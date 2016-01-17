<?php
    $this->pageTitle = Yii::t('vcos','活动商品列表');
    $theme_url = Yii::app()->theme->baseUrl;
    $menu_type = 'activity_product_list';
?>
<link rel="stylesheet"  href="<?php echo $theme_url; ?>/assets/css/jquery.datetimepicker.css" />             

<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
   /* if(in_array('321', $auth) || $auth[0] == '0'){
        $canadd = TRUE;
    }  else {
        $canadd = False;
    }
    if(in_array('322', $auth) || $auth[0] == '0'){
        $canedit = TRUE;
    }  else {
        $canedit = False;
    }
    if(in_array('323', $auth) || $auth[0] == '0'){
        $candelete = TRUE;
    }  else {
        $candelete = FALSE;
    }*/
?>
<div class="main-container" id="main-container">
        <script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        <style>
        	
            .table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
            .table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
            .table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
            table{width:98%;margin:20px auto 0px;border-collapse:collapse;border:1px solid #ccc}
            table thead tr td{text-align:center;height:30px;background:#B0E0E6;}
    		table tbody tr td{padding-top:10px;padding-bottom:5px;text-align:center;}
    		table tbody tr{border-bottom:1px dashed #ccc;}	
	   </style>

        <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                        <span class="menu-text"></span>
                </a>
                <?php
                //菜单挂件
                 $this->widget('menuWidget', array('menu_type'=>$menu_type));
                ?>
                <div class="main-content"> 
                    <?php
                        //面包屑挂件
                        $this->widget('breadcrumbWidget');
                    ?>
                    <div class="page-content">
                        <div class="page-header">
                            <h1>
                                <?php echo yii::t('vcos', '活动管理')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '活动商品列表')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                            
                             <div class="table-responsive">
                               <style>
	                             .list_select_option{margin-bottom:10px;}
	                             .city_sel{margin-left:20px;width:250px;}
                               </style>
                               <div class="list_select_option">
                                  <label><?php echo yii::t('vcos', '请选择活动')?>:</label>
                                  <select class='city_sel' name='activity_all_sel'>
                                  <?php foreach($activity_sel as $row){
                                  	$url = Yii::app()->createUrl("Activity/activity_product_list",array('activity'=>$row['activity_id']));
                                  ?>
                                     <option url="<?php echo $url;?>" <?php if($row['activity_id']==$activity){echo "selected='selected'";}?> value="<?php echo $row['activity_id']?>"><?php echo $row['activity_name']?></option>
                                     <?php }?>
                                  </select>
                               </div>
                               <input type="hidden" id="all_page_num" value="<?php echo $all_page;?>"/>
                               <input type="hidden" id="already_page_num" value="<?php echo $already_page;?>" />
                               <input type="hidden" id="del_page_num" value="<?php echo $del_page;?>" />
                               <div class="table_switch"><span val='0'>选中</span><span val='1' class='myself_current' >全部</span><span val='2'>回收站</span></div>
                               
                               <div class="row hidden" id="already_checked_div" >
                               <select class="cat1" style="margin-left:1%;width:15%;">
                               	<option value='0'>全部</option>
                               	<?php foreach ($layer_1 as $row){?>
                               		<option value='<?php echo $row["category_code"];?>'><?php echo $row['name']?></option>
                               	<?php }?>
                               	</select>
                               	<select class="cat2 hidden" style="width:15%">
                               	<option value='0'>全部</option>
                               	</select>
                               	<select class="cat3 hidden" style="width:15%;">
                               	<option value='0'>全部</option>
                               	</select>
                               	<input type="button" class="submit_but" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                    <table class="already_checked_table">
                                    	<thead>
                                    	<tr>
	                                    	<td width="5%">
	                                    	<label>
	                                            <input type="checkbox" class="ace" />
	                                            <span class="lbl"></span>
	                                        </label>
	                                    	</td>
	                                    	<td width="30%">商品名</td>
	                                    	<td width="3%">排序</td>
	                                    	<td width="15%">活动显示开始时间</td>
	                                    	<td width="15%">活动显示结束时间</td>
	                                    	<td width="22%">商品上下架时间</td>
	                                    	<td width="5%">状态</td>
                                    	</tr>
                                    	</thead>
                                    	<tbody>
                                    	<?php $time = date('Y-m-d H:i:s',time()); 
                                    		foreach($activity_product as $row){
                                    			if ($row['status']==1 && $row['is_delete']==0){
                                    				if($row['s_time']<=$row['start_show_time'] && $row['e_time']>=$row['end_show_time']){
                                    					if($row['start_show_time']<=$time && $row['end_show_time']>=$time){
                                    						$is = "未过期";
                                    					}else if($row['start_show_time']>=$time){
                                    						$is = "未上架";
                                    					}else{
                                    						$is = "已过期";
                                    					}
                                    				}else{
                                    					$is = "已过期";
                                    				}
                                    			}else{
                                    				$is = "已过期";
                                    			}
                                    		
                                    		?>
                                    	<tr>
                                    		<td>
                                    		<label>
                                               <input type="checkbox" name="ids[]" p_id="<?php echo $row['product_id']?>" value="<?php echo $row['id']?>" class="ace isclick" />
                                               <span class="lbl"></span>
                                            </label>
                                    		</td>
                                    		<td style="text-align:center;"><?php echo $row['product_name']?></td>
                                    		<td><input type='text'  style='width:40px;' onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  value='<?php echo $row["sort_order"]?>' maxlength='10' class='sort' /></td>
                                    		<td><input type="text" s_time="<?php echo $row['s_time']?>" readonly='readonly' value="<?php echo substr($row['start_show_time'],0, -3)?>" class="datetimepicker_res" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                    		<td><input type="text" e_time="<?php echo $row['e_time']?>" readonly='readonly' value="<?php echo substr($row['end_show_time'],0, -3)?>" class="datetimepicker_ree" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                    		<?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                    		<td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>
                                    		
                                    		<td overdue="<?php echo $row['is_overdue'];?>"><?php echo $is;?></td>
                                    	</tr>
                                    	<?php }?>
                                    	</tbody>
                                    </table>  
                                    <div class="already_update_but" style="margin:5px 10px 0px 0px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">修改记录</div>
                                    <div class="already_del_but" style="margin:5px 10px 0px 0px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">移除选中</div>
                                    <div class="center" id="page_already_div"> </div>    
                               </div><!-- /row -->
                               
                               <div class="row" id="all_product_div" >
                               	<select class="cat1" style="margin-left:1%;width:15%;">
                               	<option value='0'>全部</option>
                               	<?php foreach ($layer_1 as $row){?>
                               		<option value='<?php echo $row["category_code"];?>'><?php echo $row['name']?></option>
                               	<?php }?>
                               	</select>
                               	<select class="cat2 hidden" style="width:15%">
                               	<option value='0'>全部</option>
                               	</select>
                               	<select class="cat3 hidden" style="width:15%;">
                               	<option value='0'>全部</option>
                               	</select>
                               	<input type="button" class="submit_but" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                    <table class="all_product_table">
                                    	<thead>
                                    	<tr>
	                                    	<td width="5%">
	                                    	<label>
	                                            <input type="checkbox" class="ace" />
	                                            <span class="lbl"></span>
	                                        </label>
	                                    	</td>
	                                    	<td width="30%">商品名</td>
	                                    	<td width="3%">排序</td>
	                                    	<td width="15%">活动显示开始时间</td>
	                                    	<td width="15%">活动显示结束时间</td>
	                                    	<td width="22%">商品上下架时间</td>
	                                    	<td width="5%">状态</td>
                                    	</tr>
                                    	</thead>
                                    	<tbody>
                                    	<!-- 全部商品的状态,只针对商品本身，不针对选中的商品活动时间 -->
                                    	<?php $alreay_arr= array();$alreay_arr_sort= array();$alreay_arr_stime= array();$alreay_arr_etime= array(); if(count($activity_product)>0){
                                    		foreach ($all_exites_already as $k=>$row){
                                    			$alreay_arr[$k] = $row['product_id'];
                                    			$alreay_arr_sort[$row['product_id']] = $row['sort_order'];
                                    			$alreay_arr_stime[$row['product_id']] = $row['start_show_time'];
                                    			$alreay_arr_etime[$row['product_id']] = $row['end_show_time'];
                                    			
                                    	}}?>
                                    	<?php if(count($product_data)>0)
                                    		$time = date('Y-m-d H:i:s',time());
                                    		foreach($product_data as $row){
                                    			if ($row['status']==1 && $row['is_delete']==0){
                                    				if($row['s_time']<=$time && $row['e_time']>=$time){
                                    					$is = "未过期";
                                    				}else if($row['s_time']>=$time){
                                    					$is = "未上架";
                                    				}else{
                                    					$is = "已过期";
                                    				}
                                    			}else{
                                    				$is = "已过期";
                                    			}
                                    		?>
                                    	<?php if(in_array($row['product_id'], $alreay_arr)){?>
                                    	<tr>
                                    		<td>
                                    		<label>
                                    		
                                               <input type="checkbox" name="ids[]" checked='checked' value="<?php echo $row['product_id']?>" class="ace isclick" />
                                               <span class="lbl"></span>
                                            </label>
                                    		</td>
                                    		<td style="text-align:center;"><?php echo $row['product_name']?></td>
                                    		<td><input type='text'  onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  value="<?php echo $alreay_arr_sort[$row['product_id']];?>" style='width:40px;' maxlength='10' class='sort' /></td>
                                    		<td><input type="text" s_time="<?php echo $row['s_time'];?>" value="<?php echo  substr($alreay_arr_stime[$row['product_id']],0,-3);?>" readonly="readonly" value="" class="datetimepicker_s" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                    		<td><input type="text" e_time="<?php echo $row['e_time'];?>" value="<?php echo  substr($alreay_arr_etime[$row['product_id']],0,-3);?>" readonly="readonly" value="" class="datetimepicker_e" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                    		<?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                    		<td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>
                                    		<td><?php echo $is;?></td>
                                    	</tr>
                                    	<?php }else{?>
                                    	<tr>
                                    		<td>
                                    		<label>
                                    		
                                               <input type="checkbox" name="ids[]"  value="<?php echo $row['product_id']?>" class="ace isclick" />
                                               <span class="lbl"></span>
                                            </label>
                                    		</td>
                                    		<td style="text-align:center;"><?php echo $row['product_name']?></td>
                                    		<td><input type='text'  onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  style='width:40px;' maxlength='10' class='sort' /></td>
                                    		<td><input type="text" s_time="<?php echo $row['s_time'];?>" readonly="readonly" value="" class="datetimepicker_s" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                    		<td><input type="text" e_time="<?php echo $row['e_time'];?>" readonly="readonly" value="" class="datetimepicker_e" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                    		<?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                    		<td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>
                                    		<td><?php echo $is;?></td>
                                    	</tr>
                                    	<?php }?>
                                    	
                                    	<?php }?>
                                    	</tbody>
                                    </table>  
                                    <div class="product_submit_but" style="margin:5px 10px 0px 0px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">提交</div>
                                    <div class="center" id="page_div"> </div>  
                               </div><!-- /row -->
                               
                               <!-- 回收站 -->
                               <div class="row hidden" id="del_product_div" >
                               <select class="cat1" style="margin-left:1%;width:15%;">
                               	<option value='0'>全部</option>
                               	<?php foreach ($layer_1 as $row){?>
                               		<option value='<?php echo $row["category_code"];?>'><?php echo $row['name']?></option>
                               	<?php }?>
                               	</select>
                               	<select class="cat2 hidden" style="width:15%">
                               	<option value='0'>全部</option>
                               	</select>
                               	<select class="cat3 hidden" style="width:15%;">
                               	<option value='0'>全部</option>
                               	</select>
                               	<input type="button" class="submit_but" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                    <table class="del_product_table">
                                    	<thead>
                                    	<tr>
	                                    	<td width="5%">
	                                    	<label>
	                                            <input type="checkbox" class="ace" />
	                                            <span class="lbl"></span>
	                                        </label>
	                                    	</td>
	                                    	<td width="30%">商品名</td>
	                                    	<td width="3%">排序</td>
	                                    	<td width="15%">活动显示开始时间</td>
	                                    	<td width="15%">活动显示结束时间</td>
	                                    	<td width="22%">商品上下架时间</td>
	                                    	<td width="5%">状态</td>
                                    	</tr>
                                    	</thead>
                                    	<tbody>
                                    	<?php $time = date('Y-m-d H:i:s',time());
                                    	foreach($del_product as $row){
                                    		if ($row['status']==1 && $row['is_delete']==0){
                                    			if($row['s_time']<=$time && $row['e_time']>=$time){
                                    				$is = "未过期";
                                    			}else if($row['s_time']>=$time){
                                    				$is = "未上架";
                                    			}else{
                                    				$is = "已过期";
                                    			}
                                    		}else{
                                    			$is = "已过期";
                                    		}
                                    		?>
                                    	<tr>
                                    		<td>
                                    		<label>
                                               <input type="checkbox" name="ids[]" p_id="<?php echo $row['product_id']?>" value="<?php echo $row['id']?>" class="ace isclick" />
                                               <span class="lbl"></span>
                                            </label>
                                    		</td>
                                    		<td style="text-align:center;"><?php echo $row['product_name']?></td>
                                    		<td><input readonly='readonly' type='text'  style='width:40px;' onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  value='<?php echo $row["sort_order"]?>' maxlength='10' class='sort' /></td>
                                    		<td><input type="text" s_time="<?php echo $row['s_time']?>" readonly='readonly' value="<?php echo substr($row['start_show_time'],0, -3)?>" class="datetimepicker_des" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                    		<td><input type="text" e_time="<?php echo $row['e_time']?>" readonly='readonly' value="<?php echo substr($row['end_show_time'],0, -3)?>" class="datetimepicker_dee" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                    		<?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                    		<td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>
                                    		<td><?php echo $is;?></td>
                                    	</tr>
                                    	<?php }?>
                                    	</tbody>
                                    </table>  
                                    <div class="del_all_but" style="margin:5px 10px 0px 0px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">清除选中</div>
                                    <div class="del_recovery_but" style="margin:5px 10px 0px 0px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">恢复选中</div>
                                    <div class="center" id="page_del_div"> </div>    
                               </div><!-- /row -->
                               
                               
                               
                             </div><!-- /.table-responsive -->
                        </div><!-- /.page-content -->
                </div><!-- /.main-content -->
                
                <!-- /#ace-settings-container start-->
                <?php
                    //设置容器配置挂件
                    $this->widget('settingsContainerWidget');
                ?>
                <!-- /#ace-settings-container end-->
        </div><!-- /.main-container-inner -->
        
        <!-- scrool up widget start-->
        <?php
            $this->widget('scrollUpWidget');
        ?>
        <!-- scrool up widget end-->
        
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jqPaginator.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min_s.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
    	/*var mydate = new Date();
    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
    	var mydate_e = new Date();
    	mydate_e.setMonth(mydate_e.getMonth()+1);
    	var day_e = mydate_e.getFullYear()+'-'+Appendzero(mydate_e.getMonth()+1)+'-'+Appendzero(mydate_e.getDate())+' '+Appendzero(mydate_e.getHours())+':00';
    	*/
    	$('.datetimepicker_s').datetimepicker({step:1});
    	$('.datetimepicker_e').datetimepicker({step:1});
    	$('.datetimepicker_res').datetimepicker({step:1});
    	$('.datetimepicker_ree').datetimepicker({step:1});
    	//$('.datetimepicker_des').datetimepicker({step:1});
    	//$('.datetimepicker_dee').datetimepicker({step:1});
    	   
        $('#all_product_div table thead td input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
        $('#already_checked_div table thead td input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
        $('#del_product_div table thead td input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });

        /**table切换**/
        $(".table_switch > span").click(function(){
        	$(".table_switch > span").removeClass('myself_current');
        	$(this).addClass('myself_current');
        	if($(this).attr('val')==0){
            	$("#already_checked_div").removeClass('hidden');
            	$("#all_product_div").addClass('hidden');
            	$("#del_product_div").addClass('hidden');
            }else if($(this).attr('val')==1){
            	$("#already_checked_div").addClass('hidden');
            	$("#all_product_div").removeClass('hidden');
            	$("#del_product_div").addClass('hidden');
            }else if($(this).attr('val')==2){
            	$("#already_checked_div").addClass('hidden');
            	$("#all_product_div").addClass('hidden');
            	$("#del_product_div").removeClass('hidden');
            }
    	});

    	/**活动改变**/
    	$("select[name='activity_all_sel']").change(function(){
        	var url = $("select[name='activity_all_sel'] option:selected").attr('url');
        	location.href = url;
        });

/***************************全部商品*********************************/
        /**页面加载时触发全部分页**/
		<?php if($product_count >1){?>
			all_page(<?php echo $product_count;?>);
		<?php }?>
		
    	/**改变一级，获取二级**/
    	$("#all_product_div .cat1").change(function(){
    		var this_code = $(this).val();
            if(this_code == 0){
            	$("#all_product_div .cat2").addClass('hidden');
            	$("#all_product_div .cat3").addClass('hidden');
            	return false;
            }
            $("#all_product_div .cat2").removeClass('hidden');
            var str = '';
            var str_ch = '';
            var str_pr = '';
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
            		str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("#all_product_div .cat2").html(str);
            		$("#all_product_div .cat3").addClass('hidden');
            	}        
            });
        });

    	/**改变分类二级,获取三级**/
        $("#all_product_div .cat2").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
            	$("#all_product_div .cat3").addClass('hidden');
            	return false;
            }
            $("#all_product_div .cat3").removeClass('hidden');
            var str = '';
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
            		str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("#all_product_div .cat3").html(str);
            	}      
            });
        });
		/**分类筛选确认查询**/
        $("#all_product_div .submit_but").click(function(){
        	var mydate = new Date();
        	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
        	
            var activity = $("select[name='activity_all_sel']").val();
            var cat1 = $("#all_product_div .cat1").val();
            var cat2 = $("#all_product_div .cat2").val();
            var cat3 = $("#all_product_div .cat3").val();
            var code = '';
            var act = 1;
            if(cat1==0){
                //全部商品
                act = 1;
                code = '';
            }else if(cat1!=0&&cat2==0){
                //二级全部选中
                act = 2;
                code = cat1;
            }else if(cat2!=0&&cat1!=0&&cat3==0){
                //三级全部选中
                act = 3;
                code = cat2;
            }else{
                //指定某分类商品
                act = 4;
                code = cat3;
            }
			//获取商品
			/**op:1代表全部商品，op：2已经选中*/
            <?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'op=1&act='+act+'&code='+code+'&activity='+activity,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all!=0){
                    	var data = data_all['data'];
                    	var count = data_all['count'];
                    	var already = data_all['already'];
                    	var alr_id = new Array();
                    	var alr_sort = new Array();
                    	var alr_stime = new Array();
                    	var alr_etime = new Array();
                    	if(already.length>0){
	                    	$.each(already,function(k){
	                    		alr_id[k] = already[k]['product_id'];
	                    		alr_sort[k] = already[k]['sort_order'];
	                    		alr_stime[k] = already[k]['start_show_time'].slice(0,-3);
	                    		alr_etime[k] = already[k]['end_show_time'].slice(0,-3);
	                        });
                    	}
	            		var str = '';
	            		$.each(data,function(key){  
	            			str += "<tr><td><label>";
                    		str += "<input type='checkbox' name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
                    		str += "<span class='lbl'></span></label></td>";
                            str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
                            str += '<td><input type="text" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                            str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		if(data[key]['status']==1 && data[key]['is_delete']==0){
                        		if(data[key]['s_time']<=day_s &&　data[key]['e_time']>=day_s){
                        			var is = "未过期";
                            	}else if(data[key]['s_time']>=day_s){
                            		var is = "未上架";
                                }else{
                                	var is = "已过期";
                                }
                                
                            }else{
                            	var is = "已过期";
                            }
                            str += "<td>"+is+"</td>";
                    		str += "</tr>";
	                    });
	                    $where = 'act='+act+'&code='+code;
	            		$("#all_product_div table > tbody").html(str);
	            		
	                	/*var mydate = new Date();
                    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
                    	var mydate_e = new Date();
                    	mydate_e.setMonth(mydate_e.getMonth()+1);
                    	var day_e = mydate_e.getFullYear()+'-'+Appendzero(mydate_e.getMonth()+1)+'-'+Appendzero(mydate_e.getDate())+' '+Appendzero(mydate_e.getHours())+':00';
                		$('.datetimepicker_s').datetimepicker({value:day_s,step:1});
                    	$('.datetimepicker_e').datetimepicker({value:day_e,step:1});*/
                    	$('.datetimepicker_s').datetimepicker({step:1});
                    	$('.datetimepicker_e').datetimepicker({step:1});
						if(alr_id.length>0){
	                    	$("#all_product_div table tbody>tr").each(function(){
	                        	var pro_id = $(this).find("input[type='checkbox']").val();
	                        	var num = $.inArray(pro_id, alr_id);
	    	            		if(num!=-1){
	        	            		$(this).find("input[type='checkbox']").attr('checked','checked');
	        	            		$(this).find("input.sort").val(alr_sort[num]);
	        	            		$(this).find("input.datetimepicker_s").val(alr_stime[num]);
	        	            		$(this).find("input.datetimepicker_e").val(alr_etime[num]);
	        	            	}
	                        });
						}
                    	if(count>1) {$("input#all_page_num").val(1);all_page(count,$where);}
	            		else $("#page_div").html('');
                	}else{
                    	$("#all_product_div table > tbody").html('');
                    	$("#page_div").html('');
                    }
            		
            	}      
            });
        });

        /**提交商品**/
        $("#all_product_div .product_submit_but").click(function(){
            var activity = $("select[name='activity_all_sel']").val();
            var selected_obj = $("#all_product_div table>tbody input[type='checkbox']:checked");
            var unselected_obj = $("#all_product_div table>tbody input[type='checkbox']").not("input:checked");
           // if(selected_obj.length==0){alert("请选中需要提交的记录!");return false;}
           var mydate = new Date();
           var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
                    	
            var ids = '';
            var sorts = '';
            var s_times = '';
            var e_times = '';
            var un_ids = '';
            var flag = 1;
            if(selected_obj.length>0){
			$.each(selected_obj,function(){
				var obj = $(this).parent().parent().parent();
				ids += $(this).val()+',';
				sorts += obj.find(".sort").val()+',';
				s_times += obj.find(".datetimepicker_s").val()+':00'+',';
				e_times += obj.find(".datetimepicker_e").val()+':00'+',';
				var s_time = obj.find(".datetimepicker_s").attr("s_time");
				var e_time = obj.find(".datetimepicker_e").attr("e_time");
				if(obj.find(".sort").val()=='' || obj.find(".datetimepicker_s").val()=='' || obj.find(".datetimepicker_e").val()==''){
					flag = 0;return false;
				}
				if(obj.find(".datetimepicker_e").val()<obj.find(".datetimepicker_s").val()){
					flag = 0;return false;
				}
				if(!(obj.find(".datetimepicker_s").val()>=s_time && obj.find(".datetimepicker_e").val()<=e_time)){
					flag = -1;alert("'"+obj.find("td").eq(1).html()+"'"+"的日期选择应在日期范围内！");return false;
				}
			});
			if(flag==0){alert("勾选项排序和时间不能为空,且结束时间大于开始时间!");return false;}
			if(flag==-1){return false;}
            }
            if(unselected_obj.length>0){
                $.each(unselected_obj,function(){
                    un_ids += $(this).val()+',';
                });
            }
			ids = ids.substring(0,ids.length-1);
			un_ids = un_ids.substring(0,un_ids.length-1);
			sorts = sorts.substring(0,sorts.length-1);
			s_times = s_times.substring(0,s_times.length-1);
			e_times = e_times.substring(0,e_times.length-1);
			<?php $path_url = Yii::app()->createUrl('Activity/UpdateProductActivityData');?>
			var data = 'activity='+activity+'&ids='+ids+'&un_ids='+un_ids+'&sorts='+sorts+'&s_times='+s_times+'&e_times='+e_times;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("提交失败!");return false;}
                    alert("提交成功!");
                    var count = data_all['count'];
            		var data = data_all['data'];
            		var del_count = data_all['del_count'];
            		var del_data = data_all['del_data'];
            		//选中
            		if(data.length>0){
	            		var str = '';
	            		$.each(data,function(key){
	            			str += "<tr><td><label>";
	                		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
	                		str += "<span class='lbl'></span></label></td>";
	                        str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
	                        str += "<td><input value='"+data[key]['sort_order']+"' onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  type='text' style='width:40px;' maxlength='10' class='sort' /></td>";   
	                        str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                		if(data[key]['status']==1 && data[key]['is_delete']==0){
		                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
			                		var is="未过期";
			                	}else if(data[key]['s_time']>=day_s){
				                	var is="未上架";
				                }else{
					                var is="已过期";
					            }
		                	}else{
			                	var is = "已过期";
			                }
	                		str += "<td>"+is+"</td>";
	                		str += "</tr>";
	                	})
	                	$("#already_checked_div table.already_checked_table>tbody").html(str);
	                	if(count>1){$("input#already_page_num").val(1); already_page(count);}
	                	else{$("#page_already_div").html('');}
	            		$('.datetimepicker_res').datetimepicker({step:1});
	                	$('.datetimepicker_ree').datetimepicker({step:1});
            		}else{
            			$("#already_checked_div table.already_checked_table>tbody").html('');
            			$("#page_already_div").html('');
                	}
					//回收站
            		if(del_data.length>0){
	            		var str = '';
	            		$.each(del_data,function(key){
	            			str += "<tr><td><label>";
	                		str += "<input type='checkbox' name='ids[]'  p_id='"+del_data[key]['product_id']+"' value='"+del_data[key]['id']+"' class='ace isclick' />";
	                		str += "<span class='lbl'></span></label></td>";
	                        str += "<td style='text-align:center;'>"+del_data[key]['product_name']+"</td>";   
	                        str += "<td><input readonly='readonly' value='"+del_data[key]['sort_order']+"' onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  type='text' style='width:40px;' maxlength='10' class='sort' /></td>";   
	                        str += "<td><input type='text' s_time='"+del_data[key]['s_time']+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                		str += "<td><input type='text' e_time='"+del_data[key]['e_time']+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
	                		str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                		if(del_data[key]['status']==1 && del_data[key]['is_delete']==0){
		                		if(del_data[key]['s_time']<=del_data[key]['start_show_time'] && del_data[key]['e_time']>=del_data[key]['end_show_time']){
			                		var is="未过期";
			                	}else if(del_data[key]['s_time']>=day_s){
				                	var is="未上架";
				                }else{
					                var is="已过期";
					            }
		                	}else{
			                	var is = "已过期";
			                }
	                		str += "<td>"+is+"</td>";
	                		str += "</tr>";
	                	})
	                	$("#del_product_div table.del_product_table>tbody").html(str);
	                	if(count>1){$("input#del_page_num").val(1); del_page(count);}
	                	else{$("#page_del_div").html('');}
	            		//$('.datetimepicker_des').datetimepicker({step:1});
	                	//$('.datetimepicker_dee').datetimepicker({step:1});
            		}else{
            			$("#del_product_div table.del_product_table>tbody").html('');
            			$("#page_del_div").html('');
                	}
                    
            	}        
            });
            
        });

