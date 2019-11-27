<?php
//including the database connection file
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM pelanggan, member WHERE pelanggan.id_pel = member.id_pelanggan ORDER BY member.ends  DESC"); // using mysqli_query instead
?>

<html>
<head>
	<title>Beranda</title>
</head>

<body>
	<center>
	<a href="add.html">Tambah Member Baru</a> &nbsp &nbsp <a href="memberhariini.php">Member Hari ini</a> &nbsp &nbsp <a href="memberaktif.php">Member Yang Aktif</a> &nbsp &nbsp<a href="memberhabishariini.php">Member Habis Hari ini</a> &nbsp &nbsp <a href="listbarang.php">Daftar Barang Jualan</a> &nbsp &nbsp <a href="penjualanhariini.php">Penjualan Hari Ini</a> <br/>
</center>

	<table width='100%' align=center border=1>
	<tr bgcolor='#CCCCCC'>
		<td>No.</td>
		<td>Kode Pelanggan</td>
		<td>Nama Pelanggan</td>
		<td>Jenis Kelamin</td>
		<td>Telpon</td>
		<td>Status</td>
		<td>Start Member (Y/M/D)</td>
		<td>End Member (Y/M/D)</td>
    <td>Sisa Member</td>
		<td>Harga</td>
		<td>Alamat</td>
		<td>Edit/Delete</td>
	</tr>
	<?php
  $wks=time();
  $waktu=date("D, d F Y",$wks);
	echo "<center>";
	echo "<h2> DAFTAR MEMBER HEROES GYM</h2>";
  echo "Sekarang <b>$waktu</b>";
	echo "</center>";
	$no=1;
	while($res = mysqli_fetch_array($result)) {
		$target= strtotime($res['ends']);
    $month=date('m', $target);
    $day=date('d', $target);
    $year=date('Y', $target);
    $days =(int)((mktime(0,0,0,$month,$day,$year)-time())/86400);
		if($days >=0){
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$res['kode_pel']."</td>";
			echo "<td>".$res['nama_pel']."</td>";
			echo "<td>".$res['jk']."</td>";
			echo "<td>".$res['telp']."</td>";
			echo "<td>".$res['status_pel']."</td>";
			echo "<td>".$res['start']."</td>";
			echo "<td>".$res['ends']."</td>";
			echo "<td>$days<a> hari</a></td>";
			echo "<td>".$res['harga']."</td>";
			echo "<td>".$res['alamat']."</td>";
			echo "<td><a href=\"edit.php?id=$res[id_pel]\">Edit</a> | <a href=\"delete.php?id=$res[id_pel]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		}else {
			echo "<tr>";
			echo "<td bgcolor='red'>".$no++."</td>";
			echo "<td bgcolor='red'>".$res['kode_pel']."</td>";
			echo "<td bgcolor='red'>".$res['nama_pel']."</td>";
			echo "<td bgcolor='red'>".$res['jk']."</td>";
			echo "<td bgcolor='red'>".$res['telp']."</td>";
			echo "<td bgcolor='red'>".$res['staus_pel']."</td>";
			echo "<td bgcolor='red'>".$res['start']."</td>";
			echo "<td bgcolor='red'>".$res['ends']."</td>";
			echo "<td bgcolor='red'>$days<a> hari</a></td>";
			echo "<td bgcolor='red'>".$res['harga']."</td>";
			echo "<td bgcolor='red'>".$res['alamat']."</td>";
			echo "<td><a href=\"edit.php?id=$res[id_pel]\">Edit</a> | <a href=\"delete.php?id=$res[id_pel]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

		}
	}
	?>
	</table>
</body>
</html>
