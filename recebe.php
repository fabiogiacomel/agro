<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("INSERT INTO local (imei, longitude, latitude, data)
  VALUES (:imei, :longitude, :latitude, :data)");

  $stmt->bindParam(':imei', $imei);
  $stmt->bindParam(':longitude', $longitude);
  $stmt->bindParam(':latitude', $latitude);
  $stmt->bindParam(':data', $data);

  $imei = "0210221100";
  $longitude = "12151515";
  $latitude = "115142415";
  $data = "01/02/01";
  $stmt->execute();

  echo "Dados ";
} catch(PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
$conn = null;
?>