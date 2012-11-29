<?php
include '../../includes/db.php';
require_once 'jpgraph/jpgraph.php';
require_once 'jpgraph/jpgraph_bar.php';

    
	    $results = $db->query("SELECT * from project");
	    $start = array();
	    $end = array();
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
		    $get_date = date("m", $fiscal_start) + $i;
                    if($get_date > 12){
                        $get_date = $get_date - 12; 
                    }else{
                        $get_date = $get_date;
                    }

		    //$fiscal_month = $get_date;
		    
		    //echo "$get_date<br>";
                if($row['date_of_request'] >= $fiscal_start AND $row['date_of_request'] <= $fiscal_end){	
                    $date_request = date("m", $row[date_of_request]);

                    if($date_request = $get_date){
                        $id = $row['id'];
                        

                        array_push($start, $row[start_date]);
                   
                   
                        array_push($end, $row[end_date]);
			
                        $total_start = array_sum($start);
                        $total_end = array_sum($end);
                        $count = count($end);
                        $average = (($total_end - $total_start)/$count)/86400;
                    }else{
                        $average = 0;   
                    }
                    
                    array_push($x, $get_date);
                    array_push($y, $average);

            }
            
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
