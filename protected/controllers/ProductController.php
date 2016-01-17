<?php
class ProductController extends Controller
{
	/**在售商品列表**/
	public function actionProduct_list(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			//将状态修改成2
			/*$count = VcosProduct::model()->deleteAll("product_id in($ids)");
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($ids)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($ids)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($ids) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($ids)");*/
			$sql = "UPDATE `vcos_product` SET is_rubbish=1 WHERE product_id in('$ids')";
			$count = $p_db->createCommand($sql)->execute();
			$sql = "DELETE FROM  `vcos_activity_product` WHERE product_id in('$ids') AND product_type=6";
			$p_db->createCommand($sql)->execute();
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			/*$count=VcosProduct::model()->deleteByPk($did);
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($did)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($did)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($did) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($did)");*/
			$sql = "UPDATE `vcos_product` SET is_rubbish=1 WHERE product_id in($did)";
			$count = $p_db->createCommand($sql)->execute();
			$sql = "DELETE FROM  `vcos_activity_product` WHERE product_id in($did) AND product_type=6";
			$p_db->createCommand($sql)->execute();
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$cat1_but='';
		$cat2_but='';
		$cat3_but='';
		if(isset($_GET['cat3_all_sel']) && $_GET['cat3_all_sel']!=''){
			$code_id = $_GET['cat3_all_sel'];
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code_id;
			$code1_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code1_sel['parent_cid'];
			$code2_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			
			$cat1_but = $code2_sel['parent_cid'];
			$cat2_but = $code1_sel['parent_cid'];
			$cat3_but = $code_id;
			
			$where = "a.category_code='".$code_id."'";
		}else{
			/*$sql = "select category_code from vcos_category where length(category_code) = 7 ORDER BY category_code limit 1";
			$code_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$code_id = $code_sel['category_code'];
			$code_id = 1;*/
			$where = 1;
		}
		$create_times = date("Y-m-d H:i:s",time());
		//WHERE a.category_code='".$code_id."'
		$count_sql = "SELECT count(*) count FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0  AND ".$where." AND a.sale_end_time > '".$create_times."' AND a.sale_start_time < '".$create_times."'
		ORDER BY a.shop_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		//WHERE a.category_code='".$code_id."'
		
		$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0  AND  ".$where." AND a.sale_end_time > '".$create_times."' AND a.sale_start_time < '".$create_times."'
		ORDER BY a.shop_id DESC LIMIT {$criteria->offset}, 10";
		//var_dump($sql);exit;
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();

		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if(!isset($_GET['cat3_all_sel'])){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_sel[0]['category_code'];
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_sel[0]['category_code'];
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else{
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		$this->render('product_list',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'pages'=>$pager,'auth'=>$this->auth,'product'=>$product));
	}
	
	/**待售商品列表**/
	public function actionProduct_wait_list(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			/*$count = VcosProduct::model()->deleteAll("product_id in($ids)");
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($ids)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($ids)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($ids) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($ids)");*/
			$sql = "UPDATE `vcos_product` SET is_rubbish=1 WHERE product_id in('$ids')";
			$count = $p_db->createCommand($sql)->execute();
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			/*$count=VcosProduct::model()->deleteByPk($did);
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($did)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($did)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($did) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($did)");*/
			$sql = "UPDATE `vcos_product` SET is_rubbish=1 WHERE product_id in($did)";
			$count = $p_db->createCommand($sql)->execute();
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$cat1_but='';
		$cat2_but='';
		$cat3_but='';
		if(isset($_GET['cat3_all_sel']) && $_GET['cat3_all_sel']!=''){
			$code_id = $_GET['cat3_all_sel'];
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code_id;
			$code1_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code1_sel['parent_cid'];
			$code2_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
				
			$cat1_but = $code2_sel['parent_cid'];
			$cat2_but = $code1_sel['parent_cid'];
			$cat3_but = $code_id;
				
			$where = "a.category_code='".$code_id."'";
		}else{
			/*$sql = "select category_code from vcos_category where length(category_code) = 7 ORDER BY category_code limit 1";
				$code_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
				$code_id = $code_sel['category_code'];
				$code_id = 1;*/
			$where = 1;
		}
		$create_times = date("Y-m-d H:i:s",time());
		//WHERE a.category_code='".$code_id."'
		$count_sql = "SELECT count(*) count FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0  AND  ".$where." AND (a.sale_start_time > '".$create_times."' OR (a.sale_start_time<'".$create_times."' AND a.sale_start_time<'".$create_times."'))
		ORDER BY a.shop_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		//WHERE a.category_code='".$code_id."'
		
		$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0  AND ".$where." AND (a.sale_start_time > '".$create_times."' OR (a.sale_start_time<'".$create_times."' AND a.sale_end_time < '".$create_times."' ))
		ORDER BY a.shop_id DESC LIMIT {$criteria->offset}, 10";
		//var_dump($sql);exit;
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
	
		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if(!isset($_GET['cat3_all_sel'])){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_sel[0]['category_code'];
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_sel[0]['category_code'];
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else{
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		$this->render('product_wait_list',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'pages'=>$pager,'auth'=>$this->auth,'product'=>$product));
	}
	
	/**商品添加**/
	public function actionProduct_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product = new VcosProduct();
		if($_POST){
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$code = isset($_POST['code'])?$_POST['code']:'';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$origin = isset($_POST['origin'])?$_POST['origin']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$num = isset($_POST['num'])?$_POST['num']:0;
			$price = isset($_POST['price'])?$_POST['price']*100:0;
			$mprice = isset($_POST['mprice'])?$_POST['mprice']*100:0;
			//$category = isset($_POST['category_3'])?$_POST['category_3']:0;
			$category = isset($_POST['category'])?$_POST['category']:0;
			$shop = isset($_POST['shop'])?$_POST['shop']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$create_times = date("Y/m/d H:i:s",time());
			if($_POST['sub_type'] == 1){
				$s_time = $_POST['time_up'] . ':00';
				$stime = date('Y/m/d H:i:s',strtotime($s_time));
				if($_POST['time_down'] != '' && isset($_POST['down'])){
				$e_time = $_POST['time_down'] . ':00';
				$etime = date('Y/m/d H:i:s',strtotime($e_time));
				}else{
					$etime = '';
				}
			}else{
				if($_POST['time_up'] != '' && isset($_POST['up'])){
					$s_time = $_POST['time_up'] . ':00';
					$stime = date('Y/m/d H:i:s',strtotime($s_time));
				}else{
					$stime = $create_times;
				}
				if($_POST['time_down'] != '' && isset($_POST['down'])){
					$e_time = $_POST['time_down'] . ':00';
					$etime = date('Y/m/d H:i:s',strtotime($e_time));
				}else{
					$etime = '';
				}
			}
			
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
			
			$cruise_id = Yii::app()->params['cruise_id'];
			$this_user_id = Yii::app()->user->id;
			$this_user_name = Yii::app()->user->name;
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product->product_code = $code;
				$product->product_name = $name;
				$product->origin = $origin;
				$product->product_desc = $desc;
				$product->product_img = $photo_url;
				$product->inventory_num = $num;
				$product->sale_price = $price;
				$product->standard_price = $mprice;
				$product->category_code = $category;
				$product->cruise_id = $cruise_id;
				$product->shop_id = $shop;
				$product->brand_id = $brand;
				if($stime != '')
				$product->sale_start_time = $stime;
				if($etime != '')
				$product->sale_end_time = $etime;
				$product->created = $create_times;
				$product->creator = $this_user_name;
				$product->creator_id = $this_user_id;
				$product->status = $state;
				$product->save();
				$inser_id =$product->attributes['product_id'];
				$transaction->commit();
				//Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
				Helper::show_message_querys(yii::t('vcos', '添加成功,是否继续添加商品图片？'),yii::t('vcos', '是否继续添加商品图文？'),Yii::app()->createUrl("Product/product_now_wait_list"),Yii::app()->createUrl("Product/product_edit",array('id'=>$inser_id,'action'=>'img')),Yii::app()->createUrl("Product/product_edit",array('id'=>$inser_id,'action'=>'graphic')));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$category = isset($_GET['category'])?empty($_GET['category'])?0:1:0;
		$shop = isset($_GET['shop'])?empty($_GET['shop'])?0:1:0;
		
		if($category == 1 && $shop == 1){
			$sql = "SELECT brand_id,brand_cn_name from `vcos_brand`";
			$brand = $p_db->createCommand($sql)->queryAll();
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop`";
			$shop_sel = $p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
			$layer_1 = $p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
			$layer_2 = $p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
			$layer_3 = $p_db->createCommand($sql)->queryAll();
			//店铺分类
			$sql = "SELECT * FROM `vcos_shop_category` WHERE shop_id=".$_GET['shop']." ORDER BY sort_order";
			$shop_cat = $p_db->createCommand($sql)->queryAll();
			$shop_cat = self::sortOut($shop_cat);
			$this->render('product_add',array('shop_cat'=>$shop_cat,'shop'=>$_GET['shop'],'category'=>$_GET['category'],'shop_sel'=>$shop_sel,'product'=>$product,'brand'=>$brand,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
		}else{
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_status=1 AND is_delete=0";
			$shop_sel = $p_db->createCommand($sql)->queryAll();
			
			
			$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=1 AND a.shop_id=".$shop_sel[0]['shop_id']." ORDER BY a.category_code";
			$cat1_sel = $p_db->createCommand($sql)->queryAll();
			if($cat1_sel){
			$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=2 AND a.shop_id=".$shop_sel[0]['shop_id']." ORDER BY a.category_code";
			$cat2_sel = $p_db->createCommand($sql)->queryAll();
			$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=3 AND a.shop_id=".$shop_sel[0]['shop_id']." ORDER BY a.category_code";
			$cat3_sel = $p_db->createCommand($sql)->queryAll();
			$cat1_but = $cat1_sel[0]['category_code'];
			$cat2_but = $cat2_sel[0]['category_code'];
			$cat3_but = $cat3_sel[0]['category_code'];
			}else{$cat1_but='';$cat2_but='';$cat3_but='';$cat2_sel='';$cat3_sel='';}
			$this->render('product_add_category',array('shop_sel'=>$shop_sel,'cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
		}
	}
	
	/**无限极分类**/
	static public function sortOut($list,$pid=0,$level=0){
		$tree = array();
		foreach($list as $v){
			if($v['parent_cid'] == $pid){
				$v['level'] = $level + 1;
				$tree[] = $v;
				$tree = array_merge($tree, self::sortOut($list,$v['shop_category_id'],$level+1));
			}
		}
		return $tree;
	}
	
	/**商品添加：改变店铺资质改变**/
	public function actionGetOperationCategory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		
		$shop_id = isset($_GET['shop_id'])?$_GET['shop_id']:0;
		$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=1 AND a.shop_id=".$shop_id." ORDER BY a.category_code";
		$cat1_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=2 AND a.shop_id=".$shop_id." ORDER BY a.category_code";
		$cat2_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT a.category_code,a.parent_catogory_code,b.name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE b.status=1 AND a.status=1 AND tree_type=3 AND a.shop_id=".$shop_id." ORDER BY a.category_code";
		$cat3_sel = $p_db->createCommand($sql)->queryAll();
		$cat1_but = empty($cat1_sel[0]['category_code'])?'':$cat1_sel[0]['category_code'];
		$cat2_but = empty($cat2_sel[0]['category_code'])?'':$cat2_sel[0]['category_code'];
		$cat3_but = empty($cat3_sel[0]['category_code'])?'':$cat3_sel[0]['category_code'];
		$arr = array();
		$arr[0] = $cat1_sel;
		$arr[1] = $cat2_sel;
		$arr[2] = $cat3_sel;
		$arr[3] = $cat1_but;
		$arr[4] = $cat2_but;
		$arr[5] = $cat3_but;
		if($cat1_sel){
			echo json_encode($arr);
		}else{
			echo 0;
		}
		
	}
	
	/**商品编辑**/
	public function actionProduct_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$product= VcosProduct::model()->findByPk($id);
		if($_POST){
			$shop_cat = isset($_POST['shop_cat'])?$_POST['shop_cat']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$code = isset($_POST['code'])?$_POST['code']:'';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$origin = isset($_POST['origin'])?$_POST['origin']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$num = isset($_POST['num'])?$_POST['num']:0;
			$price = isset($_POST['price'])?$_POST['price']*100:0;
			$mprice = isset($_POST['mprice'])?$_POST['mprice']*100:0;
			$category = isset($_POST['category_3'])?$_POST['category_3']:0;
			$shop = isset($_POST['shop'])?$_POST['shop']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$create_times = date("Y-m-d H:i:s",time());
			
			//$overdue == 0 :未过期  $overdue==1：已过期
			if($_POST['sub_type'] == 1){
				//保存且下架
				$s_time = $_POST['time_up'] . ':00';
				$stime = date('Y-m-d H:i:s',strtotime($s_time));
				if($_POST['time_down'] != '' && isset($_POST['down'])){
					$e_time = $_POST['time_down'] . ':00';
					$etime = date('Y-m-d H:i:s',strtotime($e_time));
				}else{
					$etime = '9999-12-31 23:59:59';
				}
			}else{
				//开始销售
				if($_POST['time_up'] != '' && isset($_POST['up'])){
					$s_time = $_POST['time_up'] . ':00';
					$stime = date('Y-m-d H:i:s',strtotime($s_time));
				}else{
					$stime = $create_times;
				}
				if($_POST['time_down'] != '' && isset($_POST['down'])){
					$e_time = $_POST['time_down'] . ':00';
					$etime = date('Y-m-d H:i:s',strtotime($e_time));
				}else{
					$etime = '9999-12-31 23:59:59';
				}
				
			}
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
			$create_times = date("Y-m-d H:i:s",time());
			$cruise_id = Yii::app()->params['cruise_id'];
			$this_user_id = Yii::app()->user->id;
			$this_user_name = Yii::app()->user->name;
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product->product_code = $code;
				$product->product_name = $name;
				$product->origin = $origin;
				$product->product_desc = $desc;
				//$product->product_img = $photo_url;
				$product->inventory_num = $num;
				$product->sale_price = $price;
				$product->standard_price = $mprice;
				$product->category_code = $category;
				$product->cruise_id = $cruise_id;
				$product->shop_id = $shop;
				$product->brand_id = $brand;
				if($stime != '')
				$product->sale_start_time = $stime;
				if($etime != '')
				$product->sale_end_time = $etime;
				//$product->created = $create_times;
				$product->creator = $this_user_name;
				$product->creator_id = $this_user_id;
				if($photo){
					$product->product_img = $photo_url;
				}
				$product->status = $state; 
				$product->save();
				/*if($stime<=$create_times && $etime>=$create_times){
					//将活动商品过期更改为未过期
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_type=6 AND product_id='{$id}'";
				}else{
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_type=6 AND product_id='{$id}'";
				}
				Yii::app()->p_db->createCommand($sql)->execute();*/
				
				//将店铺分类产品删除后新增
				//删除全部店铺分类产品
				$sql = "DELETE FROM `vcos_shop_category_product` WHERE product_id='{$id}'";
				Yii::app()->p_db->createCommand($sql)->execute();
				if($shop_cat!=''){
					foreach ($shop_cat as $row){
						$sql = "INSERT INTO `vcos_shop_category_product` (shop_category_id,product_id) VALUES ('{$row}','{$id}')";
						Yii::app()->p_db->createCommand($sql)->execute();
					}
				}
				
				//启用禁用判断栏目页面记录是否有效，时间日期判断，分别判断了栏目页面配置及页面详情配置
				if($state==0){
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$id}' AND product_type=6";
					Yii::app()->p_db->createCommand($sql)->execute();
				}else if($state==1){
					$sql = "SELECT activity_id FROM `vcos_navigation`";
					$activity_ids = Yii::app()->p_db->createCommand($sql)->queryAll();
					$activity_ids_str = array();
					foreach ($activity_ids as $k=>$row){
						$activity_ids_str[$k] = $row['activity_id'];
					}
					
					$sql = "SELECT * FROM `vcos_activity_product` WHERE product_id='{$id}' AND product_type=6";
					$activity_product_obj = Yii::app()->p_db->createCommand($sql)->queryAll();
					$sql = "SELECT sale_start_time,sale_end_time FROM `vcos_product` WHERE product_id='{$id}'";
					$this_product = Yii::app()->p_db->createCommand($sql)->queryRow();
					
					foreach ($activity_product_obj as $val){
						if(in_array($val['activity_id'], $activity_ids_str)){
							//只判断商品本身时间
							if($this_product['sale_start_time']<=$create_times && $this_product['sale_end_time']>=$create_times){
								$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
							}else{
								$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
							}
						}else{
							//判断页面详情时间再判断商品本身时间是否符合且页面详情时间是否在商品时间范围内
							if($val['start_show_time']<=$create_times && $val['end_show_time']>=$create_times){
								if($this_product['sale_start_time']<=$create_times && $this_product['sale_end_time']>=$create_times){
									if($val['start_show_time']>=$this_product['sale_start_time'] && $val['end_show_time']<=$this_product['sale_end_time']){
										$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
									}else{
										$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
									}
								}else{
									$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
								}
							}else{
								$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE activity_id='{$val['activity_id']}' AND product_id='{$id}' AND product_type=6";
							}
						}
						
						Yii::app()->p_db->createCommand($sql)->execute();
					}
					
				}
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_now_wait_list"));
				
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$category_code = $product['category_code'];
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE status=1 AND category_code =".$category_code;
		$layer_cat_2 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE  status=1 AND category_code =".$layer_cat_2['parent_cid'];
		$layer_cat_1 = $p_db->createCommand($sql)->queryRow();
		
		$sql = "SELECT brand_id,brand_cn_name from `vcos_brand`";
		$brand = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category`  WHERE  status=1 AND parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE  status=1 AND parent_cid=".$layer_cat_1['parent_cid'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE  status=1 AND parent_cid=".$layer_cat_2['parent_cid'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT shop_id,shop_title FROM `vcos_shop`";
		$shop = $p_db->createCommand($sql)->queryAll();
		
		$sql = "SELECT a.*,b.product_name FROM `vcos_product_img` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE b.product_id = ".$id." ORDER BY sort_order";
		$product_img = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$sql = "SELECT a.*,b.product_name FROM `vcos_product_graphic` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE b.product_id = ".$id." ORDER BY sort_order";
		$product_graphic = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		//店铺分类
		$sql = "SELECT * FROM `vcos_shop_category` WHERE shop_id=".$product['shop_id']." ORDER BY sort_order";
		$shop_cat = $p_db->createCommand($sql)->queryAll();
		$shop_cat = self::sortOut($shop_cat);
		
		//获取已经选中的店铺分类产品
		$sql = "SELECT shop_category_id FROM `vcos_shop_category_product` WHERE product_id='{$id}'";
		$already_shop_category = $p_db->createCommand($sql)->queryAll();
		$this->render('product_edit',array('already_shop_category'=>$already_shop_category,'shop_cat'=>$shop_cat,'product_graphic'=>$product_graphic,'product_img'=>$product_img,'shop'=>$shop,'product'=>$product,'layer_cat'=>$layer_cat_1['parent_cid'],'layer_cat2'=>$layer_cat_2['parent_cid'],'brand'=>$brand,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	}
	
	
	/**验证商品编码是否唯一***/
	public function actionCheckProductCode(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_id = isset($_GET['product_id'])?trim($_GET['product_id']):0;
		$code = isset($_GET['code'])?trim($_GET['code']):0;
		if($product_id==0){
			$sql = "SELECT count(*) count FROM `vcos_product` WHERE product_code='{$code}'";
		}else{
			$sql = "SELECT count(*) count FROM `vcos_product` WHERE product_code='{$code}' AND product_id!='{$product_id}'";
		}
		$count = $p_db->createCommand($sql)->queryRow();
		if($count['count']>0){
			echo 0;
		}else{
			echo 1;
		}
		
	}
	
	
	//店铺改变，店铺分类改变
	public function actionChangeShopGetShopCategory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = isset($_GET['shop'])?$_GET['shop']:0;
		$shop_cat = '';
		if($shop!=0){
			$sql = "SELECT * FROM `vcos_shop_category` WHERE shop_id=".$shop." ORDER BY sort_order";
			$shop_cat = $p_db->createCommand($sql)->queryAll();
			$shop_cat = self::sortOut($shop_cat);
		}
		if($shop_cat){
			echo json_encode($shop_cat);
		}else{
			echo 0;
		}
		
	}
	
	//商品编辑页面内图片保存和修改
	public function actionProduct_edit_img_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_img = new VcosProductImg();
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			$img_name = isset($_POST['img_name'])?$_POST['img_name']:'';
			$img_id = isset($_POST['img_id'])?$_POST['img_id']:0;
			if($img_id == 0 || $img_id ==''){
				if($img_name != ''){
				$photo='';
				if($_FILES[$img_name]['error']!=4){
					$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
					$photo=$result['filename'];
				}
				$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
				}
				
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$product_img->product_id = $product;
					$product_img->img_url = $photo_url;
					$product_img->sort_order = $sort;
					$product_img->save();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_edit",array('id'=>$product,'action'=>'img')));
			
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '添加失败。'), '#');
				}
			}else{
				//修改
				if($img_name != ''){
					$photo='';
					if($_FILES[$img_name]['error']!=4){
						$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
						$photo=$result['filename'];
					}
					$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
				}
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$sql = "UPDATE `vcos_product_img` SET img_url='{$photo_url}' WHERE product_id='{$product}' AND product_img_id='{$img_id}'";
					Yii::app()->p_db->createCommand($sql)->execute();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_edit",array('id'=>$product,'action'=>'img')));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '修改失败。'), '#');
				}
			}
		}
		
	}	
	
	
	//商品图文保存和修改
	public function actionProduct_edit_graphic_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_graphic = new VcosProductGraphic();
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			$img_name = isset($_POST['img_name'])?$_POST['img_name']:'';
			$img_id = isset($_POST['img_id'])?$_POST['img_id']:0;
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			if($img_id == 0 || $img_id ==''){
				if($img_name != ''){
					$photo='';
					if($_FILES[$img_name]['error']!=4){
						$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
						$photo=$result['filename'];
					}
					$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
				}
	
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					$product_graphic->product_id = $product;
					$product_graphic->img_url = $photo_url;
					$product_graphic->sort_order = $sort;
					$product_graphic->graphic_desc = $desc;
					$product_graphic->save();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_edit",array('id'=>$product,'action'=>'graphic')));
						
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '添加失败。'), '#');
				}
			}else{
				//修改
				if($img_name != ''){
					$photo='';
					if($_FILES[$img_name]['error']!=4){
						$result=Helper::upload_file($img_name, Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
						$photo=$result['filename'];
					}
					$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
				}
				//事务处理
				$transaction=$p_db->beginTransaction();
				try{
					if($photo==''){
						$sql = "UPDATE `vcos_product_graphic` SET graphic_desc='{$desc}' WHERE product_id='{$product}' AND id='{$img_id}'";
					}else{
						$sql = "UPDATE `vcos_product_graphic` SET img_url='{$photo_url}',graphic_desc='{$desc}' WHERE product_id='{$product}' AND id='{$img_id}'";
					}
					Yii::app()->p_db->createCommand($sql)->execute();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_edit",array('id'=>$product,'action'=>'graphic')));
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message(yii::t('vcos', '修改失败。'), '#');
				}
			}
		}
	
	}
	
	
	
	//通过商品id获取该商品的最大排序，0：代表商品图片；1：代表商品图文
	public function actionProductGetMaxSort(){
		$this->setauth();//检查有无权限
		$product = isset($_GET['product'])?$_GET['product']:0;
		$act = isset($_GET['act'])?$_GET['act']:'';
		$result = '';
		if($product != 0){
			if($act == 0){
				$sql = "SELECT sort_order FROM `vcos_product_img` WHERE product_id=".$product." ORDER BY sort_order DESC LIMIT 1";
				$result = Yii::app()->p_db->createCommand($sql)->queryRow();
			}else if($act == 1){
				$sql = "SELECT sort_order FROM `vcos_product_graphic` WHERE product_id=".$product." ORDER BY sort_order DESC LIMIT 1";
				$result = Yii::app()->p_db->createCommand($sql)->queryRow();
			}
		}
		if($result){
			echo $result['sort_order'];
		}else{
			echo '';
		}
	}
	
	//商品编辑内商品图片和商品图文删除,1:商品图片，2、：商品图文
	public function actionProductDelMore(){
		$this->setauth();//检查有无权限
		$ids = isset($_POST['ids'])?$_POST['ids']:'';
		$act = isset($_POST['act'])?$_POST['act']:'';
		
		$res = '';
		if($act == 1){
			if($ids !=''){
				$sql= "DELETE FROM `vcos_product_img` WHERE product_img_id in('$ids')";
				$res  = Yii::app()->p_db->createCommand($sql)->execute();
			}
		}else if($act == 2){
			if($ids !=''){
				$sql= "DELETE FROM `vcos_product_graphic` WHERE id in('$ids')";
				$res  = Yii::app()->p_db->createCommand($sql)->execute();
			}
		}
		
		if($res){
			echo 1;
		}else{
			echo 0;
		}
	
	}
	
	
	//商品图片修改排序,1:置顶，2上移，3，置底，4下移
	public function actionUpdateProductImgSort(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$act = isset($_POST['act'])?$_POST['act']:0;
		$product = isset($_POST['product'])?$_POST['product']:0;
		$img_id = isset($_POST['id'])?$_POST['id']:0;
		if($act == 1){
			$sql = "UPDATE `vcos_product_img` SET sort_order=sort_order+1 WHERE product_id='{$product}' AND product_img_id!='{$img_id}'";
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_img` SET sort_order=1 WHERE product_id='{$product}' AND product_img_id='{$img_id}'";
			$p_db->createCommand($sql)->execute();
		}else if($act == 2){
			$sql = "SELECT product_img_id,sort_order FROM `vcos_product_img` WHERE product_id='{$product}' AND sort_order <= (SELECT sort_order FROM `vcos_product_img` WHERE  product_id='{$product}' AND product_img_id='{$img_id}') ORDER BY sort_order DESC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_product_img` SET sort_order='{$sort[0]["sort_order"]}' WHERE product_img_id='{$sort[1]["product_img_id"]}'";
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_img` SET sort_order='{$sort[1]["sort_order"]}' WHERE product_img_id='{$sort[0]["product_img_id"]}'";
			$p_db->createCommand($sql)->execute();
		}else if($act == 3){
			$sql = "SELECT sort_order FROM `vcos_product_img` WHERE product_id='{$product}' ORDER BY sort_order DESC LIMIT 1";
			$sort = $p_db->createCommand($sql)->queryRow();
			$sort = $sort['sort_order']+1;
			$sql = "UPDATE `vcos_product_img` SET sort_order='{$sort}' WHERE product_id='{$product}' AND product_img_id='{$img_id}'";
			$p_db->createCommand($sql)->execute();
			//$sql = "UPDATE `vcos_product_img` SET sort_order=sort_order-1 WHERE product_id='{$product}'  AND product_img_id !='{$img_id}'";
			//$p_db->createCommand($sql)->execute();
		}else if($act == 4){
			$sql = "SELECT product_img_id,sort_order FROM `vcos_product_img` WHERE product_id='{$product}' AND sort_order >= (SELECT sort_order FROM `vcos_product_img` WHERE product_id='{$product}'  AND product_img_id='{$img_id}') ORDER BY sort_order ASC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_product_img` SET sort_order='{$sort[0]["sort_order"]}' WHERE product_img_id=".$sort[1]["product_img_id"];
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_img` SET sort_order='{$sort[1]["sort_order"]}' WHERE product_img_id=".$sort[0]["product_img_id"];
			$p_db->createCommand($sql)->execute();
		}
		
		
	}
	
	
	//商品图文修改排序,1:置顶，2上移，3，置底，4下移
	public function actionUpdateProductGraphicSort(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$act = isset($_POST['act'])?$_POST['act']:0;
		$product = isset($_POST['product'])?$_POST['product']:0;
		$img_id = isset($_POST['id'])?$_POST['id']:0;
		if($act == 1){
			$sql = "UPDATE `vcos_product_graphic` SET sort_order=sort_order+1 WHERE product_id='{$product}' AND id!='{$img_id}'";
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_graphic` SET sort_order=1 WHERE product_id='{$product}' AND id='{$img_id}'";
			$p_db->createCommand($sql)->execute();
		}else if($act == 2){
			$sql = "SELECT id,sort_order FROM `vcos_product_graphic` WHERE product_id='{$product}' AND sort_order <= (SELECT sort_order FROM `vcos_product_graphic` WHERE  product_id='{$product}' AND id='{$img_id}') ORDER BY sort_order DESC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_product_graphic` SET sort_order='{$sort[0]["sort_order"]}' WHERE id='{$sort[1]["id"]}'";
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_graphic` SET sort_order='{$sort[1]["sort_order"]}' WHERE id='{$sort[0]["id"]}'";
			$p_db->createCommand($sql)->execute();
		}else if($act == 3){
			$sql = "SELECT sort_order FROM `vcos_product_graphic` WHERE product_id='{$product}' ORDER BY sort_order DESC LIMIT 1";
			$sort = $p_db->createCommand($sql)->queryRow();
			$sort = $sort['sort_order']+1;
			$sql = "UPDATE `vcos_product_graphic` SET sort_order='{$sort}' WHERE product_id='{$product}' AND id='{$img_id}'";
			$p_db->createCommand($sql)->execute();
			//$sql = "UPDATE `vcos_product_graphic` SET sort_order=sort_order-1 WHERE product_id='{$product}'  AND id !='{$img_id}'";
			//$p_db->createCommand($sql)->execute();
		}else if($act == 4){
			$sql = "SELECT id,sort_order FROM `vcos_product_graphic` WHERE product_id='{$product}' AND sort_order >= (SELECT sort_order FROM `vcos_product_graphic` WHERE product_id='{$product}'  AND id='{$img_id}') ORDER BY sort_order ASC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_product_graphic` SET sort_order='{$sort[0]["sort_order"]}' WHERE id=".$sort[1]["id"];
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_product_graphic` SET sort_order='{$sort[1]["sort_order"]}' WHERE id=".$sort[0]["id"];
			$p_db->createCommand($sql)->execute();
		}
	
	
	}
	
	/**商品：获取二级分类**/
	/*public function actionGetCategoryChild(){
		$p_db = Yii::app()->p_db;
		$parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$parent_code;
		$resutl = $p_db->createCommand($sql)->queryAll();
		if($resutl){
			echo json_encode($resutl);
		}  else {
			echo 0;
		}
	}*/
	
	/**商品详情列表**/
	public function actionProduct_detail_list(){
		$this->setauth();//检查有无权限
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosProductDetail::model()->deleteAll("product_detail_id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_detail_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosProductDetail::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_detail_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$cat1_but='';
		$cat2_but='';
		$cat3_but='';
		if(isset($_GET['cat3_all_sel']) && $_GET['cat3_all_sel']!=''){
			$code_id = $_GET['cat3_all_sel'];
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code_id;
			$code1_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code1_sel['parent_cid'];
			$code2_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
				
			$cat1_but = $code2_sel['parent_cid'];
			$cat2_but = $code1_sel['parent_cid'];
			$cat3_but = $code_id;
				
			$where = "b.category_code='".$code_id."'";
		}else{
			/*$sql = "select category_code from vcos_category where length(category_code) = 7 ORDER BY category_code limit 1";
			 $code_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			 $code_id = $code_sel['category_code'];
			 $code_id = 1;*/
			$where = 1;
		}
		$count_sql = "SELECT count(*) count FROM `vcos_product_detail` a
		LEFT JOIN `vcos_product` b ON a.product_id = b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.product_id,b.product_name FROM `vcos_product_detail` a
		LEFT JOIN `vcos_product` b ON a.product_id = b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC LIMIT {$criteria->offset}, 10";
		$product_detail = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
	
		if(!isset($_GET['cat3_all_sel'])){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_sel[0]['category_code'];
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_sel[0]['category_code'];
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else{
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		
		$this->render('product_detail_list',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'pages'=>$pager,'auth'=>$this->auth,'product_detail'=>$product_detail));
	}
	
	
	
	/**添加商品详情***/
	public function actionProduct_detail_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_detail = new VcosProductDetail();
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			//匹配替换编辑器中图片路径
			$img_ueditor = Yii::app()->params['img_ueditor_php'];
			$text = $_POST['describe_text'];
			$describe_text = preg_replace($img_ueditor,'',$text);
			$photo = $_POST['describe_photo'];
			$describe_photo = preg_replace($img_ueditor,'',$photo);

			//处理事务
			$db = Yii::app()->m_db;
			$transaction=$db->beginTransaction();
			try{
				$product_detail->product_id = $product;
				$product_detail->text_detail = $describe_text;
				$product_detail->graphic_detail = $describe_photo;
				$product_detail->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_detail_list"));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code'];
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$this->render('product_detail_add',array('product'=>$product,'product_detail'=>$product_detail,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	}
	
	/**编辑商品详情**/
	public function actionProduct_detail_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$product_detail= VcosProductDetail::model()->findByPk($id);
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			//匹配替换编辑器中图片路径
			$img_ueditor = Yii::app()->params['img_ueditor_php'];
			$text = $_POST['describe_text'];
			$describe_text = preg_replace($img_ueditor,'',$text);
			$photo = $_POST['describe_photo'];
			$describe_photo = preg_replace($img_ueditor,'',$photo);
				
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_detail->product_id = $product;
				$product_detail->text_detail = $describe_text;
				$product_detail->graphic_detail = $describe_photo;
				$product_detail->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_detail_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT category_code FROM `vcos_product` WHERE product_id=".$product_detail['product_id'];
		$category_code = Yii::app()->p_db->createCommand($sql)->queryRow();
		$category_code = $category_code['category_code'];
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$category_code;
		$layer_cat_2 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$layer_cat_2['parent_cid'];
		$layer_cat_1 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_1['parent_cid'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_2['parent_cid'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$category_code;
		$product = $p_db->createCommand($sql)->queryAll();
		$layer_cat = $layer_cat_1['parent_cid'];
		$layer_cat2 = $layer_cat_2['parent_cid'];
		$this->render('product_detail_edit',array('product_detail'=>$product_detail,'product'=>$product,'layer_cat'=>$layer_cat,'layer_cat2'=>$layer_cat2,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3,'category_code'=>$category_code));
	}
	
	
	/**商品图片列表**/
	public function actionProduct_img_list(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		//批量删除
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosProductImg::model()->deleteAll("product_img_id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_img_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosProductImg::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_img_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$cat1_but='';
		$cat2_but='';
		$cat3_but='';
		if(isset($_GET['cat3_all_sel']) && $_GET['cat3_all_sel']!=''){
			$code_id = $_GET['cat3_all_sel'];
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code_id;
			$code1_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code1_sel['parent_cid'];
			$code2_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
		
			$cat1_but = $code2_sel['parent_cid'];
			$cat2_but = $code1_sel['parent_cid'];
			$cat3_but = $code_id;
		
			$where = "b.category_code='".$code_id."'";
		}else{
			/*$sql = "select category_code from vcos_category where length(category_code) = 7 ORDER BY category_code limit 1";
			 $code_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			 $code_id = $code_sel['category_code'];
			 $code_id = 1;*/
			$where = 1;
		}
		$count_sql = "SELECT count(*) count FROM `vcos_product_img` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.product_name FROM `vcos_product_img` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC LIMIT {$criteria->offset}, 10";
		$product_img = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if(!isset($_GET['cat3_all_sel'])){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_sel[0]['category_code'];
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_sel[0]['category_code'];
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else{
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		//渲染页面
		$this->render('product_img_list',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'pages'=>$pager,'auth'=>$this->auth,'product_img'=>$product_img));
	}
	
	/**商品图片添加**/
	public function actionProduct_img_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_img = new VcosProductImg();
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			//$img_name = isset($_POST['img_name'])?$_POST['img_name']:'photo';
			//if($img_name != ''){
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
			//}
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_img->product_id = $product;
				$product_img->img_url = $photo_url;
				$product_img->sort_order = $sort;
				$product_img->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_edit",array('id'=>$product)));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code'];
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('product_img_add',array('product'=>$product,'product_img'=>$product_img,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	}
	
	/**商品图片编辑**/
	public function actionProduct_img_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$product_img= VcosProductImg::model()->findByPk($id);
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_img->product_id = $product;
				if($photo){
					$product_img->img_url = $photo_url;
				}
				$product_img->sort_order = $sort;
				$product_img->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_img_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT category_code FROM `vcos_product` WHERE product_id=".$product_img['product_id'];
		$category_code = Yii::app()->p_db->createCommand($sql)->queryRow();
		$category_code = $category_code['category_code'];
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$category_code;
		$layer_cat_2 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$layer_cat_2['parent_cid'];
		$layer_cat_1 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_1['parent_cid'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_2['parent_cid'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$category_code;
		$product = $p_db->createCommand($sql)->queryAll();
		$layer_cat = $layer_cat_1['parent_cid'];
		$layer_cat2 = $layer_cat_2['parent_cid'];
		$this->render('product_img_edit',array('product_img'=>$product_img,'product'=>$product,'layer_cat'=>$layer_cat,'layer_cat2'=>$layer_cat2,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3,'category_code'=>$category_code));
	}
	
	
	/**商品图文列表**/
	public function actionProduct_graphic_list(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		//批量删除
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosProductGraphic::model()->deleteAll("id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_graphic_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosProductGraphic::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_graphic_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$cat1_but='';
		$cat2_but='';
		$cat3_but='';
		if(isset($_GET['cat3_all_sel']) && $_GET['cat3_all_sel']!=''){
			$code_id = $_GET['cat3_all_sel'];
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code_id;
			$code1_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code=".$code1_sel['parent_cid'];
			$code2_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
		
			$cat1_but = $code2_sel['parent_cid'];
			$cat2_but = $code1_sel['parent_cid'];
			$cat3_but = $code_id;
		
			$where = "b.category_code='".$code_id."'";
		}else{
			/*$sql = "select category_code from vcos_category where length(category_code) = 7 ORDER BY category_code limit 1";
			 $code_sel = Yii::app()->p_db->createCommand($sql)->queryRow();
			 $code_id = $code_sel['category_code'];
			 $code_id = 1;*/
			$where = 1;
		}
		$count_sql = "SELECT count(*) count FROM `vcos_product_graphic` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.product_name FROM `vcos_product_graphic` a
		LEFT JOIN `vcos_product` b ON a.product_id=b.product_id
		WHERE ".$where."
		ORDER BY a.product_id DESC LIMIT {$criteria->offset}, 10";
		$product_graphic = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if(!isset($_GET['cat3_all_sel'])){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_sel[0]['category_code'];
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_sel[0]['category_code'];
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else{
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$cat2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		//渲染页面
		$this->render('product_graphic_list',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'cat3_but'=>$cat3_but,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel,'pages'=>$pager,'auth'=>$this->auth,'product_graphic'=>$product_graphic));	
	}
	
	/**商品图文添加**/
	public function actionProduct_graphic_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$product_graphic = new VcosProductGraphic();
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
				
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_graphic->product_id = $product;
				$product_graphic->img_url = $photo_url;
				if($desc != ''){
				$product_graphic->graphic_desc = $desc;
				}
				$product_graphic->sort_order = $sort;
				$product_graphic->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Product/product_graphic_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code'];
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('product_graphic_add',array('product'=>$product,'product_graphic'=>$product_graphic,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	}
	
	/**商品图文编辑**/
	public function actionProduct_graphic_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$product_graphic= VcosProductGraphic::model()->findByPk($id);
		if($_POST){
			$product = isset($_POST['product'])?$_POST['product']:0;
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'product_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'product_images/'.Yii::app()->params['month'].'/'.$photo;
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$product_graphic->product_id = $product;
				if($desc != ''){
				$product_graphic->graphic_desc = $desc;
				}
				if($photo){
					$product_graphic->img_url = $photo_url;
				}
				$product_graphic->sort_order = $sort;
				$product_graphic->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Product/product_graphic_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT category_code FROM `vcos_product` WHERE product_id=".$product_graphic['product_id'];
		$category_code = Yii::app()->p_db->createCommand($sql)->queryRow();
		$category_code = $category_code['category_code'];
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$category_code;
		$layer_cat_2 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$layer_cat_2['parent_cid'];
		$layer_cat_1 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_1['parent_cid'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_2['parent_cid'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$category_code;
		$product = $p_db->createCommand($sql)->queryAll();
		$layer_cat = $layer_cat_1['parent_cid'];
		$layer_cat2 = $layer_cat_2['parent_cid'];
		$this->render('product_graphic_edit',array('product_graphic'=>$product_graphic,'product'=>$product,'layer_cat'=>$layer_cat,'layer_cat2'=>$layer_cat2,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3,'category_code'=>$category_code));
	}
	
	/**活动商品：获取二级分类**/
	public function actionGetCategoryChild(){
		
		$p_db = Yii::app()->p_db;
		$parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE status=1 AND parent_cid=".$parent_code;
		$resutl = $p_db->createCommand($sql)->queryAll();
		if($resutl){
			echo json_encode($resutl);
		}  else {
			echo 0;
		}
	}
	
	/**活动商品，三级分类下的商品**/
	public function actionGetCategoryProduct(){
		$p_db = Yii::app()->p_db;
		$parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$parent_code;
		$resutl = $p_db->createCommand($sql)->queryAll();
		if($resutl){
			echo json_encode($resutl);
		}  else {
			echo 0;
		}
	}
	
	
	/**在售商品和待售商品合并页面**/
	public function actionProduct_now_wait_list(){
		$this->setauth();//检查有无权限
		//$pag=1;$pag_wait=1;$pag_old=1;
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*10:0;
		$pag_wait = isset($_GET['pag_wait'])?$_GET['pag_wait']==1?0:($_GET['pag_wait']-1)*10:0;
		$pag_old = isset($_GET['pag_old'])?$_GET['pag_old']==1?0:($_GET['pag_old']-1)*10:0;
		$create_times = date("Y-m-d H:i:s",time());
		/*
			if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosProduct::model()->deleteAll("product_id in($ids)");
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($ids)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($ids)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($ids) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($ids)");
			if ($count>0){
			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_list"));
			}else{
			Helper::show_message(yii::t('vcos', '删除失败。'));
			}
			}
			if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosProduct::model()->deleteByPk($did);
			$count1 = VcosProductDetail::model()->deleteAll("product_id in($did)");
			$count2 = VcosProductImg::model()->deleteAll("product_id in($did)");
			//$count3 = VcosActivityProduct::model()->deleteAll("product_id in($did) AND product_type=6");
			$count4 = VcosProductGraphic::model()->deleteAll("product_id in($did)");
			if ($count>0){
			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Product/product_list"));
			}else{
			Helper::show_message(yii::t('vcos', '删除失败。'));
			}
			}*/
		
		/**分类筛选**/
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE status=1 AND parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/**在售**/
		
		$count_sql = "SELECT count(*) count FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0 AND a.sale_end_time >= '".$create_times."' AND a.sale_start_time <= '".$create_times."'
		ORDER BY a.shop_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$count = (int)ceil($count['count']/10);
		
		$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0 AND a.sale_end_time >= '".$create_times."' AND a.sale_start_time <= '".$create_times."'
		ORDER BY a.shop_id DESC LIMIT {$pag}, 10";
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/*待售**/
		
		$count_sql = "SELECT count(*) count FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0   AND (a.sale_start_time > '".$create_times."' 
		OR (a.sale_start_time<'".$create_times."' AND a.sale_end_time < '".$create_times."' ))
		ORDER BY a.shop_id DESC";
		$count_wait = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$count_wait = $count_wait['count'];
		$count_wait = (int)ceil($count_wait/10);
		
		$sql = "SELECT a.category_code,a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=0  AND (a.sale_start_time > '".$create_times."' OR (a.sale_start_time<'".$create_times."' AND a.sale_end_time < '".$create_times."' ))
		ORDER BY a.shop_id DESC LIMIT {$pag_wait}, 10";
		$product_wait = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		/**回收站**/
		$count_sql = "SELECT count(*) count FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=1 
		ORDER BY a.shop_id DESC";
		$count_old = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$count_old = $count_old['count'];
		$count_old = (int)ceil($count_old/10);
		
		$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		RIGHT JOIN (select * from `vcos_category` where status=1) d ON a.category_code = d.category_code
		WHERE a.is_rubbish=1 
		ORDER BY a.shop_id DESC LIMIT {$pag_old}, 10";
		$product_old = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$this->render('product_now_wait_list',array('now_page_num'=>1,'wait_page_num'=>1,'old_page_num'=>1,'count'=>$count,'count_wait'=>$count_wait,'count_old'=>$count_old,'auth'=>$this->auth,'product'=>$product,'cat1_sel'=>$cat1_sel,'product_wait'=>$product_wait,'product_old'=>$product_old));
	}
	
	/**商品分页获取**/
	public function actionGetProductPage(){
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*10:0;
		$pag_wait = isset($_GET['pag_wait'])?$_GET['pag_wait']==1?0:($_GET['pag_wait']-1)*10:0;
		$pag_old = isset($_GET['pag_old'])?$_GET['pag_old']==1?0:($_GET['pag_old']-1)*10:0;
		$create_times = date("Y-m-d H:i:s",time());
		if(isset($_GET['pag'])){
			$all_one = isset($_GET['all_one'])?trim($_GET['all_one']):0;
			$all_two = isset($_GET['all_two'])?trim($_GET['all_two']):0;
			$all_three = isset($_GET['all_three'])?trim($_GET['all_three']):0;

			if($all_one==0){
				$where = 1;
			}else if($all_one!=0&&$all_two==0){
				$where = "a.category_code like '{$all_one}%'";
			}else if($all_one!=0&&$all_two!=0&&$all_three==0){
				$where = "a.category_code like '{$all_two}%'";
			}else{
				$where = "a.category_code = '{$all_three}'";
			}
			$sql = "SELECT count(*) count FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=0  AND  ".$where." AND a.sale_end_time >= '".$create_times."' AND a.sale_start_time <= '".$create_times."'
			ORDER BY a.shop_id DESC";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
			$count = $count['count'];
			$count = (int)ceil($count/10);
			
			$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=0  AND  ".$where." AND a.sale_end_time >= '".$create_times."' AND a.sale_start_time <= '".$create_times."'
			ORDER BY a.shop_id DESC LIMIT {$pag}, 10";
			$product = Yii::app()->p_db->createCommand($sql)->queryAll();
			if($product){
				$data_all = array();
				$data_all['count'] = $count;
				$data_all['data'] = $product;
				echo json_encode($data_all);
			}  else {
				echo 0;
			}
		}else if(isset($_GET['pag_wait'])){
			
			$wait_one = isset($_GET['wait_one'])?trim($_GET['wait_one']):0;
			$wait_two = isset($_GET['wait_two'])?trim($_GET['wait_two']):0;
			$wait_three = isset($_GET['wait_three'])?trim($_GET['wait_three']):0;
			
			if($wait_one==0){
				$where_wait = 1;
			}else if($wait_one!=0&&$wait_two==0){
				$where_wait = "a.category_code like '{$wait_one}%'";
			}else if($wait_one!=0&&$wait_two!=0&&$wait_three==0){
				$where_wait = "a.category_code like '{$wait_two}%'";
			}else{
				$where_wait = "a.category_code = '{$wait_three}'";
			}
			
			$sql = "SELECT count(*) count FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=0  AND  ".$where_wait." AND (a.sale_start_time > '".$create_times."' OR (a.sale_start_time<'".$create_times."' AND a.sale_end_time < '".$create_times."' ))
			ORDER BY a.shop_id DESC";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
			$count = $count['count'];
			$count = (int)ceil($count/10);
			
			$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=0  AND  ".$where_wait." AND (a.sale_start_time > '".$create_times."' OR (a.sale_start_time<'".$create_times."' AND a.sale_end_time < '".$create_times."' ))
			ORDER BY a.shop_id DESC LIMIT {$pag_wait}, 10";
			$product_wait = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			if($product_wait){
				$data_all = array();
				$data_all['count'] = $count;
				$data_all['data'] = $product_wait;
				echo json_encode($data_all);
			}  else {
				echo 0;
			}
		}else if(isset($_GET['pag_old'])){
			$old_one = isset($_GET['old_one'])?trim($_GET['old_one']):0;
			$old_two = isset($_GET['old_two'])?trim($_GET['old_two']):0;
			$old_three = isset($_GET['old_three'])?trim($_GET['old_three']):0;
			
			if($old_one==0){
				$where_old = 1;
			}else if($old_one!=0&&$old_two==0){
				$where_old = "a.category_code like '{$old_one}%'";
			}else if($old_one!=0&&$old_two!=0&&$old_three==0){
				$where_old = "a.category_code like '{$old_two}%'";
			}else{
				$where_old = "a.category_code = '{$old_three}%'";
			}
			
			$sql = "SELECT count(*) count FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=1 AND  ".$where_old."
			ORDER BY a.shop_id DESC";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
			$count = $count['count'];
			$count = (int)ceil($count/10);
				
			$sql = "SELECT a.status,a.product_id,a.sale_end_time,a.product_name,a.origin,a.product_code,a.sale_start_time,a.product_img,b.shop_title,c.brand_cn_name,d.name FROM `vcos_product` a
			LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
			LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
			LEFT JOIN `vcos_category` d ON a.category_code = d.category_code
			WHERE a.is_rubbish=1 AND  ".$where_old."
			ORDER BY a.shop_id DESC LIMIT {$pag_old}, 10";
			
			$product_old = Yii::app()->p_db->createCommand($sql)->queryAll();
			
			if($product_old){
				$data_all = array();
				$data_all['count'] = $count;
				$data_all['data'] = $product_old;
				echo json_encode($data_all);
			}  else {
				echo 0;
			}
		}
		
	}
	
	
	/**商品批量下架**/
	public function actionProductOverdue(){
		$this->setauth();//检查有无权限
		$ids = isset($_POST['ids'])?$_POST['ids']:'';
		$old_times = date("Y-m-d H:i:s",time()-1);
		$sql = "UPDATE `vcos_product` SET sale_end_time='{$old_times}',sale_start_time='{$old_times}' WHERE product_id in($ids)";
		$res = Yii::app()->p_db->createCommand($sql)->execute();
		
		//商品批量下架删除活动商品记录
		//$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id in ($ids) AND product_type=6";
		//Yii::app()->p_db->createCommand($sql)->execute();
		$sql = "DELETE FROM `vcos_activity_product` WHERE product_id in ($ids) AND product_type=6";
		Yii::app()->p_db->createCommand($sql)->execute();
		if($res>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	
	/**商品批量上架**/
	public function actionProductShelves(){
		$this->setauth();//检查有无权限
		$ids = isset($_POST['ids'])?$_POST['ids']:'';
		$times = date("Y-m-d H:i:s",time());
		//$new_times = date("Y-m-d H:i:s",strtotime("+1 year"));
		
		$sql = "UPDATE `vcos_product` SET sale_end_time='9999-12-31 23:59:59',sale_start_time='{$times}' WHERE product_id in($ids)";
		$res = Yii::app()->p_db->createCommand($sql)->execute();
		
		$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_type=6 AND product_id in ($ids)";
		Yii::app()->p_db->createCommand($sql)->execute();
		if($res>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	/**商品批量恢复**/
	public function actionProductRecovery(){
		$this->setauth();//检查有无权限
		$ids = isset($_POST['ids'])?$_POST['ids']:'';
		$sql = "UPDATE `vcos_product` SET is_rubbish=0 WHERE product_id in($ids)";
		$res = Yii::app()->p_db->createCommand($sql)->execute();
		if($res>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	
	/**商品库存页面**/
	public function actionProduct_inventory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$where = '';
		$code_but = '';
		$min_but = '';
		$max_but = '';
		$type_but = '';
		$category_but = '';
		$category1_but = '';
		$category2_but = '';
		$cat1_sel = '';
		$cat2_sel = '';
		$cat3_sel = '';
		if($_POST){
			$code = isset($_POST['code'])?trim($_POST['code']):'';
			$min = isset($_POST['min'])?trim($_POST['min']):'';
			$max = isset($_POST['max'])?trim($_POST['max']):'';
			$type = isset($_POST['type'])?trim($_POST['type']):'';
			$category = isset($_POST['categroy_three'])?trim($_POST['categroy_three']):'';
			$category1 = isset($_POST['categroy_one'])?trim($_POST['categroy_one']):'';
			$category2 = isset($_POST['categroy_two'])?trim($_POST['categroy_two']):'';
			if($code!=''){
				$where .= "product_code='". $code."' AND ";
				$code_but = $code;
			}
			if($min!=''){
				$where .= "inventory_num>='".$min."' AND ";
				$min_but = $min;
			}
			if($max!=''){
				$where .= "inventory_num<='".$max."' AND ";
				$max_but = $max;
			}
			if($type!=''){
				$create_times = date("Y-m-d H:i:s",time());
				if($type==1){
					//在售
					$where .= "sale_end_time > '".$create_times."' AND sale_start_time < '".$create_times."' AND ";
					$type_but = 1;
				}else if($type==2){
					//待售
					$where .=  "(sale_start_time > '".$create_times."' OR (sale_start_time<'".$create_times."' AND sale_end_time < '".$create_times."' )) AND ";
					$type_but = 2;
				}
			}
			if($category!=''){
				if($category1!=0 && $category2!=0 && $category!=0){
					$where .=  "category_code like '".$category."' AND ";
					$category_but = $category;
					$category1_but = $category1;
					$category2_but = $category2;
				}else if($category2 == 0 && $category1!=0){
					$where .=  "category_code like '".$category1."%' AND ";
					$category1_but = $category1;
				}else if($category1!=0 && $category2!=0 && $category==0){
					$where .=  "category_code like '".$category2."%' AND ";
					$category1_but = $category1;
					$category2_but = $category2;
				}
				//$where .=  "category_code='".$category."' AND ";
			}
			$where = trim($where,'AND ');
			if($where == ''){$where=1;}
		}else{
			$where = 1;
		}
		$sql = "SELECT count(*) count FROM `vcos_product` WHERE ".$where." AND is_rubbish=0";
		$product_count = Yii::app()->p_db->createCommand($sql)->queryRow();
		$product_count = (int)ceil($product_count['count']/10);
		
		$sql = "SELECT product_id,product_code,product_name,inventory_num,sale_start_time,sale_end_time FROM `vcos_product`  WHERE ".$where." AND is_rubbish=0 LIMIT 0,10 ";
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($category1_but!=0&&$category1_but!=''){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$category1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		if($category2_but!=0&&$category2_but!=''){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$category2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		
		$this->render('product_inventory',array('inventory_page'=>1,'code_but'=>$code_but,'min_but'=>$min_but,'max_but'=>$max_but,'type_but'=>$type_but,'category_but'=>$category_but,'category1_but'=>$category1_but,'category2_but'=>$category2_but,'product'=>$product,'product_count'=>$product_count,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
	}
	
	/**商品库存分页获取**/
	public function actionGetProductInventoryPage(){
		$pag = isset($_POST['pag'])?$_POST['pag']==1?0:($_POST['pag']-1)*10:0;
		$create_times = date("Y-m-d H:i:s",time());
		$code = isset($_POST['code'])?$_POST['code']:'';
		$min = isset($_POST['min'])?$_POST['min']:'';
		$max = isset($_POST['max'])?$_POST['max']:'';
		$type = isset($_POST['type'])?$_POST['type']:'';
		$category = isset($_POST['category_three'])?$_POST['category_three']:'';
		$category1 = isset($_POST['category_one'])?$_POST['category_one']:'';
		$category2 = isset($_POST['category_two'])?$_POST['category_two']:'';
		$where = '';
		if($code!=''){
			$where .= "product_code='". $code."' AND ";
		}
		if($min!=''){
			$where .= "inventory_num>='".$min."' AND ";
		}
		if($max!=''){
			$where .= "inventory_num<='".$max."' AND ";
		}
		if($type!=''){
			$create_times = date("Y-m-d H:i:s",time());
			if($type==1){
				//在售
				$where .= "sale_end_time > '".$create_times."' AND sale_start_time < '".$create_times."' AND ";
			}else if($type==2){
				//待售
				$where .=  "(sale_start_time > '".$create_times."' OR (sale_start_time<'".$create_times."' AND sale_end_time < '".$create_times."' )) AND ";
			}
		}
		if($category1!='' && $category2!='' && $category!=''){
			$where .=  "category_code like '".$category."' AND ";
		}else if($category1!=''&& $category2=='' && $category==''){
			$where .=  "category_code like '".$category1."%' AND ";
		}else if($category1!='' && $category2!='' && $category==''){
			$where .=  "category_code like '".$category2."%' AND ";
		}
		$where = trim($where,'AND ');
		
		if($where==''){$where=1;}
		$sql = "SELECT product_id,product_code,product_name,inventory_num,sale_start_time,sale_end_time FROM `vcos_product` WHERE ".$where." AND is_rubbish=0 LIMIT {$pag},10";
		$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($product){
			echo json_encode($product);
		}  else {
			echo 0;
		}
		
	}
	
	/**库存管理库存修改**/
	public function actionUpdateProductInventory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$ids = isset($_POST['ids'])?$_POST['ids']:'';
		$inventory = isset($_POST['inventory'])?$_POST['inventory']:'';
		$flag = 0;
		if($inventory!=''&&$ids!=''){
			$ids = explode(',', $ids);
			$inventory = explode(',', $inventory);
			$transaction=$p_db->beginTransaction();
			try{
				for($i=0;$i<count($ids);$i++){
					$sql = "UPDATE `vcos_product` SET inventory_num='".$inventory[$i]."' WHERE product_id=".$ids[$i];
					Yii::app()->p_db->createCommand($sql)->execute();
				}
				$transaction->commit();
				$flag = 1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag = 0;
			}
		}
		if($flag == 1){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	/**商品盘点页面**/
	public function actionProduct_check(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$where = '';
		$code_but = '';
		$min_but = '';
		$max_but = '';
		$type_but = 1;
		$category_but = '';
		$category1_but = '';
		$category2_but = '';
		$cat1_sel = '';
		$cat2_sel = '';
		$cat3_sel = '';
		$product = '';
		$product_count = 0;
		if($_POST){
			$code = isset($_POST['code'])?trim($_POST['code']):'';
			$min = isset($_POST['min'])?trim($_POST['min']):'';
			$max = isset($_POST['max'])?trim($_POST['max']):'';
			$type = isset($_POST['type'])?trim($_POST['type']):'';
			$category = isset($_POST['categroy_three'])?trim($_POST['categroy_three']):'';
			$category1 = isset($_POST['categroy_one'])?trim($_POST['categroy_one']):'';
			$category2 = isset($_POST['categroy_two'])?trim($_POST['categroy_two']):'';
			if($code!=''){
				$where .= "product_code='". $code."' AND ";
				$code_but = $code;
			}
			if($min!=''){
				$where .= "inventory_num>='".$min."' AND ";
				$min_but = $min;
			}
			if($max!=''){
				$where .= "inventory_num<='".$max."' AND ";
				$max_but = $max;
			}
			if($type!=''){
				$create_times = date("Y-m-d H:i:s",time());
				if($type==1){
					//在售
					$where .= "sale_end_time > '".$create_times."' AND sale_start_time < '".$create_times."' AND ";
					$type_but = 1;
				}else if($type==2){
					//待售
					$where .=  "(sale_start_time > '".$create_times."' OR (sale_start_time<'".$create_times."' AND sale_end_time < '".$create_times."' )) AND ";
					$type_but = 2;
				}
			}
			if($category!=''){
				if($category1!=0 && $category2!=0 && $category!=0){
					$where .=  "category_code like '".$category."' AND ";
					$category_but = $category;
					$category1_but = $category1;
					$category2_but = $category2;
				}else if($category2 == 0 && $category1!=0){
					$where .=  "category_code like '".$category1."%' AND ";
					$category1_but = $category1;
				}else if($category1!=0 && $category2!=0 && $category==0){
					$where .=  "category_code like '".$category2."%' AND ";
					$category1_but = $category1;
					$category2_but = $category2;
				}
				//$where .=  "category_code='".$category."' AND ";
			}
			$where = trim($where,'AND ');
			if($where == ''){$where=1;}
		}else{
			$where = 1;
		}
		if(isset($_POST['find_but'])){
			$sql = "SELECT count(*) count FROM `vcos_product` WHERE ".$where." AND is_rubbish=0";
			$product_count = Yii::app()->p_db->createCommand($sql)->queryRow();
			$product_count = (int)ceil($product_count['count']/10);
		
			$sql = "SELECT product_id,product_code,product_name,inventory_num,sale_start_time,sale_end_time FROM `vcos_product`  WHERE ".$where." AND is_rubbish=0 LIMIT 0,10 ";
			$product = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		if($category1_but!=0&&$category1_but!=''){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$category1_but;
			$cat2_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		if($category2_but!=0&&$category2_but!=''){
			$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$category2_but;
			$cat3_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		
		
		$this->render('product_check',array('inventory_page'=>1,'code_but'=>$code_but,'min_but'=>$min_but,'max_but'=>$max_but,'type_but'=>$type_but,'category_but'=>$category_but,'category1_but'=>$category1_but,'category2_but'=>$category2_but,'product'=>$product,'product_count'=>$product_count,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
	}
	
	
	
	//盘点管理：导出excel
	public  function actionProductCheckExport()
	{	
		//判断数据条件
		$where='';
		$code = isset($_POST['code'])?trim($_POST['code']):'';
		$min = isset($_POST['min'])?trim($_POST['min']):'';
		$max = isset($_POST['max'])?trim($_POST['max']):'';
		$type = isset($_POST['type'])?trim($_POST['type']):'';
		$category = isset($_POST['categroy_three'])?trim($_POST['categroy_three']):'';
		$category1 = isset($_POST['categroy_one'])?trim($_POST['categroy_one']):'';
		$category2 = isset($_POST['categroy_two'])?trim($_POST['categroy_two']):'';
		if($code!=''){
			$where .= "product_code='". $code."' AND ";
			$code_but = $code;
		}
		if($min!=''){
			$where .= "inventory_num>='".$min."' AND ";
			$min_but = $min;
		}
		if($max!=''){
			$where .= "inventory_num<='".$max."' AND ";
			$max_but = $max;
		}
		if($type!=''){
			$create_times = date("Y-m-d H:i:s",time());
			if($type==1){
				//在售
				$where .= "sale_end_time > '".$create_times."' AND sale_start_time < '".$create_times."' AND ";
				$type_but = 1;
			}else if($type==2){
				//待售
				$where .=  "(sale_start_time > '".$create_times."' OR (sale_start_time<'".$create_times."' AND sale_end_time < '".$create_times."' )) AND ";
				$type_but = 2;
			}
		}
		if($category!=''){
			if($category1!=0 && $category2!=0 && $category!=0){
				$where .=  "category_code like '".$category."' AND ";
			}else if($category2 == 0 && $category1!=0){
				$where .=  "category_code like '".$category1."%' AND ";
			}else if($category1!=0 && $category2!=0 && $category==0){
				$where .=  "category_code like '".$category2."%' AND ";
			}
		}
		$where = trim($where,'AND ');
		if($where == ''){$where=1;}
		$type_text = $type_but==1?'在售商品':'待售商品';
		
		$objectPHPExcel = new PHPExcel();
		$objectPHPExcel->setActiveSheetIndex(0);
		
		$page_size = 52;
		//数据的取出
		//$sql = "SELECT product_code,product_name,inventory_num,inventory_num check_num FROM `vcos_product` limit 10";
		//$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT product_code,product_name,inventory_num,inventory_num check_num FROM `vcos_product`  WHERE ".$where." AND is_rubbish=0";
		$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		$count = count($data);
		//总页数的算出
		$page_count = (int)($count/$page_size) +1;
		$current_page = 0;
	
		$n = 0;
		foreach ( $data as $product )
		{
			if ( $n % $page_size === 0 )
			{
				$current_page = $current_page +1;
	
				//报表头的输出
				$objectPHPExcel->getActiveSheet()->mergeCells('B1:G1');
				$objectPHPExcel->getActiveSheet()->setCellValue('B1','产品信息表');
	
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','产品信息表');
				//$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','产品信息表');
				$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
				$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
				->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2',$type_text.'/日期：'.date("Y年m月j日"));
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2','第'.$current_page.'/'.$page_count.'页');
				$objectPHPExcel->setActiveSheetIndex(0)->getStyle('E2')
				->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
				//表格头的输出
				//$objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3','商品编码');
				$objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3','商品名称');
				$objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','库存总数');
				$objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
				$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','盘点总数');
				$objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
	
				//设置居中
				$objectPHPExcel->getActiveSheet()->getStyle('B3:E3')
				->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
			}
			//明细的输出
			$objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+4) ,$product['product_code']);
			$objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+4) ,$product['product_name']);
			$objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+4) ,$product['inventory_num']);
			$objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,$product['check_num']);
			
			$n = $n +1;
		}
	
		//设置分页显示
		//$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
		//$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
		$objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
		$objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
	
	
		//ob_end_clean();
		//ob_start();
		
		//生成xls文件
		header('Content-Type : application/vnd.ms-excel');
		header('Content-Disposition:attachment;filename="'.'产品信息表-'.date("Y年m月j日-H时i分s秒").'.xls"');
		$objWriter= PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
		$objWriter->save('php://output');
		
	}
	
	
	//盘点管理：导入excel
	public  function actionProductCheckImport()
	{
		//$filePath='E:/svnLog/aa.xls';
		if(!isset($_FILES['import_input']['tmp_name'])){
			$this->redirect(array('Product/product_check'));
			exit;
		}
		$filePath = $_FILES['import_input']['tmp_name'];
		$data = '';
		$type_text = 1;
		if($filePath){
			$objectPHPExcel = new PHPExcel();
			//$reader = PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
			
			$PHPExcel = PHPExcel_IOFactory::load($filePath);
			
			$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表(编号从 0 开始)
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			
			$arr = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M', 14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z');
			
			//获取状态是在售或待售
			$type_text = $sheet->getCellByColumnAndRow(1, 2)->getValue();
			$type_text = explode('/', $type_text);
			$type_text = $type_text[0]=='在售商品'?1:2;
			// 一次读取一列
			$data = array();
			for ($row = 4; $row <= $highestRow; $row++) {
				$data_child = array();
				for ($column = 1; $arr[$column] != 'E'; $column++)  {
					$val = $sheet->getCellByColumnAndRow($column, $row)->getValue();
					//$val = iconv("utf-8","GB2312//IGNORE",$val);
					//var_dump($val . "&nbsp;&nbsp;");
					if($val){
						$data_child[] = $val;
					}
				}
				//var_dump('-------------------------<br/>');
				if($data_child){
					$data[] = $data_child;
				}
			}
		}	
		$code_but = '';
		$min_but = '';
		$max_but = '';
		$type_but = $type_text;
		$category_but = '';
		$category1_but = '';
		$category2_but = '';
		$cat1_sel = '';
		$cat2_sel = '';
		$cat3_sel = '';
		$product = '';
		$product_count = 0;
		$sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=0";
		$cat1_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$this->render('product_check',array('inventory_page'=>1,'code_but'=>$code_but,'min_but'=>$min_but,'max_but'=>$max_but,'type_but'=>$type_but,'category_but'=>$category_but,'category1_but'=>$category1_but,'category2_but'=>$category2_but,'import_product'=>$data,'product'=>'','product_count'=>0,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
		
	}
	
	
	//盘点管理：提交修改
	public function actionUpdateProductCheckInventory(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		
		$code = isset($_POST['code'])?$_POST['code']:'';
		$name = isset($_POST['name'])?$_POST['name']:'';
		$status = isset($_POST['status'])?$_POST['status']:'';
		$inventory_old = isset($_POST['inventory_old'])?$_POST['inventory_old']:'';
		$inventory = isset($_POST['inventory'])?$_POST['inventory']:'';
		$time = date('Y-m-d H:i:s',time());
		$this_user_name = Yii::app()->user->name;
		$flag = 0;
		if($code!=''){
			$transaction=$p_db->beginTransaction();
			try{
				$check_code = OrderService::createOrderno();
				//新增盘点记录
				$sql = "INSERT INTO `vcos_product_check` (check_code,check_time,check_type,check_people) VALUES ('{$check_code}','{$time}','{$status[0]}','{$this_user_name}')";
				Yii::app()->p_db->createCommand($sql)->execute();
				
				for($i=0;$i<count($code);$i++){
					$sql = "INSERT INTO `vcos_product_check_detail` (check_code,product_name,inventory_num,check_num,product_code) VALUES ('{$check_code}','{$name[$i]}','{$inventory_old[$i]}','{$inventory[$i]}','{$code[$i]}')";
					Yii::app()->p_db->createCommand($sql)->execute();
					$sql = "UPDATE `vcos_product` SET inventory_num='{$inventory[$i]}' WHERE product_code='{$code[$i]}'";
					Yii::app()->p_db->createCommand($sql)->execute();
				}
				$transaction->commit();
				$flag=1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag = 0;
			}
		}
		
		if($flag==1){
			Helper::show_message(yii::t('vcos', '提交成功。'), Yii::app()->createUrl("Product/product_check"));
		}else{
			Helper::show_message(yii::t('vcos', '提交失败。'),Yii::app()->createUrl("Product/product_check"));
		}
		
	}
	
	
	//盘点记录页面
	public function actionProduct_check_record(){
		$this->setauth();//检查有无权限
		$count_sql = "SELECT count(*) count FROM `vcos_product_check` ORDER BY check_time DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT * FROM `vcos_product_check` ORDER BY check_time DESC
		LIMIT {$criteria->offset}, 10";
		$product_check_record = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('product_check_record',array('pages'=>$pager,'auth'=>$this->auth,'product_check_record'=>$product_check_record));
	} 
	
	
	//盘点记录详情页面
	public function actionProduct_check_record_detail(){
		$this->setauth();//检查有无权限
		$code = isset($_GET['id'])?$_GET['id']:0;
		$sql = "SELECT * FROM `vcos_product_check_detail` WHERE check_code='{$code}' ";
		$product_check_record_detail = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('product_check_record_detail',array('auth'=>$this->auth,'product_check_record_detail'=>$product_check_record_detail));
	}
	
}