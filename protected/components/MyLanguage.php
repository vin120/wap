<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyLanguage
 *
 * @author Rock.Lei
 */
class MyLanguage {
    
    public static function setLanguage()
    {
    	
        
        $cookie = Yii::app()->request->getCookies();
        if(isset($_GET['lang'])&&$_GET['lang']!="")   //通过lang参数识别语言   
        {
            Yii::app()->language=$_GET['lang'];  
            $cookie=new CHttpCookie('my_language', $_GET['lang']);  
            $cookie->expire =time()+60*60*6;  
            Yii::app()->request->cookies['my_language']=$cookie;              

        }elseif(isset($cookie['my_language']) && $cookie['my_language']!="")   //通过$_COOKIE['lang']识别语言   
        {
            $temp_lang = $cookie['my_language']->value;
            Yii::app()->language=$temp_lang; 
        }else{
            //通过系统或浏览器识别语言   
            $lang=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);   
            Yii::app()->language=strtolower(str_replace('-','_',$lang[0]));   
        }
    }
}