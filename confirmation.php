<?php
    include 'includes/db.php';
?>
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta name="generator" content="HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
    <meta http-equiv="content-type" content="text/html; charset=us-ascii" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="<?php  echo  $_SERVER['SERVER_NAME'] ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="<?php  echo  $_SERVER['SERVER_NAME']; ?>/css/jquery-ui.css" />
    <link rel="stylesheet" href="css/base.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.1.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>

  <title>CDC Informatics R&amp;D Lab</title>
</head>
<body>
    <?php
    	//Inserting user info
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$organization = $_POST['organization'];
		$method_of_contact = $_POST['method_of_contact'];
		
		$db->query("insert into users values('','$fname','$lname','$email','$phone','$organization','$method_of_contact')");
    	
		//Inserting project overview
		$last_id_user = mysql_insert_id();
		$title = $_POST['title'];
		$time = time();
		$date_of_request = strtotime(date("m/d/Y", $time)); 
		$start_date = strtotime($_POST['start_date']);
		$end_date = strtotime($_POST['end_date']);
		$num_personnel = $_POST['num_personnel'];
		
		$db->query("insert into project values ('', $last_id_user,'$title','$date_of_request','$start_date','$end_date','$num_personnel','','','','')");
		
		//Project ID for the rest of the tables
		$last_id_project = mysql_insert_id();
		
		//Inserting project resources
		$consultation = $_POST['consultation'];	
		$developer_resources = $_POST['developer_resources'];	
		$lab = $_POST['lab'];	
		$lab_start_date = strtotime($_POST['lab_start_date']);	
		$length = $_POST['length'];	
		$workstations = $_POST['workstations'];
		
		$db->query("insert into project_resources values ('', $last_id_project,'$consultation','$developer_resources','$lab','$lab_start_date','$length','$workstations')");
		
		//Inserting project summary
		$motivation = $_POST['motivation'];	
		$vision = $_POST['vision'];	
		$stakeholder1 = $_POST['stakeholder1'];	
		$role1 = $_POST['role1'];	
		$stakeholder2 = $_POST['stakeholder2'];	
		$role2 = $_POST['role2'];
		$stakeholder3 = $_POST['stakeholder3'];	
		$role3 = $_POST['role3'];
		$stakeholder4 = $_POST['stakeholder4'];	
		$role4 = $_POST['role4'];	
		$stakeholder5 = $_POST['stakeholder5'];	
		$role5 = $_POST['role5'];
		$stakeholder6 = $_POST['stakeholder6'];	
		$role6 = $_POST['role6'];
		$datasources = $_POST['datasources'];	
		$steps = $_POST['steps'];	
		$metrics = $_POST['metrics'];	
		$project_additional_info = $_POST['project_additional_info'];	
		$db->query("insert into project_summary values ('', $last_id_project,'$motivation','$vision','$stakeholder1','$role1','$stakeholder2','$role2','$stakeholder3','$role3','$stakeholder4','$role4','$stakeholder5','$role5','$stakeholder6','$role6','$datasources','$steps','$metrics','$project_additional_info')");
		
		//Inserting tech resources - desktop
		for($i=1;$i<7;$i++){
		    	$dt_qty = $_POST['dt_qty'.$i];
			$dt_operating_system = $_POST['dt_operating_system'.$i];
			$dt_memory = $_POST['dt_memory'.$i];
			$dt_disk = $_POST['dt_disk'.$i];
			$dt_vm = $_POST['dt_vm'.$i];
			$dt_software = $_POST['dt_software'.$i];
	    		$dt_notes = $_POST['dt_notes'.$i];
			$db->query("insert into tr_desktop values ('', $last_id_project,'$dt_qty','$dt_operating_system','$dt_memory','$dt_disk','$dt_vm','$dt_software','$dt_notes')");
		}

		//Inserting tech resources - server
		for($i=1;$i<7;$i++){
		    $server_qty = $_POST['server_qty'.$i];
		    $server_operating_system = $_POST['server_operating_system'.$i];
		    $server_memory = $_POST['server_memory'.$i];
		    $server_disk = $_POST['server_disk'.$i];
		    $server_vm = $_POST['server_vm'.$i];
		    $server_software = $_POST['server_software'.$i];
		    $server_notes = $_POST['server_notes'.$i];
			$db->query("insert into tr_server values ('', $last_id_project,'$server_qty','$server_operating_system','$server_memory','$server_disk','$server_vm','$server_software','$server_notes')");
		    }


		//Inserting connectivity
		$outside_access = $_POST['outside_access'];
		$custom_network_config = $_POST['custom_network_config'];
		$outside_agency = $_POST['outside_agency'];
		$inside_agency = $_POST['inside_agency'];
		$additional_info = $_POST['additional_info'];
		$db->query("insert into connectivity values ('', $last_id_project,'$outside_access','$custom_network_config','$outside_agency','$inside_agency','$additional_info')");
		
		
		$project_status = "Submitted to Team";
		$db->query("insert into admin_project_status (id, projectid, project_status, project_modified_by)  values('', $last_id_project,'$project_status', 'System')");
		$db->query("insert into admin_infrastructure_status (id, projectid,infrastructure_status,infrastructure_modified_by) values ('', $last_id_project,'Waiting for Approval', 'System')");
		
		//Project Outcome
		$db->query("insert into project_output (id, projectid)  values('', $last_id_project)");
		//email confirmations/info here
				
	?>
	<div align="center">
    <div class="header">
	<span class="alignleft">R&D LAB ENGAGEMENT REQUEST FORM</span><span class="alignright">(v.1.5)</span>
    </div>
	<div class="confirmation">
	    Thank you for your submission to our R&D Lab. We will review your submission, and will be following-up with you shortly.<br>
If you have any questions, please email us at <a href="mailto:InformaticsLab@cdc.gov">InformaticsLab@cdc.gov</a>.
<br/>
<br/>
<a href="admin">Admin</a>
	</div>
</body>
</html>
