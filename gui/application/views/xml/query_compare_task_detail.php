<?php
echo <<<XML
<dip_command>
  <command>query_compare_task_detail</command>
  <command_data>
    <task_name>$name</task_name>
  </command_data>
</dip_command>
XML
;