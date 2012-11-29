 <?php include '../includes/db.php';
   include '../includes/functions.php';
	if(!isset($_GET['id'])){$_GET['id'] = 'undefined';}
	if(!isset($_POST['op'])){$_POST['op'] = 'undefined';}
   $id = $_GET['id'];
   $op = $_POST['op'];
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
   <title>Details: <?php echo $id?></title>
   <link rel="stylesheet" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/style.css" type="text/css" media="all" />
   <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery-ui.css" />
   <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery.ui.datepicker.css" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/ui.datepicker.js" type="text/javascript"></script>
   <script type="text/javascript">
       $(function() {
	       $("#datepicker1").datepicker();
	       $("#datepicker2").datepicker();
	       $("#datepicker3").datepicker();
	       $.datepicker.setDefaults($.datepicker.regional['']);
	   }
       );
   </script>
</head>
<body>
    <?php switch ($op){
	case "Update":
	 
	       //User info
		$userid = $_POST['userid'];
	    	$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$organization = $_POST['organization'];	
		$method_of_contact = $_POST['method_of_contact'];		
		$db->query("update users set fname='$fname',lname='$lname',phone='$phone',email='$email',organization='$organization', method_of_contact='$method_of_contact' where id='$userid'");
		
		
		//Inserting project overview
		$projectid = $_POST['projectid'];
	    	$title = $_POST['title'];
		$start_date = strtotime($_POST['start_date']);
		$end_date = strtotime($_POST['end_date']);
		$num_personnel = $_POST['num_personnel'];
		$project_summary = $_POST['project_summary'];	
		$summary_status = $_POST['summary_status'];
		$project_type = $_POST['project_type'];
		$project_use = $_POST['project_use'];	
		$db->query("update project set title='$title',start_date='$start_date',end_date='$end_date',num_personnel=$num_personnel,project_summary='$project_summary',summary_status='$summary_status', project_type='$project_type', project_use='$project_use' where id='$projectid'");

		
		//Inserting project resources
		$consultation = $_POST['consultation'];	
		$developer_resources = $_POST['developer_resources'];	
		$lab = $_POST['lab'];	
		$lab_start_date = strtotime($_POST['lab_start_date']);	
		$length = $_POST['length'];	
		$workstations = $_POST['workstations'];	
		$db->query("update project_resources set consultation='$consultation',developer_resources='$developer_resources',lab='$lab',lab_start_date='$lab_start_date',length='$length',workstations=$workstations  where projectid='$projectid'");
		
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
		$db->query("update project_summary set motivation='$motivation',vision='$vision',stakeholder1='$stakeholder1',role1='$role1',stakeholder2='$stakeholder2',role2='$role2',stakeholder3='$stakeholder3',role3='$role3',stakeholder4='$stakeholder4',role4='$role4',stakeholder5='$stakeholder5',role5='$role5',stakeholder6='$stakeholder6',role6='$role6',datasources='$datasources',steps='$steps',metrics='$metrics',project_additional_info='$project_additional_info' where projectid='$projectid'");
		
		//Inserting tech resources - desktop
		for($i=1;$i<7;$i++){
		  $desktop_id = $_POST['desktop_id'.$i];
		  $dt_qty = $_POST['dt_qty'.$i];
		  $dt_operating_system = $_POST['dt_operating_system'.$i];
		  $dt_memory = $_POST['dt_memory'.$i];
		  $dt_disk = $_POST['dt_disk'.$i];
		  $dt_vm = $_POST['dt_vm'.$i];
		  $dt_software = $_POST['dt_software'.$i];
		  $dt_notes = $_POST['dt_notes'.$i];
		     $db->query("update tr_desktop set dt_qty='$dt_qty', dt_operating_system='$dt_operating_system',dt_memory='$dt_memory',dt_disk='$dt_disk',dt_vm='$dt_vm',dt_software='$dt_software',dt_notes='$dt_notes' where id='$desktop_id' and projectid='$projectid'");
		}

		//Inserting tech resources - server
		for($i=1;$i<7;$i++){
		  $server_id = $_POST['server_id'.$i];
		  $server_qty = $_POST['server_qty'.$i];
		  $server_operating_system = $_POST['server_operating_system'.$i];
		  $server_memory = $_POST['server_memory'.$i];
		  $server_disk = $_POST['server_disk'.$i];
		  $server_vm = $_POST['server_vm'.$i];
		  $server_software = $_POST['server_software'.$i];
		  $server_notes = $_POST['server_notes'.$i];
		       $db->query("update tr_server set server_qty='$server_qty',server_operating_system='$server_operating_system',server_memory='$server_memory',server_disk='$server_disk',server_vm='$server_vm',server_software='$server_software',server_notes='$server_notes' where id='$server_id' and projectid='$projectid'");
		}

		//Inserting connectivity
		$outside_access = $_POST['outside_access'];
		$custom_network_config = $_POST['custom_network_config'];
		$outside_agency = $_POST['outside_agency'];
		$inside_agency = $_POST['inside_agency'];
		$additional_info = $_POST['additional_info'];
		
		$db->query("update connectivity set outside_access='$outside_access',custom_network_config='$custom_network_config',outside_agency='$outside_agency',inside_agency='$inside_agency',additional_info='$additional_info' where projectid='$projectid'");
		
		
		//Outcome
	       $outcome_summary = $_POST['outcome_summary'];
	       $db->query("update project_output set outcome_summary='$outcome_summary' WHERE projectid='$projectid'");

	       if($_POST['update_pstatus'] == "Yes"){
		  //Admin Updates
		  $project_status = $_POST['project_status'];
		  $project_modified_by = $_POST['project_modified_by'];
		  $project_comments = $_POST['project_comments'];
		  $project_modified_date = time();
		  $db->query("insert into admin_project_status values ('', $projectid,'$project_status','$project_modified_by','$project_modified_date','$project_comments')");
		 
		 //update log files - Project Status
		    $project_readable_date = date("m/d/Y g:i A",$project_modified_date);
		    $project = "logs/project.txt";
		    $fh = fopen($project, 'a') or die("can't open file project");
		    $stringData = "<tr align='center'><td>$title</td><td>$project_status</td><td>$project_comments</td><td>$project_modified_by</td><td>$project_readable_date</td></tr>";
		    fwrite($fh, $stringData);
		    fclose($fh);
	       }
	       if($_POST['update_istatus'] == "Yes"){
		  $infrastructure_status = $_POST['infrastructure_status'];
		  $infrastructure_modified_by = $_POST['infrastructure_modified_by'];
		  $infrastructure_comments = $_POST['infrastructure_comments'];
		  $infrastructure_modified_date = time();
		  $db->query("insert into admin_infrastructure_status values ('', $projectid,'$infrastructure_status','$infrastructure_modified_by','$infrastructure_modified_date','$infrastructure_comments')");
			
		 
		 //update log files - Infrastructure Status
		    $infrastructure_readable_date = $start_date = date("m/d/Y g:i A",$infrastructure_modified_date);
		    $infrastructure = "logs/infrastructure.txt";
		    $fh = fopen($infrastructure, 'a') or die("can't open file infrastructure");
		    $stringData = "<tr align='center'><td>$title</td><td>$infrastructure_status</td><td>$infrastructure_comments</td><td>$infrastructure_modified_by</td><td>$infrastructure_readable_date</td></tr>";
		    fwrite($fh, $stringData);
		    fclose($fh);
	       }
		//header("Location:http://172.16.0.75/rpms/admin/actions.php?id=$projectid");
		echo "<script type='text/javascript'><!--
		     window.location = 'http://".$_SERVER['SERVER_NAME']."/rpms/admin/actions.php?id=$projectid'
		     //--></script>";

	    break;
	default:
    ?>
    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/rpms/admin/index.php" style="float:left;">&lt;&lt; Back to Projects</a>
    <?php   
	    $results = $db->query("SELECT *,users.id as userid from project
	    JOIN users on project.userid = users.id
            JOIN project_summary on project.id = project_summary.projectid
            JOIN project_resources as resources on project.id = resources.projectid
            JOIN connectivity on project.id = connectivity.projectid
	    JOIN project_output on project.id = project_output.projectid
	    JOIN admin_project_status on project.id = admin_project_status.projectid and admin_project_status.id = (select max(id) from admin_project_status where projectid = $id)
	    JOIN admin_infrastructure_status on project.id = admin_infrastructure_status.projectid and admin_infrastructure_status.id = (select max(id) from admin_infrastructure_status where projectid = $id)
            WHERE project.id=$id");
	
	 while($row = mysql_fetch_assoc($results)){
	       $start_date = date("m/d/Y", $row['start_date']);
	       $end_date = date("m/d/Y", $row['end_date']);
	       $lab_start_date = date("m/d/Y", $row['lab_start_date']);
	      
    ?>
        <h1 style="padding-right:150px;text-align:center;"><?php echo $row['title']; ?>&nbsp</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	
	<!--USER INFO-->
      <table cellspacing="2" cellpadding="0" border="0" align="center" class="tablewidth50">
	 <tr><td><h3>Project ID: <?php echo $id; ?><br>Date of request: <?php echo date("m/d/Y", $row['date_of_request']); ?></h3></td><td align="right"><input type="submit" value="Update" name="op" class="buttonsize"><br><a href="mailto:ldi3@cdc.gov?subject=Engagement%20<?php echo $id;?>%20http://<?php echo $_SERVER['SERVER_NAME']?>/rpms/admin/actions.php?id=<?php echo $id;?>&body=New%20project%20created%20for:%20<?php echo $row['title'];?>.%20Status:<?php echo $row['project_status'];?>,%20Infrastructure%20<?php echo $row['infrastructure_status'];?>">Email Dale</a></td></tr>
	 <tr><td colspan="2"><h1>User Info</h1></td></tr>
	 <tr><td>First Name:</td><td><input type="text" name="fname" value="<?php echo $row['fname'];?>"></td></tr>
	 <tr><td>Last Name:</td><td><input type="text" name="lname" value="<?php echo $row['lname'];?>"></td></tr>
	 <tr><td>Organization</td><td><input type="text" name="organization" value="<?php echo $row['organization']; ?>"></td></tr>
	 <tr><td>Phone:</td><td><input type="text" name="phone" value="<?php echo $row['phone']; ?>"></td></tr>
	 <tr><td>E-mail</td><td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td></tr>
	 <tr><td>Method of Contact</td><td><select name="method_of_contact">
	 <option value="<?php echo $row['method_of_contact']; ?>" selected ><?php echo $row['method_of_contact']; ?></option>
	 <option value="Phone">Phone</option>
	 <option value="E-mail">E-mail</option>
	 </select></td></tr>
      </table>
	
	<!--Overview/Resources-->
      <table cellpadding="0" cellspacing="2" border="0" align="center" class="tablewidth50">
	 <tr><td colspan="2"><h1>Overview/Resources</h1></td></tr>
	 <tr><td>Project Type:</td><td><select name="project_type"><option>---</option><option  value="<?php echo $row['project_type']; ?>" selected><?php echo $row['project_type']; ?></option><option value="Prototype">Prototype</option><option value="Evaluation">Evaluation</option><option value="Hybrid">Hybrid</option></select></td></tr>
	 <tr><td>Project Use:</td><td><select name="project_use"><option>---</option><option  value="<?php echo $row['project_use']; ?>" selected><?php echo $row['project_use']; ?></option><option value="Internal">Internal</option><option value="External">External</option><option value="Collaborative">Collaborative</option></select></td></tr>
	 <tr><td>Title:</td><td> <input type="text" name="title" value="<?php echo $row['title']; ?>"></td></tr>
	 <tr><td class="aligntop">Summary:</td><td><textarea rows="5" name="project_summary" class="textarea_small"><?php echo $row['project_summary']; ?></textarea></td></tr>
	 <tr><td>Private?</td><td><input type="radio" name="summary_status" value="Yes" <?php if ($row['summary_status']=="Yes") {echo "checked";}  ?>/> Yes <input type="radio" name="summary_status" value="No" <?php if($row['summary_status']=="No"){ echo "checked";} ?>/>No </td></tr>
	 <tr><td>Start Date:</td><td> <input type="text" name="start_date" id="datepicker1" value="<?php echo $start_date; ?>"></td></tr>
	 <tr><td>End Date:</td><td> <input type="text" name="end_date" id="datepicker2" value="<?php echo $end_date; ?>"></td></tr>
	 <tr><td>Number of personnel participating in engagement:</td><td><input type="text" name="num_personnel" value="<?php echo $row['num_personnel']; ?>"></td></tr>
	 <tr><td>Do you request a consultation meeting with<br> our Research and Innovation Team?</td><td><input type="radio" name="consultation" value="Yes" <?php if ($row['consultation']=="Yes"){ echo "checked";} ?>/> Yes <input type="radio" name="consultation" value="No" <?php if($row['consultation']=="No"){ echo "checked";} ?>/> No</td></tr>
	 <tr><td>Do you request developer resources from<br> our Prototype Development Team?</td><td><input type="radio" name="developer_resources" value="Yes" <?php if ($row['developer_resources']=="Yes"){ echo "checked";} ?>/> Yes <input type="radio" name="developer_resources" value="No" <?php if($row['developer_resources']=="No"){ echo "checked";} ?>/> No</td></tr>
	 <tr><td>Do you request use of the Informatics R&D Laboratory?</td><td><input type="radio" name="lab" value="Yes" <?php if ($row['lab']=="Yes"){ echo "checked";} ?>/> Yes <input type="radio" name="lab" value="No" <?php if($row['lab']=="No"){ echo "checked";} ?>/> No</td></tr>
	 <tr><td>If yes, when would you like to start<br> using resources in the R&D Lab?</td><td> <input type="text" name="lab_start_date" id="datepicker3" value="<?php echo $lab_start_date; ?>"></td></tr>
	 <tr><td>How long do you expect the project to take?</td><td><input type="text" name="length" value="<?php echo $row['length']; ?>"></td></tr>
	 <tr><td>How many physical workstations <br>(lab seats) do you require?</td><td> <input type="text" name="workstations" maxlength="2" value="<?php echo $row['workstations']; ?>"></td></tr>
	 </table>
        
        <!--Summary-->
      <table cellspacing="2" cellpadding="0" border="0" align="center" class="tablewidth50">
	 <tr><td colspan="2"><h1>Summary</h1></td></tr>
	 <tr><td><p>What is the motivation for this project? Indicate problems, challenges, and/or opportunities driving project interest.  Also, feel free to indicate any technologies you have tried that have not worked well as well as those that you believe may have potential as a solution.<br/><textarea rows="10" name="motivation"><?php echo $row['motivation']; ?></textarea></p>
	     <p>What is your ultimate vision for this project? Ideally, what would you like to be able to do that you cannot do now, or cannot do in the way you want to do it? (optional) <br/><textarea rows="10" name="vision"><?php echo $row['vision']; ?></textarea></p>
	     <p>Who are the stakeholders (users/actors) that this proposed technology change will effect?  Please list key technology users, data suppliers, report recipients, as well as any applicable governing guidelines (e.g., HIPPA).
		 <table cellspacing="2" cellpadding="2" align="center" class="tableform70" id="stakeholder">
		     <tr><td>Stakeholder</td><td>Role</td></tr>
		     <tr><td style="width:50%;"><input type="text" name="stakeholder1" value="<?php echo $row['stakeholder1']; ?>"/></td><td><input type="text" name="role1" value="<?php echo $row['role1']; ?>"/></td></tr>
		     <tr><td><input type="text" name="stakeholder2" value="<?php echo $row['stakeholder2']; ?>"/></td><td><input type="text" name="role2" value="<?php echo $row['role2']; ?>"/></td></tr>
		     <tr><td><input type="text" name="stakeholder3" value="<?php echo $row['stakeholder3']; ?>"/></td><td><input type="text" name="role3" value="<?php echo $row['role3']; ?>"/></td></tr>
		     <tr><td><input type="text" name="stakeholder4" value="<?php echo $row['stakeholder4']; ?>"/></td><td><input type="text" name="role4" value="<?php echo $row['role4']; ?>"/></td></tr>
		     <tr><td><input type="text" name="stakeholder5" value="<?php echo $row['stakeholder5']; ?>"/></td><td><input type="text" name="role5" value="<?php echo $row['role5']; ?>"/></td></tr>
		     <tr><td><input type="text" name="stakeholder6" value="<?php echo $row['stakeholder6']; ?>"/></td><td><input type="text" name="role6" value="<?php echo $row['role6']; ?>"/></td></tr>
		 </table>
	     </p>
	     <p>What is/are the primary sources of data, if any, for the proposed technology? Project data sets must be examined (e.g., for privacy & security) prior to loading into the lab environment. The lab can provide synthetic data if necessary. <br/><textarea rows="10" name="datasources"><?php echo $row['datasources']; ?></textarea></p>
	     <p>If this technology is to be used as part of a general work process, what are the basic high-level steps in the process? Five to six steps should cover most processes at a high level. (optional) <br/><textarea rows="10" name="steps"><?php echo $row['steps']; ?></textarea></p>
	     <p>How will we know if the public health informatics R&D unit is successful regarding this project? What are some measures or metrics we can use to determine if we have achieved a viable solution (e.g., efficiency measures, usability guidelines, accessibility guidelines)?  <br/><textarea rows="10" name="metrics"><?php echo $row['steps']; ?></textarea></p>
	     <p>Is there anything about the nature of the project or key stakeholders not covered above that we should know about to facilitate success? Please feel free to provide any additional information. <br/><textarea rows="10" name="project_additional_info"><?php  echo $row['project_additional_info']; ?></textarea></p>
	     </td>
	 </tr>
      </table>
     
     <!--Technical Requirements Desktop-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
      <tr><td colspan="7"><h1>Technical Requirements Desktop</h1></td></tr>
      <tr><th>#</th><th>Operating System</th><th>Memory</th><th>Disk</th><th>VM?</th><th>Software</th><th>Notes</th></tr>
      <?php
	  $tr_desktop = $db->query("SELECT * from tr_desktop WHERE projectid = $id");
	     $i=1;
	     while($desktop = mysql_fetch_assoc($tr_desktop)){

	     echo "<tr class='aligncenter'><td><select name='dt_qty$i' class='aligncenter'><option value='$desktop[dt_qty]' selected>$desktop[dt_qty]</option>";
	     dropdown(); 
	     echo "</select></td><td><input type='text' name='dt_operating_system$i' value='$desktop[dt_operating_system]'/></td><td><input type='text' name='dt_memory$i' value='$desktop[dt_memory]'/></td><td><input type='text' name='dt_disk$i' value='$desktop[dt_disk]'/></td>
	     <td><select name='dt_vm$i'><option value='$desktop[dt_vm]' selected>$desktop[dt_vm]</option><option value='Yes'>Yes</option><option value='No'>No</option></select></td><td><input type='text' name='dt_software$i' value='$desktop[dt_software]'/></td><td><textarea name='dt_notes$i' class='textarea_small'>$desktop[dt_notes]</textarea></td>
	     </tr><tr><td><input type='hidden' name='desktop_id$i' value='$desktop[id]'></td></tr>"; 
			 
	     $i++;
	  }
	
       ?>
   </table>
  
  <!--Technical Requirements SERVER-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
      <tr><td colspan="7"><h1>Technical Requirements Server</h1></td></tr>
      <tr><th>#</th><th>Operating System</th><th>Memory</th><th>Disk</th><th>VM?</th><th>Software</th><th>Notes</th></tr>
       <?php
	  $tr_server = $db->query("SELECT * from tr_server WHERE projectid = $id");
	     $i=1;
	     while($server = mysql_fetch_assoc($tr_server)){

	     echo "<tr class='aligncenter'><td><select name='server_qty$i' class='aligncenter'><option value='$server[server_qty]' selected>$server[server_qty]</option>";
	     dropdown();
	     echo "</select></td><td><input type='text' name='server_operating_system$i' value='$server[server_operating_system]'/></td><td><input type='text' name='server_memory$i' value='$server[server_memory]'/></td><td><input type='text' name='server_disk$i' value='$server[server_disk]'/></td>
	     <td><select name='server_vm$i'><option value='$server[server_vm]' selected>$server[server_vm]</option><option value='Yes'>Yes</option><option value='No'>No</option></select></td><td><input type='text' name='server_software$i' value='$server[server_software]'/></td><td><textarea name='server_notes$i' class='textarea_small'>$server[server_notes]</textarea></td>
	     </tr><tr><td><input type='hidden' name='server_id$i' value='$server[id]'></td></tr>"; 
			 
	     $i++;
	  }
       ?>
   </table>

<!--Connectivity-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
      <tr><td colspan="2"><h1>Connectivity</h1></td></tr>
      <tr><td>Will you need access to your prototype from outside the R&D Lab network?</td><td><input type="radio" name="outside_access" value="Yes" <?php if ($row['outside_access']=="Yes") {echo "checked";} ?>/> Yes <input type="radio" name="outside_access" value="No" <?php if ($row['outside_access']=="No") {echo "checked";} ?>/> No</td></tr>
      <tr><td>Do you expect custom network configurations to be required?</td><td><input type="radio" name="custom_network_config" value="Yes" <?php if ($row['custom_network_config']=="Yes") {echo "checked";} ?>/> Yes <input type="radio" name="custom_network_config" value="No" <?php if ($row['custom_network_config']=="No") {echo "checked";} ?>/> No</td></tr>
      <tr><td>Will your prototype connect to non-production systems/databases OUTSIDE the agency?</td><td><input type="radio" name="outside_agency" value="Yes" <?php if ($row['outside_agency']=="Yes") {echo "checked";} ?>/> Yes <input type="radio" name="outside_agency" value="No" <?php if ($row['outside_agency']=="No") {echo "checked";} ?>/> No</td></tr>
      <tr><td>Will your prototype connect to non-production systems/databases INSIDE the agency?</td><td><input type="radio" name="inside_agency" value="Yes" <?php if ($row['inside_agency']=="Yes") {echo "checked";} ?>/> Yes <input type="radio" name="inside_agency" value="No" <?php if ($row['inside_agency']=="No") {echo "checked";} ?>/> No</td></tr>
      <tr><td class="aligntop" colspan="2">Please feel free to provide any additional information regarding your technology needs below.<br><textarea rows="5" name="additional_info"><?php  echo $row['additional_info']; ?></textarea></td></tr>
   </table>
    
  <!--Project Status-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
	<tr><td><h1>Project Status</h1></td><td><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/rpms/admin/log_project.php" target="_blank">View project log</a></td></tr>
	<tr><td>Status:</td><td>
	 <select name="project_status"><option value="<?php echo $row['project_status']; ?>" selected><?php echo $row['project_status']; ?></option>
	    <?php
	       $project_status  = "Awaiting Submission,Under Review,Submitted,Rejected,Submitter Revising,Approved,On Hold,Discontinued,Completed";
	       $ps = explode(",", $project_status);
	       foreach($ps as $status){
		  if($status!=$row['project_status']){
		     echo "<option value='$status'>$status</option>";
		  }
	       }
	    ?>
	 </select></td></tr>
        <tr><td>Modified by:</td><td><input type="text" name="project_modified_by" value="<?php echo $row['project_modified_by']; ?>"></td></tr>
        <tr><td class="aligntop">Comments</td><td><textarea rows="5" name="project_comments" class="textarea_small"><?php echo $row['project_comments']; ?></textarea></td></tr>
	<tr><td colspan="2">Check if updating project status or comments<input type="checkbox" value="Yes" name="update_pstatus"></td></tr>
   </table>

<!--Infrastructure Status-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
      <tr><td><h1>Infrastructure Status</h1></td><td><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/rpms/admin/log_infrastructure.php" target="_blank">View infrastructure log</a></td></tr>
      <tr><td>Status:</td><td>
	 <select name="infrastructure_status"><option value="<?php echo $row['infrastructure_status']; ?>" selected><?php echo $row['infrastructure_status']; ?></option>
	     <?php
		   $infrastructure_status  = "To Set Up, On Hold, Setting Up, Ready, Modifying, To Take Down, Taking Down, Removed, Archived";
		   $is = explode(",", $infrastructure_status);
		   foreach($is as $status){
		      if($status!=$row['infrastructure_status']){
			 echo "<option value='$status'>$status</option>";
		      }
		   }
	     ?>
	  </select></td></tr>
      <tr><td>Modified by:</td><td><input type="text" name="infrastructure_modified_by" value="<?php echo $row['infrastructure_modified_by']; ?>"></td></tr>
      <tr><td class="aligntop">Comments:</td><td><textarea rows="5" name="infrastructure_comments" class="textarea_small"><?php echo $row['infrastructure_comments']; ?></textarea></td></tr>
      <tr><td colspan="2">Check if updating infrastructure status or comments<input type="checkbox" value="Yes" name="update_istatus"></td></tr>
   </table>
    
<!--Outcome/Notes-->
   <table cellpadding="0" cellspacing="2" align="center" class="tablewidth50">
      <tr><td><h1>Outcome/Notes</h1></td></tr>
      <tr><td><textarea rows="5" name="outcome_summary"><?php echo $row['outcome_summary']; ?></textarea></td></tr>
      <tr><td colspan="2"><input type="hidden" value="<?php echo $id; ?>" name="projectid"><input type="hidden" value="<?php echo $row['userid']; ?>" name="userid"></td></tr>
      <tr class="aligncenter"><td colspan="2"><input type="submit" value="Update" name="op" class="buttonsize"></td></tr>
    </table>
   </form>
    <?php    
        }//end while
    ?>

    <?php
    }//end switch
    ?>
    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/rpms/admin/index.php"> << Back to Projects</a>
</body>
</html>
