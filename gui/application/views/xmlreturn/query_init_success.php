<?php
$i = rand(0, 100);
	echo <<<XML
<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <status>no_init</status>
    <process_percent>$i</process_percent>
    <detail_info>亲，正在进行初始化！</detail_info>
  </return_data>
</dip_command>	
XML
;