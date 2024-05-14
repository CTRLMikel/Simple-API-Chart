<?php
 //headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

 include_once('../core/initialize.php');

 $post = new Post($db);
 $data = json_decode(file_get_contents("php://input"));

 $post->Country = $data->Country;
 $post->Alcohol = $data->Alcohol;

 if($post->update()){
    echo json_encode(
        array('message' => 'Update success!')
    );
 }else{
    echo json_encode(
        array('message' => 'Update failed!')
    );
}