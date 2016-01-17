<?php
    $this->pageTitle = Yii::t('vcos','店铺分类');
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'shop_category';
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
                            <?php echo yii::t('vcos', '店铺管理')?>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '店铺分类')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                        	<style>
                        		.click_but{width:100px;cursor:pointer;height:35px;line-height:35px;text-align:center;border:1px solid #9e9d9e;background:#e9ecec;float:left;margin-left:10px;margin-bottom:5px;}
                        		#add_category_one{cursor:pointer;line-height:30px;text-align:center;width:100px;height:30px;color:#fff;background:#009FCC;}
                        		.categroy_table thead tr td{text-align:center;height:30px;background:#B0E0E6;}
                        		.categroy_table tbody tr td{height:40px;}
                        		.categroy_table tbody tr{border-bottom:1px dashed #ccc;}
                        		.categroy_table .number{width:28px;margin-right:5px;text-align:center;}
                        		.categroy_table .cat_name{width:220px;}
                        		.categroy_table .parent_op{cursor:pointer;position:relative;top:-5px;margin:0px 5px 0px 8px;width: 0;height: 0;border-left: 8px solid transparent;border-right: 8px solid transparent;border-top: 10px solid #1b1b1b;}
                        		.categroy_table tbody tr .img>label{width:25px;}
                        		.categroy_table tbody tr .img>label>img{cursor:pointer;}
                        		.categroy_table tbody tr td.text_center{text-align:center;}
                        		.categroy_table tbody tr td .add_start{color:blue;cursor:pointer;}
                        		.categroy_table tbody tr td .add_stop{color:#ccc;}
                        		.categroy_table tbody tr td .child_op{margin:-9px 5px 0px 41px;width:15px;height:15px;border-left:1px solid #ccc;border-bottom:1px solid #ccc;}
                        	</style>
                        	<div style="margin-bottom: 10px;margin-left:10px;">
                        	<select name='shop'>
                        	<?php foreach($shop as $row){
                        		$path_url = Yii::app()->createUrl('Shop/shop_category',array('shop'=> $row['shop_id']));
                        	?>
                        		<option url="<?php echo $path_url?>" value="<?php echo $row['shop_id']?>" <?php if($shop_but == $row['shop_id']){echo "selected='selected'";}?>><?php echo $row['shop_title'];?></option>
                        	<?php }?>
                        	</select>
                        	</div>
                        	<div id="del_all" class="click_but">全部删除</div><div id="start_all" class="click_but">全部展开</div><div id="stop_all" class="click_but">全部收起</div>
                           <table class="categroy_table" style="width:100%;border-collapse:collapse;border:1px solid #ccc;">
                           	<thead>
                           		<tr>
                           			<td width='8%'>分类</td>
                           			<td width='5%'>移动</td>
                           			<td width='5%'>是否在首页显示商品</td>
                           			<td width='5%'>添加子分类</td>
                           			<td width='5%'>展开子分类</td>
                           			<td width='5%'>操作</td>
                           		</tr>
                           	</thead>
                            <tbody>
                            	<?php if($shop_cat){
                            		$pa_key = 1;
                            		$ch_key = 1;
                            	foreach ($shop_cat as $key=>$row){
                            		if($row['parent_cid'] == 0){
                            	?>
                            	<tr sort='<?php echo $row['sort_order']?>' edit='0' val='<?php echo $row['sc_id']?>' parent='<?php echo $row['parent_cid']?>' code='<?php echo $row['shop_category_id']?>'>
									<td><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $pa_key;?>'/><input readOnly='true' type='text' class='cat_name' name='name[]' value='<?php echo $row["shop_category_name"]?>'/></td>
									<?php if($pa_key == 1 && $row['count']==1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($row['count']>1 && $pa_key != 1 && $row['count'] != $pa_key){?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($row['count']>1 && $pa_key == 1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else{?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }?>
									<td class='text_center'><input class='show_main' type='checkbox' <?php if($row['is_show_main']==0){echo "checkd='checekd'";}?> value='<?php echo $row['is_show_main']?>' name='show[]'/></td>
									<td class='text_center'><label class='add_child <?php if($row['is_show_main']==0){echo "add_stop";}else{echo "add_start";}?>'>添加子分类</label></td>
									<td class='text_center'><input type='checkbox' class='show_child_cate'/></td>
									<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>
								</tr>
                            	<?php $pa_key++;$ch_key=1; }else{?>
                            	<tr sort='<?php echo $row['sort_order']?>' edit='0' val='<?php echo $row['sc_id']?>' parent='<?php echo $row['parent_cid']?>' code='<?php echo $row['shop_category_id']?>'>
									<td><label class='child_op'></label><input readOnly='true' type='text' class='number' value='<?php echo $ch_key;?>'/><input readOnly='true' type='text' class='cat_name' name='name[]' value='<?php echo $row["shop_category_name"]?>' /></td>
									<?php if($ch_key == 1  && $row['count']==1){?>
									<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>
									<?php }else if($row['count']>1 && $ch_key != 1 && $row['count'] != $ch_key){?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else if($row['count']>1 && $ch_key == 1){?>
									<td class='text_center img'><label class='up_s'></label><label  class='up'></label><label class='down_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_01.png' /></label><label class='down'><img src='<?php echo $theme_url; ?>/assets/images/sh_04.png' /></label></td>
									<?php }else{?>
									<td class='text_center img'><label class='up_s'><img src='<?php echo $theme_url; ?>/assets/images/sh_02.png' /></label><label class='up'><img src='<?php echo $theme_url; ?>/assets/images/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>
									<?php }?>
									<td class='text_center'></td>
									<td class='text_center'></td>
									<td class='text_center'></td>
									<td class='text_center img'><label><img class='success_but' src='<?php echo $theme_url; ?>/assets/images/sh_06.png' /></label><label><img class='edit_but' src='<?php echo $theme_url; ?>/assets/images/sh_07.png' /></label><label><img class='del_but' src='<?php echo $theme_url; ?>/assets/images/sh_05.png' /></label></td>
								</tr>
                            	
                            	<?php $ch_key++;}}}?>
                            </tbody>
                           </table>
                           <div id="add_category_one">添加新分类</div>
                           
                           
                           
                           
                           
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
<script src="<?php echo $theme_url; ?>/assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/moment.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/daterangepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	$("#add_category_one").click(function(){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		
		var tr_count = $(".categroy_table>tbody").find("tr[parent='0']").length;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var code_id = 0;
		var sort_id = 0;
		<?php $path_url = Yii::app()->createUrl('Shop/GetShopCatCode');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'parent_code=0&shop='+shop,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	if(data != 0){
		    		code_id = data[0];
		    		sort_id = data[1];
		    	}
	    	}      
	    });
	  	code_id = parseInt(code_id);sort_id = parseInt(sort_id);
	    if(code_id == 0){code_id = 10;}else if(code_id != 99){code_id = code_id+1;}
	    if(sort_id == 0){sort_id = 1;}else{sort_id = sort_id+1;}
	    var number_key = tr_count+1;
		var  str = '';
		str += "<tr sort='"+sort_id+"' edit='1' val='' parent='0' code='"+code_id+"'>";
		str += "<td><label class='parent_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='cat_name' name='name[]' /></td>";
		if(tr_count == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
			str += "<td class='text_center img'><label class='up_s'><img src='"+url+"/sh_02.png' /></label class='up'><label><img src='"+url+"/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}
		str += "<td class='text_center'><input class='show_main' type='checkbox' value='1' name='show[]'/></td>";
		str += "<td class='text_center'><label class='add_child add_start'>添加子分类</label></td>";
		str += "<td class='text_center'><input type='checkbox' class='show_child_cate'/></td>";
		str += "<td class='text_center img'><label><img class='success_but' src='"+url+"/sh_06.png' /></label><label><img class='edit_but' src='"+url+"/sh_07.png' /></label><label><img class='del_but' src='"+url+"/sh_05.png' /></label></td>";
		str += "</tr>";

		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		if(tr_count != 0){
			$(".categroy_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down_s").html(downs_img);
			$(".categroy_table>tbody").find("tr[parent='0']").eq(tr_count-1).find(".down").html(down_img);
		}
		$(".categroy_table").append(str);
		
	});

	$(document).on('click',".add_start",function(e){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var parent_code = $(this).parent().parent().attr('code');
		var child_tr_count = $(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").length;
		var code_id = 0;
		var sort_id = 0;
		<?php $path_url = Yii::app()->createUrl('Shop/GetShopCatCode');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'get',
	        data:'parent_code='+parent_code+'&shop='+shop,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		if(data != 0){
	    			code_id = data[0];
		    		sort_id = data[1];
		    	}
	    	}      
	    });
	    code_id = parseInt(code_id);sort_id = parseInt(sort_id);
	    if(code_id == 0){code_id = parseInt(parent_code+'01');}else if(code_id != parseInt(parent_code+'99')){code_id = code_id+1;}
	    if(sort_id == 0){sort_id = 1;}else{sort_id = sort_id+1;}
	    var number_key = child_tr_count+1;
		var url = "<?php echo $theme_url; ?>"+'/assets/images';
		var  str = '';
		str += "<tr sort='"+sort_id+"' edit='1' val='' parent='"+parent_code+"' code='"+code_id+"'>";
		str += "<td><label class='child_op'></label><input readOnly='true' type='text' class='number' value='"+number_key+"'/><input type='text' class='cat_name' name='name[]' /></td>";
		if(child_tr_count == 0){
			str += "<td class='text_center img'><label class='up_s'></label><label class='up'></label><label class='down_s'></label><label class='down'></label></td>";
		}else{
			str += "<td class='text_center img'><label class='up_s'><img src='"+url+"/sh_02.png' /></label><label class='up'><img src='"+url+"/sh_03.png' /></label><label class='down_s'></label><label class='down'></label></td>";
		}
		str += "<td class='text_center'></td>";
		str += "<td class='text_center'></td>";
		str += "<td class='text_center'></td>";
		str += "<td class='text_center img'><label><img class='success_but' src='"+url+"/sh_06.png' /></label><label><img class='edit_but' src='"+url+"/sh_07.png' /></label><label><img class='del_but' src='"+url+"/sh_05.png' /></label></td>";
		str += "</tr>";
		
		var downs_img = "<img src='"+url+"/sh_01.png' />";
		var down_img = "<img src='"+url+"/sh_04.png' />";
		if(child_tr_count != 0){
			$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down_s").html(downs_img);
			$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).find(".down").html(down_img);
		}
		if(child_tr_count == 0)
		$(this).parent().parent().after(str);
		else
		$(".categroy_table>tbody").find("tr[parent='"+parent_code+"']").eq(child_tr_count-1).after(str);
	});

	
	/**是否在首页展示商品**/
	$(document).on('click','.show_main',function(e){
		var obj = $(this).parent().parent().find('.add_child');
		var shop = $("select[name='shop'] option:selected").val();
		var checked = $(this).is(":checked");
		var this_code = $(this).parent().parent().attr('code');
		var key = 0;
		if(checked == true){
			//禁用添加
			obj.removeClass('add_start');
			obj.addClass('add_stop');
			$(this).val(0);
			key = 0;
		}else if(checked == false){
			//启用添加
			obj.addClass('add_start');
			obj.removeClass('add_stop');
			$(this).val(1);
			key = 1;
		}
		<?php $path_url = Yii::app()->createUrl('Shop/SetMainShow');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&code='+this_code+'&key='+key,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	//alert(data);
	    	}      
	    });
	});

	/**展开或收缩子类***/
	$(document).on('click','.show_child_cate',function(e){
		var checked = $(this).is(":checked");
		var parent_code = $(this).parent().parent().attr('code');
		var obj = $(".categroy_table>tbody").find("tr[parent='"+parent_code+"']");
		if(checked == true){
			//收缩子类
			obj.addClass('hidden');
		}else if(checked == false){
			//展开子类
			obj.removeClass('hidden');
		}
	});

	
	/**提交数据**/
	$(document).on('click','.success_but',function(e){
		var obj_tr = $(this).parent().parent().parent();
		if(obj_tr.attr('edit') == 0){return false;}
		
		var act = obj_tr.attr('val');
		var shop = $("select[name='shop'] option:selected").val();
		var code = obj_tr.attr('code');
		var name = obj_tr.find('.cat_name').val();
		var parent_code = obj_tr.attr('parent');
		var sort = obj_tr.attr('sort');
		if(parent_code != 0){
		var show_main = $(".categroy_table>tbody").find("tr[code='"+parent_code+"']").find('.show_main').val();
		}else{
		var show_main = obj_tr.find('.show_main').val();
		}
		if($.trim(name).length == 0){ alert('请输入分类名称'); return false;}
		
		if($.trim(act).length == 0){act=0}else{act=1;}
		<?php $path_url = Yii::app()->createUrl('Shop/ShopCategoryKeep');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'act='+act+'&shop='+shop+'&code='+code+'&name='+name+'&parent_code='+parent_code+'&sort='+sort+'&show_main='+show_main,
	        async:false,
	     	dataType:'json',
	    	success:function(data){
		    	if(act == 0) { //新增
			    	alert('添加成功!');
	    			obj_tr.attr('val',data);
		    	}else{
			    	alert('修改成功');
			    }
		    	obj_tr.attr('edit','0');
		    	obj_tr.find('.cat_name').attr('readonly','true');
	    	}      
	    });
	});


	/**全部展开**/
	$("#start_all").click(function(){
		$(".categroy_table>tbody").find('tr').removeClass('hidden');
	});

	/**全部收起**/
	$("#stop_all").click(function(){
		$(".categroy_table>tbody").find('tr[parent!=0]').addClass('hidden');
	});

	/**删除**/
	$(document).on('click','.del_but',function(e){
		var obj = $(this).parent().parent().parent();
		var this_val = obj.attr('val');
		var this_code = obj.attr('code');
		var parent = obj.attr('parent');
		var shop = $("select[name='shop'] option:selected").val();
		var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
		if($.trim(this_val).length == 0){
			var query = confirm("您确定要删除此行吗？");
			if(query == true)
				if(length != 1){
					obj.prev().find('.down_s').html('');	
					obj.prev().find('.down').html('');
				}
				obj.remove();		
		}else{
			if(parent == 0){
				var query = confirm("确定删除该分类并删除该分类下的全部子类记录?");
			}else{
				var query = confirm("确定删除该分类记录?");
			}
			if(query == false) return false;
			var msg = 0;
			//删除数据
			<?php $path_url = Yii::app()->createUrl('Shop/DelShopCate');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'post',
		        data:'code='+this_code+'&shop'+shop,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
			    	msg = data;
		    	}      
		    });
			if(msg == 0){
				alert("删除失败!");return false;
			}
			alert("删除成功!");
			if(parent == 0){
				if(obj.find('.number').val() == 1){
					$(".categroy_table>tbody").find("tr[parent='0']").eq(1).find('.up_s').html('');
					$(".categroy_table>tbody").find("tr[parent='0']").eq(1).find('.up').html('');
				}else if(obj.find('.number').val() == length){
					$(".categroy_table>tbody").find("tr[parent='0']").eq(length-2).find('.down_s').html('');
					$(".categroy_table>tbody").find("tr[parent='0']").eq(length-2).find('.down').html('');
				}
				obj.remove();
				$(".categroy_table>tbody").find("tr[parent='"+this_code+"']").remove();
			}else{
				if(obj.find('.number').val() == 1 && obj.next().attr('parent')==parent){
					obj.next().find('.up_s').html('');
					obj.next().find('.up').html('');
				}else if(obj.find('.number').val() == length && obj.prev().attr('parent')==parent){
					obj.prev().find('.down_s').html('');
					obj.prev().find('.down').html('');
				}
				obj.remove();
			}
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				$(this).find('.number').val(i+1);
				
			});
			
			
		}
	});


	/**店铺改变***/
	$("select[name='shop']").change(function(){
		var path = $(this).find("option:selected").attr('url');
		window.location.href=path;
	});

	/**编辑**/
	$(document).on('click','.edit_but',function(e){
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var obj = $(this).parent().parent().parent();
		obj.attr('edit','1');
		obj.find('.cat_name').removeAttr('readonly');
	});

	/**排序置顶操作**/
	$(document).on('click','.up_s>img',function(e){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
		var parent = this_obj.attr('parent');
		//排序图标
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[parent='0']").eq(0).before(this_obj);
			var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
			this_obj.after(child_obj);
			var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
			$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
				$(this).find(".number").val(i+1);
				if(i == 0){
					$(this).find('.up_s').html('');
					$(this).find('.up').html('');
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}else if(i == length-1){
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html('');
					$(this).find('.down').html('');
				}else{
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}
			});
		
		}else{
			var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[code='"+parent+"']").after(this_obj); 
			
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				//var val = $(this).find(".number").val();
				//val = parseInt(val)+1;
				$(this).find(".number").val(i+1);
				if(i == 0){
					$(this).find('.up_s').html('');
					$(this).find('.up').html('');
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}else if(i == length-1){
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html('');
					$(this).find('.down').html('');
				}else{
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}
			});
		}
		//修改数据
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=1&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',     
	    });
	});

	/**排序上移操作**/
	$(document).on('click','.up>img',function(e){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
		var parent = this_obj.attr('parent');
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn();
			var index = this_obj.find('.number').val();
			if(index!=1){
				$(".categroy_table>tbody").find("tr[parent='0']").eq(index-2).before(this_obj);
				var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
				this_obj.after(child_obj);
				var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
				$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
					$(this).find(".number").val(i+1);
					if(i == 0){
						$(this).find('.up_s').html('');
						$(this).find('.up').html('');
						$(this).find('.down_s').html(down_s);
						$(this).find('.down').html(down);
					}else if(i == length-1){
						$(this).find('.up_s').html(up_s);
						$(this).find('.up').html(up);
						$(this).find('.down_s').html('');
						$(this).find('.down').html('');
					}else{
						$(this).find('.up_s').html(up_s);
						$(this).find('.up').html(up);
						$(this).find('.down_s').html(down_s);
						$(this).find('.down').html(down);
					}
				});
			}
			
		}else{
			var prev=this_obj.prev(); 
			var up_sort = prev.find('.number').val();
		    var down_sort = this_obj.find('.number').val();
		    var next_parent = this_obj.next().attr('parent');
		   
		    if(down_sort>1)  
		    {  	
		    	this_obj.insertBefore(prev);  
			    prev.find('.number').val(down_sort);
			    this_obj.find('.number').val(up_sort);
			    if(up_sort == 1){
				    //最顶，需检查排序符合显示
			    	this_obj.find('.up_s').html('');
			    	this_obj.find('.up').html('');
			    	this_obj.find('.down_s').html(down_s);
			    	this_obj.find('.down').html(down);
				}else{
					this_obj.find('.up_s').html(up_s);
					this_obj.find('.up').html(up);
					this_obj.find('.down_s').html(down_s);
					this_obj.find('.down').html(down);
				}
				if(next_parent == 0 || typeof(next_parent)=="undefined"){
					//后面无同类
					prev.find('.up_s').html(up_s);
					prev.find('.up').html(up);
					prev.find('.down_s').html('');
					prev.find('.down').html('');
				}else{
					prev.find('.up_s').html(up_s);
					prev.find('.up').html(up);
					prev.find('.down_s').html(down_s);
					prev.find('.down').html(down);
				}
		    }
		}

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=2&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',     
	    });
		
	});

	/**排序置底操作**/
	$(document).on('click','.down_s>img',function(e){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var parent = this_obj.attr('parent');
		var this_code = this_obj.attr('code');
		//排序图标
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody").append(this_obj);
			var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
			this_obj.after(child_obj);
			var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
			$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
				$(this).find(".number").val(i+1);
				if(i == 0){
					$(this).find('.up_s').html('');
					$(this).find('.up').html('');
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}else if(i == length-1){
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html('');
					$(this).find('.down').html('');
				}else{
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}
			});
		}else{
			var length = $(".categroy_table>tbody").find("tr[parent='"+parent+"']").length;
			this_obj.fadeOut().fadeIn(); 
			$(".categroy_table>tbody>tr[parent='"+parent+"']:last").after(this_obj); 
			//this_obj.find('.number').val(length);
			$(".categroy_table>tbody").find("tr[parent='"+parent+"']").each(function(i){
				//var val = $(this).find(".number").val();
				//val = parseInt(val)-1;
				$(this).find(".number").val(i+1);
				if(i == 0){
					$(this).find('.up_s').html('');
					$(this).find('.up').html('');
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}else if(i == length-1){
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html('');
					$(this).find('.down').html('');
				}else{
					$(this).find('.up_s').html(up_s);
					$(this).find('.up').html(up);
					$(this).find('.down_s').html(down_s);
					$(this).find('.down').html(down);
				}
			});
		}

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=4&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',
	    });
	});

	/**排序下移操作**/
	$(document).on('click','.down>img',function(e){
		var shop = $("select[name='shop'] option:selected").val();
		var num =$(".categroy_table tbody tr[edit='1']").length;
		if(num != 0){
			alert('正在执行操作,不能继续操作!');
			return false;
		}
		var this_obj = $(this).parent().parent().parent();
		var this_code = this_obj.attr('code');
		var parent = this_obj.attr('parent');
		var url = "<?php echo $theme_url; ?>"+"/assets/images";
	    var up_s = "<img src='"+url+"/sh_02.png' />";
	    var up = "<img src='"+url+"/sh_03.png' />";
	    var down_s = "<img src='"+url+"/sh_01.png' />";
	    var down = "<img src='"+url+"/sh_04.png' />";
		if(this_obj.attr('parent') == 0){
			this_obj.fadeOut().fadeIn();
			var index = this_obj.find('.number').val();
			if(index){
				var length = $(".categroy_table>tbody").find("tr[parent='0']").length;
				index = parseInt(index)+1;
				if(index == length){
					$(".categroy_table>tbody").append(this_obj);
				}else{
					$(".categroy_table>tbody").find("tr[parent='0']").eq(index).before(this_obj);
				}
				var child_obj = $(".categroy_table>tbody").find("tr[parent='"+this_code+"']");
				this_obj.after(child_obj);
				
				$(".categroy_table>tbody").find("tr[parent='0']").each(function(i){
					$(this).find(".number").val(i+1);
					if(i == 0){
						$(this).find('.up_s').html('');
						$(this).find('.up').html('');
						$(this).find('.down_s').html(down_s);
						$(this).find('.down').html(down);
					}else if(i == length-1){
						$(this).find('.up_s').html(up_s);
						$(this).find('.up').html(up);
						$(this).find('.down_s').html('');
						$(this).find('.down').html('');
					}else{
						$(this).find('.up_s').html(up_s);
						$(this).find('.up').html(up);
						$(this).find('.down_s').html(down_s);
						$(this).find('.down').html(down);
					}
				});
			}
			
		}else{
			var next=this_obj.next(); 
			var down_sort = next.find('.number').val();
		    var up_sort = this_obj.find('.number').val();
		    var next_parent = this_obj.next().next().attr('parent');
		    if(this_obj.next().attr('parent')!=0)  
		    {  	
		    	this_obj.insertAfter(next);  
		    	next.find('.number').val(up_sort);
			    this_obj.find('.number').val(down_sort);
			    if(up_sort == 1){
				    //最顶，需检查排序符合显示
			    	next.find('.up_s').html('');
			    	next.find('.up').html('');
			    	next.find('.down_s').html(down_s);
			    	next.find('.down').html(down);
				}else{
					next.find('.up_s').html(up_s);
					next.find('.up').html(up);
					next.find('.down_s').html(down_s);
					next.find('.down').html(down);
				}
				if(next_parent == 0  || typeof(next_parent)=="undefined"){
					//后面无同类
					this_obj.find('.up_s').html(up_s);
					this_obj.find('.up').html(up);
					this_obj.find('.down_s').html('');
					this_obj.find('.down').html('');
				}else{
					this_obj.find('.up_s').html(up_s);
					this_obj.find('.up').html(up);
					this_obj.find('.down_s').html(down_s);
					this_obj.find('.down').html(down);
				}
		    }
		}

		//修改数据
		<?php $path_url = Yii::app()->createUrl('Shop/UpdateSort');?>
	    $.ajax({
	        url:"<?php echo $path_url;?>",
	        type:'post',
	        data:'shop='+shop+'&act=3&code='+this_code+'&parent='+parent,
	        async:false,
	     	dataType:'json',
	    });
		
	});


	/**全部删除**/
	$("#del_all").click(function(){
		var shop = $("select[name='shop'] option:selected").val();
		var length = $(".categroy_table>tbody>tr").length;
		if(length == 0) return false;
		var query = confirm("确定删除该店铺下的所有分类?");
		if(query == true){
			<?php $path_url = Yii::app()->createUrl('Shop/DelShopCateAll');?>
		    $.ajax({
		        url:"<?php echo $path_url;?>",
		        type:'get',
		        data:'shop='+shop,
		     	dataType:'json',
		     	success:function(data){
			     	alert(data);
			     	alert("删除成功！");
			     }
		    });
		}
	});
});
</script>
