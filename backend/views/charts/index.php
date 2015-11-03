<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Charts');
$this->params['breadcrumbs'][] = $this->title;

?>
<!DOCTYPE html>
<html>
    
    <!--relevando/backend/web/plugins/chartjs/Chart.js-->
     <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    
    <head> 
        
    </head>
    <body>
        <h2>Cantidad de Empresas según su prioridad</h2>
        
        <!--<div class="caja">
            <select onChange="mostrarResultados(this.value);">
                <?php
                    for ($i=1;$i<7;$i++){
                        echo '<option value="'.$i.'" selectad>'.$i.'</option>';
                    }
                ?>
            </select>
        </div>-->
        <div class="resultados">
            <canvas id="grafico">mostrarResultados();</canvas>
        </div>

    </body>
    <script>
            $(document).ready(mostrarResultados());  
                function mostrarResultados(prioridad){
                    $.ajax({
                        type:'POST',
                        url:'controllers/ChartsController.php',
                        data:'prioridad='+prioridad,
                        success:function(data){

                            var valores = eval(data);

                            var p1   = valores[0];
                            var p2   = valores[1];
                            var p3  = valores[2];
                            var p4   = valores[3];
                            var p5  = valores[4];
                            var p6   = valores[5];
                            var p7  = valores[6];
                            var p8  = valores[7];
                            var p9  = valores[8];
                            var p10  = valores[9];

                                
                            var Datos = {
                                    labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                                    datasets : [
                                        {
                                            fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [p1,p2,p3,p4,p5,p6,p7,p8,p9,p10]
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
</html>
