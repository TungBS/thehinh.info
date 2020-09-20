<?php

namespace App\HelpersClass;

class Month {
	public static function getListMonthInYear()
	{
		$arrayDay = [];
		//$month = date('m');
		$year = date('Y');
		//Lấy tất cả các ngày trong tháng

		for ($month = 1; $month <= 12; $month ++) 
		{ 
			$arrayDay[] = date('Y-m', $time);	
		}
		return $arrayDay;
	} 
}