<?php
echo <<<XML
<dip_command>
<command>delete_group_server</command>
<command_data>
<group>$group</group>
<component>
<type>$type</type>
<name>$name</name>
</component>
</command_data>
</dip_command>
XML
;