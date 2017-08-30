<?php
require_once("../../includes/initialise.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }

include_layout_template('admin_header.php');

$user = new User();
$user->username = "johnsmith";
$user->password = "abcd12345";
$user->first_name = "John";
$user->last_name = "Smith";
$user->create();

include_layout_template('admin_footer.php');
?>
