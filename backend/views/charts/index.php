
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\Survey;
$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 

//MOSTRAR contenido de la matriz
function recorro($tops1){
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
} 

//recorro($tops1);

print_r ( $cli);

?>

<html>
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        
        <script type="text/javascript">

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
                ["<?php echo "Id: ".$cli_sleccionado[0]['prod_id']."  (".$cli_sleccionado[0]['survey_date'].")"?>", <?php echo $cli_sleccionado[0]['order']?>, "#008B45"],
                ["<?php echo "Id: ".$cli_sleccionado[1]['prod_id']."  (".$cli_sleccionado[1]['survey_date'].")"?>", <?php echo $cli_sleccionado[1]['order']?>, "#00CD66"],
                ["<?php echo "Id: ".$cli_sleccionado[2]['prod_id']."  (".$cli_sleccionado[2]['survey_date'].")"?>", <?php echo $cli_sleccionado[2]['order']?>, "#00EE76"],
                ["<?php echo "Id: ".$cli_sleccionado[3]['prod_id']."  (".$cli_sleccionado[3]['survey_date'].")"?>", <?php echo $cli_sleccionado[3]['order']?>, "#4EEE94"],
                ["<?php echo "Id: ".$cli_sleccionado[4]['prod_id']."  (".$cli_sleccionado[4]['survey_date'].")"?>", <?php echo $cli_sleccionado[4]['order']?>, "#98FB98"]
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
  
   
// **********ENVIO DE SELECCION DEL DROPDOWN****************

        //ENVIANDO mediante un formulario oculto
      
        $("list").change(function(){ // Here we listen for a click on a link within the <li>
        alert("The paragraph was clicked.");
            var selectedValue = $(this).html(); // Put the value of the link into a variable
            $("#someValue").val(selectedValue);
            $("#someForm").submit();
            return false;
        });
              
          
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
               <!--Form oculta -->
                <form id="someForm" method="post" action="/ChartsController.php">
                    <input type="hidden" id="someValue" name="someValue">
                </form>
                <!-- DROPDOWN-->
                <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Id
                        <span class="caret"></span>
                        </button>
                      
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="list">
                           <?php
                            foreach($tot_cli as $key) {
                                echo '<li value="'.$key['client_id'].'"><a  href="#">'.$key['client_id'].'</a></li>';
                            }
                            ?>
                        </ul> <i><b>...Por favor, selecciona un cliente. </b></i>
                </div> <!--finDropDown -->
                <form name="formulario" method="post" action="../controllers/ChartsController.php">
                        Id: <input type="text" name="i" value="">
                        <input type="submit" />
                </form>
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
    
