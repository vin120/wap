<?php

class WifisettingController extends Controller
{
    public function actionWifi_config_list()
    {
        $this->setauth();//检查有无权限
        $db = Yii::app()->m_db;
        $wifi = VcosWifiConfig::model()->findAll();
        
        if($_POST){
        	$a = count($_POST['ids']);
            $ids=implode('\',\'', $_POST['ids']);
            $result = VcosWifiConfig::model()->count();
            if($a == $result){
                die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
            }
            //事务处理
            $transaction=$db->beginTransaction();
            try{
                $count=VcosWifiConfig::model()->deleteAll("config_id in('$ids')");
                $transaction->commit();
                Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Wifisetting/Wifi_config_list"));   
            }catch(Exception $e){
                $transaction->rollBack();
                Helper::show_message(yii::t('vcos', '删除失败。'));
            }
        }
        //单条删除
        if(isset($_GET['id'])){
        	$result = VcosWifiConfig::model()->count();
        	if($result<=1){
        		die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
        	}
        	$did=$_GET['id'];
        	//事务处理
        	$transaction2=$db->beginTransaction();
        	try{
        		$count = VcosWifiConfig::model()->deleteByPk($did);
        		$transaction2->commit();
        		Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Wifisetting/Wifi_config_list"));
        	}catch(Exception $e){
        		$transaction2->rollBack();
        		Helper::show_message(yii::t('vcos', '删除失败。'));
        	}
        }
        
        $count_sql = "SELECT count(*) count FROM vcos_wifi_config ";
        $count = $db->createCommand($count_sql)->queryRow();
        
        //分页
        $criteria = new CDbCriteria();
        $count = $count['count'];
        $pager = new CPagination($count);
        $pager->pageSize=10;
        $pager->applyLimit($criteria);
        
        
        $this->render('wifi_config_list',array('wifi'=>$wifi,'auth'=>$this->auth,'pages'=>$pager));
    }
    
    /**更改wifi配置***/
    public function actionWifi_config_set_state(){
    	$sql = "UPDATE vcos_wifi_config t1,vcos_wifi_config t2 SET t1.config_state =  '1',t2.config_state = '0' WHERE t1.config_id = {$_GET['id']} AND t2.config_id NOT IN ( {$_GET['id']} )";
    	$wifis = Yii::app()->m_db->createCommand($sql)->execute();
    	if($wifis>0){
    		//Helper::show_message(yii::t('vcos', '保存成功'), Yii::app()->createUrl("Wifisetting/wifi_config_list"));
    		echo json_encode(1);
    	}else{
    		//Helper::show_message(yii::t('vcos', '保存失败'));
    		echo json_encode(0);
    	}
    }

    public function actionWifi_config_add()
    {
        $this->setauth();//检查有无权限
        $wifi = new VcosWifiConfig();
        if($_POST){
            if($_POST['describe']!=''&&$_POST['loginurl']!=''&&$_POST['logouturl']!=''&&$_POST['change']!=''&&$_POST['notice']!=''&&$_POST['policy']!=''&&$_POST['ssid']!=''&&$_POST['acip']!=''&&$_POST['apmac']!=''){
                $wifi->config_describe = $_POST['describe'];
                $wifi->config_login_url = $_POST['loginurl'];
                $wifi->config_logout_url = $_POST['logouturl'];
                $wifi->config_change_url = $_POST['change'];
                $wifi->config_notice = $_POST['notice'];
                $wifi->config_policy = $_POST['policy'];
                $wifi->config_ssid = $_POST['ssid'];
                $wifi->config_acip = $_POST['acip'];
                $wifi->config_apmac = $_POST['apmac'];
                if($wifi->save()>0){
                    Helper::show_message(yii::t('vcos', '添加成功'), Yii::app()->createUrl("Wifisetting/wifi_config_list"));
                }else{
                    Helper::show_message(yii::t('vcos', '添加失败'));
                }
            }else{
                Helper::show_message(yii::t('vcos', '添加失败'));
            }
        }
        $this->render('wifi_config_add');
    }

