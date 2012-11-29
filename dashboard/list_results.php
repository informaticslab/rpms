 <?php
 include '../includes/db.php';
 require_once 'includes/jpgraph/jpgraph.php';
 require_once 'includes/jpgraph/jpgraph_bar.php';
 $list = $_GET['list'];
 
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title><!-- Insert your title here --></title>
</head>
<body>
<?php
        $table_open_status = "<table border='0' cellspacing='1' cellpadding='1' align='center' width='80%'>
        <thead><tr align='center'><th>Project ID</th><th>Title</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>";
        
        $table_open_type = "<table border='0' cellspacing='1' cellpadding='1' align='center' width='80%'>
        <thead><tr align='center'><th>Project ID</th><th>Title</th><th>Date</th><th>Project Type</th><th>Internal/External use</th></tr></thead>
        <tbody>";
        
        $table_close = "</tbody></table>";

        $ids = unserialize(rawurldecode($_GET[ids]));
       
        
        switch($list){
            case status:
                echo "Search results for projects based on project status<br>";
                echo $table_open_status;
                foreach($ids as $key=>$value){
                    $results = $db->query("SELECT * from project
                    JOIN admin_project_status on project.id = admin_project_status.projectid and admin_project_status.id = (select max(id) from admin_project_status where projectid = $value)
                    JOIN admin_infrastructure_status on project.id = admin_infrastructure_status.projectid and admin_infrastructure_status.id = (select max(id) from admin_infrastructure_status where projectid = $value)
                    WHERE project.id=$value");
               
                    while($row = mysql_fetch_assoc($results)){
                            $projectid = $row[project.id];
                            $title = $row['title'];
                            $date_of_request = date("m/d/Y", $row['date_of_request']);
                            $project_status = $row['project_status'];
                            $infrastructure_status = $row['infrastructure_status'];
                            echo "<tr align='center'><td>$projectid</td><td>$title</td><td>$date_of_request</td><td>$project_status</td></tr>";      
                        }
                }
            
            break;
    
            case type:
                    
                    echo "Search results for projects based on project type<br>";
                    echo $table_open_type;
                    foreach($ids as $key=>$value){
    
                    $results = $db->query("SELECT * from project WHERE id = $value");
               
                    while($row = mysql_fetch_assoc($results)){
                            $projectid = $row[id];
                            $title = $row['title'];
                            $date_of_request = date("m/d/Y", $row['date_of_request']);
                            $project_type = $row['project_type'];
                            $project_use = $row['project_use'];
                            echo "<tr align='center'><td>$projectid</td><td>$title</td><td>$date_of_request</td><td>$project_type</td><td>$project_use</td></tr>";      
                        }
                }
            break;
        }
        echo $table_close;     
        
?>
</body>
</html>
