<?php
    Yii::app()->language = 'zh_cn';

    $this->pageTitle = Yii::t('vcos','查看会员详细信息');
    $this->pageTag = 'index';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'user_list';
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
                            <?php echo yii::t('vcos', '会员管理 ')?>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '查看会员详细信息')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-11" style="padding-left: 5%">
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员号').' : '.$detail['member_code'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员真实姓名').' : '.$detail['cn_name'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员姓名拼音').' : '.$detail['first_name'].' '.$detail['last_name'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '性别').' : '; echo $detail['sex']=='1'?'男':'女';?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '出生日期').':'.date('Y-m-d',$detail['date_of_birth']);?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '出生地').' : '.$detail['birth_place'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '国籍').' : '.$detail['country_name'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '民族').' : '.$detail['nation_name'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '电话号码').' : '.$detail['mobile_number'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '护照号').' : '.$detail['passport_number'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '护照签发日期').':'.date('Y-m-d',$detail['passport_date_issue']);?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '护照过期日期').':'.date('Y-m-d',$detail['passport_expiry_date']);?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '护照签发地').' : '.$detail['passport_place_issue'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '身份证号码').' : '.$detail['resident_id_card'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '智能卡卡号').' : '.$detail['smart_card_number'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员账号').' : '.$detail['member_name'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员邮箱').' : '.$detail['member_email'];?>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-8 col-sm-8 col-md-8 control-label no-padding-right"><?php echo yii::t('vcos', '会员注册日期').':'.date('Y-m-d',$detail['reg_time']);?>
                            </div>
                            
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
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>


