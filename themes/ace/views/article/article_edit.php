<?php
    $this->pageTitle = Yii::t('vcos','编辑动态');
    $this->pageTag = 'index';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'article_add';
    $menu_type = 'article_list';
?>
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
?>
<link rel="stylesheet"  href="<?php echo $theme_url; ?>/assets/css/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>/assets/css/bootstrap-timepicker.css" />
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
                            <?php echo yii::t('vcos', '邮轮动态管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Article/article_list")?>"><?php echo yii::t('vcos', '邮轮动态列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑动态')?>
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
                                    'enctype'=>'multipart/form-data',
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
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '标题')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles" placeholder="<?php echo yii::t('vcos', '标题')?>" class="col-xs-10 col-sm-8 col-md-8" name="title" maxlength="80" value="<?php echo $article_language['article_title'];?>" />
                                        <?php echo $form->error($article_language,'article_title'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_title">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '标题').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles_iso" placeholder="<?php echo yii::t('vcos', '标题').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="title_iso" maxlength="80" value=""/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($article['article_state']){echo 'checked="checked"';}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '简介')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="abstract" class="col-xs-10 col-sm-8 col-md-8" name="abstract" maxlength="80" value="<?php echo $article_language['article_abstract'];?>"/>
                                        <?php echo $form->error($article_language,'article_abstract'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_abstract">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '简介').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="abstract_iso" class="col-xs-10 col-sm-8 col-md-8" name="abstract_iso" maxlength="80" placeholder="<?php echo yii::t('vcos', '简介').yii::t('vcos','(外语)')?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '有效日期')?>：</label>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control" type="text" name="time" id="time" value="<?php echo substr($article['article_start_time'],0,10).' - '.substr($article['article_end_time'],0,10)?>" data-rel="tooltip" title="开始时间为当天00:00:00,结束时间为当天23:59:59" data-placement="bottom"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $form->error($article,'article_start_time'); ?> 
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '开始时间')?>：</label>
                                    <div class="col-xs-5 col-sm-5 col-md-5 input-group bootstrap-timepicker">
                                        <input id="stime" name="stime" type="text" class="form-control col-xs-8 col-sm-8 col-md-8" maxlength="100" placeholder="<?php echo yii::t('vcos', '开始时间')?>" value="<?php echo substr($article['article_start_time'],11,-1)?>"/>
                                        <span class="input-group-addon">
                                            <i class="icon-time bigger-110"></i>
                                        </span>
                                    </div>
                                    <?php echo $form->error($article,'article_start_time'); ?> 
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '结束时间')?>：</label>
                                    <div class="col-xs-5 col-sm-5 col-md-5 input-group bootstrap-timepicker">
                                        <input id="etime" name="etime" type="text" class="form-control col-xs-6 col-sm-6 col-md-6" maxlength="100" placeholder="<?php echo yii::t('vcos', '结束时间')?>" value="<?php echo substr($article['article_end_time'],11,-1)?>"/>
                                        <span class="input-group-addon">
                                            <i class="icon-time bigger-110"></i>
                                        </span>
                                    </div>
                                    <?php echo $form->error($article,'article_start_time'); ?> 
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$article['article_img_url'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo" id="photo"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '内容')?>：</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                    	<?php 
		                                $msg = $article_language['article_content'];
		                                $img_ueditor_old = Yii::app()->params['img_ueditor_old'];
		                                $count = preg_replace($img_ueditor_old,Yii::app()->params['img_ueditor'],$msg);
		                                ?>
                                        <textarea id="contents" name="contents"><?php echo $count?></textarea>
                                        <font style="display: none"><?php echo yii::t('vcos', '请输入内容')?></font>
                                    </div>
                                    <?php echo $form->error($article_language,'article_content'); ?> 
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_content">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '内容').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <textarea id="contents2" name="contents_iso"></textarea>
                                        <font style="display: none"><?php echo yii::t('vcos', '请输入内容').yii::t('vcos','(外语)')?></font>
                                    </div>
                                </div>
                                <div class="space-4"></div>
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
<script src="<?php echo $theme_url; ?>/assets/js/ueditor.config.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ueditor.all.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/moment.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/daterangepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
jQuery(function($){
    <?php
        $this->widget('UploadjsWidget',array('form_id'=>'edit'));
    ?>
    
    UE.getEditor('contents');
    
    $(".iso_choose").click(function(){
    	$check = $(this).attr('check');
        if($check == 'no'){
            $(this).attr('check','yes');
	        $a = $(this).val();
	        $b = '<?php echo $_GET['id']?>';
	        $ueditor_url = "<?php echo Yii::app()->params['img_ueditor'];?>";
	        $img_ueditor_old = <?php echo Yii::app()->params['img_ueditor_old_js'];?>;
	        $.post("<?php echo Yii::app()->createUrl("article/getiso")?>",{iso:$a,id:$b},function(data){
	            if(data != 0){
	                var result = jQuery.parseJSON(data);
	                $(".iso input:text").val('');
	                $(".iso textarea").html('');
	                $(".iso_title input:text").val(result['article_title']);
	                $(".iso_abstract input:text").val(result['article_abstract']);
	                var msg = result['article_content'];
	                var reg = $img_ueditor_old;
	                msg= msg.replace(reg,$ueditor_url);
	                $(".iso_content textarea").html(msg);
	                UE.getEditor('contents2');
	                $(".iso").removeClass('hidden'); 
	                $(".iso input:text").addClass('required');
	                $("#judge").val(result['id']);
	            }else{
	                $(".iso").removeClass('hidden');
	                $(".iso input:text").addClass('required');
	                $("#judge").val('add');
	                UE.getEditor('contents2');
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
    
    $('form').submit(function(){
        var a = 1;
        if($('#contents').next().val()==''){
            $('#contents').next().next().show();
            a = 0;
        }
        if(!$(".iso_content").hasClass("hidden")){
            if($('#contents2').next().val()==''){
                $('#contents2').next().next().show();
                a = 0;
            }
        }
        var date = $("#time").val();
        date = date.split(' - ');
        if(date[0] == date[1]){
           //日期为同一天需判断结束时间不能大于开始时间
            var stime = $("#stime").val();
            var etime = $("#etime").val();
            if(stime > etime){
                alert("<?php echo Yii::t('vcos','请输入正确的结束时间');?>");
                a = 0;
            }
        }
     
       if(a == 0){
           return false;
       }
    });
    
    $("#edit").validate({
        rules: {
            title: {required:true,stringCheckAll:true},
            title_iso: {isEnglish:true},
            abstract:{required:true,stringCheckAll:true},
            abstract_iso:{isEnglish:true},
            stime:"required",
        },
        message: {
            title:{
	            stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
			},
			abstract:{
		            stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
	    	},
	    	title_iso:{
	    		isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符')?>",
    		},
    		abstract_iso:{
    			isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符')?>",
    		}
        }
    });
    
    $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });
    $('#time').daterangepicker({
        dateFormat:'yy-mm-dd'
    });
    $('#stime').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false
	}).next().on(ace.click_event, function(){
	        $(this).prev().focus();
	});
	$('#etime').timepicker({
	        minuteStep: 1,
	        showSeconds: true,
	        showMeridian: false
	}).next().on(ace.click_event, function(){
	        $(this).prev().focus();
	});

	/*jQuery.validator.addMethod("etime", function(value, element) {   
		var assigntime = $("#stime").val();
	    var deadlinetime = $("#etime").val();
	    var reg = new RegExp(':','g');
	    assigntime = assigntime.replace(reg,'/');//正则替换
	    deadlinetime = deadlinetime.replace(reg,'/');
	    assigntime = new Date(parseInt(Date.parse(assigntime),10));
	    deadlinetime = new Date(parseInt(Date.parse(deadlinetime),10));
	  
	    if(assigntime>deadlinetime){
	        return false;
	    }else{
	        return true;
	    }
}, "<php echo Yii::t('vcos','请输入正确的结束时间');?>");*/

	
});
</script>