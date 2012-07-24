<?php
echo <<<XML
<dip_command>
  <command>query_capture_status</command>
  <command_data>
    <group>$group</group>
    <thread>$thread</thread>  
  </command_data>
</dip_command>
XML
;