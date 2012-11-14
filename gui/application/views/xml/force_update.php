<?php
echo <<<XML
<dip_command>
<command>force_update</command>
<command_data>
<group>$group</group>
<name>$name</name>
</command_data>
</dip_command>
XML
;