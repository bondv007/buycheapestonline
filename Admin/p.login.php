<?php 
session_start ( ) ; 

require_once ( "../config.php") ; 
require_once ( "../classes/manipulate.php") ; 
error_reporting(E_ALL & ~E_NOTICE);
require_once ( "../classes/misc.func.php") ; 

$data = new DataManipulator ( ) ; 

get_status_license ( ) ;

if ( $_POST ) {
	$post_array = $_POST ; 
	$post_array["psd_password"] = md5 ( $post_array["psd_password"] ) ; 
	$admin_detail = $data->select ( "Admins","*",array ( "AdminEmail"=>addslashes ( $post_array["txtEmailAddress"] ) ,"AdminPassword"=>$post_array["psd_password"] ) ) ; 

	if ( !empty ( $admin_detail ) ) 
	{ 
		$admin_detail = $admin_detail[0] ;
		$_SESSION["login_admin_id"] = intval ( $admin_detail["AdminID"] ) ; 
		$_SESSION["login_admin_email"] = $admin_detail["AdminEmail"] ;
		$_SESSION["admin_rights"]["r_home"] = intval ( $admin_detail["IsSite_Manage"] ) ; 
		$_SESSION["admin_rights"]["r_coupon"] = intval ( $admin_detail["IsCoupon_Manage"] ) ;
		$_SESSION["admin_rights"]["r_website"] = intval ( $admin_detail["IsWebsite_Manage"] ) ; 
		$_SESSION["admin_rights"]["r_tag"] = intval ( $admin_detail["IsTag_Manage"] ) ; 
		$_SESSION["admin_rights"]["r_comment"] = intval ( $admin_detail["IsComment_Manage"] ) ; 
		$_SESSION["admin_rights"]["r_account"] = intval ( $admin_detail["IsAccount_Manage"] ) ; 
		$_SESSION["admin_rights"]["r_page"] = intval ( $admin_detail["IsPage_Manage"] ) ; 
		header ( "Location: home.php") ; exit ( ) ; 
	} 
}

header ( "Location: index.php") ; 
?>