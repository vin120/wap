<?php $this->beginContent('//layouts/main'); ?>
<?php
        $theme_url = Yii::app()->theme->baseUrl;
        
?>
<!-- page specific plugin styles -->
<link rel="stylesheet" href="<?php echo $theme_url; ?>/assets/css/jquery-ui-1.10.3.full.min.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>/assets/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>/assets/css/ui.jqgrid.css" />
    
    <?php echo $content; ?>
        
<?php $this->endContent(); ?>

