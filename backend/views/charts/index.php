
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\chart_Survey;
$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;
?>





<html>
  <head>
     
     
     <?php 
     
     //Trae TODOS los clientes que realizaron alguna compra
    $total_cli = (new \yii\db\Query())
    ->select('client_id')
    ->distinct()
    ->from('survey');
     
    $command_total_cli = $total_cli->createCommand();
    $data = $command_total_cli->queryAll();
    $i = 0;
    //-----------------------------------------------------


     $client = 1;
     //Trae las 3 COMPRAS más altas de un cliente  $client
    $query = (new \yii\db\Query())
    ->select('client_id, prod_id, order')
    ->from('survey')
    ->where('client_id=:id', array(':id'=>$client))
    ->orderBy(['order' => SORT_DESC,])
    ->limit(3);
    // Crea un commando
      $command = $query->createCommand();
      // Ejecuta el commando
      $rows = $command->queryAll(); //TRAE un array con los datos

     //-----------------------------------------------------
     
    ?>
    
      
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['ID productos', 'Compras'],
          ['<?php echo $rows[0]['prod_id']?>', <?php echo $rows[0]['order']?>],
          ['<?php echo $rows[1]['prod_id']?>', <?php echo $rows[1]['order']?>],
          ['<?php echo $rows[2]['prod_id']?>', <?php echo $rows[2]['order']?>],
        
          
          
          
          
        ]);
        var options = {
          chart: {
            title: ' Client with ID <?php echo $rows[0]['client_id']?>',
            subtitle: 'TOP 3 compras',
          }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, options);
      }
     
    </script>
    
    
    
  </head>

  <body>
    
    <!--CAJA con los id de los Clientes que compraron-->
    <div>
            <i><b>Por favor, selecciona un cliente... </b></i>
           <!-- <select onChange="mostrarResultados(this.value);" >-->
            <select >
                <?php
                    foreach($data as $key) {
                        echo '<option value="'.$data[$i]['client_id'].'" selected>'.$data[$i]['client_id'].'</option>';
                        $i++; 
                    }
                    
                ?>
            </select>
        </div>


    <!--Div that will hold the bar chart-->
    <div id="columnchart_material" style="width: 450px; height: 250px;"></div>
  </body>
</html>
