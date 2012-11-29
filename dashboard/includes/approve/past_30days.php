<?php
include '../../../includes/db.php';
require_once '../jpgraph/jpgraph.php';
require_once '../jpgraph/jpgraph_bar.php';

    
	    $results = $db->query("SELECT * from project");
	    $past_30days = mktime(0, 0, 0, date("m"), date("d")-30, date("y"));
	    $approve = array();
	    $complete = array();
	    $x = array();
	    $y = array();
            $i=0;

            while($row = mysql_fetch_assoc($results) and $i<5){

                if(($row['date_of_request'] >= $past_30days AND $row['date_of_request'] <= time())){
                        
		    $week_request = date("W", $row[date_of_request]);

		    $get_timestamp = mktime(0, 0, 0, date("m"), date("d")-(7*$i), date("y"));
		    $get_week = date("W", $get_timestamp);

                    if($week_request=$get_week){
                        $id = $row['id'];
                        $timestamp = date("m/d", $get_timestamp);
			
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
                        $timestamp = $timestamp;
                        $average = 0;   
                    }
                    
                    array_push($x, $timestamp);
                    array_push($y, $average);
		}
            
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
           $graph->yaxis->title->SetMargin(25); 
	   $graph->yaxis->title->Set("Average Days");
            
	   // Show 0 label on Y-axis (default is not to show)
	   $graph->yscale->ticks->SupressZeroLabel(false);
	    
	   // Setup X-axis labels
	   $graph->xaxis->SetTickLabels($x);
           $graph->xaxis->title->Set("Date of request");
           $graph->xaxis->title->SetMargin(32,25,50,50);
           $graph->xaxis->SetLabelAngle(45);
           $graph->xaxis->SetLabelMargin(10);
           
	    
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
