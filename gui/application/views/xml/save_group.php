<?php
echo <<<XML
<dip_command>
<command>add_group</command>
<command_data>
<group>$name</group>
<description>$description</description>
</command_data>
</dip_command>
XML
;