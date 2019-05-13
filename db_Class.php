<?php
$DBhos = 'localhost';
$DBuse = 'root';
$DBpas = '';
$DBNam = 'db_imran';


class db_class
{
	//MyQql Property
	var $conn;
	var $result;
################################   DO NOT CHANGE   #################################
									//MySql Method
									
	//Connect the Server
	
	function MySQL($host="localhost", $user="root", $pass="",$bd="db_imran")

	//function MySQL($host, $user, $pass,$bd)
	{
		
		$this->conn = mysql_connect($host,$user,$pass) or die(mysql_error()) 
				or die('Could not connect: ' . mysql_error());
				
		$this->select_db($bd);
	}
	
	//Connect to badabase
	function select_db($bd)
	{
				$db=mysql_select_db($bd,$this->conn) or die(mysql_error())
						or die('Could not connect to '. $bd .' ' . mysql_error());
	}
	
	//Generate Querey
	function sql($SQL)
	{
		mysql_query('SET CHARACTER SET utf8');
mysql_query("SET SESSION collation_connection ='utf8_general_ci'");
		
		$this->result = mysql_query($SQL)
		or
		die('SQL Error<br>' .$SQL.' '. mysql_error());

		return $this->result;
		
	}

}

$setting_list='<option selected>Select Menu</option>
                          <option value="Home" >Home</option>
                          <option value="Product" >Product</option>
                          <option value="FAQ">FAQ</option>';



// SELECT * 
//FROM  `status` 
//WHERE  `crop_type` 
//REGEXP  'Wheat|Rice'


/*SELECT * 
FROM (
SELECT  'Missed Call' AS 
TYPE , COUNT( uniqueid ) total
FROM cdr
WHERE disposition =  'NO ANSWER'
AND billsec =0
AND lastapp =  'Hangup'
AND uniqueid NOT 
IN (

SELECT DISTINCT uniqueid
FROM STATUS WHERE (
uniqueid IS NOT NULL 
AND uniqueid !=0
)
UNION SELECT DISTINCT uniqueid
FROM STATUS WHERE (
uniqueid IS NOT NULL 
AND uniqueid !=0
)
)
ORDER BY calldate DESC
)a
UNION

SELECT  'Answered' AS 
TYPE , COUNT( uniqueid ) total
FROM STATUS WHERE STATUS =  'answered'
UNION 
SELECT  'Alert' AS 
TYPE , COUNT( uniqueid ) total
FROM STATUS WHERE STATUS =  'alert'
UNION 
SELECT  'Processing' AS 
TYPE , COUNT( uniqueid ) total
FROM STATUS WHERE STATUS =  'processing' */

?>