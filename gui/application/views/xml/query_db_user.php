<?php
echo <<<XML
<dip_command>
<command>query_db_schema</command>
<command_data>
<db_type>$type</db_type>
<db_user>$user</db_user>
<db_password>$password</db_password>
<tns>$tns</tns>
</command_data>
</dip_command>
XML
;