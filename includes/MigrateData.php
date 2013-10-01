<?php 
/* 
Migrate data from old tables in db rpms to new (RPMSv2.0) tables in db rpms

Table of Contents
	Create variables and start web page
	Pull and test data from old db tables
	Connect to db and run preliminary tests
	Insert into new tables if validated


Todo List
Finish pulling old data LN 256 and making new objects
CREATE DATE AND DATETIME REGEX, LN 165
Fix data fields:  Insert into new tables if validated
Place a repeat check for all old tables: 1.users, 4.connectivity to project_main, 6.project_output, 7.project_resources, 8.project_summary
Add an else error on all db queries

*/


/*** Create variables and start web page ***/

// variables
$pageVars = (object) array(
	'proceed' => 'n'
);
$dbTables = array(
	'users',
	'admin_infrastructure_status',
	'admin_project_status',
	'connectivity',
	'project',
	'project_output',
	'project_resources',
	'project_summary',
	'tr_desktop',
	'tr_server',
	'project_main',
	'personnel',
	'stakeholders',
	'resources',
	'project_date_history',
	'status_history',
	'resources_history'
);

// receive confirmation from form if exist
if (isset($_POST)) {
	foreach ($_POST as $key => $value) {
		// sanitize form data
		$value = filter_var(trim($value), FILTER_SANITIZE_STRING);
		$pageVars->$key = $value;
	}
}

