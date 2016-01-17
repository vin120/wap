<?php
    $this->pageTitle = Yii::t('vcos','服务预订_中华泰山号邮轮');
    $this->pageTag = 'service';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'membership_safe';
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
                                            账户安全
                                            <small>
                                                    <i class="icon-double-angle-right"></i>
                                                    密码修改
                                            </small>
                                    </h1>
                            </div><!-- /.page-header -->

                            <div class="row">
                                <div class="col-xs-12 col-sm-9">
                                        <form class="form-horizontal" id="validation-form" action="<?php echo yii::app()->createUrl('site/updatepasswd');?>" method="post">
<!--                                            <div class="form-group">
                                                <label class="control-label col-xs-3 col-sm-3 no-padding-right" style="text-align: right" for="password">原密码:</label>

                                                    <div class="col-xs-8 col-sm-8">
                                                            <div class="clearfix">
                                                                    <input type="password" name="old_password" id="old_password" class="col-xs-12 col-sm-4" />
                                                            </div>
                                                    </div>
                                            </div>-->

                                            <div class="space-2"></div>
                                            <div class="form-group">
                                                    <label class="control-label col-xs-3 col-sm-3 no-padding-right" style="text-align: right" for="password">新密码:</label>

                                                    <div class="col-xs-8 col-sm-8">
                                                            <div class="clearfix">
                                                                    <input type="password" name="password" id="password" class="col-xs-12 col-sm-4" />
                                                            </div>
                                                    </div>
                                            </div>

                                            <div class="space-2"></div>

                                            <div class="form-group">
                                                    <label class="control-label col-xs-3 col-sm-3 no-padding-right" style="text-align: right" for="password2">密码确认:</label>

                                                    <div class="col-xs-8 col-sm-8">
                                                            <div class="clearfix">
                                                                    <input type="password" name="password2" id="password2" class="col-xs-12 col-sm-4" />
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="space-2"></div>
                                            <div class="form-group">
                                                <div class="col-xs-9 col-sm-6" style="text-align: right">
                                                    <button class="btn btn-sm btn-info" type="submit">
                                                    <i class="icon-ok"></i>
                                                    提交
                                                    </button>
                                                    <button class="btn btn-sm" type="reset">
                                                    <i class="icon-undo"></i>
                                                    重置
                                                    </button>
                                                </div>
                                                    
                                            </div>
                                        </form>
                                        
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

<!-- page specific plugin scripts -->

<script src="<?php echo $theme_url; ?>/assets/js/jquery.validate.min.js"></script>


<!-- inline scripts related to this page -->

<script type="text/javascript">
        jQuery(function($) {

            $('#validation-form').validate({
                        errorElement: 'div',
                        errorClass: 'help-block',
                        focusInvalid: false,
                        rules: {
                                password: {
                                        required: true,
                                        minlength: 5
                                },
                                password2: {
                                        required: true,
                                        minlength: 5,
                                        equalTo: "#password"
                                }
                        },

                        messages: {
                                password: {
                                        required: "<?php echo Yii::t('login','密码不能为空!'); ?>",
                                        minlength: "<?php echo Yii::t('login','密码不能小于5位数!'); ?>"
                                },
                                password2: {
                                        required: "<?php echo Yii::t('login','请输入确认密码!'); ?>",
                                        minlength: "<?php echo Yii::t('login','密码不能小于5位数!'); ?>",
                                        equalTo: "<?php echo Yii::t('login','两次输入密码不一致!'); ?>"
                                }
                        },

                        highlight: function (e) {
                                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                        },

                        success: function (e) {
                                $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                                $(e).remove();
                        },

                        errorPlacement: function (error, element) {
                                error.insertAfter(element.parent());
                        },

                        submitHandler: function (form) {
                            form.submit();
                        }
                });
        })
</script>