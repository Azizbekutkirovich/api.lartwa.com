<?php
require_once "vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validateEmail($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
	return true;
}

function validatePassword($password) {
	if (strlen($password) !== 8) return false;
	return true;
}

function setError($error) {
	$errors = [
		"email error" => "Email doesn't validated",
		"password error" => "Password len error"
	];
	$res = [
		'status' => false,
		"message" => $errors[$error]
	];
	echo json_encode($res);
}

function addToken($user_id) {
	$secret_key = "api_1_aziz_php_25062007";
	$started_at = time();
	$ended_at = $started_at + 3600;
	$payload = [
		"iat" => $started_at,
		"exp" => $ended_at,
		"user_id" => $user_id
	];
	$token = JWT::encode($payload, $secret_key, "HS256");
	http_response_code(201);
	$res = [
		"status" => true,
		"token" => $token
	];
	echo json_encode($res);
}

function login($email, $password) {
	global $pdo;
	$query1 = $pdo->prepare("SELECT * FROM users WHERE email = ?");
	$query1->execute([$email]);
	$user = $query1->fetch(PDO::FETCH_ASSOC);
	if (!empty($user)) {
		if (password_verify($password, $user['password'])) {
			addToken($user['id']);
		} else {
			$res = [
				"status" => false,
				"message" => "Email or password wrong"
			];
			echo json_encode($res);
		}
	} else {
		$res = [
			"status" => false,
			"message" => "Email or password wrong"
		];
		echo json_encode($res);
	}
}

function register($data) {
	$name = $data['name'];
	$email = $data['email'];
	$password = $data['password'];
	if (!validateEmail($email)) {
		setError("email error");
	} elseif (!validatePassword($password)) {
		setError("password error");
	} else {
		global $pdo;
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
		$query = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
		$query->execute([$name, $email, $hash_password]);
		$user_id = $pdo->lastInsertId();
		login($email, $password);
	}
}

function profile($token) {
	$key = "api_1_aziz_php_25062007";
	try {
		$decode = JWT::decode($token, new Key($key, "HS256"));
		$user_id = $decode->user_id;
		global $pdo;
		$query = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
		$query->execute([$user_id]);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$res = [
			"status" => true,
			"name" => $data['name'],
			"email" => $data['email']
		];
		echo json_encode($res);
	} catch (Exception $e) {
		http_response_code(401);
		echo json_encode(["message" => "Token noto'g'ri yoki vaqti tugagan", "error" => $e->getMessage()]);
	}
}