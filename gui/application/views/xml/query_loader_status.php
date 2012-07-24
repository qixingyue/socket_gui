<?php
echo <<<XML
<dip_command>
<command>query_apply_status</command>
<command_data>
<group>$group</group>
<name>$name</name>
</command_data>
</dip_command>
XML
;