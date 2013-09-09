<?php 
/* 
Table of Contents
	Set variables
	Process any form data
	Pagination functionality
	Connect to the db
*/


/* Set variables */

// set secure vars
$sqlServer = "localhost";
$username = "rpms";
$password = "Budde373";
$database = "rpms";

// global vars
$datestamp = date('Y-m-d'); // SQL YYYY-MM-DD HH:MM:SS
$emptySetMsg = 'There are no engagements that match your query.';
$thisLoc = '/rpms2/';

// Use this array to change <menu>, 
$menu = array(
	'new'=>array('Delete', $thisLoc.'admin/index.php'), 
	'admin'=>array('Email', $thisLoc.'admin/index.php'), 
	'reports'=>array('Copy', $thisLoc.'admin/index.php')
);

// Use this array to change <nav>, 
$nav = array(
	'new'=>array('New Project', $thisLoc.'index.php'), 
	'admin'=>array('Administration', $thisLoc.'admin/index.php'), 
	'reports'=>array('Reports', $thisLoc.'admin/reports.php')
);



/* Process any form data */

// create form data object and sanitize
$formVars = (object) array();
if (isset($_GET)) { $formVars->formData=$_GET; }
if (isset($_POST)) { $formVars->formData=$_POST; }

class security {
// loop through all/any GET/POST and sanitize, make vars
	function sanitizeForm() {
		foreach ($formVars->formData as $key => $value) {
			// sanitize form data
			$value = filter_var(trim($value), FILTER_SANITIZE_STRING);
			// HOW do I add another item in this object?
			$formVars->$$key = $value;
		}
		/* maybe use this instead?
		while (list($key,$value) = each($formdata)){
			echo "while: Key: ".$key . "Value: ".$value."<br />";
			$$key = $value;
		}*/
	}
	//email check and sanitize
	function spamcheck($field) {
	  // sanitizes the e-mail address using FILTER_SANITIZE_EMAIL
	  $field = filter_var($field, FILTER_SANITIZE_EMAIL);
	  // validates the e-mail address using FILTER_VALIDATE_EMAIL
	  if (filter_var($field, FILTER_VALIDATE_EMAIL)) { return TRUE; }
	  else { return FALSE; }
	}
	//$mailcheck1 = spamcheck($_POST['email']);
	//$email = substr($_POST['email'],0,30);
}


/* Pagination */

// create page object. HOW DO i AVOID HAVING TO LIST ALL THESE VARS?
$pageData = (object) array(
	'title' => '',
	'navSelected' => '',
	'pageName' => '',
	'numPerPage' => '',
	'page' => '',
	'resultsPageNum' => '',
	'pagesTotal' => '',
	'resultTotal' => '',
	'active' => '',
	'internal' => '',
	'external' => '',
	'collaborative' => '',
	'underReview' => '',
	'approved' => '',
	'retired' => '',
	'otherAdmin' => '',
	'toSetUp' => '',
	'ready' => '',
	'toTakeDown' => '',
	'otherTech' => ''
);

// Pagination functionality
class pages {
	function pagination($resultData, $pageData) {
		// Create page numbers
		$resultData->resultTotal = $resultData->num_rows;
		//$obj = $resultData->fetch_object();
		$pageData->pagesTotal = ceil($resultData->resultTotal / $pageData->numPerPage);
		
		// get this page
		if (isset($page)) { $pageData->resultsPageNum = $pageData->page; }
		else { $pageData->resultsPageNum = 1; }
		
		// set the limit of what will be displayed
		$limitlow = ($pageData->resultsPageNum - 1) * $pageData->numPerPage;
		$limithigh = ($pageData->resultsPageNum * $pageData->numPerPage) - 1;
		
		// find the first row to display for this page
		$resultData->data_seek($limitlow);
	}
	function pageLinks($pageData) {
		// make pagination links
		$resultsPrevious = $pageData->resultsPageNum-1;
		$resultsNext = $pageData->resultsPageNum+1;
		if (isset($search)) { $pS = 'search='.$search.'&'; }
		else $pS = '';
		if (isset($field)) { $pF = 'field='.$field.'&'; }
		else $pF = '';
		
		// if page doesn't exist, leave link blank
		if ($resultsPrevious > 0) {
			$pageData->previousLink = $pageData->pageName.'?'.$pS.$pF.'orderBy='.$orderBy.'&orderType='.$orderType.'&page='.$resultsPrevious;
		}
		else { $pageData->previousLink = ''; }
		if ($resultsNext <= $pageData->pagesTotal) {
			$pageData->nextLink = $pageData->pageName.'?'.$pS.$pF.'orderBy='.$orderBy.'&orderType='.$orderType.'&page='.$resultsNext;
		}
		else $pageData->nextLink = '';
	}
}



// Connect to the db 
$mysqli = new mysqli($sqlServer,$username,$password,$database);
if ($mysqli->connect_errno) {
	// record the error /var/tmp/my-errors.log
    error_log('Error in includes/global: failure to connect to db. \n', 3, "/tmp/my-errors.log");
	echo '<p>'.$emptySetMsg.'</p>';
}
//else echo '<p>Database Connected successfully</p>';


?>
