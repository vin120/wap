<?php
    $this->pageTitle = Yii::t('vcos','编辑商品');
    $theme_url = Yii::app()->theme->baseUrl;
    
   // $menu_type = 'product_add';
    $menu_type = 'product_now_wait_list';
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
                            <?php echo yii::t('vcos', '商品管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Product/product_now_wait_list")?>"><?php echo yii::t('vcos', '商品列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑商品')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <style>
                    	.table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                    	.table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                    	.table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
                    </style>
                    <div class="table_switch"><span <?php if(!isset($_GET['action'])){echo "class='myself_current'";}?> val='0'>基本信息</span><span val='1' <?php if(isset($_GET['action'])&&$_GET['action']=='img'){echo "class='myself_current'";}?>>商品图片</span><span val='2' <?php if(isset($_GET['action'])&&$_GET['action']=='graphic'){echo "class='myself_current'";}?>>商品图文</span></div>
                    
                    <div class="row <?php if(isset($_GET['action'])){echo "hidden";}?>" id="edit_product">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                            <?php  
                            //使用小物件生成form元素  
                            $form=$this->beginWidget('CActiveForm',array(
                                'htmlOptions'=>array(
                                    'class'=>'form-horizontal',
                                    'role'=>'form',
                                    'id'=>'edit',
                                    'enctype'=>'multipart/form-data',
                                ),
                            ));  
                            ?>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品编码')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="code" placeholder="<?php echo yii::t('vcos', '商品编码')?>" class="col-xs-10 col-sm-8 col-md-8" name="code" maxlength="32" value="<?php echo $product['product_code']?>"/>
                                        <?php echo $form->error($product,'product_code'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '产地')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="origin" placeholder="<?php echo yii::t('vcos', '产地')?>" class="col-xs-10 col-sm-8 col-md-8" name="origin" maxlength="30" value="<?php echo $product['origin']?>"/>
                                        <?php echo $form->error($product,'origin'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '商品名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="42" value="<?php echo $product['product_name']?>"/>
                                        <?php echo $form->error($product,'product_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品描述')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<textarea id="desc" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '描述')?>" name="desc" maxlength=80><?php echo $product['product_desc']?></textarea>
                                        <?php echo $form->error($product,'product_desc'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品库存')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="num" placeholder="<?php echo yii::t('vcos', '商品库存')?>" class="col-xs-10 col-sm-8 col-md-8" name="num" maxlength="10" value="<?php echo $product['inventory_num']?>"/>
                                        <?php echo $form->error($product,'inventory_num'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品销售价')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="price" placeholder="<?php echo yii::t('vcos', '商品销售价')?>" class="col-xs-10 col-sm-8 col-md-8" name="price" maxlength="10" value="<?php echo $product['sale_price']/100;?>" />
                                        <?php echo $form->error($product,'sale_price'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品原价')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="mprice" placeholder="<?php echo yii::t('vcos', '商品原价')?>" class="col-xs-10 col-sm-8 col-md-8" name="mprice" maxlength="10" value="<?php echo $product['standard_price']/100;?>"/>
                                        <?php echo $form->error($product,'standard_price'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品分类')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<?php if($layer_1){?>
                                    	<select style="width:30%;" id="category_one" name="category_1">
                                          <?php foreach($layer_1 as $lay1){?>  
                                            <option value="<?php echo $lay1['category_code']?>" <?php if($layer_cat==$lay1['category_code']){echo "selected='selected'";}?>><?php echo $lay1['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_2){?>
                                    	<select style="width:30%;" id="category_two" name="category_2">
                                          <?php foreach($layer_2 as $lay2){?>  
                                            <option value="<?php echo $lay2['category_code']?>" <?php if($layer_cat2==$lay2['category_code']){echo "selected='selected'";}?>><?php echo $lay2['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_3){?>
                                    	<select style="width:30%;" id="category_three" name="category_3">
                                          <?php foreach($layer_3 as $lay3){?>  
                                            <option value="<?php echo $lay3['category_code']?>" <?php if($product['category_code']==$lay3['category_code']){echo "selected='selected'";}?>><?php echo $lay3['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php echo $form->error($product,'category_code'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品店铺')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="shop">
                                            <!-- <option value="0" <?php if($product['shop_id']==0){echo "selected='selected'";}?>>自营产品</option> -->
                                            <?php foreach($shop as $row){?>
                                            <option value="<?php echo $row['shop_id']?>" <?php if($product['shop_id']==$row['shop_id']){echo "selected='selected'";}?>><?php echo $row['shop_title']?></option>
                                            <?php }?>
                                        </select>
                                        <?php echo $form->error($product,'shop_id'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品品牌')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="brand">
                                    		<?php foreach($brand as $row){?>
                                            <option value="<?php echo $row['brand_id'];?>" <?php if($product['brand_id']==$row['brand_id']){echo "selected='selected'";}?>><?php echo $row['brand_cn_name']?></option>
                                            <?php }?>
                                        </select>
                                        <?php echo $form->error($product,'brand_id'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$product['product_img'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo" id="photo"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($product['status']==1){echo "checked='checked'";}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店内分类')?>：</label>
                                	<div class="col-xs-6 col-sm-6 col-md-6" style="margin-left:15px;">
                                    <div id="shop_category_product_div" style="width:300px;height:200px;border:1px solid #ccc;overflow-y: scroll;padding:0px 8px;">
                                    <?php if($shop_cat!=''){
                                    	$already_str = array();
                                    foreach ($already_shop_category as $k=>$row){
                                    	$already_str[$k] = $row['shop_category_id'];
                                    }
                                    	?>
                                   
                                    <dl>
                                    <?php foreach($shop_cat as $row){ ?>
                                    <?php if($row['level']==1){?>
                                    	<dt val="<?php echo $row['shop_category_id']?>"><?php echo  $row['shop_category_name']?></dt>
                                    	<?php }else{?>
                                    	 <dd style="margin-left:10px;"><input name="shop_cat[]"  class="shop_category_id" type="checkbox" <?php if(in_array($row['shop_category_id'], $already_str)){echo "checked='checked'";}?> value="<?php echo $row['shop_category_id']?>" style="margin-right:5px;" /><?php echo $row['shop_category_name']?></dd>
                                    	 <?php }?>
                                    <?php }?>
                                    </dl>
                                    <?php }?>
                                    </div>
                                    <div style="color:red;">注意：单个商品的店内分类最多支持10个</div>
                                    </div>
                                    
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '定时上架')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<label style="float: left;margin-top:2px;margin-right:5px;"><input type='checkbox'  checked='checekd' style="position:relative;top:2px;margin-left:5px;margin-right:2px;" name="up" value='1'/>设定</label>
                                       <!--  <input type="text" id="time" class="col-xs-10 col-sm-8 col-md-8 date-picker" name="time_up" maxlength="100" placeholder="<php echo yii::t('vcos', '上架日期')?>" />-->
                                        <input type="text" value="<?php echo substr($product['sale_start_time'] , 0 , -3)?>" id="datetimepicker_s" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '上架时间')?>"/>
                                        		系统会在该时间自动进行上架操作
                                    </div>
                                    <?php echo $form->error($product,'sale_start_time'); ?> 
                                </div>
							    
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '定时下架')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<label style="float: left;margin-top:2px;margin-right:5px;"><input type='checkbox' <?php if($product['sale_end_time']!='9999-12-31 23:59:59'){echo "checked='checked'";}?> style="position:relative;top:2px;margin-left:5px;margin-right:2px;" name="down" value='1'/>设定</label>
                                        <!-- <input type="text" id="time" class="col-xs-10 col-sm-8 col-md-8 date-picker" name="time_down" maxlength="100" placeholder="<php echo yii::t('vcos', '下架日期')?>" /> -->
                                        <input type="text" value="<?php if($product['sale_end_time']!='9999-12-31 23:59:59'){echo substr($product['sale_end_time'] , 0 , -3);}?>" id="datetimepicker_e" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '下架时间')?>"/>
                                        		系统会在该时间自动进行下架操作
                                    </div>
                                    <?php echo $form->error($product,'sale_start_time'); ?> 
                                </div>
                                <div class="space-4"></div>
                                <input type="hidden" value="" id="judge" name="judge">
                                <!-- 1:保存且下架，2：开始销售 -->
                                <input type="hidden" name="sub_type" value="1" />
                                <input type="submit" value="<?php echo yii::t('vcos', '保存且下架')?>" id="submit_keep" class="btn btn-primary" style="margin-left:40%"/>
                                <input type="submit" value="<?php echo yii::t('vcos', '开始销售')?>" id="submit_now" class="btn btn-primary" style="margin-left:2%;"/>

                            <?php  
                                $this->endWidget();  
                            ?>
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                    <!-- 商品图片 -->
                    <div class="row <?php echo isset($_GET['action'])&&$_GET['action']=='img'?'':'hidden'?>" id="product_img">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                        	<style>
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
                        		.product_img_file > div{margin-left:50px;width:300px;font:12px;}
                        		.product_graphic_file > div{margin-left:50px;width:300px;font:12px;}
                        	</style>
                        	
                        	<div id="del_all" class="click_but">批量删除</div>
                           <form method='post'  action="<?php echo Yii::app()->createUrl('Product/Product_edit_img_edit');?>" enctype="multipart/form-data" id="product_img_form">
                           <input type="hidden"  name='product' value="<?php echo $product['product_id']?>"/>
                           <input type='hidden' name='sort' value='' />
                           <input type='hidden' name='img_name' value='' />
                           <input type='hidden' name='img_id' value='' />
                           <table class="categroy_table"  style="width:100%;border-collapse:collapse;border:1px solid #ccc;">
                           	<thead>
                           		<tr>
                           			<td class="center" width='2%'>
                                         <label>
                                              <input type="checkbox" class="ace" />
                                              <span class="lbl"></span>
                                         </label>
                                    </td>
                           			<td width='8%'>图片</td>
                           			<td width='5%'>排序</td>
                           			<td width='5%'>操作</td>
                           		</tr>
                           	</thead>
                            <tbody key="<?php if($product_img != ''){echo count($product_img);}else{echo 0;}?>">
                            <?php if($product_img != ''){
                            	$count = count($product_img);
                            	foreach($product_img as $key=>$row){
                            ?>
                            	<tr edit='0' sort='<?php echo $row['sort_order']?>'>
                            		<td class='center'>
                            			<label>
                            				<input type='checkbox' name='ids[]' value='<?php echo $row['product_img_id']?>' class='ace isclick' />
        									<span class='lbl'></span>
        								</label>
        							</td>
									<td class='product_img_file' ><img src="<?php echo Yii::app()->params['imgurl'].$row['img_url'];?>" style="height:90px;float:left;margin-left: 50px;" title="<?php echo yii::t('vcos', '图片')?>" /><div class='file_img hidden' style="width:200px;float:left;"><input type='file' name='product_img<?php echo $key;?>'/></div></td>
									<?php if($count == 1){?>
										<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($key==0){?>
										<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($key+1 == $count){?>
										<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else{?>
										<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }?>
									<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>
								</tr>
							<?php }}?>
                          
                            </tbody>
                           </table>
                           </form>
                           <div id="add_category_one">添加新图片</div>
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                    <!-- 商品图文 -->
                    <div class="row <?php echo isset($_GET['action'])&&$_GET['action']=='graphic'?'':'hidden'?>" id="product_graphic">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                        	<div id="del_all_graphic" class="click_but">批量删除</div>
                           <form action="<?php echo Yii::app()->createUrl('Product/Product_edit_graphic_edit');?>" method="post" enctype="multipart/form-data" id="product_graphic_form">
                           <input type="hidden"  name='product' value="<?php echo $product['product_id']?>"/>
                           <input type='hidden' name='sort' value='' />
                           <input type='hidden' name='img_name' value='' />
                           <input type='hidden' name='img_id' value='' />
                           <input type='hidden' name='desc' value='' />
                           <table class="categroy_table_graphic" style="width:100%;border-collapse:collapse;border:1px solid #ccc;">
                           	<thead>
                           		<tr>
                           			<td class="center" width='2%'>
                                         <label>
                                              <input type="checkbox" class="ace" />
                                              <span class="lbl"></span>
                                         </label>
                                    </td>
                                    <td width='1%'>描述</td>
                           			<td width='12%'>图片</td>
                           			<td width='5%'>排序</td>
                           			<td width='5%'>操作</td>
                           		</tr>
                           	</thead>
                            <tbody key='<?php if($product_graphic!=""){echo count($product_graphic);}else{echo "0";}?>'>
                           <?php if($product_graphic != ''){
                            	$count = count($product_graphic);
                            	foreach($product_graphic as $key=>$row){
                            ?>
                            	<tr edit='0' sort='<?php echo $row["sort_order"];?>'>
                            		<td class='center'>
                                        <label>
                                            <input type='checkbox' name='ids[]' value='<?php echo $row["id"]?>' class='ace isclick' />
                                            <span class='lbl'></span>
                                        </label>
                                    </td>
                                    <td class='text_center'><textarea readonly="readonly"  style='resize:none;width:200px;height:90px;' class='desc' maxlength='80'><?php echo $row["graphic_desc"];?></textarea></td>
                            		<td class='text_center product_graphic_file' ><img src="<?php echo Yii::app()->params['imgurl'].$row['img_url'];?>" style="height:90px;;float:left;margin-left: 50px;" title="<?php echo yii::t('vcos', '图片')?>" /><div class='file_graphic hidden' style="width:200px;float:left;"><input type='file' name='product_graphic<?php echo $key;?>'/></div></td>
									<?php if($count == 1){?>
										<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($key==0){?>
										<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($key+1 == $count){?>
										<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else{?>
										<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }?>
                            		<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>
                            	</tr>
                           <?php }}?>
                            </tbody>
                           </table>
                           </form>
                           <div id="add_category_one">添加新图文</div>
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                    
                    
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
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script type="text/javascript">
jQuery(function($){
	var mydate = new Date();
	var day = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
    $('#datetimepicker_s').datetimepicker();
    //$('#datetimepicker_s').datetimepicker({value:day,step:1});
    $('#datetimepicker_e').datetimepicker();

    $("#edit").validate({
        rules: {
        	code:{required:true,isRightfulString:true},
            name:{required:true,stringCheckAll:true},
            origin:{required:true,stringCheckAll:true},
            desc:{required:true},
            num:{required:true,digits:true,isIntGtZero:true},
            price:{required:true,isFloatGtZero:true},
            mprice:{required:true,isFloatGtZero:true}
        }
    });
    /**点击保存下架，需设置上架时间**/
    $("#submit_keep").click(function(){
        var a=1;
        var checked_up = $("input[name='up']").is(":checked");
        var checked_down = $("input[name='down']").is(":checked");
        var up_day = $("input[name='time_up']").val();
        var down_day = $("input[name='time_down']").val();
        var shop_category_obj = $("input[type='checkbox'][class='shop_category_id']:checked");
       
        var mydate = new Date();
        var day_now = mydate.getFullYear()+'-'+Appendzero((mydate.getMonth()+1))+'-'+Appendzero(mydate.getDate());
        var time_now = Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes());
        var day_times = day_now+' '+time_now;
        if(checked_up == false || up_day == ''){
            alert("请选择设定上架时间，且时间必填!");
            a=0;return false;
        }
        if(checked_down == true && down_day != ''){
            //判断下架时间是否正确
            if(up_day > down_day || down_day < day_times){
                alert("请正确选择下架时间!");
                a=0;return false;
            }
        }
        if(shop_category_obj.length>10){
            alert("店内分类最多支持10个!");
            a=0;return false;
        }
        var product_code = $("input[name='code']").val();
        if($.trim(product_code)!=''){
        	var query = checkProductCode(<?php echo $product['product_id']?>,product_code);
        	if(query==0){
            	alert("商品编码已经存在，请更换!");
            	a=0;return false;}
        }
        if(a==0){
            return false;
        }
        $("input[name='sub_type']").val(1);
    });
	/**点击立即销售，可不选择上下架时间**/
    $("#submit_now").click(function(){
        var a = 1;
    	var checked_up = $("input[name='up']").is(":checked");
        var checked_down = $("input[name='down']").is(":checked");
        var up_day = $("input[name='time_up']").val();
        var down_day = $("input[name='time_down']").val();
        var shop_category_obj = $("input[type='checkbox'][class='shop_category_id']:checked");
        var mydate = new Date();
        var day_now = mydate.getFullYear()+'-'+Appendzero((mydate.getMonth()+1))+'-'+Appendzero(mydate.getDate());
        var time_now = Appendzero(mydate.getHours())+':'+Appendzero(mydate.getMinutes());
        var day_times = day_now+' '+time_now;
        if(checked_up == true){
            if(up_day == ''){
                alert('您选中了设定上架时间，请填写上架日期!');
                a=0;return false;
            }
            if(up_day > day_times){
                var r = confirm('当前时间还没到上架时间，是否当前开始销售!');
                if(r == true){
                    $("input[name='time_up']").val(day_times);
                }else if(r == false){
                    a=0;return false;
                }
            }
        }
        if(checked_down == true){
            if(down_day == ''){
            	alert('您选中了设定下架时间，请填写下架日期!');
            	a=0;return false;
            }
            if(down_day < day_times || down_day < up_day){
                alert("请正确添加下架日期！");
                a=0;return false;
            }
        }
        if(shop_category_obj.length>10){
            alert("店内分类最多支持10个!");
            a=0;return false;
        }
        
        var product_code = $("input[name='code']").val();
        if($.trim(product_code)!=''){
        	var query = checkProductCode(<?php echo $product['product_id']?>,product_code);
        	if(query==0){
            	alert("商品编码已经存在，请更换!");
            	a=0;return false;}
        }
        
        if(a==0){
        return false;
        }
        $("input[name='sub_type']").val(2);
        $("input[name='time_up']").val(day_times);

    });


  //店铺改变，店内分类改变
    $("#edit_product select[name='shop']").change(function(){
        var shop_id = $(this).val();
        <?php $path_url = Yii::app()->createUrl('Product/ChangeShopGetShopCategory');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'shop='+shop_id,
         	dataType:'json',
        	success:function(data){
        		str = "<dl>";
        		if(data!=0){
        		$.each(data,function(key){  
                    if(data[key]['level']==1){
                    str += '<dt val="'+data[key]['shop_category_id']+'">'+data[key]["shop_category_name"]+'</dt>';
                    }else{
                    str += '<dd style="margin-left:10px;"><input class="shop_category_id" name="shop_cat[]" type="checkbox" value="'+data[key]['shop_category_id']+'" style="margin-right:5px;" />'+data[key]["shop_category_name"]+'</dd>';
                    }
                   
                });
        		}
        		str += "</dl>";
        		$("#edit_product #shop_category_product_div").html(str);
        	}        
        });
    });

	/**商品图片复选框**/
    $('#product_img table thead td input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
    });

    /**商品图文复选框**/
    $('#product_graphic table thead td input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
    });


   
    
    <?php
        $this->widget('UploadjsWidget',array('form_id'=>'edit'));
    ?>
    <?php
       $this->widget('UploadjsWidget',array('form_id'=>'product_img'));
    ?>
   <?php
        $this->widget('UploadjsWidget',array('form_id'=>'product_graphic'));
   ?>
    /**改变商品分类一级,获取二级**/
    $('#category_one').change(function(){
        var this_code = $(this).val();
        var str = '';
        var str_ch = '';
        <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'parent_code='+this_code,
         	dataType:'json',
        	success:function(data){
        		$.each(data,function(key){  
                   str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                });
        		$("select[name='category_2']").html(str);
        		$.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:'parent_code='+data[0]['category_code'],
                 	dataType:'json',
                	success:function(data){
                		$.each(data,function(key){  
                           str_ch += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                        });
                		$("select[name='category_3']").html(str_ch);
                	}        
                });
        	}        
        });
    });

    /**改变商品分类一级,获取二级**/
    $('#category_two').change(function(){
        var this_code = $(this).val();
        var str = '';
        <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'parent_code='+this_code,
         	dataType:'json',
        	success:function(data){
        		$.each(data,function(key){  
                   str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                });
        		$("select[name='category_3']").html(str);
        	}      
        });
    });


    /**商品图片**/      	
	$("#product_img #add_category_one").click(function(){
		var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var tr = $("#product_img .categroy_table tbody tr").length;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		$('#product_img table tr:last').find('.down_s').html(downs_img); 
		$('#product_img table tr:last').find('.down').html(down_img);
		//获取该商品图片的最大排序
		var sort = 1;
		<?php $path_url = Yii::app()->createUrl('Product/ProductGetMaxSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'act=0&product='+<?php echo $product['product_id']?>,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		if(data != ''){
		    		sort = data;
		    		sort = parseInt(sort)+1;
		    	}
	    	}      
	    });
		var key = $(".categroy_table>tbody").attr('key');
		key = parseInt(key)+1;
		var str = '';
		str += "<tr edit='1' sort='"+sort+"'><td class='center'><label><input type='checkbox' name='ids[]' value='' class='ace isclick' />";
        str += "<span class='lbl'></span></label></td>"; 
		str += "<td class='product_img_file' ><input type='file' name='product_img"+key+"'/></td>";
		if(tr == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
		str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}
		str += "<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td></tr>";
		$(".categroy_table > tbody").append(str);  
		<?php
	       $this->widget('UploadjsWidget',array('form_id'=>'product_img_form'));
	    ?>
	});

	 /**商品图片完成**/
    $(document).on('click','#product_img .success_but',function(e){
        var obj = $(this).parent().parent().parent();
        if(obj.attr('edit')==0) return false;
        //判断该条记录是修改或是新增
        var this_id = obj.find("input[type='checkbox']").val();
        if(this_id != ''){
            //修改
        	//判断是否已经选择了图片
	      	var num = obj.find(".product_img_file").find("img").length;
	      	if(num == 1) {
		      	obj.find(".file_img").addClass('hidden');
		      	obj.attr('edit','0');
		      	return false;
		    }
	      	var img_name =  obj.find("input[type='file']").attr('name');
	      	$('#product_img').find("input[name='img_name']").val(img_name);
	      	$('#product_img').find("input[name='img_id']").val(this_id);
	    	$("#product_img form").submit();
            
        }else{
            //新增
	        //判断是否已经选择了图片
	      	var num = obj.find(".product_img_file").find("img").length;
	      	if(num == 0){alert('请选择上传图片!');return false;}
			var sort = obj.attr('sort');
			var img_name =  obj.find("input[type='file']").attr('name');
			$('#product_img').find("input[name='sort']").val(sort);
			$('#product_img').find("input[name='img_name']").val(img_name);
			$('#product_img').find("input[name='img_id']").val('');
	    	$("#product_img form").submit();
        }
        obj.attr('edit','0');
    });

    /**商品图片删除**/
    $(document).on('click','#product_img .del_but',function(e){
        var obj = $(this).parent().parent().parent();
        var id = obj.find("input[type='checkbox']").val();
        var query = confirm("您确定是否删除该行记录吗?");
        if(query == false) return false;
		//判断排序图标
		var tr_num = obj.index();
		var tr_count = $("#product_img table > tbody>tr").length;
		var flag = 0;
        if(query == true){
            if(id==''){
                flag = 1;
            }else{
            	<?php $path_url = Yii::app()->createUrl('Product/ProductDelMore');?>
            	$.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:'act=1&ids='+id,
                    async:false,
                 	dataType:'json',
                	success:function(data){
                		if(data != 0){
                    		//删除成功
                    		if(data == 1){
                    		alert('删除成功!');
                    		flag = 1;
                    		}
                    	}
                	}        
                });
            }
            if(flag == 1){
                if(tr_count!=1 && tr_count!=2){
                    if(tr_num == 0){
                    	$("#product_img table tbody").find('tr').eq(1).find('.up_s').html('');
                    	$("#product_img table tbody").find('tr').eq(1).find('.up').html('');
                    }else if(parseInt(tr_num)+1 == tr_count){
                    	$("#product_img table tbody").find('tr').eq(tr_count-2).find('.down_s').html('');
                    	$("#product_img table tbody").find('tr').eq(tr_count-2).find('.down').html('');
                    }
                }else if(tr_count == 2){
                	$("#product_img table tbody").find('tr').find('.up_s').html('');
                	$("#product_img table tbody").find('tr').find('.up').html('');
                	$("#product_img table tbody").find('tr').find('.down_s').html('');
                	$("#product_img table tbody").find('tr').find('.down').html('');
                }
                obj.remove();
            }
        }
    });

    //商品图片编辑
    $(document).on('click','#product_img .edit_but',function(e){
    	var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var obj = $(this).parent().parent().parent();
		obj.attr('edit','1');
		var id = obj.find("input[type='checkbox']").val();
		obj.find(".file_img").removeClass('hidden');
    });

    //商品图片批量删除
    $("#product_img #del_all").click(function(){
    	var ids = $("#product_img table>tbody input[type='checkbox']:checked");
		if(ids.length == 0){alert("请选择删除项!");return false;}
		var query = confirm("您确定删除所选记录?");
		if(query == false) return false;
		var ids_str = '';
		$.each(ids,function(key){
			ids_str += $(this).val()+',';
		});
		ids_str = ids_str.substring(0,ids_str.length-1);
		<?php $path_url = Yii::app()->createUrl('Product/ProductDelMore');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'post',
            data:'act=1&ids='+ids_str,
         	dataType:'json',
        	success:function(data){
        		if(data == 1){
        			alert("批量删除成功!");
        			window.location.reload();
            	}
        	}      
        });
    });
    //商品图片排序
    //置顶
    $(document).on('click','#product_img .up_s>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    obj.fadeOut().fadeIn(); 
		$("#product_img table>tbody>tr").eq(0).before(obj);
		
		sort();
		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductImgSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=1&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    });
    //上移
    $(document).on('click','#product_img .up>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    var index = obj.index();
	    obj.fadeOut().fadeIn();
	    $("#product_img table>tbody").find("tr").eq(index-1).before(obj);
	    
		sort();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductImgSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=2&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    });

    //置底
    $(document).on('click','#product_img .down_s>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    obj.fadeOut().fadeIn(); 
		$("#product_img table>tbody").append(obj);
		
		sort();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductImgSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=3&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
		
    });

    //商品图片下移
    $(document).on('click','#product_img .down>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_img table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		obj.fadeOut().fadeIn();
		var index = obj.index();
		var length = $("#product_img table>tbody").find("tr").length;
		index = parseInt(index)+2;
		if(index == length){
			$("#product_img table>tbody").append(obj);
		}else{
			$("#product_img table>tbody").find("tr").eq(index).before(obj);
		}

		sort();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductImgSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=4&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    }); 

