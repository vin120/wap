<?php
    $this->pageTitle = Yii::t('vcos','服务预订_中华泰山号邮轮');
    $this->pageTag = 'service';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'membership_credit';
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
                                                    我的积分
                                            </small>
                                    </h1>
                            </div><!-- /.page-header -->
                                                       
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="table-responsive">
                                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                            <th class="center">
                                                                    序号
                                                            </th>
                                                            <th>积分来源</th>
                                                            <th>订单号</th>
                                                            <th>订单金额</th>
                                                            <th class="hidden-480">获得积分</th>

                                                            <th>
                                                                    <i class="icon-time bigger-110 hidden-480"></i>
                                                                    获得时间
                                                            </th>
                                                            <th class="hidden-480"></th>

                                                            
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                            <td class="center">
                                                                    <label>
                                                                            <!--<input type="checkbox" class="ace" />-->
                                                                            <span class="lbl"></span>
                                                                    </label>
                                                            </td>

                                                            <td>
                                                                    <a href="#"></a>
                                                            </td>
                                                            <td></td>
                                                            <td class="hidden-480"></td>
                                                            <td></td>

                                                            <td class="hidden-480">
                                                                    <span class="label label-sm label-warning"></span>
                                                            </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
