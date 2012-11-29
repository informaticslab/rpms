 <?php
 include 'includes/db.php';
 include 'includes/functions.php';
 ?>
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta name="generator" content="HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
    <meta http-equiv="content-type" content="text/html; charset=us-ascii" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/css/jquery.ui.datepicker.css" />

    <!-- JQuery -->

 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/ui.datepicker.js" type="text/javascript"></script>
    <script src="http://<?php  echo  $_SERVER['SERVER_NAME'] ?>/rpms/js/jquery.textarea-expander"></script>


  <title>CDC Informatics R&amp;D Lab</title>


<!-- JS -->
<meta charset="UTF-8" />

<script type="text/javascript">
$(function() {
    
	//date picker
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
	$("#datepicker3").datepicker();
	$.datepicker.setDefaults($.datepicker.regional['']);
	
	//tabs next/previous
	var $tabs = $('#tabs').tabs();

	$(".ui-tabs-panel").each(function(i){

	  var totalSize = $(".ui-tabs-panel").size() - 1;

	  if (i != totalSize) {
	      next = i + 2;
		  $(this).append("<a href='#' class='next-tab mover' id='next' rel='" + next + "'>Next Page &#187;</a>");
	  }

	  if (i != 0) {
	      prev = i;
		  $(this).append("<a href='#' class='prev-tab mover' id='previous' rel='" + prev + "'>&#171; Prev Page</a>");
	  }

	});

	$('.next-tab, .prev-tab').click(function() { 
	   $tabs.tabs('select', $(this).attr("rel"));
	   return false;
       });


});

//email and phone format validation
$(document).ready(function() {
	//email
	$("#validate-email").bind("keyup", (function(){
	
		var email = $("#validate-email").val();
	
		if(email != 0)
		{
			if(isValidEmailAddress(email))
			{
				$("#validEmail").css({
					"visibility":"hidden"
				});
			} else {
    
				$("#validEmail").css({
					"visibility":"visible"
				});
			}
		} else {
			$("#validEmail").css({
				"background-image": "none"
			});			
		}
		
	
	}));
	
	//phone
	$("#validate-phone").bind("keyup", (function(){
    
	    var phone = $("#validate-phone").val();
    
	    if(phone != 0)
	    {
		    if(isValidPhone(phone))
		    {
			    $("#validPhone").css({
				     "visibility":"hidden"
			    });
		    } else {

			    $("#validPhone").css({
				    "visibility":"visible"
			    });
		    }
	    } else {
		    $("#validPhone").css({
			    "background-image": "none"
		    });			
	    }
	    
    
    }));

	//start-date
	$("#datepicker1").bind("keyup change", (function(){
	
		var startDate = $("#datepicker1").val();
	
		if(startDate != 0)
		{
			if(isValidStartDate(startDate))
			{
				$("#validStartDate").css({
					"visibility":"hidden"
				});
			} else {
    
				$("#validStartDate").css({
					"visibility":"visible"
				});
			}
		} else {
			$("#validStartDate").css({
				"background-image": "none"
			});			
		}
		
	
	}));
	
    	//end-date
	$("#datepicker2").bind("keyup change", (function(){
	
		var endDate = $("#datepicker2").val();
	
		if(endDate != 0)
		{
			if(isValidEndDate(endDate))
			{
				$("#validEndDate").css({
					"visibility":"hidden"
				});
			} else {
    
				$("#validEndDate").css({
					"visibility":"visible"
				});
			}
		} else {
			$("#validEndDate").css({
				"background-image": "none"
			});			
		}
		
	
	}));

});

function isValidEmailAddress(emailAddress) {
	var pattern1 = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern1.test(emailAddress);
}

function isValidPhone(phoneNum) {
    var pattern2 = new RegExp(/\(?\s?[2-9][0-9]{2}[(\s?\)?\s?)\-\.]{1,3}[0-9]{3}[\s\-\.]{1,3}[0-9]{4}/);
    return pattern2.test(phoneNum);
}

