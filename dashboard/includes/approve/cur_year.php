<?php
include '../../../includes/db.php';
require_once '../jpgraph/jpgraph.php';
require_once '../jpgraph/jpgraph_bar.php';

    
	    $results = $db->query("SELECT * from project");
	    $array_approve = array();
	    $array_setup = array();
	    $x = array();
	    $y = array();           
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
            $i = 0;
             
            while($row = mysql_fetch_assoc($results) and $i<12){
		//$all_months = strtotime(date('m/d/Y'), $fiscal_start)+($i*604800);
		    $months = date("m", strtotime('01/01/'.date('Y'))) + $i;
		    $m_request = date("m", $row['date_of_request']);
		    $y_request = date("Y", $row['date_of_request']);


                if($y_request == date("Y") and $m_request == $months){	

    		    $id = $row['id'];
		    
		    $get_pstatus = $db->query("SELECT project_modified_date as pmd from admin_project_status WHERE project_status = 'Approved by Team' and id = (SELECT MAX(id) from admin_project_status WHERE projectid = '$id')");
		    while($row_p = mysql_fetch_assoc($get_pstatus)){
			array_push($array_approve, $row_p[pmd]);
		    }
		    $get_istatus = $db->query("SELECT infrastructure_modified_date as imd from admin_infrastructure_status WHERE infrastructure_status = 'Infrastructure set-up completed' and id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = '$id')");
		    while($row_i = mysql_fetch_assoc($get_istatus)){
			//echo $row[imd];
			array_push($array_setup, $row_i[imd]);
		    }
		    $total_start = array_sum($array_approve);
		    $total_end = array_sum($array_setup);
		    $count = count($array_setup);
		    $average = (($total_end - $total_start)/$count)/86400;
		}else{
		    $average = 0;   
		}
		
		array_push($x, $get_date);
		array_push($y, $average);
            
            $i++;
           // echo "$get_date<br>";
        }
        
	   // Setup the graph.
           
	   $graph = new Graph(1000,500);
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