/**********************************************************************************/
 	/**商品图文添加**/      	
	$("#product_graphic #add_category_one").click(function(){
		var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var tr = $("#product_graphic .categroy_table_graphic tbody tr").length;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		$('#product_graphic table tr:last').find('.down_s').html(downs_img); 
		$('#product_graphic table tr:last').find('.down').html(down_img);
		//获取该商品图片的最大排序
		var sort = 1;
		<?php $path_url = Yii::app()->createUrl('Product/ProductGetMaxSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'act=1&product='+<?php echo $product['product_id']?>,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		if(data != ''){
		    		sort = data;
		    		sort = parseInt(sort)+1;
		    	}
	    	}      
	    });
		var key = $("#product_graphic .categroy_table_graphic>tbody").attr('key');
		key = parseInt(key)+1;
		var str = '';
		str += "<tr edit='1' sort='"+sort+"'>";
		str += "<td class='center'><label><input type='checkbox' name='ids[]' value='' class='ace isclick' /><span class='lbl'></span></label></td>";
        str += "<td class='text_center'><textarea  style='resize:none;width:200px;height:90px;' class='desc' maxlength='80'></textarea></td>";   
        str += "<td class='text_center product_graphic_file'><input type='file' value=''  name='product_graphic"+key+"'  /></td>";       
        if(tr == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
			str += "<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}        
        str += "<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td></td>";
		str += "</tr>";
		
		$("#product_graphic .categroy_table_graphic > tbody").append(str);  
		<?php
	       $this->widget('UploadjsWidget',array('form_id'=>'product_graphic_form'));
	    ?>
	});

	/**商品图文完成**/
    $(document).on('click','#product_graphic .success_but',function(e){
        var obj = $(this).parent().parent().parent();
        if(obj.attr('edit')==0) return false;
        //判断该条记录是修改或是新增
        var this_id = obj.find("input[type='checkbox']").val();
        if(this_id != ''){
            //修改
        	//判断是否已经选择了图片
	      	var num = obj.find(".product_graphic_file").find("img").length;
	      	/*if(num == 1) {
		      	obj.find(".file_graphic").addClass('hidden');
		      	obj.attr('edit','0');
		      	return false;
		    }*/
	      	var img_name =  obj.find("input[type='file']").attr('name');
	      	var this_desc =  obj.find("textarea").val();
	      	$('#product_graphic').find("input[name='img_name']").val(img_name);
	      	$('#product_graphic').find("input[name='img_id']").val(this_id);
	      	$('#product_graphic').find("input[name='desc']").val(this_desc);
	    	$("#product_graphic form").submit();
            
        }else{
            //新增
	        //判断是否已经选择了图片
	      	var num = obj.find("td.product_graphic_file").find("img").length;
	      	if(num == 0){alert('请选择上传图片!');return false;}
			var sort = obj.attr('sort');
			var img_name =  obj.find("input[type='file']").attr('name');
			var this_desc =  obj.find("textarea").val();
			$('#product_graphic').find("input[name='sort']").val(sort);
			$('#product_graphic').find("input[name='img_name']").val(img_name);
			$('#product_graphic').find("input[name='img_id']").val('');
			$('#product_graphic').find("input[name='desc']").val(this_desc);
	    	$("#product_graphic form").submit();
        }
        obj.find("textarea[class='desc']").addAttr("readonly",'readonly');
        obj.attr('edit','0');
    });

  //商品图文编辑
    $(document).on('click','#product_graphic .edit_but',function(e){
    	var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var obj = $(this).parent().parent().parent();
		obj.attr('edit','1');
		var id = obj.find("input[type='checkbox']").val();
		obj.find("textarea[class='desc']").removeAttr("readonly");
		obj.find(".file_graphic").removeClass('hidden');
		
    });

    /**商品图文删除**/
    $(document).on('click','#product_graphic .del_but',function(e){
        var obj = $(this).parent().parent().parent();
        var id = obj.find("input[type='checkbox']").val();
        var query = confirm("您确定是否删除该行记录吗?");
        if(query == false) return false;
		//判断排序图标
		var tr_num = obj.index();
		var tr_count = $("#product_graphic table > tbody>tr").length;
		var flag = 0;
        if(query == true){
            if(id==''){
                flag = 1;
            }else{
            	<?php $path_url = Yii::app()->createUrl('Product/ProductDelMore');?>
            	$.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:'act=2&ids='+id,
                    async:false,
                 	dataType:'json',
                	success:function(data){
                		if(data != 0){
                    		//删除成功
                    		if(data == 1){
                    		alert('删除成功!');
                    		flag = 1;
                    		}
                    	}
                	}        
                });
            }
            if(flag == 1){
                if(tr_count!=1 && tr_count!=2){
                    if(tr_num == 0){
                    	$("#product_graphic table tbody").find('tr').eq(1).find('.up_s').html('');
                    	$("#product_graphic table tbody").find('tr').eq(1).find('.up').html('');
                    }else if(parseInt(tr_num)+1 == tr_count){
                    	$("#product_graphic table tbody").find('tr').eq(tr_count-2).find('.down_s').html('');
                    	$("#product_graphic table tbody").find('tr').eq(tr_count-2).find('.down').html('');
                    }
                }else if(tr_count == 2){
                	$("#product_graphic table tbody").find('tr').find('.up_s').html('');
                	$("#product_graphic table tbody").find('tr').find('.up').html('');
                	$("#product_graphic table tbody").find('tr').find('.down_s').html('');
                	$("#product_graphic table tbody").find('tr').find('.down').html('');
                }
                obj.remove();
            }
        }
    });

  //商品图文批量删除
    $("#product_graphic #del_all_graphic").click(function(){
    	var ids = $("#product_graphic table>tbody input[type='checkbox']:checked");
		if(ids.length == 0){alert("请选择删除项!");return false;}
		var query = confirm("您确定删除所选记录?");
		if(query == false) return false;
		var ids_str = '';
		$.each(ids,function(key){
			ids_str += $(this).val()+',';
		});
		ids_str = ids_str.substring(0,ids_str.length-1);
		<?php $path_url = Yii::app()->createUrl('Product/ProductDelMore');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'post',
            data:'act=2&ids='+ids_str,
         	dataType:'json',
        	success:function(data){
        		if(data == 1){
        			alert("批量删除成功!");
        			window.location.reload();
            	}
        	}      
        });
    });

  //商品图文排序
    //置顶
    $(document).on('click','#product_graphic .up_s>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    obj.fadeOut().fadeIn(); 
		$("#product_graphic table>tbody>tr").eq(0).before(obj);
		
		sort_graphic();
		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductGraphicSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=1&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    });
    //上移
    $(document).on('click','#product_graphic .up>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    var index = obj.index();
	    obj.fadeOut().fadeIn();
	    $("#product_graphic table>tbody").find("tr").eq(index-1).before(obj);
	    
	    sort_graphic();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductGraphicSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=2&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    });

    //置底
    $(document).on('click','#product_graphic .down_s>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		
	    obj.fadeOut().fadeIn(); 
		$("#product_graphic table>tbody").append(obj);
		
		sort_graphic();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductGraphicSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=3&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
		
    });

    //商品图片下移
    $(document).on('click','#product_graphic .down>img',function(e){
    	var obj = $(this).parent().parent().parent();
    	var num =$("#product_graphic table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var img_id = obj.find("input[type='checkbox']").val();
		obj.fadeOut().fadeIn();
		var index = obj.index();
		var length = $("#product_graphic table>tbody").find("tr").length;
		index = parseInt(index)+2;
		if(index == length){
			$("#product_graphic table>tbody").append(obj);
		}else{
			$("#product_graphic table>tbody").find("tr").eq(index).before(obj);
		}

		sort_graphic();

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Product/UpdateProductGraphicSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act=4&id='+img_id+'&product='+<?php echo $product['product_id'];?>,
	     	dataType:'json',     
	    });
    }); 
 
 
                           	

    /**table切换**/
    $(".table_switch > span").click(function(){
    	$(".table_switch > span").removeClass('myself_current');
    	$(this).addClass('myself_current');
    	if($(this).attr('val')==0){
        	$("#edit_product").removeClass('hidden');
        	$("#product_img").addClass('hidden');
        	$("#product_graphic").addClass('hidden');
        }else if($(this).attr('val')==1){
        	$("#edit_product").addClass('hidden');
        	$("#product_img").removeClass('hidden');
        	$("#product_graphic").addClass('hidden');
        }else if($(this).attr('val')==2){
        	$("#edit_product").addClass('hidden');
        	$("#product_img").addClass('hidden');
        	$("#product_graphic").removeClass('hidden');
        }
	});
	
});

