<?php
include '../../../includes/db.php';
require_once '../jpgraph/jpgraph.php';
require_once '../jpgraph/jpgraph_bar.php';

    
	    $results = $db->query("SELECT * from project");
	    $past_week = mktime(0, 0, 0, date("m"), date("d")-7, date("y"));
	    $array_approve = array();
	    $array_setup = array();
	    $x = array();
	    $y = array();
            $i=0;

            while($row = mysql_fetch_assoc($results) and $i<7){
                //echo $row['id'];
                $get_date_timestamp = mktime(0, 0, 0, date("m"), date("d"), date("y"))-($i*86400);
                $get_date = date("m/d/Y", $get_date_timestamp);
                
                if(($row['date_of_request'] >= $past_week AND $row['date_of_request'] <= time())){
                    $date_request = date("m/d/Y", $row[date_of_request]);
    
    
                     if($date_request=$get_date){
                        $id = $row['id'];
                        //echo $id;
                        $get_pstatus = $db->query("SELECT project_modified_date as pmd from admin_project_status WHERE project_status = 'Approved by Team' and id = (SELECT MAX(id) from admin_project_status WHERE projectid = '$id')");
                        while($row_p = mysql_fetch_assoc($get_pstatus)){
                        array_push($array_approve, $row_p[pmd]);
                        }
                        $get_istatus = $db->query("SELECT infrastructure_modified_date as imd from admin_infrastructure_status WHERE infrastructure_status = 'Infrastructure set-up completed' and id = (SELECT MAX(id) from admin_infrastructure_status WHERE projectid = '$id')");
                        while($row_i = mysql_fetch_assoc($get_istatus)){
                        echo $row[imd];
                        array_push($array_setup, $row_i[imd]);
                        }
                        $total_start = array_sum($array_approve);
                        $total_end = array_sum($array_setup);
                        $count = count($array_setup);
                        $average = round((($total_end - $total_start)/$count)/86400);
                    }else{
                        $get_date = $get_date;
                        $average = 0;   
                    }                    

            }
            array_push($x, $get_date);
            array_push($y, $average);
            $i++;
            
        }

	   // Setup the graph.
	   $graph = new Graph(1000,500);
	   $graph->img->SetMargin(60,20,35,85);
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
           $graph->yaxis->title->SetMargin(25); 
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
