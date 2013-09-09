<?php 

/*
PERMISSIONS PROBLEM: this will shell_exec using the current (www) user 
and will not have access to the folders I need to work with
*/

// clean vars function
function cleanVar($x) {
	$x = trim(filter_var($x, FILTER_SANITIZE_STRING));
	$x = escapeshellcmd($x);
	return $x;
}

// receive vars from html
$application = cleanVar($_POST['application']);
$method = cleanVar($_POST['method']);

// common vars
$rpmsGitUrl = 'https://github.com/informaticslab/rpms.git';

// run command based on vars
if ($method == "pull") {
	// login as wwwuser, Thick. As trees.
	// cd git_working/
	chdir('/home/wwwuser/git_working/');
	// run pull command
	if ($application == 'rpms1trunk') { exec('git pull '.$rpmsGitUrl, $output, $return_var); }
	if ($application == 'rpms2v20') { $output = trim(shell_exec('git pull v2.0 '.$rpmsGitUrl)); }
	// update permissions?
	// catch server response
}
if ($method == "sync") {
	// login as wwwuser, Thick. As trees.
	// rsync -r rpms/ /var/www/html/rpms2/
	// catch server response
}

// create response message
$response = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Smashing HTML5!</title>

<link rel="stylesheet" href="css/main.css" type="text/css" />
<style type="text/css">
	header, nav, menu, article, section, hgroup, aside, figure, footer { display:block; }
</style>

</head>
<body>

<p><?php echo $output; ?></p>
<p><?php echo $return_var; ?></p>

<form method="post" action="push.php">

<br/>Application
<select name="application">
	<option value="rpms2v20">RPMS2 v2.0</option>
	<option value="rpms1trunk">RPMS trunk</option>
	<option value="other">none</option>
</select>

<br/>Method
<select name="method">
	<option value="pull">Pull from GIT to test server</option>
	<option value="sync">Sync with htdocs</option>
	<option value="other">none</option>
</select>

</form>

</body>
</html>