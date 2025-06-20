<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Content-type: application/json");

require "db.php";
require "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$params = explode("/", $_GET['q']);
$request_type = $params[0];
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	switch ($request_type) {
		case "login":
			$login_data = json_decode(file_get_contents("php://input"), true);
			login($login_data['email'], $login_data['password']);
			break;
		case "register":
			$register_data = json_decode(file_get_contents("php://input"), true);
			register($register_data);
			break;
	}
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
	if ($request_type === "profile") {
	    $headers = apache_request_headers();
	    if (!empty($headers['Authorization'])) {
	    	$token = str_replace("Bearer ", "", $headers['Authorization']);
	    	profile($token);
	    }
	}
}