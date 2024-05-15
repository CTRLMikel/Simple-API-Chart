<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../core/initialize.php');

// Assuming $db is your PDO database connection object

$data = json_decode(file_get_contents("php://input"));

$country = $data->Country;
$alcohol = is_numeric($data->Alcohol) ? $data->Alcohol: 0;
if(empty($country)) die("No country");

$sql = "INSERT INTO alcohol (Country, Alcohol) VALUES (:country, :alcohol)";

$stmt = $db->prepare($sql);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':alcohol', $alcohol);

// Execute the statement
if (!$stmt->execute()) {
    // Failed to add data
    http_response_code(500);
    echo json_encode(array("error" => "Failed to add data"));
}

// Close statement
$stmt->closeCursor();
?>
