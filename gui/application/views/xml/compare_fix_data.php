<?php
echo <<<XML
<dip_command>
  <command>fix_data</command>
  <command_data>
    <task_name>$name</task_name>
<reference_by>$refer</reference_by>
    <record_no>$record_no</record_no>
  </command_data>
</dip_command>
XML
;	