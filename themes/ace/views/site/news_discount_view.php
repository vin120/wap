<?php
    $this->pageTitle = Yii::t('vcos','服务预订_中华泰山号邮轮');
    $this->pageTag = 'service';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'news_discount';
?>
<?php 
    //navbar 挂件
    $this->widget('navbarWidget');
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
                                            基本信息
                                            <small>
                                                    <i class="icon-double-angle-right"></i>
                                                    最新优惠
                                            </small>
                                    </h1>
                            </div><!-- /.page-header -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <h3>暂无优惠信息！</h3>
                                </div>
                            </div>
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
<script src="<?php echo $theme_url; ?>/assets/js/typeahead-bs2.min.js"></script>
