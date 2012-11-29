<?php
include '../../includes/db.php';
require_once 'jpgraph/jpgraph.php';
require_once 'jpgraph/jpgraph_bar.php';

    
	    $results = $db->query("SELECT * from project");
	    $approve = array();
	    $complete = array();
	    $x = array();
	    $y = array();
            $i = 0;

            while($row = mysql_fetch_assoc($results) and $i<6){
		$all_weeks = strtotime(date('m').'/01/'.date('Y').' 00:00:00')+($i*604800);
                $each_week = date("W", $all_weeks);
                $month_request = date("m", $row[date_of_request]);
                $week_of_request = date("W", $row[date_of_request]);
		
		//getting the day of the week in ISO (1-7, Mon-Sunday)
		$get_day_of_week = date("N", $all_weeks) - 1;
		
		if($i == 0){
			$timestamp = date("m/d", $all_weeks);

		}else{
		    $mon = strtotime("-". $get_day_of_week." days", $all_weeks);
		    $timestamp = date("m/d", $mon);
		}
		//echo $timestamp."<br>";
		    
		if($month_request == date("m") and ($week_of_request = $week)){
		    $id = $row['id'];		    
		    
		   
		    $get_pstatus = $db->query("SELECT project_modified_date as pmd from admin_project_status WHERE project_status = 'Approved by Team' and id = (SELECT MAX(id) from admin_project_status WHERE projectid = '$id')");
		    while($row_p = mysql_fetch_assoc($get_pstatus)){
			array_push($approve, $row_p[pmd]);
		    }
		    
		   $get_istatus = $db->query("SELECT infrastructure_modified_date as imd from admin_infrastructure_status WHERE infrastructure_status = 'Infrastructure set-up completed' and id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = '$id')");
		    while($row_i = mysql_fetch_assoc($get_istatus)){
			array_push($complete, $row_i[imd]);
		    }
		   $start = array_sum($approve);
		   $end = array_sum($complete);
		   $count = count($complete);
		   $average = (($end - $start)/$count)/86400;
	       }else{
		   // echo $timestamp."<br>";
		   $average = 0;   
	       }
	     
	       array_push($x, $timestamp);
	       array_push($y, $average);
            
            $i++;
            //echo "$get_date<br>";
        }
        
	   // Setup the graph.
	   
	   $graph = new Graph(800,500);
	   $graph->img->SetMargin(60,20,35,75);
	   $graph->SetScale("textlin");
	   $graph->SetMarginColor("lightblue:1.1");
	   $graph->SetShadow();
	    
	   // Set up the title for the graph
	   $graph->title->Set("Average time from approval to infrastructure set up");
	   $graph->title->SetMargin(8);
	   $graph->title->SetFont(FF_VERDANA,FS_BOLD,12);
	   $graph->title->SetColor("darkred");
	    
	   // Setup font for axis
	   $graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
	   $graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
	   $graph->yaxis->title->Set("Average Days");
            
	   // Show 0 label on Y-axis (default is not to show)
	   $graph->yscale->ticks->SupressZeroLabel(false);
	    
	   // Setup X-axis labels
	   $graph->xaxis->SetTickLabels($x);
           $graph->xaxis->title->Set("Date of request");
           $graph->xaxis->title->SetMargin(45);
	   $graph->xaxis->SetLabelAngle(45);
           $graph->xaxis->SetLabelMargin(15);
           
	    
	   // Create the bar pot
	   $bplot = new BarPlot($y);
	   $bplot->SetWidth(0.6);
	    
	   // Setup color for gradient fill style
	   $bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_LEFT_REFLECTION);
	    
	   // Set color for the frame of each bar
	   $bplot->SetColor("white");
	   $graph->Add($bplot);
	    
	   // Finally send the graph to the browser
	   $graph->Stroke();
	   
?>
