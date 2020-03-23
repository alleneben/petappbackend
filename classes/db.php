<?php
	Class DB
	{
		function Connection($pgdirect=false)
		{
			if($pgdirect==false)
			{
				//use ADODB
				$db = NewADOConnection('postgres');
				$db->SetFetchMode(ADODB_FETCH_ASSOC);
				$db->Connect('localhost','postgres','minuteman1d','petsdb');
				// $db->Connect('localhost','postgres','ampofo07','ampofodb');
				// $db->Connect('localhost','kitciojt_gymnuser','$?{gq}Um}&t%','kitciojt_gymn');
				// $db->Connect('localhost','postgres','minuteman1d','pos');
				// GRANT USAGE, SELECT ON SEQUENCE tbs_entity_recid_seq TO kitciojt_gymnuser;
				// GRANT  SELECT ON TABLE vws_user TO kitciojt_gymnuser

				return $db;
			}
			else
			{
				//connect directly
				return pg_connect('host='.'localhost'.' port='.'5432'.' dbname='.'sys'.' user='.'postgres'.' password='.'naas');
			}
		}

	}
?>
