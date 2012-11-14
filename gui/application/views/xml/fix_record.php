<?php
echo <<<XML
<dip_command>
  <command>fix_record</command>
  <command_data>
    <group>$group</group>
    <name>$name</name>
  </command_data>
</dip_command>
XML
;