<?php
class ActivityController extends Controller {
	/**
	 * 活动列表*
	 */
	public function actionActivity_list() {
		$this->setauth (); // 检查有无权限
		if ($_POST) {
			$ids = implode ( '\',\'', $_POST ['ids'] );
			
			$count = VcosActivity::model ()->deleteAll ( "activity_id in('$ids')" );
			// $count1 = VcosActivityCategory::model()->deleteAll("activity_id in('$ids')");
			$count2 = VcosActivityProduct::model ()->deleteAll ( "activity_id in('$ids')" );
			$sql = "DELETE FROM `vcos_activity_product` WHERE product_id in ('$ids') AND product_type=4";
			Yii::app ()->p_db->createCommand ( $sql )->execute ();
			if ($count > 0) {
				Helper::show_message ( yii::t ( 'vcos', '删除成功。' ), Yii::app ()->createUrl ( "Activity/activity_list" ) );
			} else {
				Helper::show_message ( yii::t ( 'vcos', '删除失败。' ) );
			}
		}
		if (isset ( $_GET ['id'] )) {
			$did = $_GET ['id'];
			
			$count = VcosActivity::model ()->deleteByPk ( $did );
			// $count1 = VcosActivityCategory::model()->deleteAll("activity_id in($did)");
			$count2 = VcosActivityProduct::model ()->deleteAll ( "activity_id in($did)" );
			$sql = "DELETE FROM `vcos_activity_product` WHERE product_id ='{$did}' AND product_type=4";
			Yii::app ()->p_db->createCommand ( $sql )->execute ();
			
			if ($count > 0) {
				Helper::show_message ( yii::t ( 'vcos', '删除成功。' ), Yii::app ()->createUrl ( "Activity/activity_list" ) );
			} else {
				Helper::show_message ( yii::t ( 'vcos', '删除失败。' ) );
			}
		}
		$count_sql = "SELECT count(*) count FROM `vcos_activity`  WHERE is_nav=0";
		$count = Yii::app ()->p_db->createCommand ( $count_sql )->queryRow ();
		$criteria = new CDbCriteria ();
		$count = $count ['count'];
		$pager = new CPagination ( $count );
		$pager->pageSize = 10;
		$pager->applyLimit ( $criteria );
		$sql = "SELECT * FROM `vcos_activity`  WHERE is_nav=0
		LIMIT {$criteria->offset}, 10";
		$activity = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		$this->render ( 'activity_list', array (
				'pages' => $pager,
				'auth' => $this->auth,
				'activity' => $activity 
		) );
	}
	
	/**
	 * 活动添加*
	 */
	public function actionActivity_add() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = new VcosActivity ();
		if ($_POST) {
			$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : '';
			$desc = isset ( $_POST ['desc'] ) ? $_POST ['desc'] : '';
			$time = explode ( " - ", $_POST ['time'] );
			$s_time = $time [0] . ' ' . $_POST ['stime'];
			$e_time = $time [1] . ' ' . $_POST ['etime'];
			$stime = date ( 'Y/m/d H:i:s', strtotime ( $s_time ) );
			$etime = date ( 'Y/m/d H:i:s', strtotime ( $e_time ) );
			$photo = '';
			if ($_FILES ['photo'] ['error'] != 4) {
				$result = Helper::upload_file ( 'photo', Yii::app ()->params ['img_save_url'] . 'activity_images/' . Yii::app ()->params ['month'], 'image', 3 );
				$photo = $result ['filename'];
			}
			$photo_url = 'activity_images/' . Yii::app ()->params ['month'] . '/' . $photo;
			$state = isset ( $_POST ['state'] ) ? $_POST ['state'] : '0';
			// $show = isset($_POST['show'])?$_POST['show']:'0';
			$show_head = isset ( $_POST ['show_head'] ) ? $_POST ['show_head'] : '0';
			$create_times = date ( "Y/m/d H:i:s", time () );
			$cruise_id = Yii::app ()->params ['cruise_id'];
			$this_user_id = Yii::app ()->user->id;
			$this_user_name = Yii::app ()->user->name;
			// 事务处理
			$transaction = $p_db->beginTransaction ();
			try {
				$activity->activity_name = $name;
				$activity->activity_desc = $desc;
				$activity->activity_img = $photo_url;
				$activity->start_time = $stime;
				$activity->end_time = $etime;
				$activity->status = $state;
				$activity->created = $create_times;
				$activity->creator = $this_user_name;
				$activity->creator_id = $this_user_id;
				// $activity->is_show_category = $show;
				$activity->is_show_head = $show_head;
				$activity->cruise_id = $cruise_id;
				$activity->save ();
				$transaction->commit ();
				Helper::show_message ( yii::t ( 'vcos', '添加成功。' ), Yii::app ()->createUrl ( "Activity/activity_list" ) );
			} catch ( Exception $e ) {
				$transaction->rollBack ();
				Helper::show_message ( yii::t ( 'vcos', '添加失败。' ), '#' );
			}
		}
		
