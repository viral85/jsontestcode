<?php

ini_set('max_execution_time',800);
ini_set('memory_limit', '1024M');

$data  = file_get_contents("listings.json");
$data1 = file_get_contents("products.json");

$array  = json_decode($data,true);
$array1 = json_decode($data1,true);
$result = array();
foreach($array1 as $products){
	$prodname = $products['productname'];
	foreach($array as $listings){
		$title    = $listings['title'];
		$newtitle = preg_replace('/(\s|\/)(\d|[a-z])+\.?\d*\sMP.*/', "",$title);
		if($prodname == $newtitle){
			$record = $listings;
			$newprodname = $prodname;
			$result[] = array('productname'=>$prodname,'listings'=>array(array('title'=>$record['title'],
					'manufacturer'=>$record['manufacturer'],
					'currency'=>$record['currency'],
					'price'=>$record['price'])));
			}                   
		}
	}
	echo json_encode($result);
?>
