<?php

for ($i = 1;$i <= 20; $i++) {
    $str = "        <field desc=\"自定义项{$i}\">
            <matchtag>def$i</matchtag>
            <name>def$i</name>
            <type>CUSTOM</type>
            <nullallowed>yes</nullallowed>
            <maxLength>101</maxLength>
            <needexport>yes</needexport>
            <checkTranslatedPK>no</checkTranslatedPK>
        </field>";
//    echo $str.PHP_EOL;
}

for ($i = 20;$i <= 30; $i++) {
    $str = "        <field desc=\"自定义项{$i}\">
            <matchtag>zyx$i</matchtag>
            <name>zyx$i</name>
            <type>CUSTOM</type>
            <nullallowed>yes</nullallowed>
            <maxLength>101</maxLength>
            <needexport>yes</needexport>
            <checkTranslatedPK>no</checkTranslatedPK>
        </field>";
    echo $str.PHP_EOL;
}