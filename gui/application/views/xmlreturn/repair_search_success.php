<?php
echo <<<XML
<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <result_name>result_2012</result_name>
    <results>
      <owner>hello</owner>
      <table>table</table>
      <ok_count>12</ok_count>
      <dismatch_count>123</dismatch_count>
    </results>
  </return_data>
</dip_command>
XML
;