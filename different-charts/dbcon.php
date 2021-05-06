<?php
//address of the server where db is installed
$servername = "localhost";

//username to connect to the db
//the default value is root
$username = "root";

//password to connect to the db
//this is the value you would have specified during installation of WAMP stack
$password = "";

//name of the db under which the table is created
$dbName = "demodb";

//establishing the connection to the db.
$conn = new mysqli($servername, $username, $password, $dbName);

//checking if there were any error during the last connection attempt
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//the SQL query to be executed
$query = "SELECT * FROM tbl_sales";

//storing the result of the executed query
$result = $conn->query($query);

//initialize the array to store the processed data
$jsonArray = array();

//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['Month'];
    $jsonArrayItem['actual_revenue'] = $row['Actual Revenue'];
    $jsonArrayItem['projected_revenue'] = $row['Projected Revenue'];    
    $jsonArrayItem['profit'] = $row['Profit'];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}

//Closing the connection to DB
$conn->close();

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>
