<?php
/*
Plugin Name: Excel Files
Description: Download thymer all page records.
Version: 1.1
Author: Ajay Kori
*/

function excel_file_download_admin() {
    include('excel_file.php');  
}
function wp_excel_export_admin() {
    include('excel_export.php');  
}


function wp_excel_file_admin_download()
{
    add_menu_page('Excel Files', 'Excel Files', 0,'excel_file','excel_file_download_admin');
    add_submenu_page(NULL, 'Export CSV', 'Export CSV' , 0,'excel_export','wp_excel_export_admin' );
    
}
add_action( 'admin_menu', 'wp_excel_file_admin_download' );