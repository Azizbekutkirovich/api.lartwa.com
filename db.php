<?php

try {
	$pdo = new PDO("mysql:host=localhost;dbname=lartwa.com;charset=utf8mb4", "root", "");
	
} catch (PDOException $e) {
	echo "Xatolik: ".$e->getMessage();
	exit;
}