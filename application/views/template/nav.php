<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
		<!-- Menu button for smallar screens -->
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.html" class="navbar-brand">CMS fauzanolshop.com</a>
		</div>
		<!-- Navigation starts -->
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">     
			<!-- Links -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">            
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<img src="" alt="" class="nav-user-pic img-responsive" />administrator <b class="caret"></b>  
					</a>
					<!-- Dropdown menu -->
					<ul class="dropdown-menu">
					<li><a href=<?php echo base_url('index.php/gantipass');?>><i class="fa fa-user"></i>Ganti Pass</a></li>
					<li><a href=<?php echo base_url('index.php/logout');?>><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
</div><!-- /#top -->

<div id="content">
	<div class="sidebar">
			<div class="sidebar-dropdown"><a href="#">Navigation</a></div>
			<div class="sidebar-inner"
				
	<!-- #menu -->
	<ul class="navi">
	<li class="nred current"><a href="<?php echo base_url('index.php/home');?>"><i class="fa fa-desktop"></i> Dashboard</a></li>
	  <li class='ngreen'><a href="<?php echo base_url('index.php/adminkategori');?>">Kategori Produk</a></li>
	  <li class='ngreen'><a href="<?php echo base_url('index.php/adminproduk');?>">Produk</a></li>
	  <li class='ngreen'><a href=<?php echo base_url('index.php/admincustomer');?>>Customer</a></li>
	  <li class='ngreen'><a href="<?php echo base_url('index.php/adminuser');?>">User</a></li>
	  <li class='ngreen'><a href="<?php echo base_url('index.php/penjualan');?>">Penjualan</a></li>
	<!--  <li class='ngreen'><a href="<?php echo base_url('index.php/laporan');?>">Laporan</a></li>-->
	  </ul><!-- /#menu -->
  </div><!-- /#sidebar -->
  </div>
</div>
	  
<div class="mainbar">
	<div id="content">
		<div class="outer" class="hidden-print">
		  <div class="inner"  class="hidden-print">
		  <div class="col-lg-12"  class="hidden-print">
