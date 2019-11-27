<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {
	$nama_bar = mysqli_real_escape_string($mysqli, $_POST['nama_bar']);
	$harga_jual = mysqli_real_escape_string($mysqli, $_POST['harga_jual']);
	$stoc_bar = mysqli_real_escape_string($mysqli, $_POST['stoc_bar']);
	// checking empty fields
	if(empty($nama_bar) || empty($harga_jual) || empty($stoc_bar)) {

		if(empty($nama_bar)) {
			echo "<font color='red'>nama pelanggan field is empty.</font><br/>";
		}

		if(empty($harga_jual)) {
			echo "<font color='red'>harga field is empty.</font><br/>";
		}

		if(empty($stoc_bar)) {
				echo "<font color='red'>jk field is empty.</font><br/>";
		}

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO masterbarang(nama_bar,harga_jual,stoc_bar) VALUES('$nama_bar','$harga_jual','$stoc_bar');");
		//$last_id = mysqli_insert_id($mysqli);
		//$result1 = mysqli_query($mysqli, "INSERT INTO member(id_pelanggan,kode_pel,start, ends) VALUES('$last_id','$kode_pel','$start','$ends');");
		if ($result === TRUE) {
		echo "New record created successfully";
		header("Location: listbarang.php");
		} else {
				echo "Error: " . $result1 . "<br>" . $mysqli->error;
		}
	}
}
?>
</body>
</html>
