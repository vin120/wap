<?php
    $this->pageTitle = Yii::t('vcos','栏目页面配置');
    $theme_url = Yii::app()->theme->baseUrl;
    $menu_type = 'nav_column_set';
?>
<link rel="stylesheet"  href="<?php echo $theme_url; ?>/assets/css/jquery.datetimepicker.css" />  
<?php 
    //navbar 挂件
   	$disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
?>
<style>

	.ace-file-multiple .file-label::before{
	font-size:12px;
	height:36px;
	}
	.ace-file-multiple .file-label .file-name [class*="icon-"]{
	font-size:20px;
	height:20px;
	line-height:20px;
	}
	.ace-file-multiple .file-label .file-name{
	top:-10px;
	}
	.ace-file-input{
	line-height:30px;margin-bottom:-5px;
	}
	.click_but{width:100px;cursor:pointer;height:35px;line-height:35px;text-align:center;border:1px solid #9e9d9e;background:#e9ecec;float:left;margin-left:10px;margin-bottom:5px;}
    #add_category_one{cursor:pointer;line-height:30px;text-align:center;width:100px;height:30px;color:#fff;background:#009FCC;}
	table thead tr td{text-align:center;height:30px;background:#B0E0E6;}
    table tbody tr td{padding-top:10px;padding-bottom:5px;}
    table tbody tr{border-bottom:1px dashed #ccc;}
    table .number{width:28px;margin-right:5px;text-align:center;}
    table .cat_name{width:220px;}
    table .parent_op{cursor:pointer;position:relative;top:-5px;margin:0px 5px 0px 8px;width: 0;height: 0;border-left: 8px solid transparent;border-right: 8px solid transparent;border-top: 10px solid #1b1b1b;}
    table tbody tr .img>label{width:25px;}
    table tbody tr .img>label>img{cursor:pointer;}
    table tbody tr td.text_center{text-align:center;}
    table tbody tr td .add_start{color:blue;cursor:pointer;}
    table tbody tr td .add_stop{color:#ccc;}
    table tbody tr td .child_op{margin:-9px 5px 0px 41px;width:15px;height:15px;border-left:1px solid #ccc;border-bottom:1px solid #ccc;}
  
    .product_category_file > div{margin-left:50px;width:300px;font:12px;}
	.set_category{text-align:left;width:150px;white-space:nowrap;display:inline-block;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow: hidden; }
	.set_category_but{cursor:pointer;}
	.cat_name_list{color:red;}
	.cat_name_list  span{margin-right:2px;}
	.set_category_show_div ul{list-style:none;}
	.set_category_show_div li{cursor:pointer;margin-right:3px;float:left;}
	.cat_name_list > span{cursor:pointer;}
	.set_category_show_div{
	width:450px;height:350px;z-index:1;background:#f9fdfd;position:fixed;left:50%;margin-left:-225px;
	padding:10px;border:2px solid #ccc;font-size:14px;line-height:30px;
	}
	.set_category_show_div .cat_list{margin-top:10px;}
	.hidden_category_checked{position:relative;float:right;cursor:pointer;}
	.set_category_submit{cursor:pointer;margin-top:10px;float:right;width:45px;height:30px;line-height:30px;background:#009fcc;text-align:center;display:inline-block;}

    .file-name{left:150px;text-align:center;line-height:100px;top:25px;position:absolute;z-index:1;width:100px;height:100px;background:#eee;z-index:1px;display:inline-block;}
	.title_text{text-align:left;width:150px;white-space:nowrap;display:inline-block;float:right;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow: hidden; }
 	.add_child{cursor:pointer;}
 	.show_category_div{left:150px;text-align:left;top:32px;position:absolute;z-index:1;width:220px;height:100px;background:#eee;z-index:1px;display:inline-block;}
</style>

<div class="main-container" id="main-container">
        <script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>

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
                                <?php echo yii::t('vcos', '界面配置')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '栏目页面配置')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <style>
                    	.table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                    	.table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                    	.table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
	                    </style>
	                    <?php if($navigation!=''){?>
	                    	<label>请选择导航:
	                    	<select name="navigation_sel">
	                    <?php foreach ($navigation as $key=>$row){?>
	                    	<option <?php if($row['navigation_id']==$this_nav){echo "selected='selected'";}?> type="<?php echo $row['navigation_style_type'];?>" value="<?php echo $row['navigation_id'];?>" ><?php echo $row['navigation_name']?></option>
	                    <?php }?>
	                    	</select>
	                    	</label>
	                    <?php }?>
	                    
	                    <?php $type_arr = explode(',', $navigation[0]['navigation_style_type']); ?>
	                    <div class="nav_type_div <?php echo  $data==''?'hidden':'';?> <?php if($type_arr==''){echo 'hidden';}?>">
	                    <?php foreach ($type_arr as $key=>$row){?>
	                    	<label style="margin-right: 15px;"><input <?php if($key==0){echo "checked='checked'";}?> style="margin-right:5px;" type='radio' name='nav_type' value="<?php echo $row;?>" /><?php echo $row==1?'设置活动':($row==2?'设置店铺':'设置商品');?></label>
	                    <?php }?>
	                    </div>
	                    <div class="table_switch <?php echo  $data==''?'hidden':'';?> <?php if($type_arr==''){echo 'hidden';}?>" ><span val='0'>选中</span><span val='1' class='myself_current' >全部</span><span val='2'>回收站</span></div>
	                    <input type='hidden' name='checked_page_num' value="<?php echo $checked_page_num;?>">
	                    <input type='hidden' name='all_page_num' value="<?php echo $all_page_num;?>">
	                    <input type='hidden' name='delete_page_num' value="<?php echo $delete_page_num;?>">
	                    
                    		<!-- 全部 -->
                                    <div class="row <?php echo  $data==''?'hidden':'';?> <?php if($type_arr==''){echo 'hidden';}?>" id="checked_table" >
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<div class="type_product_category <?php echo $type_arr[0]==3?'':'hidden';?>" style="margin-bottom: 5px;">
                                            	<!-- <form method='post' action=""> -->
                                            		<select name="category_one" style="width:150px;">
                                            			<option value='0'>全部</option>
                                            			<?php if($cat1_sel)foreach($cat1_sel as $row){?>
                                            			<option value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                            			<?php }?>
                                            		</select>
                                            		<select class="hidden" name="category_two"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<select class="hidden" name="category_three"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<input type="submit" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                            	<!-- </form> -->
                                            	</div>
                                            	<?php ?>
                                                <form method="post" class='now_form' action="<?php echo Yii::app()->createUrl("Product/product_list");?>">
                                                <table id="sample-table-1" class="all_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '名称')?></th>
                                                            <th><?php echo yii::t('vcos', '排序')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示开始时间')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示结束时间')?></th>
                                                            <?php if($type_arr[0]!=2){?>
                                                            <th><?php echo yii::t('vcos', '商品上下架时间')?></th>
                                                            <?php }?>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $p_id = array();
                                                    $p_sort = array();
                                                    $s_time = array();
                                                    $e_time = array();
                                                    $time = date('Y-m-d H:i:s',time());
                                                    if($data_already!=''){
                                                    	foreach($data_already as $k=>$row){
	                                                    		$p_id[$k] = $row['product_id'];
	                                                    		$p_sort[$row['product_id']] = $row['sort_order'];
	                                                    		$s_time[$row['product_id']] = $row['start_show_time'];
	                                                    		$e_time[$row['product_id']] = $row['end_show_time'];
                                                    	}
                                                    }?>
                                                    <tbody act="<?php echo $type_arr[0]?>">
                                                        <?php if($data!='') foreach ($data as $key=>$row){?>
                                                        <tr>
                                                        <td class="center">
                                                             <label>
                                                             <?php if(in_array($row['id'], $p_id)){$ch = "checked='checked'";$sort=$p_sort[$row['id']];$stime=substr($s_time[$row['id']],0,-3);$etime=substr($e_time[$row['id']],0,-3);}else{$ch='';$sort='';$stime='';$etime='';}?>
                                                                <input type="checkbox" <?php echo $ch;?>  name="ids[]" value="<?php echo $row['id'];?>" class="ace isclick" />
                                                                <span class="lbl"></span>
                                                             </label>
                                                        </td>
                                                        <td><?php echo $key+1;?></td>
                                                        <td><?php echo $row['name']?></td>
                                                        <td><input class='sort' style="width:40px;" maxlength="10" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  type='text' name=sort[] value="<?php echo $sort;?>"/></td>
                                                        <?php if($type_arr[0]!=2){$s_times=$row['s_time'];$e_times=$row['e_time'];}else{$s_times='';$e_times='';}?>
                                                        <td><input type="text" s_time="<?php echo $s_times;?>" readonly='readonly' value="<?php echo $stime;?>" class="datetimepicker_s" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                                        <td><input type="text" e_time="<?php echo $e_times;?>" readonly='readonly' value="<?php echo $etime;?>" class="datetimepicker_e" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                                        <?php if($type_arr[0]!=2){?>
                                                        <?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                                        <td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>  
                                                        <?php }?> 
                                                        <?php 
                                                        	if(isset($row['s_time'])){
                                                        		//活动和商品
                                                        		if($row['status']==1 && $row['s_time']<=$time && $row['e_time']>=$time){
                                                        			$is = "未过期";
                                                        		}else if($row['status']==1 && $row['s_time']>$time){
                                                        			$is = "未上架";
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}else{
                                                        		//店铺
                                                        		if($row['status']==1){
                                                        			$is = "未过期";
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}
                                                        	if(isset($row['is_delete'])){
                                                        		if($row['is_delete']==1){
                                                        			$is = "已过期";
                                                        		}else{
                                                        			if($is=="未过期"){
                                                        				$is = "未过期";
                                                        			}else if($is=="未上架"){
                                                        				$is = "未上架";
                                                        			}else{
                                                        				$is = "已过期";
                                                        			}
                                                        			
                                                        		}
                                                        	}
                                                        ?>
                                                        <td><?php echo $is;?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                <div class="submit_but" style="float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">提交</div>
                                                </form>
                                               
                                                <!-- 全部分页 -->
                                                <div class="center" id="page_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                    
                                    <!-- 选中 -->
                                    <div class="row hidden <?php echo  $data==''?'hidden':'';?> <?php if($type_arr==''){echo 'hidden';}?>" id="already_table" >
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<div class="type_already_category <?php echo $type_arr[0]==3?'':'hidden';?>" style="margin-bottom: 5px;">
                                            	<!-- <form method='post' action=""> -->
                                            		<select name="category_one" style="width:150px;">
                                            			<option value='0'>全部</option>
                                            			<?php if($cat1_sel)foreach($cat1_sel as $row){?>
                                            			<option value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                            			<?php }?>
                                            		</select>
                                            		<select class="hidden" name="category_two"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<select class="hidden" name="category_three"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<input type="submit" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                            	<!-- </form> -->
                                            	</div>
                                            	<?php ?>
                                                <form method="post" class='already_form' action="<?php echo Yii::app()->createUrl("Product/product_list");?>">
                                                <table id="sample-table-1" class="already_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '名称')?></th>
                                                            <th><?php echo yii::t('vcos', '排序')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示开始时间')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示结束时间')?></th>
                                                            <?php if($type_arr[0]!=2){?>
                                                            <th><?php echo yii::t('vcos', '商品上下架时间')?></th>
                                                            <?php }?>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody act="<?php echo $type_arr[0]?>">
                                                        <?php  $time = date('Y-m-d H:i:s',time()); if($data_already!='') foreach ($data_already as $key=>$row){?>
                                                        <tr>
                                                        <td class="center">
                                                             <label>
                                                                <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                <span class="lbl"></span>
                                                             </label>
                                                        </td>
                                                        <td><?php echo $key+1;?></td>
                                                        <td><?php echo $row['title']?></td>
                                                        <td><input class='sort'  maxlength="10" style="width:40px;" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  type='text' name=sort[] value="<?php echo $row['sort_order']?>"/></td>
                                                        <?php if($type_arr[0]!=2){$s_times=$row['s_time'];$e_times=$row['e_time'];}else{$s_times='';$e_times='';}?>
                                                        <td><input type="text" s_time="<?php echo $s_times;?>" readonly='readonly' value="<?php echo substr($row['start_show_time'],0, -3)?>" class="datetimepicker_res" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                                        <td><input type="text" e_time="<?php echo $e_times;?>" readonly='readonly' value="<?php echo substr($row['end_show_time'],0, -3)?>" class="datetimepicker_ree" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                                        <?php if($type_arr[0]!=2){?>
                                                        <?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                                        <td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>  
                                                        <?php }?>   
                                                        <?php 
                                                        	if(isset($row['s_time'])){
                                                        		//活动和商品
                                                        		if($row['status']==1 && $row['start_show_time']>=$row['s_time'] && $row['end_show_time']<=$row['e_time']){
                                                        			if($row['start_show_time']<=$time && $row['end_show_time']>=$time){
                                                        				$is = "未过期";
                                                        			}else if($row['start_show_time']>$time){
                                                        				$is = "未上架";
                                                        			}else{
                                                        				$is = "已过期";
                                                        			}
                                                        			
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}else{
                                                        		//店铺
                                                        		if($row['status']==1){
                                                        			$is = "未过期";
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}
                                                        	if(isset($row['is_delete'])){
                                                        		if($row['is_delete']==1){
                                                        			$is = "已过期";
                                                        		}else{
                                                        			if($is=="未过期"){
                                                        				$is = "未过期";
                                                        			}else if($is=="未上架"){
                                                        				$is = "未上架";
                                                        			}else{
                                                        				$is = "已过期";
                                                        			}
                                                        			
                                                        		}
                                                        	}
                                                        ?>         
                                                        <td><?php echo $is?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                <div class="submit_but_update" style="float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">修改选中</div>
                                                <div class="submit_but_del" style="margin-right:20px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">移除选中</div>
                                                </form>
                                               
                                                <!-- 已选中分页 -->
                                                <div class="center" id="page_already_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                    
                                    <!-- 回收站 -->
                                    <div class="row hidden <?php echo  $data==''?'hidden':'';?> <?php if($type_arr==''){echo 'hidden';}?>" id="del_table" >
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<div class="type_del_category <?php echo $type_arr[0]==3?'':'hidden';?>" style="margin-bottom: 5px;">
                                            	<!-- <form method='post' action=""> -->
                                            		<select name="category_one" style="width:150px;">
                                            			<option value='0'>全部</option>
                                            			<?php if($cat1_sel)foreach($cat1_sel as $row){?>
                                            			<option value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                            			<?php }?>
                                            		</select>
                                            		<select class="hidden" name="category_two"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<select class="hidden" name="category_three"  style="width:150px;">
                                            			<option value='0'>全部</option>
                                            		</select>
                                            		<input type="submit" value="查询" style="background:#6faed9;border:0px;width:55px;height:30px;"/>
                                            	<!-- </form> -->
                                            	</div>
                                            	<?php ?>
                                                <form method="post" class='del_form' action="<?php echo Yii::app()->createUrl("Product/product_list");?>">
                                                <table id="sample-table-1" class="del_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '名称')?></th>
                                                            <th><?php echo yii::t('vcos', '排序')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示开始时间')?></th>
                                                            <th><?php echo yii::t('vcos', '活动显示结束时间')?></th>
                                                            <?php if($type_arr[0]!=2){?>
                                                            <th><?php echo yii::t('vcos', '商品上下架时间')?></th>
                                                            <?php }?>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody act="<?php echo $type_arr[0]?>">
                                                        <?php if($data_del!='') foreach ($data_del as $key=>$row){?>
                                                        <tr>
                                                        <td class="center">
                                                             <label>
                                                                <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                <span class="lbl"></span>
                                                             </label>
                                                        </td>
                                                        <td><?php echo $key+1;?></td>
                                                        <td><?php echo $row['title']?></td>
                                                        <td><input readonly='readonly' class='sort'  maxlength="10" style="width:40px;" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'');}else{this.value=this.value.replace(/[^0-9]/g,'');}"  type='text' name=sort[] value="<?php echo $row['sort_order']?>"/></td>
                                                        <?php if($type_arr[0]!=2){$s_times=$row['s_time'];$e_times=$row['e_time'];}else{$s_times='';$e_times='';}?>
                                                        <td><input type="text" s_time="<?php echo $s_times;?>" readonly='readonly' value="<?php echo substr($row['start_show_time'],0, -3)?>" class="datetimepicker_des" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>"/></td>
                                                        <td><input type="text" e_time="<?php echo $e_times;?>" readonly='readonly' value="<?php echo substr($row['end_show_time'],0, -3)?>" class="datetimepicker_dee" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>"/></td>
                                                        <?php if($type_arr[0]!=2){?>
                                                        <?php  $e = $row['e_time']=="9999-12-31 23:59:59"?"永不下架":substr($row['e_time'],0,-3);?>
                                                        <td><?php echo substr($row['s_time'],0,-3).'～'.$e;?></td>  
                                                        <?php }?>          
                                                        <?php 
                                                        	if(isset($row['s_time'])){
                                                        		//活动和商品
                                                        		if($row['status']==1 && $row['start_show_time']>=$row['s_time'] && $row['end_show_time']<=$row['e_time']){
                                                        			if($row['start_show_time']<=$time && $row['end_show_time']>=$time){
                                                        				$is = "未过期";
                                                        			}else if($row['start_show_time']>$time){
                                                        				$is = "未上架";
                                                        			}else{
                                                        				$is = "已过期";
                                                        			}
                                                        			
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}else{
                                                        		//店铺
                                                        		if($row['status']==1){
                                                        			$is = "未过期";
                                                        		}else{
                                                        			$is = "已过期";
                                                        		}
                                                        	}
                                                        	if(isset($row['is_delete'])){
                                                        		if($row['is_delete']==1){
                                                        			$is = "已过期";
                                                        		}else{
                                                        			if($is=="未过期"){
                                                        				$is = "未过期";
                                                        			}else if($is=="未上架"){
                                                        				$is = "未上架";
                                                        			}else{
                                                        				$is = "已过期";
                                                        			}
                                                        			
                                                        		}
                                                        	}
                                                        ?>     
                                                        <td><?php echo $is;?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                <div class="submit_but_recovery" style="float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">恢复选中</div>
                                                <div class="submit_but_remove" style="margin-right:20px;float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">清除选中</div>
                                                </form>
                                               
                                                <!-- 回收站分页 -->
                                                <div class="center" id="page_del_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!-- 商品分类 -->
                       <div class="row <?php echo  $data!=''?'hidden':'';?>" id="product_cateory">
                       	<!-- 分类设置弹出框 -->
                        <div class="set_category_show_div hidden">
                        	<span class="hidden_category_checked"><img src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></span>
                        	<select style="width:40%"  id="form-field-select-1" name="cat1" class="cat1">
                                <option value='0'>请选择</option>
                                <?php foreach($cat_1 as $c1){?>
                                <option value="<?php echo $c1['category_code']?>"><?php echo $c1['name']?></option>
                                <?php }?>
                            </select>
                            <select style="width:40%" id="form-field-select-1" name="cat2" class="cat2 hidden">
                                <option value=""></option>
                            </select>
                            <div class="cat_list hidden" style="border:1px solid #ccc;">
                               <div class="checked_list" style="padding-left: 5px;">您选中：<span class="cat_name_list"></span></div>
                               <label style="margin-left: 4%;margin-bottom:5px;margin-top:5px;">二级:</label><span style="cursor:pointer;" class="two_checked" ></span>
                               <div><label  style="float:left;margin-left: 4%;">三级:</label><ul style="display: inline;" class="three_list">
                                   <li></li>
                               </ul></div>
                               <div style="clear:both;"></div>
                               <label style="padding-left:5px;">注意:只能选择一个二级分类或者选择多个三级分类</label>
                            </div>
                            <span class="set_category_submit hidden" >确定</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-11" style="z-index:0;">
                        <div id="start_all" class="click_but">全部展开</div><div id="stop_all" class="click_but">全部收起</div>
                           <form action="<?php echo Yii::app()->createUrl('Navigation/Nav_product_category_add');?>" method="post" enctype="multipart/form-data" id="product_category_form">
                           <input type="hidden"  name='nav' value=""/>
                           <input type='hidden' name='val' value='' />
                           <input type="hidden"  name='name' value=""/>
                           <input type='hidden' name='sort' value='' />
                           <input type='hidden' name='img_name' value='' />
                           <input type='hidden' name='parent' value='' />
                           <input type='hidden' name='cat_name' value='' />
                           <input type='hidden' name='highlight' value='' />
                           <table class="product_category_table" style="width:100%;border-collapse:collapse;border:1px solid #ccc;">
                           	<thead>
                           		<tr>
                                    <td width='5%'>名称</td>
                           			<td width='5%'>图片/分类名</td>
                           			<td width='4%'>是否高亮</td>
                           			<td width='5%'>排序</td>
                           			<td width='2%'>添加子类</td>
                           			<td width='5%'>操作</td>
                           		</tr>
                           	</thead>
                            <tbody  key='<?php if($product_category!=""){echo count($product_category);}else{echo "0";}?>'>
                            <?php if($product_category != ''){
                            	$pa_key = 1;
                            	$ch_key = 1;
                            	$count = count($product_category);
                            	foreach($product_category as $key=>$row){?>
	                           <tr edit='0' sort='<?php echo $row['sort_order']?>' parent='0' val='<?php echo $row['navigation_group_id']?>'>
						        <td class='text_center'><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $pa_key;?>'/><input readOnly='true' type='text' class='name' value='<?php echo $row["navigation_group_name"]?>' maxlength='20' /></td>  
						        <td class='text_center file_upload' k='<?php echo $key+1;?>' style='position: relative'><span class="title_text" style='float:none;'><?php $img_url = explode('/', $row['img_url']); echo $img_url[count($img_url)-1];?></span><span style="top:32px;" class="file-name large hidden" data-title="<?php echo $img_url[count($img_url)-1];?>"><img style='width:100px;' src="<?php echo Yii::app()->params['imgurl'].$row['img_url'];?>"></span></td>
						        <td class='text_center img'></td>      
						        <?php if($pa_key == 1 && $row['count']==1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($row['count']>1 && $pa_key != 1 && $row['count'] != $pa_key){?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($row['count']>1 && $pa_key == 1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else{?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }?>
						        <td class='text_center img'><span class='add_child'>添加</span></td>
						        <td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>
							  </tr>
							  <?php $pa_key++;$ch_key=1; if(isset($row['child'])){
							  	foreach($row['child'] as $k=>$val){
							  ?>
							  	<tr edit='0' sort='<?php echo $val['sort_order'];?>' parent='<?php echo $val['navigation_group_id']?>' val='<?php echo $val['navigation_group_cid']?>'>
								<td class='text_center'><label class='child_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $ch_key;?>'/><input readOnly='true' type='text' class='name' value='<?php echo $val['navigation_category_name']?>' maxlength='20' /></td>  
						        <td class='text_center' style='position: relative'><span class='set_category'><?php echo $val['cat_text'];?></span><span class='show_category_div hidden' val='<?php echo $val['mapping_id']?>'><?php echo $val['cat_text'];?></span></td>
						        <td class='text_center img'><input type='checkbox' <?php if($val['is_highlight']==1){echo "checked='checked'";}?> disabled="true"  class='highlight' /></td>      
						        <?php if($ch_key == 1  && $val['count']==1){?>
								<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
								<?php }else if($val['count']>1 && $ch_key != 1 && $val['count'] != $ch_key){?>
								<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
								<?php }else if($val['count']>1 && $ch_key == 1){?>
								<td class='text_center img'><label class='up_s'></label><label  class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
								<?php }else{?>
								<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
								<?php }?>
						        <td class='text_center img'></td>
						        <td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>
								</tr>
								<?php $ch_key++;}}}}?>
                            </tbody>
                           </table>
                           </form>
                           <div id="add_category_one">添加新栏目</div>
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row --> 
                            
                            
                        </div><!-- /.page-content -->
                </div><!-- /.main-content -->
                <?php
                    //删除确认框
                    $this->widget('ConfirmWidget',array(
                        'div_id'=>'dialog-confirm',
                        'title_content'=>yii::t('vcos', '这条记录将被永久删除，并且无法恢复。'),
                    ));
                ?>
                <?php
                    //批量删除确认框
                    $this->widget('ConfirmWidget',array(
                        'div_id'=>'dialog-confirm-multi',
                        'title_id'=>'isempty1',
                        'title_content'=>yii::t('vcos', '这些选中的记录将被永久删除，并且无法恢复。'),
                        'confirm_id'=>'isempty2',
                    ));
                ?>
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
<script src="<?php echo $theme_url; ?>/assets/js/jqPaginator.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min_s.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
		/**时间控件**/
		$('.datetimepicker_s').datetimepicker({step:1});
    	$('.datetimepicker_e').datetimepicker({step:1});
		$('.datetimepicker_res').datetimepicker({step:1});
    	$('.datetimepicker_ree').datetimepicker({step:1});
    	//$('.datetimepicker_des').datetimepicker({step:1});
    	//$('.datetimepicker_dee').datetimepicker({step:1});
        
		/**导航切换**/
		$("select[name='navigation_sel']").change(function(){
			var this_val = $(this).val();
			var this_type = $("select[name='navigation_sel'] option:selected").attr('type');
			var this_act = $("#checked_table table tbody").attr('act');
			//获取该选中导航下的类型
			this_type = this_type.split(',');
			if(this_type!=''){
				$(".nav_type_div").removeClass("hidden");
				$(".table_switch").removeClass("hidden");
				$("#checked_table").removeClass("hidden");
				$("#already_table").addClass("hidden");
				$("#del_table").addClass("hidden");
				$("#product_cateory").addClass("hidden"); 
				$(".table_switch>span[val=0]").removeClass("myself_current");
				$(".table_switch>span[val=2]").removeClass("myself_current");
				$(".table_switch>span[val=1]").addClass("myself_current");
				var str='';
				for(var i=0;i<this_type.length;i++){
					str += "<label style='margin-right: 15px;'>";
					var check = i==0?"checked='checked'":"";
					str += "<input "+check+"  style='margin-right:5px;' type='radio' name='nav_type' value='"+this_type[i]+"' />";
					var text = this_type[i]==1?'设置活动':(this_type[i]==2?'设置店铺':'设置商品');
					str += text;
					str += "</label>";
				}
				$(".nav_type_div").html(str);
				//第一个类型有改变
				if(this_type[0]==3){ 
					reset_category();
					$("#checked_table .type_product_category ").removeClass('hidden');
				}
				else{
					$("#checked_table .type_product_category ").addClass('hidden');
				}
				type_change(this_type[0]);
			}else{
				$(".nav_type_div").addClass("hidden");
				$(".table_switch").addClass("hidden");
				$("#checked_table").addClass("hidden");
				$("#already_table").addClass("hidden");
				$("#del_table").addClass("hidden");
				$("#product_cateory").removeClass("hidden");

				set_category_list(this_val);
				
			}
			
		});
		
		/**页面加载时触发全部分页**/
		<?php if($count >1&&$type_arr[0]!=''){?>
			all_page(<?php echo $count;?>,<?php echo $type_arr[0];?>);
		<?php }?>

		/**页面加载时触发选中分页**/
		<?php if($data_already_count >1){?>
			already_page(<?php echo $data_already_count;?>,<?php echo $type_arr[0];?>);
		<?php }?>

		/**页面加载时触发回收站分页**/
		<?php if($data_del_count >1){?>
			del_page(<?php echo $data_del_count;?>,<?php echo $type_arr[0];?>);
		<?php }?>


		/**类型选择改变**/
		$(document).on('click',".nav_type_div input[name='nav_type']",function(e){
			var this_val = $(this).val();
			var this_act = $("#checked_table table tbody").attr('act');
			if(this_val!=this_act){
				if(this_val==3){
					reset_category(); 
					$(".type_product_category ").removeClass('hidden');
					//$("#already_table .type_already_category ").removeClass('hidden');
				}
				else{
					$(".type_product_category ").addClass('hidden');
					//$("#already_table .type_already_category ").addClass('hidden');
				}
				type_change(this_val);
			}
		});

		/**商品分类：分类选择提交**/
		$("#checked_table .type_product_category input[type='submit']").click(function(){
			var nav = $("select[name='navigation_sel']").val();
			var this_one = $("#checked_table .type_product_category select[name='category_one']").val();
			var this_two = $("#checked_table .type_product_category select[name='category_two']").val();
			var this_three = $("#checked_table .type_product_category select[name='category_three']").val();
			<?php $path_url = Yii::app()->createUrl('Navigation/SetCategoryGetProduct');?>
			var data_para = 'nav='+nav+'&this_one='+this_one+'&this_two='+this_two+'&this_three='+this_three;
	        var mydate = new Date();
	    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
	    	
	        $.ajax({
	            url:"<?php echo $path_url;?>",
	            type:'post',
	            data:data_para,
	         	dataType:'json',
	        	success:function(data_all){
	            	var str = '';
	        		if(data_all != 0){
	        			var count = data_all['count'];
	            		var data = data_all['data'];
	            		var already = data_all['already'];
	            		var s_ids = [];
                		var s_sorts = [];
                		var cs_times = [];
                		var ce_times = [];
                		$.each(already,function(k){
                			s_ids[k] = already[k]['product_id']; 
                			s_sorts[k] = already[k]['sort_order'];
                			cs_times[k] = already[k]['start_show_time'];
                			ce_times[k] = already[k]['end_show_time'];
                    	});
		                $.each(data,function(key){
		                	var num_key = jQuery.inArray(data[key]['id'], s_ids);
                            if(num_key!=-1){var check="checked='checked'";var s_sort=s_sorts[num_key];var stimes=cs_times[num_key].slice(0,-3);var etimes=ce_times[num_key].slice(0,-3);}else{var check='';var s_sort='';var stimes='';var etimes='';}
		                	str += '<tr>';
	                        str += '<td class="center"><label>';
	                        str += '<input '+check+' type="checkbox" name="ids[]" value="'+data[key]['id']+'" class="ace isclick" />';    
	                        str += '<span class="lbl"></span></label></td>';
	                        str += '<td>'+(parseInt(key)+1)+'</td>';        
	                        str += '<td>'+data[key]['name']+'</td>';    
	                        //str += '<td><input type="text" name="sort[]" value="'+(parseInt(key)+1)+'"/></td>';
	                        str += '<td><input class="sort" style="width:40px;" maxlength="10" type="text" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  name="sort[]" value="'+s_sort+'"/></td>';
	                        str += "<td><input type='text' s_time='"+data[key]['s_time']+"' readonly='readonly' value='"+stimes+"' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    		str += "<td><input type='text' e_time='"+data[key]['e_time']+"' readonly='readonly' value='"+etimes+"' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		
	                        if(data[key]['s_time']){
                                if(data[key]['s_time']<=day_s &&　data[key]['e_time']>=day_s && data[key]['status']==1){
                                    var is = "未过期";
                                }else if(data[key]['s_time']>day_s && data[key]['status']==1){
                                	var is = "未上架";
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(data[key]['is_delete']){
                        		if(data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            str += '<td>'+is+'</td>';
	                        str += '</tr>';
	                      });
		                $("#checked_table table.all_t>tbody").html(str);
		                if(count > 1){$("input[name='all_page_num']").val(1);all_page(count,3,data_para);}
		                else $("#page_div").html('');
		                $('.datetimepicker_s').datetimepicker({step:1});
	                	$('.datetimepicker_e').datetimepicker({step:1});
		            }else{
		            	$("#checked_table table.all_t>tbody").html('');
		            	$("#page_div").html('');
			        }
	        	}      
	        });
		});
        
        
    	/**table切换**/
        $(".table_switch > span").click(function(){
        	$(".table_switch > span").removeClass('myself_current');
        	$(this).addClass('myself_current');
        	if($(this).attr('val')==0){
            	$("#already_table").removeClass('hidden');
            	$("#checked_table").addClass('hidden');
            	$("#del_table").addClass('hidden');
            }else if($(this).attr('val')==1){
            	$("#already_table").addClass('hidden');
            	$("#checked_table").removeClass('hidden');
            	$("#del_table").addClass('hidden');
            }else if($(this).attr('val')==2){
            	$("#already_table").addClass('hidden');
            	$("#checked_table").addClass('hidden');
            	$("#del_table").removeClass('hidden');
            }
    	});
		/**全部**/
        $('#checked_table table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
        /**选中**/
        $('#already_table table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });

        /**回收站**/
        $('#del_table table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
        /**商品分类**/
        $('#product_cateory table thead td input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });

        /**提交选中数据**/
        $("#checked_table .now_form .submit_but").click(function(){
            var this_nav = $("select[name='navigation_sel']").val();
            var this_type = $('.nav_type_div input[name="nav_type"]:checked').val();
            //获取全部选中
            var selected_obj = $("#checked_table table>tbody input[type='checkbox']:checked");
            //获取全部不选中
            var unselected_obj = $("#checked_table table>tbody input[type='checkbox']").not("input:checked");
            var mydate = new Date();
        	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
        	
            var sel_ids = '';
            var sel_sort = '';
            var unsel_ids = '';
            var sel_s_times = '';
            var sel_e_times = '';
            var flag = 1;
            
            if(selected_obj.length>0){
	            $.each(selected_obj,function(key){
	                var obj = $(this).parent().parent().parent();
	                var sort = $.trim(obj.find("input.sort").val());
	                sel_s_times += $.trim(obj.find(".datetimepicker_s").val())+':00'+',';
	                sel_e_times += $.trim(obj.find(".datetimepicker_e").val())+':00'+',';
					var s_time = $.trim(obj.find(".datetimepicker_s").attr("s_time"));
					var e_time = $.trim(obj.find(".datetimepicker_e").attr("e_time"));
					if(sort=='' || !((/^(\+|-)?\d+$/.test( sort ))&&sort>0)){
	                    flag = 0;return false;
	                }
					if(obj.find(".datetimepicker_e").val()<obj.find(".datetimepicker_s").val()){
						flag = 0;return false;
					}
					if(s_time!='' && e_time!=''){
					if(!(obj.find(".datetimepicker_s").val()>=s_time && obj.find(".datetimepicker_e").val()<=e_time)){
						flag = -1;alert("'"+obj.find("td").eq(2).html()+"'"+"的日期选择应在日期范围内！");return false;
					}}
					
	                sel_sort += obj.find("input.sort").val()+',';
	            	sel_ids += $(this).val()+',';
	            });
	            if(flag==0){alert("勾选项排序和时间不能为空,且结束时间大于开始时间!");return false;}
	            if(flag==-1){return false;}
            }
            sel_ids = sel_ids.substring(0,sel_ids.length-1);
            sel_sort = sel_sort.substring(0,sel_sort.length-1);
            sel_s_times = sel_s_times.substring(0,sel_s_times.length-1);
            sel_e_times = sel_e_times.substring(0,sel_e_times.length-1);
            $.each(unselected_obj,function(key){
            	unsel_ids += $(this).val()+',';
            });
            unsel_ids = unsel_ids.substring(0,unsel_ids.length-1);
            var data = 'nav='+this_nav+'&type='+this_type+'&sel_ids='+sel_ids+'&sel_sort='+sel_sort+'&unsel_ids='+unsel_ids+'&sel_s_times='+sel_s_times+'&sel_e_times='+sel_e_times;
			
            <?php $path_url = Yii::app()->createUrl('Navigation/UpdateNavigationTypeCategory');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0) {alert("修改失败!");return false;}
            		if(data_all!=0){
                		alert("修改成功!");
                		var count = data_all['count'];
                		var data = data_all['data'];
                		var del_count = data_all['del_count'];
                		var del_data = data_all['del_data'];
                		var str = '';
                		//选中
                		if(data.length>0){
	                		$.each(data,function(key){
	                			str += '<tr>';
	                            str += '<td class="center"><label>';
	                            str += '<input type="checkbox"  name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';    
	                            str += '<span class="lbl"></span></label></td>';
	                            str += '<td>'+(parseInt(key)+1)+'</td>';          
	                            str += '<td>'+data[key]['title']+'</td>';
	                            str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+data[key]['sort_order']+'"/></td>';
	                            if(this_type!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
	                            str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                    		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                    		if(this_type!=2){
	                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
	                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                    		}
	                            //if(data[key]['is_overdue']==1){var is="已过期";}else{var is = "未过期";}
	                            if(data[key]['s_time']){
	                                if(data[key]['s_time']<=data[key]['start_show_time'] &&　data[key]['e_time']>=data[key]['end_show_time'] && data[key]['status']==1){
	                                 	if(data[key]['start_show_time']<=day_s && data[key]['end_show_time']>=day_s){
	                                 		var is = "未过期";
		                                }else if(data[key]['start_show_time']>day_s){
		                                	var is = "未上架";
			                            }else{
			                            	var is = "已过期";
				                        }
	                                }else{
	                                    var is = "已过期";
	                                }
	                            }else{
	                                if(data[key]['status']==1){
	                                    var is = "未过期";
	                                }else{
	                                    var is = "已过期";
	                                }
	                            }
		                        if(data[key]['is_delete']){
	                        		if(data[key]['is_delete']==1){
	                        			$is = "已过期";
	                        		}else{
	                        			if(is == "未过期"){
	                                    	var is = "未过期";
	                                    }else if(is == "未上架"){
	                                    	var is = "未上架";
	                                    }else{
	                                    	var is = "已过期";
	                                    }
	                        		}
	                        	}
	                            str += '<td>'+is+'</td>';
	                            str += '</tr>';
	                    	})
	                    	$("#already_table table.already_t>tbody").html(str);
	                		if(count>1){$("input[name='checked_page_num']").val(1);already_page(count,this_type);}
	                		else $("#page_already_div").html('');
	                		$('.datetimepicker_res').datetimepicker({step:1});
		                	$('.datetimepicker_ree').datetimepicker({step:1});
                		}else{
                			$("#already_table table.already_t>tbody").html('');
                			$("#page_already_div").html('');
                    	}

						//回收站
                		var del_str = '';
                		if(del_data.length>0){
	                		$.each(del_data,function(key){
	                			del_str += '<tr>';
	                			del_str += '<td class="center"><label>';
	                			del_str += '<input type="checkbox"  name="ids[]" value="'+del_data[key]['product_id']+'" class="ace isclick" />';    
	                			del_str += '<span class="lbl"></span></label></td>';
	                			del_str += '<td>'+(parseInt(key)+1)+'</td>';          
	                			del_str += '<td>'+del_data[key]['title']+'</td>';
	                			del_str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+del_data[key]['sort_order']+'"/></td>';
	                            if(this_type!=2){var s_times=del_data[key]['s_time'];var e_times=del_data[key]['e_time'];}else{var s_times='';var e_times='';}
	                            del_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                            del_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                    		if(this_type!=2){
	                    		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
	                    		del_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                    		}
	                            //if(del_data[key]['is_overdue']==1){var is="已过期";}else{var is = "未过期";}
	                    		if(del_data[key]['s_time']){
	                                if(del_data[key]['s_time']<=del_data[key]['start_show_time'] &&　del_data[key]['e_time']>=del_data[key]['end_show_time'] && del_data[key]['status']==1){
	                                 	if(del_data[key]['start_show_time']<=day_s && del_data[key]['end_show_time']>=day_s){
	                                 		var is = "未过期";
		                                }else if(del_data[key]['start_show_time']>day_s){
		                                	var is = "未上架";
			                            }else{
			                            	var is = "已过期";
				                        }
	                                }else{
	                                    var is = "已过期";
	                                }
	                            }else{
	                                if(del_data[key]['status']==1){
	                                    var is = "未过期";
	                                }else{
	                                    var is = "已过期";
	                                }
	                            }
		                        if(del_data[key]['is_delete']){
	                        		if(del_data[key]['is_delete']==1){
	                        			$is = "已过期";
	                        		}else{
	                        			if(is == "未过期"){
	                                    	var is = "未过期";
	                                    }else if(is == "未上架"){
	                                    	var is = "未上架";
	                                    }else{
	                                    	var is = "已过期";
	                                    }
	                        		}
	                        	}
	                            del_str += '<td>'+is+'</td>';
	                            del_str += '</tr>';
	                    	})
	                    	$("#del_table table.del_t>tbody").html(del_str);
	                		if(del_count>1){$("input[name='delete_page_num']").val(1);del_page(del_count,this_type);}
	                		else $("#page_del_div").html('');
                		}else{
                			$("#del_table table.del_t>tbody").html('');
                			$("#page_del_div").html('');
                    	}

                	}
            	}        
            });

        });

        /**已选页面提交修改记录**/
        $("#already_table .submit_but_update").click(function(){
        	var this_nav = $("select[name='navigation_sel']").val();
            var this_type = $('.nav_type_div input[name="nav_type"]:checked').val();
            var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
            //获取已经选中页面选中
            var selected_obj = $("#already_table table>tbody input[type='checkbox']:checked");
            //获取全部页面是元素
            var checked_all_obj = $("#checked_table table>tbody input[type='checkbox']");
            if(selected_obj.length<1){alert("请勾选需要修改的记录!");return false;}
            var sel_ids = '';
            var sel_sort = '';
            var sel_s_times = '';
			var sel_e_times = '';
            var flag = 1;
            $.each(selected_obj,function(key){
                var obj = $(this).parent().parent().parent();
                var sort = obj.find("input.sort").val();
                sel_s_times += obj.find(".datetimepicker_res").val()+':00'+',';
                sel_e_times += obj.find(".datetimepicker_ree").val()+':00'+',';
				var s_time = obj.find(".datetimepicker_res").attr("s_time");
				var e_time = obj.find(".datetimepicker_ree").attr("e_time");
                if(sort=='' || obj.find(".datetimepicker_res").val()=='' || obj.find(".datetimepicker_ree").val()=='' || !((/^(\+|-)?\d+$/.test( sort ))&&sort>0)){
                    flag = 0;return false;
                }
                if(obj.find(".datetimepicker_ree").val()<obj.find(".datetimepicker_res").val()){
					flag = 0;return false;
				}
				if(!(obj.find(".datetimepicker_res").val()>=s_time && obj.find(".datetimepicker_ree").val()<=e_time)){
					flag = -1;alert("'"+obj.find("td").eq(2).html()+"'"+"的日期选择应在日期范围内！");return false;
				}
                sel_sort += obj.find("input.sort").val()+',';
            	sel_ids += $(this).val()+',';
            });
            if(flag==0){alert("勾选项排序和时间不能为空，且结束时间大于开始时间!");return false;}
            if(flag==-1){return false;}
            
            sel_ids = sel_ids.substring(0,sel_ids.length-1);
            sel_sort = sel_sort.substring(0,sel_sort.length-1);
            sel_s_times = sel_s_times.substring(0,sel_s_times.length-1);
            sel_e_times = sel_e_times.substring(0,sel_e_times.length-1);
            
            var data = 'nav='+this_nav+'&type='+this_type+'&sel_ids='+sel_ids+'&sel_sort='+sel_sort+'&sel_s_times='+sel_s_times+'&sel_e_times='+sel_e_times;
            <?php $path_url = Yii::app()->createUrl('Navigation/UpdateAlreadyProductActivity');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:data,
             	dataType:'json',
            	success:function(data){
                	if(data==0) {alert("修改失败!");return false;}
            		if(data!=0){
                		alert("修改成功!");
                		var is_delete = new Array();
                		$.each(data,function(k){
                            is_delete[data[k]['product_id']] = data[k]['is_overdue'];
                        });
                        $.each(selected_obj,function(){
                            var obj = $(this).parent().parent().parent();
                            var id = $(this).val();
                            var s_time = obj.find('.datetimepicker_res').val();
                            var e_time = obj.find('.datetimepicker_ree').val();
                            var is_del = is_delete[id]==1?"已过期":(s_time<=day_s&&e_time>=day_s?"未过期":"未上架");
                            $(this).parent().parent().parent().find("td:last").html(is_del);
                        });
                		//判断全选页面中是否存在刚修改的记录
                		var selected_arr = sel_ids.split(',');
                		var selected_sort_arr = sel_sort.split(',');
                		var selected_stime_arr = sel_s_times.split(',');
                		var selected_etime_arr = sel_e_times.split(',');
                		$.each(checked_all_obj,function(key){
                    		var val = $(this).val();
                    		var num = $.inArray(val, selected_arr);
                    		if(num!=-1){
                        		$(this).parent().parent().parent().find("input.sort").val(selected_sort_arr[num]);
                        		$(this).parent().parent().parent().find("input.datetimepicker_s").val(selected_stime_arr[num].slice(0,-3));
                        		$(this).parent().parent().parent().find("input.datetimepicker_e").val(selected_etime_arr[num].slice(0,-3));
                        	}
                    	});
                		/*$.each(selected_obj,function(key){
                    		$(this).removeAttr('checked');
                    	});*/
                		selected_obj.removeAttr("checked");
                	}
            	}        
            });
        });


        /**已选页面提交移除选中记录**/
        $("#already_table .submit_but_del").click(function(){
        	var this_nav = $("select[name='navigation_sel']").val();
            var this_type = $('.nav_type_div input[name="nav_type"]:checked').val();
            //获取已选的选中
            var selected_obj = $("#already_table table>tbody input[type='checkbox']:checked");
            //获取全部中的勾选
            var checked_all_obj = $("#checked_table table>tbody input[type='checkbox']:checked");
            var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
            if(selected_obj.length<1){alert("请勾选需要取消的记录!");return false;}
            var ids_str = '';
            $.each(selected_obj,function(key){
            	ids_str += $(this).val()+',';
            });
            ids_str = ids_str.substring(0,ids_str.length-1);
            <?php $path_url = Yii::app()->createUrl('Navigation/DelAlreadyProductActivity');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'nav='+this_nav+'&type='+this_type+'&ids='+ids_str,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("移除失败!");return false;}
                	if(data_all!=0){
                    	alert("移除成功!");
                    	var count = data_all['count'];
                    	var data = data_all['data'];
                    	var del_count = data_all['del_count'];
                    	var del_data = data_all['del_data'];
                		var str = '';
                		//选中
                		$.each(data,function(key){
                			str += '<tr>';
                            str += '<td class="center"><label>';
                            str += '<input type="checkbox"  name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';    
                            str += '<span class="lbl"></span></label></td>';
                            str += '<td>'+(parseInt(key)+1)+'</td>';          
                            str += '<td>'+data[key]['title']+'</td>';
                            str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+data[key]['sort_order']+'"/></td>';
                            if(this_type!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                            str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(this_type!=2){
                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		}
                            //if(data[key]['is_overdue']==1){var is="已过期";}else{var is="未过期";}
                    		if(data[key]['s_time']){
                                if(data[key]['s_time']<=data[key]['start_show_time'] &&　data[key]['e_time']>=data[key]['end_show_time'] && data[key]['status']==1){
                                 	if(data[key]['start_show_time']<=day_s && data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(data[key]['is_delete']){
                        		if(data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            str += '<td>'+is+'</td>';
                            str += '</tr>';
                    	})
                    	$("#already_table table.already_t>tbody").html(str);
                		if(count>1){$("input[name='checked_page_num']").val(1);already_page(count,this_type);}
                		else $("#page_already_div").html('');

                		$('.datetimepicker_res').datetimepicker({step:1});
	                	$('.datetimepicker_ree').datetimepicker({step:1});

						//回收站
                		var del_str = '';
                		$.each(del_data,function(key){
                			del_str += '<tr>';
                			del_str += '<td class="center"><label>';
                			del_str += '<input type="checkbox"  name="ids[]" value="'+del_data[key]['product_id']+'" class="ace isclick" />';    
                			del_str += '<span class="lbl"></span></label></td>';
                			del_str += '<td>'+(parseInt(key)+1)+'</td>';          
                			del_str += '<td>'+del_data[key]['title']+'</td>';
                			del_str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+del_data[key]['sort_order']+'"/></td>';
                            if(this_type!=2){var s_times=del_data[key]['s_time'];var e_times=del_data[key]['e_time'];}else{var s_times='';var e_times='';}
                            del_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                            del_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(this_type!=2){
                    		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
                    		del_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		}
                           // if(del_data[key]['is_overdue']==1){var is="已过期";}else{var is="未过期";}
                    		if(del_data[key]['s_time']){
                                if(del_data[key]['s_time']<=del_data[key]['start_show_time'] &&　del_data[key]['e_time']>=del_data[key]['end_show_time'] && del_data[key]['status']==1){
                                 	if(del_data[key]['start_show_time']<=day_s && del_data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(del_data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(del_data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(del_data[key]['is_delete']){
                        		if(del_data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            del_str += '<td>'+is+'</td>';
                            del_str += '</tr>';
                    	})
                    	$("#del_table table.del_t>tbody").html(del_str);
                		if(del_count>1){$("input[name='delete_page_num']").val(1);del_page(del_count,this_type);}
                		else $("#page_del_div").html('');


                		

                		//判断全部中是否存在删除记录的勾选状态，存在则清空，
                		var selected_arr = ids_str.split(',');
                		$.each(checked_all_obj,function(){
                    		var obj = $(this).parent().parent().parent();
                    		var val = $(this).val();
                    		if($.inArray(val, selected_arr)!=-1){
                    			obj.find("input[type='checkbox']").removeAttr('checked');
                    			obj.find("input.sort").val('');
                    			obj.find("input.datetimepicker_s").val('');
                    			obj.find("input.datetimepicker_e").val('');
                        	}
                    	});
                	}
            	}        
            });
		});
       


        /**分类筛选:一级**/
        $("#checked_table select[name='category_one']").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
            	$("#checked_table select[name='category_two']").addClass('hidden');
            	$("#checked_table select[name='category_three']").addClass('hidden');
            	return false;
            }
            $("#checked_table select[name='category_two']").removeClass('hidden');
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
            		$("#checked_table select[name='category_two']").html(str);
            		$("#checked_table select[name='category_three']").addClass('hidden');
            	}        
            });

        });

        /**改变分类二级,获取三级**/
        $("#checked_table select[name='category_two']").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
            	$("#checked_table select[name='category_three']").addClass('hidden');
            	return false;
            }
            $("#checked_table select[name='category_three']").removeClass('hidden');
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
            		$("#checked_table select[name='cat3_all_sel']").html(str);
            		$("#checked_table select[name='category_three']").html(str);
            	}      
            });
        });



        /***回收站****/
        //清除选中
        $("#del_table .submit_but_remove").click(function(){
        	var this_nav = $("select[name='navigation_sel']").val();
            var this_type = $('.nav_type_div input[name="nav_type"]:checked').val();
            var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
           //获取已选的选中
            var selected_obj = $("#del_table table>tbody input[type='checkbox']:checked");
            if(selected_obj.length<1){alert("请勾选需要清除的记录!");return false;}
            var ids_str = '';
            $.each(selected_obj,function(key){
            	ids_str += $(this).val()+',';
            });
            ids_str = ids_str.substring(0,ids_str.length-1);
            <?php $path_url = Yii::app()->createUrl('Navigation/RemoveDelProductActivity');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'nav='+this_nav+'&type='+this_type+'&ids='+ids_str,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("清除失败!");return false;}
                	if(data_all!=0){
                    	alert("清除成功!");
                    	var del_count = data_all['count'];
                    	var del_data = data_all['data'];
						//回收站
                		var del_str = '';
                		$.each(del_data,function(key){
                			del_str += '<tr>';
                			del_str += '<td class="center"><label>';
                			del_str += '<input type="checkbox"  name="ids[]" value="'+del_data[key]['product_id']+'" class="ace isclick" />';    
                			del_str += '<span class="lbl"></span></label></td>';
                			del_str += '<td>'+(parseInt(key)+1)+'</td>';          
                			del_str += '<td>'+del_data[key]['title']+'</td>';
                			del_str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+del_data[key]['sort_order']+'"/></td>';
                            if(this_type!=2){var s_times=del_data[key]['s_time'];var e_times=del_data[key]['e_time'];}else{var s_times='';var e_times='';}
                            del_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                            del_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(this_type!=2){
                    		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['child']['e_time'].slice(0,-3);}
                    		del_str += "<td>"+del_data[key]['child']['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		}
                            //if(del_data[key]['is_overdue']==1){var is="已过期";}else{var is="未过期";}
                    		if(del_data[key]['s_time']){
                                if(del_data[key]['s_time']<=del_data[key]['start_show_time'] &&　del_data[key]['e_time']>=del_data[key]['end_show_time'] && del_data[key]['status']==1){
                                 	if(del_data[key]['start_show_time']<=day_s && del_data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(del_data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(del_data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(del_data[key]['is_delete']){
                        		if(del_data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            del_str += '<td>'+is+'</td>';
                            del_str += '</tr>';
                    	})
                    	$("#del_table table.del_t>tbody").html(del_str);
                		if(del_count>1){$("input[name='delete_page_num']").val(1);del_page(del_count,this_type);}
                		else $("#page_del_div").html('');
                	}
            	}        
            });
            
        });


        //恢复选中
        $("#del_table .submit_but_recovery").click(function(){
        	var this_nav = $("select[name='navigation_sel']").val();
            var this_type = $('.nav_type_div input[name="nav_type"]:checked').val();
            var mydate = new Date();
	        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
	        
            //获取已选的选中
            var selected_obj = $("#del_table table>tbody input[type='checkbox']:checked");
			if(selected_obj.length<1){alert("请勾选需要恢复的记录!");return false;}
			var ids = '';
			var sorts = new Array();
			var sel_s_times = new Array();
			var sel_e_times = new Array();
			var product_ids = new Array();
			var flag = 1;
			$.each(selected_obj,function(k){
				ids += $(this).val()+',';
				product_ids[k] = $(this).val();
				sorts[k] = $(this).parent().parent().parent().find('input.sort').val();
				sel_s_times[k] = $(this).parent().parent().parent().find('.datetimepicker_des').val();
				sel_e_times[k] = $(this).parent().parent().parent().find('.datetimepicker_dee').val();
				
			});
			
			ids = ids.substring(0,ids.length-1);
            <?php $path_url = Yii::app()->createUrl('Navigation/RecoveryDelProductActivity');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'nav='+this_nav+'&type='+this_type+'&ids='+ids,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all==0){alert("恢复失败!");return false;}
                	if(data_all!=0){
                    	alert("恢复成功!");
                    	
                    	var count = data_all['count'];
                    	var data = data_all['data'];
                    	var del_count = data_all['del_count'];
                    	var del_data = data_all['del_data'];
                		var str = '';
                		//选中
                		$.each(data,function(key){
                			str += '<tr>';
                            str += '<td class="center"><label>';
                            str += '<input type="checkbox"  name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';    
                            str += '<span class="lbl"></span></label></td>';
                            str += '<td>'+(parseInt(key)+1)+'</td>';          
                            str += '<td>'+data[key]['title']+'</td>';
                            str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+data[key]['sort_order']+'"/></td>';
                            if(this_type!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                            str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                    		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(this_type!=2){
                    		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                    		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		}
                            //if(data[key]['is_overdue']==1){var is="已过期";}else{var is="未过期";}
                    		if(data[key]['s_time']){
                                if(data[key]['s_time']<=data[key]['start_show_time'] &&　data[key]['e_time']>=data[key]['end_show_time'] && data[key]['status']==1){
                                 	if(data[key]['start_show_time']<=day_s && data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(data[key]['is_delete']){
                        		if(data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            str += '<td>'+is+'</td>';
                            str += '</tr>';
                    	})
                    	$("#already_table table.already_t>tbody").html(str);
                		if(count>1){$("input[name='checked_page_num']").val(1);already_page(count,this_type);}
                		else $("#page_already_div").html('');

                		$('.datetimepicker_res').datetimepicker({step:1});
	                	$('.datetimepicker_ree').datetimepicker({step:1});

						//回收站
                		var del_str = '';
                		$.each(del_data,function(key){
                			del_str += '<tr>';
                			del_str += '<td class="center"><label>';
                			del_str += '<input type="checkbox"  name="ids[]" value="'+del_data[key]['product_id']+'" class="ace isclick" />';    
                			del_str += '<span class="lbl"></span></label></td>';
                			del_str += '<td>'+(parseInt(key)+1)+'</td>';          
                			del_str += '<td>'+del_data[key]['title']+'</td>';
                			del_str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+del_data[key]['sort_order']+'"/></td>';
                            if(this_type!=2){var s_times=del_data[key]['s_time'];var e_times=del_data[key]['e_time'];}else{var s_times='';var e_times='';}
                            del_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                            del_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                    		if(this_type!=2){
                    		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
                    		del_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                    		}
                           // if(del_data[key]['is_overdue']==1){var is="已过期";}else{var is="未过期";}
                    		if(del_data[key]['s_time']){
                                if(del_data[key]['s_time']<=del_data[key]['start_show_time'] &&　del_data[key]['e_time']>=del_data[key]['end_show_time'] && del_data[key]['status']==1){
                                 	if(del_data[key]['start_show_time']<=day_s && del_data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(del_data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(del_data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(del_data[key]['is_delete']){
                        		if(del_data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
                            del_str += '<td>'+is+'</td>';
                            del_str += '</tr>';
                    	})
                    	$("#del_table table.del_t>tbody").html(del_str);
                		if(del_count>1){$("input[name='delete_page_num']").val(1);del_page(del_count,this_type);}
                		else $("#page_del_div").html('');

                		//判断全部中是否存在回收站记录的勾选状态，存在则恢复记录，
                		$("#checked_table table>tbody input[type='checkbox']").each(function(){
                        	var num = $.inArray($(this).val(), product_ids);
                        	if(num!=-1){
                            	$(this).prop("checked","true");
                            	$(this).parent().parent().parent().find('.sort').val(sorts[num]);
                            	$(this).parent().parent().parent().find('.datetimepicker_s').val(sel_s_times[num]);
                            	$(this).parent().parent().parent().find('.datetimepicker_e').val(sel_e_times[num]);
                            }
                        });
                	}
            	}        
            });
        });

/****************商品分类***************************************************/

 	<?php
	     $this->widget('UploadjsWidget',array('form_id'=>'product_category_form'));
	   ?>
	  $("#product_cateory").find("input[type='file']").parent().find(".file-label").removeAttr("class");
		var nav = $("select[name='navigation_sel']").val();
		
		//添加商品分类
		$("#add_category_one").click(function(){
			var nav = $("select[name='navigation_sel']").val();
			var num =$("#product_cateory table tbody tr[edit='1']").length;
			if(num != 0){
				alert('正在执行操作,不能继续操作!');
				return false;
			}
			var tr_count = $("#product_cateory table>tbody").find("tr[parent='0']").length;
			var url = "<?php echo $theme_url; ?>"+'/assets/images';
			var downs_img = "<img src='"+url+"/sh_01.png' />";
			var down_img = "<img src='"+url+"/sh_04.png' />";
			//获取该商品图片的最大排序
			var sort = 1;
			<?php $path_url = Yii::app()->createUrl('Navigation/NavigationGroupGetMaxSort');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'nav='+nav,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		if(data != ''){
			    		sort = data;
			    		sort = parseInt(sort)+1;
			    	}
		    	}      
		    });
		    var key = $("#product_cateory table>tbody").attr('key');
			key = parseInt(key)+1;
			var number_key = tr_count+1;
			var str = '';
			str += "<tr edit='1' sort='"+sort+"' parent='0' val='' style='background:#78d7e8'>";
	        str += "<td class='text_center'><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='name' value='' maxlength='20' /></td>";  
	        str += "<td class='text_center file_upload' k='"+key+"'><input type='file' name='product_category"+key+"'  /></td>";
	        str += "<td class='text_center img'></td>";      
	        if(tr_count == 0){
				str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
			}else{
				str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
			}         
			str += "<td class='text_center img'><span class='add_child'>添加</span></td>";
	        str += "<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>";
			str += "</tr>";
			
			if(tr_count != 0){
				$("#product_cateory .product_category_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down_s").html(downs_img);
				$("#product_cateory .product_category_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down").html(down_img);
			}
			$("#product_cateory .product_category_table > tbody").append(str); 
			
			<?php
		       $this->widget('UploadjsWidget',array('form_id'=>'product_category_form'));
		    ?>
		    $("#product_cateory").find("input[type='file']").parent().find(".file-label").removeAttr("class");
		});

		//添加子类
 		$(document).on('click',"#product_cateory .add_child",function(e){
 			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			var parent_code = $(this).parent().parent().attr('val');
 			var child_tr_count = $("#product_cateory table>tbody").find("tr[parent='"+parent_code+"']").length;
 			var number_key = child_tr_count+1;
 			var url = "<?php echo $theme_url; ?>"+'/assets/images';
 			//获取该商品图片的最大排序
			var sort = 1;
			<?php $path_url = Yii::app()->createUrl('Navigation/NavigationGroupGetMaxSort');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'parent='+parent_code,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		if(data != ''){
			    		sort = data;
			    		sort = parseInt(sort)+1;
			    	}
		    	}      
		    });
 			var  str = '';
 			str += "<tr edit='1' sort='"+sort+"' parent='"+parent_code+"' val='' style='background:#78d7e8'>";
			str += "<td class='text_center'><label class='child_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='name' value='' maxlength='20' /></td>";  
	        str += "<td class='text_center' style='position: relative'><span class='set_category set_category_but'>设置分类</span><span class='show_category_div hidden' val=''></span></td>";
	        str += "<td class='text_center img'><input type='checkbox' class='highlight' /></td>";      
	        if(child_tr_count == 0){
 				str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
 			}else{
 				str += "<td class='text_center img'><label class='up_s'><img src='"+url+"/sh_02.png' /></label><label class='up'><img src='"+url+"/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
 			}
 			str += "<td class='text_center img'></td>";
 			str += "<td class='text_center img'><label><img class='success_but' src='"+url+"/sh_06.png' /></label><label><img class='edit_but' src='"+url+"/sh_07.png' /></label><label><img class='del_but' src='"+url+"/sh_05.png' /></label></td>";
			str += "</tr>";
 			
 			var downs_img = "<img src='"+url+"/sh_01.png' />";
 			var down_img = "<img src='"+url+"/sh_04.png' />";
 			if(child_tr_count != 0){
 				$("#product_cateory table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down_s").html(downs_img);
 				$("#product_cateory table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down").html(down_img);
 			}
 			if(child_tr_count == 0)
 			$(this).parent().parent().after(str);
 			else
 			$("#product_cateory table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).after(str);
 		});
        
		//提交
		$(document).on('click','#product_cateory .success_but',function(e){
			var obj = $(this).parent().parent().parent();
			if(obj.attr('edit')==0) return false;
			var nav = $("select[name='navigation_sel']").val();
			var parent = obj.attr('parent');
			var sort = obj.attr('sort');
			var val = obj.attr("val");
			var name = obj.find("input[class='name']").val();
			if(val==''){
				//新增
				if(parent == 0){
					//一级：导航组
					var flag = 1;
					var img_name =obj.find("input[type='file']").attr('name');
					var img = obj.find(".title_text").html();
					if($.trim(name)==''&&$.trim(img)==''){
						alert("名称和图片为必填!");flag = 0;return false;
					}else if($.trim(name)==''){
						alert("名称不能为空 ！");flag = 0;return false;
					}else if($.trim(img)==''){
						alert("图片必选!");flag = 0;return false;
					}
					//判断商品名是否唯一
					<?php $path_url = Yii::app()->createUrl('Navigation/CheckCategoryName');?>
				    $.ajax({
				        url:"<?php echo $path_url;?>",
				        type:'get',
				        data:'nav='+nav+'&name='+name,
				        async:false,
				     	dataType:'json',
				    	success:function(data){
				    		if(data==0){alert("商品分类名称已存在,请更换!"); flag=0;}
				    	}      
				    });
					if(flag==0) return false;
					$("#product_cateory #product_category_form input[name='name']").val(name);
					$("#product_cateory #product_category_form input[name='sort']").val(sort);
					$("#product_cateory #product_category_form input[name='img_name']").val(img_name);
					$("#product_cateory #product_category_form input[name='parent']").val(parent);
					$("#product_cateory #product_category_form input[name='nav']").val(nav);
					$("#product_cateory #product_category_form input[name='cat_name']").val('');
					$("#product_cateory #product_category_form input[name='highlight']").val('');
					$("#product_cateory #product_category_form input[name='val']").val('');
					$("#product_cateory form").submit();
				}else{
					var flag = 1;
					var cat_name = obj.find(".show_category_div").attr('val');
					//cat_name = cat_name.substr(0,cat_name.length-1);
					
					var highlight = obj.find('.highlight').is(":checked");
					if(name==''&&cat_name==''){
						alert("名称和分类必选!");flag = 0;return false;
					}else if(name==''){
						alert("名称不能为空!");flag = 0;return false;
					}else if(cat_name == ''){
						alert("分类不能为空!");flag = 0;return false;
					}
					//判断商品名是否唯一
					<?php $path_url = Yii::app()->createUrl('Navigation/CheckCategoryName');?>
				    $.ajax({
				        url:"<?php echo $path_url;?>",
				        type:'get',
				        data:'nav='+nav+'&name='+name+'&parent='+parent,
				        async:false,
				     	dataType:'json',
				    	success:function(data){
				    		if(data==0){alert("商品分类名称已存在,请更换!"); flag=0;}
				    	}      
				    });
					if(flag==0) return false;
					if(highlight==true){var highlight_val=1;}else{ var highlight_val=0;}
					$("#product_cateory #product_category_form input[name='name']").val(name);
					$("#product_cateory #product_category_form input[name='sort']").val(sort);
					$("#product_cateory #product_category_form input[name='img_name']").val('');
					$("#product_cateory #product_category_form input[name='parent']").val(parent);
					$("#product_cateory #product_category_form input[name='nav']").val(nav);
					$("#product_cateory #product_category_form input[name='cat_name']").val(cat_name);
					$("#product_cateory #product_category_form input[name='highlight']").val(highlight_val);
					$("#product_cateory #product_category_form input[name='val']").val('');
					$("#product_cateory form").submit();
				}	
			}else{
				//修改
				if(parent==0){
					//一级：导航组
					var flag = 1;
					var img_name =obj.find("input[type='file']").attr('name');
					var img = obj.find(".title_text").html();
					if(name==''){
						alert("名称不能为空 ！");flag = 0;return false;
					}
					//判断商品名是否唯一
					<?php $path_url = Yii::app()->createUrl('Navigation/CheckCategoryName');?>
				    $.ajax({
				        url:"<?php echo $path_url;?>",
				        type:'get',
				        data:'val='+val+'&nav='+nav+'&name='+name+'&parent=0',
				        async:false,
				     	dataType:'json',
				    	success:function(data){
				    		if(data==0){alert("商品分类名称已存在,请更换!"); flag=0;}
				    	}      
				    });  
					if(flag==0) return false;
					$("#product_cateory #product_category_form input[name='name']").val(name);
					$("#product_cateory #product_category_form input[name='sort']").val(sort);
					$("#product_cateory #product_category_form input[name='img_name']").val(img_name);
					$("#product_cateory #product_category_form input[name='parent']").val(parent);
					$("#product_cateory #product_category_form input[name='nav']").val(nav);
					$("#product_cateory #product_category_form input[name='cat_name']").val('');
					$("#product_cateory #product_category_form input[name='highlight']").val('');
					$("#product_cateory #product_category_form input[name='val']").val(val);
					$("#product_cateory form").submit();
				}else{
					var flag = 1;
					var cat_name = obj.find(".show_category_div").attr('val');
					
					var highlight = obj.find('.highlight').is(":checked");
					if(name==''&&cat_name==''){
						alert("名称和分类必选!");flag = 0;return false;
					}else if(name==''){
						alert("名称不能为空!");flag = 0;return false;
					}else if(cat_name == ''){
						alert("分类不能为空!");flag = 0;return false;
					}
					//判断商品名是否唯一
					<?php $path_url = Yii::app()->createUrl('Navigation/CheckCategoryName');?>
				    $.ajax({
				        url:"<?php echo $path_url;?>",
				        type:'get',
				        data:'nav='+nav+'&val='+val+'&parent='+parent+'&name='+name,
				        async:false,
				     	dataType:'json',
				    	success:function(data){
				    		if(data==0){alert("商品分类名称已存在,请更换!"); flag=0;}
				    	}      
				    });  
					if(flag==0) return false;
					if(highlight==true){var highlight_val=1;}else{ var highlight_val=0;}
					$("#product_cateory #product_category_form input[name='name']").val(name);
					$("#product_cateory #product_category_form input[name='sort']").val(sort);
					$("#product_cateory #product_category_form input[name='img_name']").val('');
					$("#product_cateory #product_category_form input[name='parent']").val(parent);
					$("#product_cateory #product_category_form input[name='nav']").val(nav);
					$("#product_cateory #product_category_form input[name='cat_name']").val(cat_name);
					$("#product_cateory #product_category_form input[name='highlight']").val(highlight_val);
					$("#product_cateory #product_category_form input[name='val']").val(val);
					$("#product_cateory form").submit();
				}
			}
			
			
			//$("#product_cateory form").submit();
		});
		//删除
		$(document).on('click','#product_cateory .del_but',function(e){
			var num =$("#product_cateory table tbody tr[edit='1']").length;
			var nav = $("select[name='navigation_sel']").val();
			var obj = $(this).parent().parent().parent();
 			var val = $.trim(obj.attr('val'));
 			var edit = $.trim(obj.attr('edit'));
			var parent = $.trim(obj.attr('parent'));
 			if(num != 0&&edit==0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			
			if(val==''){
				alert('删除成功!');
	        	location.href = "<?php echo Yii::app()->createUrl("Navigation/nav_column_set",array('act'=>'category','op'=>'1'))?>/nav/"+nav;//location.href实现客户端页面的跳转
	        	return false;  
			}
			
			if(parent == 0){
				var childs = $("#product_cateory table tbody>tr[parent='"+val+"']").length;
				if(childs==0){
					var q = confirm("确定是否删除该栏目？");
				}else{
					var q = confirm("该栏目存在子类，确定是否删除该栏目并全部该栏目下的子类？");
				}
			}else{
				var q = confirm("确定是否删除该栏目？");
			}
			if(q == false)return false;
			<?php $path_url = Yii::app()->createUrl('Navigation/DelNavigationAndCategory');?>
 	        $.ajax({
 	            url:"<?php echo $path_url;?>",
 	            type:'get',
 	            data:'val='+val+'&parent='+parent,
 	         	dataType:'json',
 	        	success:function(data){
 	        		if(data==1){
 	 	        		alert('删除成功!');
 	 	        		location.href = "<?php echo Yii::app()->createUrl("Navigation/nav_column_set",array('act'=>'category','op'=>'1'))?>/nav"+nav;//location.href实现客户端页面的跳转
 	 	        		return false;  
 	 	        	}else{
 	 	 	        	alert("删除失败!");
 	 	 	        	return false;
 	 	 	        }
 	        	}        
 	        });
			
 			
		});
		//编辑
		$(document).on('click','#product_cateory .edit_but',function(e){
			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
			var obj = $(this).parent().parent().parent();
			//更换背景颜色
			obj.css('background','#78d7e8');
			
			var val = obj.attr('val');
			var parent = obj.attr('parent');
			obj.attr('edit','1');
			obj.find("input[class='name']").removeAttr('readonly');
			if(parent==0){
				var k = obj.find(".file_upload").attr('k');
				var img_name = obj.find(".title_text").html();
				var img_url = obj.find(".file-name").html();
				obj.find(".file_upload").html("<input type='file' name='product_category"+k+"'>");
				<?php
			       $this->widget('UploadjsWidget',array('form_id'=>'product_category_form'));
			    ?>
				$("#product_cateory").find("input[type='file']").parent().find(".file-label").removeAttr("class");
				obj.find(".title_text").html(img_name);
				obj.find(".file-name").html(img_url);
			}else{
				obj.find(".set_category").addClass("set_category_but");
				obj.find("input[class='highlight']").removeAttr('disabled');
			}
		});

		//设置分类
 		$(document).on('click','#product_cateory .set_category_but',function(e){
 	 		$(".set_category_show_div").removeClass("hidden");
 		});
 		//确定分类
 		$(".set_category_submit").click(function(){
 			var data_text = '';
 			var data_ids = '';
 	 		$(".cat_name_list>span").each(function(){
 	 			data_text += $(this).html();
 	 			data_ids += $(this).attr('val')+',';
 	 	 	});
 	 		data_text = data_text.substr(0,data_text.length-1);
 	 		data_ids = data_ids.substr(0,data_ids.length-1);
 	 		$("#product_cateory table>tbody>tr[edit='1']").find(".show_category_div").attr('val',data_ids);
 	 		$("#product_cateory table>tbody>tr[edit='1']").find(".show_category_div").html(data_text);
 	 		$("#product_cateory table>tbody>tr[edit='1']").find(".set_category").html(data_text);
 	 	 	$(".set_category_show_div").addClass("hidden");
 	 	});
 	 	//关闭分类
 	 	$(".hidden_category_checked").click(function(){
 	 		$(".set_category_show_div").addClass("hidden");
 	 	});

 		$("select[name='cat1']").change(function(){
 			var this_code = $(this).val();
 			if(this_code == 0){$('.cat2').addClass('hidden');$('.cat_list').addClass('hidden');return false;}
 			var str = '<option value="0">请选择</option>';
 			<?php $path_url = Yii::app()->createUrl('Navigation/GetCategoryChild');?>
 	        $.ajax({
 	            url:"<?php echo $path_url;?>",
 	            type:'get',
 	            data:'code='+this_code,
 	         	dataType:'json',
 	        	success:function(data){
 	        		$.each(data,function(key){  
 	                   str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
 	                });
 	                $(".cat2").removeClass('hidden');
 	        		$("select[name='cat2']").html(str);
 	        	}        
 	        });
 		});

 		$("select[name='cat2']").change(function(){
 			var this_code = $(this).val();
 			if(this_code == 0){$('.cat_list').addClass('hidden');return false;}
 			$('.cat_list').removeClass('hidden');
 			$(".set_category_submit").removeClass('hidden');
 			var text = $(".cat2 option:selected").html();  
 			$('.cat_list').find('.two_checked').html(text);
 			var checked="<span class='two_val' val='"+this_code+"'>"+text+"</span>";
 			$('.cat_name_list').html(checked);
 			var str = '';
 			<?php $path_url = Yii::app()->createUrl('Navigation/GetCategoryChild');?>
 	        $.ajax({
 	            url:"<?php echo $path_url;?>",
 	            type:'get',
 	            data:'code='+this_code,
 	         	dataType:'json',
 	        	success:function(data){
 	        		$.each(data,function(key){  
 	                   str += "<li value="+data[key]['category_code']+">"+data[key]['name']+"、</li>"; 
 	                });
 	                
 	        		$(".three_list").html(str);
 	        	}        
 	        });
 			//alert(text);
 		});

 		$('.two_checked').click(function(){
 			var this_code = $(".cat2 option:selected").val();
 			var this_text = $(this).html();
 			var str = "<span class='two_val' val='"+this_code+"'>"+this_text+"</span>";
 			$('.cat_name_list').html(str);
 		});

 		$('.cat_list').on('click','.three_list > li',function(e){
 			var this_code = $(this).attr('value');
 			var this_name = $(this).html();
 			var arr = $('.cat_name_list').find("span[val='"+this_code+"']");
 			if(arr.length==1) return false;
 			var str = "<span val='"+this_code+"'>"+this_name+"</span>";
 			$('.cat_name_list').find('.two_val').remove();
 			$('.cat_name_list').append(str);
 		});

 		$('.cat_list').on('click','.cat_name_list > span',function(e){
 			$(this).remove();
 		});

 		$(document).on('mouseover','#product_cateory .title_text',function(e){
			$(this).parent().find(".file-name").removeClass("hidden");
		});
 		$(document).on('mouseout','#product_cateory .title_text',function(e){
 			$(this).parent().find(".file-name").addClass("hidden");
		});
 		$(document).on('mouseover','#product_cateory .set_category',function(e){
			$(this).parent().find(".show_category_div").removeClass("hidden");
		});
 		$(document).on('mouseout','#product_cateory .set_category',function(e){
 			$(this).parent().find(".show_category_div").addClass("hidden");
		});

 		/**全部展开**/
 		$("#product_cateory #start_all").click(function(){
 			$("#product_cateory table>tbody").find('tr').removeClass('hidden');
 		});

 		/**全部收起**/
 		$("#product_cateory #stop_all").click(function(){
 			$("#product_cateory table>tbody").find('tr[parent!=0]').addClass('hidden');
 		});

 		/**排序置顶操作**/
 		$(document).on('click','#product_cateory .up_s>img',function(e){
 			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			var nav = $("select[name='navigation_sel']").val();
 			var this_obj = $(this).parent().parent().parent();
 			var val = this_obj.attr('val');
 			var parent = this_obj.attr('parent');
 			//排序图标
 			var url = "<?php echo $theme_url; ?>"+"/assets/images";
 		    var up_s = "<img src='"+url+"/sh_02.png' />";
 		    var up = "<img src='"+url+"/sh_03.png' />";
 		    var down_s = "<img src='"+url+"/sh_01.png' />";
 		    var down = "<img src='"+url+"/sh_04.png' />";
 			if(this_obj.attr('parent') == 0){
 				this_obj.fadeOut().fadeIn(); 
 				$("#product_cateory table>tbody>tr[parent='0']").eq(0).before(this_obj);
 				var child_obj = $("#product_cateory table>tbody").find("tr[parent='"+val+"'][parent!=0]");
 				this_obj.after(child_obj);
 				var length = $("#product_cateory table>tbody").find("tr[parent='0']").length;
 				$("#product_cateory table>tbody").find("tr[parent='0']").each(function(i){
 					$(this).find(".number").val(i+1);
 					if(i == 0){
 						$(this).find('.up_s').html('');
 						$(this).find('.up').html('');
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}else if(i == length-1){
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html('');
 						$(this).find('.down').html('');
 					}else{
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}
 				});
 			
 			}else{
 				var length = $("#product_cateory table>tbody").find("tr[parent='"+parent+"']").length;
 				
 				this_obj.fadeOut().fadeIn(); 
 				$("#product_cateory table>tbody>tr[val='"+parent+"'][parent=0]").after(this_obj); 
 				
 				$("#product_cateory table>tbody").find("tr[parent='"+parent+"']").each(function(i){
 					$(this).find(".number").val(i+1);
 					if(i == 0){
 						$(this).find('.up_s').html('');
 						$(this).find('.up').html('');
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}else if(i == length-1){
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html('');
 						$(this).find('.down').html('');
 					}else{
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}
 				});
 			}
 			//修改数据
 			<?php $path_url = Yii::app()->createUrl('Navigation/UpdateNavigationGroupSort');?>
 		    $.ajax({
 		        url:"<?php echo $path_url;?>",
 		        type:'post',
 		        data:'nav='+nav+'&act=1&val='+val+'&parent='+parent,
 		        async:false,
 		     	dataType:'json',     
 		    });
 		});

 		/**排序上移操作**/
 		$(document).on('click','#product_cateory .up>img',function(e){
 			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			var nav = $("select[name='navigation_sel']").val();
 			var this_obj = $(this).parent().parent().parent();
 			var val = this_obj.attr('val');
 			var parent = this_obj.attr('parent');
 			var url = "<?php echo $theme_url; ?>"+"/assets/images";
 		    var up_s = "<img src='"+url+"/sh_02.png' />";
 		    var up = "<img src='"+url+"/sh_03.png' />";
 		    var down_s = "<img src='"+url+"/sh_01.png' />";
 		    var down = "<img src='"+url+"/sh_04.png' />";
 			if(this_obj.attr('parent') == 0){
 				this_obj.fadeOut().fadeIn();
 				var index = this_obj.find('.number').val();
 				if(index!=1){
 					$("#product_cateory table>tbody").find("tr[parent='0']").eq(index-2).before(this_obj);
 					var child_obj = $("#product_cateory table>tbody").find("tr[parent='"+val+"'][parent!=0]");
 					this_obj.after(child_obj);
 					var length = $("#product_cateory table>tbody").find("tr[parent='0']").length;
 					$("#product_cateory table>tbody").find("tr[parent='0']").each(function(i){
 						$(this).find(".number").val(i+1);
 						if(i == 0){
 							$(this).find('.up_s').html('');
 							$(this).find('.up').html('');
 							$(this).find('.down_s').html(down_s);
 							$(this).find('.down').html(down);
 						}else if(i == length-1){
 							$(this).find('.up_s').html(up_s);
 							$(this).find('.up').html(up);
 							$(this).find('.down_s').html('');
 							$(this).find('.down').html('');
 						}else{
 							$(this).find('.up_s').html(up_s);
 							$(this).find('.up').html(up);
 							$(this).find('.down_s').html(down_s);
 							$(this).find('.down').html(down);
 						}
 					});
 				}
 				
 			}else{
 				var prev=this_obj.prev(); 
 				var up_sort = prev.find('.number').val();
 			    var down_sort = this_obj.find('.number').val();
 			    var next_parent = this_obj.next().attr('parent');
 			   
 			    if(down_sort>1)  
 			    {  	
 			    	this_obj.insertBefore(prev);  
 				    prev.find('.number').val(down_sort);
 				    this_obj.find('.number').val(up_sort);
 				    if(up_sort == 1){
 					    //最顶，需检查排序符合显示
 				    	this_obj.find('.up_s').html('');
 				    	this_obj.find('.up').html('');
 				    	this_obj.find('.down_s').html(down_s);
 				    	this_obj.find('.down').html(down);
 					}else{
 						this_obj.find('.up_s').html(up_s);
 						this_obj.find('.up').html(up);
 						this_obj.find('.down_s').html(down_s);
 						this_obj.find('.down').html(down);
 					}
 					if(next_parent == 0 || typeof(next_parent)=="undefined"){
 						//后面无同类
 						prev.find('.up_s').html(up_s);
 						prev.find('.up').html(up);
 						prev.find('.down_s').html('');
 						prev.find('.down').html('');
 					}else{
 						prev.find('.up_s').html(up_s);
 						prev.find('.up').html(up);
 						prev.find('.down_s').html(down_s);
 						prev.find('.down').html(down);
 					}
 			    }
 			}

 			//修改数据
 			<?php $path_url = Yii::app()->createUrl('Navigation/UpdateNavigationGroupSort');?>
 		    $.ajax({
 		        url:"<?php echo $path_url;?>",
 		        type:'post',
 		        data:'nav='+nav+'&act=2&val='+val+'&parent='+parent,
 		        async:false,
 		     	dataType:'json',     
 		    });
 			
 		});

 		/**排序置底操作**/
 		$(document).on('click','#product_cateory .down_s>img',function(e){
 			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			var nav = $("select[name='navigation_sel']").val();
 			var this_obj = $(this).parent().parent().parent();
 			var parent = this_obj.attr('parent');
 			var val = this_obj.attr('val');
 			//排序图标
 			var url = "<?php echo $theme_url; ?>"+"/assets/images";
 		    var up_s = "<img src='"+url+"/sh_02.png' />";
 		    var up = "<img src='"+url+"/sh_03.png' />";
 		    var down_s = "<img src='"+url+"/sh_01.png' />";
 		    var down = "<img src='"+url+"/sh_04.png' />";
 			if(this_obj.attr('parent') == 0){
 				this_obj.fadeOut().fadeIn(); 
 				$("#product_cateory table>tbody").append(this_obj);
 				var child_obj = $("#product_cateory table>tbody").find("tr[parent='"+val+"'][parent!=0]");
 				this_obj.after(child_obj);
 				var length = $("#product_cateory table>tbody").find("tr[parent='0']").length;
 				$("#product_cateory table>tbody").find("tr[parent='0']").each(function(i){
 					$(this).find(".number").val(i+1);
 					if(i == 0){
 						$(this).find('.up_s').html('');
 						$(this).find('.up').html('');
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}else if(i == length-1){
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html('');
 						$(this).find('.down').html('');
 					}else{
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}
 				});
 			}else{
 				var length = $("#product_cateory table>tbody").find("tr[parent='"+parent+"'][parent!=0]").length;
 				this_obj.fadeOut().fadeIn(); 
 				$("#product_cateory table>tbody>tr[parent='"+parent+"'][parent!=0]:last").after(this_obj); 
 				$("#product_cateory table>tbody").find("tr[parent='"+parent+"'][parent!=0]").each(function(i){
 					$(this).find(".number").val(i+1);
 					if(i == 0){
 						$(this).find('.up_s').html('');
 						$(this).find('.up').html('');
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}else if(i == length-1){
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html('');
 						$(this).find('.down').html('');
 					}else{
 						$(this).find('.up_s').html(up_s);
 						$(this).find('.up').html(up);
 						$(this).find('.down_s').html(down_s);
 						$(this).find('.down').html(down);
 					}
 				});
 			}

 			//修改数据
 			<?php $path_url = Yii::app()->createUrl('Navigation/UpdateNavigationGroupSort');?>
 		    $.ajax({
 		        url:"<?php echo $path_url;?>",
 		        type:'post',
 		        data:'nav='+nav+'&act=3&val='+val+'&parent='+parent,
 		        async:false,
 		     	dataType:'json',
 		    });
 		});

 		/**排序下移操作**/
 		$(document).on('click','#product_cateory .down>img',function(e){
 			var num =$("#product_cateory table tbody tr[edit='1']").length;
 			if(num != 0){
 				alert('正在执行操作,不能继续操作!');
 				return false;
 			}
 			var nav = $("select[name='navigation_sel']").val();
 			var this_obj = $(this).parent().parent().parent();
 			var val = this_obj.attr('val');
 			var parent = this_obj.attr('parent');
 			var url = "<?php echo $theme_url; ?>"+"/assets/images";
 		    var up_s = "<img src='"+url+"/sh_02.png' />";
 		    var up = "<img src='"+url+"/sh_03.png' />";
 		    var down_s = "<img src='"+url+"/sh_01.png' />";
 		    var down = "<img src='"+url+"/sh_04.png' />";
 			if(this_obj.attr('parent') == 0){
 				this_obj.fadeOut().fadeIn();
 				var index = this_obj.find('.number').val();
 				if(index){
 					var length = $("#product_cateory table>tbody").find("tr[parent='0']").length;
 					index = parseInt(index)+1;
 					if(index == length){
 						$("#product_cateory table>tbody").append(this_obj);
 					}else{
 						$("#product_cateory table>tbody").find("tr[parent='0']").eq(index).before(this_obj);
 					}
 					var child_obj = $("#product_cateory table>tbody").find("tr[parent='"+val+"'][parent!=0]");
 					this_obj.after(child_obj);
 					
 					$("#product_cateory table>tbody").find("tr[parent='0']").each(function(i){
 						$(this).find(".number").val(i+1);
 						if(i == 0){
 							$(this).find('.up_s').html('');
 							$(this).find('.up').html('');
 							$(this).find('.down_s').html(down_s);
 							$(this).find('.down').html(down);
 						}else if(i == length-1){
 							$(this).find('.up_s').html(up_s);
 							$(this).find('.up').html(up);
 							$(this).find('.down_s').html('');
 							$(this).find('.down').html('');
 						}else{
 							$(this).find('.up_s').html(up_s);
 							$(this).find('.up').html(up);
 							$(this).find('.down_s').html(down_s);
 							$(this).find('.down').html(down);
 						}
 					});
 				}
 				
 			}else{
 				var next=this_obj.next(); 
 				var down_sort = next.find('.number').val();
 			    var up_sort = this_obj.find('.number').val();
 			    var next_parent = this_obj.next().next().attr('parent');
 			    if(this_obj.next().attr('parent')!=0)  
 			    {  	
 			    	this_obj.insertAfter(next);  
 			    	next.find('.number').val(up_sort);
 				    this_obj.find('.number').val(down_sort);
 				    if(up_sort == 1){
 					    //最顶，需检查排序符合显示
 				    	next.find('.up_s').html('');
 				    	next.find('.up').html('');
 				    	next.find('.down_s').html(down_s);
 				    	next.find('.down').html(down);
 					}else{
 						next.find('.up_s').html(up_s);
 						next.find('.up').html(up);
 						next.find('.down_s').html(down_s);
 						next.find('.down').html(down);
 					}
 					if(next_parent == 0  || typeof(next_parent)=="undefined"){
 						//后面无同类
 						this_obj.find('.up_s').html(up_s);
 						this_obj.find('.up').html(up);
 						this_obj.find('.down_s').html('');
 						this_obj.find('.down').html('');
 					}else{
 						this_obj.find('.up_s').html(up_s);
 						this_obj.find('.up').html(up);
 						this_obj.find('.down_s').html(down_s);
 						this_obj.find('.down').html(down);
 					}
 			    }
 			}

 			//修改数据
 			<?php $path_url = Yii::app()->createUrl('Navigation/UpdateNavigationGroupSort');?>
 		    $.ajax({
 		        url:"<?php echo $path_url;?>",
 		        type:'post',
 		        data:'nav='+nav+'&act=4&val='+val+'&parent='+parent,
 		        async:false,
 		     	dataType:'json',
 		    });
 			
 		});


 		

		
       /****jquery页面加载完成***********/
    });

	/**随着类型改变，全部分页改变**/
    function all_page(count,act,cat_data=''){
        var this_nav = $("select[name='navigation_sel']").val();
        if(count<=1) {$("#page_div").html('');return false;}
        var mydate = new Date();
    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
    	
    	$('#page_div').jqPaginator({
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
        	    var this_page = $("input[name='all_page_num']").val();
        	    if(this_page==num){$("input[name='all_page_num']").val('fail');return false;}
        	    
    	    	<?php $path_url = Yii::app()->createUrl('Navigation/GetNavigationTypePage');?>
    	    	if(cat_data=='')
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act;
    	    	else
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act+'&'+cat_data;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                    	var str = '';
                		if(data_all != 0){
                    		var checked_data = data_all[1];
                    		var data = data_all[0];
                    		var s_ids = [];
                    		var s_sorts = [];
                    		var cs_times = [];
                    		var ce_times = [];
                    		$.each(checked_data,function(k){
                    			s_ids[k] = checked_data[k]['s_id']; 
                    			s_sorts[k] = checked_data[k]['s_sort'];
                    			cs_times[k] = checked_data[k]['start_show_time'];
                    			ce_times[k] = checked_data[k]['end_show_time'];
                        	});
        	                $.each(data,function(key){
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                var num_key = jQuery.inArray(data[key]['id'], s_ids);
                                if(num_key!=-1){var check="checked='checked'";var s_sort=s_sorts[num_key];var stimes=cs_times[num_key].slice(0,-3);var etimes=ce_times[num_key].slice(0,-3);}else{var check='';var s_sort='';var stimes='';var etimes='';}
                                str += '<input type="checkbox" '+check+' name="ids[]" value="'+data[key]['id']+'" class="ace isclick" />';    
                                str += '<span class="lbl"></span></label></td>';
                                str += '<td>'+(parseInt(key)+1)+'</td>';
                                str += '<td>'+data[key]['name']+'</td>';
                                str += '<td><input class="sort" maxlength="10" style="width:40px;" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+s_sort+'"/></td>';
                                if(act!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                                str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+stimes+"' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                        		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+etimes+"' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                        		if(act!=2){
                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                        		}
                                if(data[key]['s_time']){
                                    if(data[key]['s_time']<=day_s &&　data[key]['e_time']>=day_s && data[key]['status']==1){
                                        var is = "未过期";
                                    }else if(data[key]['s_time']>day_s && data[key]['status']==1){
                                        var is = "未上架";
                                    }else{
                                        var is = "已过期";
                                    }
                                }else{
                                    if(data[key]['status']==1){
                                        var is = "未过期";
                                    }else{
                                        var is = "已过期";
                                    }
                                }
                                if(data[key]['is_delete']){
                                    if(data[key]['is_delete']==1){
                                        var is = "已过期";
                                    }else{
                                        if(is == "未过期"){
                                        	var is = "未过期";
                                        }else if(is=="未上架"){
                                            var is = "未上架";
                                        }else{
                                        	var is = "已过期";
                                        }
                                        
                                    }
                                }
                                str += '<td>'+is+'</td>';
                                str += '</tr>';
                              });
        	                $("#checked_table table.all_t>tbody").html(str);
        	                $('.datetimepicker_s').datetimepicker({step:1});
    	                	$('.datetimepicker_e').datetimepicker({step:1});
        	            }else{
        	            	$("#checked_table table.all_t>tbody").html('');
            	            }
                	}      
                });
    	    }
    	});
        
    }

    


    /**随着类型改变，选中分页改变**/
    function already_page(count,act,cat_data=''){
        var this_nav = $("select[name='navigation_sel']").val();
        var mydate = new Date();
        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
        
        if(count<=1) {$("#page_already_div").html('');return false;}
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
        	    var this_page = $("input[name='checked_page_num']").val();
        	    if(this_page==num){$("input[name='checked_page_num']").val('fail');return false;}
    	    	<?php $path_url = Yii::app()->createUrl('Navigation/GetAlreadyNavigationTypePage');?>
    	    	if(cat_data=='')
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act;
    	    	else
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act+'&'+cat_data;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:data,
                 	dataType:'json',
                	success:function(data){
                		var str = '';
                    	if(data!=0){
        	                $.each(data,function(key){
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';    
                                str += '<span class="lbl"></span></label></td>';
                                str += '<td>'+(parseInt(key)+1)+'</td>';          
                                str += '<td>'+data[key]['title']+'</td>';
                                str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+data[key]['sort_order']+'"/></td>';
                                if(act!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                                str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                        		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                        		if(act!=2){
                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                        		}
                                //if(data[key]['is_overdue']==1){var is = "已过期";}else{var is = "未过期";}
                        		if(data[key]['s_time']){
                                    if(data[key]['s_time']<=data[key]['start_show_time'] &&　data[key]['e_time']>=data[key]['end_show_time'] && data[key]['status']==1){
                                     	if(data[key]['start_show_time']<=day_s && data[key]['end_show_time']>=day_s){
                                     		var is = "未过期";
    	                                }else if(data[key]['start_show_time']>day_s){
    	                                	var is = "未上架";
    		                            }else{
    		                            	var is = "已过期";
    			                        }
                                    }else{
                                        var is = "已过期";
                                    }
                                }else{
                                    if(data[key]['status']==1){
                                        var is = "未过期";
                                    }else{
                                        var is = "已过期";
                                    }
                                }
    	                        if(data[key]['is_delete']){
                            		if(data[key]['is_delete']==1){
                            			$is = "已过期";
                            		}else{
                            			if(is == "未过期"){
                                        	var is = "未过期";
                                        }else if(is == "未上架"){
                                        	var is = "未上架";
                                        }else{
                                        	var is = "已过期";
                                        }
                            		}
                            	}
                                str += '<td>'+is+'</td>';
                                str += '</tr>';
                              });
        	                $("#already_table table.already_t>tbody").html(str);
        	                $('.datetimepicker_res').datetimepicker({step:1});
    	                	$('.datetimepicker_ree').datetimepicker({step:1});
                    	}else{
                    		$("#already_table table.already_t>tbody").html('');
                        }
                    	
                	}   
                });
    	    }
    	});
        
    }


    /**随着类型改变，回收站分页改变**/
    function del_page(count,act,cat_data=''){
        var this_nav = $("select[name='navigation_sel']").val();
        var mydate = new Date();
        var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
        
        if(count<=1) {$("#page_del_div").html('');return false;}
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
        	    var this_page = $("input[name='delete_page_num']").val();
        	    if(this_page==num){$("input[name='delete_page_num']").val('fail');return false;}
    	    	<?php $path_url = Yii::app()->createUrl('Navigation/GetDelNavigationTypePage');?>
    	    	if(cat_data=='')
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act;
    	    	else
    	    		var data = 'nav='+this_nav+'&pag='+num+'&act='+act+'&'+cat_data;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:data,
                 	dataType:'json',
                	success:function(data){
                		var str = '';
                    	if(data!=0){
        	                $.each(data,function(key){
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';    
                                str += '<span class="lbl"></span></label></td>';
                                str += '<td>'+(parseInt(key)+1)+'</td>';          
                                str += '<td>'+data[key]['title']+'</td>';
                                str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+data[key]['sort_order']+'"/></td>';
                                if(act!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                                str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                        		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                        		if(act!=2){
                        		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                        		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                        		}
                               // if(data[key]['is_overdue']==1){var is = "已过期";}else{var is = "未过期";}
                        		if(data[key]['s_time']){
                                    if(data[key]['s_time']<=data[key]['start_show_time'] &&　data[key]['e_time']>=data[key]['end_show_time'] && data[key]['status']==1){
                                     	if(data[key]['start_show_time']<=day_s && data[key]['end_show_time']>=day_s){
                                     		var is = "未过期";
    	                                }else if(data[key]['start_show_time']>day_s){
    	                                	var is = "未上架";
    		                            }else{
    		                            	var is = "已过期";
    			                        }
                                    }else{
                                        var is = "已过期";
                                    }
                                }else{
                                    if(data[key]['status']==1){
                                        var is = "未过期";
                                    }else{
                                        var is = "已过期";
                                    }
                                }
    	                        if(data[key]['is_delete']){
                            		if(data[key]['is_delete']==1){
                            			$is = "已过期";
                            		}else{
                            			if(is == "未过期"){
                                        	var is = "未过期";
                                        }else if(is == "未上架"){
                                        	var is = "未上架";
                                        }else{
                                        	var is = "已过期";
                                        }
                            		}
                            	}
                                str += '<td>'+is+'</td>';
                                str += '</tr>';
                              });
        	                $("#del_table table.del_t>tbody").html(str);
        	                //$('.datetimepicker_des').datetimepicker({step:1});
    	                	//$('.datetimepicker_dee').datetimepicker({step:1});
                    	}else{
                    		$("#del_table table.del_t>tbody").html('');
                        }
                    	
                	}   
                });
    	    }
    	});
    }

	/**类型改变**/
    function type_change(act){
        if(act==2){
            //店铺，隐藏'商品上下架时间'
            $("#checked_table table>thead tr th:eq(6)").addClass('hidden');
            $("#already_table table>thead tr th:eq(6)").addClass('hidden');
            $("#del_table table>thead tr th:eq(6)").addClass('hidden');
        }else{
        	$("#checked_table table>thead tr th:eq(6)").removeClass('hidden');
        	$("#already_table table>thead tr th:eq(6)").removeClass('hidden');
        	$("#del_table table>thead tr th:eq(6)").removeClass('hidden');
        }
    	<?php $path_url = Yii::app()->createUrl('Navigation/Nav_column_set');?>
    	var mydate = new Date();
    	var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes())+':'+Appendzero(mydate.getSeconds());
    	
    	var nav = $("select[name='navigation_sel']").val();
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'act='+act+'&nav='+nav,
         	dataType:'json',
        	success:function(data_all){
            	var str = '';
            	var al_str = '';
            	var de_str = '';
        		if(data_all != 0){
        			//alert(data_all);
            		var count = data_all['all_count'];
            		var data = data_all['all_data'];
            		var already_count = data_all['already_count'];
            		var already_data = data_all['already_data'];
            		var del_count = data_all['del_count'];
            		var del_data = data_all['del_data'];
            		var s_ids = [];
            		var s_sorts = [];
            		var cs_times = [];
            		var ce_times = [];
            		if(already_data.length>0){
	            		$.each(already_data,function(k){
	            			s_ids[k] = already_data[k]['product_id']; 
	            			s_sorts[k] = already_data[k]['sort_order'];
	            			cs_times[k] = already_data[k]['start_show_time'];
	            			ce_times[k] = already_data[k]['end_show_time'];
	                	});
            		}

            		//全部
            		if(data.length>0){
	                $.each(data,function(key){
	                	str += '<tr>';
                        str += '<td class="center"><label>';
                        var num_key = jQuery.inArray(data[key]['id'], s_ids);
                        if(num_key!=-1){var check="checked='checked'";var s_sort=s_sorts[num_key];var stimes=cs_times[num_key].slice(0,-3);var etimes=ce_times[num_key].slice(0,-3);}else{var check='';var s_sort='';var stimes='';var etimes='';}
                        str += '<input '+check+' type="checkbox" name="ids[]" value="'+data[key]['id']+'" class="ace isclick" />';    
                        str += '<span class="lbl"></span></label></td>'; 
                        str += '<td>'+(parseInt(key)+1)+'</td>';         
                        str += '<td>'+data[key]['name']+'</td>';    
                        //str += '<td><input type="text" name="sort[]" value="'+(parseInt(key)+1)+'"/></td>';
                        str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+s_sort+'"/></td>';
                        if(act!=2){var s_times=data[key]['s_time'];var e_times=data[key]['e_time'];}else{var s_times='';var e_times='';}
                        str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+stimes+"' class='datetimepicker_s' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                		str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+etimes+"' class='datetimepicker_e' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                		if(act!=2){
                		if(data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=data[key]['e_time'].slice(0,-3);}
                		str += "<td>"+data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                		}
                        if(data[key]['s_time']){
                            if(data[key]['s_time']<=day_s &&　data[key]['e_time']>=day_s && data[key]['status']==1){
                                var is = "未过期";
                            }else if(data[key]['s_time']>day_s && data[key]['status']==1){
                            	var is = "未上架";
                            }else{
                                var is = "已过期";
                            }
                        }else{
                            if(data[key]['status']==1){
                                var is = "未过期";
                            }else{
                                var is = "已过期";
                            }
                        }
                        if(data[key]['is_delete']){
                            if(data[key]['is_delete']==1){
                                var is = "已过期";
                            }else{
                            	if(is == "未过期"){
                                	var is = "未过期";
                                }else if(is == "未上架"){
                                    var is = "未上架";
                                }else{
                                	var is = "已过期";
                                }
                            }
                        }
                        str += '<td>'+is+'</td>';
                        str += '</tr>';
                      });
	                $("#checked_table table.all_t>tbody").html(str);
	                if(count>1) {$("input[name='all_page_num']").val(1);all_page(count,act);}
 	               	else $("#page_div").html('');
	                $('.datetimepicker_s').datetimepicker({step:1});
                	$('.datetimepicker_e').datetimepicker({step:1});
            		}else{
            			$("#checked_table table.all_t>tbody").html('');
                	}
	                $("#checked_table table tbody").attr('act',act);

		          //选中  
	               if(already_data.length>0){
	                $.each(already_data,function(key){
	                	al_str += '<tr>';
	                	al_str += '<td class="center"><label>';
	                	al_str += '<input type="checkbox" name="ids[]" value="'+already_data[key]['product_id']+'" class="ace isclick" />';    
	                	al_str += '<span class="lbl"></span></label></td>'; 
	                	al_str += '<td>'+(parseInt(key)+1)+'</td>';         
	                	al_str += '<td>'+already_data[key]['title']+'</td>';    
                        //str += '<td><input type="text" name="sort[]" value="'+(parseInt(key)+1)+'"/></td>';
                        al_str += '<td><input class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+already_data[key]['sort_order']+'"/></td>';
                        if(act!=2){var s_times=already_data[key]['s_time'];var e_times=already_data[key]['e_time'];}else{var s_times='';var e_times='';}
                        al_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+already_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_res' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
                        al_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+already_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_ree' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
                		if(act!=2){
                		if(already_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=already_data[key]['e_time'].slice(0,-3);}
                		al_str += "<td>"+already_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
                		}
                		if(already_data[key]['s_time']){
                            if(already_data[key]['s_time']<=already_data[key]['start_show_time'] &&　already_data[key]['e_time']>=already_data[key]['end_show_time'] && already_data[key]['status']==1){
                             	if(already_data[key]['start_show_time']<=day_s && already_data[key]['end_show_time']>=day_s){
                             		var is = "未过期";
                                }else if(already_data[key]['start_show_time']>day_s){
                                	var is = "未上架";
	                            }else{
	                            	var is = "已过期";
		                        }
                            }else{
                                var is = "已过期";
                            }
                        }else{
                            if(already_data[key]['status']==1){
                                var is = "未过期";
                            }else{
                                var is = "已过期";
                            }
                        }
                        if(already_data[key]['is_delete']){
                    		if(already_data[key]['is_delete']==1){
                    			$is = "已过期";
                    		}else{
                    			if(is == "未过期"){
                                	var is = "未过期";
                                }else if(is == "未上架"){
                                	var is = "未上架";
                                }else{
                                	var is = "已过期";
                                }
                    		}
                    	}
                        //if(already_data[key]['is_overdue']==1){var is = "已过期";}else{var is = "未过期";}
                        
                        al_str += '<td>'+is+'</td>';
                        al_str += '</tr>';
                      });
	                $("#already_table table.already_t>tbody").html(al_str);
	                $('.datetimepicker_res').datetimepicker({step:1});
                	$('.datetimepicker_ree').datetimepicker({step:1});
                	
 	               	if(already_count>1){$("input[name='checked_page_num']").val(1);already_page(already_count,act);}
 	               	else $("#page_already_div").html('');
 	               	
	               }else{
	            	   $("#already_table table.already_t>tbody").html('');
		           }
	                $("#already_table table tbody").attr('act',act);

				//回收站
	                if(del_data.length>0){
		                $.each(del_data,function(key){
		                	de_str += '<tr>';
		                	de_str += '<td class="center"><label>';
		                	de_str += '<input type="checkbox" name="ids[]" value="'+del_data[key]['product_id']+'" class="ace isclick" />';    
		                	de_str += '<span class="lbl"></span></label></td>'; 
		                	de_str += '<td>'+(parseInt(key)+1)+'</td>';         
		                	de_str += '<td>'+del_data[key]['title']+'</td>';    
	                        //str += '<td><input type="text" name="sort[]" value="'+(parseInt(key)+1)+'"/></td>';
	                        de_str += '<td><input readonly="readonly" class="sort" style="width:40px;" maxlength="10" onkeyup=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");}  onafterpaste=if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,"");}else{this.value=this.value.replace(/[^0-9]/g,"");} type="text" name="sort[]" value="'+del_data[key]['sort_order']+'"/></td>';
	                        if(act!=2){var s_times=del_data[key]['s_time'];var e_times=del_data[key]['e_time'];}else{var s_times='';var e_times='';}
	                        de_str += "<td><input type='text' s_time='"+s_times+"' readonly='readonly' value='"+del_data[key]['start_show_time'].slice(0,-3)+"' class='datetimepicker_des' name='time_up' maxlength='100' placeholder='<?php echo yii::t("vcos", "开始时间")?>'/></td>";
	                        de_str += "<td><input type='text' e_time='"+e_times+"' readonly='readonly' value='"+del_data[key]['end_show_time'].slice(0,-3)+"' class='datetimepicker_dee' name='time_down' maxlength='100' placeholder='<?php echo yii::t("vcos", "结束时间")?>'/></td>";
	                		if(act!=2){
	                		if(del_data[key]['e_time']=='9999-12-31 23:59:59'){var e="永不下架";}else{var e=del_data[key]['e_time'].slice(0,-3);}
	                		de_str += "<td>"+del_data[key]['s_time'].slice(0,-3)+"～"+e+"</td>";
	                		}
	                       // if(del_data[key]['is_overdue']==1){var is = "已过期";}else{var is = "未过期";}
	                		if(del_data[key]['s_time']){
                                if(del_data[key]['s_time']<=del_data[key]['start_show_time'] &&　del_data[key]['e_time']>=del_data[key]['end_show_time'] && del_data[key]['status']==1){
                                 	if(del_data[key]['start_show_time']<=day_s && del_data[key]['end_show_time']>=day_s){
                                 		var is = "未过期";
	                                }else if(del_data[key]['start_show_time']>day_s){
	                                	var is = "未上架";
		                            }else{
		                            	var is = "已过期";
			                        }
                                }else{
                                    var is = "已过期";
                                }
                            }else{
                                if(del_data[key]['status']==1){
                                    var is = "未过期";
                                }else{
                                    var is = "已过期";
                                }
                            }
	                        if(del_data[key]['is_delete']){
                        		if(del_data[key]['is_delete']==1){
                        			$is = "已过期";
                        		}else{
                        			if(is == "未过期"){
                                    	var is = "未过期";
                                    }else if(is == "未上架"){
                                    	var is = "未上架";
                                    }else{
                                    	var is = "已过期";
                                    }
                        		}
                        	}
	                        de_str += '<td>'+is+'</td>';
	                        de_str += '</tr>';
	                      });
		                $("#del_table table.del_t>tbody").html(de_str);
		               // $('.datetimepicker_des').datetimepicker({step:1});
	                 //	$('.datetimepicker_dee').datetimepicker({step:1});
	                	
		                if(del_count>1){$("input[name='delete_page_num']").val(1);del_page(del_count,act);}
	 	               	else $("#page_del_div").html('');
	 	               	
		               }else{
		            	   $("#del_table table.del_t>tbody").html('');
			           }
		                $("#del_table table tbody").attr('act',act);
	               
	            }
        	}      
        });
    }

    /**商品分类重置**/
    function reset_category(){
        var str = '<option value="0">全部</option>';
        <?php 
        foreach ($cat1_sel as $row){
        	?>
        	str += '<option value="<?php echo $row['category_code']?>"><?php echo $row["name"]?></option>';
        <?php }?>
        $("#checked_table select[name='category_one']").html(str);
        $("#checked_table select[name='category_one']").removeClass('hidden');
        $("#checked_table select[name='category_two']").addClass('hidden');
        $("#checked_table select[name='category_three']").addClass('hidden');
     
    }


    /**商品分类页面**/
    function set_category_list(nav){
    	<?php $path_url = Yii::app()->createUrl('Navigation/Nav_column_set');?>
    	var nav = $("select[name='navigation_sel']").val();
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'act=category&nav='+nav,
         	dataType:'json',
        	success:function(data){
            	if(data!=0){
                    	var pa_key = 1;
                    	var ch_key = 1;
                    	var count = data.length;
                    	var str = '';
                    	$.each(data,function(key){
	                    str += "<tr edit='0' sort='"+data[key]['sort_order']+"' parent='0' val='"+data[key]['navigation_group_id']+"'>";
					    str += "<td class='text_center'><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='"+pa_key+"'/><input readOnly='true' type='text' class='name' value='"+data[key]["navigation_group_name"]+"' maxlength='20' /></td>";
					    var img_url = data[key]['img_url'].split('/'); var img_name= img_url[img_url.length-1];
					    str += "<td class='text_center file_upload' k='"+(parseInt(key)+1)+"' style='position: relative'><span class='title_text' style='float:none;'>"+img_name+"</span><span style='top:32px;' class='file-name large hidden' data-title='"+img_name+"'><img style='width:100px;' src='<?php echo Yii::app()->params['imgurl'];?>"+data[key]['img_url']+"'></span></td>";
				        str += "<td class='text_center img'></td>";      
				        if(pa_key==1&&data[key]['count']==1){
						str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
						}else if(data[key]['count']>1 && pa_key != 1 && data[key]['count'] != pa_key){
						str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>";
						}else if(data[key]['count']>1 && pa_key == 1){
						str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>";
						}else{
						str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
						}
				        str += "<td class='text_center img'><span class='add_child'>添加</span></td>";
				        str += "<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>";
					    str += "</tr>";
					    pa_key++;ch_key=1; 
					    if(data[key]['child']){
						  	$.each(data[key]['child'],function(k){
							  	str += "<tr edit='0' sort='"+data[key]['child'][k]['sort_order']+"' parent='"+data[key]['child'][k]['navigation_group_id']+"' val='"+data[key]['child'][k]['navigation_group_cid']+"'>";
								str += "<td class='text_center'><label class='child_op'></label><input readOnly='true' type='text' class='number' value='"+ch_key+"'/><input readOnly='true' type='text' class='name' value='"+data[key]['child'][k]['navigation_category_name']+"' maxlength='20' /></td>";
						        str += "<td class='text_center' style='position: relative'><span class='set_category'>"+data[key]['child'][k]['cat_text']+"</span><span class='show_category_div hidden' val='"+data[key]['child'][k]['mapping_id']+"'>"+data[key]['child'][k]['cat_text']+"</span></td>";
						        if(data[key]['child'][k]['is_highlight']==1){var hig = "checked='checked'";}else{var hig='';}
						        str += "<td class='text_center img'><input type='checkbox' "+hig+" disabled='true'  class='highlight' /></td>";    
						        if(ch_key == 1  && data[key]['child'][k]['count']==1){
								str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
								}else if(data[key]['child'][k]['count']>1 && ch_key != 1 && data[key]['child'][k]['count'] != ch_key){
								str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>";
								}else if(data[key]['child'][k]['count']>1 && ch_key == 1){
								str += "<td class='text_center img'><label class='up_s'></label><label  class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>";
								}else{
								str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
								}
						        str += "<td class='text_center img'></td>";
						        str += "<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>";
									str += "</tr>";
									ch_key++;
								});
							}
                    	});
                    	$("#product_cateory table.product_category_table>tbody").html(str);
                    	$("#product_cateory table.product_category_table>tbody").attr('key',count);
            	}else{
                	$("#product_cateory table.product_category_table>tbody").html('');
                	$("#product_cateory table.product_category_table>tbody").attr('key','0');
                }
        	}
    	
        });
    }

    function Appendzero (obj) {
    	  if (obj < 10) return "0"+obj; else return obj;
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