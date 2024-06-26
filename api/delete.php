<?php
 //headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: DELETE');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

 include_once('../core/initialize.php');

 $post = new Post($db);

 $data = json_decode(file_get_contents("php://input"));

 $post->Country = $data->Country;
 
 if($post->delete()){
    echo json_encode(
        array('message' => 'Success! Data has been deleted.')
    );
 }else{
    echo json_encode(
        array('message' => 'Error! Data has not been deleted.')
    );
 }