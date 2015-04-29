<?php 


function get_category_path ( $categoryID ,&$array_to_fill ,&$manipulator ) { $data_temp = $manipulator->select ( "Category","*",array ( "CategoryID"=>$categoryID ) ) ; array_push( $array_to_fill ,$data_temp[0] ) ; if ( intval ( $data_temp[0]["HeadCategoryID"] ) >0 ) { get_category_path ( intval ( $data_temp[0]["HeadCategoryID"] ) ,$array_to_fill ,$manipulator ) ; } } 


function get_sub_categories ( $categoryID ,&$manipulator ) { $array_to_return = array ( ) ; $data_temp = $manipulator->select ( "Category","*",array ( "HeadCategoryID"=>$categoryID ) ) ; if ( !empty ( $data_temp ) ) { foreach ( $data_temp as $dat ) array_push ( $array_to_return ,$dat ) ; } return $array_to_return ; } 


function get_app_header ( &$mainCategory ) { include ( "theme/default/inc.header.php") ; } 


function get_app_media ( ) { echo base_url."theme/default/images/"; } 


function get_cat_icon ( $categoryID ) { $temp_src = base_url."media/cls_cat_".$categoryID."_5520.jpg"; echo $temp_src ; if ( file_exists ( $temp_src ) ) return ""; return "No Image"; } 


function get_menu ( ) { include ( "theme/default/inc.menu.php") ; } 


function get_base_url ( ) { return base_url ; } function get_listing_url ( $categoryID ,$regionID ) { if ( intval ( $categoryID ) <1 ) return base_url."browse.php"; if ( intval ( $categoryID ) <1 ) return base_url."browse.php?regid=".$regionID ; return base_url."browse.php?catid=".$categoryID ; } 


function get_post_url ( ) { return base_url."selectcat.php"; } function get_detail_link ( $clsID ) { return base_url."detail.php?clsid=".$clsID ; } 


function get_query_string_vars ( $exception = "") { $str = ""; if ( !empty ( $_GET ) ) { foreach ( $_GET as $key =>$val ) if ( $key != $exception ) $str .= "&$key=$val"; } return $str ; } 


function get_sef_search_listing_url ( $url_string ,$exception = "",$new_val = "") { $str = ""; $found = 0 ; if ( $url_string != "") { $var_params = explode ( "|",$url_string ) ; if ( !empty ( $var_params ) ) foreach ( $var_params as $val ) { if ( $val != "") { $var_temp = explode ( ":",$val ) ; if ( $var_temp[0] != $exception ) { $str .= $var_temp[0].":".$var_temp[1]."|"; } else { $found = 1 ; if ( $new_val != "") { $str .= $new_val."|"; } } } } if ( $found == 0 ) $str .= $new_val ; } else { $str = $new_val ; } return $str ; } 


function getDistance($a1,$b1,$a2,$b2) { $r = 3963.1; $pi = 3.14159265358979323846; $a1 = $a1*($pi/180); $a2 = $a2*($pi/180); $b1 = $b1*($pi/180); $b2 = $b2*($pi/180); $ret = (acos(cos($a1)*cos($b1)*cos($a2)*cos($b2) +cos($a1)*sin($b1)*cos($a2)*sin($b2) +sin($a1)*sin($a2)) * $r) ; return $ret; } 


function get_sef_url ( $entity_id ,$entity_type ) { if ( !$data ) { require_once ( "classes/manipulate.php") ; $data = new DataManipulator ; } $entity = $data->select ( "SEF_URL","*",array ( "EntityType"=>$entity_type,"EntityID"=>$entity_id ) ) ; return $entity[0]["URL"] ; } 


function generate_sef_url ( $entity_title ,$entity_id ,$entity_type ) { $data = new DataManipulator ; $entity_title = trim ( $entity_title ) ; $entity_title = str_replace ( " ","-",$entity_title ) ; $entity_title = str_replace ( "&","",$entity_title ) ; $entity_title = str_replace ( "?","",$entity_title ) ; $entity_title = str_replace ( "=","",$entity_title ) ; $entity_title = str_replace ( ">","",$entity_title ) ; $entity_title = str_replace ( ",","",$entity_title ) ; $entity_title = str_replace ( "'","",$entity_title ) ; $entity_title = str_replace ( "/","",$entity_title ) ; $entity_title = str_replace ( "\\","",$entity_title ) ; $entity_title = str_replace ( "--","-",$entity_title ) ; $entity_title = str_replace ( "--","-",$entity_title ) ; $entity_title = str_replace ( ":","",$entity_title ) ; $entity = $data->select ( "SEF_URL","*",array ( "URL"=>$entity_title ) ) ; if ( !empty ( $entity ) ) { return generate_sef_url ( $entity_title."-".$entity_id ,$entity_id ,$entity_type ) ; } else { return $data->insert ( "SEF_URL",array ( "EntityType"=>$entity_type ,"EntityID"=>$entity_id ,"URL"=>$entity_title ) ) ; } } 


function re_generate_sef_url ( $entity_title ,$entity_id ,$entity_type ) { $data = new DataManipulator ; $entity_title = trim ( $entity_title ) ; $entity_title = str_replace ( " ","-",$entity_title ) ; $entity_title = str_replace ( "&","",$entity_title ) ; $entity_title = str_replace ( "?","",$entity_title ) ; $entity_title = str_replace ( "=","",$entity_title ) ; $entity_title = str_replace ( ">","",$entity_title ) ; $entity_title = str_replace ( ",","",$entity_title ) ; $entity_title = str_replace ( "'","",$entity_title ) ; $entity_title = str_replace ( "/","",$entity_title ) ; $entity_title = str_replace ( "\\","",$entity_title ) ; $entity_title = str_replace ( ":","",$entity_title ) ; $entity = $data->select ( "SEF_URL","*",array ( "EntityType"=>$entity_type ,"EntityID"=>$entity_id ) ) ; if ( !empty ( $entity ) ) { return $data->update ( "SEF_URL",array ( "URL"=>$entity_title ) ,array ( "EntityType"=>$entity_type ,"EntityID"=>$entity_id ) ) ; } else { return generate_sef_url ( $entity_title ,$entity_id ,$entity_type ) ; } } 


function PPHttpPost ($methodName_,$nvpStr_ ,$paymentParam) { return; global $environment; $API_UserName = $paymentParam["PayPalUserName"]; $API_Password = $paymentParam["PayPalPassword"]; $API_Signature = $paymentParam["PayPalSignature"]; $API_Endpoint = "https://api-3t.paypal.com/nvp"; if("sandbox"=== $environment ||"beta-sandbox"=== $environment) { $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp"; } $version = urlencode('51.0'); $ch = curl_init(); curl_setopt($ch,CURLOPT_URL,$API_Endpoint); curl_setopt($ch,CURLOPT_VERBOSE,1); curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE); curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_POST,1); $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_"; curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq); $httpResponse = curl_exec($ch); if(!$httpResponse) { exit('$methodName_ failed: '.curl_error($ch).'('.curl_errno($ch).')'); } $httpResponseAr = explode("&",$httpResponse); $httpParsedResponseAr = array(); foreach ($httpResponseAr as $i =>$value) { $tmpAr = explode("=",$value); if(sizeof($tmpAr) >1) { $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1]; } } if((0 == sizeof($httpParsedResponseAr)) ||!array_key_exists('ACK',$httpParsedResponseAr)) { exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint."); } return $httpParsedResponseAr; } 


function get_status_license ( ) { $output = 1; } 

?>