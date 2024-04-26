<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/nodemcu_log.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Nodemcu_log($db);
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// The request is using the POST method
		$data = json_decode(file_get_contents("php://input"));
        //dht11
		$item->suhu = $data->suhu;
		$item->kelembaban = $data->kelembaban;

        //dht22
        $item->suhu22 = $data->suhu22;
        $item->kelembaban22 = $data->kelembaban22;

        //asap
        $item->ppm = $data->ppm;
	} 
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
		// The request is using the GET method

        //dht11
		$item->suhu = isset($_GET['t']) ? $_GET['t'] : die('wrong structure!');
		$item->kelembaban = isset($_GET['h']) ? $_GET['h'] : die('wrong structure!');

        //dht22
        $item->suhu22 = isset($_GET['t22']) ? $_GET['t22'] : die('wrong structure!');
		$item->kelembaban22 = isset($_GET['h22']) ? $_GET['h22'] : die('wrong structure!');

        //asap
        $item->ppm = isset($_GET['ppm']) ? $_GET['ppm'] : die('wrong structure!');
	}else {
		die('wrong request method');
	}
	
    if($item->createLogData()){
        echo 'Data created successfully.';
    } else{
        echo 'Data could not be created.';
    }
?>