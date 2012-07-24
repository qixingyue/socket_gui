<?php
echo <<<XML
<dip_command>
  <command>start_server_by_scn</command>
  <command_data>
    <group>$group</group>
    <name>$name</name>
	<start_scn>$startscn</start_scn>
    <low_scn>$lowscn</low_scn>
  </command_data>
</dip_command>
XML
;