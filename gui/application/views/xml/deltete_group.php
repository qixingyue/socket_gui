<?php
echo <<<XML
<dip_command>
  <command>delete_group</command>
  <command_data>
    <group>$group</group>
  </command_data>
</dip_command>	
XML
;