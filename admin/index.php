<?php
    include '../includes/db.php';
	if(!isset($_POST['op'])){ $_POST['op'] = "undefined";}
    $op = $_POST["op"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>IRDU Projects</title>
    <meta http-equiv="content-type" content="text/html; charset=us-ascii" />
    <link rel="stylesheet" href="http://<?php  echo $_SERVER['SERVER_NAME']; ?>/rpms/css/style.css" type="text/css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script src="http://<?php  echo $_SERVER['SERVER_NAME']; ?>/rpms/js/jquery.tablesorter.min.js" type="text/javascript"></script>
 <script type="text/javascript">

$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
</head>

<body class="admin">
<?php            
    switch ($op){
    case "Delete":

            $ids = $_POST['id'];
            foreach($ids as $id){
             $db->query("DELETE ai_status, ap_status, connectivity, resources, summary, desktop, server, outcome, project from project
                    JOIN project_summary as summary on project.id = summary.projectid
                    JOIN project_resources as resources on project.id = resources.projectid
                    JOIN tr_desktop as desktop on project.id = desktop.projectid
                    JOIN tr_server as server on project.id = server.projectid
                    JOIN connectivity as connectivity on project.id = connectivity.projectid
                    JOIN project_output as outcome on project.id = outcome.projectid
                    JOIN admin_project_status as ap_status on project.id = ap_status.projectid
                    JOIN admin_infrastructure_status as ai_status on project.id = ai_status.projectid
                    where project.id=$id"); 
            }
        header("Location: http://".$_SERVER['SERVER_NAME']."/rpms/admin/index.php");
        break;
    default:
?>
<div class="aligncenter" style="font-size:18px;padding-top:15px;">RESEARCH PROJECT MANAGEMENT SYSTEM<a href="feed"> <img valign="middle" src="../img/rss_icon.png" alt="RSS Feed" border="0"></a></div><div class="alignleft"><a href="../">New Project</a></div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table border=0 cellspacing=1 cellpadding=1 align="center" width="80%" id="myTable">
        <thead><tr align="center">
		<th class="adminheader">ID</th>
		<th class="adminheader" style="width:5%">Organization</th>
		<th class="adminheader">Start</th>
		<th class="adminheader">End</th>
		<th class="adminheader" style="width:50%">Title</th>
		<th class="adminheader">Status</th>
		<th class="adminheader">Infrastructure</th>
		<th class="adminheader">Engagement</th>
		<th class="adminheader">Del</th>
	</tr></thead>
            <tbody>
            <?php
                $results = $db->query("SELECT project.start_date,project.end_date,project.id, title, project_status, infrastructure_status, project_type, project_use,organization,users.email from project
                                       JOIN users on project.userid = users.id
                                       JOIN admin_project_status on project.id = admin_project_status.projectid and admin_project_status.id = (select max(id) from admin_project_status where projectid = project.id)
                                       JOIN admin_infrastructure_status on project.id = admin_infrastructure_status.projectid and admin_infrastructure_status.id = (select max(id) from admin_infrastructure_status where projectid = project.id)");
                if(!$results){ echo 'fail';}
		$underReview =0;
		$approved = 0;
		$completed = 0;
		$countCollaborative=0;
		$countInternal=0;
		$countExternal=0;
		$countHybrid=0;
		$countPrototype=0;
		$countEvaluation=0;

		$rowNumber=0;

		$emailAlertList='';
		
                while($row = mysql_fetch_assoc($results)){
		if ($row['project_status'] == 'Under Review'){
			$underReview++;
		}elseif ($row['project_status'] == 'Approved'){
			$approved++;
			//I want to track all the projects that are approved and ready|modify so we can email blast them
			if ($row['infrastructure_status'] == 'Ready' || $row['infrastructure_status'] == 'Modifying'){
				$emailAlertList = $emailAlertList.$row['email'].";";
			}
		}elseif ($row['project_status'] == 'Completed'){
			$completed++;
		}
		if($row['project_type']=='Evaluation'){$countEvaluation++;}
		elseif($row['project_type']=='Prototype'){$countPrototype++;}
		elseif($row['project_type']=='Hybrid'){$countHybrid++;}

		if($row['project_use']=='Collaborative'){$countCollaborative++;}
		elseif($row['project_use']=='Internal'){$countInternal++;}
		elseif($row['project_use']=='External'){$countExternal++;}
    		
		if ($rowNumber++%2 == 0){
			$rowColor="#f6f1e0";
			$alternateRowCOlor="#efefef";
		}else{
			$rowColor="#efefef";
			$alternateRowColor="#f6f1e0";
		}
//alternate color could be frog green: e3f377
            ?>
            <tr align="center" style="background-color: <?php echo $rowColor; ?>;" onclick="document.location.href='actions.php?id=<?php echo  $row['id'];?>';" onmouseover="this.style.backgroundColor='#a1de77';" onmouseout="this.style.backgroundColor='<?php echo $rowColor;?>';">
                <td style="width:5%;"><?php echo $row['id']; ?></td>
                <td><?php echo $row['organization']; ?></td>
                <td><?php if ($row['start_date'] > 0){echo date("Y.m.d",$row['start_date']);} ?></td>
                <td><?php if ($row['end_date'] > 0){echo date("Y.m.d",$row['end_date']);} ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['project_status']; ?></td>
                <td><?php echo $row['infrastructure_status']; ?></td>
		<td><?php echo $row['project_use']; ?></td>
<!--                <td style="width:5%;"><a href="actions.php?id=<?php echo $row['id']; ?>"><img src="../img/pencil_24.png" border="0"></a></td>-->
                <td style="width:5%;" onclick="event.stopPropagation();"><input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>"></td>
            </tr>
    
            <?php
                }//end while
        
            ?>

		<tr align="left" style="background-color: #f6f1e0;font-weight:bold;">
			<td>&nbsp;</td>
			<td colspan="9">
				<?php echo("Total Projects: ".mysql_num_rows($results)."; Active Projects: ".(mysql_num_rows($results) - $completed)."<br>Under Review:".$underReview."; Approved:".$approved."; Completed/Retired:".$completed."; Other: ".(mysql_num_rows($results) - $approved - $underReview - $completed)); ?>
<!--<br>
<?php echo ("Project Types: Prototype: ".$countPrototype."; Evaluation: ".$countEvaluation."; Hybrid: ".$countHybrid);?>
-->
<br>
<?php echo ("Engagement Types: Internal: ".$countInternal."; External: ".$countExternal."; Collaborative:".$countCollaborative);?>
			</td>
		</tr>
    
            </tbody>
    </table>

<?php
$emailAlertList = '';

$results = $db->query("SELECT DISTINCT CONCAT('''',fname,' ',lname,'''<',email,'>') as email from users JOIN project ON users.id = project.userid JOIN admin_project_status on project.id = admin_project_status.projectid and admin_project_status.id = (select max(id) from admin_project_status where projectid = project.id) JOIN admin_infrastructure_status on project.id = admin_infrastructure_status.projectid and admin_infrastructure_status.id = (select max(id) from admin_infrastructure_status where projectid = project.id) WHERE email != '' AND admin_project_status.project_status = 'Approved' AND admin_infrastructure_status.infrastructure_status in ('Ready','Modifying')");

while($row = mysql_fetch_assoc($results)){
	$emailAlertList = $emailAlertList.$row['email'].";";
}
?>    
            <div style="float: right; padding-top: 10px; padding-right: 200px;"><input type="submit" name="op" value="Delete">
<a href="mailto:<?php echo $emailAlertList;?>">Email Alert</a>
</div>
</form>
        <?php
            }//end switch
        ?>
</body>
</html>
