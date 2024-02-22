<!-- UDAH DI TES DAN OK -->
<?php
require "../connection.php";
// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "esp";

$api_key= $nama = $tds=$temp_hidro= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = saring($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $nama = saring($_POST["nama"]);
        $tds = saring($_POST["tds"]);
        $temp_hidro = saring($_POST["temp$temp_hidro"]);
       
    
        // Create connection
      
try{        
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO hidroponik (nama, tds,temp_hidro)VALUES ('" . 'hidroponik' . "', '" . $tds . "','" . $temp_hidro . "','" . "')";
			$connection->exec($sql);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$connection = null;
    
        $connection->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}
?>
