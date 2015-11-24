$(document).ready(function() {
    $.ajax({
        url: "https://test-danielraimondi.c9.io/relevando/api/web/v1/product"
    }).then(function(data) {
       
       var p;
       
       $('#myTable').DataTable( {
            ajax: {
                url: 'https://test-danielraimondi.c9.io/relevando/api/web/v1/products',
                dataSrc: 'data'
            },
            
        } );
       
       for (p in data){
           
       		$('.greeting-id').append(data[p].prod_name+' ');
       		$('.greeting-content').append(data[p].cat_id+' ');
       		
       		
            
       }
       
       console.log(JSON.stringify(data));
    });
});