var $form = $('#<?php echo $form_id?>');
var file_input = $form.find('input[type=file]');
var is_require = $form.find('input[type=file]').attr('img_png');
var upload_in_progress = false;

file_input.ace_file_input({
    style : 'well',
    btn_choose : '<?php echo yii::t('vcos', '点击选择或者拖拽图片到这里')?>',
    btn_change: null,
    droppable: true,
    thumbnail: 'large',

    before_remove: function() {
        if(upload_in_progress){
            return false;//if we are in the middle of uploading a file, don't allow resetting file input
            }
        return true;
    },

    before_change: function(files, dropped) {
        var file = files[0];
        if(typeof(is_require)=="undefined"){
	        if(typeof file == "string") {//files is just a file name here (in browsers that don't support FileReader API)
	            if(! (/\.(jpe?g|png|gif)$/i).test(file) ) {
	                alert('<?php echo yii::t('vcos', '你选择的不是图片文件！')?>');
	                return false;
	            }
	        }
	        else {
	            var type = $.trim(file.type);
	            if((type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type))||( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name))){
	                alert('<?php echo yii::t('vcos', '你选择的不是图片文件！')?>');
	                return false;
	            }
	            if( file.size > 3*1024*1024 ) {//~100Kb
	                alert('<?php echo yii::t('vcos', '文件大小不能超过3MB！')?>')
	                return false;
	            }
	        }
        }else{
        	if(typeof file == "string") {//files is just a file name here (in browsers that don't support FileReader API)
	            if(! (/\.(png)$/i).test(file) ) {
	                alert('<?php echo yii::t('vcos', '只能选择png格式的图片文件！')?>');
	                return false;
	            }
	        }
	        else {
	            var type = $.trim(file.type);
	            if((type.length > 0 && ! (/^image\/(png)$/i).test(type))||( type.length == 0 && ! (/\.(png)$/i).test(file.name))){
	                alert('<?php echo yii::t('vcos', '只能选择png格式的图片文件！')?>');
	                return false;
	            }
	            if( file.size > 3*1024*1024 ) {//~100Kb
	                alert('<?php echo yii::t('vcos', '文件大小不能超过3MB！')?>')
	                return false;
	            }
	        }
        }
        return true;
    }
});