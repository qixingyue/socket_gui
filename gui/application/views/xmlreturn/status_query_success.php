<?php
	echo <<<XML
	<dip_command>
  <command_return>SUCCESS</command_return>
  <return_data>
    <group>
      <name>group1</name>
      <captures>
        <capture>
          <name>dcl_oracap</name>
          <thread>1</thread>
          <db_name>rdtb</db_name>
          <status>Unknown</status>
          <start_time>2012-09-18 16:33:24</start_time>
          <work_scn>201305642</work_scn>
          <work_scn_time>2012-09-13 15:47:53</work_scn_time>
        </capture>
        <simulator>
          <name>dcl_simulator</name>
          <db_name></db_name>
          <status>running</status>
          <start_time>2012-09-18 16:33:25</start_time>
          <work_scn>201299523</work_scn>
          <work_scn_time>2012-09-13 13:10:22</work_scn_time>
        </simulator>
      </captures>
      <servers>
        <server>
          <name>dcl_undo</name>
          <db_name>rdtc</db_name>
          <status>running</status>
          <start_time>2012-09-13 10:15:09</start_time>
          <work_scn>201182620</work_scn>
          <work_scn_time>2012-09-13 10:16:06</work_scn_time>
        </server>
      </servers>
    </group>
    <group>
      <name>group2</name>
      <captures>
        <capture>
          <name>dcl_oracap</name>
          <thread>1</thread>
          <db_name>rdtb</db_name>
          <status></status>
          <start_time></start_time>
          <work_scn>0</work_scn>
          <work_scn_time></work_scn_time>
        </capture>
        <simulator>
          <name>dcl_simulator</name>
          <db_name></db_name>
          <status></status>
          <start_time></start_time>
          <work_scn>0</work_scn>
          <work_scn_time></work_scn_time>
        </simulator>
      </captures>
      <servers>
        <server>
          <name>dcl_undo</name>
          <db_name>rdtc</db_name>
          <status></status>
          <start_time></start_time>
          <work_scn>0</work_scn>
          <work_scn_time></work_scn_time>
        </server>
      </servers>
    </group>
  </return_data>
</dip_command>                   
XML
;