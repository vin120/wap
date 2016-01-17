<?php
    $this->pageTitle = Yii::t('vcos','添加导航');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'navigation_add';
    $menu_type = 'navigation_list';
?>
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
                            <?php echo yii::t('vcos', '导航管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Navigation/navigation_list")?>"><?php echo yii::t('vcos', '导航列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '添加导航')?>
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
                                ),
                            ));  
                            ?>  
                            	
                            	<div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '导航名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '导航名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="10" />
                                        <?php echo $form->error($navigation,'navigation_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '活动')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<!-- <select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="activity">
                                    		<php foreach($activity as $row){?>
                                            <option value="<php echo $row['activity_id']?>"><php  echo $row['activity_name']?></option>
                                            <php }?>
                                            
                                        </select> 
                                        <php echo $form->error($navigation,'navigation_style_type'); ?>--> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '排序')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="sort" placeholder="<?php echo yii::t('vcos', '排序')?>" class="col-xs-10 col-sm-8 col-md-8" name="sort" maxlength="10" />
                                        <?php echo $form->error($navigation,'sort_order'); ?> 
                                    </div>
                                </div>
                            	
                                
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '是否显示')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" checked="checked" class="ace ace-switch ace-switch-5" name="show" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '是否第一个显示')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox"  class="ace ace-switch ace-switch-5" name="main" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '是否设置分类')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox"  class="ace ace-switch ace-switch-5" name="set_cat" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group type_check_tr">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '导航类型')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7 type_check">
                                    	<label style="margin:1px 15px 0px 0px;"><input style="margin-right: 5px;" type="checkbox" name="type_activity" value="1"/>活动</label>
                                    	<label style="margin:1px 15px 0px 0px;"><input style="margin-right: 5px;" type="checkbox" name="type_shop" value="2"/>店铺</label>
                                    	<label style="margin:1px 15px 0px 0px;"><input style="margin-right: 5px;" type="checkbox" name="type_product" value="3"/>商品</label>
                                        <?php echo $form->error($navigation,'navigation_style_type'); ?> 
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
                                <input type="submit" value="<?php echo yii::t('vcos', '提交')?>" id="submit" class="btn btn-primary" style="margin-left: 45%"/>
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
<script type="text/javascript">
jQuery(function($){
    $("#add").validate({
        rules: {
            name:{required:true,stringCheckAll:true},
            sort:{required:true,digits:true,isIntGtZero:true}
        }
    });

    /**设置是否第一显示*/
    $("input[name='main']").click(function(){
    	var this_checked = $("input[name='main']:checkbox:checked").val();
    	var set_category = $("input[name='set_cat']:checkbox:checked").val();
    	if(this_checked == 1){
        	var res = 0;
        	$.ajax({
        		type:'get',
    			async: false, 
    			url:'<?php echo Yii::app()->createUrl("Navigation/CheckIsMain")?>',
    			success:function(msg){
    				res = msg;
    			}
            });
            if(res == 1){
                if(set_category == 1){
                	var r = confirm("导航中已经存在第一个显示并您已选中设置分类，是否要取消其它的显示并取消分类选中?");
                }else{
            		var r = confirm("导航中已经存在第一个显示，是否要取消其它的显示?");
                }  
                if(r==true){
                	$("input[name='set_cat']:checkbox:checked").removeAttr("checked");
                    //取消其它
                	$.ajax({
                		type:'get',
            			async: false, 
            			url:'<?php echo Yii::app()->createUrl("Navigation/OffIsMain")?>',
                    });
                	$(".type_check_tr").removeClass("hidden");
                	$(".type_check_tr").find("input[type='checkbox']").each(function(){
                		$(this).prop("checked",true);
                    });
                }
                if(r == false){ return false;}
            }else{
            	if(set_category == 1){
                	var q = confirm("您已选中设置分类，是否要取消分类选中?");
                	if(q==true){
                    	$("input[name='set_cat']:checkbox:checked").removeAttr("checked");
                    	$(".type_check_tr").removeClass("hidden");
                    	$(".type_check_tr").find("input[type='checkbox']").each(function(){
                    		$(this).prop("checked",true);
                        });
                    }
                    if(q == false) {$(".type_check_tr").addClass("hidden");return false;}
                }else{
                	$(".type_check_tr").find("input[type='checkbox']").each(function(){
                		$(this).prop("checked",true);
                    });
                }
            	
            }
            
        }
    });

    /**设置分类**/
    $("input[name='set_cat']").click(function(){
    	var this_checked = $("input[name='main']:checkbox:checked").val();
    	var set_category = $("input[name='set_cat']:checkbox:checked").val();
    	if(set_category == 1){
        	if(this_checked==1){
        		var q = confirm("您已选中设置导航是否第一个显示，是否要取消导航是第一个显示?");
        		if(q == true){
        			//取消其它
        			$("input[name='main']:checkbox:checked").removeAttr("checked");
                	$.ajax({
                		type:'get',
            			async: false, 
            			url:'<?php echo Yii::app()->createUrl("Navigation/OffIsMain")?>',
                    });
                    $(".type_check_tr").addClass("hidden");
            	}
        		if(q == false) return false;
            }else{
            	$(".type_check_tr").addClass("hidden");
            }
        }else{
        	$(".type_check_tr").removeClass("hidden");
        }
    });

    /**表单提交**/
    $('form').submit(function(){
    	var this_checked = $("input[name='main']:checkbox:checked").val();
    	var set_category = $("input[name='set_cat']:checkbox:checked").val();
        var a = 1;
        var q = 0;
        
        if(set_category==1){
        	$(".type_check input[type='checkbox']").each(function(e){
    			if($(this).is(":checked")){
    				$(this).removeAttr("checked");
    			}
    		});
        }else{
        	if(this_checked==1){
            	$(".type_check input[type='checkbox']").each(function(e){
        			if(!$(this).is(":checked")){		//三个类型都需要选中
        			 	q= 2;return false;
        			}
        		});
        		if(q!=2) q=1;
            }else{
				$(".type_check input[type='checkbox']").each(function(e){
					if($(this).is(":checked")){
					 	q = 1;
					}
				});
            }
            if(q==2){
                alert("三个类型都必须选中!");
                a=0;return false;
            }else if(q==0){
				alert("请选择导航类型，至少勾选一个!");
				a=0;return false;
			}
        }
       //判断导航名是否已经存在
        var name = $("input[name='name']").val();
        
        if($.trim(name)!=''){
        	var flag = 0;
	        <?php $path_url = Yii::app()->createUrl('Navigation/CheckNavNameExits');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'name='+name,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		if(data==0) flag=1;
		    	}      
		    });
		    if(flag==0){
	            alert("导航名已存在，请更换导航名称!");
		   		return false;
	        }
        }
        
       if(a == 0){
           return false;
       }
      
    });
});
</script>