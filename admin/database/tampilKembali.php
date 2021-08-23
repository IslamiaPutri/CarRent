<?php
	$sql = "SELECT sewa.id_sewa, penyewa.nama_penyewa AS Penyewa, mobil.no_polisi AS No_Polisi, mobil.merek AS Merek , sewa.tgl_sewa , bayar.status_bayar FROM sewa , penyewa ,mobil , bayar WHERE bayar.id_sewa = sewa.id_sewa AND sewa.id_mobil = mobil.id_mobil AND sewa.id_penyewa = penyewa.id_penyewa AND status_bayar = 'Lunas' and sewa.id_sewa NOT IN(SELECT id_sewa from pengembalian)";
	$rsSewa = mysqli_query($kon, $sql) Or die ("error");
?>
<div class="col-md-10 col-md-offset-1">
<table class='table table-striped table-hover'>
    	<thead bgcolor='#d9edf7'>
	    	<tr>
	    		<th>Id Sewa</th>
	    		<th>Penyewa</th>
	    		<th>No Polisi</th>
	    		<th>Merek</th>
	    		<th>Tanggal Sewa</th>
	    		<th>Satus Bayar</th>
	    		<th>Kembalikan</th>
	    	</tr>
    	</thead>
    	<tbody bgcolor='#fff'>
<?php
	while($rs = $rsSewa->fetch_array(MYSQLI_ASSOC)) {
?>
		<tr>
			<td><?php echo $rs['id_sewa']?></td>
			<td><?php echo $rs["Penyewa"]?></td>
			<td><?php echo $rs["No_Polisi"]?></td>
			<td><?php echo $rs["Merek"]?></td>
			<td><?php echo $rs["tgl_sewa"]?></td>
			<td><?php echo $rs["status_bayar"]?></td>
			<td><a onClick="return Kembalikan('<?php echo $rs["Penyewa"]?>', '<?php echo $rs["Merek"]?>','<?php echo $rs["No_Polisi"]?>','kembali<?php echo $rs["id_sewa"]?>')" href="database/kembali.php?id_sewa=<?php echo $rs['id_sewa']?>" id="kembali<?php echo $rs['id_sewa']?>">Kembalikan</a></td>
		</tr>
<?php
	}
?>
		</tbody>
	</table>
</div>
