<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" />

<title><?php echo $pageData->title; ?></title>

<!--[if lte IE 10]>
	<script src="../styles/summaryIE.css"></script>
<![endif]-->
<link type="text/css" href="../styles/summary.css" rel="stylesheet" />

<!-- <script type="text/javascript" src="scripts/main.js"></script> -->

<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>

<section class="leftnav">
	<img src="../images/brandingsm.jpg" width="300" height="81" title="Informatics R&D Laboratory" alt="Informatics R&D Laboratory" />
	<div class="content">
		<h1>Research Project <br>Management System</h1>
		
		<hr class="small"/>
		
		<div>Total Page<?php 
			//add s for multiple
			if ($pagination->pagesTotal > 1) { echo 's'; }
			echo ': '.$pagination->pagesTotal.' &nbsp; ';
			// unavailable pagination is not linked
			if ($pagination->previousLink!='') { echo '<a href="'.$pagination->previousLink.'">Previous</a> | '; }
			else echo '<span class="disabled">Previous</span> | ';
			echo $pagination->resultsPageNum.' | ';
			if ($pagination->nextLink!='') { echo '<a href="'.$pagination->nextLink.'">Next</a>'; }
			else echo '<span class="disabled">Next</span>';
			?>
		</div>
		
		<div class="summary">
			<ul>
				<li>Total Projects:&nbsp;<?php echo $pagination->resultTotal; ?></li>
				<li>Active Projects:&nbsp;<?php echo $pageData->active; ?></li>
			</ul>
			
			<h2>Engagement Types</h2>
			<ul>
				<li>Internal:&nbsp;<?php echo $pageData->Internal; ?></li>
				<li>External:&nbsp;<?php echo $pageData->External; ?></li>
				<li>Collaborative:&nbsp;<?php echo $pageData->Collaborative; ?></li>
			</ul>
			
			<h2>Administration Status</h2>
			<ul>
				<li>Under Review:&nbsp;<?php echo $pageData->UnderReview; ?></li>
				<li>Approved:&nbsp;<?php echo $pageData->Approved; ?></li>
				<li>Discontinued:&nbsp;<?php echo $pageData->Retired; ?></li>
				<li>Other:&nbsp;<?php echo $pageData->OtherAdmin; ?></li>
			</ul>
			
			<h2>Infrastructure Status</h2>
			<ul>
				<li>To Set Up:&nbsp;<?php echo $pageData->ToSetUp; ?></li>
				<li>Ready:&nbsp;<?php echo $pageData->Ready; ?></li>
				<li>To&nbsp;Take&nbsp;Down:&nbsp;<?php echo $pageData->ToTakeDown; ?></li>
				<li>Other:&nbsp;<?php echo $pageData->OtherTech; ?></li>
			</ul>
		</div>
		
		<menu>
		<?php // menu html in a php loop
		foreach ($menu as $value) {
			echo '<a href="'.$value[1].'">'.$value[0].'</a>';
		}
		?>
		Checked Engagements
		</menu>
	</div>
	
	<div class="searchbox">
		<form action="index.php" method="get">
	        <input type="hidden" name="search" value="yes" />
	      	<input type="text" name="keyword" value="" class="search" placeholder="Search Engagements" alt="Search" title="Search" autocomplete="on" disabled="disabled" />
			<input type="button" class="searchButton" value="Search" disabled="disabled" />
			
			<section>Search from date
			<br/><input type="text" name="searchFrom" id="datepicker1" value="" class="hasDatepicker" disabled="disabled" />
			<img src="../images/calendarIcon.png" width="20" height="18" alt="">
			</section>
			<section>Search to date
			<br/><input type="text" name="searchTo" id="datepicker1" value="" class="hasDatepicker" disabled="disabled" />
			<img src="../images/calendarIcon.png" width="20" height="18" alt="">
			</section>
			
		</form>
	</div>
	 
	
	<nav>
		<?php // navigation html in a php loop
		foreach ($nav as $value) {
			if ($pageData->navSelected==$value[0]) { 
				echo '<span>'.$value[0].'</span>'; 
			} 
			else { 
				echo '<a href="'.$value[1].'">'.$value[0].'</a>';
			}
		}
		?>
	</nav>
