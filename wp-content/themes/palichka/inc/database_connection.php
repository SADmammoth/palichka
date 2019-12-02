<?php
require_once("../../../../wp-load.php");
if($_POST['reload'] && $_POST['psw'] === 'Vfrc200018reloadbb'){

  $connectionInfo = array("UID" => "palichkaapp", "pwd" => "Vfrc200018", "Database" => "palichkadata", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
  $serverName = "tcp:palichkaserver.database.windows.net,1433";
  $conn = sqlsrv_connect($serverName, $connectionInfo);
  sqlsrv_query($conn, 'EXEC getUpdates');
}
header('Location: '.get_site_url());
?>