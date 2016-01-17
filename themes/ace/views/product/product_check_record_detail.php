<?php
    $this->pageTitle = Yii::t('vcos','盘点记录详情');
    $theme_url = Yii::app()->theme->baseUrl;
    $menu_type = 'product_check_record';
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
        <style>
        .product_check_table{overflow-y:auto;height:518px;}
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
                                <?php echo yii::t('vcos', '基础数据')?>
                                <small style="cursor:pointer">
                                    <i class="icon-double-angle-right"></i>
                                    <a href="<?php echo Yii::app()->createUrl("Product/product_check_record")?>"><?php echo yii::t('vcos', '盘点记录 ')?></a>
                            </small>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '盘点记录详情')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                            <div class="row">
                                <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <form method="post" action="">
                                                <div class="product_check_table">
                                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo yii::t('vcos', '序号')?></th>
                                                            <th><?php echo yii::t('vcos', '商品编码')?></th>
                                                            <th><?php echo yii::t('vcos', '商品名')?></th>
                                                            <th><?php echo yii::t('vcos', '原库存')?></th>
                                                            <th><?php echo yii::t('vcos', '盘点总数')?></th>
                                                            <th><?php echo yii::t('vcos', '差异')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $inventory_all = 0;
                                                        $check_all = 0;
                                                        $inventory_check = 0;
                                                        foreach ($product_check_record_detail as $key=>$row) { 
                                                        $inventory_all +=  $row['inventory_num'];
                                                        $check_all += $row['check_num'];
                                                        $inventory_check += abs($row['inventory_num']-$row['check_num']);
                                                            ?>
                                                        <tr>
                                                            <td><?php echo ++$key;?></td>
                                                            <td><?php echo $row['product_code'];?></td>
                                                            <td><?php echo $row['product_name'];?></td>
                                                            <td><?php echo $row['inventory_num'];?></td>
                                                            <td><?php echo $row['check_num'];?></td>
                                                            <td><?php echo ($row['inventory_num']-$row['check_num']);?></td>
                                                        </tr>
                                                        <?php }?>
                                                        <tr>
                                                        <td>总和</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $inventory_all;?></td>
                                                        <td><?php echo $check_all;?></td>
                                                        <td><?php echo $inventory_check;?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                 </div>
                                                </form>
                                               
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
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        
    });
</script>
