<?php
    $this->pageTitle = Yii::t('vcos','编辑电话服务类型');
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
                                    <a href="<?php echo Yii::app()->createUrl("Systemsetting/telephone_service_type_list")?>"><?php echo yii::t('vcos', '电话服务类型管理')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑电话服务类型')?>
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
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '编辑外语')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="radio" check='no' class="iso_choose" name="language" value="en" />English
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '名称')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="title" placeholder="<?php echo yii::t('vcos', '名称')?>" value="<?php echo $item_language['tel_name']?>" class="col-xs-10 col-sm-8 col-md-8" name="title" maxlength="80" />
                                        <?php echo $form->error($item_language,'tel_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_name">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '名称').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles" placeholder="<?php echo yii::t('vcos', '名称').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="titles" maxlength="80" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '价格')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="price" value="<?php echo $item['sale_price']/100?>" placeholder="<?php echo yii::t('vcos', '价格')?>" class="col-xs-10 col-sm-8 col-md-8" name="price" maxlength="8" />
                                        <?php echo $form->error($item,'sale_price'); ?> 
                                    </div>
                                </div>
                                
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '时间')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    <input type="hidden" name='time' value='' />
                                    <?php
                                    function time2second($seconds){
                                    	$seconds = (int)$seconds;
                                    	if( $seconds<86400 ){//如果不到一天
                                    		$format_time = gmstrftime('-1&%H&%M', $seconds);
                                    	}else{
                                    		$time = explode(' ', gmstrftime('%j %H %M %S', $seconds));//Array ( [0] => 04 [1] => 14 [2] => 14 [3] => 35 )
                                    		$format_time = ($time[0]-1).'&'.$time[1].'&'.$time[2];
                                    	}
                                    	return $format_time;
                                    }
                                    $times = time2second($item['tel_time']);
                                    $times = explode('&', $times);
                                    $day = ltrim($times[0],'0');
                                    $hours = ltrim($times[1],'0');
                                    $minute = ltrim($times[2],'0');
                                    ?>
                                   
                                        <label style="width:20%;"><select name="day" style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var i=0;i<=30;i++){
                                            	if(i=='<?php echo $day?>'){var ch="selected='selected'";}else{var ch='';}
                                            	document.write("<option "+ch+" value='"+i+"'>"+i+"</option>");
                                            	}
                                        	</script>
                                        </select>天</label>
                                        <label style="width:20%;"><select name="hours"  style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var j=0;j<=23;j++){
                                        		if(j=='<?php echo $hours?>'){var ch="selected='selected'";}else{var ch='';}
                                            	document.write("<option "+ch+" value='"+j+"'>"+j+"</option>");
                                            	}
                                        	</script>
                                        </select>时</label>
                                        <label style="width:20%;"><select name="minute"  style="width:70%;margin-right:5px;">
                                        	<script>
                                        	for(var k=0;k<60;k+=5){
                                        		if(k=='<?php echo $minute?>'){var ch="selected='selected'";}else{var ch='';}
                                            	document.write("<option "+ch+" value='"+k+"'>"+k+"</option>");
                                            	}
                                        	</script>
                                        </select>分</label>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($item['status']){echo 'checked="checked"';}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                              
                                <input type="hidden" value="" id="judge" name="judge">
                                <input type="submit" value="提交" id="submit" class="btn btn-primary" style="margin-left: 45%"/>
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
	        $.post("<?php echo Yii::app()->createUrl("Systemsetting/getiso")?>",{iso:$a,id:$b},function(data){
	            if(data != 0){
	                var result = jQuery.parseJSON(data);
	                $(".iso input:text").val('');
	                $(".iso_name input:text").val(result['tel_name']);
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
        	title: {required:true,stringCheckAll:true},
            titles: {isEnglish:true},
            price:{required:true,isFloatGtZero:true},
        },
	    messages:{
			title:{
	            stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
			},
			titles:{
				isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符')?>",
			},
			price:{
				isFloatGtZero:"<?php echo yii::t('vcos', '只能大于0的浮点数')?>",
			}
		}
    });

    /**查看该名称是否已经存在**/
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
});
function checkTelItemName(){ 
    flag = 1;
    $id = "<?php echo $item['tel_id']?>";
    $name = $("input[name='title']").val();
    $name_iso = $("input[name='titles']").val();
	$url = "<?php echo Yii::app()->createUrl("Systemsetting/CheckTelItemName")?>";
	$.ajax({
		type:'post',
		data:'title='+$name+'&title_iso='+$name_iso+'&id='+$id,
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