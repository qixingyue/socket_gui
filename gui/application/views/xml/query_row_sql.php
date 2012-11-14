<?php
echo <<<XML
<dip_command>
  <command>query_row_sql</command>
  <command_data>
    <row_id>$rowid</row_id>
  </command_data>
</dip_command>
XML
;