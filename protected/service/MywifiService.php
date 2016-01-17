<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MywifiService
 *
 * @author Rock.Lei
 */
class MywifiService {
    
    public static function createWifiservice($membership,$wifi_service_name,$wifi_service_price,$wifi_session_time,$wifi_login_url,$aam_param_array)
    {
        $res_wifi_state = false;
        //请求AAM Log记录在事务之前开启
        $wifiAamRequest = new WifiAamRequest();
        $transaction = Yii::app()->db->beginTransaction();
        $wifi_service_price = $wifi_service_price*100;//转为分为单位
        try{
            $start_time = time();
            $wifiAamRequest->request_time = $start_time;
            $wifiAamRequest->request_url = $wifi_login_url.'|'.MyString::ip();

            $call_back_xml = MyString::curl_file_get_contents($wifi_login_url, 15);

            $end_time = time();
            $wifiAamRequest->membership_id= $membership->member_id;
            $wifiAamRequest->membership_code= $membership->member_code;
            $wifiAamRequest->response_time= $end_time;
            $wifiAamRequest->use_time= $end_time-$start_time;
            $wifiAamRequest->response_parameter = $call_back_xml;
            if(!empty ($call_back_xml)){
                $xml = new SimpleXMLElement($call_back_xml);
    //            $user_name = trim($xml->username);
    //            $message = trim($xml->message);
                $error_code = trim($xml->errcode);
                if ('0' == $error_code){
                    $res_wifi_state = '1';
                    //记录用户开通wifi
                    $wifiService = WifiService::model()->find(array(
                        'condition'=>'membership_code=:membership_code',
                        'params'=>array(':membership_code'=>$membership->member_code),

                    ));
                    if (empty($wifiService))
                    {
                        $wifiService = new WifiService();
                        $wifiService->membership_id = $membership->member_id;
                        $wifiService->membership_code = $membership->member_code;
                        $wifiService->total_wifi_time = $wifi_session_time;
                        if (!empty($membership->mobile_number)){
                            $wifiService->mobile_number = $membership->mobile_number;
                        }
                    }else{
                        $wifiService->total_wifi_time += $wifi_session_time;
                    }
                    $wifiService->save();
                    //wifi订单生成
                    $wifiServiceOrder = new WifiServiceOrder();
                    $wifiServiceOrder->membership_id = $membership->member_id;
                    $wifiServiceOrder->membership_code = $membership->member_code;
                    $wifiServiceOrder->wifi_service_name = $wifi_service_name;
                    $wifiServiceOrder->wifi_service_price = $wifi_service_price;
                    $wifiServiceOrder->wifi_service_time = $wifi_session_time;
                    $wifiServiceOrder->wifi_order_number = date('Ymd').$membership->member_id.rand(10, 99);
                    $wifiServiceOrder->wifi_order_time = time();
                    $wifiServiceOrder->order_price = $wifi_service_price;
                    $wifiServiceOrder->discount_price = $wifi_service_price;
                    $wifiServiceOrder->pay_price = $wifi_service_price;
                    $wifiServiceOrder->wifi_order_state = 1;
                    $wifiServiceOrder->save();
                    //wifi连接状态
                    $wifiConnectLog = new WifiConnectLog();
                    $wifiConnectLog->membership_id = $membership->member_id;
                    $wifiConnectLog->membership_code = $membership->member_code;
                    $wifiConnectLog->wifi_service_name = $wifi_service_name;
                    $wifiConnectLog->wifi_time = $wifi_session_time;
                    $wlanuserip = isset($aam_param_array['wlanuserip']) ? $aam_param_array['wlanuserip'] : '';
                    $wlanapmac = isset($aam_param_array['wlanapmac']) ? $aam_param_array['wlanapmac'] : '';
                    $wlanacip = isset($aam_param_array['wlanacip']) ? $aam_param_array['wlanacip'] : '';
                    $ssid = isset($aam_param_array['ssid']) ? $aam_param_array['ssid'] : '';
                    $wifiConnectLog->wlanacip = $wlanacip;
                    $wifiConnectLog->ssid= $ssid;
                    
                    $wifiConnectLog->ip_address = $wlanuserip;
                    $wifiConnectLog->mac_address = $wlanapmac;
                    $wifiConnectLog->wifi_login_time = time();
                    $wifiConnectLog->wifi_logout_time = 0;
                    $wifiConnectLog->wifi_online_time = 0;
                    $wifiConnectLog->exit_type = 0;
                    $wifiConnectLog->save();                    
                }else{
                    $res_wifi_state = $call_back_xml;
                }
                $wifiAamRequest->request_state = 0;
            }else{
                $res_wifi_state = '请求超时';
                $wifiAamRequest->request_state = 1;
            }
            //提交事务
            $transaction->commit();
        } catch (Exception $exc) {
            //异常回滚事务
            $transaction->rollback();
        }
        $wifiAamRequest->save();
        return $res_wifi_state;
    }
    
