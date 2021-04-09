<?php
error_reporting(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,($str[1]));
	return $str[0];
}
$base64 = "Q29weSByaWdodCBCeSBFeiBDYXNoIGh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL2NoYW5uZWwvVUNxTXNBWWVRU05HODFFdnJ3bHM1MVBR";
function get_data($user){
	$arr = array("\r","	");
	$url = "https://totorewards.totodreammarketing.com/api/v2/user/$user/data_2";
	$h = explode("\n",str_replace($arr,"","x-authorization: ffcf674dcf020096d009d55db7b6e81a
	user-agent: okhttp/4.2.2"));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
	curl_close($ch);
	return json_decode($x,true);
}
function get_coin($user,$authorization){
	$arr = array("\r","	");
	$url = "https://totorewards.totodreammarketing.com/api/v2/games/$user/checkin";
	$h = explode("\n",str_replace($arr,"","x-authorization: $authorization
	content-type: application/x-www-form-urlencoded
	user-agent: okhttp/4.2.2"));
	$body = "game_title=Light%20Tower&country=ID&level=2";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
	curl_close($ch);
	return json_decode($x,true);
}
echo "#################\n#   Ez Cash     #\n#   Ez Money    #\n#   Paypal      #\n#################\n";
echo "Dont Edit This File\n";
echo base64_decode($base64);
echo "\n";
echo "Input user: ";
$user = trim(fgets(STDIN));
echo "Input x-authorization: ";
$authorization = trim(fgets(STDIN));
  $get_data =  get_data($user);
  $output_get_data = json_encode($get_data);
  $points = getStr($output_get_data,'"points":"','"');
  $email = getStr($output_get_data,'"email":"','"');
  $gagal = getStr($output_get_data,'"data":"','"');
  if(strpos($output_get_data,"false")==true){
                $email = "Your Email : $email";
				$point = "Your Points : $points";
				echo $email."\n".$point."\n";
            }else{
                $text ="Failed $gagal";
				echo $text."\n";
			}
while(TRUE){
  $get_coin =  get_coin($user,$authorization);
  $output_get_coin = json_encode($get_coin);
  $message = getStr($output_get_coin,'"message":"','"');
  if(strpos($output_get_coin,"false")==true){
                $text = "Successfull Get Coins Wait 2 minutes";
				echo $text."\n";
            }else{
                $text ="Failed $message Get X-authorization again";
				echo $text."\n";
				exit();
			}
  $get_data =  get_data($user);
  $output_get_data = json_encode($get_data);
  $points_check = getStr($output_get_data,'"points":"','"');
  if(strpos($output_get_data,"false")==true){
				$points_check = "Your current point : $points_check";
				echo $points_check."\n";
            }else{
                $text ="Failed $gagal";
				echo $text."\n";
			}
	sleep(120);
}