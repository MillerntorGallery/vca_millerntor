<?php

die('nothing here');

$loc = setlocale(LC_ALL, 'fr_FR');

echo $loc.':'.strftime("%A %e %B %Y");

$loc_de = setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
echo "Preferred locale for german on this system is '$loc_de'";
exit;
error_reporting(E_ALL);
  ini_set("display_errors", 1);
echo "hello";
//exit;

$dbhost = 'localhost';
//$dbhost = '127.0.0.1';
$dbuser = 'millerntor';
//$dbuser = 'root';
$dbpass = 'aenovuodashuteiv';
//$dbpass = '';
$table = 'tx_vcamillerntor_domain_model_kuenstler';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}




mysql_select_db('millerntor');
//mysql_select_db('ml_62');





$row_count = 1;
if (($handle = fopen("artistmg5.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 4000, ";")) !== FALSE) {
        $num = count($data);
        
        echo $row_count.':'.$num.':'.$data[0].'<br />'; 
    
	    $search_sql = 'SELECT * FROM '.$table.' WHERE LOWER(name) LIKE ("'.strtolower($data[0]).'") AND sys_language_uid=0';
	  
		$result = mysql_query( $search_sql, $conn );
		if(! $result )
		{
		  die('Could not enter data: ' . mysql_error());
		} else {
			if (mysql_num_rows($result) == 0) {
				
				//INSERT
				$sql = 'INSERT INTO  '.$table.'(name,decription,url,facebook,other,pid,tstamp,crdate) '.
				'VALUES ( "'.$data[0].'","'.addslashes ( $data[3]).'","'.$data[1].'","'.$data[2].'","'.$data[5].'", 4,TIMESTAMP(NOW()),TIMESTAMP(NOW()) )';
				echo $sql.'<br />';
				
				$retval = mysql_query( $sql, $conn );
				if(! $retval )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				$uid = mysql_insert_id();

				echo 'insert-uid: '.$uid.'<br />';
				
			} else {
				while ($row = mysql_fetch_assoc($result)) {
				  	$sql = 'UPDATE  '.$table.' SET decription="'.addslashes ( $data[3]).'",url="'.$data[1].'",facebook="'.$data[2].'",other="'.$data[5].'" WHERE uid='.$row['uid'];
					echo $sql.'<br />';
					$retval = mysql_query( $sql, $conn );
					if(! $retval )
					{
					  die('Could not enter data: ' . mysql_error());
					}
				
				    echo $row['name'].':';
				    echo $row['uid'].'<br /><br />';
				    $uid = $row['uid'];

				}			
			}

			//create translation
			//search translation
			
			$search_trans_sql = 'SELECT * FROM '.$table.' WHERE LOWER(name) LIKE ("'.strtolower($data[0]).'") AND sys_language_uid = 1';
	  
			$result_trans = mysql_query( $search_trans_sql, $conn );
			if(! $result_trans )
			{
			  die('Could not find translation data: ' . mysql_error());
			} else {
				if (mysql_num_rows($result_trans) == 0) {
					 
					//INSERT new translation
					$sql_trans = 'INSERT INTO  '.$table.'(name,decription,pid,sys_language_uid,l10n_parent,tstamp,crdate) '.
					'VALUES ( "'.$data[0].'","'.addslashes ( $data[4]).'", 4,1,'.$uid.',NOW(),NOW() )';
					echo 'trans: '.$sql_trans.'<br />';
					
					$retval_trans = mysql_query( $sql_trans, $conn );
					if(! $retval_trans )
					{
					  die('Could not enter data: ' . mysql_error());
					}
					$uid_trans = mysql_insert_id();

					
					
				} else {
					while ($row_trans = mysql_fetch_assoc($result_trans)) {
					  	$sql_trans = 'UPDATE  '.$table.' SET decription="'.addslashes ( $data[4]).'" WHERE uid='.$row_trans['uid'];
						echo 'trans_update: '.$sql_trans.'<br />';
						$retval_trans = mysql_query( $sql_trans, $conn );
						if(! $retval_trans )
						{
						  die('Could not enter data: ' . mysql_error());
						}
					
					    echo 'trans:'.$row_trans['name'].':';
					    echo $row_trans['uid'].'<br /><br />';
					    $uid_trans = $row_trans['uid'];
					}			
				}
			}	
			
		}
    	
        //SET Gallery 2015
		//
		// Already set?
	
		$gal_sql = 'SELECT * FROM tx_vcamillerntor_ausstellung_kuenstler_mm WHERE uid_local=4 AND uid_foreign='.$uid;
		$res_gal = mysql_query( $gal_sql, $conn );
		if (mysql_num_rows($res_gal) == 0) {
			$ins_sql = 'INSERT INTO tx_vcamillerntor_ausstellung_kuenstler_mm (uid_local,uid_foreign) VALUES (4,'.$uid.')';
			$retval = mysql_query( $ins_sql, $conn );
		}
	
        $row_count++;    
        
    }
    fclose($handle);
}

echo $row_count;

mysql_close($conn);

?> 
