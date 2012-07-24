<?php
echo <<<XML
<dip_command>
  <command>query_compare_result</command>
  <command_data>
	<task_name>$name</task_name>
    <result_date>$result_type</result_date>      
  </command_data>
</dip_command>
XML
; 