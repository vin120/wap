<?php
    $this->pageTitle = Yii::t('vcos','编辑电话服务');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'telephone_service_add';
    $menu_type = 'telephone_service_list';
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
                            <?php echo yii::t('vcos', '网络通信管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Systemsetting/telephone_service_list")?>"><?php echo yii::t('vcos', '电话服务列表')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑电话服务')?>
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
                                    'id'=>'edit',
                                    'role'=>'form',
                                )
                            ));  
                            ?> 
                               <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '卡号')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text"  id="code" placeholder="<?php echo yii::t('vcos', '卡号')?>"  class="col-xs-10 col-sm-8 col-md-8" name="code" value="<?php echo $code['sn_code'];?>" maxlength="32" />
                                        <?php echo $form->error($code,'sn_code'); ?> 
                                    </div>               
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '卡密')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<input type="text"  id="pass" placeholder="<?php echo yii::t('vcos', '卡密')?>"  class="col-xs-10 col-sm-8 col-md-8" name="pass" value="<?php echo $code['sn_password']?>" maxlength="32" />
                                        <?php echo $form->error($code,'sn_password'); ?> 
                                    </div>               
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '有效开始时间')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text"  id="stime" placeholder="<?php echo yii::t('vcos', '有效开始时间')?>" readonly='readonly' value="<?php echo substr($code['start_time'],0,-3)?>" class="datetimepicker_s col-xs-10 col-sm-8 col-md-8" name="stime" maxlength="80" />
                                        <?php echo $form->error($code,'start_time'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '有效结束时间')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="etime" placeholder="<?php echo yii::t('vcos', '有效结束时间')?>" readonly='readonly' value="<?php echo substr($code['end_time'],0,-3)?>" class="datetimepicker_e col-xs-10 col-sm-8 col-md-8" name="etime" maxlength="80" />
                                        <?php echo $form->error($code,'end_time'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '服务类型')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <select id='tel_cat' name='tel_cat' class="col-xs-10 col-sm-8 col-md-8">
                                        <?php if($tel_item!=''){ 
                                        	function time2second($seconds){
                                        		$seconds = (int)$seconds;
                                        		if( $seconds<86400 ){//如果不到一天
                                        			$format_time = gmstrftime('0天%H时%M分', $seconds);
                                        		}else{
                                        			$time = explode(' ', gmstrftime('%j %H %M %S', $seconds));//Array ( [0] => 04 [1] => 14 [2] => 14 [3] => 35 )
                                        			$format_time = ($time[0]-1).'天'.$time[1].'时'.$time[2].'分';
                                        		}
                                        		return $format_time;
                                        	}
                                        	foreach($tel_item as $row){?>
                                        	<?php if($row['tel_id']==$code['tel_id']){$ch="selected='selected'";$time=time2second($row['tel_time']);$price=$row['sale_price'];}else{$ch='';}?>
                                        	<option value='<?php echo $row['tel_id']?>' <?php echo $ch;?>><?php echo $row['tel_name']?></option>
                                        <?php }}?>
                                        </select>
                                        <?php echo $form->error($code,'tel_id'); ?> 
                                    </div>
                                    
                                    <div class="code_pass_val col-xs-8 col-sm-8 col-md-7" style="margin-left:16.6666%;margin-top:5px;">
                                    <?php if(isset($time)){?>
                                   	 <label style="margin-right: 10px;">时间：<?php echo $time;?></label><label>金额：<?php echo $price;?></label>
                                   	 <?php }?>
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
<script src="<?php echo $theme_url; ?>/assets/js/jqPaginator.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/uncompressed/additional-methods.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ueditor.config.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ueditor.all.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	$('.datetimepicker_s').datetimepicker({step:1});
	$('.datetimepicker_e').datetimepicker({step:1});

	$("select[id='tel_cat']").change(function(){
		var id = $(this).val();
		<?php foreach($tel_item as $row){?>
		if(id=='<?php echo $row['tel_id']?>'){
			<?php $time = time2second($row['tel_time']);?>
			var time = '<?php echo $time?>';
			var price = '<?php echo $row['sale_price']/100?>';
			}
		<?php }?>
		$(".code_pass_val").find("label:eq(0)").html("时间："+time);
		$(".code_pass_val").find("label:eq(1)").html("金额："+price);
	});

    $('form').submit(function(){
        
    	var flag = 1;
        var code = $("input[name='code']").val();
        var pass = $("input[name='pass']").val();
        var id = <?php echo $code['id']?>;
        var stime =  $("input[name='stime']").val();
        var etime = $("input[name='etime']").val();
        if($.trim(code)==''||$.trim(pass)==''){return false;}
        if($.trim(stime)=='' || $.trim(etime)==''){alert("请选择开始时间和结束时间!");return false;}
        if($.trim(stime)>$.trim(etime)){alert("结束时间必须大于开始时间!");return false;}
        
        var msg = checkCodePass(code,pass,id);
        if(msg==1){
            alert("卡号和卡密都已经存在,请更换!");return false;
        }else if(msg==2){
            alert("卡号已存在，请更换!");return false;
        }else if(msg==3){
            alert("卡密已存在，请更换!");return false;
        }
    });
    $("#edit").validate({
    	rules: {
        	code: {required:true,isEnglishNum:true},
        	pass: {required:true,isEnglishNum:true},
        	stime:{required:true},
        	etime:{required:true},
        	
        },
    });
});
function checkCodePass(code,pass,id){
    var flag = 1;
	$url = "<?php echo Yii::app()->createUrl("Systemsetting/CheckCodePass")?>";
	$.ajax({
		type:'post',
		data:'code='+code+'&pass='+pass+'&id='+id,
		url:$url,
		async: false,
		success:function(data){
		    flag = data;
		}
	});
	return flag;
}
</script>
<style>
 input[readonly]{background:#fff !important;}
</style>