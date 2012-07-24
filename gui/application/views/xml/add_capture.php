<?php
echo <<<XML
<dip_command>
<command>add_capture</command>
<command_data>
<group>$group</group>
<name>$name</name>
<db_type>$type</db_type>
<source_db>
<db_user>{$sourcedb['user']}</db_user>
<db_password>{$sourcedb['password']}</db_password>
<tns_1>{$sourcedb['tns_1']}</tns_1>
<tns_2>{$sourcedb['tns_2']}</tns_2>
<source_db>
<downstream_db>
<db_user>{$downstreamdb['user']}</db_user>
<db_password>{$downstreamdb['password']}</db_password>
<tns>{$downstreamdb['tns']}</tns>
</downstream_db>
<arch_path1>$node1diaray_path</arch_path1>
<arch_path2>$node2diaray_path</arch_path2>
<schemas>
XML
;
foreach ($users as $user)
echo "<schema>$user</schema>";
echo <<<XML
</schemas>
</command_data>
</dip_command>
XML
;