    public static function continueWifiLogin($membership,$wifi_service_name, $wifi_session_time,$wifi_login_url,$aam_param_array)
    {
        $res_wifi_state = false;
        //请求AAM Log记录在事务之前开启
        $wifiAamRequest = new WifiAamRequest();

        $start_time = time();
        $wifiAamRequest->request_time = $start_time;
        $wifiAamRequest->request_url = $wifi_login_url.'|'.MyString::ip();

        $call_back_xml = MyString::curl_file_get_contents($wifi_login_url, 15);
        
        $end_time = time();
        $wifiAamRequest->membership_id= $membership->member_id;
        $wifiAamRequest->membership_code= $membership->member_code;
        $wifiAamRequest->response_time= $end_time;
        $wifiAamRequest->use_time= $end_time-$start_time;
        $wifiAamRequest->response_parameter = $call_back_xml;
        if(!empty ($call_back_xml)){
            $xml = new SimpleXMLElement($call_back_xml);
            $error_code = trim($xml->errcode);
            if ('0' == $error_code){
                $res_wifi_state = '1';

                //wifi连接状态
                $wifiConnectLog = new WifiConnectLog();
                $wifiConnectLog->membership_id = $membership->member_id;
                $wifiConnectLog->membership_code = $membership->member_code;
                $wifiConnectLog->wifi_service_name = $wifi_service_name;
                $wifiConnectLog->wifi_time = $wifi_session_time;
                $wlanuserip = isset($aam_param_array['wlanuserip']) ? $aam_param_array['wlanuserip'] : '';
                $wlanapmac = isset($aam_param_array['wlanapmac']) ? $aam_param_array['wlanapmac'] : '';
                $wlanacip = isset($aam_param_array['wlanacip']) ? $aam_param_array['wlanacip'] : '';
                $ssid = isset($aam_param_array['ssid']) ? $aam_param_array['ssid'] : '';
                $wifiConnectLog->wlanacip = $wlanacip;
                $wifiConnectLog->ssid= $ssid;
                    
                $wifiConnectLog->ip_address = $wlanuserip;
                $wifiConnectLog->mac_address = $wlanapmac;
                $wifiConnectLog->wifi_login_time = time();
                $wifiConnectLog->wifi_logout_time = 0;
                $wifiConnectLog->wifi_online_time = 0;
                $wifiConnectLog->exit_type = 0;
                $wifiConnectLog->save();                    
            }elseif('2' == $error_code)
            {
                $res_wifi_state = '1';
                $wifiConnectLog = WifiConnectLog::model()->find(array(
                    'condition'=>'membership_id=:membership_id',
                    'params'=>array(':membership_id'=>$membership->member_id),
                    'order' => 'id desc',
                    'limit' => 1,
                ));
                $wifiConnectLog->exit_type = 0;
                $wifiConnectLog->save();
            }
            $wifiAamRequest->request_state = 0;
        }else{
            $wifiAamRequest->request_state = 1;
        }
       
        $wifiAamRequest->save();
        return $res_wifi_state;
    }
    
    
     public static function WifiLogOff($membership,$wifi_service_name, $wifi_session_time,$wifi_logoff_url,$aam_param_array)
    {
        $res_wifi_state = false;
        //请求AAM Log记录在事务之前开启
        $wifiAamRequest = new WifiAamRequest();

        $start_time = time();
        $wifiAamRequest->request_time = $start_time;
        $wifiAamRequest->request_url = $wifi_logoff_url;

        $call_back_xml = MyString::curl_file_get_contents($wifi_logoff_url, 15);

        $end_time = time();
        $wifiAamRequest->membership_id= $membership->member_id;
        $wifiAamRequest->membership_code= $membership->member_code;
        $wifiAamRequest->response_time= $end_time;
        $wifiAamRequest->use_time= $end_time-$start_time;
        $wifiAamRequest->response_parameter = $call_back_xml;
        if(!empty ($call_back_xml)){
            $xml = new SimpleXMLElement($call_back_xml);
            $error_code = trim($xml->errcode);
            if ('0' == $error_code){
                $res_wifi_state = '1';                 
            }elseif ('1' == $error_code){
                $res_wifi_state = '2';
            }
            $wifiAamRequest->request_state = 0;
        }else{
            $wifiAamRequest->request_state = 1;
        }
       
        $wifiAamRequest->save();
        return $res_wifi_state;
    }
    