function isValidStartDate(startDate) {
    var pattern3 = new RegExp(/(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d/);
    return pattern3.test(startDate);
}

function isValidEndDate(endDate) {
    var pattern4 = new RegExp(/(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d/);
    return pattern4.test(endDate);
}


</script>

 <!-- /JS -->
	
</head>

<body>
<div align="center">
    <div class="header">
	<span class="alignleft">R&D LAB ENGAGEMENT REQUEST FORM</span><span class="alignright">(v.1.5)</span>
    </div>

<form action="confirmation.php" method="post" enctype="multipart/form-data" class="form" id="rpms_form">
    <div id="tabs">
	<ul>
            <li><a href="#tabs-1">1.</a></li>
	    <li><a href="#tabs-2">2.</a></li>
            <li><a href="#tabs-3">3.</a></li>
            </ul>
	<div id="tabs-1">
	    <table cellspacing="2" cellpadding="2" border="0" align="center" class="tableform70">
		<tbody>
		    <tr><td colspan="3">Project Title <br><input type="text" size="55%" name="title" title="title"></td></tr>
		    <tr>
			<td>First name:<br><input type="text" id="fname" name="fname" title="First Name"></td><td colspan="2">Last name:<br><input type="text" maxlength="50" id="lname" name="lname" title="Last Name"></td>
		    </tr>
			<td colspan="2">Organization (i.e., C/I/O):<br><input type="text" size="55%" name="organization" title="Organization"></td>
	
		    <tr>
		      <td>Phone: <span id="validPhone" class="tooltips-red">Please enter a valid phone number</span><br><input type="text" maxlength="12" id="validate-phone" name="phone" title="Phone"></td><td>E-Mail: <span id="validEmail" class="tooltips-red">Please enter a valid e-mail address</span><br><input type="text" maxlength="50" id="validate-email" name="email"></td>
		      <td>Preferred contact method:<br><select name="method_of_contact">
			  <option value="Phone">Phone</option>
			  <option value="E-mail">E-mail</option>
		      </select>
		      </td>
		    </tr>
	
		    <tr><td>Project Start Date: <span id="validStartDate" class="tooltips-red">Please enter a valid start date</span><br><input type="text" id="datepicker1" name="start_date"></td><td colspan="2">Project End Date: <span id="validEndDate" class="tooltips-red">Please enter a valid end date</span><br><input type="text" id="datepicker2" name="end_date"></td></tr>
		    <tr><td colspan="3">Number of personnel participating in engagement:<br><input type="text" class="validate[required]" id="num_personnel" name="num_personnel"></td></tr>
		    <tr><td colspan="3">Do you request a consultation meeting with our Research and Innovation Team?<br><input type="radio" value="Yes" id="consultation" name="consultation"> Yes <input type="radio" value="No" id="consulation" name="consultation"> No</td></tr>
		    <tr><td colspan="3">Do you request developer resources from our Prototype Development Team?<br><input type="radio" name="developer_resources" id="developer_resources" value="Yes"> Yes <input type="radio" name="developer_resources" id="developer_resources" value="No"> No</td></tr>
		    <tr><td colspan="3">&nbsp;</td></tr>
		    <tr><td colspan="3">Do you request use of the Informatics R&amp;D Laboratory?<br> (e.g,. would you like to have a web or database server prepared for you?)<br><input type="radio" value="Yes" name="lab"> Yes <input type="radio" value="No" name="lab"> No</td></tr>
		    <tr><td colspan="3">If yes...</td></tr>
		    <tr><td colspan="3">When would you like to start using resources in the R&amp;D Lab?<br> <input type="text" name="lab_start_date" id="datepicker3"></td></tr>
		    <tr><td colspan="3">How long do you expect the project to take?<br><input type="text" name="length"></td></tr>
		    <tr><td colspan="3">How many simultaneous physical workstations (lab seats) do you require at one time?<br><input type="text" name="workstations" maxlength="2"></td></tr>
		</tbody>
	    </table>
	</div>

	<div id="tabs-2">
        <table cellpadding="0" cellspacing="2" align="center" class="tableform">
	    <tr>
		<td>
	    <p>
		We can best help you meet your goals if we have a general vision of your project. Please help us frame your project by addressing the following questions. Even if you are only requesting use of the physical laboratory space, a project summary will allow us to potentially leverage other R&D technology initiatives in working with you.
	    </p>
	    <br><br>
	    <p>
		What is the motivation for this project? Indicate problems, challenges, and/or opportunities driving project interest.  Also, feel free to indicate any technologies you have tried that have not worked well as well as those that you believe may have potential as a solution.<p><textarea name="motivation" class="expand"></textarea>
	    </p>
	    <p>
		What is your ultimate vision for this project? Ideally, what would you like to be able to do that you cannot do now, or cannot do in the way you want to do it? (optional) <p><textarea name="vision" class="textarea_large expand" style="height:50px;"></textarea>
	    </p>
	    <p>
		Who are the stakeholders (users/actors) that this proposed engagement will affect?  Please list key technology users, data suppliers, report recipients, as well as any applicable governing guidelines (e.g., HIPAA).  <p>
		<table cellpadding="0" cellspacing="2" align="center" class="tableform70" id="stakeholder">
		    <tr><td style="width:50%;">Stakeholder*</td><td>Role**</td></tr>
			<?php stakeholders(6); ?>
		    <tr><td class="aligntop">*Organization, C/I/O, user group, individual, etc.</td><td>**User, data supplier, report recipient, governing body.<br>Please note that you can choose more than one role per stakeholder.</td></tr>
		</table>
		<br>
	    </p>
	    <p>
		What is/are the primary sources of data, if any, for the proposed technology? Project data sets must be examined (e.g., for privacy & security) prior to loading into the lab environment. The lab can provide synthetic data if necessary. <p><textarea name="datasources" class="textarea_large expand" style="height:50px;"></textarea>
	    </p>
	    <p>
		If this technology is to be used as part of a general work process, what are the basic high-level steps in the process? Five to six steps should cover most processes at a high level. (optional) <p><textarea name="steps" class="textarea_large expand" style="height:50px;"></textarea>
	    </p>
	    <p>
		How will we know if the public health informatics R&D unit is successful regarding this project? What are some measures or metrics we can use to determine if we have achieved a viable solution (e.g., efficiency measures, usability guidelines, accessibility guidelines)?  <p><textarea name="metrics" class="textarea_large expand" style="height:50%;"></textarea>
	    </p>
	    <p>
		Is there anything about the nature of the project or key stakeholders not covered above that we should know about to facilitate success? Please feel free to provide any additional information. <p><textarea name="project_additional_info" class="textarea_large expand" style="height:50%;"></textarea>
	    </p>
		</td>
	    </tr>
	</table>

	</div>
	<!--**********Tech Req Desktop**********-->
<div id="tabs-3">
    <p>
	The Lab has defined a set of core technology standards which are installed as a default (i.e., not otherwise specified).  Please modify as needed for your specific project requirements. Please list specific software needed in the Notes section.
    </p>
	<table cellpadding="0" cellspacing="2" class="tableform" style="width:100%;">
	    <tr><th>#</th><th>Operating System*</th><th>Memory</th><th>Disk</th><th>VM?</th><th>Software**</th><th>Notes</th></tr>
	    <tr class="aligncenter"><td><select name="dt_qty1" class="aligncenter"><option value="0" selected>0</option><?php dropdown(11); ?></select></td><td><input type="text" name="dt_operating_system1" value="Windows XP" class="techreqtextlg"/></td><td><input type="text" name="dt_memory1" value="2GB" class="techreqtextsm"/></td><td><input type="text" name="dt_disk1" value="10GB" class="techreqtextsm"/></td><td>
	    <select name=dt_vm1><option value="Yes" selected>Yes</option><option value="No">No</option></select></td><td><input type="text" name="dt_software1" value="Default" class="techreqtextlg"/></td><td><textarea name="dt_notes1" cols="20" rows="1">Default desktop image</textarea></td></tr>
	    <?php techreq_dt(6); ?>
	</table>
    <br>
    <p>
	*Examples of Desktop OS platforms available: Windows XP, Windows 7 (32 bit / 64 bit), and Ubuntu Desktop Edition. Other platforms (Linux, Unix, Mac, Vista) may be possible based on availability and need.
    </p>
    <p>
	**Examples of Desktop Software packages available: Visual Studio. Other software packages may be possible based on availability and need.
    </p>

<!--**********Tech Req Server**********-->

    <table cellpadding="0" cellspacing="2" class="tableform" style="width:100%;">
        <tr><th>#</th><th>Operating System*</th><th>Memory</th><th>Disk</th><th>VM?</th><th>Software**</th><th>Notes</th></tr>
        <tr class="aligncenter"><td><select name="server_qty1" class="aligncenter"><option value="0" selected>0</option><?php dropdown(11); ?></select></td><td><input type="text" name="server_operating_system1" value="Windows 2003 Server" class="techreqtextlg"/></td><td><input type="text" name="server_memory1" value="2GB" class="techreqtextsm"/></td><td><input type="text" name="server_disk1" value="16GB" class="techreqtextsm"/></td><td>
        <select name=server_vm1><option value="Yes" selected>Yes</option><option value="No">No</option></select></td><td><input type="text" name="server_software1" value="Default"Default" class="techreqtextlg"/></td><td><textarea name="server_notes1" cols="20" rows="1">Default server image</textarea></td></tr>
	<?php techreq_server(6); ?>
    </table>
    <br>
    <p>
	*Examples of Desktop OS platforms available: Windows XP, Windows 7 (32 bit / 64 bit), and Ubuntu Desktop Edition. Other platforms (Linux, Unix, Mac, Vista) may be possible based on availability and need.
    </p>
    <p>
	**Examples of Desktop Software packages available: Visual Studio. Other software packages may be possible based on availability and need.
    </p>

<!--**********Connectivity**********-->

    <table cellpadding="0" cellspacing="2" align="center" class="tableform">
        <tr><td>Will you need access to your prototype from outside the R&D Lab network?<br><input type="radio" name="outside_access" value="Yes" /> Yes <input type="radio" name="outside_access" value="No" /> No</td></tr>
        <tr><td>Do you expect custom network configurations to be required?<br><input type="radio" name="custom_network_config" value="Yes" /> Yes <input type="radio" name="custom_network_config" value="No" /> No</td></tr>
        <tr><td>Will your prototype connect to non-production systems/databases <strong>OUTSIDE</strong> the agency?<br><input type="radio" name="outside_agency" value="Yes" /> Yes <input type="radio" name="outside_agency" value="No" /> No</td></tr>
        <tr><td>Will your prototype connect to non-production systems/databases <strong>INSIDE</strong> the agency?<br><input type="radio" name="inside_agency" value="Yes" /> Yes <input type="radio" name="inside_agency" value="No" /> No</td></tr>
        <tr><td cols="2">&nbsp;</td></tr>
	<tr><td class="aligntop">Please feel free to provide any additional information regarding your technology needs below.<br><textarea name="additional_info" class="expand"></textarea></td></tr>
    </table>
    
<p class="aligncenter" style="padding:10px 0px 0px 0px;">Please confirm that all the entered information is accurate.  Click "Submit" when ready.<br> Once you have submitted your information, if you then need to make changes, please contact Dr. Savel at <a href="mailto:tsavel@cdc.gov">tsavel@cdc.gov</a>.<br><br><input type="submit" class="buttonsize" value="Submit" name="Submit"></p>
</div>
</div>
  </form>
</body>
</html>
