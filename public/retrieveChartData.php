<?php

$city = $_GET['str'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Aanpassing gemaakt zodat de nieuwe database tabel gebruikt kan worden voor de grafiek op de home pagina
// $sql = "SELECT `aantal`, `Ingangsdatum` FROM overzicht WHERE `product_toevoeger_vestiging` = '$city'";
$sql = "SELECT overzicht.Aantal, overzicht.Created_at FROM `overzicht` INNER JOIN users ON overzicht.User_id = users.id WHERE users.vestiging = '$city'";


$result = $conn->query($sql);

if ($result->num_rows > 0) {


    

	$i = 0;
	$jan = 0;
	$feb = 0;
	$mar = 0;
	$apr = 0;
	$mei = 0;
	$jun = 0;
	$jul = 0;
	$aug = 0;
	$sep = 0;
	$okt = 0;
	$nov = 0;
	$dec = 0;
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$i++;

    	$i = substr($row["Created_at"], 5, 10) . ", ";

		if ($i >= "01-01" && $i <= "01-31") {
			$jan++;

    	}else if ($i >= "02-01" && $i <= "02-28") {
    		$feb++;

    	}else if ($i >= "03-01" && $i <= "03-31") {
    		$mar++;

    	}else if ($i >= "04-01" && $i <= "03-30") {
    		$apr++;

    	}else if ($i >= "05-01" && $i <= "05-31") {
    		$mei++;

    	}else if ($i >= "06-01" && $i <= "06-30") {
    		$jun++;

    	}else if ($i >= "07-01" && $i <= "07-31") {
    		$jul++;

    	}else if ($i >= "08-01" && $i <= "08-31") {
    		$aug++;

    	}else if ($i >= "09-01" && $i <= "09-30") {
    		$sep++;

    	}else if ($i >= "10-01" && $i <= "10-31") {
    		$okt++;

    	}else if ($i >= "11-01" && $i <= "11-30") {
    		$nov++;

    	}else if ($i >= "12-01" && $i <= "12-31") {
    		$dec++;

    	}

    }

    $data = array($jan, $feb, $mar, $apr, $mei, $jun, $jul, $aug, $sep, $okt, $nov, $dec);

    echo json_encode($data);

} else {
    $data = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    echo json_encode($data);
}
$conn->close();