<?php
    $this->pageTitle = Yii::t('vcos','编辑目的地城市');
    $theme_url = Yii::app()->theme->baseUrl;
    
    //$menu_type = 'port_add';
    $menu_type = 'port';
?>
<?php 
    //navbar 挂件
    $disable = 1;
    $this->widget('navbarWidget',array('disable'=>$disable));
    //$this->widget('navbarWidget');
    if(in_array('123', $auth) || $auth[0] == '0'){
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
                            <?php echo yii::t('vcos', '目的地管理')?>
                            <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Cruiseinfo/port")?>"><?php echo yii::t('vcos', '目的地列表 ')?></a>
                            </small>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '编辑目的地城市')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <style>
                        .table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                        .table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                        .table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
                    </style>
                    <div class="table_switch"><span <?php if($current_page!=1){echo "class='myself_current'";}?>  val='0'>基本信息</span><span val='1' <?php if($current_page==1){echo "class='myself_current'";}?>>目的地城市介绍列表</span></div>
                    
                    <div class="row <?php if($current_page==1){echo "hidden";}?>" id="edit_port">
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
                                        <input type="radio" check='no' class="iso_choose" name="language" value="en" />English
                                    </div>
                                </div>
                                <input type='hidden' id='port_id' value="<?php echo $port['port_id']?>"/>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '港口名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles" placeholder="<?php echo yii::t('vcos', '港口名')?>" class="col-xs-10 col-sm-8 col-md-8" name="title" maxlength="80" value="<?php echo $port_language['port_name'];?>" />
                                        <?php echo $form->error($port_language,'port_name'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_title">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '港口名').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="titles2" placeholder="<?php echo yii::t('vcos', '港口名').yii::t('vcos','(外语)')?>" class="col-xs-10 col-sm-8 col-md-8" name="title_iso" maxlength="80" value="" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '描述')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <textarea id="desc" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '描述')?>" name="desc" maxlength=80><?php echo $port_language['describe'];?></textarea>
                                        <?php echo $form->error($port_language,'describe'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group hidden iso iso_desc">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '描述').yii::t('vcos','(外语)')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    <textarea id="desc2" style=" overflow:auto; width: 66.6666%;height: 60px;resize: none;" placeholder="<?php echo yii::t('vcos', '描述').yii::t('vcos','(外语)')?>" name="desc_iso" maxlength=80></textarea>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '状态')?>：</label>
                                    <label style="margin-left: 10px;">
                                        <input id="id-button-borders" type="checkbox" <?php if($port['port_state']){echo 'checked="checked"';}?> class="ace ace-switch ace-switch-5" name="state" value="1" />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '图片')?>：</label>
                                    <img src="<?php echo Yii::app()->params['imgurl'].$port_language['img_url'];?>" class="col-xs-3 col-sm-3 col-md-3" title="<?php echo yii::t('vcos', '原图片')?>" />
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
                                <input type="submit" value="<?php echo yii::t('vcos', '提交')?>" id="submit" class="btn btn-primary" style="margin-left: 45%"/>
                            <?php  
                                $this->endWidget();  
                            ?> 
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                    
                    <div class="row <?php if($current_page!=1){echo "hidden";}?>" id="detail_list">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" action="<?php echo Yii::app()->createUrl('Cruiseinfo/port_detail_list');?>" name="del" class="detail_form">
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
                                                            <th><?php echo yii::t('vcos', '目的地名称')?></th>
                                                            <th><?php echo yii::t('vcos', '目的地图片')?></th>
                                                            <th><?php echo yii::t('vcos', '目的地简介')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detail as $key=>$row) { 
                                                            $msg = $row['detail'];
                                                            $img_ueditor_old = Yii::app()->params['img_ueditor_old'];
                                                            $count = preg_replace($img_ueditor_old,Yii::app()->params['img_ueditor'],$msg);
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['detail_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['port_name'];?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['detail_img_url'];?>" width="50"/></td>
                                                            <td><?php echo Helper::truncate_utf8_string($count, 30);?></td>
                                                            <td><?php echo $row['detail_state']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td>
                                                                <?php
                                                                    //操作挂件
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Cruiseinfo',
                                                                        'MethodName'=>'port_detail_edit',
                                                                        'id'=>$row['detail_id'],
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
                                                            'MethodName'=>'port_detail_add',
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>

<script type="text/javascript">
jQuery(function($){  
    $(".iso_choose").click(function(){
        $check = $(this).attr('check');
        if($check == 'no'){
            $(this).attr('check','yes');
            $a = $(this).val();
            $b = '<?php echo $_GET['id']?>';
            $img_url = '<?php echo Yii::app()->params['imgurl'];?>';
            $.post("<?php echo Yii::app()->createUrl("cruiseinfo/getiso_port")?>",{iso:$a,id:$b},function(data){
                if(data != 0){
                    var result = jQuery.parseJSON(data);
                    $(".iso input:text").val('');
                    $(".iso textarea").html('');
                    $(".iso_title input:text").val(result['port_name']);
                    $(".iso").removeClass('hidden'); 
                    $(".iso input:text").addClass('required');
                    $img_url = $img_url + result['img_url'];
                    $(".iso_img > img").attr('src',$img_url);
                    $(".iso_desc textarea").html(result['describe']);
                    $("#judge").val(result['id']);
                }else{
                    $(".iso").removeClass('hidden');
                    $(".iso input:text").addClass('required');
                    $(".iso input:file").addClass('required');
                    $(".iso textarea").addClass('required');
                    $("#judge").val('add');
                }
            });
        }else if($check == 'yes'){
            $(this).attr('check','no');
            $(this).removeAttr('checked');
            $(".iso").addClass('hidden'); 
            $(".iso input:text").removeClass('required');
            $(".iso input:file").removeClass('required');
            $(".iso textarea").removeClass('required');
            $("#judge").val();
        }
        
    });
    
    $("#edit").validate({
        rules: {
            title: {required:true,stringCheckAll:true},
            desc:{required:true},
            title_iso: {isEnglish:true},
            desc_iso:{isEnglish:true},
        },
        messages:{
            title:{
                stringCheckAll: "<?php echo yii::t('vcos', '只能包含中文、英文、数字、下划线、逗号、句号等字符')?>",
            },
            title_iso:{
                isEnglish: "<?php echo yii::t('vcos', '只能包含英文字符:')?>",
            },
            
        }
    });

    /**查看该港口名是否已经存在**/
    $('form.edit_form').submit(function(){
        var msg = checkPort();
        if(msg == 0){
            alert('港口已存在!');
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
                            location.href="<?php echo Yii::app()->createUrl("Cruiseinfo/port_detail_list");?>"+"?id="+$a;
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
            $("#edit_port").removeClass('hidden');
            $("#detail_list").addClass('hidden');
        }else if($(this).attr('val')==1){
            $("#edit_port").addClass('hidden');
            $("#detail_list").removeClass('hidden');
        }
    });
});

function checkPort(){
    flag = 1;
    $port_name = $("input[name='title']").val();
    $this_id = $("input[id='port_id']").val();
    $url = "<?php echo Yii::app()->createUrl("cruiseinfo/PortNamegetAgain")?>";
    $.ajax({
        type:'post',
        data:'title='+$port_name+'&this_id='+$this_id,
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