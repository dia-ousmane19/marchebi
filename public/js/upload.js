$(document).ready(function(){
  $('#button_image').hide();
  $('#button_valider').hide();
  $('#button_suivant').on('click',function(e){
    e.preventDefault();
    $('#button_image').fadeIn('slow');
  });
  $('#button_add_image').on('change',function(e){
    e.preventDefault();
    $('#form').submit();
  });
  $('#form').on('submit',function(e){
      e.preventDefault();
    //  var form=$(this);
    alert('ok');
      $('#result').html('chargement...');
      $.ajax({
        url:"https://127.0.0.1:8000/annonces/new",
        type:"POST",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        success:function(data){
          alert('ok');
        }

      });


  });




});
