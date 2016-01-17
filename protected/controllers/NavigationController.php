<?php
class NavigationController extends Controller
{
	/**导航列表**/
	public function actionNavigation_list(){
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$str_group = '';   //获取将要删除navigation_group表的id
			$nav_group = VcosNavigationGroup::model()->findAll("navigation_id in('$ids')");
			foreach($nav_group as $la2){
				$str_group .= $la2['navigation_group_id'].',';
			}
			$str_group = trim($str_group,',');
			//var_dump($str_group);
			//exit;
			//$count = VcosNavigation::model()->deleteAll("navigation_id in($ids)");
			$count = $db->createCommand("UPDATE `vcos_navigation` set status=0 WHERE navigation_id in('$ids')")->execute();
			//$count1 = VcosNavigationGroup::model()->deleteAll("navigation_id in($ids)");
			$sql = "UPDATE `vcos_navigation_group` set status=0 WHERE navigation_id in('$ids')";
			$db->createCommand($sql)->execute();
			if($str_group != ''){
			//$count2 = VcosNavigationGroupCategory::model()->deleteAll("navigation_group_id in($str_group)");
			$db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_id in($str_group)")->execute();
			//$count3 = VcosNavigationGroupBrand::model()->deleteAll("navigation_group_id in($str_group)");
			$db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_id in($str_group)")->execute();
			}
			//导航指定活动禁用
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id in ({$ids})";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
			$nav_act = '';
			foreach($data as $row){
				$nav_act .= $row['activity_id']; 
			}
			$nav_act = trim($nav_act,',');
		    $sql = "UPDATE `vcos_activity` SET status=0 WHERE activity_id in ({$nav_act})";
		    $db->createCommand($sql)->execute();
			//if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_list"));
			//}else{
				//Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$str_group = '';   //获取将要删除navigation_group表的id
			$nav_group = VcosNavigationGroup::model()->findAll("navigation_id in($did)");
			foreach($nav_group as $la2){
				$str_group .= $la2['navigation_group_id'].',';
			}
			$str_group = trim($str_group,',');
			
			//$count=VcosNavigation::model()->deleteByPk($did);
			//$count1 = VcosNavigationGroup::model()->deleteAll("navigation_id in($did)");
			$count =  $db->createCommand("UPDATE `vcos_navigation` set status=0 WHERE navigation_id in($did)")->execute();
			$db->createCommand("UPDATE `vcos_navigation_group` set status=0 WHERE navigation_id in($did)")->execute();
			if($str_group != ''){
			//$count2 = VcosNavigationGroupCategory::model()->deleteAll("navigation_group_id in($str_group)");
			//$count3 = VcosNavigationGroupBrand::model()->deleteAll("navigation_group_id in($str_group)");
				$db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_id in($str_group)")->execute();
				$db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_id in($str_group)")->execute();
			}
			
			//导航指定活动禁用
			$sql = "UPDATE `vcos_activity` SET status=0 WHERE activity_id=(SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$did}')";
			$db->createCommand($sql)->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		
		
		$count_sql = "SELECT count(*) count FROM `vcos_navigation` a LEFT JOIN `vcos_activity` b ON a.activity_id=b.activity_id";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.activity_name FROM `vcos_navigation` a LEFT JOIN `vcos_activity` b ON a.activity_id=b.activity_id
		LIMIT {$criteria->offset}, 10";
		$navigation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE status=1";
		$navigation_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_list',array('pages'=>$pager,'auth'=>$this->auth,'navigation'=>$navigation));
	}
	
