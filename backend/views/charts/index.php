
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;

?>

<html>
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        
        <script type="text/javascript">
        
// **********ENVIO DE SELECCION DEL DROPDOWN****************        //devuelve un array con los pedidos del cliente


//+++++++++  CHART 3, TOP COMPRAS CLIENTE   +++++++++++++++++++++++++++++++++++++++++++++++++++
          var surveys=<?php echo json_encode($surveys) ?> ;
          
          
          //Inicializo la funcion CON EL 1er cliente 
          var id_seleccionado = <?php echo $tot_cli[0]['client_id'] ?>; 
          var cliente = buscarCliente(id_seleccionado);
          cliente_cero (cliente); 
           
                    function buscarCliente(idCliente){
                      
                        var pedidosCliente=[];
                        for (s in surveys)
                            if (surveys[s].client_id==idCliente)
                                pedidosCliente.push(surveys[s]);
                     
                        return pedidosCliente;
                    }
                    
        //id_seleccionado se actualiza segun el id elegido
                    function mostrarResultados(idCliente){
                        
                        cliente = buscarCliente(idCliente);
                        cliente_cero (cliente);
                        drawChart();
                        
                    }
       //cargar el resto del array con 0
            function cliente_cero (cliente){
                while (cliente.length <5){
                    cliente[cliente.length]= "";
                    
                }
                
            }
       
 //+++++++++  CHART 4, PORCENTAJE RELEVADOR   +++++++++++++++++++++++++++++++++++++++++++++++++++
 
       
        
         var tot_cli_para_visitar=<?php echo json_encode($tot_cli_para_visitar) ?> ; //pendientes
         var tot_cli_ya_visitaron=<?php echo json_encode($tot_cli_ya_visitaron) ?> ; //realizados
         
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
             }
                
                 var id_selec_relevador = <?php echo $tot_usu[0]['user_id'] ?>; 
                 //console.log(id_selec_relevador);
                 var relevador = buscarRelevador(id_selec_relevador);
                 //console.log(relevador[0]);console.log(relevador[1]);
                var realizado = (relevador[0]['COUNT(client_id)'] * 100) / relevador[1]['COUNT(client_id)'];
                var pendiente = 100 - realizado;
                
           function mostrarResultadosRel(idrelevador){
                relevador = buscarRelevador(idrelevador);
                realizado = (relevador[0]['COUNT(client_id)'] * 100) / relevador[1]['COUNT(client_id)'];
                pendiente = 100 - realizado;
                
                drawChart()
            }
 

   

