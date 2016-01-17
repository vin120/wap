<?php
    $this->pageTitle = Yii::t('vcos','评价结果');
    $theme_url = Yii::app()->theme->baseUrl;
    
    $menu_type =  'survey_recode';
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
                                <?php echo yii::t('vcos', '评价与帮助管理')?>
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    <?php echo yii::t('vcos', '评价结果')?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <div class="row">
                            <div class="col-xs-12"><!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                        <select name="survey_sel" style="min-width:200px;position:relative;bottom:5px;">
                                        <option <?php if($survey_but==0){echo "selected='selected'";}?> value="<?php echo Yii::app()->createUrl("Commentandhelp/survey_recode",array('survey'=>0));?>">全部</option>
                                        <?php if($survey) foreach ($survey as $row){
                                        	$url = Yii::app()->createUrl("Commentandhelp/survey_recode",array('survey'=>$row['survey_id']));
                                        ?>
                                        <option <?php if($survey_but==$row['survey_id']){echo "selected='selected'";}?> value="<?php echo $url;?>"><?php echo $row['survey_title']?></option>
                                        <?php }?>
                                        </select>
                                            <form method="post" name="del">
                                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo yii::t('vcos', '序号')?></th>
                                                        <th><?php echo yii::t('vcos', '栏目')?></th>
                                                        <th><?php echo yii::t('vcos', '会员编码')?></th>
                                                        <th><?php echo yii::t('vcos', '评价值')?></th>
                                                        <th><?php echo yii::t('vcos', '创建时间')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($recode as $key=>$row) { ?>
                                                    <tr>
                                                        <td><?php echo ++$key;?></td>
                                                        <td><?php echo $row['survey_title'];?></td>
                                                        <td><?php echo $row['membership_code'];?></td>
                                                        <td><?php echo $row['star_value'];?></td>
                                                        <td><?php echo $row['create_time'];?></td>
                                                        
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                            </form>
                                            
                                            <div class="center">
                                                <?php
                                                $this->widget('MyCLinkPager',array(
                                                    'pages'=>$pages,
                                                    'header'=>false,
                                                    'htmlOptions'=>array('class'=>'pagination'),
                                                    'firstPageLabel'=>yii::t('vcos', '首页'),
                                                    'lastPageLabel'=>yii::t('vcos', '尾页'),
                                                    'prevPageLabel'=>'«',
                                                    'nextPageLabel'=>'»',
                                                    'maxButtonCount'=>5,
                                                    'cssFile'=>false,
                                                    ));
                                                ?>
                                            </div>
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
<script>
jQuery(function($){
	$("select[name='survey_sel']").change(function(){
		var path = $(this).val();
		window.location.href=path;
	});
});
</script>
