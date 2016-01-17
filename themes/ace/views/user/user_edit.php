<?php
    Yii::app()->language = 'zh_cn';

    $this->pageTitle = Yii::t('vcos','修改用户信息');
    $this->pageTag = 'index';
    
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type = 'user_detail';
?>
<link rel="stylesheet"  href="<?php echo $theme_url; ?>/assets/css/daterangepicker.css" />
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
                            <?php echo yii::t('vcos', '会员管理')?>
                            <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '修改用户信息')?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-11">
                            <form class="form-horizontal" role="form" method="post" action="" id="edit">
                                <input type="hidden" id="member_id" name="member_id" value="<?php echo $detail['member_code'];?>" />
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '会员真实姓名')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="cn_name" placeholder="<?php echo yii::t('vcos', '会员真实姓名')?>" class="col-xs-10 col-sm-8 col-md-8" name="cn_name" value="<?php echo $detail['cn_name'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '会员姓氏')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="last_name" placeholder="<?php echo yii::t('vcos', '会员姓氏')?>" class="col-xs-10 col-sm-8 col-md-8" name="last_name" value="<?php echo $detail['last_name'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '会员名字')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="first_name" placeholder="<?php echo yii::t('vcos', '会员名字')?>" class="col-xs-10 col-sm-8 col-md-8" name="first_name" value="<?php echo $detail['first_name'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '性别')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7" style="margin-top: 4px;">
                                        <input type="radio" id="sex" name="sex" value="1" <?php if($detail['sex']=='1'){echo 'checked="checked"';}?> />男
                                        <input type="radio" id="sex" name="sex" value="2" <?php if($detail['sex']=='2'){echo 'checked="checked"';}?> />女
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '出生日期')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="dob" placeholder="<?php echo yii::t('vcos', '出生日期')?>" class="col-xs-10 col-sm-8 col-md-8 date-picker" name="dob" value="<?php echo date('Y-m-d',$detail['date_of_birth']);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '出生地')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="birth_place" placeholder="<?php echo yii::t('vcos', '出生地')?>" class="col-xs-10 col-sm-8 col-md-8" name="birth_place" value="<?php echo $detail['birth_place'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '国籍')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <select class="col-xs-10 col-sm-8 col-md-8" name="country">
                                            <?php foreach ($country as $row){ ?>
                                            <option value="<?php echo $row['country_short_code']?>" <?php if($detail['country_code']==$row['country_short_code']){echo 'selected';}?> ><?php echo $row['country_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '民族')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <select class="col-xs-10 col-sm-8 col-md-8" name="nation">
                                            <?php foreach ($nation as $row){ ?>
                                            <option value="<?php echo $row['nation_code']?>" <?php if($detail['nation_code']==$row['nation_code']){echo 'selected';}?> ><?php echo $row['nation_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '电话号码')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="mobile" placeholder="<?php echo yii::t('vcos', '电话号码')?>" class="col-xs-10 col-sm-8 col-md-8" name="mobile" value="<?php echo $detail['mobile_number'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '护照号')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="passport" placeholder="<?php echo yii::t('vcos', '护照号')?>" class="col-xs-10 col-sm-8 col-md-8" name="passport" value="<?php echo $detail['passport_number'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '护照有效日期')?>：</label>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control" type="text" name="passport_validate" id="id-date-range-picker-1" value="<?php echo date('Y-m-d',$detail['passport_date_issue']).' - '.date('Y-m-d',$detail['passport_expiry_date'])?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '护照签发地')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="issue_place" placeholder="<?php echo yii::t('vcos', '护照签发地')?>" class="col-xs-10 col-sm-8 col-md-8" name="issue_place" value="<?php echo $detail['passport_place_issue'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '身份证号码')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="ic_number" placeholder="<?php echo yii::t('vcos', '身份证号码')?>" class="col-xs-10 col-sm-8 col-md-8" name="ic_number" value="<?php echo $detail['resident_id_card'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '会员账号')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="member_name" placeholder="<?php echo yii::t('vcos', '会员账号')?>" class="col-xs-10 col-sm-8 col-md-8" name="member_name" value="<?php echo $detail['member_name'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-md-2 control-label no-padding-right"><?php echo yii::t('vcos', '会员邮箱')?>：</label>
                                    <div class="col-xs-8 col-sm-8 col-md-7">
                                        <input type="text" id="email" placeholder="<?php echo yii::t('vcos', '会员邮箱')?>" class="col-xs-10 col-sm-8 col-md-8" name="email" value="<?php echo $detail['member_email'];?>" />
                                    </div>
                                </div>
                                <input type="submit" value="<?php echo yii::t('vcos', '提交')?>" id="submit" class="btn btn-primary" style="margin-left: 45%"/>
                                <a href="<?php echo Yii::app()->createUrl("User/resetpassword?id={$detail['member_id']}");?>" class="reset btn btn-warning"><?php echo yii::t('vcos', '重设密码')?></a>
                            </form>
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
<script src="<?php echo $theme_url; ?>/assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/moment.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/daterangepicker.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/date-time/card.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace-elements.min.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/ace.min.js"></script>
<script type="text/javascript">
jQuery(function($){
    // 身份证号码验证 
    jQuery.validator.addMethod("isIdCardNo", function(value, element) { 
        return this.optional(element) || idCardNoUtil.checkIdCardNo(value);     
    }, "<?php echo yii::t('vcos', '请输入正确的身份证号码')?>"); 
    
    //护照号验证
    jQuery.validator.addMethod("passport", function(value, element) {   
        var str = /^[A-Za-z0-9]+$/;
        return this.optional(element) || (str.test(value));
    }, "<?php echo yii::t('vcos', '请输入正确的护照号')?>");
    
   // 手机号码验证 
    jQuery.validator.addMethod("isMobile", function(value, element) { 
        var length = value.length; 
        var mobile = /^(1((3\d)|(4[57])|(5[01256789])|(8\d))\d{8})$/; 
        return this.optional(element) || (length == 11 && mobile.test(value)); 
    }, "<?php echo yii::t('vcos', '请输入正确的手机号码')?>"); 
    
    $("#edit").validate({
        rules: {
            cn_name:'required',
            laet_name:'required',
            first_name:'required',
            dob:{  
                required: true,
                dateISO:true
            },
            birth_place:'required',
            mobile:{  
                isMobile:true
            },
            passport:{  
                required: true,
                maxlength:12,
                passport:true
            },
            issue_place:'required',
            ic_number:{  
                required: true,
                isIdCardNo:true
            }
        },
        messages:{
            cn_name:'<?php echo yii::t('vcos', '请输入会员真实姓名')?>',
            laet_name:'<?php echo yii::t('vcos', '请输入会员姓氏')?>',
            first_name:'<?php echo yii::t('vcos', '请输入会员真实名字')?>',
            dob:{
                required: "<?php echo yii::t('vcos', '请输入日期')?>",
                dateISO: "<?php echo yii::t('vcos', '请输入正确的日期')?>"
            },
            birth_place:'<?php echo yii::t('vcos', '请输入出生地')?>',
            passport:{
                required:"<?php echo yii::t('vcos', '请输入护照编号')?>",
                maxlength:"<?php echo yii::t('vcos', '请输入正确的护照号')?>"
            },
            issue_place:'<?php echo yii::t('vcos', '请输入护照签发地')?>',
            ic_number:{
                required: "<?php echo yii::t('vcos', '请输入身份证号码')?>"
            }
        }
    });
    $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });
    $('#id-date-range-picker-1').daterangepicker({
        dateFormat:'yy-mm-dd'
    });
});
</script>

