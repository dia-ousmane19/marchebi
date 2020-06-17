$(document).ready(function(){
  $('#button_image').hide();
  $('#terminer').hide();
  $('#button_valider').hide();
    $('#loader').hide();
  $('#button_suivant').on('click',function(e){
    e.preventDefault();
    $('#button_image').fadeIn('slow');
  });

  $('#annonces_images').on('change',function(e){
    e.preventDefault();
    $('#form').submit();
  });
  $('#form').on('submit',function(e){
    e.preventDefault();

    $('#loader').show();
    $.ajax({
      url: "https://127.0.0.1:8000/annonces/new",
      method:"POST",
      data:new FormData(this),

      processData:false,
      contentType:false,
      cache:false,
      success:function(data){
          $('#resultat').html(data);
            $('#loader').hide();
            $('#button_add_image').attr('disabled','true');
            $('#annonces_images').attr('disabled','true');
            $('#terminer').fadeIn('slow');
            $('#annuler').fadeOut('slow');

      }

    });


  });


});
