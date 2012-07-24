<?php

$skip_taged = $skip_taged ? "YES" : "NO";
$auto_fix = $auto_fix ? "YES" : "NO";

echo <<<XML
<dip_command>
<command>add_apply_config</command>
<command_data>
<group>$group</group>
<server_name>{$server['name']}</server_name>
<server_type>oracle</server_type>
<db_type>{$server['db_type']}</db_type>
<db_user>{$server['db_user']}</db_user>
<db_password>{$server['password']}</db_password>
<tns>{$server['tns']}</tns>
<skip_taged>$skip_taged</skip_taged>
<auto_fix>$auto_fix</auto_fix>
<skip_error>$skip_error</skip_error>
<delay_alert>$delay_alter</delay_alert>
<filter>
<filter_type>include</filter_type>
XML
;

//包含
foreach ($include_schemas as $chema):
	echo <<<XML
<schema>
	<name>{$chema->userName}</name>
	<mapping_name>{$chema->ysuserName}</mapping_name>
	<object_type>
	<name>{$chema->objtype}</name>
XML;
if($chema->objlist != "*"):
	$object_names = explode(REPLACEENTER, $chema->objlist);
	foreach ($object_names as $object_name) {
		if($object_name!="")
			echo "<object_name>$object_name</object_name>";										//object_name要是选择所有的时候，传值什么？
	}
endif;
echo <<<XML
</object_type>
</schema>
XML
;
endforeach;
echo <<<XML
</filter>
<filter>
<filter_type>exclude></filter_type>
XML;

//添加排除
foreach ($excludeschemas as $chema):
	echo <<<XML
	<schema>
	<name>{$chema->userName}</name>
	<object_type>
	<name>{$chema->objtype}</name>
XML;
if($chema->objlist != "*"):
	$object_names = explode("\n", $chema->objlist);
	foreach ($object_names as $object_name) {
		if($object_name!="")
			echo "<object_name>$object_name</object_name>";										//object_name要是选择所有的时候，传值什么？
	}
endif;
echo <<<XML
</object_type>
</schema>
XML
;
endforeach;
echo <<<XML
</filter>
</command_data>
</dip_command>
XML
;

