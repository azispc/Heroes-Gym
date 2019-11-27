<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nama_bar = mysqli_real_escape_string($mysqli, $_POST['nama_bar']);
	$harga_jual = mysqli_real_escape_string($mysqli, $_POST['harga_jual']);
	$stoc_bar = mysqli_real_escape_string($mysqli, $_POST['stoc_bar']);

  // checking empty fields
	if(empty($nama_bar) || empty($harga_jual) || empty($stoc_bar)) {

		if(empty($nama_bar)) {
			echo "<font color='red'>Kode field is empty.</font><br/>";
		}

		if(empty($harga_jual)) {
			echo "<font color='red'>Nama field is empty.</font><br/>";
		}

		if(empty($stoc_bar)) {
			echo "<font color='red'>stoc field is empty.</font><br/>";
		}

	} else {
		echo $nama_bar;
		echo $harga_jual;
		echo $stoc_bar;
		//updating the table
		$result1 = mysqli_multi_query($mysqli, "UPDATE masterbarang SET masterbarang.nama_bar='$nama_bar',masterbarang.harga_jual='$harga_jual', masterbarang.stoc_bar='$stoc_bar' WHERE masterbarang.id_bar=$id");
		if($result1 == FALSE){
				echo "<font color='red'>ends field is empty.</font><br/>".$mysqli->error;
			}
		//redirectig to the display page. In our case, it is index.php
		header("Location: listbarang.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM masterbarang WHERE masterbarang.id_bar=$id");

while($res = mysqli_fetch_array($result))
{
	$nama_bar=$res['nama_bar'];
	$harga_jual = $res['harga_jual'];
	$stoc_bar= $res['stoc_bar'];
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
		<a href="listbarang.php">Kembali ke Halaman Daftar Barang</a><br/> <br/>
	</center>

	<form name="form1" method="post" action="editbarang.php">
		<table border="0" align="center">
			<tr>
				<td>Nama Barang</td>
				<td><input type="text" name="nama_bar" value="<?php echo $nama_bar;?>"></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><input type="text" name="harga_jual" value="<?php echo $harga_jual;?>"></td>
			</tr>
			<tr>
				<td>Stock Barang</td>
				<td><input type="text" name="stoc_bar" value="<?php echo $stoc_bar;?>"></td>
			</tr>

			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
