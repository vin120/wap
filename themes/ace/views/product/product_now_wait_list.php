<?php
    $this->pageTitle = Yii::t('vcos','商品列表');
    $theme_url = Yii::app()->theme->baseUrl;
    $menu_type = 'product_now_wait_list';
?>
<?php 
    //navbar 挂件
    $this->widget('navbarWidget');
    if(in_array('295', $auth) || $auth[0] == '0'){
        $canadd = TRUE;
    }  else {
        $canadd = False;
    }
    if(in_array('296', $auth) || $auth[0] == '0'){
        $canedit = TRUE;
    }  else {
        $canedit = False;
    }
    if(in_array('297', $auth) || $auth[0] == '0'){
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
                                <?php echo yii::t('vcos', '商品管理')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '商品列表')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <style>
                    	.table_switch{width:100%;height:45px;border-bottom:1px solid #ccc;margin-bottom:10px;}
                    	.table_switch > span{cursor:pointer;padding-left:15px;padding-right:15px;height:35px;line-height:35px;display:inline-block;background:#eee;text-align:center;margin-top:5px;margin-right:5px;}
                    	.table_switch >.myself_current{height:40px;background:#fff;border:1px solid #ccc;border-bottom:none;}
	                    </style>
	                    <div class="table_switch"><span class='myself_current' val='0'>在售商品</span><span val='1' >待售商品</span><span val='2'>回收站</span></div>
	                    <!-- 分页 -->
	                    <input type="hidden" name='now_page_num' value='<?php echo $now_page_num;?>' />
	                    <input type="hidden" name='wait_page_num' value='<?php echo $wait_page_num;?>' />
	                    <input type="hidden" name='old_page_num' value='<?php echo $old_page_num;?>' />
                    		<!-- 在售 -->
                            <div class="row" id="now_table">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<style>
			                                        .list_select_option{margin-bottom:10px;}
			                                        .city_sel{margin-left:5px;width:150px;}
		                                        </style>
                                            	<div class="list_select_option all_cat_choose">
                                             	  <label><?php echo yii::t('vcos', '请选择分类')?>:</label>
                                             	  <select class='city_sel' nam='cat1_all_sel'>
                                             	  <option value='0'>全部</option>
                                             	  <?php
                                             	  foreach($cat1_sel as $row){
                                             	  ?>
                                             	  	<option value="<?php echo $row['category_code'];?>"><?php echo $row['name']?></option>
                                             	  <?php }?>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat2_all_sel'>
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat3_all_sel' >
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <input style="background:#6faed9;border:0px;width:55px;height:30px;" type='submit' value='确认'/>
                                             	</div>
                                             	
                                                <form method="post" class='now_form' action="<?php echo Yii::app()->createUrl("Product/product_list");?>">
                                                <table id="sample-table-1" class="now_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '商品店铺')?></th>
                                                            <th><?php echo yii::t('vcos', '商品品牌')?></th>
                                                            <th><?php echo yii::t('vcos', '商品分类')?></th>
                                                            <th><?php echo yii::t('vcos', '商品编码')?></th>
                                                            <th><?php echo yii::t('vcos', '商品名')?></th>
                                                            <th><?php echo yii::t('vcos', '产地')?></th>
                                                            <th><?php echo yii::t('vcos', '最新上架时间')?></th>
                                                            <th><?php echo yii::t('vcos', '商品图片')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($product as $key=>$row) { ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php if($row['shop_title']==''){echo '自营产品';}else{echo $row['shop_title'];}?></td>
                                                            <td><?php echo $row['brand_cn_name'];?></td>
                                                            <td><?php echo $row['name'];?></td>
                                                            <td><?php echo $row['product_code'];?></td>
                                                            <td><?php echo $row['product_name'];?></td>
                                                            <td><?php echo $row['origin'];?></td>
                                                            <td><?php echo substr($row['sale_start_time'] , 0 , -3);?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['product_img'];?>" width="50" height="50"></td>
                                                            <td><?php echo $row['status']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td>
                                                                <?php
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Product',
                                                                        'MethodName'=>'product_edit',
                                                                        'id'=>$row['product_id'],
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
                                                	<button id="down_submit" class="btn btn-xs">批量下架</button>
                                                    <?php
                                                        //底部操作挂件
                                                        $this->widget('BotWidget',array(
                                                            'ControllerName'=>'Product',
                                                            'MethodName'=>'product_add',
                                                            'canadd'=>$canadd,
                                                            //'candelete'=>$candelete,
                                                        ));
                                                    ?>
                                                </div>
                                                <!-- 在售分页 -->
                                                <div class="center" id="page_div"> </div>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <!-- 待售 -->
							<div class="row hidden" id="wait_table">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<style>
			                                        .list_select_option{margin-bottom:10px;}
			                                        .city_sel{margin-left:5px;width:150px;}
		                                        </style>
		                                        
                                            	<div class="list_select_option wait_cat_choose">
                                             	  <label><?php echo yii::t('vcos', '请选择分类')?>:</label>
                                             	  <select class='city_sel' nam='cat1_all_sel_wait'>
                                             	  <?php
                                             	  foreach($cat1_sel as $row){
                                             	  ?>
                                             	  	<option value="<?php echo $row['category_code'];?>"><?php echo $row['name']?></option>
                                             	  <?php }?>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat2_all_sel_wait'>
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat3_all_sel_wait'>
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <input style="background:#6faed9;border:0px;width:55px;height:30px;" type='submit' value='确认'/>
                                             	</div>
                                             	
                                                <form method="post" class='wait_form' action="<?php echo Yii::app()->createUrl("Product/product_wait_list");?>">
                                                <table id="sample-table-1" class="wait_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '商品店铺')?></th>
                                                            <th><?php echo yii::t('vcos', '商品品牌')?></th>
                                                            <th><?php echo yii::t('vcos', '商品分类')?></th>
                                                            <th><?php echo yii::t('vcos', '商品编码')?></th>
                                                            <th><?php echo yii::t('vcos', '商品名')?></th>
                                                            <th><?php echo yii::t('vcos', '产地')?></th>
                                                            <th><?php echo yii::t('vcos', '下架时间')?></th>
                                                            <th><?php echo yii::t('vcos', '商品图片')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($product_wait as $key=>$row) { ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php if($row['shop_title']==''){echo '自营产品';}else{echo $row['shop_title'];}?></td>
                                                            <td><?php echo $row['brand_cn_name'];?></td>
                                                            <td><?php echo $row['name'];?></td>
                                                            <td><?php echo $row['product_code'];?></td>
                                                            <td><?php echo $row['product_name'];?></td>
                                                            <td><?php echo $row['origin'];?></td>
                                                            <td><?php echo substr($row['sale_end_time'] , 0 , -3);?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['product_img'];?>" width="50" height="50"></td>
                                                            <td><?php echo $row['status']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td>
                                                                <?php
                                                                    $this->widget('ManipulateWidget',array(
                                                                        'ControllerName'=>'Product',
                                                                        'MethodName'=>'product_edit',
                                                                        'id'=>$row['product_id'],
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
                                                	<button id="up_submit" class="btn btn-xs">批量上架</button>
                                                	
                                                    <?php
                                                        //底部操作挂件
                                                        $this->widget('BotWidget',array(
                                                            'ControllerName'=>'Product',
                                                            'MethodName'=>'product_add',
                                                            'canadd'=>$canadd,
                                                            'candelete'=>$candelete,
                                                        ));
                                                    ?>
                                                </div>
                                               
                                               <!-- 待售分页 -->
                                                <div class="center" id="page_wait_div"> </div>
                                                
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->                            
                            <!-- 待售 -->
                            <!-- 回收站 -->
							<div class="row hidden" id="old_table">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                            	<style>
			                                        .list_select_option{margin-bottom:10px;}
			                                        .city_sel{margin-left:5px;width:150px;}
		                                        </style>
		                                        
                                            	<div class="list_select_option old_cat_choose">
                                             	  <label><?php echo yii::t('vcos', '请选择分类')?>:</label>
                                             	  <select class='city_sel' nam='cat1_all_sel_old'>
                                             	  <option value='0'>全部</option>
                                             	  <?php
                                             	  foreach($cat1_sel as $row){
                                             	  ?>
                                             	  	<option value="<?php echo $row['category_code'];?>" ><?php echo $row['name']?></option>
                                             	  <?php }?>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat2_all_sel_old'>
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <select class='city_sel hidden' nam='cat3_all_sel_old'>
                                             	  <option value='0'>全部</option>
                                             	  </select>
                                             	  <input style="background:#6faed9;border:0px;width:55px;height:30px;" type='submit' value='确认' />
                                             	</div>
                                             	
                                             	<style>
                                             		.recovery{color:blue;cursor:pointer;}
                                             	</style>
                                                <form method="post" class='old_form' action="<?php echo Yii::app()->createUrl("Product/product_old_list");?>">
                                                <table id="sample-table-1" class="old_t table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '商品店铺')?></th>
                                                            <th><?php echo yii::t('vcos', '商品品牌')?></th>
                                                            <th><?php echo yii::t('vcos', '商品分类')?></th>
                                                            <th><?php echo yii::t('vcos', '商品编码')?></th>
                                                            <th><?php echo yii::t('vcos', '商品名')?></th>
                                                            <th><?php echo yii::t('vcos', '产地')?></th>
                                                            <th><?php echo yii::t('vcos', '下架时间')?></th>
                                                            <th><?php echo yii::t('vcos', '商品图片')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '操作')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	
                                                        <?php foreach ($product_old as $key=>$row) { ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php if($row['shop_title']==''){echo '自营产品';}else{echo $row['shop_title'];}?></td>
                                                            <td><?php echo $row['brand_cn_name'];?></td>
                                                            <td><?php echo $row['name'];?></td>
                                                            <td><?php echo $row['product_code'];?></td>
                                                            <td><?php echo $row['product_name'];?></td>
                                                            <td><?php echo $row['origin'];?></td>
                                                            <td><?php echo substr($row['sale_end_time'] , 0 , -3);?></td>
                                                            <td><img src="<?php echo Yii::app()->params['imgurl'].$row['product_img'];?>" width="50" height="50"></td>
                                                            <td><?php echo $row['status']?yii::t('vcos', '启用'):yii::t('vcos', '禁用');?></td>
                                                            <td>
                                                               <span id="<?php echo $row['product_id'];?>" class="recovery">恢复</span>
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                </form>
                                                <div class="center">
                                                	<button id="Recovery_submit" class="btn btn-xs">批量恢复</button>
                                                	
                                                </div>
                                               
                                                <!-- 回收站分页 -->
                                                <div class="center" id="page_old_div"> </div>
                                                
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->                            
                            <!-- 回收站 -->
                            
                            
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        /**在售分页**/
        <?php if($count >1){?>
    		now_page(<?php echo $count;?>);
		<?php }?>
		
		/**待售分页**/
		<?php if($count_wait >1){?>
    		wait_page(<?php echo $count_wait;?>);
		<?php }?>
		
		/**回收站分页**/
		<?php if($count_old >1){?>
    		old_page(<?php echo $count_old;?>);
		<?php }?>
		
    	/**table切换**/
        $(".table_switch > span").click(function(){
        	$(".table_switch > span").removeClass('myself_current');
        	$(this).addClass('myself_current');
        	if($(this).attr('val')==0){
            	$("#now_table").removeClass('hidden');
            	$("#wait_table").addClass('hidden');
            	$("#old_table").addClass('hidden');
            }else if($(this).attr('val')==1){
            	$("#now_table").addClass('hidden');
            	$("#wait_table").removeClass('hidden');
            	$("#old_table").addClass('hidden');
            }else if($(this).attr('val')==2){
            	$("#now_table").addClass('hidden');
            	$("#wait_table").addClass('hidden');
            	$("#old_table").removeClass('hidden');
            }
    	});
		/**在售**/
        $('#now_table table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
      

        /**待售**/
        $('#wait_table table th input:checkbox').on('click' , function(){
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
       
        //$( "#wait_table .delete" ).on('click', function(e) {
        $(document).on('click','#wait_table .delete',function(e){
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
                            location.href="<?php echo Yii::app()->createUrl("Product/product_wait_list");?>"+"?id="+$a;
                            }else if(res == 0){
                                alert('输入密码有误!');
                            }
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
         
        $( "#wait_table #submit" ).on('click', function(e) {
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
                            	$("#wait_table form.wait_form").submit();
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
            if(!$('#wait_table .isclick').is(':checked')){
                $('#danger').hide();
                $('.widget-header h4').html("<i class='icon-warning-sign red'></i><?php echo yii::t('vcos', '没有选中！')?>");
                $('#isempty1').html("<?php echo yii::t('vcos', '请选择删除项。')?>");
                $('#isempty2').hide();
            }
        }); 

        /**回收站**/
        $('#old_table table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });


        /**在售：分类筛选:一级**/
        $("select[nam='cat1_all_sel']").change(function(){
            var this_code = $(this).val();
            var str = '';
            var str_ch = '';
            var str_pr = '';
            if(this_code==0){
                $("select[nam='cat2_all_sel']").addClass('hidden');
                $("select[nam='cat3_all_sel']").addClass('hidden');
                return false;
           }
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
                	str = "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat2_all_sel']").html(str);
            		$("select[nam='cat2_all_sel']").removeClass('hidden');
            		$("select[nam='cat3_all_sel']").addClass('hidden');
            	}        
            });

        });

        /**改变分类二级,获取三级**/
        $("select[nam='cat2_all_sel']").change(function(){
            var this_code = $(this).val();
            var str = '';
            if(this_code==0){$("select[nam='cat3_all_sel']").addClass('hidden');return false;}
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
                	str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat3_all_sel']").html(str);
            		$("select[nam='cat3_all_sel']").removeClass('hidden');
            	}      
            });
        });

        /**在售，查询提交**/
       $("#now_table .all_cat_choose input[type='submit']").click(function(){
            var all_one = $("select[nam='cat1_all_sel']").val();
            var all_two = $("select[nam='cat2_all_sel']").val();
            var all_three = $("select[nam='cat3_all_sel']").val();
            <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
            var data_text = '&all_one='+all_one+'&all_two='+all_two+'&all_three='+all_three;
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'pag=1'+data_text,
             	dataType:'json',
            	success:function(data_all){
                	var str = '';
            		if(data_all != 0){
                		var data = data_all['data'];
                		var count = data_all['count'];
    	                $.each(data,function(key){
                            // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
    	                	str += '<tr>';
                            str += '<td class="center"><label>';
                            str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                            str += '<span class="lbl"></span></label></td>';
                            var k = parseInt(key)+1;
                            str += '<td>'+k+'</td>';    
                            if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                            str += '<td>'+data[key]["shop_title"]+'</td>';
                            str += '<td>'+data[key]['brand_cn_name']+'</td>';
                            str += '<td>'+data[key]['name']+'</td>';
                            str += '<td>'+data[key]['product_code']+'</td>';
                            str += '<td>'+data[key]['product_name']+'</td>';
                            str += '<td>'+data[key]['origin']+'</td>';
                           // str += '<td>'+data[key]['sale_start_time']+'</td>';
                            str += '<td>'+data[key]['sale_start_time'].slice(0,-3)+'</td>';
                            str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                            if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                            str += '<td>'+st+'</td>';
                            str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Product/product_edit")?>?id='+data[key]['product_id']+'"><i class="icon-edit bigger-120"></i></a></div></td></tr>';
                          });
                        
    	                $("table.now_t>tbody").html(str);
    	                
    	                //在售分页
    	                if(count>1){$("input[name='now_page_num']").val(1);now_page(count,data_text);}
    	                else $('#page_div').html('');
    	            }else{
    	            	$("table.now_t>tbody").html('');
    	            	$('#page_div').html('');
        	        }
            	}      
            });
            
       });
        
        /**待售:分类筛选:一级**/
        $("select[nam='cat1_all_sel_wait']").change(function(){
            var this_code = $(this).val();
            var str = '';
            var str_ch = '';
            var str_pr = '';
            if(this_code==0){
                $("select[nam='cat2_all_sel_wait']").addClass('hidden');
                $("select[nam='cat3_all_sel_wait']").addClass('hidden');
                return false;
            }
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
                	str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat2_all_sel_wait']").html(str);
            		$("select[nam='cat2_all_sel_wait']").removeClass('hidden');
            		$("select[nam='cat3_all_sel_wait']").addClass('hidden');
            	}        
            });

        });

        /**待售：改变分类二级,获取三级**/
        $("select[nam='cat2_all_sel_wait']").change(function(){
            var this_code = $(this).val();
            var str = '';
            if(this_code == 0){$("select[nam='cat3_all_sel_wait']").addClass('hidden');return false;}
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
                	str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat3_all_sel_wait']").html(str);
            		$("select[nam='cat3_all_sel_wait']").removeClass('hidden');
            	}      
            });
        });

        /**待售，查询提交**/
        $("#wait_table .wait_cat_choose input[type='submit']").click(function(){
             var wait_one = $("select[nam='cat1_all_sel_wait']").val();
             var wait_two = $("select[nam='cat2_all_sel_wait']").val();
             var wait_three = $("select[nam='cat3_all_sel_wait']").val();
             <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
             var data_text = '&wait_one='+wait_one+'&wait_two='+wait_two+'&wait_three='+wait_three;
             $.ajax({
                 url:"<?php echo $path_url;?>",
                 type:'get',
                 data:'pag_wait=1'+data_text,
              	dataType:'json',
             	success:function(data_all){
                 	var str = '';
             		if(data_all != 0){
                 		var data = data_all['data'];
                 		var count = data_all['count'];
                 		$.each(data,function(key){
                            // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
    	                	str += '<tr>';
                            str += '<td class="center"><label>';
                            str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                            str += '<span class="lbl"></span></label></td>';
                            var k = parseInt(key)+1;
                            str += '<td>'+k+'</td>';    
                            if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                            str += '<td>'+data[key]["shop_title"]+'</td>';
                            str += '<td>'+data[key]['brand_cn_name']+'</td>';
                            str += '<td>'+data[key]['name']+'</td>';
                            str += '<td>'+data[key]['product_code']+'</td>';
                            str += '<td>'+data[key]['product_name']+'</td>';
                            str += '<td>'+data[key]['origin']+'</td>';
                            str += '<td>'+data[key]['sale_end_time'].slice(0,-3)+'</td>';
                            str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                            if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                            str += '<td>'+st+'</td>';
                            str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Product/product_edit")?>?id='+data[key]['product_id']+'"><i class="icon-edit bigger-120"></i></a><a id="'+data[key]['product_id']+'" class="btn btn-xs btn-warning delete" title="删除" href="#"><i class="icon-trash bigger-120"></i></a></div></td></tr>';
                          });
    	                $("table.wait_t>tbody").html(str);
     	                
     	                //待售分页
     	                if(count>1){$("input[name='wait_page_num']").val(1);wait_page(count,data_text);}
     	                else $('#page_wait_div').html('');
     	            }else{
     	            	$("table.wait_t>tbody").html('');
     	            	$('#page_wait_div').html('');
         	        }
             	}      
             });
             
        });
         

        /**回收站:分类筛选:一级**/
        $("select[nam='cat1_all_sel_old']").change(function(){
            var this_code = $(this).val();
            var str = '';
            var str_ch = '';
            var str_pr = '';
            if(this_code==0){
            	$("select[nam='cat2_all_sel_old']").addClass('hidden');
            	$("select[nam='cat3_all_sel_old']").addClass('hidden');
            	return false;
            }
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
                	str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat2_all_sel_old']").html(str);
            		$("select[nam='cat2_all_sel_old']").removeClass('hidden');
            		$("select[nam='cat3_all_sel_old']").addClass('hidden');
            	}        
            });

        });

        /**回收站：改变分类二级,获取三级**/
        $("select[nam='cat2_all_sel_old']").change(function(){
            var this_code = $(this).val();
            var str = '';
            if(this_code==0){$("select[nam='cat3_all_sel_old']").addClass('hidden');return false;}
            <?php $path_url = Yii::app()->createUrl('Product/GetCategoryChild');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'parent_code='+this_code,
             	dataType:'json',
            	success:function(data){
            		str += "<option value='0'>全部</option>";
            		$.each(data,function(key){  
                       str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                    });
            		$("select[nam='cat3_all_sel_old']").html(str);
            		$("select[nam='cat3_all_sel_old']").removeClass('hidden');
            	}      
            });
        });


        /**回收站，查询提交**/
        $("#old_table .old_cat_choose input[type='submit']").click(function(){
             var old_one = $("select[nam='cat1_all_sel_old']").val();
             var old_two = $("select[nam='cat2_all_sel_old']").val();
             var old_three = $("select[nam='cat3_all_sel_old']").val();
             <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
             var data_text = '&old_one='+old_one+'&old_two='+old_two+'&old_three='+old_three;
             $.ajax({
                 url:"<?php echo $path_url;?>",
                 type:'get',
                 data:'pag_old=1'+data_text,
              	dataType:'json',
             	success:function(data_all){
                 	var str = '';
             		if(data_all != 0){
                 		var data = data_all['data'];
                 		var count = data_all['count'];
                 		$.each(data,function(key){
                            // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
    	                	str += '<tr>';
                            str += '<td class="center"><label>';
                            str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                            str += '<span class="lbl"></span></label></td>';
                            var k = parseInt(key)+1;
                            str += '<td>'+k+'</td>';    
                            if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                            str += '<td>'+data[key]["shop_title"]+'</td>';
                            str += '<td>'+data[key]['brand_cn_name']+'</td>';
                            str += '<td>'+data[key]['name']+'</td>';
                            str += '<td>'+data[key]['product_code']+'</td>';
                            str += '<td>'+data[key]['product_name']+'</td>';
                            str += '<td>'+data[key]['origin']+'</td>';
                            str += '<td>'+data[key]['sale_start_time'].slice(0,-3)+'</td>';
                            str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                            if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                            str += '<td>'+st+'</td>';
                            str += '<td><span id="'+data[key]['product_id']+'" class="recovery">恢复</span></td></tr>';
                          });
    	                $("table.old_t>tbody").html(str);
     	                
     	                //待售分页
     	                if(count>1){$("input[name='old_page_num']").val(1);old_page(count,data_text);}
     	                else $('#page_old_div').html('');
     	            }else{
     	            	$("table.old_t>tbody").html('');
     	            	$('#page_old_div').html('');
         	        }
             	}      
             });
             
        });
        
        /**批量下架**/
		$("#down_submit").click(function(){
			var ids = $("#now_table table>tbody input[type='checkbox']:checked");
			if(ids.length == 0){alert("请选择下架项!");return false;}
			var ids_str = '';
			$.each(ids,function(key){
				ids_str += $(this).val()+',';
			});
			ids_str = ids_str.substring(0,ids_str.length-1);
			<?php $path_url = Yii::app()->createUrl('Product/ProductOverdue');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+ids_str,
             	dataType:'json',
            	success:function(data){
                	alert("批量下架成功!");
            		if(data == 1){
            			/*$("#now_table table>tbody input[type='checkbox']:checked").each(function(i){
                			$(this).parent().parent().parent().remove();
                		});*/
                		//刷新页面
            			window.location.reload();
                	}
            	}      
            });
		});

		/**批量上架**/
		$("#up_submit").click(function(){
			var ids = $("#wait_table table>tbody input[type='checkbox']:checked");
			if(ids.length == 0){alert("请选择上架项!");return false;}
			var ids_str = '';
			$.each(ids,function(key){
				ids_str += $(this).val()+',';
			});
			ids_str = ids_str.substring(0,ids_str.length-1);
			<?php $path_url = Yii::app()->createUrl('Product/ProductShelves');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+ids_str,
             	dataType:'json',
            	success:function(data){
            		alert("批量上架成功!");
            		if(data == 1){
            			/*$("#wait_table table>tbody input[type='checkbox']:checked").each(function(i){
                			$(this).parent().parent().parent().remove();
                		});*/
            			//刷新页面
            			window.location.reload();
                	}
            	}      
            });
		});

		/**批量恢复**/
		$("#Recovery_submit").click(function(){
			var ids = $("#old_table table>tbody input[type='checkbox']:checked");
			if(ids.length == 0){alert("请选择恢复项!");return false;}
			var ids_str = '';
			$.each(ids,function(key){
				ids_str += $(this).val()+',';
			});
			ids_str = ids_str.substring(0,ids_str.length-1);
			<?php $path_url = Yii::app()->createUrl('Product/ProductRecovery');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+ids_str,
             	dataType:'json',
            	success:function(data){
            		alert("批量恢复成功!");
            		if(data == 1){
            			/*$("#wait_table table>tbody input[type='checkbox']:checked").each(function(i){
                			$(this).parent().parent().parent().remove();
                		});*/
            			//刷新页面
            			window.location.reload();
                	}
            	}      
            });
		});

		/**单条恢复**/
		$(document).on('click','.recovery',function(e){
			var id = $(this).attr('id');
			<?php $path_url = Yii::app()->createUrl('Product/ProductRecovery');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+id,
             	dataType:'json',
            	success:function(data){
            		alert("恢复成功!");
            		if(data == 1){
            			/*$("#wait_table table>tbody input[type='checkbox']:checked").each(function(i){
                			$(this).parent().parent().parent().remove();
                		});*/
            			//刷新页面
            			window.location.reload();
                	}
            	}      
            });
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


    /**在售商品分页**/
    function now_page(count,data_text=''){
    	$('#page_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
        	    var this_page = $("input[name='now_page_num']").val();
        	    if(num == this_page){$("input[name='now_page_num']").val('fail');return false;}
        	    <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
    	    	if(data_text=='')
    	    		var data = 'pag='+num;
    	    	else
    	    		var data = 'pag='+num+data_text;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                    	var data = data_all['data'];
                    	var str = '';
                		if(data != 0){
        	                $.each(data,function(key){
                                // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                                str += '<span class="lbl"></span></label></td>';
                                var k = parseInt(key)+1;
                                str += '<td>'+k+'</td>';    
                                if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                                str += '<td>'+data[key]["shop_title"]+'</td>';
                                str += '<td>'+data[key]['brand_cn_name']+'</td>';
                                str += '<td>'+data[key]['name']+'</td>';
                                str += '<td>'+data[key]['product_code']+'</td>';
                                str += '<td>'+data[key]['product_name']+'</td>';
                                str += '<td>'+data[key]['origin']+'</td>';
                               // str += '<td>'+data[key]['sale_start_time']+'</td>';
                                str += '<td>'+data[key]['sale_start_time'].slice(0,-3)+'</td>';
                                str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                                if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                                str += '<td>'+st+'</td>';
                                str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Product/product_edit")?>?id='+data[key]['product_id']+'"><i class="icon-edit bigger-120"></i></a></div></td></tr>';
                              });
        	                $("table.now_t>tbody").html(str);
        	            }
                	}      
                });
    	    }
    	});
    }


    /**待售：商品分页**/
    function wait_page(count,data_text=''){
    	$('#page_wait_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var this_page = $("input[name='wait_page_num']").val();
        	    if(num == this_page){$("input[name='wait_page_num']").val('fail');return false;}
        	    <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
    	    	if(data_text=='')
    	    		var data = 'pag_wait='+num;
    	    	else
    	    		var data = 'pag_wait='+num+data_text;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                    	var str = '';
                		if(data_all != 0){
                    		var data = data_all['data'];
        	                $.each(data,function(key){
                                // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                                str += '<span class="lbl"></span></label></td>';
                                var k = parseInt(key)+1;
                                str += '<td>'+k+'</td>';    
                                if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                                str += '<td>'+data[key]["shop_title"]+'</td>';
                                str += '<td>'+data[key]['brand_cn_name']+'</td>';
                                str += '<td>'+data[key]['name']+'</td>';
                                str += '<td>'+data[key]['product_code']+'</td>';
                                str += '<td>'+data[key]['product_name']+'</td>';
                                str += '<td>'+data[key]['origin']+'</td>';
                                str += '<td>'+data[key]['sale_end_time'].slice(0,-3)+'</td>';
                                str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                                if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                                str += '<td>'+st+'</td>';
                                str += '<td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group"><a class="btn btn-xs btn-info" title="编辑" href="<?php echo Yii::app()->createUrl("Product/product_edit")?>?id='+data[key]['product_id']+'"><i class="icon-edit bigger-120"></i></a><a id="'+data[key]['product_id']+'" class="btn btn-xs btn-warning delete" title="删除" href="#"><i class="icon-trash bigger-120"></i></a></div></td></tr>';
                              });
        	                $("table.wait_t>tbody").html(str);
        	            }
                	}      
                });
    	    }
    	});
    }


    /**回收站商品分页**/
    function old_page(count,data_text=''){
    	$('#page_old_div').jqPaginator({
    	    totalPages: count,
    	    visiblePages: 5,
    	    //currentPage: 3,
    	    wrapper:'<ul class="pagination"></ul>',
    	    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
    	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
    	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
    	    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
    	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
    	    onPageChange: function (num) {
    	    	var this_page = $("input[name='old_page_num']").val();
        	    if(num == this_page){$("input[name='old_page_num']").val('fail');return false;}
        	    <?php $path_url = Yii::app()->createUrl('Product/GetProductPage');?>
    	    	if(data_text=='')
    	    		var data = 'pag_old='+num;
    	    	else
    	    		var data = 'pag_old='+num+data_text;
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'get',
                    data:data,
                 	dataType:'json',
                	success:function(data_all){
                    	var str = '';
                		if(data_all != 0){
                    		var data = data_all['data'];
        	                $.each(data,function(key){
                                // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
        	                	str += '<tr>';
                                str += '<td class="center"><label>';
                                str += '<input type="checkbox" name="ids[]" value="'+data[key]['product_id']+'" class="ace isclick" />';
                                str += '<span class="lbl"></span></label></td>';
                                var k = parseInt(key)+1;
                                str += '<td>'+k+'</td>';    
                                if(data[key]['shop_title']==''){var name ='自营产品';}else{var name = data[key]['shop_title'];}
                                str += '<td>'+data[key]["shop_title"]+'</td>';
                                str += '<td>'+data[key]['brand_cn_name']+'</td>';
                                str += '<td>'+data[key]['name']+'</td>';
                                str += '<td>'+data[key]['product_code']+'</td>';
                                str += '<td>'+data[key]['product_name']+'</td>';
                                str += '<td>'+data[key]['origin']+'</td>';
                                str += '<td>'+data[key]['sale_start_time'].slice(0,-3)+'</td>';
                                str += '<td><img src="<?php echo Yii::app()->params['imgurl'];?>'+data[key]['product_img']+'" width="50" height="50"></td>';
                                if(data[key]['status']==1){var st = '启用';}else{ var st = '禁用';}
                                str += '<td>'+st+'</td>';
                                str += '<td><span id="'+data[key]['product_id']+'" class="recovery">恢复</span></td></tr>';
                              });
        	                $("table.old_t>tbody").html(str);
        	            }
                	}      
                });
    	    }
    	});
    }
</script>
