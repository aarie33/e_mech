<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php 
			$notifAll = $notifTek + $notifCust; 
			if($notifAll>0){
				echo "(".$notifAll.")";
			}
		?>
		Administrator E-Mech
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<style>
	.navbar-custom {
		background-color:#dd2c00;
		color:#FFF;
		border-radius:0;
	}
	.navbar-custom .navbar-nav > li > a {
		color:#FFF;
	}
	.navbar-custom .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus, #side-menu li .active
	{
		background-color:#a30000;
		color: #FFF;
	}
		  
	.navbar-custom .navbar-nav > li > a:hover, .nav > li > a:focus {
		text-decoration: none;
		background-color: #a30000;
	}
		  
	.navbar-custom .navbar-brand {
		color:#FFF;
	}
	.navbar-custom .navbar-toggle {
		background:#dd2c00;
	}
	.navbar-custom .icon-bar {
		background:#FFF;
	}
	</style>

    <script>
    var jlh_notifTekn = null;
    var jlh_notifCust = null;
	var jlh_notifAll = null;
	var timeout_length = 10000;
      document.addEventListener('DOMContentLoaded', function () {
      if (!Notification) {
        alert('Desktop notifications not available in your browser. Try Chromium.'); 
        return;
      }

      if (Notification.permission !== "granted")
        Notification.requestPermission();
    });

    function showNotifTekn(jlh) {
      if (Notification.permission !== "granted")
        Notification.requestPermission();
      else {
          var notification = new Notification('Notifikasi Teknisi', {
            icon: 'https://assets.materialup.com/uploads/c8f04d47-fc5d-40f5-8e70-6910ddd06a6d/preview',
            body: jlh + " Notifikasi kode SMS baru untuk Teknisi",
          });

          notification.onclick = function () {
            window.focus();
            window.close();
            window.open("<?php echo site_url('admin/bukaHalamanTeknisiSMS');?>");
            notification.close();
          };
      }
    }

    function showNotifCust(jlh) {
      if (Notification.permission !== "granted")
        Notification.requestPermission();
      else {
          var notification = new Notification('Notifikasi Customer', {
            icon: 'https://assets.materialup.com/uploads/c8f04d47-fc5d-40f5-8e70-6910ddd06a6d/preview',
            body: jlh + " Notifikasi kode SMS baru untuk Customer",
          });

          notification.onclick = function () {
            window.focus();
            window.close();
            window.open("<?php echo site_url('admin/bukaHalamanCustomerSMS');?>");      
            notification.close();
          };
      }
    }

    function getNotifTekn(){
      $.ajax({
        url:'<?php echo site_url('admin/getNotificationTekn');?>',
        success:
          function (data){
            if(jlh_notifTekn == null){
              jlh_notifTekn = data;
              getNotifAll();
            }else{
              if(data>jlh_notifTekn){
				  getNotifAll();
				  showNotifTekn(data);
				  jlh_notifTekn = data;
				  document.getElementById('notifTekn').innerHTML = '<span class="label label-primary">'+data+'</span>';
				  <?php 
				  if(isset($smsmenu_teknisi)){ ?>
						location.reload();
				  <?php
				  }
				  ?>
              }else if(data<jlh_notifTekn){
				  getNotifAll();
				  if(data == 0){
					  //$('#notif').hide();
					  $('#notifTekn').hide();
				  }else{
					  document.getElementById('notifTekn').innerHTML = '<span class="label label-primary">'+data+'</span>';
				  }
				  <?php 
				  if(isset($smsmenu_teknisi)){ ?>
						location.reload();
				  <?php
				  }
				  ?>
				  jlh_notifTekn = data;
              }else{
				  jlh_notifTekn = data;
			  }
            }
            setTimeout(function(){
              getNotifTekn();
            }, timeout_length);
          }
      });
    }

    function getNotifCust(){
      $.ajax({
        url:'<?php echo site_url('admin/getNotificationCust');?>',
        success:
          function (data){
            if(jlh_notifCust == null){
              jlh_notifCust = data;
              getNotifAll();
            }else{
              if(data>jlh_notifCust){
				  getNotifAll();
				  showNotifCust(data);
				  jlh_notifCust = data;
				  document.getElementById('notifCust').innerHTML = '<span class="label label-primary">'+data+'</span>';
				  <?php 
				  if(isset($smsmenu_cust)){ ?>
						location.reload();
				  <?php
				  }
				  ?>
              }else if(data<jlh_notifCust){
				  getNotifAll();
				  if(data == 0){
					  //$('#notif').hide();
					  $('#notifCust').hide();
				  }else{
					  document.getElementById('notifCust').innerHTML = '<span class="label label-primary">'+data+'</span>';
				  }
				  <?php 
				  if(isset($smsmenu_cust)){ ?>
						location.reload();
				  <?php
				  }
				  ?>
				  jlh_notifCust = data;
              }else{
                jlh_notifCust = data;
              }
            }
            setTimeout(function(){
              getNotifCust();
            }, timeout_length);
          }
      });
    }
		
	function getNotifAll(){
      $.ajax({
        url:'<?php echo site_url('admin/getNotificationAll');?>',
        success:
          function (data){
            if(jlh_notifAll == null){
              jlh_notifAll = data;
            }else{
              if(data>jlh_notifAll){
				  jlh_notifAll = data;
				  document.getElementById('notif').innerHTML = '<span class="label label-primary">'+data+'</span>';
				  document.title = '(' + data + ') Administrator E-Mech';
              }else if(data<jlh_notifAll){
				  if(data == 0){
					  $('#notif').hide();
				  }else{
					  document.getElementById('notif').innerHTML = '<span class="label label-primary">'+data+'</span>';
					  document.title = '(' + data + ') Administrator E-Mech';
				  }
				  jlh_notifAll = data;
              }else{
				  jlh_notifAll = data;
			  }
            }
          }
      });
    }

    $(function(){
		getNotifTekn();
		getNotifCust();
		getNotifAll();
    });
  </script>

