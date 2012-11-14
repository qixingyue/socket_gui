<?php
echo <<<XML
<dip_command>
  <command>compare_result_detail</command>
  <command_data>
    <result_name>$name</result_name>
    <record_no>$result_no</record_no>
  </command_data>
</dip_command> 
XML
;