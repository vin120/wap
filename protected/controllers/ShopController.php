<?php
class ShopController extends Controller
{
	/**店铺列表**/
	public function actionShop_list(){
		$this->setauth();//检查有无权限
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			
			/*$count = VcosShop::model()->deleteAll("shop_id in($ids)");
			$count1 = VcosShopBrand::model()->deleteAll("shop_id in($ids)");
			$count2 = VcosShopCategory::model()->deleteAll("shop_id in($ids)");*/
			$sql = "UPDATE `vcos_shop` SET is_delete=1 WHERE shop_id in('$ids')";
			$res = Yii::app()->p_db->createCommand($sql)->execute();
			$sql = "DELETE FROM  `vcos_activity_product` WHERE product_id in('$ids') AND product_type=3";
			Yii::app()->p_db->createCommand($sql)->execute();
			if ($res){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			
			/*$count=VcosShop::model()->deleteByPk($did);
			$count1 = VcosShopBrand::model()->deleteAll("shop_id in($did)");
			$count2 = VcosShopCategory::model()->deleteAll("shop_id in($did)");*/
			$sql = "UPDATE `vcos_shop` SET is_delete=1 WHERE shop_id ='{$did}'";
			$res = Yii::app()->p_db->createCommand($sql)->execute();
			$sql = "DELETE FROM  `vcos_activity_product` WHERE product_id ='{$did}' AND product_type=3";
			Yii::app()->p_db->createCommand($sql)->execute();
			
			if ($res){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		$count_sql = "SELECT count(*) count FROM `vcos_shop` WHERE is_delete=0";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$count = (int)ceil($count['count']/10);
		$sql = "SELECT * FROM `vcos_shop` WHERE is_delete=0  LIMIT 0,10";
		$shop = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$count_sql = "SELECT count(*) count FROM `vcos_shop` WHERE is_delete=1";
		$already_count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$already_count = (int)ceil($already_count['count']/10);
		$sql = "SELECT * FROM `vcos_shop` WHERE is_delete=1 LIMIT 0,10";
		$already_shop = Yii::app()->p_db->createCommand($sql)->queryAll();
		
		$this->render('shop_list',array('no_page'=>1,'already_page'=>1,'already_count'=>$already_count,'count'=>$count,'auth'=>$this->auth,'shop'=>$shop,'already_shop'=>$already_shop));
	}
	
	/**店铺分页*
	 * act ==1:未删除
	 * act ==2:已删除
	 * 
	 * page：页码
	 * */
	public function actionGetShopPage(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$act = isset($_GET['act'])?$_GET['act']:1;
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*10:0;
		$pag_already = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*10:0;
		if($act == 1){
			$sql = "SELECT * FROM `vcos_shop` WHERE is_delete=0 LIMIT {$pag},10";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		}else if($act == 2){
			$sql = "SELECT * FROM `vcos_shop` WHERE is_delete=1 LIMIT {$pag_already},10";
			$data = Yii::app()->p_db->createCommand($sql)->queryAll();
		}
		if($data){
			echo json_encode($data);
		}  else {
			echo 0;
		}
	}
	
	
	/**店铺恢复数据**/
	public function actionUpdateShopIsDelete(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$ids = isset($_POST['ids'])?trim($_POST['ids']):'';
		if($ids!=''){
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "UPDATE `vcos_shop` SET is_delete=0 WHERE shop_id in ({$ids})";
				$data = Yii::app()->p_db->createCommand($sql)->execute();
				$ids_array = explode(',', $ids);
				foreach($ids_array as $row){
					$sql = "SELECT shop_status FROM `vcos_shop` WHERE shop_id='{$row}'";
					$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
					if($this_data['shop_status']==1){
						$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_id='{$row}' AND product_type=3";
					}else{
						$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$row}' AND product_type=3";
					}
					Yii::app()->p_db->createCommand($sql)->execute();
				}
				$transaction->commit();
				$flag = 1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag = 0;
			}
			
		}			
		if($flag==1){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	/**添加店铺**/
	public function actionShop_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = new VcosShop();
		if($_POST){
			$code = isset($_POST['code'])?$_POST['code']:'';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$people = isset($_POST['people'])?$_POST['people']:'';
			$company = isset($_POST['company'])?$_POST['company']:'';
			$address = isset($_POST['address'])?$_POST['address']:'';
			$price = isset($_POST['price'])?$_POST['price']*100:'';
			$products = isset($_POST['products'])?$_POST['products']:'';
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'shop_images/'.Yii::app()->params['month'].'/'.$photo;
			$photo1='';
			if($_FILES['photo1']['error']!=4){
				$result=Helper::upload_file('photo1', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo1=$result['filename'];
			}
			$photo_url1 = 'shop_images/'.Yii::app()->params['month'].'/'.$photo1;
			
			$photo2='';
			if($_FILES['photo2']['error']!=4){
				$result=Helper::upload_file('photo2', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo2=$result['filename'];
			}
			$photo_url2 = 'shop_images/'.Yii::app()->params['month'].'/'.$photo2;
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$create_times = date("Y/m/d H:i:s",time());
			$cruise_id = Yii::app()->params['cruise_id'];
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$shop->shop_code = $code;
				$shop->shop_title = $name;
				$shop->shop_logo = $photo_url;
				$shop->business_license = $photo_url2;
				$shop->shop_img_url = $photo_url1;
				$shop->shop_desc = $desc;
				$shop->legal_representative = $people;
				$shop->company_name = $company;
				$shop->shop_address = $address;
				$shop->cash_deposit = $price;
				$shop->main_products = $products;
				$shop->created = $create_times;
				$shop->shop_status = $state;
				$shop->cruise_id = $cruise_id;
				$shop->save();
				$inser_id =$shop->attributes['shop_id'];
				
				$transaction->commit();
				//Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Shop/shop_list"));
				Helper::show_message_querys(yii::t('vcos', '添加成功,是否继续添加店铺资质？'),yii::t('vcos', '是否继续添加店铺分类？'),Yii::app()->createUrl("Shop/shop_list"),Yii::app()->createUrl("Shop/shop_operation"),Yii::app()->createUrl("Shop/shop_edit",array('id'=>$inser_id)));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		
		$this->render('shop_add',array('shop'=>$shop));
	}
	
	/**编辑店铺**/
	public function actionShop_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$shop= VcosShop::model()->findByPk($id);
		if($_POST){
			$code = isset($_POST['code'])?$_POST['code']:'';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$people = isset($_POST['people'])?$_POST['people']:'';
			$company = isset($_POST['company'])?$_POST['company']:'';
			$address = isset($_POST['address'])?$_POST['address']:'';
			$price = isset($_POST['price'])?$_POST['price']*100:'';
			$products = isset($_POST['products'])?$_POST['products']:'';
			
			$photo='';
			if($_FILES['photo']['error']!=4){
				$result=Helper::upload_file('photo', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo=$result['filename'];
			}
			$photo_url = 'shop_images/'.Yii::app()->params['month'].'/'.$photo;
			$photo1='';
			if($_FILES['photo1']['error']!=4){
				$result=Helper::upload_file('photo1', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo1=$result['filename'];
			}
			$photo_url1 = 'shop_images/'.Yii::app()->params['month'].'/'.$photo1;
			
			$photo2='';
			if($_FILES['photo2']['error']!=4){
				$result=Helper::upload_file('photo2', Yii::app()->params['img_save_url'].'shop_images/'.Yii::app()->params['month'], 'image', 3);
				$photo2=$result['filename'];
			}
			$photo_url2 = 'shop_images/'.Yii::app()->params['month'].'/'.$photo2;
		
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$create_times = date("Y/m/d H:i:s",time());
			$cruise_id = Yii::app()->params['cruise_id'];
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$shop->shop_code = $code;
				$shop->shop_title = $name;
				if($photo){
				    $shop->shop_logo = $photo_url;
				}
				if($photo1){
					$shop->shop_img_url = $photo_url1;
				}
				if($photo2){
					$shop->business_license = $photo_url2;
				}
				$shop->shop_desc = $desc;
				$shop->legal_representative = $people;
				$shop->company_name = $company;
				$shop->shop_address = $address;
				$shop->cash_deposit = $price;
				$shop->main_products = $products;
				$shop->created = $create_times;
				$shop->shop_status = $state;
				$shop->cruise_id = $cruise_id;
				$shop->save();

				//修改活动商品（栏目页面配置是否有效问题）
				$sql = "SELECT is_delete FROM `vcos_shop` WHERE shop_id='{$id}'";
				$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
				if($state==0){
						$flag = 1;
				}else if($state==1){
					if($this_data['is_delete']==1){
						$flag = 1;
					}else{
						$flag = 0;
					}
				}
				if($flag == 1){
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$id}' AND product_type=3";
				}else if($flag == 0){
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_id='{$id}' AND product_type=3";
				}
				$p_db->createCommand($sql)->execute();
				
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Shop/shop_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT a.*,b.name,c.name parent_name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code LEFT JOIN `vcos_category` c ON a.parent_catogory_code=c.category_code WHERE a.status=1 AND a.shop_id=".$id;
		$shop_operation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$shop_operation = self::shopsortOut($shop_operation);
		//var_dump($shop_operation);exit;
		$sql = "SELECT * FROM `vcos_shop_category` a LEFT JOIN
		(SELECT parent_cid,count(parent_cid) count FROM `vcos_shop_category` b WHERE shop_id=".$id." GROUP BY parent_cid) b ON a.parent_cid=b.parent_cid
		WHERE a.shop_id=".$id." ORDER BY sort_order";
		$shop_cat = $p_db->createCommand($sql)->queryAll();
		$shop_cat = self::sortOut($shop_cat);
		$this->render('shop_edit',array('shop_cat'=>$shop_cat,'shop'=>$shop,'auth'=>$this->auth,'shop_operation'=>$shop_operation));
	}
	
	
	/**店铺编辑：店铺资质批量删除***/
	public function actionDelShopOperation(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		//$shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:0;
		//全部都是二级分类
		$checked_str = isset($_POST['checked_str'])?$_POST['checked_str']:'';
		if($checked_str!=''){
			$checked_str = explode(',', $checked_str);
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				foreach($checked_str as $row){
					//先查询父级code除了自己一个子类，是否存在其他子类，存在则不删除父类，不存在则删除父类
					//删除当前获取当前code，删除当前二级分类下的全部三级分类
					$sql = "SELECT shop_id,category_code,parent_catogory_code FROM `vcos_shop_operation_category` WHERE so_id='{$row}'";
					$this_data = Yii::app()->p_db->createCommand($sql)->queryRow();
					$sql = "SELECT count(*) count FROM `vcos_shop_operation_category` WHERE shop_id='{$this_data['shop_id']}' AND parent_catogory_code='{$this_data['parent_catogory_code']}' AND so_id!='{$row}'";
					$parent_count = Yii::app()->p_db->createCommand($sql)->queryRow();
					if($parent_count==0){
						//除了当前二级分类，已没有其他二级分类属于这个指定一级分类，应删除
						$sql = "DELETE FROM `vcos_shop_operation_category` WHERE category_code='{$ths_data['parent_catogory_code']}' AND shop_id='{$this_data['shop_id']}'";
						Yii::app()->p_db->createCommand($sql)->execute();
					}
					//删除当前code和子类全部
					$sql = "DELETE FROM `vcos_shop_operation_category` WHERE shop_id='{$this_data['shop_id']}' AND category_code like '{$this_data['category_code']}%'";
					Yii::app()->p_db->createCommand($sql)->execute();
				}
				$transaction->commit();
				$flag = 1;
			}catch(Exception $e){
				$transaction->rollBack();
				$flag = 0;
			}
		}
		
		if($flag){
			echo 1;
		}else{
				echo 0;
			}
	}
	
	/**检验店铺编码是否已经存在**/
	public function actionCheckCodeNameExits(){
		$this->setauth();//检查有无权限
		$id = isset($_GET['id'])?$_GET['id']:0;
		$code = isset($_GET['code'])?$_GET['code']:'';
		if($id==0){
			$sql = "SELECT count(*) count FROM `vcos_shop` WHERE shop_code='$code'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
		}else{
			$sql = "SELECT count(*) count FROM `vcos_shop` WHERE shop_code='$code' AND shop_id!='{$id}'";
			$count = Yii::app()->p_db->createCommand($sql)->queryRow();
			
		}
		if($count['count']>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	
	/**店铺品牌列表**/
	Public function actionShop_brand_list(){
		$this->setauth();//检查有无权限
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosShopBrand::model()->deleteAll("shop_brand_id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_brand_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosShopBrand::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_brand_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['shop']) && $_GET['shop'] != ''){
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_id=".$_GET['shop'];
		}else{
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` LIMIT 1";
		}
		$shop_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$shop_but = $shop_first['shop_id'];
		
		$count_sql = "SELECT count(*) count FROM `vcos_shop_brand` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		WHERE c.brand_status = 1 AND b.shop_status=1 AND a.shop_id=".$shop_but." ORDER BY a.shop_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.shop_brand_id,a.sort_order,b.shop_title,c.brand_cn_name FROM `vcos_shop_brand` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_brand` c ON a.brand_id = c.brand_id
		WHERE c.brand_status = 1 AND b.shop_status=1 AND a.shop_id=".$shop_but." ORDER BY a.shop_id DESC
		LIMIT {$criteria->offset}, 10";
		$shop_brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT shop_id,shop_title FROM `vcos_shop`";
		$shop_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('shop_brand_list',array('shop_but'=>$shop_but,'shop_sel'=>$shop_sel,'pages'=>$pager,'auth'=>$this->auth,'shop_brand'=>$shop_brand));
	}
	
	/**店铺品牌添加**/
	Public function actionShop_brand_add(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop_brand = new VcosShopBrand();
		if($_POST){
			$shop = isset($_POST['shop'])?$_POST['shop']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'';
			
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$shop_brand->shop_id = $shop;
				$shop_brand->brand_id = $brand;
				$shop_brand->sort_order = $sort;
				$shop_brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Shop/shop_brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'), '#');
			}
		}
		$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_status=1";
		$shop = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT brand_id,brand_cn_name FROM `vcos_brand` WHERE brand_status=1";
		$brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('shop_brand_add',array('shop'=>$shop,'brand'=>$brand,'shop_brand'=>$shop_brand));
	}
	
	
	/**店铺品牌编辑**/
	public function actionShop_brand_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$shop_brand= VcosShopBrand::model()->findByPk($id);
		if($_POST){
			$shop = isset($_POST['shop'])?$_POST['shop']:0;
			$brand = isset($_POST['brand'])?$_POST['brand']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:'';
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$shop_brand->shop_id = $shop;
				$shop_brand->brand_id = $brand;
				$shop_brand->sort_order = $sort;
				$shop_brand->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Shop/Shop_brand_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_status=1";
		$shop = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT brand_id,brand_cn_name FROM `vcos_brand` WHERE brand_status=1";
		$brand = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('shop_brand_edit',array('shop'=>$shop,'brand'=>$brand,'shop_brand'=>$shop_brand));
	}
	
	
	/**店铺分类列表**/
	/*public function actionShop_category_list(){
		$this->setauth();//检查有无权限
		if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosShopCategory::model()->deleteAll("shop_cid in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_category_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosShopCategory::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_category_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['shop']) && $_GET['shop'] != ''){
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_id=".$_GET['shop'];
		}else{
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` LIMIT 1";
		}
		$shop_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$shop_but = $shop_first['shop_id'];
		
		$count_sql = "SELECT count(*) count FROM `vcos_shop_category` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_category` c ON a.category_code = c.category_code
		WHERE a.shop_id=".$shop_but."
		ORDER BY a.shop_id DESC";
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT a.*,b.shop_title,c.name FROM `vcos_shop_category` a
		LEFT JOIN `vcos_shop` b ON a.shop_id = b.shop_id
		LEFT JOIN `vcos_category` c ON a.category_code = c.category_code
		WHERE a.shop_id=".$shop_but."
		ORDER BY a.shop_id DESC LIMIT {$criteria->offset}, 10";
		$shop_category = Yii::app()->p_db->createCommand($sql)->queryAll();
		$sql = "SELECT shop_id,shop_title FROM `vcos_shop`";
		$shop_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('shop_category_list',array('shop_but'=>$shop_but,'shop_sel'=>$shop_sel,'pages'=>$pager,'auth'=>$this->auth,'shop_category'=>$shop_category));
	}*/
	
	/**店铺分类**/
	public function actionShop_category(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop_category = new VcosShopCategory();
		
		if(isset($_GET['shop']) && $_GET['shop'] != ''){
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_status=1 AND shop_id=".$_GET['shop'];
		}else{
			$sql = "SELECT shop_id,shop_title FROM `vcos_shop`  WHERE shop_status=1 LIMIT 1";
		}
		$shop_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$shop_but = $shop_first['shop_id'];
		
		//$sql = "SELECT * FROM `vcos_shop_category` WHERE shop_id=".$shop[0]['shop_id'];
		$sql = "SELECT * FROM `vcos_shop_category` a LEFT JOIN 
		(SELECT parent_cid,count(parent_cid) count FROM `vcos_shop_category` b WHERE shop_id=".$shop_but." GROUP BY parent_cid) b ON a.parent_cid=b.parent_cid
		WHERE a.shop_id=".$shop_but." ORDER BY sort_order";
		$shop_cat = $p_db->createCommand($sql)->queryAll();
		$shop_cat = self::sortOut($shop_cat);
		
		$sql = "SELECT shop_id,shop_title from `vcos_shop` WHERE shop_status=1";
		$shop = $p_db->createCommand($sql)->queryAll();
		$this->render('shop_category_add',array('shop_but'=>$shop_but,'shop'=>$shop,'shop_cat'=>$shop_cat));
	}
	
	/**无限极分类**/
	static public function sortOut($list,$pid=0,$level=0,$html='--'){
		$tree = array();
		foreach($list as $v){
			if($v['parent_cid'] == $pid){
				$v['level'] = $level + 1;
				$v['html'] = str_repeat($html, $level);
				$tree[] = $v;
				$tree = array_merge($tree, self::sortOut($list,$v['shop_category_id'],$level+1,$html));
			}
		}
		return $tree;
	}
	
	/**编辑店铺分类**/
	/*
	public function actionShop_category_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$id=$_GET['id'];
		$shop_category= VcosShopCategory::model()->findByPk($id);
		if($_POST){
			$shop = isset($_POST['shop'])?$_POST['shop']:'0';
			$category = isset($_POST['category_3'])?$_POST['category_3']:0;
			$sort = isset($_POST['sort'])?$_POST['sort']:0;
		
			//事务处理
			$transaction=$p_db->beginTransaction();
			try{
				$shop_category->shop_id = $shop;
				$shop_category->category_code = $category;
				$shop_category->sort_order = $sort;
				$shop_category->save();
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Shop/shop_category_list"));
		
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'));
			}
		}
		$category_code = $shop_category['category_code'];
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$category_code;
		$layer_cat_2 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$layer_cat_2['parent_cid'];
		$layer_cat_1 = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT shop_id,shop_title from `vcos_shop` WHERE shop_status=1";
		$shop = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
		$layer_1 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_1['parent_cid'];
		$layer_2 = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_2['parent_cid'];
		$layer_3 = $p_db->createCommand($sql)->queryAll();
		$this->render('shop_category_edit',array('shop'=>$shop,'layer_cat'=>$layer_cat_1['parent_cid'],'layer_cat2'=>$layer_cat_2['parent_cid'],'shop_category'=>$shop_category,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	}*/
	
	
	/**店铺分类：获取最大值code和排序**/
	public function actionGetShopCatCode(){
		
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = isset($_GET['shop'])?$_GET['shop']:0;
		$parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
		$sql = "SELECT shop_category_id FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid= '{$parent_code}' ORDER BY shop_category_id DESC LIMIT 1";
		$result = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT sort_order FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid= '{$parent_code}' ORDER BY sort_order DESC LIMIT 1";
		$result_count = $p_db->createCommand($sql)->queryRow();
		//var_dump($result);var_dump($result_count);exit;
		$mag = array();
		$msg[0]=$result['shop_category_id'];
		$msg[1]=$result_count['sort_order'];
		if($result && $result_count){
			echo json_encode($msg);
		}else{
			echo 0;
		}
	}
	
	
	/**店铺分类-排序修改:act=>1:置顶，act=>2：上移，act=>3:下移，act=>4:置底**/
	public function actionUpdateSort(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$act = isset($_POST['act'])?$_POST['act']:0;
		$shop = isset($_POST['shop'])?$_POST['shop']:0;
		$code = isset($_POST['code'])?$_POST['code']:0;
		$parent = isset($_POST['parent'])?$_POST['parent']:0;
		if($act == 1){
			$sql = "UPDATE `vcos_shop_category` SET sort_order=sort_order+1 WHERE parent_cid='{$parent}' AND shop_id='{$shop}' AND shop_category_id != '{$code}'";
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_shop_category` SET sort_order=1 WHERE parent_cid='{$parent}' AND shop_id='{$shop}' AND shop_category_id='{$code}'";
			$p_db->createCommand($sql)->execute();
		}else if($act == 2){
			$sql = "SELECT sc_id,sort_order FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid='{$parent}' AND sort_order <= (SELECT sort_order FROM `vcos_shop_category` WHERE parent_cid='{$parent}' AND shop_id='{$shop}' AND shop_category_id='{$code}') ORDER BY sort_order DESC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_shop_category` SET sort_order='{$sort[0]["sort_order"]}' WHERE shop_id='{$shop}' AND sc_id=".$sort[1]["sc_id"];
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_shop_category` SET sort_order='{$sort[1]["sort_order"]}' WHERE shop_id='{$shop}' AND sc_id=".$sort[0]["sc_id"];
			$p_db->createCommand($sql)->execute();
		}else if($act == 3){
			$sql = "SELECT sc_id,sort_order FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid='{$parent}' AND sort_order >= (SELECT sort_order FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid='{$parent}' AND shop_category_id='{$code}') ORDER BY sort_order ASC LIMIT 2";
			$sort = $p_db->createCommand($sql)->queryAll();
			$sql = "UPDATE `vcos_shop_category` SET sort_order='{$sort[0]["sort_order"]}' WHERE shop_id='{$shop}' AND sc_id=".$sort[1]["sc_id"];
			$p_db->createCommand($sql)->execute();
			$sql = "UPDATE `vcos_shop_category` SET sort_order='{$sort[1]["sort_order"]}' WHERE shop_id='{$shop}' AND sc_id=".$sort[0]["sc_id"];
			$p_db->createCommand($sql)->execute();
		}else if($act == 4){
			$sql = "SELECT sort_order FROM `vcos_shop_category` WHERE shop_id='{$shop}' AND parent_cid='{$parent}' ORDER BY sort_order DESC LIMIT 1";
			$sort = $p_db->createCommand($sql)->queryRow();
			$sort = $sort['sort_order']+1;
			$sql = "UPDATE `vcos_shop_category` SET sort_order='{$sort}' WHERE shop_id='{$shop}' AND parent_cid='{$parent}' AND shop_category_id='{$code}'";
			$p_db->createCommand($sql)->execute();
			//$sql = "UPDATE `vcos_shop_category` SET sort_order=sort_order-1 WHERE shop_id='{$shop}' AND parent_cid='{$parent}' AND shop_category_id !='{$code}'";
			//$p_db->createCommand($sql)->execute();
		}
		
		echo 1;
		
		
	}
	
	
	/**店铺分类：提交数据入库:默认0=》新增，act-》1:修改，**/
	public function actionShopCategoryKeep(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$act = isset($_POST['act'])?$_POST['act']:0;
		$shop = isset($_POST['shop'])?$_POST['shop']:'0';
		$code = isset($_POST['code'])?$_POST['code']:0;
		$name = isset($_POST['name'])?$_POST['name']:'';
		$parent_code = isset($_POST['parent_code'])?$_POST['parent_code']:0;
		$sort = isset($_POST['sort'])?$_POST['sort']:0;
		$show_main = isset($_POST['show_main'])?$_POST['show_main']:1;
		
		if($act == 0){
			//新增数据
			$sql = "INSERT INTO `vcos_shop_category` (shop_id,shop_category_id,shop_category_name,parent_cid,sort_order,is_show_main) VALUES ('{$shop}','{$code}','{$name}','{$parent_code}','{$sort}','{$show_main}')";
		}else{
			//修改数据
			$sql = "UPDATE `vcos_shop_category` SET shop_id='{$shop}',shop_category_name='{$name}',parent_cid='{$parent_code}',sort_order='{$sort}',is_show_main='{$show_main}' WHERE shop_category_id = '{$code}'";
		}
		
		//事务处理
		$transaction=$p_db->beginTransaction();
		try{
			$result = $p_db->createCommand($sql)->execute();
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollBack();
		}
		echo $result;
	}
	
	/**店铺分类：删除数据**/
	public function actionDelShopCate(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$code = isset($_POST['code'])?$_POST['code']:0;
		$shop = isset($_POST['shop'])?$_POST['shop']:0;
		$sql = "DELETE FROM `vcos_shop_category` WHERE shop_category_id='{$code}' OR parent_cid='{$code}' AND shop_id='{$shop}'";
		$result = $p_db->createCommand($sql)->execute();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	/**店铺分类：点击是否在首页显示**/
	public function actionSetMainShow(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = isset($_POST['shop'])?$_POST['shop']:0;
		$code = isset($_POST['code'])?$_POST['code']:0;
		$key = isset($_POST['key'])?$_POST['key']:0;
		$sql = "UPDATE `vcos_shop_category` SET is_show_main='{$key}' WHERE (shop_id='{$shop}' AND shop_category_id='{$code}') OR (shop_id='{$shop}' AND parent_cid='{$code}')";
		$result = $p_db->createCommand($sql)->execute();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	/**店铺分类：删除该店铺下的全部分类**/
	public function actionDelShopCateAll(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = isset($_GET['shop'])?$_GET['shop']:0;
		$sql = "DELETE FROM `vcos_shop_category` WHERE shop_id=".$shop;
		$result = $p_db->createCommand($sql)->execute();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	/**商品：获取二级分类**/
	public function actionGetCategoryChild(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$parent_code;
		$resutl = $p_db->createCommand($sql)->queryAll();
		if($resutl){
			echo json_encode($resutl);
		}  else {
			echo 0;
		}
	}
	
	
	
	
	/**店铺资质添加***/
	public function actionShop_operation(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		if($_POST){
			$str_sql = '';
			$str_cat2 = array();
			$str_cat1 = array();
			$shop = $_POST['shop'];
			$data = $_POST['code'];
			//分区一二三级
			$cat1 = '';$cat2 = '';$cat3 = '';
			foreach($data as $row){
				if(strlen($row) == 2){
					$cat1 .= $row.',';
				}else if(strlen($row) == 4){
					$cat2 .= $row.',';
				}else if(strlen($row)){
					$cat3 .= $row.',';
				}
			}
			$cat1 = trim($cat1,',');
			$cat2 = trim($cat2,',');
			$cat3 = trim($cat3,',');
			$cat1 = explode(',', $cat1);
			$cat2 = explode(',', $cat2);
			$cat3 = explode(',', $cat3);
			
			//连接三级sql,并判断父类存在否
			if(!empty($cat3)){
			foreach ($cat3 as $row){
				$parent_1 = substr($row,0,2);
				$parent_2 = substr($row,0,4);
				if(!in_array($parent_1,$cat1) && !in_array($parent_1,$str_cat1)){
					$str_cat1[] = $parent_1;
				}
				if(!in_array($parent_2,$cat2) && !in_array($parent_2,$str_cat2)){
					$str_cat2[] = $parent_2;
				}
				$str_sql .= "('{$shop}','{$row}','3','1','1','{$parent_2}'),";
			}}
			//连接二级,全选状态
			if(!empty($cat2)){
			foreach ($cat2 as $row){
				$parent_1 = substr($row,0,2);
				if($row != '')
				$str_sql .= "('{$shop}','{$row}','2','1','1','{$parent_1}'),";
			}}
			//连接二级不选中状态
			if(!empty($str_cat2)){
			foreach ($str_cat2 as $row){
				$parent_1 = substr($row,0,2);
				if($row != '')
				$str_sql .= "('{$shop}','{$row}','2','0','1','{$parent_1}'),";
			}}
			//连接一级,全选状态
			if(!empty($cat1)){
			foreach ($cat1 as $row){
				if($row != '')
				$str_sql .= "('{$shop}','{$row}','1','1','1','0'),";
			}}
			//连接一级不选中状态
			if(!empty($str_cat1)){
			foreach ($str_cat1 as $row){
				if($row != '')
				$str_sql .= "('{$shop}','{$row}','1','0','1','0'),";
			}}
			
			$str_sql = trim($str_sql,',');
			$transaction=$p_db->beginTransaction();
			try{
				$sql = "INSERT INTO `vcos_shop_operation_category`(shop_id,category_code,tree_type,is_sub_all,status,parent_catogory_code) VALUES".$str_sql;
				$result = $p_db->createCommand($sql)->execute();
				$transaction->commit();
				//判断该店铺是否已经存在店铺分类，不存在则提示是否跳转添加分类
				$sql = "SELECT count(*) count FROM `vcos_shop_category` WHERE shop_id=".$shop;
				$count=$p_db->createCommand($sql)->queryRow();
				if($count['count']==0){
					Helper::show_message_query(yii::t('vcos', '添加成功,是否继续添加店铺分类？'),Yii::app()->createUrl("Shop/shop_edit",array('id'=>$shop)),Yii::app()->createUrl("Shop/shop_list"));
				}else{
					Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Shop/shop_list"));
				}
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '添加失败。'));
			}
		}
		
		//$sql = "SELECT shop_id,shop_title FROM `vcos_shop` WHERE shop_status=1";
		$sql = "select * from `vcos_shop` where shop_id not in(select shop_id from `vcos_shop_operation_category` GROUP BY shop_id) AND shop_status=1";
		$shop = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND parent_cid=0";
		$cat1_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND length(category_code)=4 ORDER BY parent_cid";
		$cat2_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND length(category_code)=7 ORDER BY parent_cid";
		$cat3_sel = $p_db->createCommand($sql)->queryAll();
		$cat1_but = $cat1_sel[0]['category_code'];
		$cat2_but = $cat2_sel[0]['category_code'];
		//$sql = "SELECT * FROM `vcos_shop_operation_category` WHERE status=1 AND shop_id=".$shop[0]['shop_id'];
		//$operation = $p_db->createCommand($sql)->queryAll();
		
		$this->render('shop_operation',array('cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'shop'=>$shop,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
	}
	
	/**店铺资质列表**/
	public function actionShop_operation_list(){
		$this->setauth();//检查有无权限
		/*if($_POST){
			$ids=implode('\',\'', $_POST['ids']);
			$count = VcosShopOperationCategory::model()->deleteAll("so_id in('$ids')");
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_operation_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		if(isset($_GET['id'])){
			$did=$_GET['id'];
			$count=VcosShopOperationCategory::model()->deleteByPk($did);
			if ($count>0){
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Shop/shop_operation_list"));
			}else{
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		*/
		if(isset($_GET['shop']) && $_GET['shop'] != ''){
			$sql = "SELECT a.shop_id,b.shop_title FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_shop` b ON a.shop_id=b.shop_id WHERE a.status=1 AND a.shop_id=".$_GET['shop'];
		}else{
			$sql = "SELECT a.shop_id,b.shop_title FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_shop` b ON a.shop_id=b.shop_id WHERE a.status=1 LIMIT 1";
		}
		$shop_first = Yii::app()->p_db->createCommand($sql)->queryRow();
		$shop_but = $shop_first['shop_id'];
		/*
		$count_sql = "SELECT count(*) count FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code WHERE a.status=1 AND a.shop_id=".$shop_but;
		$count = Yii::app()->p_db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);*/
		$sql = "SELECT a.*,b.name,c.name parent_name FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_category` b ON a.category_code=b.category_code LEFT JOIN `vcos_category` c ON a.parent_catogory_code=c.category_code WHERE a.status=1 AND a.shop_id=".$shop_but;
		$shop_operation = Yii::app()->p_db->createCommand($sql)->queryAll();
		$shop_operation = self::shopsortOut($shop_operation);
		$sql = "SELECT a.shop_id,b.shop_title FROM `vcos_shop_operation_category` a LEFT JOIN `vcos_shop` b ON a.shop_id=b.shop_id WHERE a.status=1 GROUP BY a.shop_id";
		$shop_sel = Yii::app()->p_db->createCommand($sql)->queryAll();
		$this->render('shop_operation_list',array('shop_but'=>$shop_but,'shop_sel'=>$shop_sel,'auth'=>$this->auth,'shop_operation'=>$shop_operation));
	}
	
	/**店铺资质编辑***/
	public function actionShop_operation_edit(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop_id = isset($_GET['shop'])?$_GET['shop']:0;
		if($_POST){
			
			$str_sql = '';
			$str_cat2 = array();
			$str_cat1 = array();
			$shop = $_POST['shop'];
			$data = $_POST['code'];
			$sql = "DELETE FROM `vcos_shop_operation_category` WHERE shop_id='{$shop}'";
			Yii::app()->p_db->createCommand($sql)->execute();
			//分区一二三级
			$cat1 = '';$cat2 = '';$cat3 = '';
			foreach($data as $row){
				if(strlen($row) == 2){
					$cat1 .= $row.',';
				}else if(strlen($row) == 4){
					$cat2 .= $row.',';
				}else if(strlen($row)){
					$cat3 .= $row.',';
				}
			}
			$cat1 = trim($cat1,',');
			$cat2 = trim($cat2,',');
			$cat3 = trim($cat3,',');
			$cat1 = explode(',', $cat1);
			$cat2 = explode(',', $cat2);
			$cat3 = explode(',', $cat3);
				
			//连接三级sql,并判断父类存在否
			if(!empty($cat3)){
				foreach ($cat3 as $row){
					$parent_1 = substr($row,0,2);
					$parent_2 = substr($row,0,4);
					if(!in_array($parent_1,$cat1) && !in_array($parent_1,$str_cat1)){
						$str_cat1[] = $parent_1;
					}
					if(!in_array($parent_2,$cat2) && !in_array($parent_2,$str_cat2)){
						$str_cat2[] = $parent_2;
					}
					$str_sql .= "('{$shop}','{$row}','3','1','1','{$parent_2}'),";
				}}
				//连接二级,全选状态
				if(!empty($cat2)){
					foreach ($cat2 as $row){
						$parent_1 = substr($row,0,2);
						if($row != '')
							$str_sql .= "('{$shop}','{$row}','2','1','1','{$parent_1}'),";
					}}
					//连接二级不选中状态
					if(!empty($str_cat2)){
						foreach ($str_cat2 as $row){
							$parent_1 = substr($row,0,2);
							if($row != '')
								$str_sql .= "('{$shop}','{$row}','2','0','1','{$parent_1}'),";
						}}
						//连接一级,全选状态
						if(!empty($cat1)){
							foreach ($cat1 as $row){
								if($row != '')
									$str_sql .= "('{$shop}','{$row}','1','1','1','0'),";
							}}
							//连接一级不选中状态
							if(!empty($str_cat1)){
								foreach ($str_cat1 as $row){
									if($row != '')
										$str_sql .= "('{$shop}','{$row}','1','0','1','0'),";
								}}
									
								$str_sql = trim($str_sql,',');
								$transaction=$p_db->beginTransaction();
								try{
									$sql = "INSERT INTO `vcos_shop_operation_category`(shop_id,category_code,tree_type,is_sub_all,status,parent_catogory_code) VALUES".$str_sql;
									$result = $p_db->createCommand($sql)->execute();
									$transaction->commit();
									Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Shop/shop_list"));
									
								}catch(Exception $e){
									$transaction->rollBack();
									Helper::show_message(yii::t('vcos', '修改失败。'));
								}
		}
	
		$sql = "select shop_id,shop_title from `vcos_shop` where shop_id='{$shop_id}' LIMIT 1";
		$shop = $p_db->createCommand($sql)->queryRow();
		$sql = "SELECT category_code FROM `vcos_shop_operation_category` where shop_id='{$shop_id}' AND is_sub_all=1 AND status=1";
		$already_operation = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND parent_cid=0";
		$cat1_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND length(category_code)=4 ORDER BY parent_cid";
		$cat2_sel = $p_db->createCommand($sql)->queryAll();
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE status=1 AND length(category_code)=7 ORDER BY parent_cid";
		$cat3_sel = $p_db->createCommand($sql)->queryAll();
		$cat1_but = $cat1_sel[0]['category_code'];
		$cat2_but = $cat2_sel[0]['category_code'];
		//$sql = "SELECT * FROM `vcos_shop_operation_category` WHERE status=1 AND shop_id=".$shop[0]['shop_id'];
		//$operation = $p_db->createCommand($sql)->queryAll();
	
		$this->render('shop_operation_edit',array('already_operation'=>$already_operation,'cat1_but'=>$cat1_but,'cat2_but'=>$cat2_but,'shop'=>$shop,'cat1_sel'=>$cat1_sel,'cat2_sel'=>$cat2_sel,'cat3_sel'=>$cat3_sel));
	}
	
	/**店铺资质：无限极分类**/
	static public function shopsortOut($list,$pid=0){
		$tree = array();
		foreach($list as $v){
			if($v['parent_catogory_code'] == $pid){
				$tree[] = $v;
				$tree = array_merge($tree, self::shopsortOut($list,$v['category_code']));
			}
		}
		return $tree;
	}
	
	
	
	/**验证店铺是否已经存在资质**/
	public function actionCheckShopExites(){
		$this->setauth();//检查有无权限
		$p_db = Yii::app()->p_db;
		$shop = isset($_POST['shop'])?$_POST['shop']:0;
		$result = '';
		$sql = "SELECT count(*) count FROM `vcos_shop_operation_category` WHERE shop_id=".$shop;
		$result = $p_db->createCommand($sql)->queryRow();
		
		if($result['count']>0){
			echo 0;
		}else{
			echo 1;
		}
	}
}