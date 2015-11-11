
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

// CONSULTAS que no llegan al mínimo

//SI cantidad total de compras es menor a 5 se cargan los restantes espacios con 0
$productos_top5 = count($tops);
while ($productos_top5  < 5){
    $i = $productos_top5 ++;
    $tops[$i]['client_id']=0;
    $tops[$i]['prod_id']=0;
    $tops[$i]['order']=0;
    $tops[$i]['survey_date']=0;
    
    $productos_top5 = count($tops);
}

//SI cantidad total de Clientes es menor a 5 se cargan los restantes espacios con 0

$compras_top5 = count($cantPedidos);
/*
while ($compras_top5  < 5){
    $i = $cant_top5 ++;
    $cantPedidos[$i]['client_id']=0;
    $cantPedidos[$i]['COUNT(client_id)']=0;

    $compras_top5 = count($cantPedidos);
}
*/
//-------------------------------



//print_r( $rows  );  


?>

<html>
      <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

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
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          
          
          var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
            chart.draw(view, options); 
            
   //-------------------------------------------
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
            title: ' TOP 5 CLIENTES que han realizado más compras',
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          
          
          var chart2 = new google.visualization.BarChart(document.getElementById("chart_div2"));
            chart2.draw(view2, options2); 
            
   //-------------------------------------------
   
   
   
   }
          
          
        </script>
      </head>

      <body>
         <!--Divs that will hold the charts-->
        <div id="chart_div"></div>
        <br>
        <div id="chart_div2"></div>
        <div id="chart_div3"></div>
    
      </body>
    </html>
    
