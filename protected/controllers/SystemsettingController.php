<?php

class SystemsettingController extends Controller
{
    public function actionLscategoryadd()
    {
        if($this->auth[0] == '0'){
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $lc = new VcosLifeserviceCategory();
        $lc_language = new VcosLifeserviceCategoryLanguage();
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',  Yii::app()->params['img_save_url'].'lifeservice_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            $lc->bg_color = $_POST['bgcolor'];
            $lc->lc_state = $state;
            $lc->lc_img_url = 'lifeservice_images/'.Yii::app()->params['month'].'/'.$photo;
            
            //处理事务
            $db = Yii::app()->m_db;
            $transaction=$db->beginTransaction();
            try{
                $lc->save();
                if(isset($_POST['language']) && $_POST['language'] != ''){//判读是否同时添加系统语言和外语
                    $sql = "INSERT INTO `vcos_lifeservice_category_language` (`lc_id`, `iso`, `lc_name`) VALUES ('{$lc->primaryKey}', '".Yii::app()->params['language']."', '{$_POST['title']}'), ('{$lc->primaryKey}', '{$_POST['language']}', '{$_POST['title_iso']}')";
                    $db->createCommand($sql)->execute();
                    $transaction->commit();
                    Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Lifeservice/Service_category"));
                }  else {//只添加系统语言时
                    $lc_language->lc_id = $lc->primaryKey;
                    $lc_language->iso = Yii::app()->params['language'];
                    $lc_language->lc_name = $_POST['title'];
                    $lc_language->save();
                    $transaction->commit();
                    Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Lifeservice/Service_category"));
                }
            }catch(Exception $e){
                $transaction->rollBack();
                Helper::show_message(yii::t('vcos', '添加失败。'), '#');
            }
        }
        $this->render('lscategoryadd',array('lc'=>$lc,'lc_language'=>$lc_language));
    }
    