    public function actionWifi_config_edit()
    {
        $this->setauth();//检查有无权限
        $id=$_GET['id'];
        $wifi= VcosWifiConfig::model()->findByPk($id);
        if($_POST){
            if($_POST['describe']!=''&&$_POST['loginurl']!=''&&$_POST['logouturl']!=''&&$_POST['change']!=''&&$_POST['notice']!=''&&$_POST['policy']!=''&&$_POST['ssid']!=''&&$_POST['acip']!=''&&$_POST['apmac']!=''){
                $wifi->config_id = $id;
                $wifi->config_describe = $_POST['describe'];
                $wifi->config_login_url = $_POST['loginurl'];
                $wifi->config_logout_url = $_POST['logouturl'];
                $wifi->config_change_url = $_POST['change'];
                $wifi->config_notice = $_POST['notice'];
                $wifi->config_policy = $_POST['policy'];
                $wifi->config_ssid = $_POST['ssid'];
                $wifi->config_acip = $_POST['acip'];
                $wifi->config_apmac = $_POST['apmac'];
                if($wifi->save()>0){
                    Helper::show_message(yii::t('vcos', '修改成功'), Yii::app()->createUrl("Wifisetting/wifi_config_list"));
                }else{
                    Helper::show_message(yii::t('vcos', '修改失败'));
                }
            }else{
                Helper::show_message(yii::t('vcos', '修改失败'));
            }
        }
        $this->render('wifi_config_edit',array('wifi'=>$wifi));
    }
    
    
    /**wifi服务管理**/
    public function actionWifi_service_list(){
    	$this->setauth();//检查有无权限
    	$db = Yii::app()->m_db;
    	if(isset($_GET['id'])){
    		$result = VcosWifiItem::model()->count();
    		if($result<=1){
    			die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
    		}
    		$did=$_GET['id'];
    		//事务处理
    		$transaction2=$db->beginTransaction();
    		try{
    			$count = VcosWifiItem::model()->deleteByPk($did);
    			$count2 = VcosWifiItemLanguage::model()->deleteAll("wifi_id in('$did')");
    			$transaction2->commit();
    			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    		}catch(Exception $e){
    			$transaction2->rollBack();
    			Helper::show_message(yii::t('vcos', '删除失败。'));
    		}
    	}
    	//单条删除
    	if(isset($_GET['id'])){
    		$result = VcosWifiItem::model()->count();
    		if($result<=1){
    			die(Helper::show_message(yii::t('vcos', '不能把所有记录删除！')));
    		}
    		$did=$_GET['id'];
    		//事务处理
    		$transaction2=$db->beginTransaction();
    		try{
    			$count = VcosWifiItem::model()->deleteByPk($did);
    			$count2 = VcosWifiItemLanguage::model()->deleteAll("wifi_id in('$did')");
    			$transaction2->commit();
    			Helper::show_message(yii::t('vcos', '删除成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    		}catch(Exception $e){
    			$transaction2->rollBack();
    			Helper::show_message(yii::t('vcos', '删除失败。'));
    		}
    	}
    	$count_sql = "SELECT count(*) count FROM vcos_wifi_item a LEFT JOIN vcos_wifi_item_language b ON a.wifi_id = b.wifi_id WHERE b.iso = '".Yii::app()->language."' ORDER BY a.wifi_id DESC";
    	$count = $db->createCommand($count_sql)->queryRow();
    	//分页
    	$criteria = new CDbCriteria();
    	$count = $count['count'];
    	$pager = new CPagination($count);
    	$pager->pageSize=10;
    	$pager->applyLimit($criteria);
    	$sql = "SELECT * FROM vcos_wifi_item a LEFT JOIN vcos_wifi_item_language b ON a.wifi_id = b.wifi_id WHERE b.iso = '".Yii::app()->language."' ORDER BY a.wifi_id DESC LIMIT {$criteria->offset}, {$pager->pageSize}";
    	$wifi_item = $db->createCommand($sql)->queryAll();
    	$this->render('wifi_service_list',array('pages'=>$pager,'auth'=>$this->auth,'wifi_item'=>$wifi_item));
    }
    
    /**添加wifi服务**/
    public function actionWifi_service_add(){
    	$this->setauth();//检查有无权限
    	$wifi_item = new VcosWifiItem();
    	$wifi_item_language = new VcosWifiItemLanguage();
    	if($_POST){
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$price = isset($_POST['price'])?$_POST['price']*100:'0';
    		$time = isset($_POST['time'])?$_POST['time']:'0';
    		$wifi_item->status = $state;
    		$wifi_item->sale_price = $price;
    		$wifi_item->wifi_time = $time;
    		//事务处理
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			$wifi_item->save();
    			if(isset($_POST['language']) && $_POST['language'] != ''){//判读是否同时添加系统语言和外语
    				$sql = "INSERT INTO `vcos_wifi_item_language` (`wifi_id`, `iso`, `wifi_name`) VALUES ('{$wifi_item->primaryKey}', '".Yii::app()->params['language']."', '{$_POST['name']}'), ('{$wifi_item->primaryKey}', '{$_POST['language']}', '{$_POST['name_iso']}')";
    				$db->createCommand($sql)->execute();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    			}  else {//只添加系统语言时
    				$wifi_item_language->wifi_id = $wifi_item->primaryKey;
    				$wifi_item_language->iso = Yii::app()->params['language'];
    				$wifi_item_language->wifi_name = $_POST['name'];
    				$wifi_item_language->save();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    			}
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '添加失败。'), '#');
    		}
    	}
    	$this->render('wifi_service_add',array('wifi_item'=>$wifi_item,'wifi_item_language'=>$wifi_item_language));
    }
    
    /**编辑wifi服务**/
    public function actionWifi_service_edit(){
    	$this->setauth();//检查有无权限
    	$id=$_GET['id'];
    	$wifi_item= VcosWifiItem::model()->findByPk($id);
    	$sql = "SELECT b.id FROM vcos_wifi_item a LEFT JOIN vcos_wifi_item_language b ON a.wifi_id = b.wifi_id WHERE a.wifi_id = {$id} AND b.iso ='".Yii::app()->params['language']."'";
    	$id2 = Yii::app()->m_db->createCommand($sql)->queryRow();
    	$wifi_item_language = VcosWifiItemLanguage::model()->findByPk($id2['id']);
    	if($_POST){
    		
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$price = isset($_POST['price'])?$_POST['price']*100:'0';
    		$time = isset($_POST['time'])?$_POST['time']:'0';
    		
    		//事务处理
    		$db = Yii::app()->m_db;
    		$transaction=$db->beginTransaction();
    		try{
    			if(isset($_POST['language']) && $_POST['language'] != ''){//编辑系统语言和外语状态下
    				//编辑主表
    				$columns = array('sale_price'=>$price,'status'=>$state,'wifi_time'=>$time);
    				$db->createCommand()->update('vcos_wifi_item',$columns,'wifi_id = :id',array(':id'=>$id));
    				//编辑系统语言
    				$db->createCommand()->update('vcos_wifi_item_language', array('wifi_name'=>$_POST['name']), 'id=:id', array(':id'=>$id2['id']));
    				//判断外语是新增OR编辑
    				if($_POST['judge']=='add'){
    					//新增外语
    					$db->createCommand()->insert('vcos_wifi_item_language',array('wifi_id'=>$id,'iso'=>$_POST['language'],'wifi_name'=>$_POST['name_iso']));
    				}  else {
    					//编辑外语
    					$db->createCommand()->update('vcos_wifi_item_language', array('wifi_name'=>name_iso), 'id=:id', array(':id'=>$_POST['judge']));
    				}
    				//事务提交
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    			}  else {//只编辑系统语言状态下
    				$wifi_item->wifi_id = $id;
    				$wifi_item->sale_price = $price;
    				$wifi_item->wifi_time = $time;
    				$wifi_item->status = $state;
    				$wifi_item->save();
    				$wifi_item_language->id = $id2['id'];
    				$wifi_item_language->wifi_name = $_POST['name'];
    				$wifi_item_language->save();
    				$transaction->commit();
    				Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Wifisetting/wifi_service_list"));
    			}
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message(yii::t('vcos', '修改失败。'), '#');
    		}
    	}
    	
    	$this->render('wifi_service_edit',array('wifi_item'=>$wifi_item,'wifi_item_language'=>$wifi_item_language));
    }
    
    public function actionGetiso()
    {
    	$sql = "SELECT b.id, b.wifi_name FROM vcos_wifi_item a LEFT JOIN vcos_wifi_item_language b ON a.wifi_id = b.wifi_id WHERE a.wifi_id = '{$_POST['id']}' AND b.iso = '{$_POST['iso']}'";
    	$iso = Yii::app()->m_db->createCommand($sql)->queryRow();
    	if($iso){
    		echo json_encode($iso);
    	}  else {
    		echo 0;
    	}
    }
    
    /**验证wifi服务名称是否已经存在**/
    public function actionWifiNameGetAgain(){
    	$this->setauth();//检查有无权限
    	$name = isset($_POST['name'])?$_POST['name']:'';
    	$id = isset($_POST['id'])?$_POST['id']:'';
    	var_dump($_POST);exit;
    	if($id==''||$id==0){
    		//添加页面
    		$sql = "SELECT count(*) count FROM `vcos_wifi_item_language` WHERE wifi_name='{$name}'";
    		$count = Yii::app()->m_db->createCommand($sql)->queryRow();
    	}else{
    		//修改页面
    		$sql = "SELECT count(*) count FROM `vcos_wifi_item_language` WHERE wifi_name='{$name}' AND wifi_id!='{$id}'";
    		$count = Yii::app()->m_db->createCommand($sql)->queryRow();
    	}
    	if($count['count']>0){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
	
}