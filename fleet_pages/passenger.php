<?
//Load global configuration file...
require '/home/flyafa/public_html/PRS/conf_global.php';

//Import global functions...
require '/home/flyafa/public_html/PRS/functions.php';
$auth = new Auth;
$pilots = new Pilots;
include('layout.php');
print commonHeader('Passenger Fleet');
//
$path = 'downloads/fleet/standard';
require_once('files/fleet/load.php');
$aircraftCollection = $fleet->getAllAircraft();
$cat1 = $aircraftCollection->getByCategory(1);
$cat2 = $aircraftCollection->getByCategory(2);
$cat3 = $aircraftCollection->getByCategory(3);
$cat4 = $aircraftCollection->getByCategory(4);
$cat5 = $aircraftCollection->getByCategory(5);
$cat6 = $aircraftCollection->getByCategory(6);

if ($_GET['download']) {
	$fleet->downloadAircraft($_GET['download']);
}
?>

		<!---Begin Page Content-->



<td width="600" valign="top"><table align="center"><tr><td>

<tr>
<td><font face="Arial,Helvetica"><font size=-1><font color="red">*All aircraft have been updated to self installer files. The aircraft zip files should be extracted using <a href="http://www.winzip.com" target="_blank">Winzip</a> which will extract a self installer icon which should be clicked on to automatically install the aircraft to flight simulator.  Most aircraft also require either <a href="/fleet/panels/AFA_Panels_FS9.zip">FS2004 Panels</a> or <a href="/fleet/panels/AFA_Panels_FSX.zip">FSX Panels</a> which should be downloaded and installed separately.</font></font></font></td>

</tr>
</table></center><p><br>
<table width="600" align="center">
<!-- CAT 1 -->
<?php if(count($cat1) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 1</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat1 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>

<!-- CAT 2 -->
<?php if(count($cat2) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 2</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat2 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>

<!-- CAT 3 -->
<?php if(count($cat3) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 3</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat3 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>

<!-- CAT 4 -->
<?php if(count($cat4) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 4</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat4 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>

<!-- CAT 5 -->
<?php if(count($cat5) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 5</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat5 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>

<!-- CAT 6 -->
<?php if(count($cat6) > 0) { ?>
	<tr><td colspan="3">
	<hr NOSHADE color="#E1E1E1" size="1">
	<b>Category 6</b>
	<hr NOSHADE color="#E1E1E1" size="1">
	</td></tr>

	<?php foreach ($cat6 as $aircraft) { ?>
		<tr><td><a href=""><b><?php echo $aircraft->aircraft_title; ?></b></a></td>
		<td>
		<?php foreach ($aircraft->files as $key => $file) { ?>
			<?php if ($key === 'fs2002') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k2.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fs2004') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fs2k4.gif" border="0"></a>
			<?php } ?>
			
			<?php if ($key === 'fsx') { ?>
			<a href="fleetdownload.php?download=<?=$file[0]->file_name?>"><img src="http://flyafa.com/images/fsx.gif" border="0"></a>
			<?php } ?>
		
		<?php } ?>
		</td>
		<td align="right"><img src="<?php echo $aircraft->path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $aircraft->image; ?>" border="0"></td>
		</tr>
	<?php } ?>
<?php } ?>


</table>



<!-- Begin page footer -->
<?include ('footer.php');?>