	/**导航添加**/
	public function actionNavigation_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$navigation = new VcosNavigation();
		$activity = new VcosActivity();
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$type_activity = isset($_POST['type_activity'])?$_POST['type_activity']:'';
			$type_shop = isset($_POST['type_shop'])?$_POST['type_shop']:'';
			$type_product = isset($_POST['type_product'])?$_POST['type_product']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$show = isset($_POST['show'])?$_POST['show']:0;
			$set_cat = isset($_POST['set_cat'])?$_POST['set_cat']:0;
			$main = isset($_POST['main'])?$_POST['main']:0;
			$nav_type = '';
			if($type_activity!=''){
				$nav_type .=$type_activity.',';
			}
			if($type_shop!=''){
				$nav_type .=$type_shop.',';
			}
			if($type_product!=''){
				$nav_type .=$type_product.',';
			}
			$nav_type = trim($nav_type,',');
			$create_times = date("Y/m/d H:i:s",time());
			$cruise_id = Yii::app()->params['cruise_id'];
			$this_user_id = Yii::app()->user->id;
			$this_user_name = Yii::app()->user->name;
			//先自动生成活动
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$activity->activity_name = $name;
				$activity->start_time = $create_times;
				$activity->status = $state;
				$activity->created = $create_times;
				$activity->creator = $this_user_name;
				$activity->creator_id = $this_user_id;
				$activity->cruise_id = $cruise_id;
				$activity->is_show_head = 0;
				$activity->is_nav = 1;
				$activity->save();
				$ac_id = $activity->attributes['activity_id'];
				$transaction->commit();
				//Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/navigation_list"));
				$flag = 1;
			
			}catch(Exception $e){
				$transaction->rollBack();
				//Helper::show_message(yii::t('vcos', '添加失败。'), '#');
				$flag = 0;
			}
			if($flag == 1){
			//导航添加
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation->activity_id = $ac_id;
				$navigation->navigation_name = $name;
				$navigation->sort_order = $sort;
				$navigation->status = $state;
				$navigation->navigation_style_type = $nav_type;
				$navigation->cruise_id = $cruise_id;
				$navigation->is_show = $show;
				$navigation->is_category = $set_cat;
				$navigation->is_main = $main;
				$navigation->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/navigation_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
			}else{
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_add',array('navigation'=>$navigation,'activity'=>$activity));
	}
	
	/**导航编辑**/
	public function actionNavigation_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$navigation= VcosNavigation::model()->findByPk($id);
		if($_POST){
			$old_name = isset($_POST['old_name'])?$_POST['old_name']:'';
			$act_id = isset($_POST['act_id'])?$_POST['act_id']:'';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$type_activity = isset($_POST['type_activity'])?$_POST['type_activity']:'';
			$type_shop = isset($_POST['type_shop'])?$_POST['type_shop']:'';
			$type_product = isset($_POST['type_product'])?$_POST['type_product']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$cruise_id = Yii::app()->params['cruise_id'];
			$show = isset($_POST['show'])?$_POST['show']:0;
			$set_cat = isset($_POST['set_cat'])?$_POST['set_cat']:0;
			$main = isset($_POST['main'])?$_POST['main']:0;
			$nav_type = '';
			$un_activity_product = '';
			if($type_activity!=''){
				$nav_type .=$type_activity.',';
			}else if($type_activity==''){
				$un_activity_product .= '4,';
			}
			if($type_shop!=''){
				$nav_type .=$type_shop.',';
			}else if($type_shop==''){
				$un_activity_product .= '3,';
			}
			if($type_product!=''){
				$nav_type .=$type_product.',';
			}else if($type_product==''){
				$un_activity_product .= '6,';
			}
			$nav_type = trim($nav_type,',');
			$un_activity_product = trim($un_activity_product,',');
			if($old_name!=$name){
				$sql = "UPDATE `vcos_activity` SET activity_name='".$name."' WHERE activity_id=".$act_id;
				Yii::app()->p_db->createCommand($sql)->execute();
			}
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation->navigation_name = $name;
				$navigation->sort_order = $sort;
				$navigation->status = $state;
				$navigation->navigation_style_type = $nav_type;
				$navigation->cruise_id = $cruise_id;
				$navigation->is_show = $show;
				$navigation->is_category = $set_cat;
				$navigation->is_main = $main;
				$navigation->save();
				if($un_activity_product!=''){
				$sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$act_id}' AND product_type in ({$un_activity_product})";
				Yii::app()->p_db->createCommand($sql)->execute();
				}
				
				//商品分类：启用和禁用导航 ，修改相应子类
				if($set_cat==1){
					$sql = "UPDATE `vcos_navigation_group` SET status='{$state}' WHERE navigation_id='{$id}'";
					Yii::app()->p_db->createCommand($sql)->execute();
					$sql = "SELECT navigation_group_id FROM `vcos_navigation_group` WHERE navigation_id='{$id}'";
					$nav_cats = Yii::app()->p_db->createCommand($sql)->queryAll();
					$nav_cat_ids = '';
					foreach($nav_cats as $row){
						$nav_cat_ids .= $row['navigation_group_id'].',';
					}
					$nav_cat_ids = trim($nav_cat_ids,',');
					$sql = "UPDATE `vcos_navigation_group_category` SET status='{$state}' WHERE navigation_group_id in ({$nav_cat_ids})";
					Yii::app()->p_db->createCommand($sql)->execute();
				}
				
				$sql = "UPDATE `vcos_activity` SET status='{$state}' WHERE activity_id='{$act_id}'";
				Yii::app()->p_db->createCommand($sql)->execute();
				
				
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/navigation_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_edit',array('navigation'=>$navigation,'activity'=>$activity));
	}
	
	//检验导航名是否已经存在
	public function actionCheckNavNameExits(){
		$this->setauth();//检查有无权限
		$id = isset($_GET['id'])?$_GET['id']:0;
		$name = isset($_GET['name'])?$_GET['name']:'';
		if($id==0){
			$sql = "SELECT count(*) count FROM `vcos_navigation` WHERE navigation_name='$name'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		}else{
			$sql = "SELECT count(*) count FROM `vcos_navigation` WHERE navigation_name='$name' AND navigation_id!='{$id}'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		}
		if($count['count']>0){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	
	
	/**导航组列表**/
	public function actionNavigation_group_list(){
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			//$count = VcosNavigationGroup::model()->deleteAll("navigation_group_id in('$ids')");
			//$count1 = VcosNavigationGroupCategory::model()->deleteAll("navigation_group_id in('$ids')");
			//$count2 = VcosNavigationGroupBrand::model()->deleteAll("navigation_group_id in('$ids')");
			$count = $db->createCommand("UPDATE `vcos_navigation_group` set status=0 WHERE navigation_group_id in('$ids')")->execute();
			$db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_id in('$ids')")->execute();
			$db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_id in('$ids')")->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_list"));
			//}else{
				//Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			//$count=VcosNavigationGroup::model()->deleteByPk($did);
			//$count1 = VcosNavigationGroupCategory::model()->deleteAll("navigation_group_id in('$did')");
			//$count1 = VcosNavigationGroupBrand::model()->deleteAll("navigation_group_id in('$did')");
			$count = $db->createCommand("UPDATE `vcos_navigation_group` set status=0 WHERE navigation_group_id in('$did')")->execute();
			$db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_id in('$did')")->execute();
			$db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_id in('$did')")->execute();
			//if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		
		if(isset($_GET['navigation'])){
			$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE navigation_id =".$_GET['navigation'];
		}else{
			$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE is_category=1 LIMIT 1";
		}
		$navigation_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$navigation_but = $navigation_first['navigation_id'];
		
		$count_sql = "SELECT count(*) count FROM `vcos_navigation_group` a LEFT JOIN `vcos_navigation` b ON a.navigation_id=b.navigation_id LEFT JOIN `vcos_activity` c ON a.activity_id = c.activity_id WHERE b.status=1 AND a.navigation_id=".$navigation_but;
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.navigation_name,c.activity_name FROM `vcos_navigation_group` a
		LEFT JOIN `vcos_navigation` b ON a.navigation_id = b.navigation_id
		LEFT JOIN `vcos_activity` c ON a.activity_id = c.activity_id
		WHERE b.status=1 AND a.navigation_id=".$navigation_but."
		ORDER BY a.navigation_id DESC
		LIMIT {$criteria->offset}, 10";
		$navigation_group = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE is_category=1 AND status=1";
		$navigation_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_list',array('navigation_sel'=>$navigation_sel,'navigation_but'=>$navigation_but,'pages'=>$pager,'auth'=>$this->auth,'navigation_group'=>$navigation_group));
	}
	
	/**导航组添加**/
	public function actionNavigation_group_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$navigation_group = new VcosNavigationGroup();
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$navigation = isset($_POST['navigation'])?$_POST['navigation']:0;
			$activity = isset($_POST['activity'])?$_POST['activity']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$group_type = isset($_POST['group_type'])?$_POST['group_type']:'0';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'navigation_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'navigation_images/'.Yii::app()->params['month'].'/'.$photo;
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group->navigation_group_name = $name;
				$navigation_group->navigation_id = $navigation;
				$navigation_group->activity_id = $activity;
				$navigation_group->img_url = $photo_url;
				$navigation_group->sort_order = $sort;
				$navigation_group->status = $state;
				$navigation_group->show_type = $group_type;
				$navigation_group->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/navigation_group_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE is_category=1 AND status=1 ";
		$navigation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_add',array('activity'=>$activity,'navigation'=>$navigation,'navigation_group'=>$navigation_group));
	}
	
	/**编辑导航组**/
	public function actionNavigation_group_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$navigation_group= VcosNavigationGroup::model()->findByPk($id);
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$navigation = isset($_POST['navigation'])?$_POST['navigation']:0;
			$activity = isset($_POST['activity'])?$_POST['activity']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$group_type = isset($_POST['group_type'])?$_POST['group_type']:'0';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'navigation_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'navigation_images/'.Yii::app()->params['month'].'/'.$photo;
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group->navigation_group_name = $name;
				$navigation_group->navigation_id = $navigation;
				$navigation_group->activity_id = $activity;
				$navigation_group->img_url = $photo_url;
				$navigation_group->sort_order = $sort;
				$navigation_group->status = $state;
				$navigation_group->show_type = $group_type;
				$navigation_group->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/navigation_group_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT navigation_id,navigation_name FROM `vcos_navigation` WHERE is_category=1 AND status=1";
		$navigation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_edit',array('activity'=>$activity,'navigation'=>$navigation,'navigation_group'=>$navigation_group));
	}
	
	/**查看是否已经存在第一个显示的导航字段**/
	public function actionCheckIsMain(){
		$this->setauth();//检查有无权限
		$nav_id = isset($_GET['nav_id'])?$_GET['nav_id']:0;
		$sql = "SELECT count(*) count FROM `vcos_navigation` WHERE is_main=1 AND navigation_id!='{$nav_id}'";
		$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		if($count['count'] == 0){
			echo 0;
		}else{
			echo 1;
		}
	}
	/**取消已经是第一个的导航显示***/
	public function actionOffIsMain(){
		$this->setauth();//检查有无权限
		$sql = "Update `vcos_navigation` set is_main=0 WHERE is_main=1";
		Yii::app()->p_db->createCommand($sql)->execute();
	}
	
	
	/**导航组分类列表**/
	public function actionNavigation_group_category_list(){
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			//$count = VcosNavigationGroupCategory::model()->deleteAll("navigation_group_cid in('$ids')");
			$count = $db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_cid in('$ids')")->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_category_list"));
			//}else{
				//Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			//$count=VcosNavigationGroupCategory::model()->deleteByPk($did);
			$count = $db->createCommand("UPDATE `vcos_navigation_group_category` set status=0 WHERE navigation_group_cid in('$did')")->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_category_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		
		if(isset($_GET['navigation_group'])){
			$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` WHERE navigation_group_id=".$_GET['navigation_group'];
		}else{
			//$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` LIMIT 1";
			$sql = "SELECT a.navigation_group_id,a.navigation_group_name FROM `vcos_navigation_group` a LEFT JOIN `vcos_navigation` b ON a.navigation_id=b.navigation_id WHERE b.is_category=1 AND a.status=1 LIMIT 1";
		}
		$navigation_group_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$navigation_group_but = $navigation_group_first['navigation_group_id'];
		
		$count_sql = "SELECT count(*) count FROM `vcos_navigation_group_category` a LEFT JOIN `vcos_navigation_group` b ON a.navigation_group_id=b.navigation_group_id WHERE a.navigation_group_id=".$navigation_group_but;
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.navigation_group_name FROM `vcos_navigation_group_category` a
		LEFT JOIN `vcos_navigation_group` b ON a.navigation_group_id=b.navigation_group_id
		WHERE a.navigation_group_id =".$navigation_group_but."
		LIMIT {$criteria->offset}, 10";
		
		$navigation_group_category = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT a.navigation_group_id,a.navigation_group_name FROM `vcos_navigation_group` a
		LEFT JOIN `vcos_navigation` b ON a.navigation_id=b.navigation_id WHERE b.is_category=1 AND a.status=1";
		$navigation_group_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_category_list',array('navigation_group_but'=>$navigation_group_but,'navigation_group_sel'=>$navigation_group_sel,'pages'=>$pager,'auth'=>$this->auth,'navigation_group_category'=>$navigation_group_category));
	}
	
	/**导航组分类添加**/
	public function actionNavigation_group_category_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$navigation_group_category = new VcosNavigationGroupCategory();
		if($_POST){
			$navigation_group = isset($_POST['navigation_group'])?$_POST['navigation_group']:0;
			$name = isset($_POST['name'])?$_POST['name']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$highlight = isset($_POST['highlight'])?$_POST['highlight']:0;
			$type = isset($_POST['type'])?$_POST['type']:'0';
			if($type == 1){
				$mapping = isset($_POST['mapping'])?$_POST['mapping']:'';
				$mapping = trim($mapping,',');
			}else{
				$mapping = isset($_POST['one_sel'])?$_POST['one_sel']:'';
			}
			//$mapping = isset($_POST['mapping'])?$_POST['mapping']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group_category->navigation_group_id = $navigation_group;
				$navigation_group_category->navigation_category_name = $name;
				$navigation_group_category->sort_order = $sort;
				$navigation_group_category->is_highlight = $highlight;
				$navigation_group_category->category_type = $type;
				$navigation_group_category->mapping_id = $mapping;
				$navigation_group_category->status = $state;
				$navigation_group_category->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/navigation_group_category_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT * FROM `vcos_navigation_group` WHERE status=1";
		$navigation_group = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat_1 = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_category_add',array('cat_1'=>$cat_1,'navigation_group'=>$navigation_group,'navigation_group_category'=>$navigation_group_category));
	}	
	
	/**导航组分类编辑**/
	public function actionNavigation_group_category_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$navigation_group_category= VcosNavigationGroupCategory::model()->findByPk($id);
		if($_POST){
			$navigation_group = isset($_POST['navigation_group'])?$_POST['navigation_group']:0;
			$name = isset($_POST['name'])?$_POST['name']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$highlight = isset($_POST['highlight'])?$_POST['highlight']:0;
			$type = isset($_POST['type'])?$_POST['type']:'0';
			if($type == 1){
				$mapping = isset($_POST['mapping'])?$_POST['mapping']:'';
				$mapping = trim($mapping,',');
			}else{
				$mapping = isset($_POST['one_sel'])?$_POST['one_sel']:'';
			}
			//$mapping = isset($_POST['mapping'])?$_POST['mapping']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group_category->navigation_group_id = $navigation_group;
				$navigation_group_category->navigation_category_name = $name;
				$navigation_group_category->sort_order = $sort;
				$navigation_group_category->is_highlight = $highlight;
				$navigation_group_category->category_type = $type;
				$navigation_group_category->mapping_id = $mapping;
				$navigation_group_category->status = $state;
				$navigation_group_category->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/navigation_group_category_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT * FROM `vcos_navigation_group` WHERE status=1";
		$navigation_group = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat_1 = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this_type_val = $navigation_group_category['category_type'];
		$type_cat = '';
		$cat2_val = '';
		$cat1_val = '';
		$cat2_name = '';
		$checked_sel = '';
		if($this_type_val==2){
			$sql = "SELECT brand_id as val1,brand_cn_name as val2 FROM `vcos_brand` WHERE brand_status=1";
			$type_cat = Yii::app()->p_db->createCommand($sql)->queryAll();
		}elseif($this_type_val==3){
			$sql = "SELECT shop_id as val1,shop_title as val2 FROM `vcos_shop`";
			$type_cat = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else if($this_type_val == 1){
			$this_code = $navigation_group_category['mapping_id'];
			$this_code = trim($this_code,',');
			$sql = "SELECT category_code,name from `vcos_category` WHERE category_code in ({$this_code})";
			$checked_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			$this_code = explode(",",$this_code);
			$this_code = $this_code[0];
			$this_code_length = strlen($this_code);
			
			if($this_code_length == 7){
				//三级
				$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$this_code;
				$cat2_res = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT parent_cid,name FROM `vcos_category` WHERE category_code=".$cat2_res['parent_cid'];
				$cat1_res = Yii::app()->p_db->createCommand($sql)->queryRow();
				$cat1_val = $cat1_res['parent_cid'];
				$cat2_name = $cat1_res['name'];
				$cat2_val = $cat2_res['parent_cid'];
			}else{
				//二级
				$sql = "SELECT parent_cid,name FROM `vcos_category` WHERE category_code=".$this_code;
				$cat1_res = Yii::app()->p_db->createCommand($sql)->queryRow();
				$cat2_name = $cat1_res['name'];
				$cat1_val = $cat1_res['parent_cid'];
				$cat2_val = $this_code;
				
			}
		$sql = "SELECT * from `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT * from `vcos_category` WHERE parent_cid=".$cat1_val;
		$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT * from `vcos_category` WHERE parent_cid=".$cat2_val;
		$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		$this->render('navigation_group_category_edit',array('checked_sel'=>$checked_sel,'cat2_name'=>$cat2_name,'type_cat'=>$type_cat,'cat1_val'=>$cat1_val,'cat2_val'=>$cat2_val,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'navigation_group'=>$navigation_group,'navigation_group_category'=>$navigation_group_category));
	}
	
	
	/**导航组分类：通过选择分类类型，对应列出分类类型名称
	 * @type==2:品牌
	 * @type==3:店铺
	 * **/
	public function actionCategoryTypeGetChild(){
		$this->setauth();//检查有无权限
		$type = isset($_GET['type'])?$_GET['type']:0;
		$result = '';
		if($type==2){
			$sql = "SELECT brand_id as val1,brand_cn_name as val2 FROM `vcos_brand` WHERE brand_status=1";
		}else if($type == 3){
			$sql = "SELECT shop_id as val1,shop_title as val2 FROM `vcos_shop`";
		}
		$result = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}  else {
			echo 0;
		}
	}
	
	/**根据分类父级code获取分类**/
	public function actionGetCategoryChild(){
		$this->setauth();//检查有无权限
		$code = isset($_GET['code'])?$_GET['code']:0;
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$code;
		$result = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}  else {
			echo 0;
		}
	}
	
	
	/**导航组品牌列表**/
	public function actionNavigation_group_brand_list(){
		$this->setauth();//检查有无权限
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			//$count = VcosNavigationGroupBrand::model()->deleteAll("navigation_group_bid in('$ids')");
			$count = $db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_bid in('$ids')")->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_brand_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			//$count=VcosNavigationGroupBrand::model()->deleteByPk($did);
			$count = $db->createCommand("UPDATE `vcos_navigation_group_brand` set status=0 WHERE navigation_group_bid in('$did')")->execute();
			//if ($count){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_group_brand_list"));
				
			//}else{
				//Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['navigation_group'])){
			$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` WHERE navigation_group_id=".$_GET['navigation_group'];
		}else{
			//$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` LIMIT 1";
			$sql = "SELECT a.navigation_group_id,a.navigation_group_name FROM `vcos_navigation_group` a LEFT JOIN `vcos_navigation` b ON a.navigation_id=b.navigation_id WHERE b.is_category=1 AND a.status=1 LIMIT 1";
		}
		$navigation_group_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$navigation_group_but = $navigation_group_first['navigation_group_id'];
		
		$count_sql = "SELECT count(*) count FROM `vcos_navigation_group_brand` a LEFT JOIN `vcos_navigation_group` b ON a.navigation_group_id=b.navigation_group_id LEFT JOIN `vcos_brand` c ON a.brand_id=c.brand_id WHERE a.navigation_group_id=".$navigation_group_but;
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.navigation_group_name,c.brand_cn_name FROM `vcos_navigation_group_brand` a
		LEFT JOIN `vcos_navigation_group` b ON a.navigation_group_id=b.navigation_group_id
		LEFT JOIN `vcos_brand` c ON a.brand_id=c.brand_id
		WHERE a.navigation_group_id=".$navigation_group_but."
		LIMIT {$criteria->offset}, 10";
		$navigation_group_brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT a.navigation_group_id,a.navigation_group_name FROM `vcos_navigation_group` a
		LEFT JOIN `vcos_navigation` b ON a.navigation_id=b.navigation_id WHERE b.is_category=1 AND a.status=1";
		$navigation_group_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_brand_list',array('navigation_group_sel'=>$navigation_group_sel,'navigation_group_but'=>$navigation_group_but,'pages'=>$pager,'auth'=>$this->auth,'navigation_group_brand'=>$navigation_group_brand));
	}
	
	/**导航组品牌添加**/
	public function actionNavigation_group_brand_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$navigation_group_brand = new VcosNavigationGroupBrand();
		if($_POST){
			$navigation = isset($_POST['navigation'])?$_POST['navigation']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group_brand->navigation_group_id = $navigation;
				$navigation_group_brand->brand_id = $brand;
				$navigation_group_brand->sort_order = $sort;
				$navigation_group_brand->status = $state;
				$navigation_group_brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/navigation_group_brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` WHERE status=1";
		$navigation_group = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT brand_id,brand_cn_name FROM `vcos_brand` WHERE brand_status=1";
		$brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_brand_add',array('brand'=>$brand,'navigation_group'=>$navigation_group,'navigation_group_brand'=>$navigation_group_brand));
	}
	
	/**导航组品牌编辑**/
	public function actionNavigation_group_brand_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$navigation_group_brand= VcosNavigationGroupBrand::model()->findByPk($id);
		if($_POST){
			$navigation = isset($_POST['navigation'])?$_POST['navigation']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'0';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$navigation_group_brand->navigation_group_id = $navigation;
				$navigation_group_brand->brand_id = $brand;
				$navigation_group_brand->sort_order = $sort;
				$navigation_group_brand->status = $state;
				$navigation_group_brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/navigation_group_brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT navigation_group_id,navigation_group_name FROM `vcos_navigation_group` WHERE status=1";
		$navigation_group = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT brand_id,brand_cn_name FROM `vcos_brand` WHERE brand_status=1";
		$brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('navigation_group_brand_edit',array('brand'=>$brand,'navigation_group'=>$navigation_group,'navigation_group_brand'=>$navigation_group_brand));
	}
	
	
	/**添加导航内容**/
	public function actionNavigation_content(){
		$this->setauth();//检查有无权限
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosActivityProduct::model()->deleteAll("id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_content"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosActivityProduct::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Navigation/navigation_content"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		/*
		if(isset($_GET['naviagtion'])){
			$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE  activity_id=".$_GET['activity'];
			$activity_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		}else{
			$sql = "SELECT activity_id,activity_name FROM `vcos_activity` LIMIT 1";
			$activity_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		}
		$navigation_but = $activity_first['activity_id'];
		$type_but = 0;
		
		$activity_id = isset($_GET['activity'])?$_GET['activity']:$activity_first['activity_id'];
		
		$navigation_but =$activity_id;
		$type_but = $type_id;
		*/
		
		$type_id = isset($_GET['type'])?$_GET['type']:0;
		$type_but = $type_id;
		
		$sql = "SELECT a.navigation_id,a.navigation_name,a.activity_id,b.activity_name FROM `vcos_navigation` a LEFT JOIN `vcos_activity` b ON a.activity_id=b.activity_id WHERE a.status=1";
		$navigation_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$navigation_but = $navigation_sel[0]['navigation_id'];
		$activity_id = $navigation_sel[0]['activity_id'];
		$sql = "call fun_activity_product_t1($activity_id,$type_id)";
		$activity_product = Yii::app()->p_db->createCommand($sql)->queryAll();
		$criteria = new CDbCriteria();
		$count = count($activity_product);
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		
		$this->render('navigation_content',array('navigation_but'=>$navigation_but,'type_but'=>$type_but,'navigation_sel'=>$navigation_sel,'pages'=>$pager,'auth'=>$this->auth,'activity_product'=>$activity_product));
	}
	
	
	/**栏目界面配置
	 * op=1:代表从商品分类提交成功后跳转
	 * 
	 * **/
	public function actionNav_column_set(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$sql = "SELECT navigation_id,navigation_name,navigation_style_type,is_category FROM `vcos_navigation` WHERE status=1 ORDER BY navigation_id";
		$navigation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$type_arr = $navigation[0]['navigation_style_type'];
		$type_arr = explode(',', $type_arr);
		$act = isset($_GET['act'])?$_GET['act']:$type_arr[0];
		$nav = isset($_GET['nav'])?$_GET['nav']:$navigation[0]['navigation_id'];
		$op = isset($_GET['op'])?$_GET['op']:0;
		if($act==1){$action=4;}else if($act==2){$action=3;}else if($act==3){$action=6;}
		$cat1_sel='';
		$product_category = '';
		$data_already_count='';$data_already='';$count='';$data='';
		$time = date('Y-m-d H:i:s',time());
		if($act == 1){
			//活动
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_activity` WHERE is_nav=0 ";
				//$sql = "SELECT count(*) count FROM `vcos_activity` WHERE is_nav=0 AND status=1";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$count = (int)ceil($count['count']/10);
				$sql = "SELECT activity_id id,activity_name name,status,start_time s_time,end_time e_time FROM `vcos_activity` WHERE is_nav=0  LIMIT 0,10";
				//$sql = "SELECT activity_id id,activity_name name FROM `vcos_activity` WHERE is_nav=0 AND status=1 LIMIT 0,10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else if($act == 2){
			//店铺
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_shop`";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$count = (int)ceil($count['count']/10);
				$sql = "SELECT shop_id id,shop_title name,shop_status status,is_delete is_delete  FROM `vcos_shop` LIMIT 0,10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else if($act == 3){
			//商品
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				//$sql = "SELECT count(*) count FROM `vcos_product` WHERE status=1";
				$sql = "SELECT count(*) count FROM `vcos_product`";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$count = (int)ceil($count['count']/10);
				//$sql = "SELECT product_id id,product_name name FROM `vcos_product` WHERE status=1  LIMIT 0,10";
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product`  LIMIT 0,10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else if($act=='' || $act=='category'){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_category = array(); 
				$sql = "SELECT * FROM `vcos_navigation_group` WHERE status=1 AND navigation_id=".$nav." ORDER BY sort_order";
				$product_group = Yii::app()->p_db->createCommand($sql)->queryAll();
				$count_group = count($product_group);
				foreach ($product_group as $key=>$row){	//遍历导航
					$row['count'] = $count_group;
					$product_category[$key] = $row;
					$group_id = $row['navigation_group_id'];
					$sql = "SELECT * FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$group_id}' AND status=1 ORDER BY sort_order";
					$group_cat = Yii::app()->p_db->createCommand($sql)->queryAll();
					$count_category = count($group_cat);
					if($count_category>0){	//判断该导航组下是否存在分类
					foreach($group_cat as $k=>$val){	//遍历导航组分类
						$mapping = $val['mapping_id'];
						$mapping = explode(',', $mapping);
						$cat_names = ''; 
						foreach ($mapping as $vals){
							$sql = "SELECT name FROM `vcos_category` WHERE category_code=".$vals;
							$cat_name = Yii::app()->p_db->createCommand($sql)->queryRow();
							$cat_names .= $cat_name['name'].'、';
						}
						$cat_names = trim($cat_names,'、');
						$group_cat[$k]['cat_text'] = $cat_names;
						$group_cat[$k]['count'] = $count_category;
					}
					
					$product_category[$key]['child'] = $group_cat;
					}
					
				}
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}
		$data_already_count = '';
		$data_already = '';
		$data_del_count = '';
		$data_del = '';
		//已经选择了的活动商品和回收站
		if(isset($_GET['nav'])){
			if($act!=''&&$act!='category'){
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT activity_id,navigation_style_type FROM `vcos_navigation` WHERE navigation_id=".$nav." LIMIT 1";
					$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
					$activity = $activity['activity_id'];
					
					//选中
					if($act==1){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}else if($act ==2){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}else if($act==3){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}
					$data_already_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
					$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
					//回收站
					if($act==1){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
						$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
					}else if($act ==2){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
						$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
					}else if($act==3){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
						$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 LIMIT 10 ";
					}

					$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
					$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
						
					$data_already_count = (int)ceil($data_already_count['count']/10);
					$data_del_count = (int)ceil($data_del_count['count']/10);
					
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
		}else{
			if($act!=''&&$act!='category'){
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id=".$navigation[0]['navigation_id']." LIMIT 1";
					$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
					$activity = $activity['activity_id'];
					//选中
					if($act==1){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}else if($act ==2){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}else if($act==3){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
						$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
					}
					$data_already_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
					$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
					//回收站
					if($act==1){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
						$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
					}else if($act ==2){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
						$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
					}else if($act==3){
						$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
						$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
					}
					$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
					$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
					
					$data_already_count = (int)ceil($data_already_count['count']/10);
					$data_del_count = (int)ceil($data_del_count['count']/10);
					
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
		}
		
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE status=1 AND parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if(isset($_GET['act']) && $op!=1){
			if($act!=''&&$act!='category'){
				$data_all  = array();
				$data_all['all_count'] = $count;
				$data_all['all_data'] = $data;
				$data_all['already_count'] = $data_already_count;
				$data_all['already_data'] = $data_already;
				$data_all['del_count'] = $data_del_count;
				$data_all['del_data'] = $data_del;
				if($data_all){
					echo json_encode($data_all);
				}else{
					echo 0;
				}
			}else if($act=='category'){
				if($product_category){
					echo json_encode($product_category);
				}else{
					echo 0;
				}
			}
			exit;
		}
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat_1 = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('nav_column_set',array('checked_page_num'=>1,'all_page_num'=>1,'delete_page_num'=>1,'this_nav'=>$nav,'cat_1'=>$cat_1,'product_category'=>$product_category,'data_already'=>$data_already,'data_already_count'=>$data_already_count,'data_del_count'=>$data_del_count,'data_del'=>$data_del,'navigation'=>$navigation,'data'=>$data,'count'=>$count,'cat1_sel'=>$cat1_sel));
		
	}
	
	
	/**栏目页面配置：验证商品分类名是否唯一**/
	public function actionCheckCategoryName(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav_id = isset($_GET['nav'])?trim($_GET['nav']):'';
		$name = isset($_GET['name'])?trim($_GET['name']):'';
		$val = isset($_GET['val'])?trim($_GET['val']):'';
		$parent = isset($_GET['parent'])?trim($_GET['parent']):'';
		if($val==''){
			//新增
				$sql = "SELECT count(*) count FROM `vcos_navigation_group` WHERE navigation_group_name='{$name}' AND navigation_id='{$nav_id}'";
				$nav = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT navigation_group_id FROM `vcos_navigation_group` WHERE navigation_id='{$nav_id}'";
				$all_nav = Yii::app()->p_db->createCommand($sql)->queryAll();
				$all_nav_array = '';
				foreach($all_nav as $k=>$row){
					$all_nav_array .= $row['navigation_group_id'].',';
				}
				$all_nav_array = trim($all_nav_array,',');
				$sql = "SELECT count(*) count FROM `vcos_navigation_group_category` WHERE navigation_category_name='{$name}' AND navigation_group_id in ($all_nav_array)";
				$nav_cat = Yii::app()->p_db->createCommand($sql)->queryRow();
				if($nav['count']==0 && $nav_cat['count']==0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			//修改
			if($parent==0){
				$sql = "SELECT count(*) count FROM `vcos_navigation_group` WHERE navigation_group_name='{$name}' AND navigation_id='{$nav_id}' AND navigation_group_id!='{$val}'";
			}else{
				$sql = "SELECT count(*) count FROM `vcos_navigation_group` WHERE navigation_group_name='{$name}' AND navigation_id='{$nav_id}'";
			}
			$nav = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT navigation_group_id FROM `vcos_navigation_group` WHERE navigation_id='{$nav_id}'";
			$all_nav = Yii::app()->p_db->createCommand($sql)->queryAll();
			$all_nav_array = '';
			foreach($all_nav as $k=>$row){
				$all_nav_array .= $row['navigation_group_id'].',';
			}
			$all_nav_array = trim($all_nav_array,',');
			if($parent==0){
				$sql = "SELECT count(*) count FROM `vcos_navigation_group_category` WHERE navigation_category_name='{$name}' AND navigation_group_id in ($all_nav_array)";
			}else{
				$sql = "SELECT count(*) count FROM `vcos_navigation_group_category` WHERE navigation_category_name='{$name}' AND navigation_group_id in ($all_nav_array) AND navigation_group_cid!='{$val}'";
			}
			$nav_cat = Yii::app()->p_db->createCommand($sql)->queryRow();
			
			if($nav['count']==0 && $nav_cat['count']==0){
				echo 1;
			}else{
				echo 0;
			}
			
		}
		
		
	}
	
	/**栏目界面配置分页**/
	public function actionGetNavigationTypePage(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?$_POST['nav']:'';
		$pag = isset($_POST['pag'])?$_POST['pag']==1?0:($_POST['pag']-1)*10:0;
		$act = isset($_POST['act'])?$_POST['act']:'';
		$this_one = isset($_POST['this_one'])?$_POST['this_one']:0;
		$this_two = isset($_POST['this_two'])?$_POST['this_two']:0;
		$this_three = isset($_POST['this_three'])?$_POST['this_three']:0;
		if($act==1){$action=4;}else if($act==2){$action=3;}else if($act==3){$action=6;}
		$time = date('Y-m-d H:i:s',time());
		if($act == 1){
			//活动
			$sql = "SELECT activity_id id,activity_name name,status,start_time s_time,end_time e_time FROM `vcos_activity` WHERE is_nav=0  LIMIT {$pag},10";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		}elseif($act == 2){
			//店铺
			$sql = "SELECT shop_id id,shop_title name,shop_status status,is_delete is_delete FROM `vcos_shop` LIMIT {$pag},10";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		}elseif($act==3){
			//商品
			if($this_one==0){
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product`   LIMIT {$pag},10";
			}else if($this_one!=0&&$this_two==0){
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE  category_code like '{$this_one}%' LIMIT {$pag},10";
			}else if($this_one!=0&&$this_two!=0&&$this_three==0){
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE  category_code like '{$this_two}%' LIMIT {$pag},10";
			}else{
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE  category_code='{$this_three}' LIMIT {$pag},10";
			}
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		
		//获取用户已经选择的记录
		$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
		$sql = "SELECT product_id s_id,sort_order s_sort,start_show_time,end_show_time,is_overdue FROM `vcos_activity_product` WHERE product_type='{$action}' AND activity_id='{$activity['activity_id']}' AND is_overdue!=2";
		$checked_data = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($data){
			$data_all = array();
			$data_all[0] = $data;
			$data_all[1] = $checked_data;
			echo json_encode($data_all);
		}else{
			echo 0;
		}
	}
	
	/**选中页面分页**/
	public function actionGetAlreadyNavigationTypePage(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?$_POST['nav']:'';
		$pag = isset($_POST['pag'])?$_POST['pag']==1?0:($_POST['pag']-1)*10:0;
		$act = isset($_POST['act'])?$_POST['act']:'';
		$this_one = isset($_POST['this_one'])?$_POST['this_one']:0;
		$this_two = isset($_POST['this_two'])?$_POST['this_two']:0;
		$this_three = isset($_POST['this_three'])?$_POST['this_three']:0;
		if($act==1){$action=4;}else if($act==2){$action=3;}else if($act==3){$action=6;}
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id=".$nav." LIMIT 1";
			$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
			$activity = $activity['activity_id'];
			if($act==1){
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT {$pag},10 ";
			}else if($act ==2){
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT {$pag},10 ";
			}else if($act==3){
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 {$pag},LIMIT 10 ";
			}
			$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollBack();
		}
		
		if($data_already){
			echo json_encode($data_already);
		}else{
			echo 0;
		}
		
	}
	
	
	/**栏目界面配置：回收站分页***/
	public function actionGetDelNavigationTypePage(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?$_POST['nav']:'';
		$pag = isset($_POST['pag'])?$_POST['pag']==1?0:($_POST['pag']-1)*10:0;
		$act = isset($_POST['act'])?$_POST['act']:'';
		$this_one = isset($_POST['this_one'])?$_POST['this_one']:0;
		$this_two = isset($_POST['this_two'])?$_POST['this_two']:0;
		$this_three = isset($_POST['this_three'])?$_POST['this_three']:0;
		if($act==1){$action=4;}else if($act==2){$action=3;}else if($act==3){$action=6;}
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id=".$nav." LIMIT 1";
			$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
			$activity = $activity['activity_id'];
			if($act==1){
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT {$pag},10 ";
			}else if($act ==2){
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT {$pag},10 ";
			}else if($act==3){
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 {$pag},LIMIT 10 ";
			}
			$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollBack();
		}
		
		if($data_del){
			echo json_encode($data_del);
		}else{
			echo 0;
		}
	}
	
	/**栏目界面配置商品类型选择分类提交**/
	public function actionSetCategoryGetProduct(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):0;
		$this_one = isset($_POST['this_one'])?$_POST['this_one']:0;
		$this_two = isset($_POST['this_two'])?$_POST['this_two']:0;
		$this_three = isset($_POST['this_three'])?$_POST['this_three']:0;
		
		if($this_one==0){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_product`";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` LIMIT 10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else if($this_two==0 && $this_one!=0){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_product` WHERE  category_code like '{$this_one}%'";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE category_code like '{$this_one}%'  LIMIT 10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else if($this_three==0&&$this_one!=0&&$this_two!=0){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_product` WHERE category_code like '{$this_two}%'";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE category_code like '{$this_two}%'  LIMIT 10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}else{
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "SELECT count(*) count FROM `vcos_product` WHERE category_code='{$this_three}'";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				$sql = "SELECT product_id id,product_name name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE  category_code='{$this_three}'  LIMIT 10";
				$data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
			}
		}
		$p_ids = '';
		foreach ($data as $row){
			$p_ids .= $row['id'].',';
		}
		$p_ids = trim($p_ids,',');
		$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}'";
		$this_activity = Yii::app()->p_db->createCommand($sql)->queryRow();
		$sql = "SELECT product_id,start_show_time,end_show_time,is_overdue,sort_order FROM `vcos_activity_product` WHERE activity_id='{$this_activity['activity_id']}' AND product_id in ({$p_ids}) AND product_type=6 AND is_overdue!=2";
		$already_data = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$count = (int)ceil($count['count']/10);
		if($data){
			$data_all  = array();
			$data_all['count'] = $count;
			$data_all['data'] = $data;
			$data_all['already'] = $already_data;
			if($data_all){
				echo json_encode($data_all);
			}
		}else{
			echo 0;
		}
		
	}
	
	
	/**栏目界面配置提交类型选中数据*
	 * $action == 4:活动
	 * $action == 3:店铺
	 * $action == 6:商品
	 * */
	public function actionUpdateNavigationTypeCategory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):"";
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$sel_ids = isset($_POST['sel_ids'])?trim($_POST['sel_ids']):'';
		$sel_sort = isset($_POST['sel_sort'])?trim($_POST['sel_sort']):'';
		$sel_s_times = isset($_POST['sel_s_times'])?trim($_POST['sel_s_times']):'';
		$sel_e_times = isset($_POST['sel_e_times'])?trim($_POST['sel_e_times']):'';
		$unsel_ids = isset($_POST['unsel_ids'])?trim($_POST['unsel_ids']):'';
		$times = date("Y-m-d H:i:s",time());
		if($type==1){$action=4;}else if($type==2){$action=3;}else if($type==3){$action=6;}
		$flag = 1;
		$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
		$time = date('Y-m-d H:i:s',time());
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			if($sel_ids!=''){
			$sel_ids  = explode(',', $sel_ids);
			$sel_sort = explode(',', $sel_sort);
			$sel_s_times = explode(',', $sel_s_times);
			$sel_e_times = explode(',', $sel_e_times);
			
			for($i=0;$i<count($sel_ids);$i++){
				if($action==4){
					$sql = "SELECT status,start_time s_time,end_time e_time FROM `vcos_activity` WHERE activity_id = '{$sel_ids[$i]}'";
				}else if($action==3){
					$sql = "SELECT shop_status status,is_delete is_delete FROM `vcos_shop` WHERE shop_id = '{$sel_ids[$i]}'";
				}else if($action==6){
					$sql = "SELECT status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE product_id='{$sel_ids[$i]}'";
				}
				$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
				if(isset($this_data['s_time'])){
					if($this_data['s_time']<=$sel_s_times[$i] && $this_data['e_time']>=$sel_e_times[$i] && $this_data['status']==1){
						if($sel_s_times[$i]<=$time && $sel_e_times[$i]>=$time){
							$is = 0;
						}else if($sel_s_times[$i]>$time){
							$is = 0;
						}else{
							$is = 1;
						}
					}else{
						$is = 1;
					}
				}else{
					if($this_data['status']==1){
						$is=0;
					}else{
						$is=1;
					}
				}
				if(isset($this_data['is_delete'])){
					if($this_data['is_delete']==1){
						$is = 1;
					}else{
						if($is==0){
							$is = 0;
						}else{
							$is =1;
						}
					}
				}
				$sql = "SELECT count(*) count FROM `vcos_activity_product` WHERE activity_id='{$activity['activity_id']}' AND product_id='$sel_ids[$i]' AND product_type='{$action}'";
				$count = Yii::app()->p_db->createCommand($sql)->queryRow();
				if($count['count']>0){
					//修改
					$sql = "UPDATE `vcos_activity_product` SET sort_order='{$sel_sort[$i]}',is_overdue='{$is}',start_show_time='{$sel_s_times[$i]}',end_show_time='{$sel_e_times[$i]}' WHERE activity_id='{$activity['activity_id']}' AND product_id='$sel_ids[$i]' AND product_type='{$action}'";
					$result = Yii::app()->p_db->createCommand($sql)->execute();
				}else{
					//新增
					$sql = "INSERT INTO `vcos_activity_product` (activity_id,product_id,sort_order,start_show_time,end_show_time,product_type,is_overdue) VALUES ('{$activity['activity_id']}','{$sel_ids[$i]}','{$sel_sort[$i]}','{$sel_s_times[$i]}','{$sel_e_times[$i]}','{$action}','{$is}')";
					$result = Yii::app()->p_db->createCommand($sql)->execute();
				}
			}}

			if($unsel_ids!=''){
				$sql = "SELECT product_id FROM `vcos_activity_product` WHERE activity_id='{$activity['activity_id']}' AND product_type='{$action}' AND product_id in ({$unsel_ids})";
				$un_data = Yii::app()->p_db->createCommand($sql)->queryAll();
				$un_id = '';
				foreach($un_data as $row){
					$un_id .= $row['product_id'].',';
				}
				$un_id = trim($un_id,',');
				if($un_id!=''){
				$sql = "UPDATE `vcos_activity_product` SET is_overdue=2 WHERE activity_id='{$activity['activity_id']}' AND product_type='{$action}' AND product_id in ({$un_id})";
				//$sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity['activity_id']}' AND product_id in ({$unsel_ids}) AND product_type='{$action}'";
				$del_result = Yii::app()->p_db->createCommand($sql)->execute();
				}
			}
			
			$transaction->commit();
			$flag = 1;
		}catch(Exception $e){
			$transaction->rollBack();
			$flag = 0;
		}
		//提交成功获取已经选中记录遍历在已选中记录中
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$activity = $activity['activity_id'];
			
			//选中
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}
			$data_already_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
			//回收站
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}
			$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
				
			$data_already_count = (int)ceil($data_already_count['count']/10);
			$data_del_count = (int)ceil($data_del_count['count']/10);
			
			
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollBack();
		}
		
		
		if($flag==1){
			$data_all = array();
			$data_all['count'] = $data_already_count;
			$data_all['data'] = $data_already;
			$data_all['del_count'] = $data_del_count;
			$data_all['del_data'] = $data_del;
			echo json_encode($data_all);
		}else{
			echo 0;
		}
		
	}
	
	
	/**栏目界面配置，取消选中记录**/
	public function actionDelAlreadyProductActivity(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):'';
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$ids = isset($_POST['ids'])?trim($_POST['ids']):'';
		if($type==1){$action=4;}else if($type==2){$action=3;}else if($type==3){$action=6;}
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
			$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
			$activity = $activity['activity_id'];
			//$sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_id in ({$ids}) AND product_type='{$action}'";
			$sql = "UPDATE `vcos_activity_product` SET is_overdue=2 WHERE activity_id='{$activity}' AND product_id in ({$ids}) AND product_type='{$action}'";
			$del_result = Yii::app()->p_db->createCommand($sql)->execute();
			
			//选中
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}
			$data_already_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
			//回收站
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 LIMIT 10 ";
			}
			
			$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			$data_already_count = (int)ceil($data_already_count['count']/10);
			$data_del_count = (int)ceil($data_del_count['count']/10);
			
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollBack();
		}
		
		if($del_result){
			$data_all = array();
			$data_all['count'] = $data_already_count;
			$data_all['data'] = $data_already;
			$data_all['del_count'] = $data_del_count;
			$data_all['del_data'] = $data_del;
			echo json_encode($data_all);
		}else{
			echo 0;
		}
		
	}
	
	
	/**栏目界面配置，修改已选记录中的排序**/
	public function actionUpdateAlreadyProductActivity(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):'';
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$sel_ids = isset($_POST['sel_ids'])?trim($_POST['sel_ids']):'';
		$sel_sort = isset($_POST['sel_sort'])?trim($_POST['sel_sort']):'';
		$sel_s_times = isset($_POST['sel_s_times'])?trim($_POST['sel_s_times']):'';
		$sel_e_times = isset($_POST['sel_e_times'])?trim($_POST['sel_e_times']):'';
		
		if($type==1){$action=4;}else if($type==2){$action=3;}else if($type==3){$action=6;}
		$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
		$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
		$activity = $activity['activity_id'];
		$time = date('Y-m-d H:i:s',time());
		$flag = 1;
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			if($sel_ids!=''){
				$sel_ids  = explode(',', $sel_ids);
				$sel_sort = explode(',', $sel_sort);
				$sel_s_times = explode(',', $sel_s_times);
				$sel_e_times = explode(',', $sel_e_times);
				for($i=0;$i<count($sel_ids);$i++){
				//判断该条数据是否还有效
					if($action==4){
						$sql = "SELECT status,start_time s_time,end_time e_time FROM `vcos_activity` WHERE activity_id = '{$sel_ids[$i]}'";
					}else if($action==3){
						$sql = "SELECT shop_status status,is_delete is_delete FROM `vcos_shop` WHERE shop_id = '{$sel_ids[$i]}'";
					}else if($action==6){
						$sql = "SELECT status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE product_id='{$sel_ids[$i]}'";
					}
					$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
					if(isset($this_data['s_time'])){
						if($this_data['s_time']<=$sel_s_times[$i] && $this_data['e_time']>=$sel_e_times[$i] && $this_data['status']==1){
							if($sel_s_times[$i]<=$time && $sel_e_times[$i]>=$time){
								$is = 0;
							}else if($sel_s_times[$i]>$time){
								$is = 0;
							}else{
								$is = 1;
							}
						}else{
							$is = 1;
						}
					}else{
						if($this_data['status']==1){
							$is=0;
						}else{
							$is=1;
						}
					}
					if(isset($this_data['is_delete'])){
						if($this_data['is_delete']==1){
							$is = 1;
						}else{
							if($is==0){
							$is = 0;
							}else{
								$is = 1;
							}
						}
					}
				//修改
				$sql = "UPDATE `vcos_activity_product` SET sort_order='{$sel_sort[$i]}',is_overdue='{$is}',start_show_time='{$sel_s_times[$i]}',end_show_time='{$sel_e_times[$i]}' WHERE activity_id='{$activity}' AND product_id='$sel_ids[$i]' AND product_type='{$action}'";
				$result = Yii::app()->p_db->createCommand($sql)->execute();
				}
			}
			$sql = "SELECT product_id,is_overdue FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type='{$action}'";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
			$transaction->commit();
			$flag = 1;
		}catch(Exception $e){
			$transaction->rollBack();
			$flag = 0;
		}
		
		if($flag == 1){
			echo json_encode($data);
		}else{
			echo 0;
		}
	}
	
	
	/**栏目界面配置:回收站-》清除选中****/
	public function actionRemoveDelProductActivity(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):'';
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$sel_ids = isset($_POST['ids'])?trim($_POST['ids']):'';
		if($type==1){$action=4;}else if($type==2){$action=3;}else if($type==3){$action=6;}
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
			$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
			$activity = $activity['activity_id'];
			$sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type='{$action}' AND product_id in ($sel_ids)";
			Yii::app()->p_db->createCommand($sql)->execute();
			//回收站
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 LIMIT 10 ";
			}
				
			$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
			$data_del_count = (int)ceil($data_del_count['count']/10);
			
				
			
			$transaction->commit();
			$flag = 1;
		}catch(Exception $e){
			$transaction->rollBack();
			$flag = 0;
		}
		if($flag == 1){
			$data_all = array();
			$data_all['count'] = $data_del_count;
			$data_all['data'] = $data_del;
			echo json_encode($data_all);
		}else{
			echo 0;
		}
	}
	
	
	/**栏目界面配置：回收站-》恢复选中***/
	public function actionRecoveryDelProductActivity(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?trim($_POST['nav']):'';
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$sel_ids = isset($_POST['ids'])?trim($_POST['ids']):'';
		if($type==1){$action=4;}else if($type==2){$action=3;}else if($type==3){$action=6;}
		$sel_ids = explode(',', $sel_ids);
		$time = date('Y-m-d H:i:s',time());
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			
			$sql = "SELECT activity_id FROM `vcos_navigation` WHERE navigation_id='{$nav}' LIMIT 1";
			$activity = Yii::app()->p_db->createCommand($sql)->queryRow();
			$activity = $activity['activity_id'];
			foreach($sel_ids as $row){
				$sql = "SELECT start_show_time,end_show_time FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type='{$action}' AND product_id='{$row}'";
				$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
				
				if($action==4){
					$sql = "SELECT status,start_time s_time,end_time e_time FROM `vcos_activity` WHERE activity_id = '{$row}'";
				}else if($action==3){
					$sql = "SELECT shop_status status,is_delete is_delete FROM `vcos_shop` WHERE shop_id = '{$row}'";
				}else if($action==6){
					$sql = "SELECT status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE product_id='{$row}'";
				}
				$this_product = Yii::app()->p_db->createCommand($sql)->queryRow();
				
					if(isset($this_product['s_time'])){
						if($this_product['s_time']<=$this_data['start_show_time'] && $this_product['e_time']>=$this_data['end_show_time'] && $this_product['status']==1){
							if($this_data['start_show_time']<=$time && $this_data['end_show_time']>=$time){
								$is = 0;
							}else if($this_data['start_show_time']>$time){
								$is = 0;
							}else{
								$is = 1;
							}
						}else{
							$is = 1;
						}
					}else{
						if($this_product['status']==1){
							$is=0;
						}else{
							$is=1;
						}
					}
					if(isset($this_product['is_delete'])){
						if($this_product['is_delete']==1){
							$is = 1;
						}else{
							if($is==0){
							$is = 0;
							}else{
								$is = 1;
							}
						}
					}
					
			$sql = "UPDATE `vcos_activity_product` SET is_overdue='{$is}' WHERE activity_id='{$activity}' AND product_type='{$action}' AND product_id='{$row}'";
			Yii::app()->p_db->createCommand($sql)->execute();
			}
			
			//选中
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue!=2 LIMIT 10 ";
			}
			$data_already_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_already = Yii::app()->p_db->createCommand($sql)->queryAll();
			//回收站
			if($type==1){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}' AND a.is_overdue=2";
				$sql = "SELECT a.*,b.activity_name title,b.start_time s_time,b.end_time e_time,b.status FROM `vcos_activity_product` a LEFT JOIN `vcos_activity` b ON a.product_id=b.activity_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type ==2){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.shop_title title,b.shop_status status,b.is_delete is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_shop` b ON a.product_id=b.shop_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2 LIMIT 10 ";
			}else if($type==3){
				$sql_count  = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type='{$action}'  AND a.is_overdue=2";
				$sql = "SELECT a.*,b.product_name title,b.sale_start_time s_time,b.sale_end_time e_time,b.status,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 LIMIT 10 ";
			}
				
			$data_del_count = Yii::app()->p_db->createCommand($sql_count)->queryRow();
			$data_del = Yii::app()->p_db->createCommand($sql)->queryAll();
				
			$data_already_count = (int)ceil($data_already_count['count']/10);
			$data_del_count = (int)ceil($data_del_count['count']/10);
			
			
			$transaction->commit();
			$flag = 1;
		}catch(Exception $e){
			$transaction->rollBack();
			$flag = 0;
		}
		
		if($flag == 1){
			$data_all = array();
			$data_all['count'] =  $data_already_count;
			$data_all['data'] = $data_already;
			$data_all['del_count'] = $data_del_count;
			$data_all['del_data'] = $data_del;
			echo json_encode($data_all);
		}else{
			echo 0;
		}
		
	}
	
	/**栏目配置：商品分类获取导航组和导航组分类最大排序**/
	public function actionNavigationGroupGetMaxSort(){
		$this->setauth();//检查有无权限
		$nav = isset($_GET['nav'])?$_GET['nav']:'';
		$parent = isset($_GET['parent'])?$_GET['parent']:'';
		$data = '';
		if($nav!=''&&isset($_GET['nav'])){
			$sql = "SELECT sort_order FROM `vcos_navigation_group` WHERE navigation_id=".$nav." ORDER BY sort_order DESC LIMIT 1";
			$data = Yii::app()->p_db->createCommand($sql)->queryRow();
		}else if($parent!=''&&isset($_GET['parent'])){
			$sql = "SELECT sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id=".$parent." ORDER BY sort_order DESC LIMIT 1";
			$data = Yii::app()->p_db->createCommand($sql)->queryRow();
		}
		if($data){
			echo json_encode($data['sort_order']);
		}else{
			echo 0;
		}
	}
	
	
	/**栏目配置：商品分类入库**/
	public function actionNav_product_category_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$group = new VcosNavigationGroup();
		$group_category = new VcosNavigationGroupCategory();
		$nav = isset($_POST['nav'])?$_POST['nav']:0;
		$val = isset($_POST['val'])?$_POST['val']:0;
		$parent = isset($_POST['parent'])?$_POST['parent']:0;
		$name = isset($_POST['name'])?$_POST['name']:'';
		$sort = isset($_POST['sort'])?$_POST['sort']:'';
		$img_name = isset($_POST['img_name'])?$_POST['img_name']:'';
		$cat_name = isset($_POST['cat_name'])?$_POST['cat_name']:'';
		$highlight = isset($_POST['highlight'])?$_POST['highlight']:0;
		//var_dump($_POST);exit;
		if($val==0||$val==''){
			//新增
			if($parent == 0){
				$photo='';
				if($_FILES[$img_name]['error']!=4){
					$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'navigation_images/'.Yii::app()->params['month'], 'image', 3);
					$photo=$result['filename'];
				}
				$photo_url = 'navigation_images/'.Yii::app()->params['month'].'/'.$photo;
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$group->navigation_id = $nav;
					$group->navigation_group_name = $name;
					$group->sort_order = $sort;
					$group->img_url = $photo_url;
					$group->save();
					//$id = $group->attributes['navigation_group_id'];
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '添加失败。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}
			
			}else{
				
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$group_category->navigation_group_id = $parent;
					$group_category->navigation_category_name = $name;
					$group_category->sort_order = $sort;
					$group_category->is_highlight = $highlight;
					$group_category->category_type = 1;
					$group_category->mapping_id = $cat_name;
					$group_category->save();
					//$id = $group->attributes['navigation_group_id'];
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '添加失败。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}
				
			}
		}else{
			//修改
			if($parent==0){
				$photo='';
				if($_FILES[$img_name]['error']!=4){
					$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'navigation_images/'.Yii::app()->params['month'], 'image', 3);
					$photo=$result['filename'];
				}
				$photo_url = 'navigation_images/'.Yii::app()->params['month'].'/'.$photo;
				
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					if($photo==''){
						$sql = "UPDATE `vcos_navigation_group` SET navigation_group_name='{$name}' WHERE navigation_group_id='{$val}'";
					}else{
						$sql = "UPDATE `vcos_navigation_group` SET navigation_group_name='{$name}',img_url='{$photo_url}' WHERE navigation_group_id='{$val}'";
					}
					Yii::app()->p_db->createCommand($sql)->execute();
				
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '修改失败。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}
			}else{
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "UPDATE `vcos_navigation_group_category` SET navigation_category_name='{$name}',mapping_id='{$cat_name}',is_highlight='{$highlight}' WHERE navigation_group_cid='{$val}'";
					Yii::app()->p_db->createCommand($sql)->execute();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '修改失败。'), Yii::app()->createUrl("Navigation/nav_column_set",array('nav'=>$nav,'act'=>'category','op'=>1)));
				}
			}
				
		}
		
		
	}
	
	
	/***栏目界面配置：删除栏目****/
	public function actionDelNavigationAndCategory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$val = isset($_GET['val'])?$_GET['val']:0;
		$parent = isset($_GET['parent'])?$_GET['parent']:0;
		$flag=0;
		if($parent==0){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "DELETE FROM `vcos_navigation_group` WHERE navigation_group_id='{$val}'";
				Yii::app()->p_db->createCommand($sql)->execute();
				$sql = "DELETE FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$val}'";
				Yii::app()->p_db->createCommand($sql)->execute();
				$transaction->commit();
				$flag=1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag=0;
			}
		}else{
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "DELETE FROM `vcos_navigation_group_category` WHERE navigation_group_cid='{$val}'";
				Yii::app()->p_db->createCommand($sql)->execute();
				$transaction->commit();
				$flag=1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag=0;
			}
		}
		if($flag==1){
			echo 1;
		}else{
			echo 0;
		}
		
		
	}
	
	
	/**栏目界面配置
	 * act=1:置顶
	 * act=2:上移
	 * act=3:置底
	 * act=4:下移
	 * 
	 * **/
	public function actionUpdateNavigationGroupSort(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$nav = isset($_POST['nav'])?$_POST['nav']:0;
		$act = isset($_POST['act'])?$_POST['act']:0;
		$val = isset($_POST['val'])?$_POST['val']:0;
		$parent = isset($_POST['parent'])?$_POST['parent']:0;
		if($act==1){
			//事务处理
			if($parent==0){
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "UPDATE `vcos_navigation_group` SET sort_order=1 WHERE navigation_id='{$nav}' AND  navigation_group_id='{$val}' ";
					Yii::app()->p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group` SET sort_order=sort_order+1 WHERE navigation_id='{$nav}' AND navigation_group_id!='{$val}'";
					Yii::app()->p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}else{
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order=1 WHERE navigation_group_cid='{$val}' ";
					Yii::app()->p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order=sort_order+1 WHERE navigation_group_id='{$parent}' AND navigation_group_cid!='{$val}'";
					Yii::app()->p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
		}else if($act==2){
			if($parent==0){
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT navigation_group_id,sort_order FROM `vcos_navigation_group` WHERE navigation_id='{$nav}' AND  sort_order <= (SELECT sort_order FROM `vcos_navigation_group` WHERE navigation_id='{$nav}' AND navigation_group_id='{$val}') ORDER BY sort_order DESC LIMIT 2";
					$sort = $p_db->createCommand($sql)->queryAll();
					$sql = "UPDATE `vcos_navigation_group` SET sort_order='{$sort[0]["sort_order"]}' WHERE navigation_group_id=".$sort[1]["navigation_group_id"];
					$p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group` SET sort_order='{$sort[1]["sort_order"]}' WHERE navigation_group_id=".$sort[0]["navigation_group_id"];
					$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}else{
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT navigation_group_cid,sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$parent}' AND  sort_order <= (SELECT sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$parent}' AND navigation_group_cid='{$val}') ORDER BY sort_order DESC LIMIT 2";
					$sort = $p_db->createCommand($sql)->queryAll();
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order='{$sort[0]["sort_order"]}' WHERE navigation_group_cid=".$sort[1]["navigation_group_cid"];
					$p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order='{$sort[1]["sort_order"]}' WHERE navigation_group_cid=".$sort[0]["navigation_group_cid"];
					$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
			
		}else if($act==3){
			if($parent==0){
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT sort_order FROM `vcos_navigation_group` WHERE navigation_id='{$nav}' ORDER BY sort_order DESC LIMIT 1";
					$sort = $p_db->createCommand($sql)->queryRow();
					$sort = $sort['sort_order'] +1;
					$sql = "UPDATE `vcos_navigation_group` SET sort_order='{$sort}' WHERE navigation_id='{$nav}' AND navigation_group_id='{$val}'";
					$p_db->createCommand($sql)->execute();
					//$sql = "UPDATE `vcos_navigation_group` SET sort_order=sort_order-1 WHERE navigation_id='{$nav}' AND navigation_group_id !='{$val}'";
					//$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}else{
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$parent}' ORDER BY sort_order DESC LIMIT 1";
					$sort = $p_db->createCommand($sql)->queryRow();
					$sort = $sort['sort_order'] +1;
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order='{$sort}' WHERE navigation_group_id='{$parent}' AND navigation_group_cid='{$val}'";
					$p_db->createCommand($sql)->execute();
					//$sql = "UPDATE `vcos_navigation_group_category` SET sort_order=sort_order-1 WHERE navigation_group_id='{$parent}' AND navigation_group_cid !='{$val}'";
					//$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
			
		}else if($act==4){
			if($parent==0){
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT navigation_group_id,sort_order FROM `vcos_navigation_group` WHERE navigation_id='{$nav}' AND sort_order >= (SELECT sort_order FROM `vcos_navigation_group` WHERE navigation_id='{$nav}' AND navigation_group_id='{$val}') ORDER BY sort_order ASC LIMIT 2";
					$sort = $p_db->createCommand($sql)->queryAll();
					$sql = "UPDATE `vcos_navigation_group` SET sort_order='{$sort[0]["sort_order"]}' WHERE navigation_group_id=".$sort[1]["navigation_group_id"];
					$p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group` SET sort_order='{$sort[1]["sort_order"]}' WHERE navigation_group_id=".$sort[0]["navigation_group_id"];
					$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}else{
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "SELECT navigation_group_cid,sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$parent}' AND sort_order >= (SELECT sort_order FROM `vcos_navigation_group_category` WHERE navigation_group_id='{$parent}' AND navigation_group_cid='{$val}') ORDER BY sort_order ASC LIMIT 2";
					$sort = $p_db->createCommand($sql)->queryAll();
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order='{$sort[0]["sort_order"]}' WHERE navigation_group_cid=".$sort[1]["navigation_group_cid"];
					$p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_navigation_group_category` SET sort_order='{$sort[1]["sort_order"]}' WHERE navigation_group_cid=".$sort[0]["navigation_group_cid"];
					$p_db->createCommand($sql)->execute();
					$transaction->commit();
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}
		}
		echo 1;
	}
	
	
	
	
	
	
}
