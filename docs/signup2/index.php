<?php
// Send main headers
header('Last-Modified: ' . date('r')); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Pragma: no-cache");



// Load libs
	include('modules/engine/api.mysql.php');
        include('modules/engine/api.lightastral.php');
        include('modules/engine/api.compat.php');
        include('modules/engine/api.signup.php');
        
$dbConnect = new MySQLDB();

$signup=new SignupService();

//show form by default
if (!la_CheckPost(array('createrequest'))) {
  if (!la_CheckGet(array('success'))) {
      show_window('',$signup->renderForm());
  } else {
      show_window(__('Thank you'), __('Your inquiry will be dealt with in the shortest possible time, and you will be contacted by our representative for details of connection.'));
  } 
  
  
} else {
    //or create request
    $request=$signup->createRequest();
    if ($request) {
        rcms_redirect("?success=yeah");
    } else {
        show_window(__('Error'),__('All fields marked with an asterisk (*) are required').'. '.  la_Link('index.php', __('Try again')));
    }
}

sn_ShowTemplate(); // render data into template
?>