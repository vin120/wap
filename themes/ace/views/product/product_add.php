<?php
    $this->pageTitle = Yii::t('vcos','添加商品');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'product_add';
    $menu_type = 'product_now_wait_list';
?>
<link rel="stylesheet"  href="<?php echo $theme_url; ?>/assets/css/jquery.datetimepicker.css" />             
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
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
                            <?php echo yii::t('vcos', '商品管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Product/product_now_wait_list")?>"><?php echo yii::t('vcos', '商品列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '添加商品')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                            <?php  
                            //使用小物件生成form元素  
                            $form=$this->beginWidget('CActiveForm',array(
                                'htmlOptions'=>array(
                                    'class'=>'form-horizontal',
                                    'role'=>'form',
                                    'id'=>'add',
                                    'enctype'=>'multipart/form-data',
                                ),
                            ));  
                            ?> 
                            	<input type='hidden' name="category" value="<?php echo $category;?>">
                            	<input type='hidden' name="shop" value="<?php echo $shop;?>">
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品编码')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="code" placeholder="<?php echo yii::t('vcos', '商品编码')?>" class="col-xs-10 col-sm-8 col-md-8" name="code" maxlength="32" />
                                        <?php echo $form->error($product,'product_code'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '商品名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="42" />
                                        <?php echo $form->error($product,'product_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '产地')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="origin" placeholder="<?php echo yii::t('vcos', '产地')?>" class="col-xs-10 col-sm-8 col-md-8" name="origin" maxlength="30" />
                                        <?php echo $form->error($product,'origin'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品描述')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<textarea id="desc" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '描述')?>" name="desc" maxlength=80></textarea>
                                        <?php echo $form->error($product,'product_desc'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品库存')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="num" placeholder="<?php echo yii::t('vcos', '商品库存')?>" class="col-xs-10 col-sm-8 col-md-8" name="num" maxlength="10" />
                                        <?php echo $form->error($product,'inventory_num'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品销售价')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="price" placeholder="<?php echo yii::t('vcos', '商品销售价')?>" class="col-xs-10 col-sm-8 col-md-8" name="price" maxlength="10" />
                                        <?php echo $form->error($product,'sale_price'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品原价')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text" id="mprice" placeholder="<?php echo yii::t('vcos', '商品原价')?>" class="col-xs-10 col-sm-8 col-md-8" name="mprice" maxlength="10" />
                                        <?php echo $form->error($product,'standard_price'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品分类')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<?php if($layer_1){?>
                                    	<select style="width:30%;" id="category_one" name="category_1">
                                          <?php foreach($layer_1 as $lay1){?>  
                                            <option value="<?php echo $lay1['category_code']?>"><?php echo $lay1['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_2){?>
                                    	<select style="width:30%;" id="category_two" name="category_2">
                                          <?php foreach($layer_2 as $lay2){?>  
                                            <option value="<?php echo $lay2['category_code']?>"><?php echo $lay2['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_3){?>
                                    	<select style="width:30%;" id="category_three" name="category_3">
                                          <?php foreach($layer_3 as $lay3){?>  
                                            <option value="<?php echo $lay3['category_code']?>"><?php echo $lay3['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php echo $form->error($product,'category_code'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品店铺')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="">
                                            <option value="0">自营产品</option>
                                            <?php foreach($shop_sel as $row){?>
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
                                            <option value="<?php echo $row['brand_id'];?>"><?php echo $row['brand_cn_name']?></option>
                                            <?php }?>
                                        </select>
                                        <?php echo $form->error($product,'brand_id'); ?> 
                                    </div>
                                </div>
                                
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片')?>：</label>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <input type="file" name="photo" id="photo"/>
                                        <font style="color: red; display: none"><?php echo yii::t('vcos', '请上传图片')?></font>
                                        <?php echo $form->error($product,'product_img'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" checked="checked" class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '店内分类')?>：</label>
                                	<div class="col-xs-6 col-sm-6 col-md-6" style="margin-left:15px;">
                                    <div  id="shop_category_product_div" style="width:300px;height:200px;border:1px solid #ccc;overflow-y: scroll;padding:0px 8px;">
                                    <?php if($shop_cat!=''){?>
                                    <dl>
                                    <?php foreach($shop_cat as $row){ ?>
                                    <?php if($row['level']==1){?>
                                    	<dt val="<?php echo $row['shop_category_id']?>"><?php echo  $row['shop_category_name']?></dt>
                                    	<?php }else{?>
                                    	 <dd style="margin-left:10px;"><input class="shop_category_id" name="shop_cat[]" type="checkbox" value="<?php echo $row['shop_category_id']?>" style="margin-right:5px;" /><?php echo $row['shop_category_name']?></dd>
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
                                    	<label style="float: left;margin-top:2px;margin-right:5px;"><input type='checkbox' style="position:relative;top:2px;margin-left:5px;margin-right:2px;" name="up" value='1'/>设定</label>
                                       <!--  <input type="text" id="time" class="col-xs-10 col-sm-8 col-md-8 date-picker" name="time_up" maxlength="100" placeholder="<php echo yii::t('vcos', '上架日期')?>" />-->
                                        <input type="text" value="" id="datetimepicker_s" name="time_up" maxlength="100" placeholder="<?php echo yii::t('vcos', '上架时间')?>"/>
                                        		系统会在该时间自动进行上架操作
                                    </div>
                                    <?php echo $form->error($product,'sale_start_time'); ?> 
                                </div>
							    
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '定时下架')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<label style="float: left;margin-top:2px;margin-right:5px;"><input type='checkbox' style="position:relative;top:2px;margin-left:5px;margin-right:2px;" name="down" value='1'/>设定</label>
                                        <!-- <input type="text" id="time" class="col-xs-10 col-sm-8 col-md-8 date-picker" name="time_down" maxlength="100" placeholder="<php echo yii::t('vcos', '下架日期')?>" /> -->
                                        <input type="text" value="" id="datetimepicker_e" name="time_down" maxlength="100" placeholder="<?php echo yii::t('vcos', '下架时间')?>"/>
                                        		系统会在该时间自动进行下架操作
                                    </div>
                                    <?php echo $form->error($product,'sale_start_time'); ?> 
                                </div>
                                
                                <div class="space-4"></div>
                                <!-- 1:保存且下架，2：开始销售 -->
                                <input type="hidden" name="sub_type" value="1" />
                                <input type="submit" value="<?php echo yii::t('vcos', '保存且下架')?>" id="submit_keep" class="btn btn-primary" style="margin-left:40%"/>
                                <input type="submit" value="<?php echo yii::t('vcos', '开始销售')?>" id="submit_now" class="btn btn-primary" style="margin-left:2%;"/>

                            <?php  
                                $this->endWidget();  
                            ?>
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script type="text/javascript">
jQuery(function($){
    var mydate = new Date();
	var day = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
    //$('#datetimepicker_s').datetimepicker();
   $('#datetimepicker_s').datetimepicker({value:day,step:1});
   $('#datetimepicker_e').datetimepicker({value:day,step:1});
	

    <?php
        $this->widget('UploadjsWidget',array('form_id'=>'add'));
    ?>
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
        if(product_code!=''){
        	var query = checkProductCode(product_code);
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
        	var query = checkProductCode(product_code);
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

  
    
    /*
    $('form').submit(function(){
		var data_up = $("input[name='time_up']").val();
		alert(data_up);
        return false;*/
        /*
        var a=1;
    	var date = $("#time").val();
    	if(date == ''){
        	alert("<php echo Yii::t('vcos','请输入有效日期');?>");
        	a = 0;
        }
        date = date.split(' - ');
        if(date[0] == date[1]){
           //日期为同一天需判断结束时间不能大于开始时间
            var stime = $("#stime").val();
            var etime = $("#etime").val();
            if(stime > etime){
                alert("<php echo Yii::t('vcos','请输入正确的结束时间');?>");
                a = 0;
            }
        }
       if(a == 0){
           return false;
       }*/
  /*  });*/

    
    $("#add").validate({
        rules: {
            code:{required:true,isRightfulString:true},
            name:{required:true,stringCheckAll:true},
            origin:{required:true,stringCheckAll:true},
            desc:{required:true},
            num:{required:true,isIntGtZero:true,digits:true},
            price:{required:true,isFloatGtZero:true},
            mprice:{required:true,isFloatGtZero:true},
            photo:{required:true}
            
        }
    });

    /**改变商品分类一级,获取二级**/
    /*
    $('#category_one').change(function(){
        var this_code = $(this).val();
        var str = '';
        var str_ch = '';
        <php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
        $.ajax({
            url:"<php echo $path_url;?>",
            type:'get',
            data:'parent_code='+this_code,
         	dataType:'json',
        	success:function(data){
        		$.each(data,function(key){  
                   str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                });
        		$("select[name='category_2']").html(str);
        		$.ajax({
                    url:"<php echo $path_url;?>",
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
    });*/

    /**改变商品分类一级,获取二级**/
    /*
    $('#category_two').change(function(){
        var this_code = $(this).val();
        var str = '';
        <php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
        $.ajax({
            url:"<php echo $path_url;?>",
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
    });*/

});
function Appendzero (obj) {
	  if (obj < 10) return "0"+obj; else return obj;
}

/**判断商品编码是否唯一**/
 	function checkProductCode(code){
 	 	var query = 0;
 		<?php $path_url = Yii::app()->createUrl('Product/CheckProductCode');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            data:'code='+code,
            async: false,
         	dataType:'json',
        	success:function(data){
        		query = data;
        	}      
        });
        return query;
 	}
</script>