    public static function createWifiLoginUrl($membership, $wifi_session_time, $aam_conf_array, $aam_param_array)
    {
        $wifi_login_url = $aam_conf_array['wifi_login_url'];
        $wlanuserip = isset($aam_param_array['wlanuserip']) ? $aam_param_array['wlanuserip'] : '';
        $wlanacip = isset($aam_param_array['wlanacip']) ? $aam_param_array['wlanacip'] : '';
        $wlanapmac = isset($aam_param_array['wlanapmac']) ? $aam_param_array['wlanapmac'] : '';
        $ssid = isset($aam_param_array['ssid']) ? $aam_param_array['ssid'] : '';
        
        $wifi_login_url .= '?username='.$membership->member_code.'&maxsessiontime='.$wifi_session_time.'&policy='.$aam_conf_array['wifi_policy'];

        if(!empty($wlanuserip))
        {
            $wifi_login_url .= '&wlanuserip='.$wlanuserip;
        }
        if(!empty($wlanacip))
        {
            $wifi_login_url .= '&wlanacip='.$wlanacip;
        }
        if(!empty($wlanapmac))
        {
            $wifi_login_url .= '&wlanapmac='.$wlanapmac;
        }
        if(!empty($ssid))
        {
            $wifi_login_url .= '&ssid='.$ssid;
        }
        return $wifi_login_url;
    }
    
    public static function createWifiLogoffUrl($membership, $wifi_session_time, $aam_conf_array, $aam_param_array)
    {
        $wifi_login_url = $aam_conf_array['wifi_logoff_url'];
        $wlanuserip = isset($aam_param_array['wlanuserip']) ? $aam_param_array['wlanuserip'] : '';
        $wlanacip = isset($aam_param_array['wlanacip']) ? $aam_param_array['wlanacip'] : '';
        $wlanapmac = isset($aam_param_array['wlanapmac']) ? $aam_param_array['wlanapmac'] : '';
        $ssid = isset($aam_param_array['ssid']) ? $aam_param_array['ssid'] : '';
        
        $wifi_login_url .= '?username='.$membership->member_code.'&maxsessiontime='.$wifi_session_time.'&policy='.$aam_conf_array['wifi_policy'];

        if(!empty($wlanuserip))
        {
            $wifi_login_url .= '&wlanuserip='.$wlanuserip;
        }
        if(!empty($wlanacip))
        {
            $wifi_login_url .= '&wlanacip='.$wlanacip;
        }
        if(!empty($wlanapmac))
        {
            $wifi_login_url .= '&wlanapmac='.$wlanapmac;
        }
        if(!empty($ssid))
        {
            $wifi_login_url .= '&ssid='.$ssid;
        }
        return $wifi_login_url;
    }
    public static function getWifiConnectLog($membership_id)
    {
        $wifiConnectLogArray = WifiConnectLog::model()->findAll(array(
            'condition'=>'membership_id=:membership_id',
            'params'=>array(':membership_id'=>$membership_id),
            'order' => 'id desc',
            'limit' => 8,
        ));
 
        return $wifiConnectLogArray;
    }
    
    public static function getLastWifiConnectLog($membership_id)
    {
        $wifiConnectLogArray = WifiConnectLog::model()->find(array(
            'condition'=>'membership_id=:membership_id',
            'params'=>array(':membership_id'=>$membership_id),
            'order' => 'id desc',
            'limit' => 1,
        ));
 
        return $wifiConnectLogArray;
    }
    
    /**
     * 根据会员查询免费wifi体验信息
     * @param type $membership_id
     * @return boolean
     */
    public static function getFreeWifiLog($membership_id)
    {
        $free_bool = 0;
        $cruise_trip = self::getTripIdByCurrTime();
        if(!empty($cruise_trip)){
            $sql_value = 'SELECT count(*) FROM vcos_wifi_free_log WHERE trip_id = '.$cruise_trip['trip_id'].' AND membership_id= '.$membership_id.' LIMIT 1';
            $cruise_trip_count = yii::app()->db->createCommand($sql_value)->queryScalar();
            if(empty($cruise_trip_count)){
                $free_bool = 1;
            }else{
                $free_bool = 2;
            }
        }
        return $free_bool;        
    }
    
    /**
     * 根据当前时间判断所在航线
     * @return type
     */
    public static function getTripIdByCurrTime()
    {
        $curr_time = time();
        $sql_value = 'SELECT trip_id,trip_name,trip_no,trip_start_time,trip_end_time FROM vcos_cruise_trip WHERE trip_state =0 AND trip_start_time< '.$curr_time.' AND trip_end_time > '.$curr_time.' LIMIT 1';
        $cruise_trip = yii::app()->db->createCommand($sql_value)->queryRow();
        return $cruise_trip;
    }
    
