<?php

/*
update
new
*/


UPDATE  `rpms`.`project_main` SET  `admin_change_date` =  '2010-07-05 00:00:00',
`infra_change_date` =  '2010-08-10 00:00:00',
`totalVM` =  '5',
`totalPhysical` =  '1' WHERE  `project_main`.`id` =23;


// Loop through ids for personnel and resource db calls
$IdList = '';
if ( $resultData != false ) {
	while ( $obj = $resultData->fetch_object() ) { 
		$IdList = $IdList.$obj->id.',';
	}
	// remove trailing comma
	$IdList = rtrim($IdList,',');
	// go back to begining of object
	$resultData->data_seek(0);
}
else {
	echo '<p>'.$emptySetMsg.'</p>';
}


$queryPersonnel = 'SELECT first_name,last_name,organization FROM personnel WHERE id IN ('.$IdList.') ORDER BY id ASC LIMIT 0,1000';
$resultPersonnel = $mysqli->query($queryPersonnel);

$queryResources = 'SELECT count(*) FROM (SELECT id,resource_type FROM resources WHERE id IN ('.$IdList.') GROUP BY id,resource_type) LIMIT 0,1000';
$resultResources = $mysqli->query($queryResources);



?>
