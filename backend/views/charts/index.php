
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\Survey;
$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;
?>


<br>

<?php 

$items = array();
foreach($tops as $top) {
 $rows[] = $top;
}

?>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script>
 
 
    //  CARGAR grafica
                            google.load("visualization", "1.1", {packages:["bar"]});
                            google.setOnLoadCallback(drawChart1);
                            function drawChart1() {
                              
                              var data = google.visualization.arrayToDataTable([
                                ['ID productos', 'Compras'],
                                ['<?php echo $rows[0]['prod_id']."  (".$rows[0]['survey_date'].")"?>', <?php echo $rows[0]['order']?>],
                                ['<?php echo $rows[1]['prod_id']."  (".$rows[1]['survey_date'].")"?>', <?php echo $rows[1]['order']?>],
                                ['<?php echo $rows[2]['prod_id']."  (".$rows[2]['survey_date'].")"?>', <?php echo $rows[2]['order']?>],
                                ['<?php echo $rows[3]['prod_id']."  (".$rows[3]['survey_date'].")"?>', <?php echo $rows[3]['order']?>],
                                ['<?php echo $rows[4]['prod_id']."  (".$rows[4]['survey_date'].")"?>', <?php echo $rows[4]['order']?>],
                               
                                
                              ]);
                              var options = {
                                chart: {
                                  title: ' Las 5 mayores ventas',
                                  subtitle: 'Top 5',
                                }
                              };
                              var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                              chart.draw(data, options);
                            }
                       
    </script>

    
  </head>

   <body>


    <!--Div that will hold the bar chart-->
    <div id="columnchart_material" style="width: 600px; height: 300px;"></div>
    
  </body>
</html>

