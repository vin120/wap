<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MembershipService
 *
 * @author Rock
 */
class MembershipService {
    
    public static function getMembershipSex($membership_id){
         $membership = Membership::model()->find(array(
            'select'=>'sex',
            'condition'=>'member_id=:membership_id',
            'params'=>array(':membership_id'=>$membership_id),
         ));
         return $membership;
    }

    public static function checkMembershipCode($membership_code)
    {
        $res_bool = false;
        $len = strlen($membership_code);
        if (12 == $len){
            $prefix_value = substr($membership_code, 0, 10);
            $suffix_value = substr($membership_code, 10);
            $rsp_suffix = self::createCheckValue($prefix_value);
            if ($suffix_value == $rsp_suffix){
                $res_bool = true;
            }
        }
        return $res_bool;       
    }
    
    public static function createCheckValue($member_no)
    {
        $odd_value = 0;//奇数
        $even_value = 0;//偶数
        for ($i = 0; $i<10; $i++){
            //下标0开始，所以奇数是被2整除
            if (0 == $i%2){
                $odd_value += $member_no[$i];
            } else {
                $even_value += $member_no[$i];
            }
        }
        
        if (9 < $odd_value){
            $odd_value = self::getOneValue($odd_value);
        }
        
        if (9 < $even_value){
            $even_value = self::getOneValue($even_value);
        }
        return $odd_value.''.$even_value;
    }
    
    public static function getOneValue($value)
    {
        $len = strlen($value);
        $temp_value = 0;
        for($i=0; $i<$len; $i++){
            $temp_value += substr($value, $i,1);
        }
        if (10<=$temp_value){
            return self::getOneValue($temp_value);
        }else{
            return $temp_value;
        }
    }
    public static function getMembership($membership_id)
    {
        $membership = Membership::model()->findByPk($membership_id);
        
        return $membership;
        
    }
}