/***************************选中商品*********************************/
 /**页面加载时触发全部分页**/
	<?php if($activity_count >1){?>
	already_page(<?php echo $activity_count;?>);
	<?php }?>

    	/**改变一级，获取二级**/
    	$("#already_checked_div .cat1").change(function(){
    		var this_code = $(this).val();
            if(this_code == 0){
            	$("#already_checked_div .cat2").addClass('hidden');
            	$("#already_checked_div .cat3").addClass('hidden');
            	return false;
            }
            $("#already_checked_div .cat2").removeClass('hidden');
            var str = '';
            var str_ch = '';
            var str_pr = '';
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
            		str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("#already_checked_div .cat2").html(str);
            		$("#already_checked_div .cat3").addClass('hidden');
            	}        
            });
        });

    	/**改变分类二级,获取三级**/
        $("#already_checked_div .cat2").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
            	$("#already_checked_div .cat3").addClass('hidden');
            	return false;
            }
            $("#already_checked_div .cat3").removeClass('hidden');
            var str = '';
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
            		str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("#already_checked_div .cat3").html(str);
            	}      
            });
        });

		/**选中商品提交分类查询**/
		$("#already_checked_div .submit_but").click(function(){
			var activity = $("select[name='activity_all_sel']").val();
			var cat1 = $("#already_checked_div .cat1").val();
            var cat2 = $("#already_checked_div .cat2").val();
            var cat3 = $("#already_checked_div .cat3").val();
            var mydate = new Date();
            var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
            
            var code = '';
            var act = 1;
            if(cat1==0){
                //全部商品
                act = 1;
                code = '';
            }else if(cat1!=0&&cat2==0){
                //二级全部选中
                act = 2;
                code = cat1;
            }else if(cat2!=0&&cat1!=0&&cat3==0){
                //三级全部选中
                act = 3;
                code = cat2;
            }else{
                //指定某分类商品
                act = 4;
                code = cat3;
            }
			//获取商品
			/**op:1代表全部商品，op：2已经选中*/
            <?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'op=2&act='+act+'&code='+code+'&activity='+activity,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all!=0){
                    	var data = data_all['data'];
                    	var count = data_all['count'];
	            		var str = '';
	            		$.each(data,function(key){  
	            			str += "<tr><td><label>";
                    		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
                    		str += "<span class='lbl'></span></label></td>";
                            str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
                            str += '<td><input type="text" value="'+data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                            str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		if(data[key]['status']==1 && data[key]['is_delete']==0){
		                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
			                		var is="未过期";
			                	}else if(data[key]['s_time']>=day_s){
				                	var is="未上架";
				                }else{
					                var is="已过期";
					            }
		                	}else{
			                	var is = "已过期";
			                }
                    		str += "<td>"+is+"</td>";
                    		str += "</tr>";
	                    });
	                    $where = 'act='+act+'&code='+code;
	            		$("#already_checked_div table > tbody").html(str);
	            		if(count>1){$("input#already_page_num").val(1); already_page(count,$where);}
	            		else $("#page_already_div").html('');
	            		$('.datetimepicker_res').datetimepicker({step:1});
	                	$('.datetimepicker_ree').datetimepicker({step:1});
                	}else{
                    	$("#already_checked_div table > tbody").html('');
                    	$("#page_already_div").html('');
                    }
            		
            	}      
            });
		});



		/**修改记录**/
		$("#already_checked_div .already_update_but").click(function(){
			var activity = $("select[name='activity_all_sel']").val();
			var selected_obj = $("#already_checked_div table>tbody input[type='checkbox']:checked");
			var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	          
			if(selected_obj.length<1){alert("未选择修改项，请勾选需修改的记录！"); return false;}
			var ids = '';
			var sorts = '';
			var s_times = '';
			var e_times = '';
			var product_ids = new Array();
			var flag = 1;
			$.each(selected_obj,function(k){
				var obj = $(this).parent().parent().parent();
				product_ids[k] = $(this).attr('p_id');
				ids += $(this).val()+',';
				sorts += obj.find(".sort").val()+',';
				s_times += obj.find(".datetimepicker_res").val()+':00'+',';
				e_times += obj.find(".datetimepicker_ree").val()+':00'+',';
				var s_time = obj.find(".datetimepicker_res").attr("s_time");
				var e_time = obj.find(".datetimepicker_ree").attr("e_time");
				if(obj.find(".sort").val()=='' || obj.find(".datetimepicker_res").val()=='' || obj.find(".datetimepicker_ree").val()==''){
					flag = 0;return false;
				}
				if(obj.find(".datetimepicker_ree").val()<obj.find(".datetimepicker_res").val()){
					flag = 0;return false;
				}
				if(!(obj.find(".datetimepicker_res").val()>=s_time && obj.find(".datetimepicker_ree").val()<=e_time)){
					flag = -1;alert("'"+obj.find("td").eq(1).html()+"'"+"的日期选择应在日期范围内！");return false;
				}
			});
			if(flag==0){alert("勾选项排序和时间不能为空，且结束时间大于开始时间!");return false;}
			if(flag==-1){return false;}
			<?php $path_url = Yii::app()->createUrl('Activity/UpdateActivityProductAlreadyData');?>
			var data = 'activity='+activity+'&ids='+ids+'&sorts='+sorts+'&s_times='+s_times+'&e_times='+e_times;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("修改失败!");return false;}
                    alert("修改成功!");
                    var is_delete = new Array();
                    $.each(data_all,function(k){
                        var text = data_all[k]['is_overdue']==1?"已过期":(data_all[k]['start_show_time']>day_s?"未上架":"未过期");
                        is_delete[data_all[k]['id']] = text;
                    });
                    $.each(selected_obj,function(){
                        var id = $(this).val();
                       // var is_del = is_delete[id];
                        $(this).parent().parent().parent().find("td:last").html(is_delete[id]);
                    });
                    selected_obj.removeAttr("checked");
                    sorts = sorts.split(',');
                    s_times = s_times.split(',');
                    e_times = e_times.split(',');
                    $("#all_product_div table>tbody input[type='checkbox']").each(function(){
                        var num = $.inArray($(this).val(), product_ids);
                    	if(num!=-1){
                        	$obj = $(this).parent().parent().parent();
                        	$obj.find("input.sort").val(sorts[num]);
                        	$obj.find("input.datetimepicker_s").val(s_times[num].slice(0,-3));
                        	$obj.find("input.datetimepicker_e").val(e_times[num].slice(0,-3));
                        }
                    });

                    
            	}        
            });
			
			
		});

		/**移除选中**/
		$("#already_checked_div .already_del_but").click(function(){
			var activity = $("select[name='activity_all_sel']").val();
			var selected_obj = $("#already_checked_div table>tbody input[type='checkbox']:checked");
			if(selected_obj.length<1){alert("未选择修改项，请勾选需移除的记录！"); return false;}
		    var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	            
			var ids = '';
			var product_ids = new Array();
			var flag = 1;
			$.each(selected_obj,function(k){
				ids += $(this).val()+',';
				product_ids[k] = $(this).attr('p_id');
			});
			<?php $path_url = Yii::app()->createUrl('Activity/DelActivityProductAlreadyData');?>
			var data = 'activity='+activity+'&ids='+ids;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("移除失败!");return false;}
                    alert("移除成功!");
                    var count = data_all['count'];
                    var data = data_all['data'];
                    var del_count = data_all['del_count'];
                    var del_data = data_all['del_data'];
                    var str = '';
                    $.each(data,function(key){ 
            			str += "<tr><td><label>";
                		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
                		str += "<span class='lbl'></span></label></td>";
                        str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
                        str += '<td><input type="text" value="'+data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                        str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                		if(data[key]['status']==1 && data[key]['is_delete']==0){
	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
		                		var is="未过期";
		                	}else if(data[key]['s_time']>=day_s){
			                	var is="未上架";
			                }else{
				                var is="已过期";
				            }
	                	}else{
		                	var is = "已过期";
		                }
                		str += "<td>"+is+"</td>";
                		str += "</tr>";
                    });
                  
            		$("#already_checked_div table > tbody").html(str);
            		$("#already_checked_div .cat1").find("option:selected").removeAttr("selected");
            		$("#already_checked_div .cat2").addClass('hidden');
            		$("#already_checked_div .cat3").addClass('hidden');
            		if(count>1) {$("input#already_page_num").val(1);already_page(count);}
            		else $("#page_already_div").html('');

            		var del_str = '';
                    $.each(del_data,function(key){ 
                    	del_str += "<tr><td><label>";
                    	del_str += "<input type='checkbox' name='ids[]'  p_id='"+del_data[key]['product_id']+"' value='"+del_data[key]['id']+"' class='ace isclick' />";
                    	del_str += "<span class='lbl'></span></label></td>";
                    	del_str += "<td style='text-align:center;'>"+del_data[key]['product_name']+"</td>";   
                    	del_str += '<td><input readonly="readonly" type="text" value="'+del_data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                    	del_str += "<td><input type='text' s_time='"+del_data[key]['s_time']+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    	del_str += "<td><input type='text' e_time='"+del_data[key]['e_time']+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    	if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
                    	del_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+del_data[key]['e_time'].slice(0,-3)+"</td>";
                    	if(del_data[key]['status']==1 && del_data[key]['is_delete']==0){
	                		if(del_data[key]['s_time']<=del_data[key]['start_show_time'] && del_data[key]['e_time']>=del_data[key]['end_show_time']){
		                		var is="未过期";
		                	}else if(del_data[key]['s_time']>=day_s){
			                	var is="未上架";
			                }else{
				                var is="已过期";
				            }
	                	}else{
		                	var is = "已过期";
		                }
                		del_str += "<td>"+is+"</td>";
                		del_str += "</tr>";
                    });
                  
            		$("#del_product_div table > tbody").html(del_str);
            		$("#del_product_div .cat1").find("option:selected").removeAttr("selected");
            		$("#del_product_div .cat2").addClass('hidden');
            		$("#del_product_div .cat3").addClass('hidden');
            		if(count>1) {$("input#del_page_num").val(1);del_page(del_count);}
            		else $("#page_del_div").html('');
            		
            		//$('.datetimepicker_des').datetimepicker({step:1});
                	//$('.datetimepicker_dee').datetimepicker({step:1});
                	$("#all_product_div table>tbody input[type='checkbox']:checked").each(function(){
                    	if($.inArray($(this).val(), product_ids)!=-1){
                        	$(this).removeAttr("checked");
                        	$(this).parent().parent().parent().find('.sort').val('');
                        	$(this).parent().parent().parent().find('.datetimepicker_s').val('');
                        	$(this).parent().parent().parent().find('.datetimepicker_e').val('');
                        }
                    });
                    
            	}        
            });
		});