		$this->render ( 'activity_add', array (
				'activity' => $activity 
		) );
	}
	
	/**
	 * 活动编辑*
	 */
	public function actionActivity_edit() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$id = $_GET ['id'];
		$activity = VcosActivity::model ()->findByPk ( $id );
		if ($_POST) {
			$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : '';
			$desc = isset ( $_POST ['desc'] ) ? $_POST ['desc'] : '';
			$time = explode ( " - ", $_POST ['time'] );
			$s_time = $time [0] . ' ' . $_POST ['stime'];
			$e_time = $time [1] . ' ' . $_POST ['etime'];
			$stime = date ( 'Y-m-d H:i:s', strtotime ( $s_time ) );
			$etime = date ( 'Y-m-d H:i:s', strtotime ( $e_time ) );
			$photo = '';
			if ($_FILES ['photo'] ['error'] != 4) {
				$result = Helper::upload_file ( 'photo', Yii::app ()->params ['img_save_url'] . 'activity_images/' . Yii::app ()->params ['month'], 'image', 3 );
				$photo = $result ['filename'];
			}
			$photo_url = 'activity_images/' . Yii::app ()->params ['month'] . '/' . $photo;
			$state = isset ( $_POST ['state'] ) ? $_POST ['state'] : '0';
			// $show = isset($_POST['show'])?$_POST['show']:'0';
			$show_head = isset ( $_POST ['show_head'] ) ? $_POST ['show_head'] : '0';
			$create_times = date ( "Y-m-d H:i:s", time () );
			$cruise_id = Yii::app ()->params ['cruise_id'];
			$this_user_id = Yii::app ()->user->id;
			$this_user_name = Yii::app ()->user->name;
			
			// 事务处理
			$transaction = $p_db->beginTransaction ();
			try {
				$activity->activity_name = $name;
				$activity->activity_desc = $desc;
				$activity->start_time = $stime;
				$activity->end_time = $etime;
				$activity->status = $state;
				$activity->created = $create_times;
				$activity->creator = $this_user_name;
				$activity->creator_id = $this_user_id;
				// $activity->is_show_category = $show;
				$activity->is_show_head = $show_head;
				$activity->cruise_id = $cruise_id;
				if ($photo) {
					$activity->activity_img = $photo_url;
				}
				$activity->save ();
				// 修改活动商品是否过期
				if ($state == 0) {
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE activity_id='{$id}' AND product_type=6";
					$p_db->createCommand ( $sql )->execute ();
					$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$id}' AND product_type=4";
					$p_db->createCommand ( $sql )->execute ();
				} else {
					if ($stime <= $create_times && $etime >= $create_times) {
						$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_id='{$id}' AND product_type=4";
						$p_db->createCommand ( $sql )->execute ();
						$sql = "SELECT product_id,start_show_time,end_show_time FROM `vcos_activity_product` WHERE activity_id='{$id}' AND product_type=6";
						$data = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
						if ($data) {
							foreach ( $data as $row ) {
								$sql = "SELECT sale_start_time s_time,sale_end_time e_time,status FROM `vcos_product` WHERE product_id='{$row['product_id']}'";
								$this_data = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
								if ($this_data ['status'] == 0) {
									$flag = 1;
								} else {
									if ($row ['start_show_time'] <= $create_times && $row ['end_show_time'] >= $create_times) {
										if ($this_data ['s_time'] <= $create_times && $this_data ['e_time'] >= $create_times) {
											if ($row ['start_show_time'] >= $this_data ['s_time'] && $row ['end_show_time'] <= $this_data ['e_time']) {
												$flag = 0;
											} else {
												$flag = 1;
											}
										} else {
											$flag = 1;
										}
									} else {
										$flag = 1;
									}
								}
								if ($flag == 1) {
									$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$row['product_id']}' AND activity_id='{$id}' AND product_type=6";
								} else if ($flag == 0) {
									$sql = "UPDATE `vcos_activity_product` SET is_overdue=0 WHERE product_id='{$row['product_id']}' AND activity_id='{$id}' AND product_type=6";
								}
								$p_db->createCommand ( $sql )->execute ();
							}
						}
					} else {
						$sql = "UPDATE `vcos_activity_product` SET is_overdue=1 WHERE product_id='{$id}' AND product_type=4";
						$p_db->createCommand ( $sql )->execute ();
					}
				}
				$transaction->commit ();
				Helper::show_message ( yii::t ( 'vcos', '修改成功。' ), Yii::app ()->createUrl ( "Activity/activity_list" ) );
			} catch ( Exception $e ) {
				$transaction->rollBack ();
				Helper::show_message ( yii::t ( 'vcos', '修改失败。' ) );
			}
		}
		$this->render ( 'activity_edit', array (
				'activity' => $activity 
		) );
	}
	
	/**
	 * 活动分类列表*
	 */
	public function actionActivity_category_list() {
		$this->setauth (); // 检查有无权限
		if ($_POST) {
			$ids = implode ( '\',\'', $_POST ['ids'] );
			$count = VcosActivityCategory::model ()->deleteAll ( "activity_cid in('$ids')" );
			if ($count > 0) {
				Helper::show_message ( yii::t ( 'vcos', '删除成功。' ), Yii::app ()->createUrl ( "Activity/activity_category_list" ) );
			} else {
				Helper::show_message ( yii::t ( 'vcos', '删除失败。' ) );
			}
		}
		if (isset ( $_GET ['id'] )) {
			$did = $_GET ['id'];
			$count = VcosActivityCategory::model ()->deleteByPk ( $did );
			if ($count > 0) {
				Helper::show_message ( yii::t ( 'vcos', '删除成功。' ), Yii::app ()->createUrl ( "Activity/activity_category_list" ) );
			} else {
				Helper::show_message ( yii::t ( 'vcos', '删除失败。' ) );
			}
		}
		if (isset ( $_GET ['activity'] )) {
			$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE  activity_id=" . $_GET ['activity'];
			$activity_first = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
		} else {
			$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1 LIMIT 1";
			$activity_first = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
		}
		$activity_but = $activity_first ['activity_id'];
		
		$activity_id = isset ( $_GET ['activity'] ) ? $_GET ['activity'] : $activity_first ['activity_id'];
		
		$activity_but = $activity_id;
		
		$count_sql = "SELECT count(*) count FROM `vcos_activity_category` a
		LEFT JOIN `vcos_activity` b ON a.activity_id = b.activity_id 
		WHERE b.status=1 AND a.activity_id=" . $activity_id;
		$count = Yii::app ()->p_db->createCommand ( $count_sql )->queryRow ();
		$criteria = new CDbCriteria ();
		$count = $count ['count'];
		$pager = new CPagination ( $count );
		$pager->pageSize = 10;
		$pager->applyLimit ( $criteria );
		$sql = "SELECT a.*,b.activity_name FROM `vcos_activity_category` a
		LEFT JOIN `vcos_activity` b ON a.activity_id = b.activity_id 
		WHERE  b.status=1 AND a.activity_id=" . $activity_id . " 
		LIMIT {$criteria->offset}, 10";
		$activity_category = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity`";
		$activity_sel = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		$this->render ( 'activity_category_list', array (
				'activity_but' => $activity_but,
				'activity_sel' => $activity_sel,
				'pages' => $pager,
				'auth' => $this->auth,
				'activity_category' => $activity_category 
		) );
	}
	
	/**
	 * 添加活动分类*
	 */
	public function actionActivity_category_add() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity_category = new VcosActivityCategory ();
		if ($_POST) {
			$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
			$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : '';
			$sort = isset ( $_POST ['sort'] ) ? $_POST ['sort'] : '';
			$state = isset ( $_POST ['state'] ) ? $_POST ['state'] : '0';
			// 事务处理
			$transaction = $p_db->beginTransaction ();
			try {
				$activity_category->activity_id = $activity;
				$activity_category->activity_category_name = $name;
				$activity_category->sort_order = $sort;
				$activity_category->status = $state;
				$activity_category->save ();
				$transaction->commit ();
				Helper::show_message ( yii::t ( 'vcos', '添加成功。' ), Yii::app ()->createUrl ( "Activity/activity_category_list" ) );
			} catch ( Exception $e ) {
				$transaction->rollBack ();
				Helper::show_message ( yii::t ( 'vcos', '添加失败。' ), '#' );
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		$this->render ( 'activity_category_add', array (
				'activity' => $activity,
				'activity_category' => $activity_category 
		) );
	}
	
	/**
	 * 编辑活动分类*
	 */
	public function actionActivity_category_edit() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$id = $_GET ['id'];
		$activity_category = VcosActivityCategory::model ()->findByPk ( $id );
		if ($_POST) {
			$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
			$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : '';
			$sort = isset ( $_POST ['sort'] ) ? $_POST ['sort'] : '';
			$state = isset ( $_POST ['state'] ) ? $_POST ['state'] : '0';
			
			// 事务处理
			$transaction = $p_db->beginTransaction ();
			try {
				$activity_category->activity_id = $activity;
				$activity_category->activity_category_name = $name;
				$activity_category->sort_order = $sort;
				$activity_category->status = $state;
				$activity_category->save ();
				$transaction->commit ();
				Helper::show_message ( yii::t ( 'vcos', '修改成功。' ), Yii::app ()->createUrl ( "Activity/activity_category_list" ) );
			} catch ( Exception $e ) {
				$transaction->rollBack ();
				Helper::show_message ( yii::t ( 'vcos', '修改失败。' ) );
			}
		}
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
		$activity = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		$this->render ( 'activity_category_edit', array (
				'activity_category' => $activity_category,
				'activity' => $activity 
		) );
	}
	
	/**
	 * 活动商品列表*
	 */
	public function actionActivity_product_list() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE is_nav=0 AND status=1";
		$activity_sel = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		$activity = isset ( $_GET ['activity'] ) ? $_GET ['activity'] : $activity_sel [0] ['activity_id'];
		$sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0 AND status=1";
		$layer_1 = $p_db->createCommand ( $sql )->queryAll ();
		// $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code']." AND status=1";
		$sql = "SELECT count(*) count FROM `vcos_product`";
		$product_count = $p_db->createCommand ( $sql )->queryRow ();
		$product_count = ( int ) ceil ( $product_count ['count'] / 10 );
		$sql = "SELECT product_id,product_name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` LIMIT 0,10";
		$product_data = $p_db->createCommand ( $sql )->queryAll ();
		$product_arr = '';
		foreach ( $product_data as $row ) {
			$product_arr .= $row ['product_id'] . ',';
		}
		$product_arr = trim ( $product_arr, ',' );
		// 选中
		$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND a.is_overdue!=2";
		$activity_count = $p_db->createCommand ( $sql )->queryRow ();
		$activity_count = ( int ) ceil ( $activity_count ['count'] / 10 );
		$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue!=2 ORDER BY sort_order LIMIT 0,10";
		$activity_product = $p_db->createCommand ( $sql )->queryAll ();
		
		$sql = "SELECT product_id,sort_order,start_show_time,end_show_time FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6 AND is_overdue!=2 AND product_id in ({$product_arr})";
		$all_exites_already = $p_db->createCommand ( $sql )->queryAll ();
		// 回收站
		$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND a.is_overdue=2";
		$del_count = $p_db->createCommand ( $sql )->queryRow ();
		$del_count = ( int ) ceil ( $del_count ['count'] / 10 );
		$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 ORDER BY sort_order LIMIT 0,10";
		$del_product = $p_db->createCommand ( $sql )->queryAll ();
		$this->render ( 'activity_product_list', array (
				'all_exites_already' => $all_exites_already,
				'all_page' => 1,
				'del_page' => 1,
				'already_page' => 1,
				'activity' => $activity,
				'activity_count' => $activity_count,
				'activity_product' => $activity_product,
				'product_data' => $product_data,
				'product_count' => $product_count,
				'layer_1' => $layer_1,
				'activity_sel' => $activity_sel,
				'del_count' => $del_count,
				'del_product' => $del_product 
		) );
	}
	
	/**
	 * 活动商品详情：根据值判断获取商品
	 * act=1:全部商品
	 * act=2:二级全部商品
	 * act=3：三级全部商品
	 * act=4:指定某个分类下的商品
	 *
	 * op=1:全部商品
	 * op=2:已经选中商品
	 * op=3:回收站
	 * *
	 */
	public function actionSetCategoryGetProduct() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$act = isset ( $_GET ['act'] ) ? $_GET ['act'] : 1;
		$code = isset ( $_GET ['code'] ) ? $_GET ['code'] : 0;
		$op = isset ( $_GET ['op'] ) ? $_GET ['op'] : 1;
		$activity = isset ( $_GET ['activity'] ) ? $_GET ['activity'] : 0;
		$pag = isset ( $_GET ['pag'] ) ? $_GET ['pag'] == 1 ? 0 : ($_GET ['pag'] - 1) * 10 : 0;
		/*
		 * $cat1 = isset($_GET['cat1'])?$_GET['cat1']:0;
		 * $cat2 = isset($_GET['cat2'])?$_GET['cat2']:0;
		 * $cat3 = isset($_GET['cat3'])?$_GET['cat3']:0;
		 */
		$already_data = '';
		if ($op == 1) {
			if ($act == 1) {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_product`";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT product_id,product_name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			} else {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_product` WHERE  category_code like '{$code}%'";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT product_id,product_name,status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE  category_code like '{$code}%' LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			}
			$sql = "SELECT product_id,sort_order,start_show_time,end_show_time,is_overdue FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6 AND is_overdue!=2";
			$already_data = $p_db->createCommand ( $sql )->queryAll ();
			if ($data) {
				$data_all = array ();
				$data_all ['count'] = $count;
				$data_all ['data'] = $data;
				$data_all ['already'] = $already_data;
				echo json_encode ( $data_all );
			} else {
				echo 0;
			}
		} else if ($op == 2) {
			if ($act == 1) {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue!=2";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue!=2 ORDER BY sort_order  LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			} else {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id  WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue!=2  AND b.category_code like '{$code}%'";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id  WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue!=2 AND  b.category_code like '{$code}%' ORDER BY sort_order LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			}
			if ($data) {
				$data_all = array ();
				$data_all ['count'] = $count;
				$data_all ['data'] = $data;
				echo json_encode ( $data_all );
			} else {
				echo 0;
			}
		} else if ($op == 3) {
			if ($act == 1) {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND a.is_overdue=2";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND a.is_overdue=2 ORDER BY sort_order  LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			} else {
				// 事务处理
				$transaction = $p_db->beginTransaction ();
				try {
					$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id  WHERE a.activity_id='{$activity}' AND a.product_type=6 AND a.is_overdue=2  AND b.category_code like '{$code}%'";
					$count = $p_db->createCommand ( $sql )->queryRow ();
					$count = ( int ) ceil ( $count ['count'] / 10 );
					$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id  WHERE a.activity_id='{$activity}' AND a.product_type=6 AND a.is_overdue=2 AND   b.category_code like '{$code}%' ORDER BY sort_order LIMIT {$pag},10";
					$data = $p_db->createCommand ( $sql )->queryAll ();
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollBack ();
				}
			}
			if ($data) {
				$data_all = array ();
				$data_all ['count'] = $count;
				$data_all ['data'] = $data;
				echo json_encode ( $data_all );
			} else {
				echo 0;
			}
		}
	}
	
	/**
	 * 活动商品全部页面提交记录*
	 */
	public function actionUpdateProductActivityData() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
		$un_ids = isset ( $_POST ['un_ids'] ) ? $_POST ['un_ids'] : '';
		$ids = isset ( $_POST ['ids'] ) ? trim ( $_POST ['ids'], ',' ) : '';
		$sorts = isset ( $_POST ['sorts'] ) ? trim ( $_POST ['sorts'], ',' ) : '';
		$s_times = isset ( $_POST ['s_times'] ) ? trim ( $_POST ['s_times'], ',' ) : '';
		$e_times = isset ( $_POST ['e_times'] ) ? trim ( $_POST ['e_times'], ',' ) : '';
		$already_id = array ();
		$time = date ( 'Y-m-d H:i:s', time () );
		/**
		 * 获取该活动的商品id*
		 */
		
		// 事务处理
		$transaction = $p_db->beginTransaction ();
		try {
			$sql = "SELECT id,product_id,is_overdue FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6";
			$product_id = $p_db->createCommand ( $sql )->queryAll ();
			if ($product_id) {
				foreach ( $product_id as $k => $row ) {
					$already_id [$k] = $row ['product_id'];
				}
			}
			
			if ($ids != '') {
				$ids = explode ( ',', $ids );
				$sorts = explode ( ',', $sorts );
				$s_times = explode ( ',', $s_times );
				$e_times = explode ( ',', $e_times );
				for($i = 0; $i < count ( $ids ); $i ++) {
					$sql = "SELECT status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE product_id='{$ids[$i]}'";
					$this_data = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
					if ($this_data ['is_delete'] == 0 && $this_data ['status'] == 1) {
						if (($s_times [$i] <= $time && $e_times [$i] >= $time) || $s_times [$i] > $time) {
							$is = 0;
						} else {
							$is = 1;
						}
					} else {
						$is = 1;
					}
					if (count ( $already_id ) > 0) {
						// 修改+新增
						if (in_array ( $ids [$i], $already_id )) {
							// 修改
							$sql = "UPDATE `vcos_activity_product` SET sort_order='{$sorts[$i]}',start_show_time='{$s_times[$i]}',end_show_time='{$e_times[$i]}',is_overdue='{$is}' WHERE activity_id='{$activity}' AND product_id='{$ids[$i]}' AND product_type=6";
							Yii::app ()->p_db->createCommand ( $sql )->execute ();
						} else {
							// 新增
							$sql = "INSERT INTO `vcos_activity_product` (activity_id,product_id,sort_order,start_show_time,end_show_time,product_type,is_overdue) VALUES ('{$activity}','{$ids[$i]}','{$sorts[$i]}','{$s_times[$i]}','{$e_times[$i]}',6,'{$is}')";
							$res = Yii::app ()->p_db->createCommand ( $sql )->execute ();
						}
					} else {
						// 全是新增
						$sql = "INSERT INTO `vcos_activity_product` (activity_id,product_id,sort_order,start_show_time,end_show_time,product_type,is_overdue) VALUES ('{$activity}','{$ids[$i]}','{$sorts[$i]}','{$s_times[$i]}','{$e_times[$i]}',6,'{$is}')";
						Yii::app ()->p_db->createCommand ( $sql )->execute ();
					}
				}
			}
			
			// 删除的记录>判断该记录是否存在选中中，若存在则将is_overdue更改为2 ，加入回收站，否则不操作
			if ($un_ids != '') {
				$un_ids = explode ( ',', $un_ids );
				foreach ( $un_ids as $row ) {
					if (count ( $already_id ) > 0) {
						if (in_array ( $row, $already_id )) {
							$sql = "UPDATE `vcos_activity_product` SET is_overdue=2 WHERE activity_id='{$activity}' AND product_id='{$row}' AND product_type=6";
							Yii::app ()->p_db->createCommand ( $sql )->execute ();
						}
					}
				}
				// $sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_id in ({$un_ids})";
				// Yii::app()->p_db->createCommand($sql)->execute();
			}
			// 选中
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue!=2";
			$already_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$already_count = ( int ) ceil ( $already_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue!=2 ORDER BY sort_order LIMIT 0,10";
			$already = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			// 回收站
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue=2";
			$del_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$del_count = ( int ) ceil ( $del_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue=2 ORDER BY sort_order LIMIT 0,10";
			$del = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			$transaction->commit ();
			$flag = 1;
		} catch ( Exception $e ) {
			$transaction->rollBack ();
			$flag = 0;
		}
		if ($flag == 1) {
			$data_all = array ();
			$data_all ['count'] = $already_count;
			$data_all ['data'] = $already;
			$data_all ['del_count'] = $del_count;
			$data_all ['del_data'] = $del;
			echo json_encode ( $data_all );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品页面：回收站中删除商品选择恢复该商品*
	 */
	public function actionRecoveryActivityProductData() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
		$ids = isset ( $_POST ['ids'] ) ? trim ( $_POST ['ids'], ',' ) : '';
		$time = date ( 'Y-m-d H:i:s', time () );
		$ids = explode ( ',', $ids );
		// 事务处理
		$transaction = $p_db->beginTransaction ();
		try {
			foreach ( $ids as $row ) {
				$sql = "SELECT product_id,start_show_time,end_show_time FROM `vcos_activity_product` WHERE id='{$row}'";
				$this_data = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
				$sql = "SELECT sale_start_time,sale_end_time,status,is_rubbish FROM `vcos_product` WHERE product_id='{$this_data['product_id']}'";
				$this_product = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
				if ($this_product ['status'] == 0) {
					$status = 1;
				} else {
					if ($this_product ['is_rubbish'] == 1) {
						$status = 1;
					} else {
						if ($this_product ['sale_start_time'] <= $this_data ['start_show_time'] && $this_product ['sale_end_time'] >= $this_data ['end_show_time']) {
							if ($this_data ['end_show_time'] >= $time) {
								$status = 0;
							} else {
								$status = 1;
							}
						} else {
							$status = 1;
						}
					}
				}
				$sql = "UPDATE `vcos_activity_product` SET is_overdue='{$status}' WHERE id='{$row}'";
				Yii::app ()->p_db->createCommand ( $sql )->execute ();
			}
			// 选中商品
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue!=2";
			$already_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$already_count = ( int ) ceil ( $already_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue!=2 ORDER BY sort_order  LIMIT 0,10";
			$already = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			// 回收站商品
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue=2";
			$del_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$del_count = ( int ) ceil ( $del_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue=2 ORDER BY sort_order  LIMIT 0,10";
			$del = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			
			$transaction->commit ();
			$flag = 1;
		} catch ( Exception $e ) {
			$transaction->rollBack ();
			$flag = 0;
		}
		
		if ($flag == 1) {
			$data_all = array ();
			$data_all ['count'] = $already_count;
			$data_all ['data'] = $already;
			$data_all ['del_count'] = $del_count;
			$data_all ['del_data'] = $del;
			echo json_encode ( $data_all );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品已选中修改记录*
	 */
	public function actionUpdateActivityProductAlreadyData() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
		$ids = isset ( $_POST ['ids'] ) ? trim ( $_POST ['ids'], ',' ) : '';
		$sorts = isset ( $_POST ['sorts'] ) ? trim ( $_POST ['sorts'], ',' ) : '';
		$s_times = isset ( $_POST ['s_times'] ) ? trim ( $_POST ['s_times'], ',' ) : '';
		$e_times = isset ( $_POST ['e_times'] ) ? trim ( $_POST ['e_times'], ',' ) : '';
		$ids = explode ( ',', $ids );
		$sorts = explode ( ',', $sorts );
		$s_times = explode ( ',', $s_times );
		$e_times = explode ( ',', $e_times );
		$time = date ( 'Y-m-d H:i:s', time () );
		// 事务处理
		$transaction = $p_db->beginTransaction ();
		try {
			for($i = 0; $i < count ( $ids ); $i ++) {
				$sql = "SELECT product_id FROM `vcos_activity_product` WHERE id='{$ids[$i]}'";
				$p_data = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
				$sql = "SELECT status,sale_start_time s_time,sale_end_time e_time,is_rubbish is_delete FROM `vcos_product` WHERE product_id='{$p_data['product_id']}'";
				$this_data = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
				if ($this_data ['is_delete'] == 0 && $this_data ['status'] == 1) {
					if (($s_times [$i] <= $time && $e_times [$i] >= $time) || $s_times [$i] >= $time) {
						$is = 0;
					} else {
						$is = 1;
					}
				} else {
					$is = 1;
				}
				$sql = "UPDATE `vcos_activity_product` SET sort_order='{$sorts[$i]}',start_show_time='{$s_times[$i]}',end_show_time='{$e_times[$i]}',is_overdue='{$is}' WHERE id='{$ids[$i]}' AND activity_id='{$activity}' AND product_type=6";
				Yii::app ()->p_db->createCommand ( $sql )->execute ();
			}
			$sql = "SELECT id,is_overdue,start_show_time FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6 AND is_overdue!=2";
			$data = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			$transaction->commit ();
			$flag = 1;
		} catch ( Exception $e ) {
			$transaction->rollBack ();
			$flag = 0;
		}
		
		if ($flag == 1) {
			echo json_encode ( $data );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品移除选中*
	 */
	public function actionDelActivityProductAlreadyData() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
		$ids = isset ( $_POST ['ids'] ) ? trim ( $_POST ['ids'], ',' ) : '';
		// 事务处理
		$transaction = $p_db->beginTransaction ();
		try {
			// $sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6 AND id in ({$ids})";
			$sql = "UPDATE `vcos_activity_product` SET is_overdue=2 WHERE activity_id='{$activity}' AND product_type=6 AND id in ({$ids})";
			$res = Yii::app ()->p_db->createCommand ( $sql )->execute ();
			// 选中
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue!=2";
			$already_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$already_count = ( int ) ceil ( $already_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue!=2 ORDER BY sort_order  LIMIT 0,10";
			$already = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			// 回收站
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue=2";
			$del_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$del_count = ( int ) ceil ( $del_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue=2 ORDER BY sort_order  LIMIT 0,10";
			$del = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			$transaction->commit ();
			$flag = 1;
		} catch ( Exception $e ) {
			$transaction->rollBack ();
			$flag = 0;
		}
		if ($flag == 1) {
			$data_all = array ();
			$data_all ['count'] = $already_count;
			$data_all ['data'] = $already;
			$data_all ['del_count'] = $del_count;
			$data_all ['del_data'] = $del;
			
			echo json_encode ( $data_all );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 页面详情配置：回收站清除记录**
	 */
	public function actionReallyDelActivityProductData() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$activity = isset ( $_POST ['activity'] ) ? $_POST ['activity'] : 0;
		$ids = isset ( $_POST ['ids'] ) ? trim ( $_POST ['ids'], ',' ) : '';
		// 事务处理
		$transaction = $p_db->beginTransaction ();
		try {
			$sql = "DELETE FROM `vcos_activity_product` WHERE activity_id='{$activity}' AND product_type=6 AND id in ({$ids})";
			$res = Yii::app ()->p_db->createCommand ( $sql )->execute ();
			$sql = "SELECT count(*) count FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6 AND is_overdue=2";
			$del_count = Yii::app ()->p_db->createCommand ( $sql )->queryRow ();
			$del_count = ( int ) ceil ( $del_count ['count'] / 10 );
			$sql = "SELECT a.*,b.product_name,b.status,b.sale_start_time s_time,b.sale_end_time e_time,b.is_rubbish is_delete FROM `vcos_activity_product` a LEFT JOIN `vcos_product` b ON a.product_id=b.product_id WHERE a.activity_id='{$activity}' AND a.product_type=6  AND is_overdue=2 ORDER BY sort_order  LIMIT 0,10";
			$del = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
			$transaction->commit ();
			$flag = 1;
		} catch ( Exception $e ) {
			$transaction->rollBack ();
			$flag = 0;
		}
		if ($flag == 1) {
			$data_all = array ();
			$data_all ['del_count'] = $del_count;
			$data_all ['del_data'] = $del;
			
			echo json_encode ( $data_all );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品添加*
	 */
	/*
	 * public function actionActivity_product_add(){
	 * $this->setauth();//检查有无权限
	 * $p_db = Yii::app()->p_db;
	 * $activity_product = new VcosActivityProduct();
	 * if($_POST){
	 * $activicty = isset($_POST['activity'])?$_POST['activity']:0;
	 * $product = isset($_POST['product'])?$_POST['product']:0;
	 * $shop = isset($_POST['shop'])?$_POST['shop']:0;
	 * $activity_child = isset($_POST['activity_child'])?$_POST['activity_child']:0;
	 * $activity_category = isset($_POST['activity_category'])?$_POST['activity_category']:0;
	 * $sort = isset($_POST['sort'])?$_POST['sort']:'';
	 * $product_type = isset($_POST['product_type'])?$_POST['product_type']:0;
	 * if($product_type == 3){
	 * $product_shop = $shop;
	 * $activity_category = '';
	 * }elseif($product_type ==6){
	 * $product_shop = $product;
	 * $activity_category = $activity_category;
	 * }elseif($product_type == 4){
	 * $product_shop = $activity_child;
	 * $activity_category = '';
	 * }
	 * $time = explode(" - ", $_POST['time']);
	 * $s_time = $time[0] . ' ' . $_POST['stime'];
	 * $e_time = $time[1] . ' ' . $_POST['etime'];
	 * $stime = date('Y/m/d H:i:s',strtotime($s_time));
	 * $etime = date('Y/m/d H:i:s',strtotime($e_time));
	 *
	 * //事务处理
	 * $transaction=$p_db->beginTransaction();
	 * try{
	 * $activity_product->activity_id = $activicty;
	 * $activity_product->product_id = $product_shop;
	 * $activity_product->activity_cid = $activity_category;
	 * $activity_product->sort_order = $sort;
	 * $activity_product->start_show_time = $stime;
	 * $activity_product->end_show_time = $etime;
	 * $activity_product->product_type = $product_type;
	 * $activity_product->save();
	 * $transaction->commit();
	 * Helper::show_message(yii::t('vcos', '添加成功。'), Yii::app()->createUrl("Activity/activity_product_list"));
	 *
	 * }catch(Exception $e){
	 * $transaction->rollBack();
	 * Helper::show_message(yii::t('vcos', '添加失败。'), '#');
	 * }
	 * }
	 * //事务处理
	 * $transaction=$p_db->beginTransaction();
	 * try{
	 * $sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1 AND is_nav=0";
	 * $activity = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
	 * $layer_1 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
	 * $layer_2 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
	 * $layer_3 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code']." ORDER BY category_code DESC LIMIT 5";
	 * $product = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT count(*) count FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code'];
	 * $product_count = Yii::app()->p_db->createCommand($sql)->queryRow();
	 * $product_count = (int)ceil($product_count['count']/10);
	 * $transaction->commit();
	 * }catch(Exception $e){
	 * $transaction->rollBack();
	 * }
	 * /*$sql = "SELECT activity_cid,activity_category_name FROM `vcos_activity_category` WHERE status=1 AND activity_id = ".$activity[0]['activity_id'];
	 * $activity_category = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT shop_id,shop_title FROM `vcos_shop` ";
	 * $shop = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE activity_id !=".$activity[0]['activity_id'];
	 * $activity_child = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $this->render('activity_product_add',array('product_count'=>$product_count,'activity'=>$activity,'product'=>$product,'activity_product'=>$activity_product,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3));
	 * }
	 */
	
	/**
	 * 活动商品添加编辑页面选择商品分页*
	 */
	public function actionGetActivityProductPage() {
		$this->setauth (); // 检查有无权限
		$pag = isset ( $_GET ['pag'] ) ? $_GET ['pag'] == 1 ? 0 : ($_GET ['pag'] - 1) * 5 : 0;
		$category_code = isset ( $_GET ['category_code'] ) ? $_GET ['category_code'] : 0;
		$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1 AND category_code=" . $category_code . " ORDER BY category_code DESC LIMIT {$pag}, 5";
		$product = Yii::app ()->p_db->createCommand ( $sql )->queryAll ();
		if ($product) {
			echo json_encode ( $product );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品编辑*
	 */
	/*
	 * public function actionActivity_product_edit(){
	 * $this->setauth();//检查有无权限
	 * $p_db = Yii::app()->p_db;
	 * $id=$_GET['id'];
	 * $layer_cat = '';
	 * $layer_cat2 = '';
	 * $layer_1 = '';
	 * $layer_2 = '';
	 * $layer_3 = '';
	 * $product_sel = '';
	 * $category_code = '';
	 * $activity_product= VcosActivityProduct::model()->findByPk($id);
	 * if($_POST){
	 * $activicty = isset($_POST['activity'])?$_POST['activity']:0;
	 * $product = isset($_POST['product'])?$_POST['product']:0;
	 * $shop = isset($_POST['shop'])?$_POST['shop']:0;
	 * $activity_child = isset($_POST['activity_child'])?$_POST['activity_child']:0;
	 * $activity_category = isset($_POST['activity_category'])?$_POST['activity_category']:0;
	 * $sort = isset($_POST['sort'])?$_POST['sort']:'';
	 * $product_type = isset($_POST['product_type'])?$_POST['product_type']:0;
	 * $time = explode(" - ", $_POST['time']);
	 * $s_time = $time[0] . ' ' . $_POST['stime'];
	 * $e_time = $time[1] . ' ' . $_POST['etime'];
	 * $stime = date('Y/m/d H:i:s',strtotime($s_time));
	 * $etime = date('Y/m/d H:i:s',strtotime($e_time));
	 * if($product_type == 3){
	 * $product_shop = $shop;
	 * $activity_category = '';
	 * }elseif($product_type ==6){
	 * $product_shop = $product;
	 * $activity_category = $activity_category;
	 * }elseif($product_type == 4){
	 * $product_shop = $activity_child;
	 * $activity_category = '';
	 * }
	 * //事务处理
	 * $transaction=$p_db->beginTransaction();
	 * try{
	 * $activity_product->activity_id = $activicty;
	 * $activity_product->product_id = $product_shop;
	 * $activity_product->activity_cid = $activity_category;
	 * $activity_product->sort_order = $sort;
	 * $activity_product->start_show_time = $stime;
	 * $activity_product->end_show_time = $etime;
	 * $activity_product->product_type = $product_type;
	 * $activity_product->save();
	 * $transaction->commit();
	 * Helper::show_message(yii::t('vcos', '修改成功。'), Yii::app()->createUrl("Activity/activity_product_list"));
	 *
	 * }catch(Exception $e){
	 * $transaction->rollBack();
	 * Helper::show_message(yii::t('vcos', '修改失败。'));
	 * }
	 * }
	 * $sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE status=1";
	 * $activity = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * //$sql = "SELECT product_id,product_name FROM `vcos_product` WHERE status=1";
	 * //$product = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT activity_cid,activity_category_name FROM `vcos_activity_category` WHERE status=1 AND activity_id = ".$activity_product['activity_id'];
	 * $activity_category = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT shop_id,shop_title FROM `vcos_shop` ";
	 * $shop = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE activity_id !=".$activity[0]['activity_id'];
	 * $activity_child = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * if($activity_product['product_type'] == 6){
	 * $sql = "SELECT category_code FROM `vcos_product` WHERE product_id=".$activity_product['product_id'];
	 * $category_code = Yii::app()->p_db->createCommand($sql)->queryRow();
	 * $category_code = $category_code['category_code'];
	 * $sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$category_code;
	 * $layer_cat_2 = $p_db->createCommand($sql)->queryRow();
	 * $sql = "SELECT parent_cid FROM `vcos_category` WHERE category_code =".$layer_cat_2['parent_cid'];
	 * $layer_cat_1 = $p_db->createCommand($sql)->queryRow();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
	 * $layer_1 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_1['parent_cid'];
	 * $layer_2 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_cat_2['parent_cid'];
	 * $layer_3 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$category_code;
	 * $product = $p_db->createCommand($sql)->queryAll();
	 * $layer_cat = $layer_cat_1['parent_cid'];
	 * $layer_cat2 = $layer_cat_2['parent_cid'];
	 * }else{
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=0";
	 * $layer_1 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_1[0]['category_code'];
	 * $layer_2 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT category_code,name,parent_cid FROM `vcos_category` WHERE parent_cid=".$layer_2[0]['category_code'];
	 * $layer_3 = $p_db->createCommand($sql)->queryAll();
	 * $sql = "SELECT product_id,product_name,category_code FROM `vcos_product` WHERE status=1 AND category_code=".$layer_3[0]['category_code'];
	 * $product = Yii::app()->p_db->createCommand($sql)->queryAll();
	 * }
	 * $this->render('activity_product_edit',array('activity_child'=>$activity_child,'shop'=>$shop,'activity'=>$activity,'product'=>$product,'activity_category'=>$activity_category,'activity_product'=>$activity_product,'layer_cat'=>$layer_cat,'layer_cat2'=>$layer_cat2,'layer_1'=>$layer_1,'layer_2'=>$layer_2,'layer_3'=>$layer_3,'category_code'=>$category_code));
	 * }
	 */
	
	/**
	 * 活动商品：获取二级分类*
	 */
	/*
	 * public function actionGetCategoryChild(){
	 * $p_db = Yii::app()->p_db;
	 * $parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
	 * $sql = "SELECT category_code,name FROM `vcos_category` WHERE parent_cid=".$parent_code;
	 * $resutl = $p_db->createCommand($sql)->queryAll();
	 * if($resutl){
	 * echo json_encode($resutl);
	 * } else {
	 * echo 0;
	 * }
	 * }
	 */
	
	/**
	 * 活动商品，三级分类下的商品*
	 */
	/*
	 * public function actionGetCategoryProduct(){
	 * $p_db = Yii::app()->p_db;
	 * $parent_code = isset($_GET['parent_code'])?$_GET['parent_code']:0;
	 * $sql = "SELECT count(*) count FROM `vcos_product` WHERE category_code=".$parent_code." order by category_code DESC";
	 * $resutl_count = $p_db->createCommand($sql)->queryRow();
	 * $resutl_count = (int)ceil($resutl_count['count']/5);
	 * $sql = "SELECT product_id,product_name FROM `vcos_product` WHERE category_code=".$parent_code." order by category_code DESC limit 5";
	 * $resutl = $p_db->createCommand($sql)->queryAll();
	 * if($resutl){
	 * $data = array();
	 * $data['count'] = $resutl_count;
	 * $data['data'] = $resutl;
	 * echo json_encode($data);
	 * } else {
	 * echo 0;
	 * }
	 * }
	 */
	
	/**
	 * 活动商品，除本活动下的其他活动*
	 */
	public function actionGetActivityChild() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$parent_id = isset ( $_GET ['parent_id'] ) ? $_GET ['parent_id'] : 0;
		$sql = "SELECT activity_id,activity_name FROM `vcos_activity` WHERE activity_id!=" . $parent_id;
		$resutl = $p_db->createCommand ( $sql )->queryAll ();
		if ($resutl) {
			echo json_encode ( $resutl );
		} else {
			echo 0;
		}
	}
	
	/**
	 * 活动商品，根据活动查询该活动下的分类*
	 */
	public function actionGetActivityCategory() {
		$this->setauth (); // 检查有无权限
		$p_db = Yii::app ()->p_db;
		$parent_id = isset ( $_GET ['parent_id'] ) ? $_GET ['parent_id'] : 0;
		$sql = "SELECT activity_cid,activity_category_name FROM `vcos_activity_category` WHERE activity_id=" . $parent_id;
		$resutl = $p_db->createCommand ( $sql )->queryAll ();
		if ($resutl) {
			echo json_encode ( $resutl );
		} else {
			echo 0;
		}
	}
}