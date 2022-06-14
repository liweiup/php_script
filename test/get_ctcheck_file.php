<?php
$start_num = $_POST['start_num'] ?: 1;
$end_num = $_POST['end_num'] ?: 10;
$flag_name = $_POST['flag_name'] ?: 'zyx';
for ($i = $start_num;$i <= $end_num; $i++) {
    $str = "        <field desc=\"自定义项{$i}\">
            <matchtag>$flag_name$i</matchtag>
            <name>$flag_name$i</name>
            <type>CUSTOM</type>
            <nullallowed>yes</nullallowed>
            <maxLength>101</maxLength>
            <needexport>yes</needexport>
            <checkTranslatedPK>no</checkTranslatedPK>
        </field>";
    echo $str.PHP_EOL;
}