    public static function sysLogoff($membership_id, $wifi_server_conf_array, $aam_param_array)
    {
        $curr_connect = self::getLastWifiConnectLog($membership_id);
        $connect_id = null;
        if(!empty($curr_connect)){
            $curr_wifi_time = ($curr_connect->wifi_time)/60;
            if (2 <= $curr_connect->exit_type){
                $online_time = round(($curr_connect->wifi_logout_time-$curr_connect->wifi_login_time)/60, 2);
            }else{
                $online_time = round((time()-$curr_connect->wifi_login_time)/60, 2);
            }
            if($online_time >= $curr_wifi_time){
                $online_time = $curr_wifi_time;
            }


            if ($curr_wifi_time == $online_time )
            {

            }elseif($online_time < $curr_wifi_time && 1 < $curr_connect->exit_type){

            }else{
                $connect_id = $curr_connect->id;
            }
        }
//        if($online_time > $curr_wifi_time && 0 == $curr_connect->exit_type){
//            
//        }  
        if(!empty($connect_id)){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $wifiConnectLog = WifiConnectLog::model()->findByPk($connect_id);

                $wifiService= WifiService::model()->find(array(
                    'condition'=>'membership_id=:membership_id',
                    'params'=>array(':membership_id'=> $membership_id),

                ));

                if (!empty($wifiConnectLog) && 0 == $wifiConnectLog->exit_type && !empty($wifiService)){
                    if(empty($aam_param_array)){
                        $aam_param_array['wlanacip'] = (empty($wifiConnectLog->wlanacip) ? '' : $wifiConnectLog->wlanacip);
                        $aam_param_array['ssid'] = (empty($wifiConnectLog->ssid) ? '' : $wifiConnectLog->ssid);
                        $aam_param_array['wlanuserip'] = (empty($wifiConnectLog->ip_address) ? '' : $wifiConnectLog->ip_address);
                        $aam_param_array['wlanapmac'] = (empty($wifiConnectLog->mac_address) ? '' : $wifiConnectLog->mac_address);
                    }
                    
                    $membership = MembershipService::getMembership($membership_id);

                    $aam_conf_array = isset($wifi_server_conf_array['wifi_param']) ? $wifi_server_conf_array['wifi_param'] : '';
                    $logoff_url = MywifiService::createWifiLogoffUrl($membership, 0, $aam_conf_array, $aam_param_array);
                    $wifi_logoff_state = MywifiService::WifiLogOff($membership,$wifiConnectLog->wifi_service_name,0,$logoff_url,$aam_param_array);

                    if('1' === $wifi_logoff_state || '2' === $wifi_logoff_state){
                        $wifiConnectLog->exit_type = 2;
                        $wifiConnectLog->wifi_logout_time = time();
                        $curr_online_time = $wifiConnectLog->wifi_logout_time - $wifiConnectLog->wifi_login_time;
                        if($curr_online_time > $wifiConnectLog->wifi_time)
                        {
                            $curr_online_time = $wifiConnectLog->wifi_time;
                        }
                        $wifiConnectLog->wifi_online_time = $curr_online_time;
                        $wifiConnectLog->save();

                        $wifiService->total_wifi_time -= $wifiConnectLog->wifi_online_time;
                        if (0 > $wifiService->total_wifi_time){
                            $wifiService->total_wifi_time = 0;
                        }
                        $wifiService->save();
                        $transaction->commit();
                    }else{
                        $transaction->commit();
                    }
                }

            } catch (Exception $exc) {
                $transaction->rollback();
            }
        }
    }
    
    /**
     * 获得补偿记录，通过会员id
     * @param type $membership_id
     * @return type
     */
    public static function getWifiCompensationLog($membership_id){
        $wifiCompensationLog = WifiCompensationLog::model()->find(array(
            'condition'=>'membership_id=:membership_id AND wifi_compensation_state=2',
            'params'=>array(':membership_id'=>$membership_id),
            'order' => 'id desc',
            'limit' => 1,
        ));
        return $wifiCompensationLog;
    }
    
    /**
     * 获得补偿记录，通过id
     * @param type $id
     * @return type
     */
    public static function getWifiCompensationLogById($id){
        $wifiCompensationLog = WifiCompensationLog::model()->find(array(
            'condition'=>'id=:id AND wifi_compensation_state=2',
            'params'=>array(':id'=>$id),
            'order' => 'id desc',
            'limit' => 1,
        ));
        return $wifiCompensationLog;
    }
}