    public function actionCruiseinfocategory()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        if($_POST){
            $ids=implode('\',\'', $_POST['ids']);
            $count=VcosCruiseInfoCategory::model()->deleteAll("id in('$ids')");
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/cruiseinfocategory")); 
            }else{
                Helper::show_message(yii::t('vcos', '删除失败')); 
            }
        }
        if($_GET){
            $did=$_GET['id'];
            $count=VcosCruiseInfoCategory::model()->deleteByPk($did);
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/cruiseinfocategory")); 
            }else{
                Helper::show_message(yii::t('vcos', '删除失败')); 
            }
        }
        $category = VcosCruiseInfoCategory::model()->findAll($params=array('order'=>'id'));
        $this->render('cruiseinfocategory',array('category'=>$category));
    }
    
    public function actionCruiseinfocategory_add()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $category = new VcosCruiseInfoCategory();
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'cruiseinfo_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->cruise_info_category_name = $_POST['name'];
                $category->category_href_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                $category->cruise_info_category_img_url = 'cruiseinfo_images/'.Yii::app()->params['month'].'/'.$photo;
                //print_r($category);die;
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '添加成功'), Yii::app()->createUrl("Systemsetting/cruiseinfocategory")); 
                }else{
                    Helper::show_message(yii::t('vcos', '添加失败')); 
                }
            }else{
                Helper::show_message(yii::t('vcos', '添加失败')); 
            }
        }
        $this->render('cruiseinfocategoryadd',array('access'=>$access));
    }
    
    public function actionCruiseinfocategory_edit()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $id=$_GET['id'];
        $category= VcosCruiseInfoCategory::model()->findByPk($id);
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'cruiseinfo_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->id = $id;
                $category->cruise_info_category_name = $_POST['name'];
                $category->category_href_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                if($photo){
                    $old=Yii::app()->params['img_save_url'].$category['cruise_info_category_img_url'];
                    if(file_exists($old)&&$category['cruise_info_category_img_url']){
                        unlink($old);
                    }
                    $category->cruise_info_category_img_url = 'cruiseinfo_images/'.Yii::app()->params['month'].'/'.$photo;
                }
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '修改成功'), Yii::app()->createUrl("Systemsetting/cruiseinfocategory"));  
                }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
                }
            }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
            }
        }
        $this->render('cruiseinfocategory_edit',array('category'=>$category));
    }
    
    public function actionNet_category()
    {
        $this->setauth();//检查有无权限
		$db = Yii::app()->m_db;
		//批量删除
		if($_POST){
			$a = count($_POST['ids']);
			$ids=implode('\',\'', $_POST['ids']);
			$result = VcosWifi::model()->count();
			/*
			$count_sql = "SELECT count(*) count FROM `vcos_strategy_city` WHERE country_id in('$ids')";
			$count_num = Yii::app()->m_db->createCommand($count_sql)->queryRow();*/
			if($a == $result){
				die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
			}/*else if($count_num['count'] >0){
				die(Helper::show_message(yii::t('vcos', '存在子类不能删除！')));
			}*/
		
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$count = VcosWifi::model()->deleteAll("wifi_id in('$ids')");
				$count2 = VcosWifiLanguage::model()->deleteAll("wifi_id in('$ids')");
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		//单条删除
		if(isset($_GET['id'])){
			$result = VcosWifi::model()->count();
			/*$sql = "SELECT count(*) count FROM `vcos_strategy_city` WHERE country_id = ".$_GET['id'];
			$count_num = $db->createCommand($sql)->queryRow();*/
			
			if($result<=1){
				die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
			}/*else if($count_num['count'] > 0){
				die(Helper::show_message(yii::t('vcos', '存在子类不能删除！')));
			}*/
			
			$did=$_GET['id'];
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$count=VcosWifi::model()->deleteByPk($did);
				$count2 = VcosWifiLanguage::model()->deleteAll("wifi_id in('$did')");
				$transaction->commit();
				Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '删除失败。'));
			}
		}
		//分页
		$count_sql = "SELECT count(*) count FROM `vcos_wifi` a LEFT JOIN `vcos_wifi_language` b ON a.wifi_id = b.wifi_id WHERE b.iso = '".Yii::app()->language."'";
		$count = $db->createCommand($count_sql)->queryRow();
		$criteria = new CDbCriteria();
		$count = $count['count'];
		$pager = new CPagination($count);
		$pager->pageSize=10;
		$pager->applyLimit($criteria);
		$sql = "SELECT * FROM `vcos_wifi` a LEFT JOIN `vcos_wifi_language` b ON a.wifi_id = b.wifi_id WHERE b.iso = '".Yii::app()->language."' LIMIT {$criteria->offset}, {$pager->pageSize}";
		$wifi = $db->createCommand($sql)->queryAll();
		
		$this->render('net_category',array('wifi'=>$wifi,'pages'=>$pager,'auth'=>$this->auth));
    }
    
    public function actionNet_category_add()
    {
        $this->setauth();//检查有无权限
        $wifi = new VcosWifi();
        $wifi_language = new VcosWifiLanguage();
        if($_POST){
            $state = isset($_POST['state'])?$_POST['state']:'0';
            $time = (int)$_POST['hour']*60+(int)$_POST['minute'];
            $wifi->wifi_price = $_POST['price']*100;
            $wifi->wifi_time = $time; 
            $wifi->wifi_state = $state;
           
            //事务处理
            $db = Yii::app()->m_db;
            $transaction=$db->beginTransaction();
            try{
                $wifi->save();
                if(isset($_POST['language']) && $_POST['language'] != ''){//判读是否同时添加系统语言和外语
                    $sql = "INSERT INTO `vcos_wifi_language` (`wifi_id`, `iso`, `wifi_name`) VALUES ('{$wifi->primaryKey}', '".Yii::app()->params['language']."', '{$_POST['name']}'), ('{$wifi->primaryKey}', '{$_POST['language']}', '{$_POST['name_iso']}')";
                    $db->createCommand($sql)->execute();
                    $transaction->commit();
                    Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
                }  else {//只添加系统语言时
                    $wifi_language->wifi_id = $wifi->primaryKey;
                    $wifi_language->iso = Yii::app()->params['language'];
                    $wifi_language->wifi_name = $_POST['name'];
                    $wifi_language->save();
                    $transaction->commit();
                    Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
                }
            }catch(Exception $e){
                $transaction->rollBack();
                Helper::show_message(yii::t('vcos', '添加失败。'), '#');
            }
        }
        $this->render('net_category_add',array('wifi'=>$wifi,'wifi_language'=>$wifi_language));
    }
    
    public function actionNet_category_edit()
    {
        $this->setauth();//检查有无权限
		$id=$_GET['id'];
		$wifi= VcosWifi::model()->findByPk($id);
		$sql = "SELECT b.id FROM vcos_wifi a LEFT JOIN vcos_wifi_language b ON a.wifi_id = b.wifi_id WHERE a.wifi_id = {$id} AND b.iso ='".Yii::app()->language."'";
		$id2 = Yii::app()->m_db->createCommand($sql)->queryRow();
		$wifi_language = VcosWifiLanguage::model()->findByPk($id2['id']);
		 
		if($_POST){
			 $state = isset($_POST['state'])?$_POST['state']:'0';
			 $time = (int)$_POST['hour']*60+(int)$_POST['minute'];
			//事务处理
			$db = Yii::app()->m_db;
			$transaction=$db->beginTransaction();
			try{
				if(isset($_POST['language']) && $_POST['language'] != ''){//编辑系统语言和外语状态下
					//编辑主表
					$columns = array('wifi_state'=>$state,'wifi_price'=>$_POST['price']*100,'wifi_time'=>$time);
					$db->createCommand()->update('vcos_wifi',$columns,'wifi_id = :id',array(':id'=>$id));
					//编辑系统语言
					$db->createCommand()->update('vcos_wifi_language', array('wifi_name'=>$_POST['name']), 'id=:id', array(':id'=>$id2['id']));
					//判断外语是新增OR编辑
					if($_POST['judge']=='add'){
						//新增外语
						$db->createCommand()->insert('vcos_wifi_language',array('wifi_id'=>$id,'iso'=>$_POST['language'],'wifi_name'=>$_POST['name_iso']));
					}  else {
						//编辑外语
						$db->createCommand()->update('vcos_wifi_language', array('wifi_name'=>$_POST['name_iso']), 'id=:id', array(':id'=>$_POST['judge']));
					}
					//事务提交
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
				}  else {//只编辑系统语言状态下
					$wifi->wifi_id = $id;
					$wifi->wifi_state = $state;
					$wifi->wifi_price = $_POST['price']*100;
					$wifi->wifi_time = $time;
					$wifi->save();
					$wifi_language->id = $id2['id'];
					$wifi_language->wifi_name = $_POST['name'];
					$wifi_language->save();
					$transaction->commit();
					Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Systemsetting/net_category"));
				}
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message(yii::t('vcos', '修改失败。'), '#');
			}
		}
		
		$this->render('net_category_edit',array('wifi'=>$wifi,'wifi_language'=>$wifi_language));
    }
    public function actionGetiso_wifi(){
    	$sql = "SELECT b.id, b.wifi_name FROM vcos_wifi a LEFT JOIN vcos_wifi_language b ON a.wifi_id = b.wifi_id WHERE a.wifi_id = '{$_POST['id']}' AND b.iso = '{$_POST['iso']}'";
    	$iso = Yii::app()->m_db->createCommand($sql)->queryRow();
    	if($iso){
    		echo json_encode($iso);
    	}  else {
    		echo 0;
    	}
    }
    
    public function actionLocation_category()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        if($_POST){
            $ids=implode('\',\'', $_POST['ids']);
            $count = VcosLocationCategory::model()->deleteAll("id in('$ids')");
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/Location_category"));
            }else{
                Helper::show_message(yii::t('vcos', '删除失败'));
            }
        }
        if($_GET){
            $did=$_GET['id'];
            $count = VcosLocationCategory::model()->deleteByPk($did);
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/Location_category"));
            }else{
                Helper::show_message(yii::t('vcos', '删除失败'));
            }
        }
        $category = VcosLocationCategory::model()->findAll($params=array('order'=>'id'));
        $this->render('location_category',array('category'=>$category));
    }
    
    public function actionLocation_category_add()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $category = new VcosLocationCategory();
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'system_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->location_category_name = $_POST['name'];
                $category->location_category_herf_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                $category->location_category_img_url = 'system_images/'.Yii::app()->params['month'].'/'.$photo;
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '添加成功'), Yii::app()->createUrl("Systemsetting/location_category")); 
                }else{
                    Helper::show_message(yii::t('vcos', '添加失败')); 
                }
            }else{
                Helper::show_message(yii::t('vcos', '添加失败')); 
            }
        }
        $this->render('location_category_add',array('access'=>$access));
    }
    
    public function actionLocation_category_edit()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $id=$_GET['id'];
        $category= VcosLocationCategory::model()->findByPk($id);
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'system_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->id = $id;
                $category->location_category_name = $_POST['name'];
                $category->location_category_herf_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                if($photo){
                    $old=Yii::app()->params['img_save_url'].$category['location_category_img_url'];
                    if(file_exists($old)&&$category['location_category_img_url']){
                        unlink($old);
                    }
                    $category->location_category_img_url = 'system_images/'.Yii::app()->params['month'].'/'.$photo;
                }
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '修改成功'), Yii::app()->createUrl("Systemsetting/location_category"));  
                }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
                }
            }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
            }
        }
        $this->render('location_category_edit',array('category'=>$category));
    }
    
    public function actionCommentandhelp_category()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        if($_POST){
            $ids=implode('\',\'', $_POST['ids']);
            $count = VcosCommentAndHelpCategory::model()->deleteAll("id in('$ids')");
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/Commentandhelp_category"));
            }else{
                Helper::show_message(yii::t('vcos', '删除失败'));
            }
        }
        if($_GET){
            $did=$_GET['id'];
            $count = VcosCommentAndHelpCategory::model()->deleteByPk($did);
            if ($count>0){
                Helper::show_message(yii::t('vcos', '删除成功'), Yii::app()->createUrl("Systemsetting/Commentandhelp_category"));
            }else{
                Helper::show_message(yii::t('vcos', '删除失败'));
            }
        }
        $category = VcosCommentAndHelpCategory::model()->findAll($params=array('order'=>'id'));
        $this->render('commentandhelp_category',array('category'=>$category));
    }
    
    public function actionCommentandhelp_category_add()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $category = new VcosCommentAndHelpCategory();
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'system_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->cnh_category_name = $_POST['name'];
                $category->cnh_herf_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                $category->cnh_img_url = 'system_images/'.Yii::app()->params['month'].'/'.$photo;
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '添加成功'), Yii::app()->createUrl("Systemsetting/Commentandhelp_category")); 
                }else{
                    Helper::show_message(yii::t('vcos', '添加失败')); 
                }
            }else{
                Helper::show_message(yii::t('vcos', '添加失败')); 
            }
        }
        $this->render('commentandhelp_category_add',array('access'=>$access));
    }
    
    public function actionCommentandhelp_category_edit()
    {
        if($this->auth[0] == '0'){
            $access = TRUE;
        }else{
            $error = Yii::app()->createUrl('error/index');
            $this->redirect($error);
        }
        $id=$_GET['id'];
        $category= VcosCommentAndHelpCategory::model()->findByPk($id);
        if($_POST){
            $photo='';
            if($_FILES['photo']['error']!=4){
                $result=Helper::upload_file('photo',Yii::app()->params['img_save_url'].'system_images/'.Yii::app()->params['month'], 'image', 3);
                $photo=$result['filename'];
            }
            $state = isset($_POST['state'])?$_POST['state']:'0';
            if($_POST['name']!=''&&$_POST['url']!=''&&$_POST['bgcolor']!=''){
                $category->id = $id;
                $category->cnh_category_name = $_POST['name'];
                $category->cnh_herf_url = $_POST['url'];
                $category->bg_color = $_POST['bgcolor'];
                $category->state = $state;
                if($photo){
                    $old=Yii::app()->params['img_save_url'].$category['cnh_img_url'];
                    if(file_exists($old)&&$category['cnh_img_url']){
                        unlink($old);
                    }
                    $category->cnh_img_url = 'system_images/'.Yii::app()->params['month'].'/'.$photo;
                }
                if($category->save()>0){
                    Helper::show_message(yii::t('vcos', '修改成功'), Yii::app()->createUrl("Systemsetting/Commentandhelp_category"));  
                }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
                }
            }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
            }
        }
        $this->render('commentandhelp_category_edit',array('category'=>$category));
    }
    
    
    
    /****电话服务列表************/
    public function actiontelephone_service_list(){
    	$this->setauth();//检查有无权限
    	$db = Yii::app()->m_db;
    	if(isset($_GET['id'])){
    		$result = VcosTelSnCode::model()->count();
    		if($result<=1){
    			die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
    		}
    		$did=$_GET['id'];
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$count=VcosTelSnCode::model()->deleteByPk($did);
    			$transaction->commit();
    			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_list"));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '删除失败。'));
    		}
    	}
    	//批量删除
    	if($_POST){
    		$a = count($_POST['ids']);
    		$result = VcosTelSnCode::model()->count();
    		if($a == $result){
    			die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
    		}
    		$ids=implode('\',\'', $_POST['ids']);
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$count=VcosTelSnCode::model()->deleteAll("id in('$ids')");
    			$transaction->commit();
    			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_list"));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '删除失败。'));
    		}
    	}
    	$count_sql = "SELECT count(*) count FROM vcos_tel_sn_code";
    	$count = $db->createCommand($count_sql)->queryRow();
    	$criteria = new CDbCriteria();
    	$count = $count['count'];
    	$pager = new CPagination($count);
    	$pager->pageSize=10;
    	$pager->applyLimit($criteria);
    	$sql = "SELECT * FROM vcos_tel_sn_code a LEFT JOIN `vcos_tel_item` b ON a.tel_id=b.tel_id  ORDER BY a.start_time DESC LIMIT {$criteria->offset}, {$pager->pageSize}";
    	$code = $db->createCommand($sql)->queryAll();
    	
    	$this->render('telephone_service_list',array('pages'=>$pager,'auth'=>$this->auth,'code'=>$code));
    }
    
    /***电话服务添加***/
    public function actionTelephone_service_add(){
    	$this->setauth();//检查有无权限
    	$code = new VcosTelSnCode();
    	if($_POST){
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$code_pass = isset($_POST['really_code_pass'])?trim($_POST['really_code_pass']):'';
    		$s_time = isset($_POST['stime'])?trim($_POST['stime']).':00':'';
    		$e_time = isset($_POST['etime'])?trim($_POST['etime']).':00':'';
    		$tel_cat = isset($_POST['tel_cat'])?trim($_POST['tel_cat']):0;
    		
    		//事务处理
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			$code_pass = explode(';', $code_pass);
    			foreach($code_pass as $row){
    				$c_p = explode(',',$row);
    				$sql = "INSERT INTO `vcos_tel_sn_code` (sn_code,sn_password,start_time,end_time,status,tel_id) VALUES ('{$c_p[0]}','{$c_p[1]}','{$s_time}','{$e_time}','{$state}','{$tel_cat}')";
    				Yii::app()->m_db->createCommand($sql)->execute();
    			}
    			$transaction->commit();
    			Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_list"));
    				
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '添加失败。'), '#');
    		}
    	}
    	$sql = "SELECT * FROM `vcos_tel_item` a LEFT JOIN `vcos_tel_item_language` b ON a.tel_id=b.tel_id WHERE a.status=1 AND b.iso= '".Yii::app()->language."'";
    	$tel_item = Yii::app()->m_db->createCommand($sql)->queryAll();
    	
    	$this->render('telephone_service_add',array('tel_item'=>$tel_item,'code'=>$code));
    }
    
    /******电话服务编辑**********/
    public function actiontelephone_service_edit(){
    	$this->setauth();//检查有无权限
    	$id=$_GET['id'];
    	$code= VcosTelSnCode::model()->findByPk($id);
    	if($_POST){
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$code_ed = isset($_POST['code'])?trim($_POST['code']):'';
    		$pass_ed = isset($_POST['pass'])?trim($_POST['pass']):'';
    		$s_time = isset($_POST['stime'])?trim($_POST['stime']).':00':'';
    		$e_time = isset($_POST['etime'])?trim($_POST['etime']).':00':'';
    		$tel_cat = isset($_POST['tel_cat'])?trim($_POST['tel_cat']):0;
    		//事务处理
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			$code->sn_code = $code_ed;
    			$code->sn_password = $pass_ed;
    			$code->start_time = $s_time;
    			$code->end_time = $e_time;
    			$code->status = $state;
    			$code->tel_id = $tel_cat;
    			$code->save();
    			$transaction->commit();
    			Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_list"));
    			
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '修改失败。'), '#');
    		}
    	}
    	$sql = "SELECT * FROM `vcos_tel_item` a LEFT JOIN `vcos_tel_item_language` b ON a.tel_id=b.tel_id WHERE a.status=1 AND b.iso= '".Yii::app()->language."'";
    	$tel_item = Yii::app()->m_db->createCommand($sql)->queryAll();
    	
    	$this->render('telephone_service_edit',array('tel_item'=>$tel_item,'code'=>$code));
    }
    
    
    /*******电话服务验证卡号和卡密是否唯一********/
    public function actionCheckCodePass(){
    	$this->setauth();//检查有无权限
    	$code_pass = isset($_POST['code_pass'])?trim($_POST['code_pass']):'';
    	$code_ed = isset($_POST['code'])?trim($_POST['code']):'';
    	$pass_ed = isset($_POST['pass'])?trim($_POST['pass']):'';
    	$id = isset($_POST['id'])?trim($_POST['id']):0;
    	
    	if($id==0){
    		$code_pass = explode(';', $code_pass);
    		$al_code = '';
    		$al_pass = '';
	    	foreach ($code_pass as $row){
	    		$val = explode(',', $row);
	    		$code = $val[0];
	    		$pass = $val[1];
	    		$sql = "SELECT count(*) count FROM `vcos_tel_sn_code` WHERE sn_code='{$code}'";
	    		$code_count = Yii::app()->m_db->createCommand($sql)->queryRow();
	    		if($code_count['count']>0){$al_code.=$code.',';}
	    		$sql = "SELECT count(*) count FROM `vcos_tel_sn_code` WHERE sn_password='{$pass}'";
	    		$pass_count = Yii::app()->m_db->createCommand($sql)->queryRow();
	    		if($pass_count['count']>0){$al_pass.=$pass.',';}
	    	}
	    	
	    	if($al_code=='' && $al_pass==''){
	    		echo 0;
	    	}else{
	    		$al_code = trim($al_code,',');
	    		$al_pass = trim($al_pass,',');
	    		$data_all = array();
	    		$data_all['al_code'] = $al_code;
	    		$data_all['al_pass'] = $al_pass;
	    		echo json_encode($data_all);
	    	}
    	}else{
    		$sql = "SELECT count(*) count FROM `vcos_tel_sn_code` WHERE sn_code='{$code_ed}' AND id!='{$id}'";
    		$code_count = Yii::app()->m_db->createCommand($sql)->queryRow();
    		$sql = "SELECT count(*) count FROM `vcos_tel_sn_code` WHERE sn_password='{$pass_ed}' AND id!='{$id}'";
    		$pass_count = Yii::app()->m_db->createCommand($sql)->queryRow();
    		if($code_count['count']>0 && $pass_count['count']>0 ){
    			echo 1;
    		}else if($code_count['count']>0){
    			echo 2;
    		}else if($pass_count['count']>0){
    			echo 3;
    		}else{
    			echo 0;
    		}
    	}
    	
    }
    
    
    /****电话服务类型列表************/
    public function actiontelephone_service_type_list(){
    	$this->setauth();//检查有无权限
        $db = Yii::app()->m_db;
        //批量删除
        if($_POST){
            $a = count($_POST['ids']);
            $result = VcosTelItem::model()->count();
            if($a == $result){
                die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
            }
            $ids=implode('\',\'', $_POST['ids']);
            //事务处理
            $transaction=$db->beginTransaction();
            try{
                $count=VcosTelItem::model()->deleteAll("tel_id in('$ids')");
                $count2 = VcosTelItemLanguage::model()->deleteAll("tel_id in('$ids')");
                $transaction->commit();
                Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
            }catch(Exception $e){
                $transaction->rollBack();
                Helper::show_message(yii::t('vcos', '删除失败。'));
            }
        }
        //单条删除
        if(isset($_GET['id'])){
            $result = VcosTelItem::model()->count();
            if($result<=1){
                die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
            }
            $did=$_GET['id'];
            //事务处理
            $transaction2=$db->beginTransaction();
            try{
                $count=VcosTelItem::model()->deleteByPk($did);
                $count2 = VcosTelItemLanguage::model()->deleteAll("tel_id in('$did')");
                $transaction2->commit();
                Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
            }catch(Exception $e){
                $transaction2->rollBack();
                Helper::show_message(yii::t('vcos', '删除失败。'));
            }
        }
        $count_sql = "SELECT count(*) count FROM vcos_tel_item a, vcos_tel_item_language b WHERE a.tel_id = b.tel_id  AND b.iso = '".Yii::app()->language."'  ORDER BY a.tel_id DESC";
        $count = $db->createCommand($count_sql)->queryRow();
        //分页
        $criteria = new CDbCriteria();
        $count = $count['count'];
        $pager = new CPagination($count);
        $pager->pageSize=10;
        $pager->applyLimit($criteria);
        $sql = "SELECT * FROM vcos_tel_item a, vcos_tel_item_language b WHERE a.tel_id = b.tel_id  AND b.iso = '".Yii::app()->language."'  ORDER BY a.tel_id DESC LIMIT {$criteria->offset}, {$pager->pageSize}";
        $type = $db->createCommand($sql)->queryAll();
        $this->render('telephone_service_type_list',array('pages'=>$pager,'auth'=>$this->auth,'type'=>$type));  
    }
    
    
    /***电话服务类型添加***/
    public  function actionTelephone_service_type_add(){
    	$this->setauth();//检查有无权限
    	$item = new VcosTelItem();
    	$item_language = new VcosTelItemLanguage();
    	if($_POST){
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$time = isset($_POST['time'])?$_POST['time']:0;
    		$title = isset($_POST['title'])?trim($_POST['title']):'';
    		$title_iso = isset($_POST['title_iso'])?trim($_POST['title_iso']):'';
    		$price = isset($_POST['price'])?trim($_POST['price'])*100:0;
    		$item->sale_price = $price;
    		$item->tel_time = $time;
    		$item->status = $state;
    		//处理事务
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			$item->save();
    			if(isset($_POST['language']) && $_POST['language'] != ''){//判读是否同时添加系统语言和外语
    				$sql = "INSERT INTO `vcos_tel_item_language` (`tel_id`, `iso`, `tel_name`) VALUES ('{$item->primaryKey}', '".Yii::app()->params['language']."', '{$title}'), ('{$item->primaryKey}', '{$_POST['language']}', '{$title_iso}')";
    				$db->createCommand($sql)->execute();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
    			}  else {//只添加系统语言时
    				$item_language->tel_id = $item->primaryKey;
    				$item_language->iso = Yii::app()->params['language'];
    				$item_language->tel_name = $title;
    				$item_language->save();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
    			}
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '添加失败。'), '#');
    		}
    	}
    	$this->render('telephone_service_type_add',array('item'=>$item, 'item_language'=>$item_language));
    }
    
    /**电话服务类型**/
    public function actionTelephone_service_type_edit(){
    	$this->setauth();//检查有无权限
    	$id=$_GET['id'];
    	$item= VcosTelItem::model()->findByPk($id);
    	$sql = "SELECT b.id FROM vcos_tel_item a LEFT JOIN vcos_tel_item_language b ON a.tel_id = b.tel_id WHERE a.tel_id = {$id} AND b.iso ='".Yii::app()->params['language']."'";
    	$id2 = Yii::app()->m_db->createCommand($sql)->queryRow();
    	$item_language = VcosTelItemLanguage::model()->findByPk($id2['id']);
    	if($_POST){
    
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$price = isset($_POST['price'])?$_POST['price']*100:'0';
    		$time = isset($_POST['time'])?$_POST['time']:'0';
    		$title = isset($_POST['title'])?trim($_POST['title']):'';
    		$titles = isset($_POST['titles'])?trim($_POST['titles']):'';
    
    		//事务处理
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			if(isset($_POST['language']) && $_POST['language'] != ''){//编辑系统语言和外语状态下
    				//编辑主表
    				$columns = array('sale_price'=>$price,'status'=>$state,'tel_time'=>$time);
    				$db->createCommand()->update('vcos_tel_item',$columns,'tel_id = :id',array(':id'=>$id));
    				//编辑系统语言
    				$db->createCommand()->update('vcos_tel_item_language', array('tel_name'=>$title), 'id=:id', array(':id'=>$id2['id']));
    				//判断外语是新增OR编辑
    				if($_POST['judge']=='add'){
    					//新增外语
    					$db->createCommand()->insert('vcos_tel_item_language',array('tel_id'=>$id,'iso'=>$_POST['language'],'wifi_name'=>$_POST['name_iso']));
    				}  else {
    					//编辑外语
    					$db->createCommand()->update('vcos_tel_item_language', array('tel_name'=>$titles), 'id=:id', array(':id'=>$_POST['judge']));
    				}
    				//事务提交
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
    			}  else {//只编辑系统语言状态下
    				$item->tel_id = $id;
    				$item->sale_price = $price;
    				$item->tel_time = $time;
    				$item->status = $state;
    				$item->save();
    				$item_language->id = $id2['id'];
    				$item_language->tel_name = $title;
    				$item_language->save();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Systemsetting/telephone_service_type_list"));
    			}
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '修改失败。'), '#');
    		}
    	}
    	 
    	$this->render('telephone_service_type_edit',array('item'=>$item,'item_language'=>$item_language));
    }
    
    public function actionGetiso()
    {
    	$sql = "SELECT b.id, b.tel_name FROM vcos_tel_item a LEFT JOIN vcos_tel_item_language b ON a.tel_id = b.tel_id WHERE a.tel_id = '{$_POST['id']}' AND b.iso = '{$_POST['iso']}'";
    	$iso = Yii::app()->m_db->createCommand($sql)->queryRow();
    	if($iso){
    		echo json_encode($iso);
    	}  else {
    		echo 0;
    	}
    }
    
    /******删除电话服务类型时验证电话服务类型是否存在子类使用*********/
    public function actionChecktype()
    {
    	$result = VcosTelSnCode::model()->count('tel_id=:num',array(':num'=>$_POST['pid']));
    	if($result>0){
    		echo 1;
    	}
    }
    
    
    /**验证电话服务类型名称是否唯一***/
    public function actionCheckTelItemName(){
    	$this->setauth();//检查有无权限
    	$id = isset($_POST['id'])?trim($_POST['id']):0;
    	$title = isset($_POST['title'])?trim($_POST['title']):'';
    	$title_iso = isset($_POST['title_iso'])?trim($_POST['title_iso']):'';
    	$where = '';
    	if($title!=''){
    		$where .= " (tel_name='{$title}' AND iso='zh_cn') OR";
    	}
    	if($title_iso !=''){
    		$where .= " (tel_name='{$title_iso}' AND iso='en' ) OR";
    	}
    	$where = trim($where,'OR');
    	if($title!='' && $title_iso!=''){
    		$where = ' ( '.$where.' ) ';
    	}
    	
    	if($id!=0 && $id!=''){
    		$sql = "SELECT count(*) count FROM `vcos_tel_item_language` WHERE ".$where." AND tel_id!='{$id}'";
    	}else{
    		$sql = "SELECT count(*) count FROM `vcos_tel_item_language` WHERE ".$where;
    	}
    	$count = Yii::app()->m_db->createCommand($sql)->queryRow();
    	if($count['count']>0){
    		echo 1;
    	}else{
    		echo 0;
    	}
    	
    }

}