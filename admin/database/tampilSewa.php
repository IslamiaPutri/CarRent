<?php
	$sql = "SELECT sewa.id_sewa,penyewa.nama_penyewa ,mobil.merek ,mobil.no_polisi , sewa.tgl_sewa , sewa.tgl_kembali FROM sewa LEFT JOIN pengembalian ON sewa.id_sewa = pengembalian.id_sewa , penyewa , mobil WHERE pengembalian.id_sewa IS NULL AND sewa.id_penyewa = penyewa.id_penyewa AND sewa.id_mobil = mobil.id_mobil" ;
	$rsSewa = mysqli_query($kon, $sql) Or die ("error");
?>

<table class='table table-striped table-hover'>
    	<thead bgcolor='#d9edf7'>
	    	<tr>
	    		<th>Id Sewa</th>
	    		<th>Penyewa</th>
	    		<th>No Polisi</th>
	    		<th>Merek</th>
	    		<th>Tanggal Sewa</th>
				<th>Tanggal Kembali</th>
	    	</tr>
    	</thead>
    	<tbody bgcolor='#fff'>
<?php
	while($rs = $rsSewa->fetch_array(MYSQLI_ASSOC)) {
?>
		<tr>
			<td><?php echo $rs['id_sewa']?></td>
			<td><?php echo $rs["nama_penyewa"]?></td>
			<td><?php echo $rs["no_polisi"]?></td>
			<td><?php echo $rs["merek"]?></td>
			<td><?php echo $rs["tgl_sewa"]?></td>
			<td><?php echo $rs["tgl_kembali"]?></td>
		</tr>
<?php	
	}
?>
		</tbody>
	</table>