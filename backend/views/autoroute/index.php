
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Automatic Route');
$this->params['breadcrumbs'][] = $this->title;

?>

<html>
    <head>
        
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
            var rel = buscarRelevador(id_rel)
            
            LatRelevador = (rel[0]['user_lat'] * Math.PI) / 180 ;  //se pasa a radianes
            LngRelevador = (rel[0]['user_lng'] * Math.PI) / 180 ;  //se pasa a radianes
            RadioRelevador = rel[0]['user_radius'];
            
            // TODOS los clientes que entran en el radio del Relevador
            clientes_relevadores = buscarClientes(LatRelevador,LngRelevador, RadioRelevador ); 
           
           //***TODOS los clientes PRESENTES EN LA RUTA OPTIMA  -<<<<<<<<<<-----<<<<<<<<<<<-----<<<<<<<<<<<<<<<
           ruta_encontrada = ruta_optima(LatRelevador, LngRelevador, RadioRelevador, clientes_relevadores); 
           
           //CARGAR LA TABLA
            document.getElementById("myTable").innerHTML = "";//limpia el contenido
            
            for (var item in ruta_encontrada) { //carga el contenido
                var table = document.getElementById("myTable");
                 console.log(table);
                
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = ruta_encontrada[item]['client_name'];
                cell2.innerHTML = ruta_encontrada[item]['priority'];
            };
           
        }
        
        //BUSCA ruta más OPTIMA
        function ruta_optima (latRelevador, LngRelevador, radio_relevador, tot_clientes){
            
            console.log("entre a ruta_optima");
            
            var latInicial = latRelevador;
            var lngInicial = LngRelevador;
            
            distancia =  0.0000000000000000000;
            var resultado = [];
            var dist= [];
            
            console.log("TOTAL INICIAL: "+tot_clientes.length);
            
            
            
            while ( (resultado.length < 5) && (tot_clientes.length > 0) ) // Si no llegué a mi tope de 5 clientes O el total de clientes es vacio
            {
                
                var dist_minima = radio_relevador;
                for (key in tot_clientes){
                    
                    var LatCliente = (tot_clientes[key]['client_lat'] * Math.PI) / 180  //se pasa a radianes
                    var LngCliente = (tot_clientes[key]['client_long'] * Math.PI) / 180  //se pasa a radianes
                    
                    //Calculo de la distancia geografica en Km, entre dos puntos.
                    distancia = 6378.137 * Math.acos( Math.cos( latInicial ) * Math.cos( LatCliente ) * Math.cos( LngCliente - lngInicial ) + Math.sin( latInicial ) * Math.sin( LatCliente ) ); //en KM
                 
                    if( distancia < dist_minima){
                       
                        dist_minima = distancia; //Actualizo
                        puntero_unset = key;
                    }
                }//for
                
                resultado.push(tot_clientes[puntero_unset]);//GUARDO Cliente en Resultado
                
                tot_clientes.splice(puntero_unset, 1); //ELIMINO el cliente que me sirvió de tot_clientes
                
                latInicial = LatCliente; //Actualizo el nuevo punto inicial (El cliente seleccionado)
                lngInicial = LngCliente; //Actualizo el nuevo punto inicial (El cliente seleccionado)
                
                
            }//while
            console.log("****pasé el WHILE******");
            console.log("TOTAL FINAL: "+tot_clientes.length);
            return resultado;
            
        }//ruta_optima
        
        function crearRuta(){
            if (clientes_relevadores[0] != undefined){ //SI TIENE clientes para ser asignados (clientes_relevadores no es vacio)
                console.log("no esta vacio");
            }
            
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
                       
                   <br> <button type="button" class="btn btn-success glyphicon glyphicon-floppy-saved" onclick ="crearRuta();">   Assign</button>
             </div>
                           
        </div> <!--finDropDown -->
        <br>
        <!-- TABLA con los clientes -->
        <div class="row ">
              <div class="col-md-8">
                  <table class="table table-striped" id="Table">
                    <thead>
                      <tr class="success" >
                        <th class="col-md-6">Client Name</th>
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
        
        
          
            
        
        
                
        
        
    </body>
</html>
    
