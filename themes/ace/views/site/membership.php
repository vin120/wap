<?php
$this->pageTitle = Yii::t('vcos', '中华泰山号邮轮');
$theme_url = Yii::app()->theme->baseUrl;

$menu_type = 'membership_info';
?>
<?php
//navbar 挂件
$this->widget('navbarWidget');
?>                

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <?php
        //菜单挂件
        $this->widget('menuWidget', array('menu_type' => $menu_type));
        ?>
        <div class="main-content">

            <?php
            //面包屑挂件
            $this->widget('breadcrumbWidget');
            ?>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        个人信息
                        <small>
                            <i class="icon-double-angle-right"></i>
                            会员基本信息
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> 姓名： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['cn_name']; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> 会员号： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['member_code']; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> 出生日期： </div>

                                <div class="profile-info-value">
                                    <span><?php echo date('Y-m-d', $membership['date_of_birth']); ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> 护照号： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['passport_number']; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> 手机号： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['mobile_number']; ?>&nbsp;</span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> 邮箱： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['member_email']; ?>&nbsp;</span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> 余额： </div>

                                <div class="profile-info-value">
                                    <span><?php echo Yii::app()->getNumberFormatter()->format('￥#,###.##', $membership['member_money'] / 100); ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> 积分： </div>

                                <div class="profile-info-value">
                                    <span><?php echo $membership['member_credit']; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="hr hr-8 dotted"></div>

                        <!--                                        <div class="profile-user-info">
                                                                        <div class="profile-info-row">
                                                                                <div class="profile-info-name"> 房间类型： </div>
                        
                                                                                <div class="profile-info-value">
                                                                                        <span>双人间</span>
                                                                                </div>
                                                                        </div>
                                                                        
                                                                        <div class="profile-info-row">
                                                                                <div class="profile-info-name"> 入住房间： </div>
                        
                                                                                <div class="profile-info-value">
                                                                                        <span>房号：C2010</span><span>床位：1</span>
                                                                                </div>
                                                                        </div>
                                                                </div>-->
                    </div><!-- /span -->
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
    window.jQuery || document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if ("ontouchend" in document)
        document.write("<script src='<?php echo $theme_url; ?>/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="<?php echo $theme_url; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/typeahead-bs2.min.js"></script>
