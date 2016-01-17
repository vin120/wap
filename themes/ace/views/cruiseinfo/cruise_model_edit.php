<?php
    $this->pageTitle = Yii::t('vcos','邮轮模型管理');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'port_add';
    $menu_type = 'cruise_model_edit';
?>
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
	//$this->widget('navbarWidget');
	/*if(in_array('123', $auth) || $auth[0] == '0'){
		$canadd = TRUE;
	}  else {
		$canadd = False;
	}
	if(in_array('124', $auth) || $auth[0] == '0'){
		$canedit = TRUE;
	}  else {
		$canedit = False;
	}
	if(in_array('125', $auth) || $auth[0] == '0'){
		$candelete = TRUE;
	}  else {
		$candelete = FALSE;
	}*/
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
                            <?php echo yii::t('vcos', '邮轮信息管理')?>
							<small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '邮轮模型管理')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    
                    <div class="row" id="edit_port">
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
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '邮轮模型图')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$model['img_back'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo" id="photo"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '鼠标经过模型变色图')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$model['img_back_over'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo1" id="photo1"/>
                                    </div>
                                </div>  
                                <div class="space-4"></div>
                                <input type="hidden" value="" id="judge" name="judge">
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>

<script type="text/javascript">
jQuery(function($){ 
	if(<?php echo $act;?>==0){
	    $("#edit").validate({
	        rules: {
	            photo: {required:true},
	            photo1:{required:true},
	        },
	    });
	}
    


    <?php
        $this->widget('UploadjsWidget',array('form_id'=>'edit'));
    ?>

});

</script>