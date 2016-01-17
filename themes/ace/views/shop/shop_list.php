<?php
    $this->pageTitle = Yii::t('vcos','店铺列表');
    $theme_url = Yii::app()->theme->baseUrl;
    $menu_type = 'shop_list';
?>
<?php 
    //navbar 挂件
    $this->widget('navbarWidget');
    if(in_array('339', $auth) || $auth[0] == '0'){
        $canadd = TRUE;
    }  else {
        $canadd = False;
    }
    if(in_array('340', $auth) || $auth[0] == '0'){
        $canedit = TRUE;
    }  else {
        $canedit = False;
    }
    if(in_array('341', $auth) || $auth[0] == '0'){
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
                                <?php echo yii::t('vcos', '店铺管理')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '店铺列表')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <style>
                    	.table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                    	.table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                    	.table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
	                    </style>
	                    <input type='hidden' id='no_page' value="<?php echo $no_page;?>" />
	                    <input type='hidden' id='already_page' value="<?php echo $already_page;?>" />
	                    <!-- 未删除 -->
	                    <div class="table_switch"><span class='myself_current' val='0'>未删除</span><span val='1'>已删除</span></div>
                            <div class="row" id="no_delete_div">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" action="">
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
                                                            <th><?php echo yii::t('vcos', '店铺编码')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺名称')?></th>
                                                            <th width='20%'><?php echo yii::t('vcos', '店铺描述')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺法人')?></th>
                                                            <th><?php echo yii::t('vcos', '公司名')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺LOGO')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($shop as $key=>$row) { ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['shop_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['shop_code'];?></td>
                                                            <td><?php echo $row['shop_title'];?></td>
                                                            <td><?php echo Helper::truncate_utf8_string($row['shop_desc'], 20);?></td>
                                                            <td><?php echo $row['legal_representative'];?></td>
                                                            <td><?php echo $row['company_name'];?></td>
                                                            <td><?php echo $row['shop_status']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['shop_logo'];?>" width="50" height="50"></td>
                                                           
                                                            <td>
                                                                <?php
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Shop',
                                                                        'MethodName'=>'shop_edit',
                                                                        'id'=>$row['shop_id'],
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
                                                            'ControllerName'=>'Shop',
                                                            'MethodName'=>'shop_add',
                                                            'canadd'=>$canadd,
                                                            'candelete'=>$candelete,
                                                        ));
                                                    ?>
                                                </div>
                                                <!-- 未删除分页 -->
                                                <div class="center" id="page_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            
                            <!-- 已经删除 -->
                            <div class="row hidden" id="already_delete_div">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" action="">
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
                                                            <th><?php echo yii::t('vcos', '店铺编码')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺名称')?></th>
                                                            <th width='20%'><?php echo yii::t('vcos', '店铺描述')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺法人')?></th>
                                                            <th><?php echo yii::t('vcos', '公司名')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '店铺LOGO')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($already_shop as $key=>$row) { ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['shop_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['shop_code'];?></td>
                                                            <td><?php echo $row['shop_title'];?></td>
                                                            <td><?php echo Helper::truncate_utf8_string($row['shop_desc'], 20);?></td>
                                                            <td><?php echo $row['legal_representative'];?></td>
                                                            <td><?php echo $row['company_name'];?></td>
                                                            <td><?php echo $row['shop_status']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['shop_logo'];?>" width="50" height="50"></td>
                                                            
                                                            <td>
                                                                <?php
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Shop',
                                                                        'MethodName'=>'shop_edit',
                                                                        'id'=>$row['shop_id'],
                                                                        'canedit'=>$canedit,
                                                                        //'candelete'=>$candelete,
                                                                    ));
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                </form>
                                                <div class="center">
                                                <button id="remove_del" class="btn btn-xs btn-warning">
												<span class="bigger-110 no-text-shadow">恢复选中</span>
												</button>
                                                    <?php
                                                        //底部操作挂件
                                                        $this->widget('BotWidget',array(
                                                            'ControllerName'=>'Shop',
                                                            'MethodName'=>'shop_add',
                                                            'canadd'=>$canadd,
                                                        ));
                                                    ?>
                                                </div>
                                                 <!-- 已删除分页  -->
                                                <div class="center" id="page_already_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            
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
                <!-- /#ace-settings-container start-->
                <?php
                    //设置容器配置挂件
                    $this->widget('settingsContainerWidget');
                ?>
                <!-- /#ace-settings-container end-->
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
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#no_delete_div table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
        $('#already_delete_div table th input:checkbox').on('click' , function(){
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
        //$( ".delete" ).on('click', function(e) {
        $(document).on('click','.delete',function(e){
            var $a = $(this).attr("id");
            e.preventDefault();
            $( "#dialog-confirm" ).removeClass('hide').dialog({
                resizable: false,
                modal: true,
                title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '删除这条记录？')?></h4></div>",
                title_html: true,
                buttons: [
                    {
                        html: "<i class='icon-trash bigger-110'></i>&nbsp; <?php echo yii::t('vcos', '删除？')?>",
                        "class" : "btn btn-danger btn-xs ",
                        click: function() {
                        	var res = CheckPass();
                            if(res == 1){
                            	location.href="<?php echo Yii::app()->createUrl("Shop/shop_list");?>"+"?id="+$a;
                            }else if(res == 0){
                                alert('输入密码有误!');
                            }
                            //location.href="<?php echo Yii::app()->createUrl("Shop/shop_list");?>"+"?id="+$a;
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
         
        $( "#submit" ).on('click', function(e) {
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
                        	var res = CheckPass();
                            if(res == 1){
                            	$("form:first").submit();
                            }else if(res == 0){
                                alert('输入密码有误!');
                            }
                            //$("form:first").submit();
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
                            $('#isempty1').html("<?php echo yii::t('vcos', '这些选中的记录将被永久删除，及关联的其它记录，并且无法恢复。')?>");
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

        /**未删除分页**/
        <?php if($count >1){?>
    	$('#page_div').jqPaginator({
    	    totalPages: <?php echo $count;?>,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
        	    var no_page = $("#no_page").val();
        	    if(no_page == num){$("#no_page").val('fail');return false;}
    	    	<?php $path_url = Yii::app()->createUrl('Shop/GetShopPage');?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:'act=1&pag='+num,
                 	dataType:'json',
                	success:function(data){
                    	var str = '';
                		if(data != 0){
        	                $.each(data,function(key){
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['shop_id']+'" class="ace isclick" />';    
                                str += '<span class="lbl"></span></label></td>';
                                var k = parseInt(key)+1;        
                                str += '<td>'+k+'</td>';        
                                str += '<td>'+data[key]['shop_code']+'</td>';   
                                str += '<td>'+data[key]['shop_title']+'</td>';
                                str += '<td>'+data[key]['shop_desc']+'</td>';
                                str += '<td>'+data[key]['legal_representative']+'</td>';
                                str += '<td>'+data[key]['company_name']+'</td>';
                                if(data[key]['shop_status']==1){var status="启用";}else{var status="禁用";}
                                str += '<td>'+status+'</td>';
                                str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['shop_logo']+'" width="50" height="50"></td>';
                                str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Shop/shop_edit")?>?id='+data[key]['shop_id']+'"><i class="icon-edit bigger-120"></i></a><a id="'+data[key]['shop_id']+'" class="btn btn-xs btn-warning delete" title="删除" href="#"><i class="icon-trash bigger-120"></i></a></div></td></tr>';
                                str += '</tr>';
                            });
        	            }
                		$("#no_delete_div table>tbody").html(str);
                	}      
                });
    	    }
    	});
		<?php }?>

		/**已删除分页**/
        <?php if($already_count >1){?>
    	$('#page_already_div').jqPaginator({
    	    totalPages: <?php echo $already_count;?>,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var already_page = $("#already_page").val();
        	    if(already_page == num){$("#already_page").val('fail');return false;}
    	    	<?php $path_url = Yii::app()->createUrl('Shop/GetShopPage');?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:'act=2&pag='+num,
                 	dataType:'json',
                	success:function(data){
                    	var str = '';
                		if(data != 0){
        	                $.each(data,function(key){
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['shop_id']+'" class="ace isclick" />';    
                                str += '<span class="lbl"></span></label></td>';
                                var k = parseInt(key)+1;        
                                str += '<td>'+k+'</td>';        
                                str += '<td>'+data[key]['shop_code']+'</td>';   
                                str += '<td>'+data[key]['shop_title']+'</td>';
                                str += '<td>'+data[key]['shop_desc']+'</td>';
                                str += '<td>'+data[key]['legal_representative']+'</td>';
                                str += '<td>'+data[key]['company_name']+'</td>';
                                if(data[key]['shop_status']==1){var status="启用";}else{var status="禁用";}
                                str += '<td>'+status+'</td>';
                                str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['shop_logo']+'" width="50" height="50"></td>';
                                str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Shop/shop_edit")?>?id='+data[key]['shop_id']+'"><i class="icon-edit bigger-120"></i></a></div></td></tr>';
                                str += '</tr>';
                            });
        	            }
                		$("#already_delete_div table>tbody").html(str);
                	}      
                });
    	    }
    	});
		<?php }?>

		//恢复选中
		$("#already_delete_div #remove_del").click(function(){
			var checked_obj = $("#already_delete_div table>tbody input[type='checkbox']:checked");
			if(checked_obj.length==0){
				alert("请选中需要恢复记录的选项!");return false;
			}
			var checked_ids = '';
			$.each(checked_obj,function(key){
				checked_ids += $(this).val()+',';
			});
			checked_ids = checked_ids.substr(0,checked_ids.length-1);
			<?php $path_url = Yii::app()->createUrl('Shop/UpdateShopIsDelete');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+checked_ids,
             	dataType:'json',
            	success:function(data){
            		if(data == 1){
            			alert("恢复成功!");
            			window.location.reload();
                	}else{
                    	alert("恢复失败!");
                    }
            	}      
            });
		});
		



        /**table切换**/
        $(".table_switch > span").click(function(){
        	$(".table_switch > span").removeClass('myself_current');
        	$(this).addClass('myself_current');
        	if($(this).attr('val')==0){
            	$("#no_delete_div").removeClass('hidden');
            	$("#already_delete_div").addClass('hidden');
            }else if($(this).attr('val')==1){
            	$("#no_delete_div").addClass('hidden');
            	$("#already_delete_div").removeClass('hidden');
            }
    	});
    });

    function CheckPass(){
    	var c = prompt('请输入用户密码');
    	var res = 0;
    	if(c == null) res = 2;
    	else{
    	<?php $path_url = Yii::app()->createUrl('Site/CheckUserPass');?>
        $.ajax({
            url:"<?php echo $path_url;?>",
            type:'get',
            async:false,
            data:'pass='+c,
         	dataType:'json',
        	success:function(data){
        		if(data == 1){
            		//密码正确
        			res = 1;
            	}
        	}      
        });
    	}
        return res;
    }
   
</script>
