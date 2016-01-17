<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerformanceFilter
 *
 * @author admin
 */
class PerformanceFilter extends CFilter
{
        /**
     * 登录action所在controller的名字
     * @var string
     */
    public $login_controller;
    /**
     * 登录action的名字
     * @var string
     */
    public $login_action;
    
    public function filter($filterChain)
    {
        if(!$this->preFilter($filterChain)){
            if((Yii::app()->controller->id)===$this->login_controller)
                CController::redirect($this->login_action);
            else
                CController::redirect($this->login_controller.'/'.$this->login_action);
        }else{
            $filterChain->run();
        }
    }

    protected function preFilter($filterChain)
    {
        return Yii::app()->user->isGuest;
    }
    
//    protected function preFilter($filterChain)
//    {
//        // 动作被执行之前应用的逻辑
//        return true; // 如果动作不应被执行，此处返回 false
//    }
 
    protected function postFilter($filterChain)
    {
        echo 'b';
        // 动作执行之后应用的逻辑
    }
}

?>
