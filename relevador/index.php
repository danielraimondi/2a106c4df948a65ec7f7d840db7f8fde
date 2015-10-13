<!doctype html>

<?php

$array = array("Leche Conaprole", "Coca Cola", "Pasta de dientes Colgate", "Jugo de naranja Ades");
var_dump($array);
?>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<title>Relevando.com.uy</title> 
	<meta name="description" content="BlackTie.co - Free Handsome Bootstrap Themes" />	    
	<meta name="keywords" content="themes, bootstrap, free, templates, bootstrap 3, freebie,">
	<meta property="og:title" content="">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fancybox/jquery.fancybox-v=2.1.5.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/style.css">	
	
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600,300,200&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	
	<link rel="prefetch" href="images/zoom.png">
	
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet" media="screen">
 	
</head>

<body>
	<div class="navbar navbar-fixed-top" data-activeslide="1">
		<div class="container">
		
			<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			
			<div class="nav-collapse collapse navbar-responsive-collapse">
				<ul class="nav row">
					<li data-slide="1" class="col-12 col-sm-2"><a id="menu-link-1" href="#slide-1" title="Next Section"><span class="icon icon-home"></span> <span class="text">INICIO</span></a></li>
					<li data-slide="2" class="col-12 col-sm-2"><a id="menu-link-2" href="#slide-2" title="Next Section"><span class="icon icon-map-marker"></span> <span class="text">RUTAS</span></a></li>
					<li data-slide="3" class="col-12 col-sm-2"><a id="menu-link-3" href="#slide-3" title="Next Section"><span class="icon icon-briefcase"></span> <span class="text">STOCK</span></a></li>
					<li data-slide="4" class="col-12 col-sm-2"><a id="menu-link-4" href="#slide-4" title="Next Section"><span class="icon icon-barcode"></span> <span class="text">PEDIDOS</span></a></li>
					<li data-slide="5" class="col-12 col-sm-2"><a id="menu-link-4" href="#slide-4" title="Next Section"><span class="icon icon-signal"></span> <span class="text">ESTADO</span></a></li>
					<li data-slide="6" class="col-12 col-sm-2"><a id="menu-link-6" href="#slide-6" title="Next Section"><span class="icon icon-envelope"></span> <span class="text">CONTACTO</span></a></li>
				</ul>
				<div class="row">
					<div class="col-sm-2 active-menu"></div>
				</div>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->
	
	
	<!-- === Arrows === -->
	<div id="arrows">
		<div id="arrow-up" class="disabled"></div>
		<div id="arrow-down"></div>
		<div id="arrow-left" class="disabled visible-lg"></div>
		<div id="arrow-right" class="disabled visible-lg"></div>
	</div><!-- /.arrows -->
	
	
	<!-- === MAIN Background === -->
	<div class="slide story" id="slide-1" data-slide="1">
		<div class="container">
			<div id="home-row-1" class="row clearfix">
				<div class="col-12">
					<h1 class="font-semibold">Relevando.com.uy </h1>
					<h4 class="font-thin">Bienvenido a nuestra aplicación RELEVANDO.COM.UY <a class="font-semibold" href="#">acceso a usuarios</a> </h4>
					<br>
					<br>
				</div><!-- /col-12 -->
			</div><!-- /row -->
			<div id="home-row-2" class="row clearfix">
				<div class="col-12 col-sm-3"><div class="home-hover navigation-slide" data-slide="2"><img src="images/s01.png"></div><span>RUTAS</span></div>
				<div class="col-12 col-sm-3"><div class="home-hover navigation-slide" data-slide="3"><img src="images/s03.png"></div><span>STOCK</span></div>
				<div class="col-12 col-sm-3"><div class="home-hover navigation-slide" data-slide="4"><img src="images/s02.png"></div><span>PEDIDOS</span></div>
				<div class="col-12 col-sm-3"><div class="home-hover navigation-slide" data-slide="5"><img src="images/s04.png"></div><span>ESTADO</span></div>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /slide1 -->
	
	<!-- === Slide 2  rutas=== -->
	<div class="slide story" id="slide-2" data-slide="2">
		<div class="container">
			<div class="row title-row">
				<div class="col-12 font-thin">Mis Rutas</div>
			</div><!-- /row -->
			<div class="row line-row">
				<div class="hr">&nbsp;</div>
			</div><!-- /row -->
			<div align="center">
				 <div id="map-container" class="col-md-6"></div>
 				<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
				<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
				<!-- Include all compiled plugins (below), or include individual files as needed -->
				<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
				<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<script>	
			 
				  function init_map() {
					var var_location = new google.maps.LatLng(-34.87803902769132,-56.18609116819539);
					var var_mapoptions = {
					  center: var_location,
					  zoom: 12
					};
			 		var var_marker = new google.maps.Marker({
						position: var_location,
						map: var_map,
						title:"Montevideo"});
			 		var var_map = new google.maps.Map(document.getElementById("map-container"),
						var_mapoptions);
			 
					var_marker.setMap(var_map);	
				  }
				  google.maps.event.addDomListener(window, 'load', init_map);
				</script>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /slide2 -->
	
	<!-- === SLide 3 - stock -->
	<div class="slide story" id="slide-3" data-slide="3">
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p01-large.jpg"><img class="thumb" src="images/portfolio/p01-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p02-large.jpg"><img class="thumb" src="images/portfolio/p02-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p09-large.jpg"><img class="thumb" src="images/portfolio/p09-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p010-large.jpg"><img class="thumb" src="images/portfolio/p10-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p05-large.jpg"><img class="thumb" src="images/portfolio/p05-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p06-large.jpg"><img class="thumb" src="images/portfolio/p06-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p07-large.jpg"><img class="thumb" src="images/portfolio/p07-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p08-large.jpg"><img class="thumb" src="images/portfolio/p08-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p03-large.jpg"><img class="thumb" src="images/portfolio/p03-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p04-large.jpg"><img class="thumb" src="images/portfolio/p04-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p11-large.jpg"><img class="thumb" src="images/portfolio/p11-small.jpg" alt=""></a></div>
			<div class="col-12 col-sm-6 col-lg-2"><a data-fancybox-group="portfolio" class="fancybox" href="images/portfolio/p12-large.jpg"><img class="thumb" src="images/portfolio/p12-small.jpg" alt=""></a></div>
		</div><!-- /row -->
	</div><!-- /slide3 -->
	
	<!-- === Slide 4 - pedido === -->
	<div class="slide story" id="slide-4" data-slide="4">
		<div class="container">
			<div class="row title-row">
				<div class="col-12 font-thin">Realizar pedido</div>
			</div><!-- /row -->
			
			
			<div class="row content-row">
				
				<div class="panel panel-default">
					
				  <!-- Default panel contents -->
				  <div class="panel-heading">Tabla de productos</div>
				  <!-- Table -->
				 
				  <table class="table"  id="tablaPedidos">
					<tr>
						<th color="black">Producto</th>
						<th>Cantidad</th> 
					</tr>
					<tr>
						<td>Coca Cola Ligth</td>
						<td contenteditable='true'>50</td> 
					</tr>
					<tr>
						<td>Leche Conaprole</td>
						<td contenteditable='true'>94</td>
					</tr>
					<tr>
						<td>Pasta de dientes Colgate</td>
						<td contenteditable='true'>10</td>
					</tr>
					<tr>
						<td>Pan tortuga Pancatlan</td>
						<td contenteditable='true'>19</td> 
					</tr>
					<tr>
						<td>Jugo de naranja Ades</td>
						<td contenteditable='true'>148</td>
					</tr>
					<tr>
						<td>Agua mineral Matutina</td>
						<td contenteditable='true'>10</td>
					</tr>
				  </table>
				</div>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /slide4 -->
	
	<!-- === Slide 5 / ESTADO === -->
	<div class="slide story" id="slide-5" data-slide="5">
		<div class="container">
			<div class="row title-row">
				<div class="col-12 font-light">Estado de cumplimiento</div>
			</div><!-- /row -->
			<div class="row content-row">
				<div class="row subtitle-row">
					<div class="col-12 font-light">Total cumplido del <span class="font-semibold">negocio</span></div>
				</div><!-- /row -->
				<div class="progress">
				  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
					<span class="sr-only">40% Complete (success)</span>
				  </div>
				</div>
				<div class="row subtitle-row">
					<div class="col-12 font-light">Total cumplido del <span class="font-semibold">día</span></div>
				</div><!-- /row -->
				<div class="progress">
				  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
					<span class="sr-only">20% Complete</span>
				  </div>
				</div>
				<div class="row subtitle-row">
					<div class="col-12 font-light">Total cumplido del <span class="font-semibold">mes</span></div>
				</div><!-- /row -->
				<div class="progress">
				  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
					<span class="sr-only">45% Complete</span>
				  </div>
				</div>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /Slide 5 -->
	
	<!-- === Slide 6 / contacto === -->
	<div class="slide story" id="slide-6" data-slide="6">
		<div class="container">
			<div class="row title-row">
				<div class="col-12 font-light">Dejenos su <span class="font-semibold">mensaje</span></div>
			</div><!-- /row -->
			<div class="row line-row">
				<div class="hr">&nbsp;</div>
			</div><!-- /row -->
			<div class="row subtitle-row">
				<div class="col-sm-1 hidden-sm">&nbsp;</div>
				<div class="col-12 col-sm-10 font-light">Puede contactare con nosotros a través de culquiera de los siguientes enlaces</div>
				<div class="col-sm-1 hidden-sm">&nbsp;</div>
			</div><!-- /row -->
			<div id="contact-row-4" class="row">
				<div class="col-sm-1 hidden-sm">&nbsp;</div>
				<div class="col-12 col-sm-2 with-hover-text">
					<p><a target="_blank" href="#"><i class="icon icon-phone"></i></a></p>
					<span class="hover-text font-light ">+598 091.265.816</span></a>
				</div><!-- /col12 -->
				<div class="col-12 col-sm-2 with-hover-text">
					<p><a target="_blank" href="#"><i class="icon icon-envelope"></i></a></p>
					<span class="hover-text font-light ">info@relevando.com.uy</span></a>
				</div><!-- /col12 -->
				<div class="col-12 col-sm-2 with-hover-text">
					<p><a target="_blank" href="#"><i class="icon icon-home"></i></a></p>
					<span class="hover-text font-light ">Montevideo, Uruguay<br>código postal 11800</span></a>
				</div><!-- /col12 -->
				<div class="col-12 col-sm-2 with-hover-text">
					<p><a target="_blank" href="#"><i class="icon icon-facebook"></i></a></p>
					<span class="hover-text font-light ">facebook/relevando.com.uy</span></a>
				</div><!-- /col12 -->
				<div class="col-12 col-sm-2 with-hover-text">
					<p><a target="_blank" href="#"><i class="icon icon-twitter"></i></a></p>
					<span class="hover-text font-light ">@Relevando.com.uy</span></a>
				</div><!-- /col12 -->
				<div class="col-sm-1 hidden-sm">&nbsp;</div>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /Slide 6 -->
	
</body>

	<!-- SCRIPTS -->
	<script src="js/html5shiv.js"></script>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox.pack-v=2.1.5.js"></script>
	<script src="js/script.js"></script>
	<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii"
    });
</script> 
	
	<!-- fancybox init -->
	<script>
	$(document).ready(function(e) {
		var lis = $('.nav > li');
		menu_focus( lis[0], 1 );
		
		$(".fancybox").fancybox({
			padding: 10,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});
	
	});
	</script>

</html>