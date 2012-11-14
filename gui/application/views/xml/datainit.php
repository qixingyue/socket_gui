<?php
echo <<<XML
<dip_command>
  <command>initialize_data</command>
  <command_data>
    <source_db>
      <db_user>{$sourcedb['sourceuser']}</db_user>
      <db_password>{$sourcedb['sourcepwd']}</db_password>
      <tns>{$sourcedb['sourcedb']}</tns>
    </source_db>
    <target_db>
      <db_user>{$targetdb['targetuser']}</db_user>
      <db_password>{$targetdb['targetpwd']}</db_password>
      <tns>{$targetdb['targetdb']}</tns>
    </target_db>
    <objects>
XML
;
foreach ($fw as $s) {
	echo  "<object>$s</object>";
}


$ttable = 'YES';
$create_index = 'YES';

echo <<<XML
    </objects>
    <max_parallel_count>$bftask</max_parallel_count>
    <task_parallel_count>$singletask</task_parallel_count>
    <truncate_table>$ttable</truncate_table>
    <create_index>$create_index</create_index>
    <flashback_scn>$backscn</flashback_scn>
  </command_data>
</dip_command>
XML
;