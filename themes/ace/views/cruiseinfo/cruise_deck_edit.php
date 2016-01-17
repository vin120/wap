<?php
    $this->pageTitle = Yii::t('vcos','编辑甲板');
    $theme_url = Yii::app()->theme->baseUrl;
    
   // $menu_type = 'cruise_deck_add';
    $menu_type = 'cruise_deck_list';
?>
<!-- 甲板位置 -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/drag.css">
<link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/fengqing.css">

<?php if($cruise_model){?>
<style>
.mmimg1{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px 0px no-repeat;
    height:94px;}
.mmimg7{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -94px  no-repeat;
    height:19px;}
.mmimg6{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px  -112px no-repeat;
    height:24px;}
.mmimg5{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -135px  no-repeat;
    height:19px;}
.mmimg4{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -153px  no-repeat;
    height:20px;}
.mmimg3{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -172px  no-repeat;
    height:19px;}
.mmimg2{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -190px  no-repeat;
    height:19px;}
.mmimg8{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back'];?>) 0px -208px  no-repeat;
    height:75px;}


.mmimg7:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px 0px  no-repeat;
    height:19px;}
.mmimg6:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px  -18px no-repeat;
    height:24px;}
.mmimg5:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px -41px  no-repeat;
    height:19px;}
.mmimg4:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px -59px  no-repeat;
    height:20px;}
.mmimg3:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px -78px  no-repeat;
    height:19px;}
.mmimg2:hover{
    background:url(<?php echo Yii::app()->params['imgurl'].$cruise_model['img_back_over'];?>) 0px -96px  no-repeat;
    height:19px;}
