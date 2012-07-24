<?php
echo <<<XML
<dip_command>
<command>test_apply_db</command>
<command_data>
<db_type>$type</db_type>
<db_user>$user</db_user>
<db_password>$password</db_password>
<tns>$tns</tns>
</command_data>
</dip_command>
XML
;