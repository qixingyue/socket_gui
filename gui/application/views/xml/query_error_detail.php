<?php
echo <<<XML
<dip_command>
<command>query_error_detail</command>
<command_data>
<group>$group</group>
<name>$name</name>
<error_id>$error_id</error_id>
</command_data>
</dip_command>
XML
;