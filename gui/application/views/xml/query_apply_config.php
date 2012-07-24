<?php
echo <<<XML
<dip_command>
  <command>query_apply_config</command>
  <command_data>
    <group>$group</group>
    <server_name>$name</server_name>
  </command_data>
</dip_command>
XML
;

