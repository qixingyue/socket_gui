<?php
echo <<<XML
<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <source_db>
      <db_user>user1</db_user>
      <db_password>password1</db_password>
      <tns>tns1</tns>
    </source_db>
    <target_db>
      <db_user>user2</db_user>
      <db_password>password2</db_password>
      <tns>tns2</tns>
    </target_db>
    <sql_condition>hello sql</sql_condition>
    <execute_plan>
      <plan_type>12|12|12</plan_type>
      <start_time>11:22</start_time>
    </execute_plan>
    <execute_immediate>Y</execute_immediate>
  </return_data>
</dip_command>
XML
;    
