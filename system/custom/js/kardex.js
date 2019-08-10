$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./php_action/manageKardex.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./assets/images/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
        }
    })
}

function details(id){
    console.log(id);
    $.ajax({
        url:'./php_action/kardexDetails.php',
        data: 'id='+id,
        type: 'post',
         beforeSend: function(objeto){
         $('#load').html('<img src="./assets/images/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".data").html(data).fadeIn('slow');
            $('#load').html('');
            
        }
    })
}