<?php
echo <<<XML
<dip_command>
  <command>query_compare_result_detail</command>
  <command_data>
    <task_name>$name</task_name>
    <result_date>$date</result_date>
    <record_no>$record_no</record_no>
  </command_data>
</dip_command> 
XML
;