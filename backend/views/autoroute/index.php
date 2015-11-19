
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
        
        
        function buscarClientes(LatRelevador,LngRelevador, RadioRelevador ){
                      
            var cli_encontrado=[];
            for (n in cli){
                
                LatCliente = (cli[n]['client_lat'] * Math.PI) / 180 ;  //se pasa a radianes
                LngCliente = (cli[n]['client_long'] * Math.PI) / 180 ;  //se pasa a radianes
                
                distancia = 6378.137 * Math.acos( Math.cos( LatRelevador ) * Math.cos( LatCliente ) * Math.cos( LngCliente - LngRelevador ) + Math.sin( LatRelevador ) * Math.sin( LatCliente ) ); //en KM
                
                if (parseInt(distancia) < parseInt(RadioRelevador) ){ //si la distancia es menor al radio del Relevador PUSH
                   
                    cli_encontrado.push(cli[n]);
                }
            }
            return cli_encontrado;
        }
        
       
       //TRAE todos los clientes que entran en el radio del relevador id_rel del dropdwon
        function relevadorSelec(id_rel){
            var rel = buscarRelevador(id_rel)
            
            LatRelevador = (rel[0]['user_lat'] * Math.PI) / 180 ;  //se pasa a radianes
            LngRelevador = (rel[0]['user_lng'] * Math.PI) / 180 ;  //se pasa a radianes
            RadioRelevador = rel[0]['user_radius'];
            
            var clientes_relevadores = buscarClientes(LatRelevador,LngRelevador, RadioRelevador ); //TODOS los clientes que entran en el radio del Relevador
            
            //CARGAR LA TABLA
            document.getElementById("myTable").innerHTML = "";//limpia el contenido
            
            for (var item in clientes_relevadores) { //carga el contenido
                var table = document.getElementById("myTable");
                
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = clientes_relevadores[item]['client_id'];
                cell2.innerHTML = clientes_relevadores[item]['priority'];
            };
            
           
        }
        
   </script>
       
    </head>

    <body>
     
       <!-- DROPDOWN-->
         <div class="dropdown" >
                       <br><i><b>...Por favor, selecciona un Relevador. </b></i>
                            <select class="form-control" id="relev" name="relev" onChange="relevadorSelec(this.value);" >
                                <?php
                                    foreach($tot_rel as $key) {
                                        if($key['id'] != 2){ //SACO EL ID 2 PORQUE ES EL ADMIN
                                        echo '<option value="'.$key['id'].'">'.$key['id'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                           
        </div> <!--finDropDown -->
        <br>
        <!-- TABLA con los clientes -->
        <div class="row ">
              <div class="col-md-8">
                  <table class="table table-striped" id="Table">
                    <thead>
                      <tr class="success" >
                        <th class="col-md-6">Id</th>
                        <th class="col-md-6">Prioridad</th>
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
    
