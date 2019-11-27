<html>
<head>
	<title>Tambah Member</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {
	$start = mysqli_real_escape_string($mysqli, $_POST['start']);
	$ends = mysqli_real_escape_string($mysqli, $_POST['ends']);
	$kode_pel = mysqli_real_escape_string($mysqli, $_POST['kode_pel']);
	$nama_pel = mysqli_real_escape_string($mysqli, $_POST['nama_pel']);
	$jk = mysqli_real_escape_string($mysqli, $_POST['jk']);
	$telp = mysqli_real_escape_string($mysqli, $_POST['telp']);
	$alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);

	// checking empty fields
	if(empty($kode_pel) || empty($nama_pel) || empty($jk) || empty($telp) || empty($alamat) || empty($start) || empty($ends)) {

		if(empty($kode_pel)) {
			echo "<font color='red'>kode pelanggan field is empty.</font><br/>";
		}

		if(empty($nama_pel)) {
			echo "<font color='red'>Nama field is empty.</font><br/>";
		}

		if(empty($jk)) {
				echo "<font color='red'>jk field is empty.</font><br/>";
		}

		if(empty($telp)) {
			echo "<font color='red'>telp field is empty.</font><br/>";
		}


		if(empty($alamat)) {
				echo "<font color='red'>alamat field is empty.</font><br/>";
		}

		if(empty($start)) {
				echo "<font color='red'>start field is empty.</font><br/>";
		}

		if(empty($end)) {
				echo "<font color='red'>end field is empty.</font><br/>";
		}

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO pelanggan(nama_pel,jk,telp,alamat) VALUES('$nama_pel','$jk','$telp','$alamat');");
		$last_id = mysqli_insert_id($mysqli);
		$result1 = mysqli_query($mysqli, "INSERT INTO member(id_pelanggan,kode_pel,start, ends) VALUES('$last_id','$kode_pel','$start','$ends');");
		if ($result1 === TRUE) {
		echo "New record created successfully";
		header("Location: index.php");
		} else {
				echo "Error: " . $result1 . "<br>" . $mysqli->error;
		}
	}
}
?>
</body>
</html>