/*********回收站**************/

		/**页面加载时触发全部分页**/
		<?php if($del_count >1){?>
		del_page(<?php echo $del_count;?>);
		<?php }?>

	    	/**改变一级，获取二级**/
	    	$("#del_product_div .cat1").change(function(){
	    		var this_code = $(this).val();
	            if(this_code == 0){
	            	$("#del_product_div .cat2").addClass('hidden');
	            	$("#del_product_div .cat3").addClass('hidden');
	            	return false;
	            }
	            $("#del_product_div .cat2").removeClass('hidden');
	            var str = '';
	            var str_ch = '';
	            var str_pr = '';
	            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
	            $.ajax({
	                url:"<?php echo $path_url;?>",
	                type:'get',
	                data:'parent_code='+this_code,
	             	dataType:'json',
	            	success:function(data){
	            		str += "<option value='0'>全部</option>";
	            		$.each(data,function(key){  
	                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
	                    });
	            		$("#del_product_div .cat2").html(str);
	            		$("#del_product_div .cat3").addClass('hidden');
	            	}        
	            });
	        });

	    	/**改变分类二级,获取三级**/
	        $("#del_product_div .cat2").change(function(){
	            var this_code = $(this).val();
	            if(this_code == 0){
	            	$("#del_product_div .cat3").addClass('hidden');
	            	return false;
	            }
	            $("#del_product_div .cat3").removeClass('hidden');
	            var str = '';
	            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
	            $.ajax({
	                url:"<?php echo $path_url;?>",
	                type:'get',
	                data:'parent_code='+this_code,
	             	dataType:'json',
	            	success:function(data){
	            		str += "<option value='0'>全部</option>";
	            		$.each(data,function(key){  
	                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
	                    });
	            		$("#del_product_div .cat3").html(str);
	            	}      
	            });
	        });

			/**选中商品提交分类查询**/
			$("#del_product_div .submit_but").click(function(){
				var activity = $("select[name='activity_all_sel']").val();
				var cat1 = $("#del_product_div .cat1").val();
	            var cat2 = $("#del_product_div .cat2").val();
	            var cat3 = $("#del_product_div .cat3").val();
	            var mydate = new Date();
		        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
		        
	            var code = '';
	            var act = 1;
	            if(cat1==0){
	                //全部商品
	                act = 1;
	                code = '';
	            }else if(cat1!=0&&cat2==0){
	                //二级全部选中
	                act = 2;
	                code = cat1;
	            }else if(cat2!=0&&cat1!=0&&cat3==0){
	                //三级全部选中
	                act = 3;
	                code = cat2;
	            }else{
	                //指定某分类商品
	                act = 4;
	                code = cat3;
	            }
				//获取商品
				/**op:1代表全部商品，op：2已经选中*/
	            <?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
	            $.ajax({
	                url:"<?php echo $path_url;?>",
	                type:'get',
	                data:'op=3&act='+act+'&code='+code+'&activity='+activity,
	             	dataType:'json',
	            	success:function(data_all){
	                	if(data_all!=0){
	                    	var data = data_all['data'];
	                    	var count = data_all['count'];
		            		var str = '';
		            		$.each(data,function(key){  
		            			str += "<tr><td><label>";
	                    		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
	                    		str += "<span class='lbl'></span></label></td>";
	                            str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
	                            str += '<td><input readonly="readonly" type="text" value="'+data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
	                            str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                    		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e.slice(0,-3)+"</td>";
	                    		if(data[key]['status']==1 && data[key]['is_delete']==0){
	    	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
	    		                		var is="未过期";
	    		                	}else if(data[key]['s_time']>=day_s){
	    			                	var is="未上架";
	    			                }else{
	    				                var is="已过期";
	    				            }
	    	                	}else{
	    		                	var is = "已过期";
	    		                }
	                    		str += "<td>"+is+"</td>";
	                    		str += "</tr>";
		                    });
		                    $where = 'act='+act+'&code='+code;
		            		$("#del_product_div table > tbody").html(str);
		            		if(count>1){$("input#del_page_num").val(1); del_page(count,$where);}
		            		else $("#page_del_div").html('');
		            		//$('.datetimepicker_des').datetimepicker({step:1});
		                	//$('.datetimepicker_dee').datetimepicker({step:1});
	                	}else{
	                    	$("#del_product_div table > tbody").html('');
	                    	$("#page_del_div").html('');
	                    }
	            		
	            	}      
	            });
			});
			

		


		/**回收站：恢复选中**/
		$("#del_product_div .del_recovery_but").click(function(){
			var activity = $("select[name='activity_all_sel']").val();
			var selected_obj = $("#del_product_div table>tbody input[type='checkbox']:checked");
			if(selected_obj.length<1){alert("未选择恢复项，请勾选需恢复的记录！"); return false;}
			var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
			var ids = '';
			var sorts = new Array();
			var s_times = new Array();
			var e_times = new Array();
			var product_ids = new Array();
			var flag = 1;
			$.each(selected_obj,function(k){
				ids += $(this).val()+',';
				product_ids[k] = $(this).attr('p_id');
				sorts[k] = $(this).parent().parent().parent().find('.sort').val();
				s_times[k] = $(this).parent().parent().parent().find('.datetimepicker_des').val();
				e_times[k] = $(this).parent().parent().parent().find('.datetimepicker_dee').val();
				
			});
			<?php $path_url = Yii::app()->createUrl('Activity/RecoveryActivityProductData');?>
			var data = 'activity='+activity+'&ids='+ids;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("恢复失败!");return false;}
                    alert("恢复成功!");
                    var count = data_all['count'];
                    var data = data_all['data'];
                    var del_count = data_all['del_count'];
                    var del_data = data_all['del_data'];
                    var str = '';
                    $.each(data,function(key){ 
            			str += "<tr><td><label>";
                		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
                		str += "<span class='lbl'></span></label></td>";
                        str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
                        str += '<td><input type="text" value="'+data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                        str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                		if(data[key]['status']==1 && data[key]['is_delete']==0){
	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
		                		var is="未过期";
		                	}else if(data[key]['s_time']>=day_s){
			                	var is="未上架";
			                }else{
				                var is="已过期";
				            }
	                	}else{
		                	var is = "已过期";
		                }
                		str += "<td>"+is+"</td>";
                		str += "</tr>";
                    });
                  
            		$("#already_checked_div table > tbody").html(str);
            		$("#already_checked_div .cat1").find("option:selected").removeAttr("selected");
            		$("#already_checked_div .cat2").addClass('hidden');
            		$("#already_checked_div .cat3").addClass('hidden');
            		if(count>1) {$("input#already_page_num").val(1);already_page(count);}
            		else $("#page_already_div").html('');
            		$('.datetimepicker_res').datetimepicker({step:1});
                	$('.datetimepicker_ree').datetimepicker({step:1});

               	 	//回收站显示
                	var del_str = '';
                    $.each(del_data,function(key){ 
                    	del_str += "<tr><td><label>";
                    	del_str += "<input type='checkbox' name='ids[]'  p_id='"+del_data[key]['product_id']+"' value='"+del_data[key]['id']+"' class='ace isclick' />";
                    	del_str += "<span class='lbl'></span></label></td>";
                    	del_str += "<td style='text-align:center;'>"+del_data[key]['product_name']+"</td>";   
                    	del_str += '<td><input readonly="readonly" type="text" value="'+del_data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                    	del_str += "<td><input type='text' s_time='"+del_data[key]['s_time']+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    	del_str += "<td><input type='text' e_time='"+del_data[key]['e_time']+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    	if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
                    	del_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    	if(del_data[key]['status']==1 && del_data[key]['is_delete']==0){
	                		if(del_data[key]['s_time']<=del_data[key]['start_show_time'] && del_data[key]['e_time']>=del_data[key]['end_show_time']){
		                		var is="未过期";
		                	}else if(del_data[key]['s_time']>=day_s){
			                	var is="未上架";
			                }else{
				                var is="已过期";
				            }
	                	}else{
		                	var is = "已过期";
		                }
                		del_str += "<td>"+is+"</td>";
                		del_str += "</tr>";
                    });
                  
            		$("#del_product_div table > tbody").html(del_str);
            		$("#del_product_div .cat1").find("option:selected").removeAttr("selected");
            		$("#del_product_div .cat2").addClass('hidden');
            		$("#del_product_div .cat3").addClass('hidden');
            		if(count>1) {$("input#del_page_num").val(1);del_page(del_count);}
            		else $("#page_del_div").html('');
            		//$('.datetimepicker_des').datetimepicker({step:1});
                	//$('.datetimepicker_dee').datetimepicker({step:1});
                	 
                	 //全部中勾选
                	$("#all_product_div table>tbody input[type='checkbox']").each(function(){
                    	var num = $.inArray($(this).val(), product_ids);
                    	if(num!=-1){
                        	$(this).prop("checked","true");
                        	$(this).parent().parent().parent().find('.sort').val(sorts[num]);
                        	$(this).parent().parent().parent().find('.datetimepicker_s').val(s_times[num]);
                        	$(this).parent().parent().parent().find('.datetimepicker_e').val(e_times[num]);
                        }
                    });

            	}        
            });
		});


		/**回收站清除记录**/
		$("#del_product_div .del_all_but").click(function(){
			var activity = $("select[name='activity_all_sel']").val();
			var selected_obj = $("#del_product_div table>tbody input[type='checkbox']:checked");
			if(selected_obj.length<1){alert("未选择清除项，请勾选需清除的记录！"); return false;}
			var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
			var ids = '';
			var product_ids = new Array();
			var flag = 1;
			$.each(selected_obj,function(k){
				ids += $(this).val()+',';
				product_ids[k] = $(this).attr('p_id');
			});
			<?php $path_url = Yii::app()->createUrl('Activity/ReallyDelActivityProductData');?>
			var data = 'activity='+activity+'&ids='+ids;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("清除失败!");return false;}
                    alert("清除成功!");
                    var count = data_all['del_count'];
                    var data = data_all['del_data'];
                    var str = '';
                    $.each(data,function(key){ 
            			str += "<tr><td><label>";
                		str += "<input type='checkbox' name='ids[]'  p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
                		str += "<span class='lbl'></span></label></td>";
                        str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
                        str += '<td><input readonly="readonly" type="text" value="'+data[key]['sort_order']+'" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  style="width:40px;" maxlength="10" class="sort" /></td>';   
                        str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                		if(data[key]['status']==1 && data[key]['is_delete']==0){
	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
		                		var is="未过期";
		                	}else if(data[key]['s_time']>=day_s){
			                	var is="未上架";
			                }else{
				                var is="已过期";
				            }
	                	}else{
		                	var is = "已过期";
		                }
                		str += "<td>"+is+"</td>";
                		str += "</tr>";
                    });
                  
            		$("#del_product_div table > tbody").html(str);
            		$("#del_product_div .cat1").find("option:selected").removeAttr("selected");
            		$("#del_product_div .cat2").addClass('hidden');
            		$("#del_product_div .cat3").addClass('hidden');
            		if(count>1) {$("input#del_page_num").val(1);del_page(count);}
            		else $("#page_del_div").html('');
            		//$('.datetimepicker_des').datetimepicker({step:1});
                	//$('.datetimepicker_dee').datetimepicker({step:1});
            	}        
            });
		});

        
       
    });
    function Appendzero (obj) {
  	  if (obj < 10) return "0"+obj; else return obj;
  }

    /**随着类型改变，全部分页改变**/
    function all_page(count,cat_data=''){
        if(count<=1) {$("#page_div").html('');return false;}
        var activity = $("select[name='activity_all_sel']").val();
        
    	$('#page_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	   // currentPage: this_page,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var this_page = $("input#all_page_num").val();
        	    if(num == this_page) return false;
        	    $("input#all_page_num").val('fail');
    	    	<?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
    	    	var mydate = new Date();
    	    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
    	    	
    	    	if(cat_data=='')
    	    		var data = 'op=1&pag='+num+'&activity='+activity;
    	    	else
    	    		var data = 'op=1&pag='+num+'&activity='+activity+'&'+cat_data;
    	    	<?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                		if(data_all!=0){
                        	var data = data_all['data'];
                        	var count = data_all['count'];
                        	var already = data_all['already'];
                        	var alr_id = new Array();
                        	var alr_sort = new Array();
                        	var alr_stime = new Array();
                        	var alr_etime = new Array();
                        	$.each(already,function(k){
                        		alr_id[k] = already[k]['product_id'];
                        		alr_sort[k] = already[k]['sort_order'];
                        		alr_stime[k] = already[k]['start_show_time'].slice(0,-3);
                        		alr_etime[k] = already[k]['end_show_time'].slice(0,-3);
                            });
    	            		var str = '';
    	            		$.each(data,function(key){  
        	            			str += "<tr><td><label>";
	                        		str += "<input type='checkbox' name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
	                        		str += "<span class='lbl'></span></label></td>";
	                                str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
	                                str += "<td><input onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  type='text' style='width:40px;' maxlength='10' class='sort' /></td>";   
	                                str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                        		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                        		if(data[key]['status']==1 && data[key]['is_delete']==0){
		                        		if(data[key]['s_time']<=day_s &&　data[key]['e_time']>=day_s){
		                        			var is = "未过期";
			                        	}else if(data[key]['s_time']>=day_s){
			                        		var is = "未上架";
				                        }else{
				                        	var is = "已过期";
					                    }
                                        
                                    }else{
                                        var is = "已过期";
                                    }
                                    str += "<td>"+is+"</td>";
	                        		str += "</tr>";
    	                    });
    	            		$("#all_product_div table > tbody").html(str);
                    	
                		/*var mydate = new Date();
                    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
                    	var mydate_e = new Date();
                    	mydate_e.setMonth(mydate_e.getMonth()+1);
                    	var day_e = mydate_e.getFullYear()+'-'+Appendzero(mydate_e.getMonth()+1)+'-'+Appendzero(mydate_e.getDate())+' '+Appendzero(mydate_e.getHours())+':00';
                		$('.datetimepicker_s').datetimepicker({value:day_s,step:1});
                    	$('.datetimepicker_e').datetimepicker({value:day_e,step:1});*/

                    	$('.datetimepicker_s').datetimepicker({step:1});
                    	$('.datetimepicker_e').datetimepicker({step:1});
							
                    	$("#all_product_div table tbody>tr").each(function(){
                        	var pro_id = $(this).find("input[type='checkbox']").val();
                        	var num = $.inArray(pro_id, alr_id);
    	            		if(num!=-1){
        	            		$(this).find("input[type='checkbox']").attr('checked','checked');
        	            		$(this).find("input.sort").val(alr_sort[num]);
        	            		$(this).find("input.datetimepicker_s").val(alr_stime[num]);
        	            		$(this).find("input.datetimepicker_e").val(alr_etime[num]);
        	            	}
                        });

                		}else{
                        	$("#all_product_div table > tbody").html('');
                        }
                		
                	}      
                });
    	    }
    	});
    }

   


    /**随着类型改变，选中分页改变**/
    function already_page(count,cat_data=''){
        if(count<=1) {$("#page_already_div").html('');return false;}
        var activity = $("select[name='activity_all_sel']").val();
        var mydate = new Date();
        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
        
    	$('#page_already_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var this_page = $("input#already_page_num").val();
        	    if(num == this_page) return false;
        	    $("input#already_page_num").val('fail');
    	    	if(cat_data=='')
    	    		var data = 'op=2&pag='+num+'&activity='+activity;
    	    	else
    	    		var data = 'op=2&pag='+num+'&activity='+activity+'&'+cat_data;
    	    	<?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                		if(data_all!=0){
                        	var data = data_all['data'];
                        	var count = data_all['count'];
    	            		var str = '';
    	            		$.each(data,function(key){  
        	            			str += "<tr><td><label>";
	                        		str += "<input type='checkbox' name='ids[]' p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
	                        		str += "<span class='lbl'></span></label></td>";
	                                str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
	                                str += "<td><input value='"+data[key]['sort_order']+"' onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  type='text' style='width:40px;' maxlength='10' class='sort' /></td>";   
	                                str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                        		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                        		if(data[key]['status']==1 && data[key]['is_delete']==0){
	        	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
	        		                		var is="未过期";
	        		                	}else if(data[key]['s_time']>=day_s){
	        			                	var is="未上架";
	        			                }else{
	        				                var is="已过期";
	        				            }
	        	                	}else{
	        		                	var is = "已过期";
	        		                }
	                        		str += "<td>"+is+"</td>";
	                        		str += "</tr>";
    	                    });
    	            		$("#already_checked_div table > tbody").html(str);
                    	
                		$('.datetimepicker_res').datetimepicker({step:1});
                    	$('.datetimepicker_ree').datetimepicker({step:1});
                    
                		}else{
                        	$("#already_checked_div table > tbody").html('');
                        }
                		
                	}      
                });
    	    }
    	});
        
    }


    /**随着类型改变，回收站分页改变**/
    function del_page(count,cat_data=''){
        if(count<=1) {$("#page_del_div").html('');return false;}
        var activity = $("select[name='activity_all_sel']").val();
        var mydate = new Date();
        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
        
    	$('#page_del_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var this_page = $("input#del_page_num").val();
        	    if(num == this_page) return false;
        	    $("input#del_page_num").val('fail');
    	    	if(cat_data=='')
    	    		var data = 'op=3&pag='+num+'&activity='+activity;
    	    	else
    	    		var data = 'op=3&pag='+num+'&activity='+activity+'&'+cat_data;
    	    	<?php $path_url = Yii::app()->createUrl('Activity/SetCategoryGetProduct');?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                		if(data_all!=0){
                        	var data = data_all['data'];
                        	var count = data_all['count'];
    	            		var str = '';
    	            		$.each(data,function(key){  
        	            			str += "<tr><td><label>";
	                        		str += "<input type='checkbox' name='ids[]' p_id='"+data[key]['product_id']+"' value='"+data[key]['id']+"' class='ace isclick' />";
	                        		str += "<span class='lbl'></span></label></td>";
	                                str += "<td style='text-align:center;'>"+data[key]['product_name']+"</td>";   
	                                str += "<td><input readonly='readonly' value='"+data[key]['sort_order']+"' onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}  type='text' style='width:40px;' maxlength='10' class='sort' /></td>";   
	                                str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                        		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                        		if(data[key]['status']==1 && data[key]['is_delete']==0){
	        	                		if(data[key]['s_time']<=data[key]['start_show_time'] && data[key]['e_time']>=data[key]['end_show_time']){
	        		                		var is="未过期";
	        		                	}else if(data[key]['s_time']>=day_s){
	        			                	var is="未上架";
	        			                }else{
	        				                var is="已过期";
	        				            }
	        	                	}else{
	        		                	var is = "已过期";
	        		                }
	                        		str += "<td>"+is+"</td>";
	                        		str += "</tr>";
    	                    });
    	            		$("#del_product_div table > tbody").html(str);
                    	
                		//$('.datetimepicker_des').datetimepicker({step:1});
                    	//$('.datetimepicker_dee').datetimepicker({step:1});
                    
                		}else{
                        	$("#del_product_div table > tbody").html('');
                        }
                		
                	}      
                });
    	    }
    	});
        
    }
</script>
<style>
input[readonly]{background:#fff !important;}
 input.datetimepicker_s,input.datetimepicker_e,input.datetimepicker_ree,input.datetimepicker_res{
  background: #fff url("<?php echo $theme_url; ?>/assets/images/date_icon.png") no-repeat scroll 130px 6px !important;
 }
  input.datetimepicker_s,input.datetimepicker_e,input.datetimepicker_ree,input.datetimepicker_res,input.datetimepicker_dee,input.datetimepicker_des{
  width:160px;
 }
</style>
