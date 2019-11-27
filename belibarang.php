<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nama_bar = mysqli_real_escape_string($mysqli, $_POST['nama_bar']);
	$harga_jual = mysqli_real_escape_string($mysqli, $_POST['harga_jual']);
	$stoc_bar = mysqli_real_escape_string($mysqli, $_POST['stoc_bar']);
  $jumlah_beli = mysqli_real_escape_string($mysqli, $_POST['jumlah_beli']);
  $tanggal_beli = mysqli_real_escape_string($mysqli, $_POST['tanggal_beli']);
  // checking empty fields
	if(empty($nama_bar) || empty($harga_jual) || empty($stoc_bar) || empty($jumlah_beli) || empty($tanggal_beli)) {

		if(empty($nama_bar)) {
			echo "<font color='red'>Kode field is empty.</font><br/>";
		}

		if(empty($harga_jual)) {
			echo "<font color='red'>Nama field is empty.</font><br/>";
		}

		if(empty($stoc_bar)) {
			echo "<font color='red'>stoc field is empty.</font><br/>";
		}

    if(empty($jumlah_beli)) {
      echo "<font color='red'>Jumlah_beli field is empty.</font><br/>";
    }

    if(empty($tanggal_beli)) {
      echo "<font color='red'>tanggal_beli field is empty.</font><br/>";
    }

	} else {
    $totalbayar=$harga_jual*$jumlah_beli;
    $updatestocbarang=$stoc_bar-$jumlah_beli;
    echo "<center>";
    echo "<a href=\"listbarang.php?\" onClick=\"return confirm('Total Yang Di Bayar Adalah: $totalbayar')\"> LIHAT TOTAL BAYAR</a>";
    echo "</center>";
		//updating the table
    $result1 = mysqli_query($mysqli, "INSERT INTO penjualan(id_barang,nama_barang,total_byr,tgl_beli,jumlah_beli) VALUES('$id','$nama_bar','$totalbayar','$tanggal_beli','$jumlah_beli');");
    $result2 = mysqli_query($mysqli, "UPDATE masterbarang SET masterbarang.stoc_bar='$updatestocbarang' WHERE masterbarang.id_bar=$id");
    if($result2 == FALSE){
				echo "<font color='red'>ends field is empty.</font><br/>".$mysqli->error;
			}
		//redirectig to the display page. In our case, it is index.php
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
		<h3>BELI BARANG HEROES GYM</h3>
		<h4>DRAMAGA BOGOR</h4>
		<a href="listbarang.php">Kembali ke Halaman Daftar Barang</a><br/> <br/>
	</center>

	<form name="form1" method="post" action="belibarang.php">
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
        <td>Jumlah Beli</td>
        <td><input type="text" name="jumlah_beli"></td>
      </tr>

      <tr>
        <td>Tanggal</td>
        <td><input type="date" name="tanggal_beli"></td>
      </tr>

      <tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Beli"></td>
			</tr>
		</table>
	</form>
</body>
</html>