</style>
<?php }?>
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
    if(in_array('183', $auth) || $auth[0] == '0'){
        $canadd = TRUE;
    }  else {
        $canadd = False;
    }
    if(in_array('185', $auth) || $auth[0] == '0'){
        $canedit = TRUE;
    }  else {
        $canedit = False;
    }
    if(in_array('187', $auth) || $auth[0] == '0'){
        $candelete = TRUE;
    }  else {
        $candelete = FALSE;
    }
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
                            <?php echo yii::t('vcos', '公共设施管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Cruiseinfo/cruise_deck_list")?>"><?php echo yii::t('vcos', '甲板列表 ')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑甲板')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <style>
                        .table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                        .table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                        .table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
                    </style>
                    <div class="table_switch"><span <?php if($current_page!=1){echo "class='myself_current'";}?> val='0'>基本信息</span><span val='1' <?php if($current_page==1){echo "class='myself_current'";}?>>甲板点介绍列表</span><span val='2' >甲板位置管理</span><span val='3' >预览</span></div>
                    
                    <div class="row <?php if($current_page==1){echo "hidden";}?>"  id="edit_line">
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
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '编辑外语')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="radio" class="iso_choose" check='no' name="language" value="en" />English
                                    </div>
                                </div>
                                <input type='hidden' id='deck_id' value="<?php echo $cruise_deck['deck_id']?>" />
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '甲板名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name" placeholder="<?php echo yii::t('vcos', '甲板名')?>" class="col-xs-10 col-sm-8 col-md-8" name="name" maxlength="30" value="<?php echo $cruise_deck_language['deck_name']?>"/>
                                        <?php echo $form->error($cruise_deck_language,'deck_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_name">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '甲板名').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="name_iso" placeholder="<?php echo yii::t('vcos', '甲板名').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="name_iso" maxlength="30" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '甲板层')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text"  id="layer" placeholder="<?php echo yii::t('vcos', '甲板层')?>"   class="col-xs-10 col-sm-8 col-md-8" name="layer" maxlength="2" value="<?php echo $cruise_deck['deck_layer'] ?>" />
                                        <?php echo $form->error($cruise_deck,'deck_layer'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($cruise_deck['deck_state']){echo 'checked="checked"';}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$cruise_deck_language['img_url'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo" id="photo"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group  hidden iso iso_img">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片').yii::t('vcos','(外语)')?>：</label>
                                    <img src="" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <input type="file" name="photo_iso" id="photo1"/>
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
                    <div class="row <?php if($current_page!=1){echo "hidden";}?>"  id="detail_list">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" name="del" action="<?php echo Yii::app()->createUrl('cruiseinfo/cruise_deck_point_list');?>"  class="detail_form">
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
                                                            <th><?php echo yii::t('vcos', '甲板名')?></th>
                                                            <th><?php echo yii::t('vcos', '甲板点名')?></th>
                                                            <th><?php echo yii::t('vcos', '描述')?></th>
                                                            <th><?php echo yii::t('vcos', '顺序')?></th>
                                                            <th><?php echo yii::t('vcos', '图片')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '内容')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cruise_deck_point as $key=>$row) { 
                                                            $msg = $row['deck_point_info'];
                                                            $img_ueditor_old = Yii::app()->params['img_ueditor_old'];
                                                            $count = preg_replace($img_ueditor_old,Yii::app()->params['img_ueditor'],$msg);
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['deck_point_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['deck_name'];?></td>
                                                            <td><?php echo $row['deck_point_name'];?></td>
                                                            <td><?php echo $row['deck_point_describe'];?></td>
                                                            <td><?php echo $row['deck_number'];?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['img_url'];?>" width="50"/></td>
                                                            <td><?php echo $row['deck_point_state']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td><?php echo Helper::truncate_utf8_string($count, 30);?></td>
                                                            <td>
                                                                <?php
                                                                    //操作挂件
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Cruiseinfo',
                                                                        'MethodName'=>'cruise_deck_point_edit',
                                                                        'id'=>$row['deck_point_id'],
                                                                        'canedit'=>$canedit,
                                                                        'candelete'=>$candelete,
                                                                    ));
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                </form>
                                                <div class="center">
                                                    <?php
                                                        //底部操作挂件
                                                        $this->widget('BotWidget',array(
                                                            'ControllerName'=>'Cruiseinfo',
                                                            'MethodName'=>'cruise_deck_point_add',
                                                            'canadd'=>$canadd,
                                                            'candelete'=>$candelete,
                                                        ));
                                                    ?>
                                                </div>
                                                <div class="center">
                                                    <?php
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
                                                </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            
                            <!-- 甲板位置管理 -->
                            <div class="row hidden"  id="location_list">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <div class="all">
                                                    <div id="dragleft">
                                                        <ul class="mainmenu">
                                                            <li><img class="mmimg1"/></li>
                                                            
                                                            <li><img class="mmimg7"/></li>
                                                            <ul id="ul6" class="submenu"></ul>
                                                            <li><img class="mmimg6"/></li>
                                                            <ul id="ul5" class="submenu"></ul>
                                                            <li><img class="mmimg5"/></li>
                                                            <ul id="ul4" class="submenu"></ul>
                                                            <li><img class="mmimg4"/></li>  
                                                            <ul id="ul3" class="submenu"></ul>
                                                            <li><img class="mmimg3"/></li>
                                                            <ul id="ul2" class="submenu"></ul>
                                                            <li><img class="mmimg2"/></li>  
                                                            <ul id="ul1" class="submenu"></ul>
                                                            
                                                            <li><img class="mmimg8"/></li>      
                                                        </ul>
                                                    </div>
                                                    <div id="dragright">
                                                        <ul>
                                                        <!-- <li><div class="dragdhk drag drag1" style="position: absolute;"><img src="images/11.png" title='aaa'/></div></li>   
                                                        <h4>咖啡厅</h4>
                                                        <li><div class="dragdhk drag drag2" style="position: absolute;"><img src="images/12.png"/></div></li>
                                                        <h4>咖啡厅</h4>
                                                        <li><div class="dragdhk drag drag3" style="position: absolute;"><img src="images/12.png"/></div></li>
                                                        <h4>咖啡厅</h4>
                                                        <li><div class="dragdhk drag drag4" style="position: absolute;"><img src="images/12.png"/></div></li>
                                                        <h4>咖啡厅</h4>
                                                        <li><div class="dragdhk drag drag5" style="position: absolute;"><img src="images/12.png"/></div></li>
                                                        <h4>咖啡厅</h4>-->
                                                        </ul>
                                                    </div> 
                                                    <div class="savadiv">
                                                    <button id="save" style="background:#6faed9;border:0px;margin-right:10px;width:50px;height:30px;line-heihgt:30px;">保存</button><button id="clear" style="width:50px;height:30px;line-heihgt:30px;background:#6faed9;border:0px;">清除</button>
                                                    </div>
                                                </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <!--甲板位置结束 -->
                            
                            
                            <!-- 甲板位置预览管理 -->
                            <div class="row hidden"  id="location_preview_list">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <div class="all">
                                                    <div id="dragleft">
                                                        <ul class="mainmenu">
                                                            <li><img class="mmimg1"/></li>
                                                            
                                                            <li><img class="mmimg7"/></li>
                                                            <ul id="ul6" class="submenu"></ul>
                                                            <li><img class="mmimg6"/></li>
                                                            <ul id="ul5" class="submenu"></ul>
                                                            <li><img class="mmimg5"/></li>
                                                            <ul id="ul4" class="submenu"></ul>
                                                            <li><img class="mmimg4"/></li>  
                                                            <ul id="ul3" class="submenu"></ul>
                                                            <li><img class="mmimg3"/></li>
                                                            <ul id="ul2" class="submenu"></ul>
                                                            <li><img class="mmimg2"/></li>  
                                                            <ul id="ul1" class="submenu"></ul>
                                                            
                                                            <li><img class="mmimg8"/></li>      
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <!--甲板位置预览结束 -->
                            
                            
                            
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
             <?php
                    //删除确认框
                    $this->widget('ConfirmWidget',array(
                        'div_id'=>'dialog-confirm',
                        'title_content'=>yii::t('vcos', '这条记录将被永久删除，并且无法恢复。'),
                    ));
                ?>
                <?php
                    //批量删除确认框
                    $this->widget('ConfirmWidget',array(
                        'div_id'=>'dialog-confirm-multi',
                        'title_id'=>'isempty1',
                        'title_content'=>yii::t('vcos', '这些选中的记录将被永久删除，并且无法恢复。'),
                        'confirm_id'=>'isempty2',
                    ));
                ?>
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

<!-- 甲板位置 -->
<script type="text/javascript" src="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/jquery.event.ue.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/jquery.udraggable.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/drag.js"></script><!--拖动插件-->
<script type="text/javascript" src="<?php echo $theme_url; ?>/assets/js/jQuery.udraggable/my.js"></script>


<script type="text/javascript">
jQuery(function($){

    $(".iso_choose").click(function(){
        $check = $(this).attr('check');
        if($check == 'no'){
            $(this).attr('check','yes');
            $a = $(this).val();
            $b = '<?php echo $_GET['id']?>';
            $img_url = '<?php echo Yii::app()->params['imgurl'];?>';
            $.post("<?php echo Yii::app()->createUrl("cruiseinfo/getiso_deck")?>",{iso:$a,id:$b},function(data){
                if(data != 0){
                    var result = jQuery.parseJSON(data);
                    $(".iso").removeClass('hidden'); 
                    $(".iso input:text").addClass('required');
                    $(".iso_name input:text").val(result['deck_name']);
                    $img_url = $img_url + result['img_url'];
                    $(".iso_img > img").attr('src',$img_url);
                    $("#judge").val(result['id']);
                }else{
                    $(".iso input:text").addClass('required');
                    $(".iso input:file").addClass('required');
                    $(".iso").removeClass('hidden');
                    $("#judge").val('add');
                }
            });
        }else if($check == 'yes'){
            $(this).attr('check','no');
            $(this).removeAttr('checked');
            $(".iso").addClass('hidden'); 
            $(".iso input:text").removeClass('required');
            $(".iso input:file").removeClass('required');
            $("#judge").val('');
        }
        
    });
    $("#edit").validate({
        rules: {
            name:{required:true,stringCheckAll:true},
            name_iso:{isEnglish:true},
            layer:{required:true,digits:true},
        },
        messages:{
            name:{
                    stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
            },
            name_iso:{
                isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符:')?>",
            }
        }
    });

    /**查看该港口名是否已经存在**/
    $('form.edit_form').submit(function(){
        var msg = checkDeck();
        if(msg == 0){
            alert('甲板名已存在!');
           return false;
        }
    });
    <?php
        $this->widget('UploadjsWidget',array('form_id'=>'edit'));
    ?>

    /**列表**/
    $('table th input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
    });
    $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
        _title: function(title) {
            var $title = this.options.title || '&nbsp;'
            if( ("title_html" in this.options) && this.options.title_html == true )
                title.html($title);
            else title.text($title);
        }
    }));
    $( ".delete" ).on('click', function(e) {
        var $a = $(this).attr("id");
        e.preventDefault();
        $( "#dialog-confirm" ).removeClass('hide').dialog({
            closeOnEscape:false, 
            open:function(event,ui){$(".ui-dialog-titlebar-close").hide();} ,
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '删除这条记录？')?></h4></div>",
            title_html: true,
            buttons: [
                {
                    html: "<i class='icon-trash bigger-110'></i>&nbsp; <?php echo yii::t('vcos', '删除？')?>",
                    "class" : "btn btn-danger btn-xs ",
                    click: function() {
                        location.href="<?php echo Yii::app()->createUrl("cruiseinfo/cruise_deck_point_list");?>"+"?id="+$a;
                        $( this ).dialog( "close" );
                    }
                }
                ,
                {
                    html: "<i class='icon-remove bigger-110'></i>&nbsp; <?php echo yii::t('vcos', '取消？')?>",
                    "class" : "btn btn-xs ",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
    });  
    $( "#detail_list #submit" ).on('click', function(e) {
        e.preventDefault();
        $( "#dialog-confirm-multi").removeClass('hide').dialog({
            closeOnEscape:false, 
            open:function(event,ui){$(".ui-dialog-titlebar-close").hide();} ,
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '删除选中的记录？')?></h4></div>",
            title_html: true,
            buttons: [
                {
                    html: "<i class='icon-trash bigger-110'></i>&nbsp; <?php echo yii::t('vcos', '删除？')?>",
                    "class" : "btn btn-danger btn-xs ",
                    "id" :"danger",
                    click: function() {
                        $("#detail_list form:first").submit();
                        $( this ).dialog( "close" );
                    }
                }
                ,
                {
                    html: "<i class='icon-remove bigger-110'></i>&nbsp; <?php echo yii::t('vcos', '取消？')?>",
                    "class" : "btn btn-xs ",
                    click: function() {
                        $('#danger').show();
                        $('.widget-header h4').html("<i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '删除选中的记录！')?>");
                        $('#isempty1').html("<?php echo yii::t('vcos', '这些选中的记录将被永久删除，并且无法恢复。')?>");
                        $('#isempty2').show();
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
        if(!$('.isclick').is(':checked')){
            $('#danger').hide();
            $('.widget-header h4').html("<i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '没有选中！')?>");
            $('#isempty1').html("<?php echo yii::t('vcos', '请选择删除项。')?>");
            $('#isempty2').hide();
        }
    });

    /**table切换**/
    $(".table_switch > span").click(function(){
        $(".table_switch > span").removeClass('myself_current');
        $(this).addClass('myself_current');
        if($(this).attr('val')==0){
            $("#edit_line").removeClass('hidden');
            $("#detail_list").addClass('hidden');
            $("#location_list").addClass("hidden");
            $("#location_preview_list").addClass("hidden");
        }else if($(this).attr('val')==1){
            $("#edit_line").addClass('hidden');
            $("#detail_list").removeClass('hidden');
            $("#location_list").addClass("hidden");
            $("#location_preview_list").addClass("hidden");
        }else if($(this).attr('val')==2){
            //当前甲板层
            $('#location_list .mainmenu >li').unbind("click");
            $deck = '<?php echo $cruise_deck['deck_id']?>';
            $deck_layer = '<?php echo $cruise_deck['deck_layer']?>';
            $deck_img = '<?php echo $cruise_deck_language['img_url']?>';
            $("#location_list #ul"+($deck_layer-1)).css("display","block");
            $("#location_list #ul"+($deck_layer-1)).css("background","url(<?php echo Yii::app()->params['imgurl'].$cruise_deck_language['img_url'];?>)");
            $("#location_list #ul"+($deck_layer-1)).css("background-size","100% 100%");
            
            var str = '';
            <?php foreach ($cruise_deck_point as $row){?>
                str += '<li><div class="dragdhk drag drag<?php echo $row['deck_point_id']?>" l_id="<?php echo $row['deck_point_id']?>" style="position: absolute;"><img title="<?php echo $row['deck_point_name']?>" src="<?php echo Yii::app()->params['imgurl'].$row['img_url'];?>"/></div></li>';   
                str += '<h4><?php echo $row['deck_point_name']?></h4>';
            <?php }?>
            $("#location_list #dragright > ul").html(str);
            //获取已经设置好的甲板层平面图
            $url = "<?php echo Yii::app()->createUrl("Cruiseinfo/DeckGetDeckAll")?>";
            var str_str = '';
            $.ajax({
                type:'get',
                data:'deck='+$deck,
                url:$url,
                dataType:'json',
                async: false,
                success:function(data){
                    if(data!=0){
                        $.each(data,function(key){
                        str_str += '<li id="ul'+($deck_layer-1)+'li'+parseInt(key+1)+'" class="block" style="left: '+data[key]['location_x']+'px; top: '+data[key]['location_y']+'px;">';
                        str_str += '<div class="dragdhk drag drag'+data[key]['deck_point_id']+'" style="position: absolute;" l_id="'+data[key]['deck_point_id']+'">';
                        str_str += '<img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['img_url']+'" title="'+data[key]['deck_point_name']+'" style="height: 50px; width: 50px;">';
                        str_str += '</div>';
                        str_str += '</li>';
                        });
                    }
                    $("#location_list #ul"+($deck_layer-1)).html(str_str);
                    
                }
            });
            
            $("#edit_line").addClass('hidden');
            $("#detail_list").addClass('hidden');
            $("#location_list").removeClass("hidden");
            $("#location_preview_list").addClass("hidden");
        }else if($(this).attr('val')==3){
            $url = "<?php echo Yii::app()->createUrl("Cruiseinfo/DeckPreviewGetDeckAll")?>";
           $.ajax({
                type:'get',
                url:$url,
                async: false,
                dataType:'json',
                success:function(data){
                    if(data!=0){
                        $.each(data,function(k){
                            $("#location_preview_list #ul"+(data[k]['deck_layer']-1)).css("background","url(<?php echo Yii::app()->params['imgurl'];?>"+data[k]['img_url']+")");
                            $("#location_preview_list #ul"+(data[k]['deck_layer']-1)).css("background-size","100% 100%");
                            if(data[k]['child']){
                                str_str = '';
                                $.each(data[k]['child'],function(key){
                                    str_str += '<li id="ul'+(data[k]['deck_layer']-1)+'li1" class="block" style="left: '+data[k]['child'][key]['location_x']+'px; top: '+data[k]['child'][key]['location_y']+'px;">';
                                    str_str += '<div class="dragdhk drag drag'+data[k]['child'][key]['deck_point_id']+'" style="position: absolute;" l_id="'+data[k]['child'][key]['deck_point_id']+'">';
                                    str_str += '<img src="<?php echo Yii::app()->params['imgurl'];?>'+data[k]['child'][key]['img_url']+'" title="'+data[k]['child'][key]['deck_point_name']+'" style="height: 50px; width: 50px;">';
                                    str_str += '</div>';
                                    str_str += '</li>';
                                });
                                $("#location_preview_list #ul"+(data[k]['deck_layer']-1)).html(str_str);
                                
                             }
                        });
                    }
                }
            });
                 
            $("#edit_line").addClass('hidden');
            $("#detail_list").addClass('hidden');
            $("#location_list").addClass("hidden");
            $("#location_preview_list").removeClass("hidden");
        }
    });



    //甲板位置保存
    $("body").on("click","#location_list #save",function(){
        if($.trim(position)==''){alert("未设置甲板点位置!");return false;}
        $deck = '<?php echo $cruise_deck['deck_id']?>';
        $url = "<?php echo Yii::app()->createUrl("Cruiseinfo/KeepDeckPointLocation")?>";
       $.ajax({
            type:'post',
            data:'deck='+$deck+'&location='+position,
            url:$url,
            async: false,
            success:function(data){
                //执行完保存，清除position
                position = '';
                if(data==0){alert("保存失败!");return false;}
                else alert("保存成功!");
            }
        });

        
    });

  //甲板点击清除按钮，把存储的数据清空   
    $("body").on("click","#location_list #clear",function(){
        $deck_layer = '<?php echo $cruise_deck['deck_layer']?>';
        $deck_layer = 'ul'+($deck_layer-1);
        //获取甲板id,删除`vcos_cruise_deck_location`删除甲板位置    
        var liSize=$("#location_list #dragleft ul ul[id='"+$deck_layer+"'] li").length;
        if(liSize==0){return false;}
        $deck = '<?php echo $cruise_deck['deck_id']?>';
        $url = "<?php echo Yii::app()->createUrl("Cruiseinfo/ClearDeckPointLocation")?>";
        $.ajax({
            type:'get',
            data:'deck='+$deck,
            url:$url,
            async: false,
        });
      localStorage.clear();
        //$("#pinner").html("");    
        $("#location_list ul ul").html("");
    })


    //甲板预览点击甲板层时
    /*$("#location_preview_list .mainmenu >li").click(function(){
        var this_layer = $(this).find('img').attr('class');
        //mmimg6（截取字符串）
        this_layer = this_layer.substring(5,this_layer.length);
        
        //获取已经设置好的甲板层平面图
        $url = "<php echo Yii::app()->createUrl("Cruiseinfo/DeckGetDeckAll")?>";
        var str_str = '';
        $.ajax({
            type:'get',
            data:'layer='+this_layer,
            url:$url,
            dataType:'json',
            async: false,
            success:function(data){
                var str_str = '';
                if(data!=0){
                    $.each(data,function(key){
                    str_str += '<li id="ul'+(this_layer-1)+'li1" class="block" style="left: '+data[key]['location_x']+'px; top: '+data[key]['location_y']+'px;">';
                    str_str += '<div class="dragdhk drag drag'+data[key]['deck_point_id']+'" style="position: absolute;" l_id="'+data[key]['deck_point_id']+'">';
                    str_str += '<img src="<php echo Yii::app()->params['imgurl'];?>'+data[key]['img_url']+'" title="'+data[key]['deck_point_name']+'" style="height: 50px; width: 50px;">';
                    str_str += '</div>';
                    str_str += '</li>';
                    });
                }
                $("#location_preview_list #ul"+(this_layer-1)).html(str_str);
                
            }
        });
    });*/

    
});
function checkDeck(){
    flag = 1;
    $service_name = $("input[name='name']").val();
    $this_id = $("input[id='deck_id']").val();
    $url = "<?php echo Yii::app()->createUrl("Cruiseinfo/DeckGetAgain")?>";
    $.ajax({
        type:'post',
        data:'title='+$service_name+'&this_id='+$this_id,
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
