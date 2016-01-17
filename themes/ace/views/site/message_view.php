<?php
    $this->pageTitle = Yii::t('vcos','中华泰山号邮轮');
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = isset($menu_type) ? $menu_type : '';
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
                            <div class="row">
                                    <div class="col-xs-12">
                                            <!-- PAGE CONTENT BEGINS -->

                                            <div class="error-container">
                                                    <div class="well">
                                                            <h1 class="green lighter smaller">
                                                                    <span class="blue bigger-125">
                                                                            <i class="icon-sitemap"></i>
                                                                            
                                                                    </span>
                                                                    <?php echo $message_info; ?>
                                                            </h1>

                                                            <hr />
                                                            <div>
                                                                    <div class="space"></div>
                                                                    <h4 class="smaller"><?php echo $message_info; ?>，您可以:</h4>

                                                                    <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                                                            <li>
                                                                                    <i class="icon-hand-right blue"></i>
                                                                                    <a href="<?php echo yii::app()->createUrl('site/index');?>">继续查看基本信息</a>
                                                                            </li>

                                                                            <li>
                                                                                    <i class="icon-hand-right blue"></i>
                                                                                    <a href="<?php echo yii::app()->createUrl('service/index');?>">订购邮轮服务</a>
                                                                            </li>

                                                                            <li>
                                                                                    <i class="icon-hand-right blue"></i>
                                                                                    <a href="">查看邮轮介绍</a>
                                                                            </li>
                                                                    </ul>
                                                            </div>

                                                            <hr />
                                                            <div class="space"></div>

                                                            <div class="center">
                                                                <a href="<?php echo yii::app()->createUrl((empty($res_action) ? 'site/index' : 'service/'.$res_action));?>" class="btn btn-primary">
                                                                            <i class="icon-ok"></i>
                                                                            确认
                                                                    </a>
                                                            </div>
                                                    </div>
                                            </div><!-- PAGE CONTENT ENDS -->
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
<script src="<?php echo $theme_url; ?>/assets/js/typeahead-bs2.min.js"></script>