function sort(){
	//排序图标
	var url = "<?php echo $theme_url; ?>"+"/assets/images";
    var up_s = "<img src='"+url+"/sh_02.png' />";
    var up = "<img src='"+url+"/sh_03.png' />";
    var down_s = "<img src='"+url+"/sh_01.png' />";
    var down = "<img src='"+url+"/sh_04.png' />";
	var length = $("#product_img table>tbody").find("tr").length;
	$("#product_img table>tbody").find("tr").each(function(i){
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
function sort_graphic(){
	//排序图标
	var url = "<?php echo $theme_url; ?>"+"/assets/images";
    var up_s = "<img src='"+url+"/sh_02.png' />";
    var up = "<img src='"+url+"/sh_03.png' />";
    var down_s = "<img src='"+url+"/sh_01.png' />";
    var down = "<img src='"+url+"/sh_04.png' />";
	var length = $("#product_graphic table>tbody").find("tr").length;
	$("#product_graphic table>tbody").find("tr").each(function(i){
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
function Appendzero (obj) {
	  if (obj < 10) return "0"+obj; else return obj;
}
/**判断商品编码是否唯一**/
	function checkProductCode(product_id,code){
	 	var query = 0;
		<?php $path_url = Yii::app()->createUrl('Product/CheckProductCode');?>
    $.ajax({
        url:"<?php echo $path_url;?>",
        type:'get',
        data:'product_id='+product_id+'&code='+code,
        async: false,
     	dataType:'json',
    	success:function(data){
    		query = data;
    	}      
    });
    return query;
	}
</script>
