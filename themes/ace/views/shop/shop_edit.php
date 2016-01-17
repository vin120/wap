<?php
    $this->pageTitle = Yii::t('vcos','编辑店铺');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'shop_add';
    $menu_type = 'shop_list';
?>
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
    /*资质*/
    if(in_array('358', $auth) || $auth[0] == '0'){
    	$canadd = TRUE;
    }  else {
    	$canadd = False;
    }
  if(in_array('154', $auth) || $auth[0] == '0'){
     $canedit = TRUE;
     }  else {
     $canedit = False;
     } 
    if(in_array('158', $auth) || $auth[0] == '0'){
    	$candelete = TRUE;
    }  else {
    	$candelete = FALSE;
    }
    /*资质*/
?>
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
                            <?php echo yii::t('vcos', '店铺管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Shop/shop_list")?>"><?php echo yii::t('vcos', '店铺列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑店铺')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <style>
                    	.table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                    	.table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                    	.table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
                    </style>
                    <div class="table_switch"><span class="myself_current" val='0'>基本信息</span><span val='1' >店铺资质</span><span val='2' >店铺分类</span></div>
                    
                    <div class="row" id="edit_line">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                            <?php  
                            //使用小物件生成form元素  
                            $form=$this->beginWidget('CActiveForm',array(
                                'htmlOptions'=>array(
                                    'class'=>'form-horizontal edit_form',
                                    'role'=>'form',
                                    'id'=>'edit',
                                    'enctype'=>'multipart/form-data',
                                ),
                            ));  
                            ?> 
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店铺编码')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="code" placeholder="<?php echo yii::t('vcos', '店铺编码')?>" class="col-xs-10 col-sm-8 col-md-8" name="code" maxlength="32" value="<?php echo $shop['shop_code']?>"/>
                                        <?php echo $form->error($shop,'shop_code'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店铺名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '店铺名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="30" value="<?php echo $shop['shop_title']?>" />
                                        <?php echo $form->error($shop,'shop_title'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '描述')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<textarea id="desc" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '描述')?>" name="desc" maxlength=80><?php echo $shop['shop_desc']?></textarea>
                                        <?php echo $form->error($shop,'shop_desc'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店铺法人')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="people" placeholder="<?php echo yii::t('vcos', '店铺法人')?>" class="col-xs-10 col-sm-8 col-md-8" name="people" maxlength="30" value="<?php echo $shop['legal_representative']?>"/>
                                        <?php echo $form->error($shop,'legal_representative'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '公司名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="company" placeholder="<?php echo yii::t('vcos', '公司名')?>" class="col-xs-10 col-sm-8 col-md-8" name="company" maxlength="30" value="<?php echo $shop['company_name']?>" />
                                        <?php echo $form->error($shop,'company_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '地址')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="address" placeholder="<?php echo yii::t('vcos', '地址')?>" class="col-xs-10 col-sm-8 col-md-8" name="address" maxlength="30" value="<?php echo $shop['shop_address']?>"/>
                                        <?php echo $form->error($shop,'shop_address'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '保证金')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="price" placeholder="<?php echo yii::t('vcos', '保证金')?>" class="col-xs-10 col-sm-8 col-md-8" name="price" maxlength="10" value="<?php echo $shop['cash_deposit']/100?>"/>
                                        <?php echo $form->error($shop,'cash_deposit'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店铺主营')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<textarea id="products" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '店铺主营')?>" name="products" maxlength=80><?php echo $shop['main_products']?></textarea>
                                        <?php echo $form->error($shop,'main_products'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店铺LOGO')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$shop['shop_logo'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo" id="photo"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '封面图')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$shop['shop_img_url'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo1" id="photo1"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '营业执照')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$shop['business_license'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo2" id="photo2"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($shop['shop_status']){echo "checked='checked'";}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <input type="hidden" value="" id="judge" name="judge">
                                <input type="submit" value="提交" id="submit" class="btn btn-primary" style="margin-left: 45%"/>
                            <?php  
                                $this->endWidget();  
                            ?>
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                    <!-- 资质 -->
                                    <div class="row hidden" id="operation_table">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" action="">
                                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '一级类目')?></th>
                                                            <th><?php echo yii::t('vcos', '二级类目')?></th>
                                                            <th><?php echo yii::t('vcos', '三级类目')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <!-- <th><php echo yii::t('vcos', '操作')?></th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $key = 0; foreach ($shop_operation as $row) {
                                                        	if($row['tree_type']==2){
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['so_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['parent_name'];?></td>
                                                            <td><?php echo $row['name'];?></td>
                                                            <?php $child='';
                                                            if($row['is_sub_all']!=1){
                                                            foreach ($shop_operation as $key=>$row_s){
                                                            	if($row_s['parent_catogory_code'] == $row['category_code']){
                                                           		$child .=  $row_s['name'].'、';
                                                            }}}else{$child='全部';}?>
                                                            <td><?php echo trim($child,'、');?></td>
                                                            <td>启用</td>
                                                           
                                                           <!-- <td>
                                                                <php 
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Shop',
                                                                        'MethodName'=>'shop_operation_edit',
                                                                        'id'=>$row['so_id'],
                                                                        'canedit'=>$canedit,
                                                                       // 'candelete'=>$candelete,
                                                                    ));
                                                                ?>
                                                            </td>  --> 
                                                        </tr>
                                                        <?php }}?>
                                                    </tbody>
                                                </table>
                                                </form>
                                                <div class="center">
                                                <a class="btn btn-xs" href="<?php echo Yii::app()->createUrl('Shop/shop_operation_edit',array('shop'=>$shop['shop_id']))?>">
												<i class="icon-pencil align-top bigger-125"></i>
												<span class="bigger-110 no-text-shadow">编辑</span>
												</a>
												<button id="del_shop_operation" class="btn btn-xs btn-warning">
												<i class="icon-trash bigger-125"></i>
												<span class="bigger-110 no-text-shadow">删除选中</span>
												</button>
                                                    <?php
                                                        //底部操作挂件
                                                        $this->widget('BotWidget',array(
                                                            'ControllerName'=>'Shop',
                                                            'MethodName'=>'shop_operation',
                                                            'canadd'=>$canadd,
                                                        	//'canedit'=>$canedit,
                                                           // 'candelete'=>$candelete,
                                                        ));
                                                    ?>
                                                </div>
                                                <!-- <div class="center">
                                                    <php
                                                    $this->widget('MyCLinkPager',array(
                                                        'pages'=>$pages,
                                                        'header'=>false,
                                                        'htmlOptions'=>array('class'=>'pagination'),
                                                        'firstPageLabel'=>yii::t('vcos', '首页'),
                                                        'lastPageLabel'=>yii::t('vcos', '尾页'),
                                                        'prevPageLabel'=>'«',
                                                        'nextPageLabel'=>'»',
                                                        'maxButtonCount'=>5,
                                                        'cssFile'=>false,
                                                        ));
                                                    ?>
                                                </div> -->
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                            <!-- 资质结束 -->
                            <!-- 分类 -->
  <div class="row hidden" id="category_table">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                        	<style>
                        		.click_but{width:100px;cursor:pointer;height:35px;line-height:35px;text-align:center;border:1px solid #9e9d9e;background:#e9ecec;float:left;margin-left:10px;margin-bottom:5px;}
                        		#add_category_one{cursor:pointer;line-height:30px;text-align:center;width:100px;height:30px;color:#fff;background:#009FCC;}
                        		.categroy_table thead tr td{text-align:center;height:30px;background:#B0E0E6;}
                        		.categroy_table tbody tr td{height:40px;}
                        		.categroy_table tbody tr{border-bottom:1px dashed #ccc;}
                        		.categroy_table .number{width:28px;margin-right:5px;text-align:center;}
                        		.categroy_table .cat_name{width:220px;}
                        		.categroy_table .parent_op{cursor:pointer;position:relative;top:-5px;margin:0px 5px 0px 8px;width: 0;height: 0;border-left: 8px solid transparent;border-right: 8px solid transparent;border-top: 10px solid #1b1b1b;}
                        		.categroy_table tbody tr .img>label{width:25px;}
                        		.categroy_table tbody tr .img>label>img{cursor:pointer;}
                        		.categroy_table tbody tr td.text_center{text-align:center;}
                        		.categroy_table tbody tr td .add_start{color:blue;cursor:pointer;}
                        		.categroy_table tbody tr td .add_stop{color:#ccc;}
                        		.categroy_table tbody tr td .child_op{margin:-9px 5px 0px 41px;width:15px;height:15px;border-left:1px solid #ccc;border-bottom:1px solid #ccc;}
                        	</style>
                        	<input type="hidden" name='shop_val' value="<?php echo $shop['shop_id']?>">
                        	<div id="del_all" class="click_but">全部删除</div><div id="start_all" class="click_but">全部展开</div><div id="stop_all" class="click_but">全部收起</div>
                           <table class="categroy_table" style="width:100%;border-collapse:collapse;border:1px solid #ccc;">
                           	<thead>
                           		<tr>
                           			<td width='8%'>分类</td>
                           			<td width='5%'>移动</td>
                           			<td width='5%'>是否在首页显示商品</td>
                           			<td width='5%'>添加子分类</td>
                           			<td width='5%'>展开子分类</td>
                           			<td width='5%'>操作</td>
                           		</tr>
                           	</thead>
                            <tbody>
                            	<?php if($shop_cat){
                            		$pa_key = 1;
                            		$ch_key = 1;
                            	foreach ($shop_cat as $key=>$row){
                            		if($row['parent_cid'] == 0){
                            	?>
                            	<tr sort='<?php echo $row['sort_order']?>' edit='0' val='<?php echo $row['sc_id']?>' parent='<?php echo $row['parent_cid']?>' code='<?php echo $row['shop_category_id']?>'>
									<td><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $pa_key;?>'/><input readOnly='true' type='text' class='cat_name' name='name[]' maxlength="20" value='<?php echo $row["shop_category_name"]?>'/></td>
									<?php if($pa_key == 1 && $row['count']==1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($row['count']>1 && $pa_key != 1 && $row['count'] != $pa_key){?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($row['count']>1 && $pa_key == 1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else{?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }?>
									<td class='text_center'><input class='show_main' type='checkbox' <?php if($row['is_show_main']==0){echo "checkd='checekd'";}?> value='<?php echo $row['is_show_main']?>' name='show[]'/></td>
									<td class='text_center'><label class='add_child <?php if($row['is_show_main']==0){echo "add_stop";}else{echo "add_start";}?>'>添加子分类</label></td>
									<td class='text_center'><input type='checkbox' class='show_child_cate'/></td>
									<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>
								</tr>
                            	<?php $pa_key++;$ch_key=1; }else{?>
                            	<tr sort='<?php echo $row['sort_order']?>' edit='0' val='<?php echo $row['sc_id']?>' parent='<?php echo $row['parent_cid']?>' code='<?php echo $row['shop_category_id']?>'>
									<td><label class='child_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $ch_key;?>'/><input readOnly='true' type='text' class='cat_name' maxlength='20' name='name[]' value='<?php echo $row["shop_category_name"]?>' /></td>
									<?php if($ch_key == 1  && $row['count']==1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($row['count']>1 && $ch_key != 1 && $row['count'] != $ch_key){?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($row['count']>1 && $ch_key == 1){?>
									<td class='text_center img'><label class='up_s'></label><label  class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else{?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }?>
									<td class='text_center'></td>
									<td class='text_center'></td>
									<td class='text_center'></td>
									<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>
								</tr>
                            	
                            	<?php $ch_key++;}}}?>
                            </tbody>
                           </table>
                           <div id="add_category_one">添加新分类</div>
                           
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->                          
                     <!-- 店铺分类结束 -->       
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
           
             <?php
                    //设置容器配置挂件
                    $this->widget('settingsContainerWidget');
            ?>
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/uncompressed/additional-methods.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	<?php
	        $this->widget('UploadjsWidget',array('form_id'=>'edit'));
	    ?>
    $("#edit").validate({
        rules: {
        	code:{required:true,isRightfulString:true},
            name:{required:true,stringCheckAll:true},
            desc:{required:true},
            people:{required:true,stringCheckAll:true},
            company:{required:true,stringCheckAll:true},
            address:{required:true,stringCheckAll:true},
            price:{required:true,isFloatGtZero:true},
            products:{required:true,stringCheckAll:true}
        }
    });

    $('#operation_table table th input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
    });
    
    $('#edit_line form').submit(function(){
        //判断店铺编码是否已经存在
        var id = <?php echo $shop['shop_id']?>;
        var code = $("input[name='code']").val();
        var flag = 0;
        if($.trim(code)!=''){
	        <?php $path_url = Yii::app()->createUrl('Shop/CheckCodeNameExits');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'id='+id+'&code='+code,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		if(data==0) flag=1;
		    	}      
		    });
		    if(flag==0){
	            alert("店铺编码已存在，请更换店铺编码!");
		   		 return false;
	        }
        }
        
    });

	/***店铺资质批量删除***/
	$("#operation_table #del_shop_operation").click(function(){
		var checked_obj = $("#operation_table table > tbody input[type='checkbox']:checked");
		if(checked_obj.length==0){alert("请选中需要删除的店铺资质!");return false;}
		var query = confirm("确定是否删除该记录?");
		if(query==true){
			var checked_str = '';
			$.each(checked_obj,function(){
				checked_str += $(this).val()+',';
			});
			checked_str = checked_str.substr(0,checked_str.length-1);
			<?php $path_url = Yii::app()->createUrl('Shop/DelShopOperation');?>
	        $.ajax({
	            url:"<?php echo $path_url;?>",
	            type:'post',
	            data:'checked_str='+checked_str,
	         	dataType:'json',
	        	success:function(data){
	        		if(data==1){
	            		alert("删除成功!");
	            		window.location.reload();
	            		}
	        	}      
	        });
		}
		
	});


    
 /**店铺分类开始**/
    $("#add_category_one").click(function(){
    	var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		
		var tr_count = $(".categroy_table>tbody").find("tr[parent='0']").length;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var code_id = 0;
		var sort_id = 0;
		<?php $path_url = Yii::app()->createUrl('Shop/GetShopCatCode');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'parent_code=0&shop='+shop,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	if(data != 0){
		    		code_id = data[0];
		    		sort_id = data[1];
		    	}
	    	}      
	    });
	  	code_id = parseInt(code_id);sort_id = parseInt(sort_id);
	    if(code_id == 0){code_id = 10;}else if(code_id != 99){code_id = code_id+1;}
	    if(sort_id == 0){sort_id = 1;}else{sort_id = sort_id+1;}
	    var number_key = tr_count+1;
		var  str = '';
		str += "<tr sort='"+sort_id+"' edit='1' val='' parent='0' code='"+code_id+"'>";
		str += "<td><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='cat_name' maxlength='20' name='name[]' /></td>";
		if(tr_count == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
			str += "<td class='text_center img'><label class='up_s'><img src='"+url+"/sh_02.png' /></label class='up'><label><img src='"+url+"/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}
		str += "<td class='text_center'><input class='show_main' type='checkbox' value='1' name='show[]'/></td>";
		str += "<td class='text_center'><label class='add_child add_start'>添加子分类</label></td>";
		str += "<td class='text_center'><input type='checkbox' class='show_child_cate'/></td>";
		str += "<td class='text_center img'><label><img class='success_but' src='"+url+"/sh_06.png' /></label><label><img class='edit_but' src='"+url+"/sh_07.png' /></label><label><img class='del_but' src='"+url+"/sh_05.png' /></label></td>";
		str += "</tr>";

		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		if(tr_count != 0){
			$(".categroy_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down_s").html(downs_img);
			$(".categroy_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down").html(down_img);
		}
		$(".categroy_table").append(str);
		
	});

	$(document).on('click',".add_start",function(e){
		var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var parent_code = $(this).parent().parent().attr('code');
		var child_tr_count = $(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").length;
		var code_id = 0;
		var sort_id = 0;
		<?php $path_url = Yii::app()->createUrl('Shop/GetShopCatCode');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'parent_code='+parent_code+'&shop='+shop,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		if(data != 0){
	    			code_id = data[0];
		    		sort_id = data[1];
		    	}
	    	}      
	    });
	    code_id = parseInt(code_id);sort_id = parseInt(sort_id);
	    if(code_id == 0){code_id = parseInt(parent_code+'01');}else if(code_id != parseInt(parent_code+'99')){code_id = code_id+1;}
	    if(sort_id == 0){sort_id = 1;}else{sort_id = sort_id+1;}
	    var number_key = child_tr_count+1;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var  str = '';
		str += "<tr sort='"+sort_id+"' edit='1' val='' parent='"+parent_code+"' code='"+code_id+"'>";
		str += "<td><label class='child_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='cat_name' name='name[]' maxlength='20' /></td>";
		if(child_tr_count == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
			str += "<td class='text_center img'><label class='up_s'><img src='"+url+"/sh_02.png' /></label><label class='up'><img src='"+url+"/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}
		str += "<td class='text_center'></td>";
		str += "<td class='text_center'></td>";
		str += "<td class='text_center'></td>";
		str += "<td class='text_center img'><label><img class='success_but' src='"+url+"/sh_06.png' /></label><label><img class='edit_but' src='"+url+"/sh_07.png' /></label><label><img class='del_but' src='"+url+"/sh_05.png' /></label></td>";
		str += "</tr>";
		
		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		if(child_tr_count != 0){
			$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down_s").html(downs_img);
			$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down").html(down_img);
		}
		if(child_tr_count == 0)
		$(this).parent().parent().after(str);
		else
		$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).after(str);
	});

	
	/**是否在首页展示商品**/
	$(document).on('click','.show_main',function(e){
		var obj = $(this).parent().parent().find('.add_child');
		var shop = $("input[name='shop_val']").val();
		var checked = $(this).is(":checked");
		var this_code = $(this).parent().parent().attr('code');
		var key = 0;
		if(checked == true){
			//禁用添加
			obj.removeClass('add_start');
			obj.addClass('add_stop');
			$(this).val(0);
			key = 0;
		}else if(checked == false){
			//启用添加
			obj.addClass('add_start');
			obj.removeClass('add_stop');
			$(this).val(1);
			key = 1;
		}
		<?php $path_url = Yii::app()->createUrl('Shop/SetMainShow');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&code='+this_code+'&key='+key,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	//alert(data);
	    	}      
	    });
	});

	/**展开或收缩子类***/
	$(document).on('click','.show_child_cate',function(e){
		var checked = $(this).is(":checked");
		var parent_code = $(this).parent().parent().attr('code');
		var obj = $(".categroy_table>tbody").find("tr[parent='"+parent_code+"']");
		if(checked == true){
			//收缩子类
			obj.addClass('hidden');
		}else if(checked == false){
			//展开子类
			obj.removeClass('hidden');
		}
	});

	
	/**提交数据**/
	$(document).on('click','.success_but',function(e){
		var obj_tr = $(this).parent().parent().parent();
		if(obj_tr.attr('edit') == 0){return false;}
		
		var act = obj_tr.attr('val');
		var shop = $("input[name='shop_val']").val();
		var code = obj_tr.attr('code');
		var name = obj_tr.find('.cat_name').val();
		var parent_code = obj_tr.attr('parent');
		var sort = obj_tr.attr('sort');
		if(parent_code != 0){
		var show_main = $(".categroy_table>tbody").find("tr[code='"+parent_code+"']").find('.show_main').val();
		}else{
		var show_main = obj_tr.find('.show_main').val();
		}
		if($.trim(name).length == 0){ alert('请输入分类名称'); return false;}
		
		if($.trim(act).length == 0){act=0}else{act=1;}
		<?php $path_url = Yii::app()->createUrl('Shop/ShopCategoryKeep');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act='+act+'&shop='+shop+'&code='+code+'&name='+name+'&parent_code='+parent_code+'&sort='+sort+'&show_main='+show_main,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	if(act == 0) { //新增
			    	alert('添加成功!');
	    			obj_tr.attr('val',data);
		    	}else{
			    	alert('修改成功');
			    }
		    	obj_tr.attr('edit','0');
		    	obj_tr.find('.cat_name').attr('readonly','true');
	    	}      
	    });
	});


	/**全部展开**/
	$("#start_all").click(function(){
		$(".categroy_table>tbody").find('tr').removeClass('hidden');
	});

	/**全部收起**/
	$("#stop_all").click(function(){
		$(".categroy_table>tbody").find('tr[parent!=0]').addClass('hidden');
	});

	/**删除**/
	$(document).on('click','.del_but',function(e){
		var obj = $(this).parent().parent().parent();
		var this_val = obj.attr('val');
		var this_code = obj.attr('code');
		var parent = obj.attr('parent');
		var shop = $("input[name='shop_val']").val();
		var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
		if($.trim(this_val).length == 0){
			var query = confirm("您确定要删除此行吗？");
			if(query == true)
				if(length != 1){
					obj.prev().find('.down_s').html('');	
					obj.prev().find('.down').html('');
				}
				obj.remove();		
		}else{
			if(parent == 0){
				var query = confirm("确定删除该分类并删除该分类下的全部子类记录?");
			}else{
				var query = confirm("确定删除该分类记录?");
			}
			if(query == false) return false;
			var msg = 0;
			//删除数据
			<?php $path_url = Yii::app()->createUrl('Shop/DelShopCate');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'post',
		        data:'code='+this_code+'&shop'+shop,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
			    	msg = data;
		    	}      
		    });
			if(msg == 0){
				alert("删除失败!");return false;
			}
			alert("删除成功!");
			if(parent == 0){
				if(obj.find('.number').val() == 1){
					$(".categroy_table>tbody").find("tr[parent='0']").eq(1).find('.up_s').html('');
					$(".categroy_table>tbody").find("tr[parent='0']").eq(1).find('.up').html('');
				}else if(obj.find('.number').val() == length){
					$(".categroy_table>tbody").find("tr[parent='0']").eq(length-2).find('.down_s').html('');
					$(".categroy_table>tbody").find("tr[parent='0']").eq(length-2).find('.down').html('');
				}
				obj.remove();
				$(".categroy_table>tbody").find("tr[parent='"+this_code+"']").remove();
			}else{
				if(obj.find('.number').val() == 1 && obj.next().attr('parent')==parent){
					obj.next().find('.up_s').html('');
					obj.next().find('.up').html('');
				}else if(obj.find('.number').val() == length && obj.prev().attr('parent')==parent){
					obj.prev().find('.down_s').html('');
					obj.prev().find('.down').html('');
				}
				obj.remove();
			}
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				$(this).find('.number').val(i+1);
				
			});
			
			
		}
	});


	/**店铺改变***/
	/*$("select[name='shop']").change(function(){
		var path = $(this).find("option:selected").attr('url');
		window.location.href=path;
	});*/

	/**编辑**/
	$(document).on('click','.edit_but',function(e){
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var obj = $(this).parent().parent().parent();
		obj.attr('edit','1');
		obj.find('.cat_name').removeAttr('readonly');
	});

	/**排序置顶操作**/
	$(document).on('click','.up_s>img',function(e){
		var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
		var parent = this_obj.attr('parent');
		//排序图标
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[parent='0']").eq(0).before(this_obj);
			var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
			this_obj.after(child_obj);
			var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
			$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
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
			var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[code='"+parent+"']").after(this_obj); 
			
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				//var val = $(this).find(".number").val();
				//val = parseInt(val)+1;
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
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=1&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',     
	    });
	});

	/**排序上移操作**/
	$(document).on('click','.up>img',function(e){
		var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
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
				$(".categroy_table>tbody").find("tr[parent='0']").eq(index-2).before(this_obj);
				var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
				this_obj.after(child_obj);
				var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
				$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
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
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=2&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',     
	    });
		
	});

	/**排序置底操作**/
	$(document).on('click','.down_s>img',function(e){
		var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var parent = this_obj.attr('parent');
		var this_code = this_obj.attr('code');
		//排序图标
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody").append(this_obj);
			var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
			this_obj.after(child_obj);
			var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
			$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
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
			var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[parent='"+parent+"']:last").after(this_obj); 
			//this_obj.find('.number').val(length);
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				//var val = $(this).find(".number").val();
				//val = parseInt(val)-1;
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
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=4&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',
	    });
	});

	/**排序下移操作**/
	$(document).on('click','.down>img',function(e){
		var shop = $("input[name='shop_val']").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
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
				var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
				index = parseInt(index)+1;
				if(index == length){
					$(".categroy_table>tbody").append(this_obj);
				}else{
					$(".categroy_table>tbody").find("tr[parent='0']").eq(index).before(this_obj);
				}
				var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
				this_obj.after(child_obj);
				
				$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
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
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=3&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',
	    });
		
	});


	/**全部删除**/
	$("#del_all").click(function(){
		var shop = $("input[name='shop_val']").val();
		var length = $(".categroy_table>tbody>tr").length;
		if(length == 0) return false;
		var query = confirm("确定删除该店铺下的所有分类?");
		if(query == true){
			<?php $path_url = Yii::app()->createUrl('Shop/DelShopCateAll');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'shop='+shop,
		     	dataType:'json',
		     	success:function(data){
			     	alert(data);
			     	alert("删除成功！");
			     }
		    });
		}
	});

/**店铺分类结束**/

        /**table切换**/
        $(".table_switch > span").click(function(){
        	$(".table_switch > span").removeClass('myself_current');
        	$(this).addClass('myself_current');
        	if($(this).attr('val')==0){
            	$("#edit_line").removeClass('hidden');
            	$("#operation_table").addClass('hidden');
            	$("#category_table").addClass('hidden');
            }else if($(this).attr('val')==1){
            	$("#edit_line").addClass('hidden');
            	$("#operation_table").removeClass('hidden');
            	$("#category_table").addClass('hidden');
            }else if($(this).attr('val')==2){
            	$("#edit_line").addClass('hidden');
            	$("#operation_table").addClass('hidden');
            	$("#category_table").removeClass('hidden');
            }
    	});

    	
});

</script>
