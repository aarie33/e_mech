<h3>Data Teknisi</h3>
<table class="table table-bordered table-hover" id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jkel</th>
            <th>No Telp</th>
            <th>Keahlian</th>
            <th>Kode Ver</th>
            <th>Rating</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($rows as $row) { 
			$sql_keahlian = "SELECT*FROM ahli a INNER JOIN keahlian k ON a.no_keahlian = k.no_keahlian WHERE a.id_teknisi = '$row->id_teknisi' AND a.status = 1";
			$query_keahlian = $this->db->query($sql_keahlian);
			$data_keahlian = $query_keahlian->result();
			//$data_keahlian = $this->admin(keahlianTeknisi($row->id_teknisi));
		?>
        <tr>
            <td><?php echo $row->id_teknisi;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->email;?></td>
            <td><?php echo $row->jkel;?></td>
            <td><?php echo $row->telp;?></td>
            <td><?php 
					foreach ($data_keahlian as $baris){ echo "[".$baris->keahlian."] "; }
			?></td>
            <td><?php if($row->kode_ver<>"")echo '<b class="text-primary">'.$row->kode_ver.'</b>';?></td>
            <td><?php echo $row->rating;?></td>
            <td><?php echo $row->status;?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
$(function(){
	$('.btnKonfirmasi').click(function(){
		$('#id_teknisi').val($(this).attr('id_teknisi'));
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('admin/ajaxFormKonfTeknisi/'); ?>",
			//dataType: 'json',
			data: {id_teknisi: $(this).attr('id_teknisi')},
			success: function(data) {
				$('#resultFormKonf').html(data);
			}
		});
	});
});
</script>