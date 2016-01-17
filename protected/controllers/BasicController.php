<?php
class BasicController extends Controller
{
	/**品牌列表**/
	public function actionBrand_list(){
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			/*
			$str = '';	//获取将要删除product表的id
			$pro_ids = VcosProduct::model()->findAll("brand_id in($ids)");
			foreach($pro_ids as $la1){
				$str .= $la1['product_id'].',';
			}
			$str = trim($str,',');*/
			//$count = VcosBrand::model()->deleteAll("brand_id in($ids)");
			//$count2 = VcosProduct::model()->deleteAll("brand_id in($ids)");
			$db->createCommand("UPDATE `vcos_brand` set brand_status=0 WHERE brand_id in('$ids')")->execute();
			$db->createCommand("UPDATE `vcos_product` set status=0 WHERE brand_id in('$ids')")->execute();
			//if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Basic/brand_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			/*
			$str = '';	//获取将要删除product表的id
			$pro_ids = VcosProduct::model()->findAll("brand_id in($did)");
			foreach($pro_ids as $la1){
				$str .= $la1['product_id'].',';
			}
			$str = trim($str,',');*/
			//$count=VcosBrand::model()->deleteByPk($did);
			//$count2 = VcosProduct::model()->deleteAll("brand_id in($did)");
			$db->createCommand("UPDATE `vcos_brand` set brand_status=0 WHERE brand_id in($did)")->execute();
			$db->createCommand("UPDATE `vcos_product` set status=0 WHERE brand_id in($did)")->execute();
			//if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Basic/brand_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		$count_sql = "SELECT count(*) count FROM `vcos_brand` a LEFT JOIN `vcos_country` b ON a.country_id = b.country_id"; 
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.country_cn_name FROM `vcos_brand` a 
		LEFT JOIN `vcos_country` b ON a.country_id = b.country_id
		LIMIT {$criteria->offset}, 10";
		$brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('brand_list',array('pages'=>$pager,'auth'=>$this->auth,'brand'=>$brand));
		
	}
	
