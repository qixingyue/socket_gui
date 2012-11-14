<?php
echo <<<XML
<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <row_id>1</row_id>
    <sql>select * from mytable</sql>
  </return_data>
</dip_command>
XML
;