</section>

<section class="data">
	<table>
	
		<tr>
			<th><a href="index.php?orderBy=id&orderType=<?php echo $order->id; ?>">ID</a></th>
			<th><a href="index.php?orderBy=approved_start&orderType=<?php echo $order->approved_start; ?>">Start&nbsp;Date</a></th>
			<th colspan="4"><a href="index.php?orderBy=project_title&orderType=<?php echo $order->project_title; ?>">Title</a></th>
			<th><a href="index.php?orderBy=project_use&orderType=<?php echo $order->project_use; ?>">Engagement</a></th>
			<th><a href="index.php?orderBy=admin_selection&orderType=<?php echo $order->admin_selection; ?>">Admin&nbsp;Status</a></th>
			<th><a href="#" data-click="add jquery action to check all boxes">Check&nbsp;All</a></th>
		</tr>
		<tr>
			<th><a href="index.php?orderBy=organization&orderType=<?php echo $order->organization; ?>">Organization</a></th>
			<th><a href="index.php?orderBy=approved_end&orderType=<?php echo $order->approved_end; ?>">End&nbsp;Date</a></th>
			<th><a href="index.php?orderBy=totalVM&orderType=<?php echo $order->totalVM; ?>">VM</th>
			<th><a href="index.php?orderBy=totalPhysical&orderType=<?php echo $order->totalPhysical; ?>">Physical</th>
			<th><a href="index.php?orderBy=totalOnline&orderType=<?php echo $order->totalOnline; ?>">Online</th>
			<th><a href="index.php?orderBy=totalOther&orderType=<?php echo $order->totalOther; ?>">Other</th>
			<th><a href="index.php?orderBy=last_name&orderType=<?php echo $order->last_name;?>">Primary&nbsp;Contact</th>
			<th><a href="index.php?orderBy=infra_selection&orderType=<?php echo $order->infra_selection; ?>">Infrastructure</a></th>
			<th>&nbsp;</th>
		</tr>

<?php // start looping through the records 
/*
// ADD TO TEMPLATE $resultData /= $rownum ?
// display the records within limits
while ($rownum <= $limithigh AND $row = mysql_fetch_array($result)) {
	$rownum++;
}
*/

if ( $resultData != false ) {
	$firstTime = 1;
	while ( $obj = $resultData->fetch_object() ) { 
	?>
		<tr><td colspan="9"><hr<?php if ($firstTime==1) { ?> class="red"<?php ; $firstTime++; } ?>></td></tr>
		<tr>
			<td><?php echo $obj->id; ?></td>
			<td><?php echo $obj->approved_start; ?></td>
			<td colspan="4"><?php echo $obj->project_title; ?></td>
			<td><?php echo $obj->project_use; ?></td>
			<td><?php echo $obj->admin_selection; ?></td>
			<td><input type="checkbox" name="actionBox" value="<?php echo $obj->id; ?>" disabled="disabled" /></td>
		</tr>
		<tr>
			<td><?php echo $obj->organization; ?></td>
			<td><?php echo $obj->approved_end; ?></td>
			<td><?php echo $obj->totalVM; ?></td>
			<td><?php echo $obj->totalPhysical; ?></td>
			<td><?php echo $obj->totalOnline; ?></td>
			<td><?php echo $obj->totalOther; ?></td>
			<td><?php echo $obj->first_name.' '.$obj->last_name; ?></td>
			<td><?php echo $obj->infra_selection; ?></td>
			<td>&nbsp;</td>
		</tr>
	<?php
	} // end while?>
	<tr><td colspan="9"><hr class="red"></td></tr>
	<?php 
	// free the result
	$resultData->close();
} // end if $resultData exists
else {
	echo '<tr><td colspan="9"><p>'.$emptySetMsg.'</p></td></tr>';
}

?>
	
	</table>
</section>

</body>
</html>
