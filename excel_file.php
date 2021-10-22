<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' type='text/css' />





</head>
<body>

<?php

global $wpdb;
$table_name = $wpdb->prefix.'table_name';
//echo "<pre>"; print_r($_POST); exit;
if(isset($_POST) && !empty($_POST)){
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    $daterange = "date(created_at) BETWEEN '".$startDate."' AND '".$endDate."'";
    $dataDetails = $wpdb->get_results("SELECT * FROM $table_name WHERE $daterange");
}else{
    $dataDetails = $wpdb->get_results("SELECT * FROM $table_name");
}

?>
<div aria-label="Main content" tabindex="0">		
	<div class="wrap">
		<form name="export_date_from" method="post" action="admin.php?page=excel_export">
			<div class="detail_wrap">
				<h3>Export Data</h3>
			    <div style="clear: both;">&nbsp;</div>
				<input name="startdate" class="input-text " id="startdate" type="text" value="" placeholder="From" /> -
				<input name="enddate" class="input-text " id="enddate" type="text" value="" placeholder="To" />
				<input class="button alt" name="exportdata" id="exportdata" value="Export" type="submit" >
			</div>
		</form>
	</div>
</div>
<table id="dtlist" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
        <th>Name</th>
        <th>Birthday</th>
        <th>Contact Number</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Create Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($dataDetails as $dataDetailKey => $dataDetailVal){ 
            ?>
                <tr>
                    <td><?php echo $dataDetailVal->full_name; ?></td>
                    <td><?php echo $dataDetailVal->birthday; ?></td>
                    <td><?php echo $dataDetailVal->contact_number; ?></td>
                    <td><?php echo $dataDetailVal->email; ?></td>
                    <td><?php echo $dataDetailVal->gender; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($dataDetailVal->created_at)); ?></td>
                </tr>
        <?php    } 
        ?>
    </tbody>
</table>
<script>
  jQuery(function(){
    jQuery("#dtlist").dataTable();
  })
  </script>
  <style>
    div#dtlist_wrapper {
        margin-top: 20px;
    }
    
    .dataTables_length { float: left; }
  </style>
  <script>
jQuery('#startdate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: "yy-mm-dd"
});

jQuery('#enddate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: "yy-mm-dd"
});
</script>