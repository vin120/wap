<?php
    $this->pageTitle = Yii::t('vcos','添加电话服务类型');
    $theme_url = Yii::app()->theme->baseUrl; 
    //$menu_type = 'telephone_service_type_add';
    $menu_type = 'telephone_service_type_list';
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
                            <?php echo yii::t('vcos', '网络通信管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Systemsetting/telephone_service_type_list")?>"><?php echo yii::t('vcos', '电话服务类型列表 ')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '添加电话服务类型')?>
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
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '添加外语')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="radio" check='no' class="iso_choose" name="language" value="en" />English
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '名称')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="title" placeholder="<?php echo yii::t('vcos', '名称')?>" class="col-xs-10 col-sm-8 col-md-8" name="title" maxlength="80" />
                                        <?php echo $form->error($item_language,'tel_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_title">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '名称').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles" placeholder="<?php echo yii::t('vcos', '名称').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="title_iso" maxlength="80" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '价格')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="price" placeholder="<?php echo yii::t('vcos', '价格')?>" class="col-xs-10 col-sm-8 col-md-8" name="price" maxlength="8" />
                                        <?php echo $form->error($item,'sale_price'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '时间')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    <input type="hidden" name='time' value='' />
                                        <label style="width:20%;"><select name="day" style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var i=0;i<=30;i++){
                                            	document.write("<option value='"+i+"'>"+i+"</option>");
                                            	}
                                        	</script>
                                        </select>天</label>
                                        <label style="width:20%;"><select name="hours"  style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var j=0;j<=23;j++){
                                            	document.write("<option value='"+j+"'>"+j+"</option>");
                                            	}
                                        	</script>
                                        </select>时</label>
                                        <label style="width:20%;"><select name="minute"  style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var k=0;k<60;k+=5){
                                            	document.write("<option value='"+k+"'>"+k+"</option>");
                                            	}
                                        	</script>
                                        </select>分</label>
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
    $(".iso_choose").click(function(){
    	$check = $(this).attr('check');
        if($check == 'no'){
            $(this).attr('check','yes');
	        $(".iso").removeClass('hidden');
	        $(".iso input:text").addClass('required');
        }else if($check == 'yes'){
        	$(this).attr('check','no');
            $(this).removeAttr('checked');
            $(".iso").addClass('hidden');
	        $(".iso input:text").removeClass('required');
        }
    });
    $('form').submit(function(){
        if($("input[name='title']").val()=='' || $("input[name='price']").val()=='') return false;
        var msg = checkTelItemName();
	    if(msg == 0){
		    alert('名称中文或英文已存在!');
	       return false;
	    }
	    var day = $("select[name='day']").val();
	    var hours = $("select[name='hours']").val();
	    var minute = $("select[name='minute']").val();
		var time = parseInt(day)*86400+parseInt(hours)*3600+parseInt(minute)*60;
		if(time<=0){
			alert("时间不能小于0分钟");return false;
			}
		$("input[name='time']").val(time);
    });
    
    $("#add").validate({
        rules: {
            title: {required:true,stringCheckAll:true},
            title_iso: {isEnglish:true},
            price:{required:true,isFloatGtZero:true},
        },
	    messages:{
			title:{
	            stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
			},
			title_iso:{
				isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符:')?>",
			}
		}
       
	});
});
function checkTelItemName(){ 
    flag = 1;
    $name = $("input[name='title']").val();
    $name_iso = $("input[name='titles']").val();
	$url = "<?php echo Yii::app()->createUrl("Systemsetting/CheckTelItemName")?>";
	$.ajax({
		type:'post',
		data:'title='+$name+'&title_iso='+$name_iso,
		url:$url,
		async: false,
		success:function(data){
		    if(data > 0){
				flag =  0;
		    }else{
				flag =  1;
			}
		}
	});
	return flag;
}
</script>