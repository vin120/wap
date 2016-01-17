<?php
    $this->pageTitle = Yii::t('vcos','添加活动商品');
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'activity_product_add';
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
    <style>
    .category_product_list{width:100%;border-collapse:collapse;border:1px solid #ccc;}
    table thead tr td{text-align:center;height:30px;background:#B0E0E6;}
    table tbody tr td{padding-top:10px;padding-bottom:5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
    table tbody tr{border-bottom:1px dashed #ccc;}
    </style>

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
                            <?php echo yii::t('vcos', '活动管理')?>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '添加活动商品')?>
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
                                    'enctype'=>'multipart/form-data',
                                ),
                            ));  
                            ?> 
                            	<div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '活动')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="activity">
                                    		<?php foreach($activity as $row){?>
                                            <option value="<?php echo $row['activity_id'];?>"><?php echo $row['activity_name']?></option>
                                            <?php }?>
                                        </select>
                                        <?php echo $form->error($activity_product,'activity_id'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '类型')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<select class="col-xs-10 col-sm-8 col-md-8" id="form-field-select-1" name="product_type">
                                            <option value="6">商品</option>
                                        </select>
                                        <?php echo $form->error($activity_product,'product_type'); ?> 
                                    </div>
                                </div>
                                
                                <div class="space-4"></div>
                                <div class="form-group product_sel">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '商品')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                    	<?php if($layer_1){?>
                                    	<select style="width:20%;" id="category_one" name="category_1">
                                          <?php foreach($layer_1 as $lay1){?>  
                                            <option value="<?php echo $lay1['category_code']?>"><?php echo $lay1['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_2){?>
                                    	<select style="width:20%;" id="category_two" name="category_2">
                                          <?php foreach($layer_2 as $lay2){?>  
                                            <option value="<?php echo $lay2['category_code']?>"><?php echo $lay2['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                        <?php if($layer_3){?>
                                    	<select style="width:20%;" id="category_three" name="category_3">
                                          <?php foreach($layer_3 as $lay3){?>  
                                            <option value="<?php echo $lay3['category_code']?>"><?php echo $lay3['name']?></option>
                                        	<?php }?>
                                        </select>
                                        <?php }?>
                                    
                                        <?php echo $form->error($activity_product,'product_id'); ?> 
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <input type="hidden" id='product_array' value='' />
                                <table class="category_product_list">
                                	<thead>
                                		<tr>
                                		<td class="center" style="width:10%">
                                           <label>
                                              <input type="checkbox" class="ace" />
                                              <span class="lbl"></span>
                                           </label>
                                         </td>
                                         <td style="width:30%;text-align:left;">商品名</td>
                                         <td style="width:10%;text-align:left;">排序</td>
                                         <td style="width:20%;text-align:left;">开始时间</td>
                                         <td style="width:20%;text-align:left;">结束时间</td>
                                		</tr>
                                	</thead>
                                	<tbody>
                                	<?php if(count($product)>0){foreach($product as $row){?>
                                		<tr>
                                		<td class="center">
                                           <label>
                                             <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                             <span class="lbl"></span>
                                           </label>
                                        </td>
                                        <td><?php echo $row['product_name']?></td>
                                        <td><input type="text" name="sort[]" value=''></td>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                    <?php }}else{?>
                                    <tr><td colspan='5' style='text-align: center;'>无</td></tr>
                                    <?php }?>
                                	</tbody>
                                </table>
                                <div id="submit_but" style="float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">提交</div>
                                <div class="center" id="page_div"> </div>
                                
                                <div class="space-4"></div>
                                
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
<script src="<?php echo $theme_url; ?>/assets/js/jqPaginator.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/jquery.datetimepicker.js"></script>
<script type="text/javascript">
jQuery(function($){
  
    $('form').submit(function(){
        return false;
    });

    
    
    $("#add").validate({
        rules: {
            sort:{required:true,isIntGtZero:true}
        }
    });
    
    $('table.category_product_list thead td input:checkbox').on('click' , function(){
        var checked_val = $.trim($("#product_array").val());
        var that = this;
        var code = '';
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(k){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
            if(k!=0)
                code += $(this).val()+',';
        });
        code = code.substr(0,code.length-1);
       
        if(this.checked == true){
            //选中
            if(checked_val==''){
            	if(code!='') $("#product_array").val(code);
            }else{
            	if(code!=''){
            		var new_array = checked_val+',';
            		checked_val = ','+checked_val+',';
            		code = code.split(',');
	            	$.each(code,function(k){
		            	var v = ','+code[k]+',';
	            		if(checked_val.indexOf(v)==-1){
	            			new_array += code[k]+',';
		            	} 
	                });
	            	new_array = new_array.substr(0,new_array.length-1);
	            	$("#product_array").val(new_array);
            	}
            }
        }else{
            //取消选中
            if(code!=''){
            	var new_array = '';
            	checked_val = checked_val.split(',');
        		code = ','+code+',';
        		$.each(checked_val,function(k){
            		var v = ','+checked_val[k]+',';
	            	if(code.indexOf(v)==-1){
	            		new_array += checked_val[k]+',';
		            }
                });
        		new_array = new_array.substr(0,new_array.length-1);
            	$("#product_array").val(new_array);
            }
        }  
        
    });

    /**单个点击勾选**/
    $(document).on('click','table.category_product_list tbody input[type="checkbox"]',function(e){
        var val = $(this).val();
        var checked_val = $("#product_array").val();
        
        if($(this).is(":checked")==true){
            if(checked_val==''){
            	$("#product_array").val(val);
            }else{
            	var checked_vals = ','+checked_val+',';
            	var vals = ','+val+',';
            	if(checked_vals.indexOf(val)==-1){
            		checked_val += ','+val;
                }
            	$("#product_array").val(checked_val);
            }
        }else{
            if(checked_val!=''){
                var new_array = '';
            	checked_val = checked_val.split(',');
            	$.each(checked_val,function(k){
                	if(checked_val[k]!=val){
                		new_array += checked_val[k]+',';
                    }
                });
            	new_array = new_array.substr(0,new_array.length-1);
            	$("#product_array").val(new_array);
            }
        }
    });


    <?php if($product_count >1){?>
		product_page(<?php echo $product_count;?>,<?php echo $layer_3[0]['category_code']?>);
	<?php }?>

/*
   $("select[name='product_type']").change(function(){
	   var this_id = $(this).val();
	   if(this_id == 3){
		   //店铺
		   $(".shop_sel").removeClass('hidden');
		   $(".activity_sel").addClass('hidden');
		   $(".product_sel").addClass('hidden');
		   $(".category_sel").addClass('hidden');
	   }else if(this_id == 6){
		   //商品
		   $(".shop_sel").addClass('hidden');
		   $(".product_sel").removeClass('hidden');
		   $(".category_sel").removeClass('hidden');
		   $(".activity_sel").addClass('hidden');
	   }else if(this_id == 4){
		   //商品
		   $(".activity_sel").removeClass('hidden');
		   $(".shop_sel").addClass('hidden');
		   $(".product_sel").addClass('hidden');
		   $(".category_sel").addClass('hidden');
	   }
	});
*/

   /**改变商品分类一级,获取二级**/
   $('#category_one').change(function(){
       var this_code = $(this).val();
       var str = '';
       var str_ch = '';
       var str_pr = '';
       <?php $path_url = Yii::app()->createUrl('Activity/GetCategoryChild');?>
       <?php $path_url_product = Yii::app()->createUrl('Activity/GetCategoryProduct');?>
       $.ajax({
           url:"<?php echo $path_url;?>",
           type:'get',
           data:'parent_code='+this_code,
        	dataType:'json',
       	success:function(data){
           	if(data!=0){
       		$.each(data,function(key){  
                  str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
               });
       		$("select[name='category_2']").html(str);
       		$.ajax({
                   url:"<?php echo $path_url;?>",
                   type:'get',
                   data:'parent_code='+data[0]['category_code'],
                   dataType:'json',
               	success:function(data){
                   	if(data!=0){
               		$.each(data,function(key){  
                          str_ch += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                       });
               		$("select[name='category_3']").html(str_ch);
               		var category_code = data[0]['category_code'];
               		$.ajax({
                        url:"<?php echo $path_url_product;?>",
                        type:'get',
                        data:'parent_code='+category_code,
                     	dataType:'json',
                    	success:function(data_all){
                        	var p_str = '';
                        	if(data_all!=0){
                            	var checked_val = ','+$("#product_array").val()+',';
                            	var data = data_all['data'];
                            	var count = data_all['count'];
	                    		$.each(data,function(key){  
		                    	   var c = ','+data[key]['product_id']+',';
		                    	   if(checked_val.indexOf(c)!=-1){var ch="checked='checked'";}else{var ch='';}
	                               p_str += "<tr><td class='center'><label>";
	                       		   p_str += "<input type='checkbox' "+ch+" name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
	                               p_str += "<span class='lbl'></span></label></td>";   
	                               p_str += "<td>"+data[key]['product_name']+"</td>";     
	                               p_str += "</tr> "; 
	                            });
	                    		$("table.category_product_list > tbody").html(p_str);
	                    		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
	                    		if(count>1) product_page(count,category_code);
	                    		else $("#page_div").html('');
                        	}else{
                        		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
                        		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
                        		$("#page_div").html('');
                            }
                    	}        
                 });
               	} else{
               		$("select[name='category_3']").html('');
               		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
               		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
            		$("#page_div").html('');
                   	} 
               	}      
            });
       	}else{
       		$("select[name='category_2']").html('');
       		$("select[name='category_3']").html('');
       		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
       		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
    		$("#page_div").html('');
           }
       	}        
       });
   });

   /**改变商品分类二级,获取三级**/
   $('#category_two').change(function(){
       var this_code = $(this).val();
       var str = '';
       var str_pr = '';
       <?php $path_url = Yii::app()->createUrl('Activity/GetCategoryChild');?>
       <?php $path_url_product = Yii::app()->createUrl('Activity/GetCategoryProduct');?>
       $.ajax({
           url:"<?php echo $path_url;?>",
           type:'get',
           data:'parent_code='+this_code,
        	dataType:'json',
       	success:function(data){
           	if(data!=0){
       		$.each(data,function(key){  
                  str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
               });
       		$("select[name='category_3']").html(str);
       		var category_code = data[0]['category_code'];
       		$.ajax({
                url:"<?php echo $path_url_product;?>",
                type:'get',
                data:'parent_code='+category_code,
             	dataType:'json',
            	success:function(data_all){
                	if(data_all!=0){
                		var checked_val = ','+$("#product_array").val()+',';
                    	var p_str='';
                    	var data = data_all['data'];
                    	var count = data_all['count'];
            		$.each(data,function(key){  
            			var c = ','+data[key]['product_id']+',';
                 	   if(checked_val.indexOf(c)!=-1){var ch="checked='checked'";}else{var ch='';}
                       p_str += "<tr><td class='center'><label>";
               		   p_str += "<input type='checkbox' "+ch+" name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
                       p_str += "<span class='lbl'></span></label></td>";   
                       p_str += "<td>"+data[key]['product_name']+"</td>";     
                       p_str += "</tr> ";  
                    });
            		$("table.category_product_list > tbody").html(p_str);
            		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
            		if(count>1) product_page(count,category_code);
            		else $("#page_div").html('');
                	}else{
                		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
                		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
                		$("#page_div").html('');
                    }
            	}        
         });
           	}else{
           		$("select[name='category_3']").html('');
           		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
           		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
               	$("#page_div").html('');
               	}
       	}      
       });
   });

   /**改变商品分类三级,获取商品**/
   $('#category_three').change(function(){
       var this_code = $(this).val();
       var str_pr = '';
       <?php $path_url_product = Yii::app()->createUrl('Activity/GetCategoryProduct');?>
       var category_code = this_code;
       $.ajax({
           url:"<?php echo $path_url_product;?>",
           type:'get',
           data:'parent_code='+this_code,
	        dataType:'json',
	       	success:function(data_all){
		       	if(data_all!=0){
		       		var checked_val = ','+$("#product_array").val()+',';
			       	var p_str='';
			       	var data = data_all['data'];
                	var count = data_all['count'];
	       		$.each(data,function(key){  
	       			var c = ','+data[key]['product_id']+',';
              	    if(checked_val.indexOf(c)!=-1){var ch="checked='checked'";}else{var ch='';}
	       			p_str += "<tr><td class='center'><label>";
            		p_str += "<input type='checkbox' "+ch+" name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
                    p_str += "<span class='lbl'></span></label></td>";   
                    p_str += "<td>"+data[key]['product_name']+"</td>";     
                    p_str += "</tr> ";   
	               });
	       		$("table.category_product_list > tbody").html(p_str);
	       		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
	       		if(count>1) product_page(count,category_code);
	       		else $("#page_div").html('');
		       	}else{
		       		$("table.category_product_list > tbody").html("<tr><td  style='text-align: center;' colspan='2'>无</td></tr>");
		       		$("table.category_product_list > thead").find("input[type='checkbox']").removeAttr("checked");
		       		$("#page_div").html('');
			    }
	       		
	       	}      
       });
   });


   /**顶级活动改变 ，子级活动改变,活动分类改变***/
  /* $("select[name='activity']").change(function(){
	   var this_id = $(this).val();
	   var str_pr = '';
       <php $path_url = Yii::app()->createUrl('Activity/GetActivityChild');?>
       $.ajax({
           url:"<php echo $path_url;?>",
           type:'get',
           data:'parent_id='+this_id,
	        dataType:'json',
	       	success:function(data){
	       		$.each(data,function(key){  
	       			str_pr += "<option value="+data[key]['activity_id']+">"+data[key]['activity_name']+"</option>"; 
	               });
	       		$("select[name='activity_child']").html(str_pr);
	       		
	       	}      
       });
       var str_pr_category = '';
       <php $path_url = Yii::app()->createUrl('Activity/GetActivityCategory');?>
       $.ajax({
           url:"<php echo $path_url;?>",
           type:'get',
           data:'parent_id='+this_id,
	        dataType:'json',
	       	success:function(data){
	       		$.each(data,function(key){  
	       			str_pr_category += "<option value="+data[key]['activity_cid']+">"+data[key]['activity_category_name']+"</option>"; 
	               });
	       		$("select[name='activity_category']").html(str_pr_category);
	       		
	       	}      
       });
   });*/


});

function product_page(count,category_code){
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
		    
	    	<?php $path_url = Yii::app()->createUrl('Activity/GetActivityProductPage');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'get',
                data:'pag='+num+'&category_code='+category_code,
             	dataType:'json',
            	success:function(data){
                	var str = '';
            		if(data != 0){
            			var checked_val = ','+$("#product_array").val()+',';
                		var p_str='';
    	                $.each(data,function(key){
    	                	var c = ','+data[key]['product_id']+',';
    	              	    if(checked_val.indexOf(c)!=-1){var ch="checked='checked'";}else{var ch='';}
    	                	p_str += "<tr><td class='center'><label>";
                    		p_str += "<input type='checkbox' "+ch+" name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
                            p_str += "<span class='lbl'></span></label></td>";   
                            p_str += "<td>"+data[key]['product_name']+"</td>";     
                            p_str += "</tr> "; 
                          });
    	                $("table.category_product_list > tbody").html(p_str);
    	            }
            	}      
            });
	    }
	});
}
</script>