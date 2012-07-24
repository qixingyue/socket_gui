<?php
	echo <<<XMLS
	<dip_command>
  <command>query_simulator_status</command>
  <command_data>
    <group>$group</group>
    <name>$name</name>
  </command_data>
</dip_command>
XMLS
;