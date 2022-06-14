<?php
$body = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/fukuan_body.txt','r');
$item = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/fukuan_item.txt','r');

$body = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/richang_body.txt','r');
$item = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/richang_item.txt','r');

//$body = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/chailv_body.txt','r');
//$item = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/chailv_item.txt','r');

//$body = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/kehu_body.txt','r');
//$item = fopen('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/kehu_item.txt','r');

$table_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/table.txt');
$table_detail_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/table_detail.txt');
$xml_model_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/付款结算单.xml');
$xml_model_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/日常报销单.xml');
$xml_model_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/差旅报销单.xml');

//$xml_model_str = file_get_contents('/Users/bird/Documents/yongyou_software/达闼项目/付款结算单/bankaccbas.xml');
//var_dump($table_str);
//var_dump(strstr($xml_model_str,"def1"));

//表体
while (!feof($body)){
    $line = fgets($body);
    $line_arr = explode(",",$line);
    $k = trim($line_arr[0]);
    $v = trim($line_arr[1]);
    if ($v && !strstr($xml_model_str,$v)) {
//    if (!strstr($table_str,strtoupper($v)) && !strstr($table_detail_str,strtoupper($v))) {
//        $k_s = "<!--{$k},最大长度为2,类型为:String-->".PHP_EOL;
        $k_s = "<!--{$k}-->".PHP_EOL;
        $v_s = "<{$v}></{$v}>".PHP_EOL;
        echo $k_s;
        echo $v_s;
    }
}
echo "================================================================================".PHP_EOL;
//表明细
while (!feof($item)){
    $line = fgets($item);
    $line_arr = explode(",",$line);
    $k = trim($line_arr[0]);
    $v = trim($line_arr[1]);
    if ($k && $v) {
//        if (!strstr($xml_model_str,$v) && strstr($table_detail_str,strtoupper($v))) {
        if (!strstr($xml_model_str,$v)) {
    //        $k_s = "<!--{$k},最大长度为2,类型为:String-->".PHP_EOL;
            $k_s = "<!--{$k}-->".PHP_EOL;
            $v_s = "<{$v}></{$v}>".PHP_EOL;
            echo $k_s;
            echo $v_s;
        }
    }
}