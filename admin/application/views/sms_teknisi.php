<h3>Data SMS Teknisi</h3>
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
            <th>SMS status</th>
            <th>Tindakan</th>
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
            <td><?php echo $row->sms_status;?></td>
            <td align="center">
            <?php if($row->sms_status == 0){ ?>
            	<a href="#" data-toggle="modal" data-target="#modal_konfirmasi" class="btn btn-xs btn-success btnKonfirmasi" onClick="konfirmSMS(<?php echo $row->id_teknisi;?>)"><span class="glyphicon glyphicon-envelope"></span> Konfirmasi</a>
            <?php }else{ ?>
            	SMS kode telah terkirim
            <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="modal_konfirmasi" tabindex="-1" role="dialog" aria-labelledby="LabelModalEdit">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<form method="post" action="<?php echo site_url('admin/updateSMSTeknisi');?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="LabelModalTambah">Konfirmasi Teknisi</h4>
            </div>
            <div class="modal-body">
            	<div class="container">
					Admin telah mengirimkan SMS kode ke Teknisi ?
                    <input type="hidden" name="id_teknisi" id="id_teknisi" />
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> Konfirmasi SMS</button>
            </div>
            </form>
		</div>
	</div>
</div>

<script>
function konfirmSMS(id){
	document.getElementById('id_teknisi').value = id;
}
</script>