 <?php
 $page = $_GET['page'];
 
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=us-ascii" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery.ui.datepicker.css" />
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/ui.datepicker.js" type="text/javascript"></script>
    <script src="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/js/jquery.tablesorter.min.js" type="text/javascript"></script>

 

<script type="text/javascript">
    
    //datepicker
    $(function() {
	
	//date picker
	$("#from").datepicker({ numberOfMonths: [1,3] });
	$("#to").datepicker({ numberOfMonths: [1,3] });
	$("#from2").datepicker({ numberOfMonths: [1,3] });
	$("#to2").datepicker({ numberOfMonths: [1,3] });
	$("#from3").datepicker({ numberOfMonths: [1,3] });
	$("#to3").datepicker({ numberOfMonths: [1,3] });
	$("#from4").datepicker({ numberOfMonths: [1,3] });
	$("#to4").datepicker({ numberOfMonths: [1,3] });
	$("#from5").datepicker({ numberOfMonths: [1,3] });
	$("#to5").datepicker({ numberOfMonths: [1,3] });
	$("#from6").datepicker({ numberOfMonths: [1,3] });
	$("#to6").datepicker({ numberOfMonths: [1,3] });
	$("#from7").datepicker({ numberOfMonths: [1,3] });
	$("#to7").datepicker({ numberOfMonths: [1,3] });
	$("#from8").datepicker({ numberOfMonths: [1,3] });
	$("#to8").datepicker({ numberOfMonths: [1,3] });
	$("#from9").datepicker({ numberOfMonths: [1,3] });
	$("#to9").datepicker({ numberOfMonths: [1,3] });
	$("#from10").datepicker({ numberOfMonths: [1,3] });
	$("#to10").datepicker({ numberOfMonths: [1,3] });
	$.datepicker.setDefaults($.datepicker.regional['']);
    });
</script>

</head>
<body>
<?php switch ($page){
        case set:
?>

 <a href="results.php?op=week">Projects submitted in the past 7 days</a><br>
 <a href="results.php?op=month_30">Projects submitted in the past 30 days</a><br>
 <a href="results.php?op=cur_month">Projects submitted this month</a><br>
 <a href="results.php?op=cur_fis_year">Projects submitted in the  current fiscal year</a><br>
 <a href="results.php?op=cal_year">Projects submitted in the current calendar year</a><br>
Projects submitted from: <form action="results.php?op=search" method="post">From: <input type="text" name="from" id="from"> to: <input type="text" name="to" id="to"><input type="submit" value="Submit"> </form>

<?php  break;  case count_ps: ?>

   Number of projects based on project status
   <br>============================<br>
     Search:
    <form action="results.php?op=count_ps" method="post">
	From: <input type="text" name="from2" id="from2">
	To: <input type="text" name="to2" id="to2">
	Project Status:
	<select name="status">
	    <option value="Submitted to Team">Submitted</option>
	    <option value="Rejected by Team">Rejected</option>
	    <option value="Under Review by Team">Under Review</option>
	    <option value="Approved by Team">Approved</option>
	    <option value="Infrastructure set-up completed">Active</option>
	    <option value="Completed">Completed</option>
	</select>
	<input type="submit" value="Submit">
    </form>
 
   <?php break; case count_vm: ?>

    Number of unique VMs in use
     <br>============================<br>
    Search: <form action="results.php?op=count_vm" method="post">
	    From: <input type="text" name="from3" id="from3">
	    To: <input type="text" name="to3" id="to3">
		<input type="submit" value="Submit">
	    </form>
    
     <?php break; case avg_vm: ?>
  
    Average number of total VMs in use
     <br>============================<br>
    Search: <form action="results.php?op=avg_vm" method="post">
	    From: <input type="text" name="from4" id="from4">
	    To: <input type="text" name="to4" id="to4">
		<input type="submit" value="Submit">
	    </form>
    

     <?php break; case max_vm: ?>
 
    Max num comp
    <br>============================<br>
     Search:
    <form action="results.php?op=max_vm" method="post">
	From: <input type="text" name="from5" id="from5">
	To: <input type="text" name="to5" id="to5">
	<input type="submit" value="Submit">
    </form>
 
     
      <?php break; case count_pt: ?>

     Number of projects based on type
     <br>============================<br>
	Search:
	<form action="results.php?op=count_pt" method="post">
	From:
	<input type="text" name="from6" id="from6"> To: <input type="text" name="to6" id="to6">
	Type of Project:
	    <select name="project_type">
		<option value="Prototype">Prototype</option>
		<option value="Evaluation">Evaluation</option>
		<option value="Hybrid">Hybrid</option>
	    </select>
	    Project Use:
	    <select name="project_use">
		<option value="Internal CDC use">Internal CDC use</option>
		<option value="External CDC use">External CDC use</option>
	    </select>
	    <input type="submit" value="Submit">
	</form>
      
    
     <?php break; case avg_len: ?>
   
     Average Project Length
    <br>============================<br>
	Search:
	<form action="results.php?op=avg_len" method="post">
	From:
	<input type="text" name="from8" id="from8"> To: <input type="text" name="to8" id="to8">
	 <input type="submit" value="Submit">
	</form>

     
     <?php break; case avg_len_setup: ?> 
   
     Average time from approval to set up
    <br>============================<br>
	Search:
	<form action="results.php?op=avg_len_setup" method="post">
	From:
	<input type="text" name="from9" id="from9"> To: <input type="text" name="to9" id="to9">
	 <input type="submit" value="Submit">
	</form>
    
<?php break; case graphs: ?>

Average time from approval to infrastructure set up<br>
<a href="results.php?op=approve_week">Projects submitted in the past 7 days</a> | <a href="results.php?op=approve_30days">Projects submitted in the past 30 days</a> | <a href="results.php?op=approve_cur_month">Projects submitted this month</a> | <a href="results.php?op=approve_cur_fis_year">Projects submitted this fiscal year</a> | <a href="results.php?op=approve_cur_year">Projects submitted this calendar year</a>
<br>
<br>
Average time of project<br>
<a href="results.php?op=length_week">Projects submitted in the past 7 days</a> | <a href="results.php?op=length_30days">Projects submitted in the past 30 days</a> | <a href="results.php?op=length_cur_month">Projects submitted this month</a> | <a href="results.php?op=length_cur_fis_year">Projects submitted this fiscal year</a> | <a href="results.php?op=length_cur_year">Projects submitted this calendar year</a>

<?php break; }//end op switch   ?>
 
 <p class="classname"></p>
<< <a href="index.php">Back to dashboard</a>
  
</body>
</html>
