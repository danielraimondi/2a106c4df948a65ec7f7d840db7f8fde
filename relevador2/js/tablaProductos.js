$(document).ready(function(){
  $('#cmdEnter').on("click", null, function() {  
      $.ajax({ // ajax call starts
          url: '/relevando/api/web/v1/products', // JQuery loads serverside.php
          data: 'Proucto=' + $('#txtProd').val(), // Send value of text
          dataType: 'json', // Choosing a JSON datatype
          success: function(data) // Variable data contains the data we get from serverside
          {
			  var html='';
			  // si la consulta ajax devuelve datos
			  if(data.length > 0){
                  $.each(data, function(i,item){
					  html += '<tr>'
                            html += '<td>'+item.prod_id+'</td>'
                            html += '<td>'+item.prod_name+'</td>'
                            html += '<td>'+item.cat_id+'</td>'
                            html += '<td>'+item.prod_pic+'</td>'
                        html += '</tr>';
				    });
              } 
			  // si no hay datos mostramos mensaje de no encontraron registros
                if(html == '') html = '<tr><td colspan="6">No se encontraron productos..</td></tr>'
                // añadimos  a nuestra tabla todos los datos encontrados mediante la funcion html
                $("#tableProductos tbody").html(html);  
         }           
      });
      return false; // keeps the page from not refreshing 
  });
})