<?php
    $this->pageTitle = Yii::t('vcos','库存管理');
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'product_inventory';
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
                                <?php echo yii::t('vcos', '基础数据')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '库存管理')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                            <div class="row">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row inventory_table">
                                        <div class="col-xs-12">
                                            <style>
                                               .text_center > input{width:100px;text-align:center;}
                                               .inventory_where{width:100%;padding-bottom:10px;border:1px solid #eee;margin-bottom:10px;}
                                               .tr_left{width:27%;margin:10px 4% 0px 15px;}
                                               .tr_left_s{margin:10px 4% 0px 15px;}
                                               .submit_where_but{border:0px;position:absolute;bottom:15px;right:15px;margin-right:15px;cursor:pointer;width:100px;height:35px;line-height:35px;text-align:center;background:#6faed9;}
                                            </style>
                                            <div class="table-responsive">
                                                <form action="<?php echo Yii::app()->createUrl('Product/product_inventory');?>" method="post" >
                                                <div class='inventory_where' style="position:relative;">
                                                    <label class="tr_left">商品编码：<input type="text" name="code" value="<?php if($code_but!=''){echo $code_but;}?>"/></label>
                                                    <label class="tr_left">库存总数：
                                                        <input type="text" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" maxlength='10' style="width:20%;margin-right:2px;" value="<?php if($min_but!=''){echo $min_but;}?>" name="min" />
                                                        到<input type='text' onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"  maxlength='10' style="width:20%;margin-left:9px;" value="<?php if($max_but!=''){echo $max_but;}?>" name='max' />
                                                    </label>
                                                    <label class="tr_left">
                                                        <input type="radio" check='no' style="margin-right: 3px;" name="type" <?php if($type_but==1){echo "checked='checked'";}?> value='1'/>在售商品
                                                        <input type="radio" check='no' style="margin-left: 10px;margin-right:3px;" name="type" <?php if($type_but==2){echo "checked='checked'";}?> value="2"/>待售商品
                                                    </label>
                                                    <label class="tr_left_s">商品分类：
                                                    <select name="categroy_one" style="width:220px;margin-left:-4px;margin-right:3px;">
                                                        <option value='0'>全部</option>
                                                        <?php foreach ($cat1_sel as $row){?>
                                                        <option <?php if($category1_but==$row['category_code']){echo "selected='selected'";}?> value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                                        <?php }?>
                                                    </select>
                                                    <select class="<?php if($cat2_sel==''){echo 'hidden';}?>" name="categroy_two"  style="width:220px;margin-right:3px;">
                                                        <option value='0'>全部</option>
                                                        <?php if($cat2_sel!=''){foreach ($cat2_sel as $row){?>
                                                        <option <?php if($category2_but==$row['category_code']){echo "selected='selected'";}?> value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                                        <?php }}?>
                                                    </select>
                                                    <select  class="<?php if($cat3_sel==''){echo 'hidden';}?>" name="categroy_three"  style="width:220px;margin-right:3px;">
                                                        <option value='0'>全部</option>
                                                        <?php if($cat3_sel!=''){foreach ($cat3_sel as $row){?>
                                                        <option <?php if($category_but==$row['category_code']){echo "selected='selected'";}?> value="<?php echo $row['category_code']?>"><?php echo $row['name']?></option>
                                                        <?php }}?>
                                                    </select>
                                                    
                                                    </label>
                                                    
                                                    <input value="查询" type='submit' class="submit_where_but" />
                                                </div>
                                                </form>
                                                <input type="hidden" name='inventory_page' value="<?php echo $inventory_page;?>"/>
                                                <form method="post" name="">
                                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">
                                                                    <label>
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"></span>
                                                                    </label>
                                                            </th>
                                                            <th><?php echo yii::t('vcos', '商品编码')?></th>
                                                            <th><?php echo yii::t('vcos', '商品名称')?></th>
                                                            <th><?php echo yii::t('vcos', '状态')?></th>
                                                            <th><?php echo yii::t('vcos', '库存总数')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $time = date("Y-m-d H:i:s",time());
                                                        foreach ($product as $key=>$row) { 
                                                            if($row['sale_start_time']<=$time && $row['sale_end_time']>=$time){
                                                                $status = "在售";
                                                            }else{
                                                                $status = "待售";
                                                            }
                                                            
                                                            ?>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" name="ids[]" value="<?php echo $row['product_id'];?>" class="ace isclick" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td><?php echo $row['product_code'];?></td>
                                                            <td><?php echo $row['product_name'];?></td>
                                                            <td><?php echo $status;?></td>
                                                            <td class="text_center"><input  maxlength='10'  class='inventory_input' type='text' name='inventory[]' value="<?php echo $row['inventory_num'];?>"></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                                <div class="submit_but" style="float: right;width:100px;height:35px;line-height:35px;background:#6faed9;cursor:pointer;text-align:center;">提交</div>
                                                </form>
                                                <!-- 分页 -->
                                                <div class="center" id="page_div"> </div>
                                             
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.page-content -->
                </div><!-- /.main-content -->
                
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
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jqPaginator.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
        });
       /* $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
        _title: function(title) {
            var $title = this.options.title || '&nbsp;'
            if( ("title_html" in this.options) && this.options.title_html == true )
                title.html($title);
            else title.text($title);
            }
        }));*/

        /**分页**/
        <?php if($product_count >1){?>
        $('#page_div').jqPaginator({
            totalPages: <?php echo $product_count;?>,
            visiblePages: 5,
            //currentPage: 3,
            wrapper:'<ul class="pagination"></ul>',
            first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
            prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
            next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
            last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
            page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
            onPageChange: function (num) {
                var this_page = $("input[name='inventory_page']").val();
                if(this_page==num){$("input[name='inventory_page']").val('fail');return false;}

                var mydate = new Date();
                var day_s = mydate.getFullYear()+'-'+Appendzero(mydate.getMonth()+1)+'-'+Appendzero(mydate.getDate())+' '+Appendzero(mydate.getHours())+':00';
                
                
                <?php $path_url = Yii::app()->createUrl('Product/GetProductInventoryPage');?>
                var data = 'pag='+num;
                <?php if($code_but!=''){?>
                data += '&code='+<?php echo $code_but;?>;
                <?php }?>
                <?php if($min_but!=''){?>
                data += '&min='+<?php echo $min_but;?>;
                <?php }?>
                <?php if($max_but!=''){?>
                data += '&max='+<?php echo $max_but;?>;
                <?php }?>
                <?php if($type_but!=''){?>
                data += '&type='+<?php echo $type_but;?>;
                <?php }?>
                <?php if($category1_but!=''){
                if($category2_but!='' && $category_but==''){?>
                    data += '&category_one='+<?php echo $category1_but;?>+'&category_two='+<?php echo $category2_but;?>;
                <?php }else if($category2_but!='' && $category_but!=''){?>
                    data += '&category_one='+<?php echo $category1_but;?>+'&category_two='+<?php echo $category2_but;?>+'&category_three'+<?php echo $category_but;?>;  
                <?php }else if($category2_but == ''){?>
                    data += '&category_one='+<?php echo $category1_but;?>;  
                <?php }?>
                <?php }?>
                $.ajax({
                    url:"<?php echo $path_url;?>",
                    type:'post',
                    data:data,
                    dataType:'json',
                    success:function(data){
                        var str = '';
                        if(data != 0){
                            $.each(data,function(key){
                                if(data[key]['sale_start_time']<=day_s && data[key]['sale_end_time']>=day_s){
                                    var status = "在售";
                                }else{
                                    var status = "待售";
                                }
                                // str += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                                str += "<tr><td class='center'><label>";
                                str += "<input type='checkbox' name='ids[]' value='"+data[key]['product_id']+"' class='ace isclick' />";
                                str += "<span class='lbl'></span></label></td>";    
                                str += "<td>"+data[key]['product_code']+"</td>";
                                str += "<td>"+data[key]['product_name']+"</td>";
                                str += "<td>"+status+"</td>";
                                str += "<td class='text_center'><input maxlength='10'  class='inventory_input' type='text' name='inventory[]' value='"+data[key]['inventory_num']+"'></td>";
                                str += "</tr>";
                              });
                            $(".inventory_table table>tbody").html(str);
                        }
                    }      
                });
            }
        });
        <?php }?>


        /**文本框改变**/
        $(document).on('change','.inventory_table input[class="inventory_input"]',function(e){
            $(this).parent().parent().find("input[type='checkbox']").prop("checked",true);
        });

        /**提交修改操作**/
        $(".inventory_table .submit_but").click(function(){
            var ids = $(".inventory_table table>tbody input[type='checkbox']:checked");
            if(ids.length == 0){alert("请选择修改项!");return false;}
            var ids_str = '';
            var inventory_str = '';
            var re = /^[0-9]*[1-9][0-9]*$/;
            var flag = 1;
            $.each(ids,function(key){
                ids_str += $(this).val()+',';
                var inventory = $(this).parent().parent().parent().find("input[class='inventory_input']").val();
                if(inventory == '' || !(re.test(inventory)) || inventory < 0){
                    alert("勾选的修改项值不能为空，且必须是大于0的整数!");
                    flag = 0;
                    return false;
                }
                inventory_str += inventory+',';
            });
            if(flag == 0) return false;
            ids_str = ids_str.substring(0,ids_str.length-1);
            inventory_str = inventory_str.substring(0,inventory_str.length-1);
            
            <?php $path_url = Yii::app()->createUrl('Product/UpdateProductInventory');?>
            $.ajax({
                url:"<?php echo $path_url;?>",
                type:'post',
                data:'ids='+ids_str+'&inventory='+inventory_str,
                dataType:'json',
                success:function(data){
                    if(data == 1){
                        alert("修改成功!");
                        $(".inventory_table table>tbody input[type='checkbox']:checked").removeAttr("checked");
                    }
                }      
            });
        });


         /**筛选:分类筛选:一级**/
        $("select[name='categroy_one']").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
                $("select[name='categroy_two']").addClass('hidden');
                $("select[name='categroy_three']").addClass('hidden');
                return false;
            }
            $("select[name='categroy_two']").removeClass('hidden');
            var str = '';
            var str_ch = '';
            var str_pr = '';
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
                    $("select[name='categroy_two']").html(str);
                    $("select[name='categroy_three']").addClass('hidden');
                    /*$.ajax({
                        url:"<php echo $path_url;?>",
                        type:'get',
                        data:'parent_code='+data[0]['category_code'],
                        dataType:'json',
                        success:function(data){
                            $.each(data,function(key){  
                               str_ch += "<option value="+data[key]['category_code']+">"+data[key]['name']+"</option>"; 
                            });
                            $("select[name='categroy_three']").html(str_ch);
                        }        
                 });*/
                }        
            });

        });

        /**筛选:改变分类二级,获取三级**/
        $("select[name='categroy_two']").change(function(){
            var this_code = $(this).val();
            if(this_code == 0){
                $("select[name='categroy_three']").addClass('hidden');
                return false;
            }
            $("select[name='categroy_three']").removeClass('hidden');
            var str = '';
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
                    $("select[name='categroy_three']").html(str);
                    
                }      
            });
        });

        /**在售和待售选择**/
        $("input[name='type']").click(function(){
            var val = $(this).val();
            var check = $(this).attr('check');
            if(check == 'no'){
                $(this).attr('check','yes');
                if(val==1){$("input[name='type'][value='2']").attr('check','no');}
                if(val==2){$("input[name='type'][value='1']").attr('check','no');}
            }else if(check == 'yes'){
                $(this).attr('check','no');
                $(this).removeAttr('checked');
            }
        });
        
    });
    function Appendzero (obj) {
      if (obj < 10) return "0"+obj; else return obj;
  }
</script>
