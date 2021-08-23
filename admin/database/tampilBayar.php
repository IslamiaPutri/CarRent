<?php
	$result = $kon->query("select bayar.bukti,sewa.id_sewa AS id_sewa, id_bayar, tgl_bayar, status_bayar,penyewa.nama_penyewa as penyewa, mobil.merek as merek,mobil.no_polisi AS no_pol, bayar.total_bayar from sewa, bayar, mobil, penyewa where sewa.id_sewa = bayar.id_sewa AND mobil.id_mobil=sewa.id_mobil AND penyewa.id_penyewa = sewa.id_penyewa");
?>
	<table class='table table-striped table-hover'>
    	<thead bgcolor='#d9edf7'>
	    	<tr>
	    		<th>No</th>
				<th>Bukti Pembayaran</th>
	    		<th>Nama Penyewa</th>
	    		<th>Merek Mobil</th>
	    		<th>No Polisi</th>
	    		<th>Status Bayar</th>
	    		<th>Tanggal Bayar</th>
	    		<th>Total Bayar</th>
	    	</tr>
    	</thead>
    	<tbody bgcolor='#fff'>
<?php
	$no=1;
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
?>
		<tr>
			<td><?php echo $no?></td>
			<td>
				<img src="../assets/bukti/<?=$rs['bukti']?>" alt="" width="300px">
			</td>
			<td><?php echo $rs["penyewa"]?></td>
			<td><?php echo $rs["merek"]?></td>
			<td><?php echo $rs["no_pol"]?></td>
			<td><?php echo $rs["status_bayar"]?></td>
			<td><?php echo $rs["tgl_bayar"]?></td>
			<td><?php echo $rs["total_bayar"]?></td>
		</tr>
<?php
	$no++;
	}
?>
		</tbody>
	</table>
