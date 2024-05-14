<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../core/initialize.php');

// Assuming $db is your PDO database connection object

$data = json_decode(file_get_contents("php://input"));

$country = $data->Country;
$alcohol = $data->Alcohol;

// Check if the new alcohol value is greater than the maximum existing value
$sql = "SELECT MAX(Alcohol) AS max_alcohol FROM alcohol";
$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$maxAlcohol = $row['max_alcohol'];

// Decide where to insert the new entry
if ($alcohol > $maxAlcohol) {
    // If the new alcohol value is greater than the maximum existing value,
    // insert the new entry at the top of the database
    $sql = "INSERT INTO alcohol (Country, Alcohol) VALUES (:country, :alcohol)";
} else {
    // Otherwise, insert the new entry normally
    $sql = "INSERT INTO alcohol (Country, Alcohol) SELECT :country, :alcohol FROM dual WHERE NOT EXISTS (SELECT * FROM alcohol WHERE Alcohol >= :alcohol)";
}

$stmt = $db->prepare($sql);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':alcohol', $alcohol);

// Execute the statement
if ($stmt->execute()) {
    // Data added successfully
    echo json_encode(array("message" => "Data added successfully"));
} else {
    // Failed to add data
    http_response_code(500);
    echo json_encode(array("error" => "Failed to add data"));
}

// Close statement
$stmt->closeCursor();
?>
