<?php
echo <<<XML
<dip_command>
<command>query_group_servers</command>
<command_data>
<group>$name</group>
</command_data>
</dip_command>
XML
; 