	/**品牌添加**/
	public function actionBrand_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$brand = new VcosBrand();
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$names = isset($_POST['names'])?$_POST['names']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$country = isset($_POST['country'])?$_POST['country']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:99;
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'basic_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'basic_images/'.Yii::app()->params['month'].'/'.$photo;
			$state = isset($_POST['state'])?$_POST['state']:'0';
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$brand->brand_cn_name = $name;
				$brand->brand_en_name = $names;
				$brand->country_id = $country;
				$brand->brand_logo = $photo_url;
				$brand->brand_desc = $desc;
				$brand->brand_status = $state;
				$brand->sort_order = $sort;
				$brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Basic/brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT country_id,country_cn_name FROM `vcos_country` WHERE status =1";
		$country = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('brand_add',array('brand'=>$brand,'country'=>$country));
	}
	
	/**品牌编辑**/
	public function actionBrand_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$brand= VcosBrand::model()->findByPk($id);
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$names = isset($_POST['names'])?$_POST['names']:'';
			$country = isset($_POST['country'])?$_POST['country']:0;
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:99;
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'basic_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'basic_images/'.Yii::app()->params['month'].'/'.$photo;
			$state = isset($_POST['state'])?$_POST['state']:'0';
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$brand->brand_cn_name = $name;
				$brand->brand_en_name = $names;
				$brand->country_id = $country;
				$brand->brand_desc = $desc;
				$brand->brand_status = $state;
				$brand->sort_order = $sort;
				if($photo){
					$brand->brand_logo = $photo_url;
				}
				$brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Basic/brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT country_id,country_cn_name FROM `vcos_country` WHERE status =1";
		$country = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('brand_edit',array('brand'=>$brand,'country'=>$country));
	}
	
	
	/**验证品牌名和英文名是否已经存在**/
	public function actionCheckBrandName(){
		$p_db = Yii::app()->p_db;
		$brand_id = isset($_GET['brand_id'])?trim($_GET['brand_id']):'';
		$name = isset($_GET['name'])?trim($_GET['name']):'';
		$name_iso = isset($_GET['name_iso'])?trim($_GET['name_iso']):'';
		if($brand_id!=''){
			$sql = "SELECT count(*) count FROM `vcos_brand` WHERE (brand_cn_name='{$name}' OR brand_en_name='{$name_iso}') AND brand_id!='{$brand_id}'";
		}else{
			$sql = "SELECT count(*) count FROM `vcos_brand` WHERE brand_cn_name='{$name}' OR brand_en_name='{$name_iso}'";
		}
		$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		if($count['count']>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	/**国家列表**/
	public function actionProduct_country_list(){
		$this->setauth();//检查有无权限
		$db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			
			$db->createCommand("UPDATE `vcos_country` set status=0 WHERE country_id in('$ids')")->execute();
			//$db->createCommand("UPDATE `vcos_product` set status=0 WHERE brand_id in($ids)")->execute();
			//if ($count>0){
			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Basic/product_country_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			
			$db->createCommand("UPDATE `vcos_country` set status=0 WHERE country_id in($did)")->execute();
			//$db->createCommand("UPDATE `vcos_product` set status=0 WHERE brand_id in($did)")->execute();
			//if ($count>0){
			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Basic/product_country_list"));
			//}else{
			//	Helper::show_message(yii::t('vcos', '删除失败。'));
			//}
		}
		$count_sql = "SELECT count(*) count FROM `vcos_country`";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT * FROM `vcos_country`
		LIMIT {$criteria->offset}, 10";
		$country = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('product_country_list',array('pages'=>$pager,'auth'=>$this->auth,'country'=>$country));
	}
	/**国家添加**/
	public function actionProduct_country_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$country = new VcosCountry();
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$name_en = isset($_POST['name_en'])?$_POST['name_en']:'';
			
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'basic_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'basic_images/'.Yii::app()->params['month'].'/'.$photo;
			$state = isset($_POST['state'])?$_POST['state']:'0';
				
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$country->country_cn_name = $name;
				$country->country_en_name = $name_en;
				$country->country_logo = $photo_url;
				$country->status = $state;
				$country->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Basic/product_country_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$this->render('product_country_add',array('country'=>$country));
	}
	
	/**编辑国家**/
	public function actionProduct_country_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$country= VcosCountry::model()->findByPk($id);
		if($_POST){
			$name = isset($_POST['name'])?$_POST['name']:'';
			$name_en = isset($_POST['name_en'])?$_POST['name_en']:'';
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'basic_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'basic_images/'.Yii::app()->params['month'].'/'.$photo;
			$state = isset($_POST['state'])?$_POST['state']:'0';
			//	var_dump($_POST);exit;
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$country->country_cn_name = $name;
				$country->country_en_name = $name_en;
				if($photo){
					$country->country_logo = $photo_url;
				}
				$country->status = $state;
				$country->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Basic/product_country_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		
		$this->render('product_country_edit',array('country'=>$country));
	}
	
	
	/**判断国家表中是否已经存在该国家*/
	public function actionCheckCountNameExits(){
		$this->setauth();//检查有无权限
		$id = isset($_GET['id'])?$_GET['id']:0;
		$name = isset($_GET['name'])?$_GET['name']:'';
		$ename = isset($_GET['ename'])?$_GET['ename']:'';
		if($id==0){
			$sql = "SELECT count(*) count FROM `vcos_country` WHERE country_cn_name='$name' OR country_en_name='$ename'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		}else{
			$sql = "SELECT count(*) count FROM `vcos_country` WHERE (country_cn_name='$name' OR country_en_name='$ename') AND country_id!='{$id}'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
			
		}
		if($count['count']>0){
			echo 1;
		}else{
			echo 0;
		}
		
	}
}