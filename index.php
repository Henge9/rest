<?php 
include_once 'config.php';
header('Access-Control-Allow-Origin: http://localhost:3000');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Content-Type: application/json');

//writes the url /rest/tablename/column/id into $fullurl
$fullurl = $_SERVER['REQUEST_URI']; 

//makes a array of the url
$url_parts = explode('?/', $fullurl);


//split the aray up for easyer understanding of the code
$url_to_query = explode('/',$url_parts[1]);
/* ====================================
test ekon
===========================
echo $url_parts[0];
echo "||";
echo $url_parts[1];
echo "||";
echo $url_to_query[0];
echo "||";
echo $url_to_query[1];
===============================*/
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
	/rest/?/table-name
	
	============================*/
	case 'GET':
		$query = "
			SELECT *
			FROM $url_to_query[0]
			;";
		
		$result = mysqli_query($db, $query);
		$num_rows = db_to_json($result);
		break;
	
	default:
		echo "Method not accepeted";
		break;
}


function db_to_json($result) {
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
    	$rows[] = $r;
	}
	
	
	echo (json_encode($rows)); 
}





?>