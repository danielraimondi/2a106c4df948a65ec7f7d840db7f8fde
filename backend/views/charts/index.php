
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\chart_Survey;

$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;






//los 3 productos mas comprados por ese cliente
//$client_opt_order = Yii::app()->db->createCommand()->
//                      select('client_id, prod_id, order')->
//                      from('survey')->
//                      where('client_id=1')->
//                      order('order DESC')->
//                      limit(3)->
//                      queryAll();          
                      
                      
 //los clientes que comprarn
 
 //$client_survey->select('client_id')->
 //                     from('survey')->
 //                     order('order DESC')->
 //                     queryAll();             
 //                     
//$client_survey = Yii::app()->db->createCommand()->


//$client_survey = Yii::t('app', 'survey')->db->createCommand()
//                    ->select('client_id,prod_id,order')
//                     ->from('survey')
//                    ->where('client_id=:1')
//                   ->group('order')
//                   ->query();
        
        
//$cID = Yii::app()->survey->client_id;

?>





<html>
  <head>
     
     
     <?php 
     
      $id = 1;
      //---op.2---------
  /*   $client_id = Yii::$app->db->createCommand(
                      'SELECT  `client_id` ,  `prod_id` ,  `order` 
                      FROM  `survey`
                      WHERE client_id=1
                      ORDER BY  `order` DESC 
                      LIMIT 3'
                      )->queryAll();
    */                  
//    
//     print_r( $client_id[0]);
//     echo "----";
//     print_r( $client_id[1]);
 //    echo "----";
 //    print_r( $client_id[2]);
//     $id = '1';


    $query = (new \yii\db\Query())
    ->select('client_id, prod_id, order')
    ->from('survey')
    ->orderBy(['order' => SORT_DESC,])
    ->limit(3);
    // Crea un commando
      $command = $query->createCommand();
      // Ejecuta el commando
      $rows = $command->queryAll(); //TRAE un array con los datos
      /*
      print_r( $rows);
       echo $rows[0]['prod_id'];
       echo $rows[1]['prod_id'];
       echo $rows[2]['prod_id'];
      */
      // Imprime resultados
      
      /*---op.1
     foreach ($query->each() as $usuario) {
     $usuario representa una fila de datos de la tabla usuario
     print_r( $usuario);
     }*/
     
     //---op.2
     //      print_r( $rows[0]);
     
     
    ?>
    
      
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['ID productos', 'Sales'],
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

    <!--Div that will hold the bar chart-->
    <div id="columnchart_material" style="width: 450px; height: 250px;"></div>
  </body>
</html>

<!--
 <script>
            
                 

                            var valores = eval('.$rows[0].');

                            var e   = valores[0];
                            var f   = valores[1];
                            var m   = valores[2];
                           
                    
                    
                
    </script>
    
    -->