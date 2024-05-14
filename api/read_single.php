<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 
 include_once('../core/initialize.php');

 $post = new Post($db);

$post->id = isset($_GET['Country']) ? $_GET['Country'] : die();
$post->read_single();

$post_arr = array(
    'Country' => $post->Country,
    'Alcohol' => $post->Alcohol,
);

print_r(json_encode($post_arr));