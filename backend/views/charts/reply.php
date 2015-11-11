</<script type="text/javascript" >
// Load the Visualization API and the piechart package.
          google.load('visualization', '1.1', {'packages':['bar']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          function drawChart() {

            //DATA/CHART/OPTIONS  Trae las 5 COMPRAS más altas de todos los clientes
            var data = google.visualization.arrayToDataTable([
            ['ID productos', 'Productos'],
            ['<?php echo $tops[0]['client_id']."  (".$tops[0]['survey_date'].")"?>', <?php echo $tops[0]['order']?>],
            ['<?php echo $tops[1]['client_id']."  (".$tops[1]['survey_date'].")"?>', <?php echo $tops[1]['order']?>],
            ['<?php echo $tops[2]['client_id']."  (".$tops[2]['survey_date'].")"?>', <?php echo $tops[2]['order']?>],
            ['<?php echo $tops[3]['client_id']."  (".$tops[3]['survey_date'].")"?>', <?php echo $tops[3]['order']?>],
            ['<?php echo $tops[4]['client_id']."  (".$tops[4]['survey_date'].")"?>', <?php echo $tops[4]['order']?>],
            ]);
            
            
             //DATA2/CHART2/OPTIONS2 Trae las 5 CANTIDADES de COMPRAS más altas de todos los clientes o sea los que compraron más veces sin importar la cantidad de productos    
            var data2 = google.visualization.arrayToDataTable([
            ['Id Cliente', 'Compras'],
            ['<?php echo $cantPedidos[0]['client_id']?>', <?php echo $cantPedidos[0]['COUNT(client_id)']?>],
            ['<?php echo $cantPedidos[1]['client_id']?>', <?php echo $cantPedidos[1]['COUNT(client_id)']?>],
            ]);

           // Set chart options
           var options = {
                chart: {
                title: ' TOP 5 Compras',
                subtitle: 'las 5 COMPRAS más altas de todos los clientes',
                }
            };
            
            var options2 = {
                chart2: {
                title: ' TOP 5 COMPRAS por cliente',
                subtitle: 'Los clientes que compraron más veces sin importar la cantidad de productos.',
                }
            };
          
            // Instantiate and draw our chart, passing in some options.
          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
          var chart2 = new google.charts.Bar(document.getElementById('columnchart_compras'));
                              chart2.draw(data2, options);
                              
                              chart.draw(data, options);
           

          }
          
          </script>