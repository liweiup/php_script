<?php
function xml2assoc($xml) {
    $tree = null;
    while($xml->read())
        switch ($xml->nodeType) {
            case XMLReader::END_ELEMENT: return $tree;
            case XMLReader::ELEMENT:
                $node = array('tag' => $xml->name, 'value' => $xml->isEmptyElement ? '' : xml2assoc($xml));
                if($xml->hasAttributes)
                    while($xml->moveToNextAttribute())
                        $node['attributes'][$xml->name] = $xml->value;
                $tree[] = $node;
                break;
            case XMLReader::TEXT:
            case XMLReader::CDATA:
                $tree .= $xml->value;
        }
    return $tree;
}
function loop_data($all_arr,$filed_arr,$s_num,$e_num) {
    $table_str = '<table width="60%" style="margin: auto" border="1" cellspacing="0">';
    $table_str .= "<tr>
                    <td width='10%'>字段名称</td>
                    <td width='10%'>字段编码</td>
                    <td width='10%'>字段类型及长度</td>
                    <td width='10%'>是否必填</td>
                    <td width='20%'>备注说明</td>
                    </tr>";
    $f_num = 0;
    foreach ($all_arr as $k=>$v) {
        if ($k < $s_num || $k >= $e_num) {
            continue;
        }
        $str = ltrim($v,'<!--');
        $str = rtrim($str,'-->');
        $change_arr = explode(',',$str);
        $name = $change_arr[0];
        $filed = $filed_arr[$f_num];
        $type = explode(':',$change_arr[2])[1];
        $type = str_replace('String','varchar2',$type);
        $type = str_replace('UFBoolean','char',$type);
        $type = str_replace('UFDate','char',$type);
        $type = str_replace('UFDouble','number',$type);
        preg_match('/\d+/',$change_arr[1],$length_arr);
        $length = $length_arr[0] == 0 ? 1 : $length_arr[0];
        $comment = isset($change_arr[3]) ? $change_arr[3] : '';
        $is_have = isset($change_arr[4]) ? $change_arr[4] : '';
        $table_str .= '<tr>';
        $table_str .= '<td>'.$name.'</td>';
        $table_str .= '<td>'.$filed.'</td>';
        if (strstr($type,'Integer')) {
            $table_str .= '<td>'.$type.'</td>';
        } else {
            $table_str .= '<td>'.$type."({$length})".'</td>';
        }
        $table_str .= '<td>'.$is_have.'</td>';
        $table_str .= '<td>'.$comment.'</td>';
        $table_str .= '</tr>';
        $f_num++;
    }
    $table_str .= "</table>";
    echo "<hr/>";
    return $table_str;
}
$xml_file = $_FILES;
if (!$xml_file) {
    echo "请上传文件";
    exit();
}
$xml_file = $_FILES['xml']['tmp_name'];
$xml = new XMLReader();
$xml->open($xml_file);
$assoc = xml2assoc($xml);
$xml->close();
$billhead = array_column($assoc[0]['value'][0]['value'][0]['value'],'tag');
$item = [];
if (isset($assoc[0]['value'][1])) {
    $item = array_column($assoc[0]['value'][1]['value'],'tag');
}
//匹配注释
$preg = '/<!--.*?-->/';
preg_match_all($preg,file_get_contents($xml_file),$result);
if (count($billhead) + count($item) != count($result[0])) {
    echo 'bill_head标签数量:'.count($billhead).PHP_EOL;
    echo 'item标签数量:'.count($item).PHP_EOL;
    echo '注释数量:'.count($result[0]).PHP_EOL;
    echo "注释数量不对，1.注意层级，item必须和bill标签同级。2.每个标签上方必须带有注释。";
    exit();
}
echo loop_data($result[0],$billhead,0,count($billhead)).PHP_EOL;
echo loop_data($result[0],$item,count($billhead),count($result[0]));
//var_dump($ble_arr);
//var_dump(count($billhead));
//var_dump(count($item));
//var_dump(count($result[0]));