// start htm page 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" />
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
<style type="text/css">
	p { color:#0031A3; }
	.error { color:red; font-weight:bold; }
</style>
<title>RPMS Migrate Data</title>

</head>
<body>
	<h1>RPMS Migrate Data</h1>
<?php

require('secure.php');

echo '<p>Create variables and start web page is completed.</p>';
echo '';



/*** Connect to db and run preliminary tests ***/


// Connect to the db 
echo '<h2>Connect to the db...</h2>';
$mysqli = new mysqli($sqlServer,$username,$password,$database);
if ($mysqli->connect_errno) {
	// record the error /var/tmp/my-errors.log
    //error_log('Error in includes/global: failure to connect to db. \n', 3, "/tmp/my-errors.log");
	echo '<p class="error">Error connecting to the DB "'.$database.'"</p>';
}
else echo '<p>Database connected successfully.</p>';


// test that old and new tables exist in db
echo '<h2>Test that old and new tables exist in db...</h2>';
foreach ($dbTables as $value) {
	$queryData = 'SELECT id FROM '.$value.' LIMIT 1;';
	// SHOW [FULL] TABLES [{FROM | IN} db_name] [LIKE 'pattern' | WHERE expr]
	if ($resultData = $mysqli->query($queryData)) {
		echo '<p>Table "'.$value.'" connected successfully.</p>';
	}
	else { 
		echo '<p class="error">Error connecting to the "'.$value.'" table.</p>';
	}
}

// test project table for multiple userid values
echo '<h2>test project table for multiple userid values</h2>';

$queryData = 'SELECT * FROM project ORDER BY userid;';
if ($resultData = $mysqli->query($queryData)) {
	// create an array of the userids
	$userNum = array();
	while ($obj=$resultData->fetch_object()) {
		$userNum[] = $obj->userid;

	}
	// test for duplicates in the array
	$dups = array();
	foreach(array_count_values($userNum) as $val => $c) {
		if($c > 1) $dups[] = $val;
	}
	
	if ($dups >= 1) { 
		function makeastring($a, $b) { return $a.", ".$b; }
		$dups = array_reduce($dups, 'makeastring');
		echo '<p class="error">Error: there are duplicate projects for userid/s '.$dups.'</p>'; 
	}
	else { echo '<p>Duplicates not found, test successful.</p>'; }
}
echo '<p>Connect to db and run preliminary tests is completed.</p>';




/*** Pull and test data from old db tables ***/


// pull data from old tables, reformat or combine old data, test that data meets new db formats and lengths
echo '<h2>pull data from old tables, reformat and test </h2>';

// create storage objects for new tables
$project = (object) array(); // for table 1.project_main
$personnel = (object) array(); // for table 2.personnel
$stakeholders = (object) array(); // for table 3.stakeholders
$resources = (object) array(); // for table 4.resources
$status = (object) array(); // for table 6.status_history



$queryData = 'SELECT * FROM project ORDER BY id;';
if ($resultData = $mysqli->query($queryData)) {

	while ($projectData=$resultData->fetch_object()) {

		/*** test and report function ***/
		function testData($value, $length, $dateFormat=null) {
			$value = trim($value);
			$strArray = str_split($value, $length);
			
			if (isset($dateFormat)) {
				if ($dateFormat=='date') { 
					// date format: YYYY-MM-DD
				}
				elseif ($dateFormat=='datetime') {
					// datetime format: YYYY-MM-DD HH:MM:SS
				}
			}
			elseif (isset($strArray[1])) {
				echo '<p class="error">Data for record id "'.$project->id.'"" has failed length test for a field.';
				echo '<br/>Length allowed: '.$length;
				echo '<br/>Valid text: '.$strArray[0];
				echo '<br/>Invalid text: '.$strArray[1].' </p>';
			}
			elseif ( $length==1 && ($value!=0 || $value!=1)) {
				echo '<p class="error">Data for record id "'.$project->id.'"" has failed length test for a field.';
				echo '<br/>Boolean value: '.$value.'</p>';
			}
			return $strArray[0];
		}


		// 5.project to project_main.
		// use these first 2 to pull data in other tables
		echo '<p>$projectData->id = '.$projectData->id.'</p>';
		$project->id = testData($projectData->id, 5);
		$project->userid = testData($projectData->userid, 5);

		$project->project_title = testData($projectData->title, 200);
		$project->project_created = testData($projectData->date_of_request, 10, 'datetime'); 
		$project->approved_start = testData($projectData->start_date, 10, 'date');
		$project->approved_end = testData($projectData->end_date, 10, 'date');
		$project->project_type = testData($projectData->project_type, 50);
		$project->project_use = testData($projectData->project_use, 50);
		//combine and test project_summary fields (not the same as project_summary table)
		$project->summary = $projectData->project_summary.'. Num of personnel: '.$projectData->num_personnel.'. Summary status: '.$projectData->summary_status.'. ';
		$project->summary = testData($project->summary, 1000);



		// 1.users to personnel as primary? $project->userid
		$queryData = 'SELECT * FROM users WHERE id="'.$project->userid.'" LIMIT 0,1;';
		if ($resultData = $mysqli->query($queryData)) {
			$data = $resultData->fetch_object();

			$personnel->first_name = testData($data->fname, 100);
			$personnel->last_name = testData($data->lname, 100);
			$personnel->email = testData($data->email, 100);
			$personnel->phone = testData($data->phone, 50);
			$personnel->organization = testData($data->organization, 200);
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}


		// 2.admin_infrastructure_status to project_main and status_history. 
		// use $project->id to pull: admin_infrastructure_status, admin_project_status, connectivity, project_output, project_resources to project_main and status_history
		global $num;
		$num = 1; // this is used for both infrastructure and admin below
		$queryData = 'SELECT * FROM admin_infrastructure_status WHERE projectid="'.$project->id.'" ORDER BY infrastructure_modified_date DESC;';
		if ($resultData = $mysqli->query($queryData)) {

			// fetch the first one for project_main
			$data = $resultData->fetch_object();
			$project->infra_change_date  = testData($data->infrastructure_modified_date, 19, 'datetime');
			$project->infra_selection = testData($data->infrastructure_status, 50);
			$project->infra_name = testData($data->infrastructure_modified_by, 50);
			$project->infra_notes = testData($data->infrastructure_comments, 5);

			// fetch the rest for status_history, these are type tech
			// $num = 1;
			while ($data=$resultData->fetch_object()) {
				$status->$num->type_of_status = 'infrastructure';
				$status->$num->status_changed_date = testData($data->infrastructure_modified_date, 19, 'datetime');
				$status->$num->status_selection = testData($data->infrastructure_status, 50);
				$status->$num->status_name = testData($data->infrastructure_modified_by, 50);
				$status->$num->status_notes = testData($data->infrastructure_comments, 200);
				$num++;
			}
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}



		// 3.admin_project_status to project_main and status_history
		$queryData = 'SELECT * FROM admin_project_status WHERE projectid="'.$project->id.'" ORDER BY project_modified_date DESC;';
		if ($resultData = $mysqli->query($queryData)) {

			// fetch the first one for project_main
			$data = $resultData->fetch_object();
			$project->admin_change_date = testData($data->project_modified_date, 19, 'datetime');
			$project->admin_selection = testData($data->project_status, 50);
			$project->admin_name = testData($data->project_modified_by, 50);
			$project->admin_notes = testData($data->project_comments, 5);

			// fetch the rest for status_history
			// $num = 1; continue numbering from infrastructure above
			while ($data=$resultData->fetch_object()) {
				$status->$num->type_of_status = 'admin';
				$status->$num->status_changed_date = testData($data->project_modified_date, 19, 'datetime');
				$status->$num->status_selection = testData($data->project_status, 50);
				$status->$num->status_name = testData($data->project_modified_by, 50);
				$status->$num->status_notes = testData($data->project_comments, 200);
				$num++;
			}
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}



		// 4.connectivity to project_main
		$queryData = 'SELECT * FROM connectivity WHERE projectid="'.$project->id.'" LIMIT 0,1;';
		if ($resultData = $mysqli->query($queryData)) {
			$data = $resultData->fetch_object();

			$project->outside_resources = testData($data->outside_access, 1);
			// combine for outside_notes
			$project->outside_notes = 'Custom config: '.$data->custom_network_config.'. Outside the agency: '.$data->outside_agency.'. Inside the agency: '.$data->inside_agency.'. Additional: '.$data->additional_info;
			$project->outside_notes = testData($project->outside_notes, 1000);
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}


		// 6.project_output to project_main
		$queryData = 'SELECT * FROM project_output WHERE projectid="'.$project->id.'" LIMIT 0,1;';
		if ($resultData = $mysqli->query($queryData)) {
			$data = $resultData->fetch_object();
			
			$project->project_outcome = testData($data->outcome_summary, 1000);
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}


		// 7.project_resources to project_main
		$queryData = 'SELECT * FROM project_resources WHERE projectid="'.$project->id.'" LIMIT 0,1;';
		if ($resultData = $mysqli->query($queryData)) {
			$data = $resultData->fetch_object();
			
			$project->start_date = testData($data->lab_start_date, 10, 'date');
			// combine consultation into summary
			$project->summary = $project->summary.'. Consultation: '.$data->consultation.'. ';
			$project->summary = testData($project->summary, 1000);
			// combine for additional_information
			$project->additional_information = 'Developer Resources: '.$data->developer_resources.'. Request lab use: '.$data->lab.'. Length of time: '.$data->length.'. Num of workstations: '.$data->workstations;
			$project->additional_information = testData($project->additional_information, 1000);
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}


		// 8.project_summary to project_main and stakeholders.
		$queryData = 'SELECT * FROM project_summary WHERE projectid="'.$project->id.'" LIMIT 0,1;';
		if ($resultData = $mysqli->query($queryData)) {
			$data = $resultData->fetch_object();
			
			//combine motivation into project_summary
			$project->summary = $project->summary.'. Motivation: '.$projectData->motivation.'. ';
			$project->summary = testData($project->summary, 1000);
			$project->goals = testData($data->vision, 1000);

			// add stakeholders to table stakeholders, name and role
			for ($num=1; $num<=6; $num++) {
				$currentStakeholder = 'stakeholder'.$num;
				$stakeholders->$num->name = testData($data->$currentStakeholder, 100);
				$stakeholders->$num->role = testData($data->$currentStakeholder, 100);
			}

			$project->test_data_notes = testData($data->datasources, 1000);
			$project->success = testData($data->metrics, 1000);
			// combine for additional_information
			$project->additional_information = $data->project_additional_info.'. '.$project->additional_information;
			$project->additional_information = testData($project->additional_information, 1000);
			// combine for summary
			$project->summary = $data->summary.'. Project steps: '.$data->steps;
			$project->summary = testData($project->summary, 1000);
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}



		// function to run both tr_desktop and tr_server (below)
		$project->num = 1;
		function resolveVM($resultData) {
				while ($data=$resultData->fetch_object()) { 
					echo '<br/>var $project->num='.$project->num;
					$num = $project->num;
					$resources->$num->request_date = testData($data->project_status, 19, datetime);
					$resources->$num->resource_type = testData($data->project_status, 20);
					$resources->$num->device_config = testData($data->dt_operating_system, 100);
					
					// decide ont he type based on old field of vm or not
					if ($data->dt_vm == 'Yes') { $resources->$num->resource_type = 'virtual'; }
					elseif ($data->dt_vm == 'No') { $resources->$num->resource_type = 'physical'; }
					else { $resources->$num->resource_type = 'other'; }
					// test that it is resolving correctly
					echo '<br/>VM should be "virtual, physical, else other": '.$resources->$num->resource_type;

					// combine all details into notes
					$resources->$num->notes = 'Qty: '.$data->dt_qty.'. Memory: '.$data->dt_memory.'. Disk: '.$data->dt_disk.'. Software: '.$data->dt_software.'. Notes: '.$data->dt_notes;
					$resources->$num->notes = testData($data->project_status, 1000);

					$num++;
				}
		}

		// 9.tr_desktop to resources. Expecting more than one per project!
		$queryData = 'SELECT * FROM tr_desktop WHERE projectid="'.$project->id.'";';
		if ($resultData = $mysqli->query($queryData)) {
			$testTemp = resolveVM($resultData);
			if (isset($testTemp)) { echo '<br/>Success for tr_desktop'; }
			else '<p>Error for tr_desktop</p>';
		}
		else {
			echo '<p class="error">Query failed: '.$queryData.'.</p>';
		}

		// 10.tr_server to resources. Expecting more than one per project!
		$queryData = 'SELECT * FROM tr_server WHERE projectid="'.$project->id.'";';
		if ($resultData = $mysqli->query($queryData)) {
			$testTemp = resolveVM($resultData);
			if (isset($testTemp)) { echo '<br/>Success for tr_server'; }
			else '<p>Error for tr_server</p>';
		}

		echo '<p>Pull and test data from old db tables is completed for record:id '.$project->id.'.</p>';



/*** Insert into new tables if validated

		// if ready, proceed with insert
		if ($pageVars->proceed == '1') {
			function insertError($insertData) {
				if ($insertData=$mysqli->query($queryData)) {
					echo '<br/>Insert of record:id '.$project->id.' is successful.';
				}
				else {
					echo '<p style="color:red;font-weight:bold;">Error on insert of record:id '.$project->id.'.</p>';
				}
			}

			// new data in object $project, $status.

			// insert into project_main infrastructure adn admin status
			$insertData = 'INSERT INTO project_main (id,project_title,project_created,approved_start,approved_end,summary,project_type,project_use,infra_selection,infra_name,infra_change_date,infra_notes,admin_change_date,admin_selection,admin_name,admin_notes) VALUES ('.$project->id.','.$project->title.',"'.$project->date_of_request.'","'.$project->start_date.'","'.$project->end_date.','.$project_summary.'","'.$project->project_type.'","'.$project->project_use.'","'.$project->infrastructure_status.'","'.$project->infrastructure_modified_by.'","'.$project->infrastructure_modified_date.'","'.$project->infrastructure_comments.'","'.$project->project_modified_date.'","'.$project->project_status.'","'.$project->project_modified_by.'","'.$project->project_comments.'");';
			// send query and display any errors
			insertError($insertData);

			// insert into status_history the admin data, cycle through
			$num = 1;
			while ($status->$num) {
				$insertData = 'INSERT INTO status_history (projectid,type_of_status,status_changed_date,status_selection,status_name,status_notes) VALUES ("'.$project->id.'","administration", '.$status->$num->project_modified_date.'","'.$status->$num->project_status .'","'.$status->$num->project_modified_by.'","'.$status->$num->project_comments.'");';
				// send query and display any errors
				insertError($insertData);
				$num++;
			}

			// insert into status_history the infrastructure data, cycle through 
			$num = 1;
			while ($status->$num) {
				$insertData = 'INSERT INTO status_history (projectid,type_of_status,status_changed_date,status_selection,status_name,status_notes) VALUES ("'.$project->id.'","infrastructure","'.$status->$num->infrastructure_modified_date.'","'.$status->$num->infrastructure_status.'","'.$status->$num->infrastructure_modified_by.'","'.$status->$num->infrastructure_comments.'");';
				// send query and display any errors
				insertError($insertData);
				$num++;
			}
			
			// insert into stakeholders

			// insert into personnel

			// insert into resources

		}
 ***/
	}
	echo '<p>Completed testing data for ALL records.</p>';
}

echo '<p>Insert into new tables if validated is completed.</p>';


// warning message has two options: (fix problem and) refresh the page, Or continue (warning isset)


?>

<h1>EOF</h1>

</body>
</html>
