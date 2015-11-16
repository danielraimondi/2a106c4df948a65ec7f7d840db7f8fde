
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;




?>

<?php 

//MOSTRAR contenido de la matriz
/*function recorro($tops1){
        foreach($tops1 as $key=>$value){
            if (is_array($value)){
                //si es un array sigo recorriendo
                
              echo 'key:'. $key;
              echo '<br>';
              $u=0;
             recorro($value);
          }else{  
               ${'x'.$key}[$u] = $value;
             //si es un elemento lo muestro
             echo $key.': '.$value ;
             echo '<br>';
             print_r ( ${'x'.$key});echo '<br>';echo '<br>';
             $u++;
          }
 
       }
} */



//recorro($tops1);

//print_r ( $surveys);

?>

<html>
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        
        <script type="text/javascript">
        
// **********ENVIO DE SELECCION DEL DROPDOWN****************        //devuelve un array con los pedidos del cliente
          var surveys=<?php echo json_encode($surveys) ?> ;
          
          //Inicializo la funcion CON EL 1er cliente 
          var id_seleccionado = <?php echo $tot_cli[0]['client_id'] ?>; 
          var cliente = buscarCliente(id_seleccionado);
          cliente_cero (cliente); 
           
                    function buscarCliente(idCliente){
                        
                        console.log("---entre a funcion buscarCliente: con el valor: "+idCliente);
                        
                        var pedidosCliente=[];
                        for (s in surveys)
                            if (surveys[s].client_id==idCliente)
                                pedidosCliente.push(surveys[s]);
                        
                       // console.log(JSON.stringify(pedidosCliente[0]['survey_date'] ));
                      
                        return pedidosCliente;
                    }
                    
        //id_seleccionado se actualiza segun el id elegido
                    function mostrarResultados(idCliente){
                        
                        cliente = buscarCliente(idCliente);
                        console.log(cliente.length)
                        cliente_cero (cliente);
                        drawChart();
                        
                    }
       //cargar el resto del array con 0
            function cliente_cero (cliente){
                while (cliente.length <5){
                    console.log("cliente_cero " + cliente.length);
                    cliente[cliente.length]= "";
                    
                }
                
            }
       
                    //var cliente = buscarCliente(1);
                    
                    //console.log(JSON.stringify(cliente));
   

// **********FUNCION DE LAS GRAFICAS****************
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
                    title: ' TOP 5 CLIENTES que han realizado más compras en los últimos 200 días',
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
                ["Id: " + cliente[0]['prod_id'] + "  (" + cliente[0]['survey_date'] + ")", parseInt(cliente[0]['order']), "#008B45"],
                ["Id: " + cliente[1]['prod_id'] + "  (" + cliente[1]['survey_date'] + ")", parseInt(cliente[1]['order']), "#00CD66"],
                ["Id: " + cliente[2]['prod_id'] + "  (" + cliente[2]['survey_date'] + ")", parseInt(cliente[2]['order']), "#00EE76"],
                ["Id: " + cliente[3]['prod_id'] + "  (" + cliente[3]['survey_date'] + ")", parseInt(cliente[3]['order']), "#4EEE94"],
                [( "Id: " + cliente[4]['prod_id'] + "  (" + cliente[4]['survey_date'] + ")" ).toString(), parseInt(cliente[4]['order']), "#98FB98"]
              ]);
            
                  var view3 = new google.visualization.DataView(data);
                  view.setColumns([0, 1,
                                   { calc: "stringify",
                                     sourceColumn: 1,
                                     type: "string",
                                     role: "annotation" },
                                   2]);
        
                  var options3 = {
                    title: ' TOP 5 COOMPRAS realizadas por el cliente <?php echo "Id: ".$cli ?>',
                    width: 900,
                    height: 500,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  
                  
                  var chart3 = new google.visualization.BarChart(document.getElementById("chart_div3"));
                  chart3.draw(view3, options3); 
                 

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
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">TOP 5 reveladores</a></li>
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
                <div class="dropdown">
                        <!--<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">-->
                        <!--    Id-->
                        <!--<span class="caret"></span>-->
                        <!--</button>-->
                      
                       <!-- <form method="post" action="charts/prueba"> -->
                            <select id="client" name="client" onChange="mostrarResultados(this.value);">
                                <?php
                                    foreach($tot_cli as $key) {
                                        echo '<option value="'.$key['client_id'].'">'.$key['client_id'].'</option>';
                                    }
                                ?>
                            </select>
                            <?php // echo Html::submitButton() ?>
                       <!-- </form> -->
                            
                        <!--<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="list">-->
                        <?php
                            
                            // foreach($tot_cli as $key) {
                            //     echo '<li value="'.$key['client_id'].'"><a  href="#">'.$key['client_id'].'</a></li>';
                            // }
                            
                            //foreach($tot_cli as $key) {
                            //    echo '<li><form method="POST" action="../controllers/ChartsController.php"><button type="submit" class="btn">'.$key['client_id'].'</button></form></li>';
                            //}
                            
                            ?>
                        </ul> <i><b>...Por favor, selecciona un cliente. </b></i>
                </div> <!--finDropDown -->
              
               
                <br><center><div id="chart_div3" ></div></center><!--donde se carga la grafica-->
               
                <!-- TOP 5  reveladores -->
                <div role="tabpanel" class="tab-pane" id="settings">
                               
                                <!--grafica-->
                    <div id="chart_div4"></div><!--donde se carga la grafica-->
                </div>
            </div> <!--FIN de Tab content -->
                        
        </div>
        
    </body>
</html>
    
