<?php
$lj = $mode == "ljbd" ? "Y" : "N";
echo <<<XML
<dip_command>
  <command>create_compare_task</command>
  <command_data>
    <task_name>$task_name</task_name>
    <source_db>
<db_user>{$source_db['user']}</db_user>
<db_password>{$source_db['password']}</db_password>
<tns>{$source_db['tns']}</tns>
</source_db>
<target_db>
<db_user>{$targetdb['user']}</db_user>
<db_password>{$targetdb['password']}</db_password>
<tns>{$targetdb['tns']}</tns>
</target_db>
XML;
foreach ($sql_condition as $sql) {
	echo "<sql_condition>$sql_condition</sql_condition>";
}
echo <<<XML
   <execute_plan>
<plan_type>$plan_type</plan_type>
<start_time>$start_time</start_time>
    </execute_plan>
    <execute_immediate>$lj</execute_immediate>    
  </command_data>
</dip_command>
XML
;