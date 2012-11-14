<?php
echo <<<XML
<dip_command>
<command>skip_error</command>
<command_data>
<group>$group</group>
<name>$name</name>
<skip>$skip</skip> 
</command_data>
</dip_command>
XML
;