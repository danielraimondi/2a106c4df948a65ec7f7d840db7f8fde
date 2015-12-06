
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Automatic Route');
$this->params['breadcrumbs'][] = $this->title;


//ruta_encontrada  es la matriz donde se encuentra el resultado de la busqueda llamada tras seleccionar el select y llamar a la funcion relevadorSelec()

?>

<html>
    <head>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&callback=initMap&libraries=places,drawing,geometry,directions"></script>
        <script type="text/javascript" >
        
        //Inicializo los valores
        var relv=<?php echo json_encode($tot_rel) ?> ; // relv =  $tot_rel
        var cli=<?php echo json_encode($tot_cli) ?> ; // cli =  $tot_cli
        
        var LatRelevador = 0; 
        var LngRelevador = 0; 
        var LatCliente = 0; 
        var LngCliente = 0; 
        var distancia = 0;
        var clientes_relevadores = null;
        var ruta_encontrada = [];
        var rel = [];
        var map;
        var directionDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        
        
        //BUSCA el relevador seleccionado del dropdown 
        function buscarRelevador(idRelevador){
                      
            var rel_encontrado=[];
            for (s in relv){
                if (relv[s].id==idRelevador){
                    rel_encontrado.push(relv[s]);
                }
            }
            return rel_encontrado;
        }
        
        //BUSCA TODOS los clientes en un radio
        function buscarClientes(LatRelevador,LngRelevador, RadioRelevador ){
                      
            var cli_encontrado=[];
            for (n in cli){
                
                LatCliente = (cli[n]['client_lat'] * Math.PI) / 180 ;  //se pasa a radianes
                LngCliente = (cli[n]['client_long'] * Math.PI) / 180 ;  //se pasa a radianes
                
                //Calculo de la distancia geografica en Km, entre dos puntos.
                distancia = 6378.137 * Math.acos( Math.cos( LatRelevador ) * Math.cos( LatCliente ) * Math.cos( LngCliente - LngRelevador ) + Math.sin( LatRelevador ) * Math.sin( LatCliente ) ); //en KM
                
                if (parseInt(distancia) < parseInt(RadioRelevador) ){ //si la distancia es menor al radio del Relevador PUSH
                   
                    cli_encontrado.push(cli[n]);
                    
                }
            }
            return cli_encontrado;
        }
        
       //TRAE y MUESTRA todos los clientes que entran en el radio del relevador id_rel del dropdwon
        function relevadorSelec(id_rel){
            rel = buscarRelevador(id_rel)
            
            LatRelevador = (rel[0]['user_lat'] * Math.PI) / 180 ;  //se pasa a radianes
            LngRelevador = (rel[0]['user_lng'] * Math.PI) / 180 ;  //se pasa a radianes
            RadioRelevador = rel[0]['user_radius'];
            
            // TODOS los clientes que entran en el radio del Relevador
            clientes_relevadores = buscarClientes(LatRelevador,LngRelevador, RadioRelevador ); 
           
           //***TODOS los clientes PRESENTES EN LA RUTA OPTIMA  -<<<<<<<<<<-----<<<<<<<<<<<-----<<<<<<<<<<<<<<<
           ruta_encontrada = ruta_optima(rel[0]['user_lat'], rel[0]['user_lng'], RadioRelevador, clientes_relevadores); 
          
      
           //CARGAR LA TABLA
            document.getElementById("myTable").innerHTML = "";//limpia el contenido
            var orden = 1;
            for (var item in ruta_encontrada) { //carga el contenido
                var table = document.getElementById("myTable");
                 console.log(table);
                
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                
                cell1.innerHTML = orden;
                cell2.innerHTML = ruta_encontrada[item]['client_name'];
                cell3.innerHTML = ruta_encontrada[item]['priority'];
                
                
                orden ++;
            };
           
           //CARGA EL MAPA
            initMap();
           
        }
        
      
        //MAPA
        function initMap() {
            var markers = [];
            var labels = '123456789';
            var ruta = [];
            
            var labelIndex = 0;
            var center = {lat: parseFloat(rel[0].user_lat), lng: parseFloat(rel[0].user_lng)}; //CENTRO MAPA EN EL RELEVADOR
          
            map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: center,
            strokeOpacity: 0,
            strokeColor: "#7d7d7d",
            mapTypeId: google.maps.MapTypeId.TERRAIN
            });
            
            directionDisplay.setMap(map);
         
            prev_infowindow = false;
            
            // MARKER RELEVADOR
                var markerIcon = {
                        url: "../images/streetview.ico",
                        size: new google.maps.Size(32, 32),
                        anchor: new google.maps.Point(16, 24),
                        scaledSize: new google.maps.Size(32, 32)
                    };
                
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(rel[0].user_lat), lng: parseFloat(rel[0].user_lng)},
                    animation:google.maps.Animation.BOUNCE,
                    map: map,
                    icon: markerIcon
                });
            
                markers.push(marker);
                
                ruta.push(new google.maps.LatLng(rel[0].user_lat, rel[0].user_lng ) );
            
            // MARKERS COMERCIOS
            if (ruta_encontrada[0] != undefined){ // SI tiene datos
                
                for (c in ruta_encontrada){
                    
                    var markerIcon = {
                                url: "../images/shop2.ico",
                                size: new google.maps.Size(32, 32),
                                anchor: new google.maps.Point(15, 25),
                                scaledSize: new google.maps.Size(32, 32)
                            };
                    
                    
                    var marker = new google.maps.Marker({
                        position: {lat: parseFloat(ruta_encontrada[c].client_lat), lng: parseFloat(ruta_encontrada[c].client_long)},
                        label: labels[labelIndex++ % labels.length ], //NUMERO las casitas :3
                        map: map,
                        icon: markerIcon
                    });
                    markers.push(marker);
                    
                    var content = 'ID: '+ruta_encontrada[c].client_id+'<br>Name: '+ruta_encontrada[c].client_name; 
                    
                    ruta.push(new google.maps.LatLng(ruta_encontrada[c].client_lat, ruta_encontrada[c].client_long));
            
                var infowindow = new google.maps.InfoWindow();
        
                 }//for

                     
            }
   
                
        //CIRULOS DEL RADIO        
                var cityCircle = new google.maps.Circle({
                    strokeColor: '#0000FF',
                      strokeOpacity: 0.5,
                      strokeWeight: 0.5,
                      fillColor: '#3366FF',
                      fillOpacity: 0.1,
                      map: map,
                      center: {lat: parseFloat(rel[0].user_lat), lng: parseFloat(rel[0].user_lng)},
                      radius: parseFloat(rel[0].user_radius)*1000
                    });
                    
                var content = 'ID: '+rel[0].id+'<br>Name: '+rel[0].username;     
            
         var infowindow = new google.maps.InfoWindow();
                
                
        //RUTA a seguir por Relevador        
        calculateAndDisplayRoute(directionsService, directionDisplay); //CARGO LAS DIRECCIONES
        
            
        }//initmap
        
        
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            
              var waypts = [];
              var checkboxArray = ruta_encontrada;  //CARGO los datos de la ruta encontrada
              
              for (var i = 0; i < (checkboxArray.length - 1); i++) {
                    waypts.push({
                    location: {lat: parseFloat(checkboxArray[i].client_lat), lng: parseFloat(checkboxArray[i].client_long)},
                     
                    stopover: true
                  });
              }
            
              directionsService.route({
                  
                origin: {lat: parseFloat(rel[0].user_lat), lng: parseFloat(rel[0].user_lng)}, //punto de ORIGEN
                destination: {                      //punto de FINAL
                    lat: parseFloat(ruta_encontrada[(ruta_encontrada.length - 1)].client_lat),   
                    lng: parseFloat(ruta_encontrada[(ruta_encontrada.length - 1)].client_long)    },
                
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode.DRIVING // WALKING  / BICYCLING 
              }, 
                function(response, status) {
                    
                        
                   
                if (status === google.maps.DirectionsStatus.OK) {
                    
                  directionsDisplay.setDirections(response);
                  
               
                } else {
                  window.alert('Directions request failed due to ' + status);
                }
                
                
                
                
              });
        }
        
        
       
        //BUSCA ruta más OPTIMA
        function ruta_optima (latRelevador, LngRelevador, radio_relevador, tot_clientes){
            
            var latInicial =latRelevador;
            var lngInicial =LngRelevador;
           
            distancia =  0;
            var resultado = [];
           
            while ( (resultado.length < 5) && (tot_clientes.length > 0) ) // Si no llegué a mi tope de 5 clientes O el total de clientes es vacio
            {
                var dist_minima = radio_relevador*2;
               
                for (key in tot_clientes){
                    
                    
                    console.log("CHEQUEO EL CLIENTE : "+tot_clientes[key]);
                    
                  
                    var LatCliente = tot_clientes[key]['client_lat'] ;  
                    var LngCliente = tot_clientes[key]['client_long'] ; 
                    
                    var x1=new google.maps.LatLng(latInicial,lngInicial);
                    var x2=new google.maps.LatLng(LatCliente,LngCliente);
                    
                    distancia = (google.maps.geometry.spherical.computeDistanceBetween(x1, x2) ) / 1000;
                  
                    if( distancia < dist_minima  ){ 
                        dist_minima = distancia; //Actualizo
                        var puntero_unset = key;
                    }
                    
                }//for
                
                resultado.push(tot_clientes[puntero_unset]);//GUARDO Cliente en Resultado
                
                latInicial = tot_clientes[puntero_unset]['client_lat']; //Actualizo el nuevo punto inicial (El cliente seleccionado)
                lngInicial = tot_clientes[puntero_unset]['client_long']; //Actualizo el nuevo punto inicial (El cliente seleccionado)
                
                tot_clientes.splice(puntero_unset, 1); //ELIMINO el cliente que me sirvió de tot_clientes
                
            }//while
            console.log("****pasé el WHILE******");
            console.log("TOTAL FINAL: "+tot_clientes.length);
            return resultado;
            
        }//ruta_optima
        
        
        function sleep(milliseconds) {
          var start = new Date().getTime();
          for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds){
              break;
            }
          }
        }
        
        function crearRuta(){
            
            var fechaCompleta = new Date();
			var	fecha = fechaCompleta.getFullYear()+'-'+(fechaCompleta.getMonth()+1)+'-'+fechaCompleta.getDate();
            
            for (r in ruta_encontrada){
                
                $.ajax({
			                url: "https://test-danielraimondi.c9.io/relevando/api/web/v1/route",
			                type: 'POST',
			                dataType: 'json',
			                data: {
			                	route_date: fecha,
			                	user_id: document.getElementById("relev").value,
			                	client_id: ruta_encontrada[r].client_id
			                },
			                
			                success: function(result) {
			                	console.log("OK");
			                }
			                
                    	}); //ajax
                    	
                    	sleep(200);
                    	
            }
            alert("Ruta Asignada");
        }
       
     
        
   </script>
     
    </head>

    <body>
     
       <!-- DROPDOWN-->
         <br><div class="row" >
             <div class="col-md-8">
                 <i><b>...Por favor, selecciona un Relevador. </b></i>
                            <select class="form-control" id="relev" name="relev" onChange="relevadorSelec(this.value);" >
                                <?php
                                    foreach($tot_rel as $key) {
                                        if($key['id'] != 2){ //SACO EL ID 2 PORQUE ES EL ADMIN
                                        echo '<option value="'.$key['id'].'">'.$key['username'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
             </div>
             <div class="col-md-4">
                       
                   <br> <button type="button" class="btn btn-success glyphicon glyphicon-floppy-saved" onclick ="crearRuta()">   Assign</button>
             </div>
                           
        </div> <!--finDropDown -->
        <br>
        <!-- TABLA con los clientes -->
        <div class="row ">
              <div class="col-md-8">
                  <table class="table table-striped" id="Table">
                    <thead>
                      <tr class="success" >
                        <th class="col-md-2">#</th>
                        <th class="col-md-4">Client Name</th>
                        <th class="col-md-2">Prioridad</th>
                      </tr>
                    </thead>
                </table>
              </div>
        </div>
         
        <div class="row">
              <div class="col-md-8">
                  <table class="table table-striped" id="myTable"></table> <!--  Donde carga los clientes-->
              </div>
        </div>
        
        <div class="client-map">

   
<div id="map" style="height:350px; width:800PX;"></div>

</div>

  
        
    </body>
</html>
    
