<?php
header("Content-Type: application/xml; charset=ISO-8859-1");
include '../../includes/db.php';

$results = $db->query('SELECT project.id, title, project_status, infrastructure_status, project_type, project_use,organization,motivation,vision,stakeholder1,date_of_request from project
                                       JOIN users on project.userid = users.id
					JOIN project_summary on project.id = project_summary.projectid
                                       JOIN admin_project_status on project.id = admin_project_status.projectid and admin_project_status.id = (select max(id) from admin_project_status where projectid = project.id)
                                       JOIN admin_infrastructure_status on project.id = admin_infrastructure_status.projectid and admin_infrastructure_status.id = (select max(id) from admin_infrastructure_status where projectid = project.id) ORDER BY date_of_request ASC');
                
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

		$items ='';
		
                while($row = mysql_fetch_assoc($results)){

		if($row['project_status']=='Under Review by Team'){$underReview++;
		}elseif($row['project_status']=='Approved by Team'){$approved++;
		}elseif($row['project_status']=='Completed'){$completed++;}

		if($row['project_type']=='Evaluation'){$countEvaluation++;}
		elseif($row['project_type']=='Prototype'){$countPrototype++;}
		elseif($row['project_type']=='Hybrid'){$countHybrid++;}

		if($row['project_use']=='Collaborative'){$countCollaborative++;}
		elseif($row['project_use']=='Internal'){$countInternal++;}
		elseif($row['project_use']=='External'){$countExternal++;}

		$items.='<item><title>'.
			htmlspecialchars($row['title']).'</title><link>http://'.
			$_SERVER['SERVER_NAME'].':'.
			$_SERVER['SERVER_PORT'].'/rpms/admin/actions?id='.
			$row['id'].'</link><description><![CDATA['.
			$row['organization'].','.
			$row['project_status'].','.
			$row['infrastructure_status'].','.
			$row['project_type'].','.
			$row['project_use'].','.
			$row['motivation'].','.
			$row['vision'].','.
			$row['stakeholder1'].']]></description><guid>'.
			$row['id'].'</guid><pubDate>'.
			date(DateTime::RSS,$row['date_of_request']).'</pubDate></item>';
    
                }//end while
				//echo("Total Projects: ".mysql_num_rows($results)." <br>Under Review:".$underReview."; Approved:".$approved."; Completed/Retired:".$completed); 
//echo("Project Types: Prototype: ".$countPrototype."; Evaluation: ".$countEvaluation."; Hybrid: ".$countHybrid);
//echo("Engagement Types: Internal: ".$countInternal."; External: ".$countExternal."; Collaborative:".$countCollaborative);

$details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
	<rss version="2.0">
	<channel>
		<title>IRDU Projects</title>
		<link>http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/rpms/admin/</link>
		<description>IRDU Project Engagements:Total Projects:'.mysql_num_rows($results).';Under Review:'.$underReview.'; Approved:'.$approved.'; Completed:'.$completed.
		';Engagement Types: Internal:'.$countInternal.'; External:'.$countExternal.'; Collaborative:'.$countCollaborative.'</description>
		<language>en</language>
		'.$items.'</channel></rss>';
echo $details;
?>
