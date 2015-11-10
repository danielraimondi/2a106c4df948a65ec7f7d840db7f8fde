
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\Survey;
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
  

    $client = 1;//------------------------debe cargarlo-------------------------
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
    
    //SI el cliente solo compró 1 artículo, carga en cero los otros 2 espacios del array
    if (empty($rows[1])){
      $rows[1]['client_id']=$client;
      $rows[1]['prod_id']=0;
      $rows[1]['order']=0;
    }
    if (empty($rows[2])){
      $rows[2]['client_id']=$client;
      $rows[2]['prod_id']=0;
      $rows[2]['order']=0;
    }
    
    
    print_r( $client  );   
   
     //-----------------------------------------------------
  
   ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script>
    
    function mostrarResultados(res){
      var valores = res;
      console.log(valores);
  
  }
    
    //  CARGAR grafica
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
                           
    //-----------------------------------------------------  
                          
                          
  /* 
    $(document).ready(clientElegido(1));  
     function clientElegido(id_selected){
                    $.ajax({
                        type:'POST',
                        url:'/relevando/backend/controllers/ChartsController.php',
                        data:'id_selected='+id_selected,
                        success:function(data){
                          
                          var valores = eval(data);
                          
                          var a = valores[0];
                          
                
                        }
 
                    });
        
    }//FIN clienteElegido*/
        
     
    </script>

    
  </head>

   <body>

    <!--CAJA con los id de los Clientes que compraron-->
    <div>
            <i><b>Por favor, selecciona un cliente... </b></i>
           <!-- <select onChange="clientElegido(this.value);" >  -->
            <select onChange="mostrarResultados(this.value);" id="text">
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