// ********************* FUNCION DE LAS GRAFICAS ******************************************************
          // Carga las visualizaciones
          google.load('visualization', '1.0', {'packages':['corechart']});
          google.load('visualization', '1.1', {'packages':['bar']});

         //Llama a drawChart
         google.setOnLoadCallback(drawChart);

          function drawChart() {
              
 //DATA/CHART/OPTIONS  Trae las 5 COMPRAS más altas de todos los clientes
               var data = google.visualization.arrayToDataTable([
                ["ID productos", "Productos", { role: "style" } ],
                ["<?php echo "Id: ".$tops[0]['client_id']."  (".$tops[0]['survey_date'].")"?>", <?php echo $tops[0]['order']?>, "#008B45"],
                ["<?php echo "Id: ".$tops[1]['client_id']."  (".$tops[1]['survey_date'].")"?>", <?php echo $tops[1]['order']?>, "#00CD66"],
                ["<?php echo "Id: ".$tops[2]['client_id']."  (".$tops[2]['survey_date'].")"?>", <?php echo $tops[2]['order']?>, "#00EE76"],
                ["<?php echo "Id: ".$tops[3]['client_id']."  (".$tops[3]['survey_date'].")"?>", <?php echo $tops[3]['order']?>, "#4EEE94"],
                ["<?php echo "Id: ".$tops[4]['client_id']."  (".$tops[4]['survey_date'].")"?>", <?php echo $tops[4]['order']?>, "#98FB98"]
              ]);
        
              var view = new google.visualization.DataView(data);
              view.setColumns([0, 1,
                               { calc: "stringify",
                                 sourceColumn: 1,
                                 type: "string",
                                 role: "annotation" },
                               2]);
    
              var options = {
                title: ' TOP 5 Compras más altas de todos los clientes',
                width: 900,
                height: 500,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
              };
              
              
              var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
                chart.draw(view, options); 
            
   //DATA2/CHART2/OPTIONS2  Trae las 5 COMPRAS más altas de todos los clientes
                   var data = google.visualization.arrayToDataTable([
                ["Id Cliente", "Compras", { role: "style" } ],
                ["<?php echo "Id: ".$cantPedidos[0]['client_id']?>", <?php echo $cantPedidos[0]['COUNT(client_id)']?>, "#8B6969"],
                ["<?php echo "Id: ".$cantPedidos[1]['client_id']?>", <?php echo $cantPedidos[1]['COUNT(client_id)']?>, "#CD9B9B"],
                ["<?php echo "Id: ".$cantPedidos[2]['client_id']?>", <?php echo $cantPedidos[2]['COUNT(client_id)']?>, "#EEB4B4"],
                ["<?php echo "Id: ".$cantPedidos[3]['client_id']?>", <?php echo $cantPedidos[3]['COUNT(client_id)']?>, "#FFC1C1"],
                ["<?php echo "Id: ".$cantPedidos[4]['client_id']?>", <?php echo $cantPedidos[4]['COUNT(client_id)']?>, "#FFD39B"]
               
              ]);
            
                  var view2 = new google.visualization.DataView(data);
                  view.setColumns([0, 1,
                                   { calc: "stringify",
                                     sourceColumn: 1,
                                     type: "string",
                                     role: "annotation" },
                                   2]);
        
                  var options2 = {
                    title: ' TOP 5 CLIENTES que han realizado más compras en los últimos 20 días',
                    width: 900,
                    height: 500,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  
                  
                  var chart2 = new google.visualization.BarChart(document.getElementById("chart_div2"));
                    chart2.draw(view2, options2); 
  
   //DATA/CHART3/OPTIONS3  Trae las 5 COMPRAS más altas el CLIENTE SELECCIONADO
  
             var data = google.visualization.arrayToDataTable([
                ["ID productos", "Cantidad", { role: "style" } ],
                ["Id: " + cliente[0]['prod_id'] + "  (" + cliente[0]['survey_date'] + ")", parseInt(cliente[0]['order']), "#5F9EA0"],
                ["Id: " + cliente[1]['prod_id'] + "  (" + cliente[1]['survey_date'] + ")", parseInt(cliente[1]['order']), "#48D1CC"],
                ["Id: " + cliente[2]['prod_id'] + "  (" + cliente[2]['survey_date'] + ")", parseInt(cliente[2]['order']), "#40E0D0"],
                ["Id: " + cliente[3]['prod_id'] + "  (" + cliente[3]['survey_date'] + ")", parseInt(cliente[3]['order']), "#AFEEEE"],
                ["Id: " + cliente[4]['prod_id'] + "  (" + cliente[4]['survey_date'] + ")", parseInt(cliente[4]['order']), "#E0FFFF"]
              ]);
            
                  var view3 = new google.visualization.DataView(data);
                  view.setColumns([0, 1,
                                   { calc: "stringify",
                                     sourceColumn: 1,
                                     type: "string",
                                     role: "annotation" },
                                   2]);
        
                  var options3 = {
                    title: ' TOP 5 COMPRAS realizadas por el cliente ',
                    width: 900,
                    height: 500,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  
                  
                  var chart3 = new google.visualization.BarChart(document.getElementById("chart_div3"));
                  chart3.draw(view3, options3); 
                  
                  
    //DATA/CHART4/OPTIONS4  Trae las 5 Relevadores que cumplieron con sus recorridos
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
        
    </head>

    <body>
 
         <div>

<!-- **********CARGANDO LAS cabezal de las PESTAÑAS***************-->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">TOP 5 compras</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">TOP 5 clientes</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">TOP 5 de c/cliente</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">% ruta realizada por revelador</a></li>
          </ul>

<!-- **********CONTENIDO de las PESTAÑAS***************-->  
        <div class="tab-content">
            
            <!-- TOP 5 compras -->
            <div role="tabpanel" class="tab-pane active" id="home">
                <br><center></centre><div id="chart_div" ></div></center><!--donde se carga la grafica-->
            </div>
            
            <!-- TOP 5 Clientes -->
            <div role="tabpanel" class="tab-pane" id="profile">
                 <br><center><div id="chart_div2" ></div></center> <!--donde se carga la grafica--> 
            </div>
            
            <!-- TOP 5  de c/cliente -->
           <div role="tabpanel" class="tab-pane" id="messages">    
               
                <!-- DROPDOWN-->
                <div class="dropdown" >
                       <br><i><b>...Por favor, selecciona un cliente. </b></i>
                            <select class="form-control" id="client" name="client" onChange="mostrarResultados(this.value);">
                                <?php
                                    foreach($tot_cli as $key) {
                                        echo '<option value="'.$key['client_id'].'">'.$key['client_id'].'</option>';
                                    }
                                ?>
                            </select>
                            
                      
                </div> <!--finDropDown -->
              
               
                <br><center><div id="chart_div3" ></div></center><!--donde se carga la grafica-->
               
                
            </div> 
        <!-- TOP 5  reveladores -->
            <div role="tabpanel" class="tab-pane" id="settings">
                              <div class="dropdown" >
                       <br><i><b>...Por favor, selecciona un relevador. </b></i>
                            <select class="form-control" id="relevador" name="relevador" onChange="mostrarResultadosRel(this.value);">
                                <?php
                                    foreach($tot_usu as $key) {
                                        if($key['id'] != 2){ //SACO EL ID 2 PORQUE ES EL ADMIN
                                        echo '<option value="'.$key['user_id'].'">'.$key['username'].'</option>';
                                        }
                                                 }
                                ?>
                            </select>
                            
                      
                </div> <!--finDropDown -->
                    <!--grafica-->
                    <br><center><div id="piechart" style="width: 900px; height: 500px;"></div><div id="chart_div4"></div></center><!--donde se carga la grafica-->
            </div>          
        </div><!--FIN de Tab content -->
        
    </body>
</html>
    
