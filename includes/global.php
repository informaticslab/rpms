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
require('secure.php');
/* The above file should have these lines inside php tags
$sqlServer = "[location/localhost]";
$username = "[user]";
$password = "[pass]";
$database = "[databaseName]";
*/

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

// create page objects.
$pageData = (object) array(
	'title' => '',
	'navSelected' => '',
	'pageName' => '',
	'active' => '0',
	'Internal' => '0',
	'External' => '0',
	'Collaborative' => '0',
	'UnderReview' => '0',
	'Approved' => '0',
	'Retired' => '0',
	'OtherAdmin' => '0',
	'ToSetUp' => '0',
	'Ready' => '0',
	'ToTakeDown' => '0',
	'OtherTech' => '0'
);
$order = (object) array();

/* Process any form data */

class formVars {
	public
		$orderBy = '',
		$orderType = ''
	;

	// loop through all/any GET/POST and sanitize, make vars
	function sanitizeForm($formVars) {
		if ($_GET) { $formData = $_GET; }
		if ($_POST) { $formData = $_POST; }
		if (isset($formData)) {
			foreach ($formData as $key => $value) {
				// sanitize form data
				$value = filter_var(trim($value), FILTER_SANITIZE_STRING);
				$formVars->$key = $value;
			}
		}
	}
	//email check and sanitize
	function emailCheck($field) {
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

// Pagination functionality.
class pagination {
	public 
		$numPerPage = '',
		$page = '',
		$resultsPageNum = '',
		$pagesTotal = '',
		$previousLink = '',
		$nextLink = ''
	;
	function calculations($resultData) {
		// Create page numbers
		$resultData->resultTotal = $resultData->num_rows;
		//$obj = $resultData->fetch_object();
		$this->pagesTotal = ceil($resultData->resultTotal / $this->numPerPage);
		
		// get this page
		if (isset($page)) { $this->resultsPageNum = $this->page; }
		else { $this->resultsPageNum = 1; }
		
		// set the limit of what will be displayed
		$limitlow = ($this->resultsPageNum - 1) * $this->numPerPage;
		$limithigh = ($this->resultsPageNum * $this->numPerPage) - 1;
		
		// find the first row to display for this page
		$resultData->data_seek($limitlow);
	}
	function pageLinks($pageData) {
		// make pagination links
		$resultsPrevious = $this->resultsPageNum-1;
		$resultsNext = $this->resultsPageNum+1;
		if (isset($search)) { $pS = 'search='.$search.'&'; }
		else $pS = '';
		if (isset($field)) { $pF = 'field='.$field.'&'; }
		else $pF = '';
		
		// if page doesn't exist, leave link blank
		if ($resultsPrevious > 0) {
			$this->previousLink = $pageData->pageName.'?'.$pS.$pF.'orderBy='.$orderBy.'&orderType='.$orderType.'&page='.$resultsPrevious;
		}
		else { $pageData->previousLink = ''; }
		if ($resultsNext <= $this->pagesTotal) {
			$this->nextLink = $pageData->pageName.'?'.$pS.$pF.'orderBy='.$orderBy.'&orderType='.$orderType.'&page='.$resultsNext;
		}
		else $pageData->nextLink = '';
	}
}



// Connect to the db 
$mysqli = new mysqli($sqlServer,$username,$password,$database);
if ($mysqli->connect_errno) {
	// record the error /var/tmp/my-errors.log
    //error_log('Error in includes/global: failure to connect to db. \n', 3, "/tmp/my-errors.log");
	echo '<p>'.$emptySetMsg.'</p>';
}
//else echo '<p>Database Connected successfully</p>';


?>
