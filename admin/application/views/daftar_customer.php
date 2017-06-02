<h3>Data Customer</h3>
<table class="table table-bordered table-hover" id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jkel</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Kode Ver</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row->id_customer;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->email;?></td>
            <td><?php echo $row->jkel;?></td>
            <td><?php echo $row->telp;?></td>
            <td><?php echo $row->alamat;?></td>
            <td><?php if($row->kode_ver<>"")echo '<b class="text-primary">'.$row->kode_ver.'</b>';?></td>
            <td><?php echo $row->rating;?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
