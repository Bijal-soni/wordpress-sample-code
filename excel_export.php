<?php

if(isset($_POST) && !empty($_POST)){
    global $wpdb;
    ob_end_clean();
    $table_name = $wpdb->prefix.'table_name';
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    
    $daterange = "date(created_at) BETWEEN '".$startDate.' 00:00:00'."' AND '".$endDate.' 00:00:00'."'";

    $thymerDetails = $wpdb->get_results("SELECT * FROM $table_name WHERE $daterange") or die(mysql_error());

    $fileName = "data-" . date('Ymd') . ".csv"; 
    
    
    header("Content-type: text/csv");
    header('Content-Disposition: attachment; filename='.$fileName);
    header("Pragma: no-cache");
    header("Expires: 0");
    $out = fopen('php://output', 'w');
    
    fputcsv($out, array('Full Name', 'Email', 'Gender', 'Birthday', 'University','Nationality',  'GPA', 'Contact Number')); 
    
    
    fputcsv($fp, $header);
     header('Content-Type: text/csv; charset=utf-8');
    
    
    $alllogs = array();
    foreach($thymerDetails as $excelDataVal){
        fputcsv($out, array($excelDataVal->full_name, $excelDataVal->email, $excelDataVal->gender, $excelDataVal->birthday, $excelDataVal->university, $excelDataVal->nationality,  $excelDataVal->gpa, $excelDataVal->contact_number));
        
    }
   	fclose($out);
    exit;
    
    
    
    
    /**/
}