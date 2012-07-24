<?php
$insert = rand(0, 100);
$update = rand(0, 100);
$delete = rand(0, 100);
$ddl = rand(0, 100);
echo <<<XML
<dip_command>
	<command_return>SUCCESS</command_return>
	<return_data>
		<db_name>dbhello_A</db_name>
		<tns>hellotns</tns>
		<status>terminated</status>
		<start_time>20120125151</start_time>
		<work_scn>15115151</work_scn>
		<work_scn_time>154546551565</work_scn_time>
		<op_insert>{$insert}</op_insert>
		<op_update>{$update}</op_update>
		<op_delete>{$delete}</op_delete>
		<op_ddl>{$ddl}</op_ddl>
		<last_sql>insert into A values('a','b','c');</last_sql>
		<history_op>
			<op_node>
				<op_insert>{$insert}</op_insert>
				<op_update>{$update}</op_update>
				<op_delete>{$delete}</op_delete>
				<op_ddl>{$ddl}</op_ddl>
			</op_node>
			<op_node>
				<op_insert>37</op_insert>
				<op_update>12</op_update>
				<op_delete>34</op_delete>
				<op_ddl>73</op_ddl>
			</op_node>
			<op_node>
				<op_insert>23</op_insert>
				<op_update>12</op_update>
				<op_delete>33</op_delete>
				<op_ddl>10</op_ddl>
			</op_node>
			<op_node>
				<op_insert>21</op_insert>
				<op_update>23</op_update>
				<op_delete>35</op_delete>
				<op_ddl>23</op_ddl>
			</op_node>
			<op_node>
				<op_insert>67</op_insert>
				<op_update>24</op_update>
				<op_delete>67</op_delete>
				<op_ddl>43</op_ddl>
			</op_node>
			<op_node>
				<op_insert>13</op_insert>
				<op_update>23</op_update>
				<op_delete>36</op_delete>
				<op_ddl>10</op_ddl>
			</op_node><op_node>
				<op_insert>14</op_insert>
				<op_update>24</op_update>
				<op_delete>33</op_delete>
				<op_ddl>10</op_ddl>
			</op_node>
			<op_node>
				<op_insert>40</op_insert>
				<op_update>10</op_update>
				<op_delete>60</op_delete>
				<op_ddl>50</op_ddl>
			</op_node>
			<op_node>
				<op_insert>31</op_insert>
				<op_update>24</op_update>
				<op_delete>34</op_delete>
				<op_ddl>18</op_ddl>
			</op_node>
		</history_op>
		<errors>
			<error>
				<error_time>1125122</error_time>
				<error_message>出错啦</error_message>
			</error>
			<error>
				<error_time>112512422</error_time>
				<error_message>真出错啦</error_message>
			</error>
		</errors>
	</return_data>
</dip_command>
XML
;
