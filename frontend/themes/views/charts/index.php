<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;


$id = Yii::$app->user->identity->id;

echo ($tot_rutas_asignadas);


?>

<html>
    <head>
        
    </head>

    <body>
        
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">% ruta realizada por revelador</a></li>
            <li role="presentation"><a href="#historical" aria-controls="historical" role="tab" data-toggle="tab">Histórico rutas</a></li>
          </ul>

<!-- **********CONTENIDO de las PESTAÑAS***************-->  
        <div class="tab-content">
            
            <!-- TOP 5 compras -->
            <div role="tabpanel" class="tab-pane active" id="home">
                <br><center><div id="piechart" style="width: 900px; height: 500px;"></div><div id="chart_div4"></div></center><!--donde se carga la grafica-->
            </div>
            <div role="tabpanel" class="tab-pane" id="historical">
              
               <!-- TABLA con las RUTAS asignadas -->
            <div class="row ">
              <div class="col-md-8">
                  <table class="table table-striped" id="Table">
                    <thead>
                      <tr class="success" >
                        <th class="col-md-2">Id Route</th>
                        <th class="col-md-6">Route Date</th>
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
        
            </div>
        
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        
        <script type="text/javascript">
        
 

//+++++++++  PORCENTAJE RELEVADOR   +++++++++++++++++++++++++++++++++++++++++++++++++++
 
       
        
         var tot_cli_para_visitar=<?php echo json_encode($tot_cli_para_visitar) ?> ; //pendientes
         var tot_cli_ya_visitaron=<?php echo json_encode($tot_cli_ya_visitaron) ?> ; //realizados
        
        
         var realizado = null;
         var pendiente = null;
             function buscarRelevador(idrelevador){
                        
                        var relevador_info=[];
                        
                        for (s in tot_cli_ya_visitaron){
                            if (tot_cli_ya_visitaron[s].user_id==idrelevador){
                                relevador_info.push(tot_cli_ya_visitaron[s]);
                              
                                
                                for (n in tot_cli_para_visitar){
                                    if (tot_cli_para_visitar[n].user_id==idrelevador){
                                        relevador_info.push(tot_cli_para_visitar[n]);
                                     
                                    }    
                                }
                            }    
                        }
                        
                        return relevador_info;
             } //FIN buscar relevador
                
                // cargo el relevador con los datos de las rutas
                var relevador = buscarRelevador(<?=$id?>);
               
                //Verificación de existencia
                
                //Realizó algun relevo?
                if (relevador[0] != undefined){ //SI TIENE clientes para ser asignados (clientes_relevadores no es vacio)
                    realizado = (relevador[0]['COUNT(client_id)'] * 100) / relevador[1]['COUNT(client_id)'];
                }else{
                    realizado=0;
                }
               
               //Se le fue asignada alguna ruta?
                if (relevador[1] != undefined){ //SI TIENE clientes para ser asignados (clientes_relevadores no es vacio)
                   pendiente = 100 - realizado;
                }else{
                    pendiente = 0;
                }       
                
                
//+++++++++  TABLA RUTAS ASIGNADAS  +++++++++++++++++++++++++++++++++++++++++++++++++++

            var tot_rutas=<?php echo json_encode( $tot_rutas_asignadas) ?> ; //total rutas realizadas
      
            function buscarRutas(idrelevador){
                        var rutas_info=[];
                        
                        for (n in tot_rutas){
                            if (tot_rutas[n].user_id==idrelevador){
                                rutas_info.push(tot_rutas[n]);
                            }    
                        };
                        
                        return rutas_info;
            } //FIN buscar Rutas
            
           
            var tot_rutas_encontradas = buscarRutas(<?php echo $id?>);
       
      
          if (tot_rutas_encontradas[0] != undefined){
              for (var item in tot_rutas_encontradas) { //carga el contenido
                    var table = document.getElementById("myTable");
                    
                    console.log(tot_rutas_encontradas[item]);
                    
                    
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    cell1.innerHTML = tot_rutas_encontradas[item]['route_id'];
                    cell2.innerHTML = tot_rutas_encontradas[item]['route_date'];
                };
          }
             


// ********************* FUNCION DE LAS GRAFICAS ******************************************************
          // Carga las visualizaciones
          google.load('visualization', '1.0', {'packages':['corechart']});
          google.load('visualization', '1.1', {'packages':['bar']});

         //Llama a drawChart
         google.setOnLoadCallback(drawChart);

            function drawChart() {
              
                var data = google.visualization.arrayToDataTable([
                  ['Task', 'Porcentaje'],
                  ['Realizado ' ,  realizado ],
                  ['Pendiente',  pendiente]
                ]);
    
                var options4 = {
                  title: 'Porcentaje de rutas realizadas por el relevador',
                  width: 900,
                  height: 500
                };
    
                var chart4 = new google.visualization.PieChart(document.getElementById('piechart'));
                chart4.draw(data, options4);
      
            
                
            }//fin DRAWCHART
  
    
          
        </script>
        

    </body>
</html>
    