</head>
<body>
<nav class="navbar navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="#">Administrator E-Mech</a>
    </div>
    <div class="navbar-collapse collapse">
	    <ul class="nav navbar-nav">
          <li <?php if(isset($konfTeknisi)){ echo 'class="active"';}?>><a href="<?php echo site_url('admin/bukaHalamanKonfTeknisi');?>">Teknisi Baru</a></li>
          <li <?php if(isset($teknisi)){ echo 'class="active"';}?>><a href="<?php echo site_url('admin/bukaHalamanTeknisi');?>">Teknisi</a></li>
          <li <?php if(isset($customer)){ echo 'class="active"';}?>><a href="<?php echo site_url('admin/bukaHalamanCustomer');?>">Customer</a></li>
          <li class="dropdown <?php if(isset($smsmenu_teknisi) or isset($smsmenu_cust)){ echo 'active';}?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Kode SMS 
				<span id="notif">
					 <?php 
					  if($notifAll>0){
						echo '<span class="label label-primary">'.$notifAll.'</span>';
						} ?>
             	</span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li>
                <a href="<?php echo site_url('admin/bukaHalamanTeknisiSMS');?>">
                  SMS Teknisi
					<span id="notifTekn">
                  		<?php if($notifTek>0){echo '<span class="label label-primary">'.$notifTek.'</span>';} ?>
					</span>
                </a>
                <a href="<?php echo site_url('admin/bukaHalamanCustomerSMS');?>">
                  SMS Customer 
					<span id="notifCust">
               			<?php if($notifCust>0){echo '<span class="label label-primary">'.$notifCust.'</span>';} ?>
					</span>
                </a>
            </li>
                </ul>
          </li>
	    </ul>
        <ul class="nav navbar-nav navbar-right">
	      <li><a href="<?php echo site_url('admin/logout');?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
	    </ul>
	</div>
  </div>
</nav>
<div class="container">