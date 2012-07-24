<?php
echo <<<XML
<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <group>group1</group>
    <name>name</name>
    <db_type>DB2</db_type>
    <source_db>
      <db_user>user</db_user>
      <db_password>password</db_password>
      <tns_1>tns1</tns_1>
      <tns_2>tns2</tns_2>
    </source_db>
    <downstream_db>
      <db_user>user2</db_user>
      <db_password>password2</db_password>
      <tns>tns3</tns>
    </downstream_db>
    <arch_path1>path1</arch_path1>
    <arch_path2>path2</arch_path2>
    <schemas>
      <schema>用户A</schema>
      <schema>用户C</schema>
    </schemas>
  </return_data>
</dip_command>
XML
;