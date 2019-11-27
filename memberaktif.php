<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecate
$waktu1=time();
$waktusekarang=date('Y-m-d', $waktu1);
$result = mysqli_query($mysqli, "SELECT * FROM pelanggan, member WHERE pelanggan.id_pel = member.id_pelanggan AND member.ends>='$waktusekarang' ORDER BY member.ends ASC"); // using mysqli_query instead
?>

<html>
<head>
	<title>Member Aktif</title>
</head>

<body>
	<table width='100%' align=center border=0>

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
		<td>harga</td>
		<td>Alamat</td>
		<td>Edit/Delete</td>
	</tr>
	<?php
  echo "<center>";
  echo "<h2> DAFTAR MEMBER AKTIF HEROES GYM</h2>";
  echo "<a href=index.php>Kembali ke Halaman Utama</a><br/><br/>";
  echo "Waktu Sekarang <b>$waktusekarang</b>";
  echo "</center>";
	$no=1;
	while($res = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>".$no++."</td>";
		echo "<td>".$res['kode_pel']."</td>";
		echo "<td>".$res['nama_pel']."</td>";
		echo "<td>".$res['jk']."</td>";
		echo "<td>".$res['telp']."</td>";
		echo "<td>".$res['status_pel']."</td>";
		echo "<td>".$res['start']."</td>";
		echo "<td>".$res['ends']."</td>";
    $target= strtotime($res['ends']);
    $month=date('m', $target);
    $day=date('d', $target);
    $year=date('Y', $target);
    $days =(int)((mktime(0,0,0,$month,$day,$year)-time())/86400);
    echo "<td>$days<a> hari</a></td>";
		echo "<td>".$res['harga']."</td>";
		echo "<td>".$res['alamat']."</td>";
		echo "<td><a href=\"edit.php?id=$res[id_pel]\">Edit</a> | <a href=\"delete.php?id=$res[id_pel]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
	}
	?>
	</table>
</body>
</html>
