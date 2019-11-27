<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecate
$waktu1=time();
$waktusekarang=date('Y-m-d', $waktu1);
$result = mysqli_query($mysqli, "SELECT * FROM masterbarang WHERE masterbarang.id_bar ORDER BY masterbarang.id_bar ASC"); // using mysqli_query instead
?>

<html>
<head>
	<title>daftar barang</title>
</head>

<body>
	<table width='70%' align=center border=0>

	<tr bgcolor='#CCCCCC'>
		<td>No.</td>
		<td>Nama Barang</td>
		<td>Harga Jual</td>
		<td>Stock Barang</td>
    <td>Edit/Delete</td>
	</tr>
	<?php
  echo "<center>";
  echo "<h2> DAFTAR BARANG HEROES GYM</h2>";
  echo "<a href=index.php>Kembali ke Halaman Utama</a> &nbsp &nbsp <a href=tambahbarang.html>Tambah Barang</a><br/><br/>";
  echo "Waktu Sekarang <b>$waktusekarang</b>";
  echo "</center>";
	$no=1;
	while($res = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>".$no++."</td>";
		echo "<td>".$res['nama_bar']."</td>";
		echo "<td>".$res['harga_jual']."</td>";
		echo "<td>".$res['stoc_bar']."</td>";
		echo "<td><a href=\"editbarang.php?id=$res[id_bar]\">Edit</a> | <a href=\"deletebarang.php?id=$res[id_bar]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a> | <a href=\"belibarang.php?id=$res[id_bar]\">Beli</a></td>";
	}
	?>
	</table>
</body>
</html>
