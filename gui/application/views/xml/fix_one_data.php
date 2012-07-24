<?php
echo <<<XML
<dip_command>
  <command>fix_data</command>
  <command_data>
    <datbase>                                    
      <db_user>{$db['user']}</db_user>
      <db_password>{$db['password']}</db_password>
      <tns>{$db['tns']}</tns>
    </database>
    <reference_by>$referenceby</reference_by>
    <result_name>$result_name</result_name>
    <record_no>$record_id</record_no>
  </command_data>
</dip_command>
XML
;