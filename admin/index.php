<?php 
/* This is the administration area for the online php application for RPMS, IRDA, CDC.
This is the functional controller or main page, it loads globals (re-usable functionality) 
and templates (re-usable layout).

Table of contents
	get global data
	Change these for personalization
	process form data
	query the db
	pagination
	get html template
*/
/* insert some test data into the db: 23 56 68
INSERT INTO `project_main` (id,approved_start,approved_end,project_title,project_use,admin_selection,infra_selection) VALUES (23,'2010-08-10','2010-10-15','Health Statistics Web Presentation System (IBIS) Health Statistics Web Presentation','Internal','Approved','Ready');
INSERT INTO `personnel` (projectid,first_name,last_name,organization,primary_contact) VALUES (60,'David','McNalley','CGH / CDC',1);
*/

/* get global data */
require('../includes/global.php');

/* Change these for personalization */
$pageData->title = 'RPMS Administration Summary';
$pageData->navSelected = 'Administration';
$pageData->pageName = 'index.php';
$pageData->numPerPage = '1000';

// default summary engagement order
$orderBy = 'approved_start';
// this can only be 'ASC' or 'DESC'
$orderType = 'DESC';

// Default orderType for each sort field/column.
$order->id = 'DESC';
$order->approved_start = 'DESC';
$order->approved_end = 'DESC';
$order->project_title = 'ASC';
$order->project_use = 'ASC';
$order->admin_selection = 'ASC';
$order->infra_selection = 'ASC';
$order->totalVM = 'DESC';
$order->totalPhysical = 'DESC';
$order->totalOnline = 'DESC';
$order->totalOther = 'DESC';
$order->last_name = 'ASC';
$order->organization = 'ASC';


/*** change below for functionality ***/

/* process form data */

$formVars = new formVars;
$formVars->orderBy = $orderBy;
$formVars->orderType = $orderType;
$formVars->sanitizeForm($formVars);



/* query the db */

// query the db for stats/summary. NEED TO ADD EXCLUSIONS WHEN SEARCHING
$queryStats = 'SELECT COUNT(admin_selection) FROM project_main WHERE admin_selection!="Closed" LIMIT 0,10;';
$resultStats = $mysqli->query($queryStats);
$obj = $resultStats->fetch_object();
$countCol = 'COUNT(admin_selection)';
$pageData->active=$obj->$countCol;

//Loop through other stats
$statTypes = array('project_use','admin_selection','infra_selection');
foreach ($statTypes as $typeName) {
	//getStats($value, $mysqli, $pageData);
	$queryStats = 'SELECT '.$typeName.', COUNT('.$typeName.') FROM project_main GROUP BY '.$typeName.' LIMIT 0,10;';
	$resultStats = $mysqli->query($queryStats);
	
	if ($resultStats!=false) {  
		while ($obj = $resultStats->fetch_object()) {
			$temp = $obj->$typeName;
			$temp = preg_replace('/\s+/', '',$temp);
			$countCol = 'COUNT('.$typeName.')';
			$pageData->$temp = $obj->$countCol;
		}
		$$typeName = $resultStats->num_rows;
		if (isset($admin_selection)) { 
			$pageData->OtherAdmin = $pageData->UnderReview + $pageData->Approved + $pageData->Retired - $admin_selection; 
			if ($pageData->OtherAdmin < 0) { $pageData->OtherAdmin = 0; }
		}
		if (isset($infra_selection)) { 
			$pageData->OtherTech = $pageData->ToSetUp + $pageData->Ready + $pageData->ToTakeDown - $infra_selection;
			if ($pageData->OtherTech < 0) { $pageData->OtherTech = 0; }
		}
	}
	else {
	    //error_log('Error in admin/index: the db query failed: query the db for stats/summary \n', 3, "/xampp/tmp/my-errors.log");
		echo 'Error in admin/index: the db query failed: query the db for stats/summary <br />';
	}
	// totals above minus total active
}

// query the db for the engagement records. NEED TO ADD EXCLUSIONS WHEN SEARCHING
//$queryData = 'SELECT id,project_title,approved_start,approved_end,project_use,admin_selection,infra_selection,totalVM,totalPhysical,totalOnline,totalOther FROM project_main ORDER BY '.$formVars->orderBy.' '.$formVars->orderType.' LIMIT 0,1000';
//echo '$formVars->orderBy: '.$formVars->orderBy. '<br />';
//echo '$formVars->orderType: '.$formVars->orderType. '<br />';
$queryData = 'SELECT project_main.id,project_main.project_title,project_main.approved_start,project_main.approved_end,project_main.project_use,project_main.admin_selection,project_main.infra_selection,project_main.totalVM,project_main.totalPhysical,project_main.totalOnline,project_main.totalOther, personnel.first_name,personnel.last_name,personnel.organization FROM project_main JOIN personnel ON project_main.id=personnel.projectid WHERE personnel.primary_contact="1" ORDER BY '.$formVars->orderBy.' '.$formVars->orderType.' LIMIT 0,1000;';
$resultData = $mysqli->query($queryData);


/* pagination */
$pagination = new pagination;
if ($resultData!=false) {  
	$pagination->numPerPage = $pageData->numPerPage;
	$pagination->calculations($resultData);
	$pagination->pageLinks($pageData);
	
	// revert column order on next click by changing link
	if ($formVars->orderType != '') {
		$temp = $formVars->orderBy;
		if ($formVars->orderType == 'ASC') { 
			$order->$temp='DESC'; 
		}
		else { $order->$temp='ASC'; }
	}
}
else {  
    //error_log('Error in admin/index: the db query failed: query the db for the records \n', 3, "/tmp/my-errors.log");
	echo 'Error in admin/index: the db query failed: query the db for the records <br />';
}



/* get html template */
require('../templates/admin-template.php');


// close db connection
if (isset($mysqli)) { $mysqli->close(); }
?>