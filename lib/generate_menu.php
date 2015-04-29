<?php
require ( "../config.php" ) ;
require_once ( "../classes/manipulate.php" ) ;
$data = new DataManipulator ;
require ( "../classes/misc.func.php" ) ;

function sef_tag($id){
	$h_db = mysql_connect(DBSERVER,DBUSERNAME,DBPASSWORD);
	mysql_select_db(DBNAME,$h_db);
	$q = "SELECT * FROM SEF_URL WHERE EntityType='Tag' AND EntityID=$id ";
	$res = mysql_query($q,$h_db);
	$row = mysql_fetch_assoc($res);
	$url = $row["URL"];
	return $url;
}

$cols=9;
$rows=5;
$k = 0;

$tags = $data->select2 ( "SELECT count(*) AS nr, Tag.TagID, Tag.TagName FROM `Website_Tag`, Tag WHERE Tag.TagID=Website_Tag.TagID GROUP BY TagID ORDER BY nr DESC LIMIT 0,{$cols}" ) ;
if ( ! empty ( $tags ) ){

	foreach($tags as $key => $val) {
		$names_tag[$tags[$key]["TagID"]] = strtolower($tags[$key]["TagName"]);
		$k++;
		$key_tag[$k] = $tags[$key]["TagID"];
	}
	$b = asort($names_tag);
	$menu = '
	<ul class="sf-menu">';

	foreach($names_tag as $key => $val) {
		$menu .='
		<li>
			<a href="'. base_url."coupons/".sef_tag($key) .'/">'. $val .'</a>
			<ul>';
	   $websites = $data->select2 ( "SELECT * FROM Website_Tag WHERE TagID='".$key."' LIMIT 0,10 ") ;
		$s = "(0 ";
		if ( ! empty ( $websites ) )
			foreach ( $websites as $web ){
				$s.="OR Website_Tag.WebsiteID=".$web['WebsiteID']." ";
			}
		$s.=")";
		
		$taguri = $data->select2 ( "select * from Tag, Website_Tag where ".$s." AND Tag.TagID=Website_Tag.TagID LIMIT 0,".($cols*$rows) ) ;
		if ( ! empty ( $taguri ) ){
			$kk=1;
			foreach ( $taguri as $mtag ) {
				if((!in_array($mtag["TagID"],$key_tag))&&($kk<=$rows)){
					$menu .='                   
					<li><a href="'. base_url."coupons/".sef_tag($mtag["TagID"]) .'/">'.strtolower($mtag["TagName"]) .'</a></li>';
					$kk++;
					$k++;
					$key_tag[$k] = $mtag["TagID"];
				}
			}
		}
		
		$menu .='
			</ul>
		</li>';
	}
	$menu .='
	</ul>';
}

$filename = '../media/main_menu.txt';
$somecontent = $menu;
if (!$handle = fopen($filename, 'w')) {
	 echo "Cannot open file ($filename)";
	 exit;
}

if (fwrite($handle, $somecontent) === FALSE) {
	echo "Cannot write to file ($filename)";
	exit;
}
echo "Success, wrote to file ($filename)";

fclose($handle);

?>