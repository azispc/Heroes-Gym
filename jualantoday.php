<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecate
$waktu1=time();
$waktusekarang=date('Y-m-d', $waktu1);
$result = mysqli_query($mysqli, "SELECT * FROM penjualan WHERE penjualan.tgl_beli='$waktusekarang' ORDER BY penjualan.id_jual ASC"); // using mysqli_query instead
?>

<html>
<head>
	<title>Daftar Jual</title>
</head>

<body>
	<table width='70%' align=center border=0>

	<tr bgcolor='#CCCCCC'>
		<td>No.</td>
		<td>Nama Barang</td>
    <td>Tanggal Beli</td>
		<td>Jumlah Beli</td>
		<td>Total Bayar</td>
	</tr>
	<?php
  echo "<center>";
  echo "<h2> DAFTAR BARANG JUAL HARI INI HEROES GYM</h2>";
  echo "<a href=index.php>Kembali ke Halaman Utama</a> &nbsp &nbsp <a href=listbarang.php>Lihat Daftar Barang Jual</a><br/><br/>";
  echo "Waktu Sekarang <b>$waktusekarang</b>";
  echo "</center>";
	$no=1;
	while($res = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>".$no++."</td>";
		echo "<td>".$res['nama_barang']."</td>";
		echo "<td>".$res['tgl_beli']."</td>";
		echo "<td>".$res['jumlah_beli']."</td>";
    echo "<td>".$res['total_byr']."</td>";
}
	?>
	</table>
</body>
</html>
