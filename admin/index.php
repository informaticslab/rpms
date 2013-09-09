<?php 
/* This is the administration area for the online php application for RPMS, IRDA, CDC.
This is the functional controller or main page, it loads globals (re-usable functionality) 
and templates (re-usable layout).

Table of contents
	get global data
	(Change these for personalization)
	set this page vars
	query the db
	pagination
	get html template
*/
/* insert some test data into the db
INSERT INTO `project_main` (id,start_date,end_date,project_title,organization,project_use,admin_selection,infra_selection) VALUES (23,'2010-08-10','2010-10-15','Health Statistics Web Presentation System (IBIS) Health Statistics Web Presentation','CGH / DPHSWD / GPHIP','Internal','Approved','Ready');
*/

/* get global data */
require('../includes/global.php');

/* (Change these for personalization) */
$pageData->title = 'RPMS Administration Summary';
$pageData->navSelected = 'Administration';
$pageData->pageName = 'index.php';
$pageData->numPerPage = '20';



/* set this page vars */

// create form data object and sanitize
$formVars = new security;


// defaults for ordering NEEDS MORE WORK 
if (!isset($orderBy)) { $orderBy = 'approved_start'; }

// loop through all db vars: if id or first... then obj thisVar = ASC. FOR ORDERING LINKS, THIS MUST BE COMPLETED
if (!isset($orderType)) {
	$orderType = 'DESC'; 
}


/* query the db */

// query the db for stats/summary. NEED TO ADD EXCLUSIONS WHEN SEARCHING
$queryStats = 'SELECT COUNT(admin_selection) FROM project_main WHERE admin_selection!="Closed" LIMIT 0,10;';
$resultStats = $mysqli->query($queryStats);
$obj = $resultStats->fetch_object();
$countCol = 'COUNT(admin_selection)';
$pageData->active=$obj->$countCol;

$queryStats = 'SELECT project_use, COUNT(project_use) FROM project_main GROUP BY project_use LIMIT 0,10;';
$resultStats = $mysqli->query($queryStats);
if ($resultStats==false) {  
    error_log('Error in admin/index: the db query failed: query the db for stats/summary \n', 3, "/xampp/tmp/my-errors.log");
	echo 'Error in select count result <br />';
}
else {
	// IT WOULD BE BETTER: 
	// to loop through isset to auto create the var by $$obj->project_use=$obj->$countCol; else (not set) $$obj->project_use=0;
	while ( $obj = $resultStats->fetch_object() ) { 
		$countCol = 'COUNT(project_use)';
		if ($obj->project_use=='Internal') { $pageData->internal=$obj->$countCol; }
		elseif ($obj->project_use=='External') { $pageData->external=$obj->$countCol; }
		elseif ($obj->project_use=='Collaborative') { $pageData->collaborative=$obj->$countCol; }
	}
}
/* SAMPLES
$result = mysql_query("SELECT COUNT(*) FROM News");
$row = mysql_fetch_assoc($result);
$size = $row['COUNT(*)'];
	SELECT COUNT(CustomerID) AS tempTableName FROM Orders WHERE CustomerID=7;
	$query = "SELECT type, COUNT(name) FROM products GROUP BY type"; 
	$result = mysql_query($query) or die(mysql_error());
	
	// Print out result
	while($row = mysql_fetch_array($result)){
		echo "There are ". $row['COUNT(name)'] ." ". $row['type'] ." items.";
		echo "<br />";
	}
*/


// query the db for the records. NEED TO ADD EXCLUSIONS WHEN SEARCHING
$queryData = 'SELECT id,project_title,approved_start,approved_end,project_use,admin_selection,infra_selection,totalVM,totalPhysical,totalOnline,totalOther FROM project_main ORDER BY '.$orderBy.' '.$orderType.' LIMIT 0,1000;';
$resultData = $mysqli->query($queryData);
if ($resultData==false) {  
    error_log('Error in admin/index: the db query failed: query the db for the records \n', 3, "/tmp/my-errors.log");
}

// query the db for the primary contact info
// I need to pull the primary's record data from table personnel
// pull rest of data separate based on obj->id, or use a join to pull all at once? 
// should I loop through the queryData to get all the ids?
// JOIN [users on project.userid = users.id] ?
// table personnel, field primary_contact == 'y'


/* pagination */
$pages = new pages;
$pages->pagination($resultData, $pageData);
$pages->pageLinks($pageData);


/* get html template */

require('../templates/admin-template.php');


// close db connection
if (isset($mysqli)) { $mysqli->close(); }
?>