<?php
exit;

$dbhost = 'localhost';
$dbuser = 'millerntor';
$dbpass = 'aenovuodashuteiv';
$table = 'tx_vcamillerntor_domain_model_kuenstler';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('millerntor');

$search_sql = 'SELECT * FROM '.$table.'';
  
$result = mysql_query( $search_sql, $conn );
if(! $result )
{
  die('Could not enter data: ' . mysql_error());
} else {
	while ($row = mysql_fetch_assoc($result)) {
	    $uid = $row['uid'];

	    $gal_sql = 'SELECT * FROM tx_vcamillerntor_ausstellung_kuenstler_mm WHERE uid_local=2 AND uid_foreign='.$uid;
		$res_gal = mysql_query( $gal_sql, $conn );
		if (mysql_num_rows($res_gal) == 0) {
			$ins_sql = 'INSERT INTO tx_vcamillerntor_ausstellung_kuenstler_mm (uid_local,uid_foreign) VALUES (2,'.$uid.')';
			$retval = mysql_query( $ins_sql, $conn );
		}
	}			
}
