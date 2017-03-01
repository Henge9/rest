<?php 
include_once 'config.php';


//writes the url /rest/tablename/column/id into $fullurl
$fullurl = $_SERVER['REQUEST_URI']; 
echo $fullurl;
echo '<br>';
//makes a array of the url
$url_parts = explode('?', $fullurl);
//split the aray up for easyer understanding of the code
$url_to_query = explode('&',$url_parts[1]);
$table = explode('=',$url_to_query[0]);
$column = explode('=',$url_to_query[1]);

/*=============================
Please note that the request method 
shall not be confused with $_POST and $_GET from 
forms in HTML....
HTTP:	|CRUD:	|mySQL:
GET		|READ	|SELECT
PUT		|UPDATE	|UPDATE
POST	|CREATE	|INSERT INTO
DELETE	|DELETE	|DELETE
===============================*/
$method = $_SERVER['REQUEST_METHOD'];

//switch to make correct SQL query
switch ($method) {
	/*==========================
	GET example:
	/rest/?table=test&column=*
	
	============================*/
	case 'GET':
		$query = "
			SELECT $column[1]
			FROM $table[1]
			;";
		echo $query;
		$result = mysqli_query($db, $query);
		$num_rows = db_print_result($result);
		break;
	
	default:
		echo "crap";
		break;
}
echo $method;


function db_print_result($result) {
	$i = 0;
	while ($row = mysqli_fetch_assoc($result)) {
   		$i++;
   		if ($i==1) {
   			foreach ($row as $index => $value) {
   				echo "$index, ";
   			}
   			echo "<br>\n";
   		}
   		foreach ($row as $value) {
   			echo "$value, ";
   		}
   		echo "<br>\n";
	}
	return $i;
}
/*


*/