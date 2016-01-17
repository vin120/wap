<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of breadcrumbWidget
 *
 * @author Rock.Lei
 */
class ConfirmWidget extends CWidget
{
    public $div_id;
    public $title_id;
    public $title_content;
    public $confirm_id;
    public function run()
    {
        $this->render('confirm_view',array('div_id'=>$this->div_id,'title_id'=>$this->title_id,'title_content'=>$this->title_content,'confirm_id'=>$this->confirm_id));  
    }
}

?>
