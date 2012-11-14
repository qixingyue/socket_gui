<?php
echo <<<XML
<dip_command>
<command_return>SUCCESS</command_return>
<return_data>
<error_detail>真的错啦！</error_detail>
<error_sql>select * from test</error_sql>
</return_data>
</dip_command>
XML
;