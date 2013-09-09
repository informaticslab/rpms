<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Smashing HTML5!</title>

</head>
<body>


<p>Will now run exec...</p>

<?php 

// exec('mysqldump --user=rpms -password=Budde373 --skip-quick --comments d:t:o,/tmp/mysqldump.trace rpms > rpmsold.sql', $outputArray);
// mysqldump --user=root -password=robbie --skip-quick --comments d:t:o,/tmp/mysqldump.trace rpms > rpmsold.sql

exec('rpms.sql', $outputArray);
// xampp mysql home \xampp\mysql\bin

?>

<p>The output of the exec is:</p>

<?php echo $outputArray ?>

</body>
</html>