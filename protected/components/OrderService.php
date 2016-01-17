<?php

class OrderService{
	
	
	public static function createOrderno()
	{
		$my_code = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		 
		$order_sn = $my_code[intval(date('m'))].(intval(date('d')) < 10 ? intval(date('d')) : $my_code[(intval(date('d'))-10)]).date('Y')
		.substr(time(),-5).substr(microtime(),2,5)
		.sprintf('%02d', rand(0, 99));
		 
		return $order_sn;
	}
	
	public static function getBookingno(){
		$booking_no = OrderService::createOrderno();
		$booking_count = MemberBooking::find()->where(['booking_no' => $booking_no])->count();
	
		if($booking_count>0){
			return OrderService::getBookingno();
		}else{
			return $booking_no;
		}
	}
}