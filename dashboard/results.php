 <?php
 include '../includes/db.php';
 require_once 'includes/jpgraph/jpgraph.php';
 require_once 'includes/jpgraph/jpgraph_bar.php';
 $op = $_GET['op'];
 
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
</head>
<body>

<?php
    $table_open = "<table border='0' cellspacing='1' cellpadding='1' align='center' width='80%' id='myTable'>
        <thead><tr align='center'><th class='adminheader'>Project ID</th><th  class='adminheader'>Title</th><th class='adminheader'>Date</th><th  class='adminheader'>Status</th></tr></thead>
        <tbody>";
        
    $table_close = "</tbody></table>";
    
    $results = $db->query("SELECT * from project
                            JOIN admin_project_status on project.id = admin_project_status.projectid
                            GROUP BY project.id");
	    
    switch ($op){
        
        //Get projects in the past week from current day.============================
        case week:
            echo "Projects submitted in the past week<br>".$table_open;
            
            $past_week = mktime(0, 0, 0, date("m"), date("d")-7, date("y"));

             while($row = mysql_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $status = $row['project_status'];
                $start_date = date("m/d/Y", $row['start_date']);
                                
                if($row['date_of_request'] >= $past_week AND $row['date_of_request'] <= time()){	
                    echo "<tr align='center'><td>$id</td><td>$title</td><td>$start_date</td><td>$status</td></tr>";
                }
             }
             
            echo $table_close;
        
        break;
            
            
        //Get projects in the past 30 days from current day.============================
        case month_30:
            echo "Projects submitted in the past 30 days<br>".$table_open;
            
            $past_month = mktime(0, 0, 0, date("m")-1, date("d"), date("y"));
            
             while($row = mysql_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $status = $row['project_status'];
                $start_date = date("m/d/Y", $row['start_date']);
                
                if($row['date_of_request'] >= $past_month AND $row['date_of_request'] <= time()){	
                    echo "<tr align='center'><td>$id</td><td>$title</td><td>$start_date</td><td>$status</td></tr>";
                }
             }
            echo $table_close;
            break;
        
        //Get projects in the current month.============================
        case cur_month:
            
            echo "Projects submitted in ".date("F")."<br>$table_open";
            
            while($row = mysql_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $status = $row['project_status'];
                $start_date = date("m/d/Y", $row['start_date']);
                $month_of_request = date("m", $row['date_of_request']);

                if($month_of_request == date("m")){	
                    echo "<tr align='center'><td>$id</td><td>$title</td><td>$start_date</td><td>$status</td></tr>";
                }
             }
            echo $table_close;
            
        break;
        
         //Count # of projects in the current fiscal year.============================	
        case cur_fis_year:
                        
            $curmonth = date("m");
            $curyearstart = "10/01/".date("Y");
            $curyearend = "09/30/".date("Y");
            $nextyear = "09/30/".date("Y", strtotime("+1 year"));
            $prevyear = "10/01/".date("Y", strtotime("-1 year"));
            
            if($curmonth<10){
                $fiscal_start = strtotime($prevyear);
                $fiscal_end = strtotime($curyearend);
             }else{
                $fiscal_start = strtotime($curyearstart);
                $fiscal_end = strtotime($nextyear);
             }
             
            echo "Projects submitted in the current fiscal year (".date('F d, Y', $fiscal_start)." - ".date('F d, Y', $fiscal_end).")<br>$table_open";
             
            while($row = mysql_fetch_assoc($results)){
               $id = $row['id'];
               $title = $row['title'];
               $status = $row['project_status'];
               $start_date = date("m/d/Y", $row['start_date']);
   
               if($row['date_of_request'] >= $fiscal_start AND $row['date_of_request'] <= $fiscal_end){		
                   echo "<tr align='center'><td>$id</td><td>$title</td><td>$start_date</td><td>$status</td></tr>";
               }
               
            }
            echo $table_close;
        
        break;
        
         //Get projects in the current year.============================
        case cur_year:
            
            echo "Projects submitted in ".date("Y")."<br>$table_open";
            
            while($row = mysql_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $status = $row['project_status'];
                $start_date = date("m/d/Y", $row['start_date']);
                $year_of_request = date("Y", $row['date_of_request']);
    
                if($year_of_request == date("Y")){	
                    echo "<tr align='center'><td>$id</td><td>$title</td><td>$start_date</td><td>$status</td></tr>";
                }
             }
            echo $table_close;
    
	break;
        
         //Get projects based on user date range..============================		
        case search:
            echo $table_open;
            
            $from = strtotime($_POST['from']);
            $to = strtotime($_POST['to']);
            
            echo "Projects submitted between ".date('F d, Y', $from)." - ".date('F d, Y', $to);
            
            while($row = mysql_fetch_assoc($results)){
                $id = $row[project.id];
                $title = $row['title'];
                $status = $row['project_status'];
                $date_of_request = date("m/d/Y", $row['date_of_request']);


                if($row['date_of_request'] >= $from AND $row['date_of_request'] <= $to){	
                    echo "<tr align='center'><td>$id</td><td>$title</td><td>$date_of_request</td><td>$status</td></tr>";
                }
            }
            echo $table_close;
            
        break;
    
    //Get # of projects based on current status.============================
    case count_ps:
        $from2 = strtotime($_POST['from2']);
        $to2 = strtotime($_POST['to2']);
        $status = $_POST['status'];
        
        $array = array();
        
        $results_projectid = $db->query("SELECT id as projid from project WHERE date_of_request >= $from2 and date_of_request<= $to2");
            while($row = mysql_fetch_assoc($results_projectid)){
                $results_maxid = $db->query("SELECT MAX(id) as maxid from admin_project_status WHERE projectid = $row[projid] GROUP BY projectid");
                while($row = mysql_fetch_assoc($results_maxid)){
                    $results_count = $db->query("SELECT projectid from admin_project_status WHERE id = $row[maxid] and project_status = '$status'");
                    while($row = mysql_fetch_assoc($results_count)){
                        $projectid = $row[projectid];
                        array_push($array, $projectid);
                    }
                }
		
            }		    
            $num = count($array);
            
	    $serialized = rawurlencode(serialize($array));
	    
            echo "Number of projects $status submitted between <br>".date('F d, Y', $from2)." and ".date('F d, Y', $to2).": <span style='font-size:24px;font-weight:bold;'>$num</span><br><a href='list_results.php?list=status&ids=$serialized' target='_blank'>View</a>";
    
    break;

    //Get # of unique vms in use.============================
    case count_vm:
        $from3 = strtotime($_POST['from3']);
        $to3 = strtotime($_POST['to3']);
        
        $array_dt = array();
        $array_server = array();
        
        $results_projectid = $db->query("SELECT id as projid from project WHERE date_of_request >= $from3 and date_of_request<= $to3");
            while($row = mysql_fetch_assoc($results_projectid)){
                $results_status = $db->query("SELECT id, projectid from admin_infrastructure_status WHERE id = (SELECT MAX(id) as maxid from admin_infrastructure_status WHERE projectid = $row[projid] GROUP BY projectid) and infrastructure_status = 'Infrastructure set-up completed'");
                while($row = mysql_fetch_assoc($results_status)){
                    $results_dt_vm = $db->query("SELECT dt_qty from tr_desktop WHERE projectid = $row[projectid] and dt_vm = 'Yes'");
                    $results_server_vm = $db->query("SELECT server_qty from tr_server WHERE projectid = $row[projectid] and server_vm = 'Yes'");
                    while($row = mysql_fetch_assoc($results_dt_vm)){
                        $id_dt = $row[dt_qty];
                        array_push($array_dt, $id_dt);
                    }
                        
                    while($row = mysql_fetch_assoc($results_server_vm)){
                        $id_server = $row[server_qty];
                        array_push($array_server, $id_server);
                    }
                }
            }

        $total = (array_sum($array_dt)) + (array_sum($array_server));
        
            echo "Number of unique VMs in use for projects submitted between <br>".date('F d, Y', $from3)." and ".date('F d, Y', $to3).": <span style='font-size:24px;font-weight:bold;'>$total</span>";
        
    break;


    //Get  # of unique vms in use.============================
    case avg_vm: 
        $from4 = strtotime($_POST['from4']);
        $to4 = strtotime($_POST['to4']);
        
        $array_dt = array();
        $array_server = array();
    
        //finding all project ids within date range specified
        $results_projectid = $db->query("SELECT id from project WHERE date_of_request >= $from4 and date_of_request<= $to4");
        while($row = mysql_fetch_assoc($results_projectid)){
             //finding all projects approved by team
            $results_pstatus = $db->query("SELECT projectid as projid from admin_project_status WHERE project_status = 'Approved by Team' and id = (SELECT MAX(id) from admin_project_status WHERE projectid = '$row[id]')");
            while($row = mysql_fetch_assoc($results_pstatus)){
                //finding all infrastructure status =>Infrastructure set-up completed
                $results_istatus = $db->query("SELECT projectid from admin_infrastructure_status WHERE id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = $row[projid] and infrastructure_status = 'Infrastructure set-up completed' GROUP BY projectid)");
                $count = 1;
                
                while($row = mysql_fetch_assoc($results_istatus)){
                    //get # of all vms for desktop and server
                    $results_dt_vm = $db->query("SELECT dt_qty from tr_desktop WHERE projectid = $row[projectid] and dt_vm = 'Yes'");
                    $results_server_vm = $db->query("SELECT server_qty from tr_server WHERE projectid = $row[projectid] and server_vm = 'Yes'");
                    //# desktop vms   
                    while($row = mysql_fetch_assoc($results_dt_vm)){
                        $dt_qty = $row[dt_qty];
                        array_push($array_dt, $dt_qty);
                    }
                    //#server vms
                    while($row = mysql_fetch_assoc($results_server_vm)){
                        $server_qty = $row[server_qty];
                        array_push($array_server, $server_qty);
                    }
                    $count++;
                }		  
            }
        }
            
        //add up desktop and server vms divide by # of projects
        $num_dt = array_sum($array_dt);
        $num_server = array_sum($array_server);
        $total = round((($num_dt + $num_server)/$count));
      
            echo "Average number of VMs in use for projects submitted between <br>".date('F d, Y', $from4)." and ".date('F d, Y', $to4).": <span style='font-size:24px;font-weight:bold;'>$total</span>";
                
        break;

    //Get max # of vms in use on a project.============================
    case max_vm:
        $from5 = strtotime($_POST['from5']);
        $to5 = strtotime($_POST['to5']);
        
        $array = array();
        
        $results = $db->query("SELECT id from project WHERE date_of_request >= $from5 and date_of_request<= $to5");
            while($row = mysql_fetch_assoc($results)){
                $num_results = $db->query("SELECT id from admin_infrastructure_status WHERE infrastructure_status = 'Infrastructure set-up completed' and id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = '$row[id]')");
                while($row = mysql_fetch_assoc($num_results)){
                    $id = $row[id];
                    array_push($array, $id);
                }
            }
            
            $num = count($array);
      
            echo "Max number of computers used in a single project submitted between <br>".date('F d, Y', $from5)." and ".date('F d, Y', $to5).": <span style='font-size:24px;font-weight:bold;'>$num</span>";

    break;

    //Get # of projects based on type.============================
    case count_pt:
        $from6 = strtotime($_POST['from6']);
        $to6 = strtotime($_POST['to6']);
        $project_type = $_POST['project_type'];
        $project_use = $_POST['project_use'];

        $array = array();
        
        $results = $db->query("SELECT id from project WHERE date_of_request >= $from6 and date_of_request<= $to6 and project_type='$project_type' and project_use='$project_use'");
            while($row = mysql_fetch_assoc($results)){
                array_push($array, $row[id]);		    
            }
                   
        $num = count($array);
      
	$serialized = rawurlencode(serialize($array));
	
        echo "Number of ".$project_type."s for $project_use projects submitted between <br>".date('F d, Y', $from6)." and ".date('F d, Y', $to6).": <span style='font-size:24px;font-weight:bold;'>$num</span><br><a href='list_results.php?list=type&ids=$serialized' target='_blank'>View</a>";
     
    break;

    //Get avg time of project length.============================
    case avg_len:
        $from7 = strtotime($_POST['from7']);
        $to7 = strtotime($_POST['to7']);
    
        $array_start = array();
        $array_end = array();
        
        $results = $db->query("SELECT * from project WHERE date_of_request >= $from7 and date_of_request<= $to7");
            while($row = mysql_fetch_assoc($results)){
                array_push($array_start, $row[start_date]);
                array_push($array_end, $row[end_date]);
            }
            
        $total_start = array_sum($array_start);
        $total_end = array_sum($array_end);
        $count = count($array_start);
        $average = round((($total_end - $total_start)/$count)/86400);
        
        
            echo "Average length of a project submitted between ".date('F d, Y', $from7)." and ".date('F d, Y', $to7).": <span style='font-size:24px;font-weight:bold;'>$average days</span>";
        
    break;

    //Get avg time from approval to infrastructure setup complete.============================
    case avg_len_setup:
        $from8 = strtotime($_POST['from8']);
        $to8 = strtotime($_POST['to8']);

        $approve = array();
        $completed = array();
        
        $results = $db->query("SELECT id as pid from project WHERE date_of_request >= $from8 and date_of_request<= $to8");
        while($row = mysql_fetch_assoc($results)){
            $get_pstatus = $db->query("SELECT project_modified_date as pmd from admin_project_status WHERE project_status = 'Approved by Team' and id = (SELECT MAX(id) from admin_project_status WHERE projectid = '$row[pid]')");
            while($row_p = mysql_fetch_assoc($get_pstatus)){
                array_push($approve, $row_p[pmd]);
            }
            $get_istatus = $db->query("SELECT infrastructure_modified_date as imd from admin_infrastructure_status WHERE infrastructure_status = 'Infrastructure set-up completed' and id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = '$row[pid]')");
                while($row_i = mysql_fetch_assoc($get_istatus)){
                    echo $row[imd];
                    array_push($completed, $row_i[imd]);     
                }
            }
            
        $total_start = array_sum($approve);
        $total_end = array_sum($completed);
        $count = count($completed);
        $average = round((($total_end - $total_start)/$count)/86400);

     
        
            echo "Average days from approval to infrastructure setup for projects submitted between ".date('F d, Y', $from8)." and ".date('F d, Y', $to8).": <span style='font-size:24px;font-weight:bold;'>$average days</span>";
        
        
    break;

    //Get projects in the past week from current day.
    case approve_week:
        
        echo "<br><img src='includes/approve/past_week.php'>";
    
    break;
    
    //Get projects in the past 30 days from current day.	
    case approve_30days:
        
        echo "<br><img src='includes/approve/past_30days.php'>";
    
    break;
    
     //Get projects in the current month
    case approve_cur_month:
        
        echo "<br><img src='includes/approve/cur_month.php'>";
        
    break;
    
     //Count # of projects in the current fiscal year	
    case approve_cur_fis_year:
        
        echo "<br><img src='includes/approve/cur_fis_year.php'>";
        
    break;
    
     //Get projects in the current year
    case approve_cur_year:
            
        echo "<br><img src='includes/approve/cur_year.php'>";  

    break;
        
        //Get projects in the past week from current day.
    case approve_week:
        
        echo "<br><img src='includes/length/past_week.php'>";
    
    break;
    
    //Get projects in the past 30 days from current day.	
    case approve_30days:
        
        echo "<br><img src='includes/length/past_30days.php'>";
    
    break;
    
     //Get projects in the current month
    case approve_cur_month:
        
        echo "<br><img src='includes/length/cur_month.php'>";
        
    break;
    
     //Count # of projects in the current fiscal year	
    case approve_cur_fis_year:
        
        echo "<br><img src='includes/length/cur_fis_year.php'>";
        
    break;
    
     //Get projects in the current year
    case approve_cur_year:
            
        echo "<br><img src='includes/length/cur_year.php'>";  

    break;
        
    }//end op switch
?>

<p class="classname"></p>

<< <a href="index.php">Back to dashboard</a>
</body>
</html>
