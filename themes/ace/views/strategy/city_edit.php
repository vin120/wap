<?php
    $this->pageTitle = Yii::t('vcos','编辑城市');
    $this->pageTag = 'city_list';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'city_add';
    $menu_type = 'city_list';
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
                            <?php echo yii::t('vcos', '邮轮攻略管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Strategy/city_list")?>"><?php echo yii::t('vcos', '城市列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑城市')?>
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
                                    'id'=>'edit',
                                ),
                            ));  
                            ?> 
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '添加外语')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="radio" check='no' class="iso_choose" name="language" value="en" />English
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '国家名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="country">
                                            <?php foreach ($country_sel as $row){ ?>
                                            <option value="<?php echo $row['country_id']?>" <?php if($row['country_id'] == $city['country_id']){echo "selected='selected'";}?>><?php echo $row['country_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '城市名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '城市名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="80" value="<?php echo $city_language['city_name']?>"/>
                                        <?php echo $form->error($city_language,'city_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_name">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '城市名').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name2" placeholder="<?php echo yii::t('vcos', '城市名').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="name_iso" maxlength="80" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                               
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($city['state']){echo "checked='checked'";}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
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
<script type="text/javascript">
jQuery(function($){
    
    $(".iso_choose").click(function(){
    	$check = $(this).attr('check');
        if($check == 'no'){
            $(this).attr('check','yes');
	        $a = $(this).val();
	        $b = '<?php echo $_GET['id']?>';
	        $.post("<?php echo Yii::app()->createUrl("Strategy/getiso_city")?>",{iso:$a,id:$b},function(data){
	            if(data != 0){
	                var result = jQuery.parseJSON(data);
	                $(".iso input:text").val('');
	                $(".iso_name input:text").val(result['city_name']);
	                $(".iso").removeClass('hidden'); 
	                $(".iso input:text").addClass('required');
	                $("#judge").val(result['id']);
	            }else{
	                $(".iso").removeClass('hidden');
	                $(".iso input:text").addClass('required');
	                $("#judge").val('add');
	            }
	        });
        }else if($check == 'yes'){
        	$(this).attr('check','no');
            $(this).removeAttr('checked');
            $(".iso").addClass('hidden');
            $(".iso input:text").removeClass('required');
            $("#judge").val('');
        }
    });
    
    $("#edit").validate({
        rules: {
            name:{required:true,stringCheckAll:true},
            name_iso:{isEnglish:true},
            country:{required:true, digits:true}
           
        },
        messages:{
            name:{
	            stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
			},
			name_iso:{
				isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符')?>",
			}
		}
    });
    
   
});
</script>



