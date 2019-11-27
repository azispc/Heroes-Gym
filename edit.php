<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$kode_pel = mysqli_real_escape_string($mysqli, $_POST['kode_pel']);
	$nama_pel = mysqli_real_escape_string($mysqli, $_POST['nama_pel']);
	$jk = mysqli_real_escape_string($mysqli, $_POST['jk']);
	$telp = mysqli_real_escape_string($mysqli, $_POST['telp']);
	$start = mysqli_real_escape_string($mysqli, $_POST['start']);
	$ends = mysqli_real_escape_string($mysqli, $_POST['ends']);
	$alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
	$status = mysqli_real_escape_string($mysqli, $_POST['status_pel']);
	$harga = mysqli_real_escape_string($mysqli, $_POST['harga']);

	// checking empty fields
	if(empty($kode_pel) || empty($nama_pel) || empty($jk) || empty($telp) || empty($alamat) || empty($start) || empty($ends) || empty($status) || empty($harga)) {

		if(empty($kode_pel)) {
			echo "<font color='red'>Kode field is empty.</font><br/>";
		}

		if(empty($nama_pel)) {
			echo "<font color='red'>Nama field is empty.</font><br/>";
		}

		if(empty($jk)) {
			echo "<font color='red'>Jk field is empty.</font><br/>";
		}
		if(empty($telp)) {
			echo "<font color='red'>Telp field is empty.</font><br/>";
		}
		if(empty($alamat)) {
			echo "<font color='red'>alamat field is empty.</font><br/>";
		}

		if(empty($start)){
				echo "<font color='red'>start field is empty.</font><br/>";
		}

		if(empty($ends)){
				echo "<font color='red'>ends field is empty.</font><br/>";
		}
		if(empty($status)){
				echo "<font color='red'>status field is empty.</font><br/>";
		}
		if(empty($harga)){
				echo "<font color='red'>harga field is empty.</font><br/>";
		}

	} else {
		//updating the table
		$result1 = mysqli_multi_query($mysqli, "UPDATE pelanggan JOIN member SET pelanggan.status_pel='$status',pelanggan.nama_pel='$nama_pel',pelanggan.jk='$jk', pelanggan.telp='$telp', pelanggan.alamat='$alamat', member.harga='$harga', member.kode_pel='$kode_pel', member.start='$start', member.ends='$ends' WHERE pelanggan.id_pel=$id and member.id_pelanggan=$id");
		if($result1 == FALSE){
				echo "<font color='red'>ends field is empty.</font><br/>".$mysqli->error;
			}
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM pelanggan, member WHERE pelanggan.id_pel=$id and member.id_pelanggan=$id");

while($res = mysqli_fetch_array($result))
{
	$kode_pel=$res['kode_pel'];
	$nama_pel = $res['nama_pel'];
	$jk = $res['jk'];
	$telp = $res['telp'];
	$alamat=$res['alamat'];
	$start=$res['start'];
	$ends=$res['ends'];
	$status=$res['status_pel'];
	$harga=$res['harga'];
}
?>
<html>
<head>
	<title>Edit Data</title>
</head>

<body>
	<center>
		<h3>EDIT/PERPANJANG MEMBER HEROES GYM</h3>
		<h4>DRAMAGA BOGOR</h4>
		<a href="index.php">Kembali ke Halaman Utama</a><br/> <br/>
	</center>

	<form name="form1" method="post" action="edit.php">
		<table border="0" align="center">
			<tr>
				<td>Kode Pelanggan</td>
				<td><input type="text" name="kode_pel" value="<?php echo $kode_pel;?>"></td>
			</tr>
			<tr>
				<td>Nama Pelanggan</td>
				<td><input type="text" name="nama_pel" value="<?php echo $nama_pel;?>"></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><input type="text" name="jk" value="<?php echo $jk;?>"></td>
			</tr>

			<tr>
				<td>Telpon</td>
				<td><input type="text" name="telp" value="<?php echo $telp;?>"></td>
			</tr>

			<tr>
				<td>Start Member</td>
				<td><input type="date" name="start" value="<?php echo $start;?>"></td>
			</tr>

			<tr>
				<td>End Member</td>
				<td><input type="date" name="ends" value="<?php echo $ends;?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td><input type="text" name="status_pel" value="<?php echo $status;?>"></td>
			</tr>

			<tr>
				<td>Harga</td>
				<td><input type="text" name="harga" value="<?php echo $harga;?>"></td>
			</tr>

			<tr>
				<td>Alamat</td>
				<td><input type="text" name="alamat" value="<?php echo $alamat;?>"></td>
			</tr>

			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
