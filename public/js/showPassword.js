$(document).ready(function() {
  // show password connexion
  $('#iconShowPassword').on('click',function(e){
    e.preventDefault();
    var passwordValue=$('#inputPassword').val();
    var passwordType=$('#inputPassword').attr('type');
    if (passwordType == 'password') {
      $('#inputPassword').attr('type','text');
      $(this).html('<i class="fas fa-eye"></i>')

    }else {
      $('#inputPassword').attr('type','password');
      $(this).html('<i class="fas fa-eye-slash"></i>')
    }

  });
  // fin
  // show password inscription
  $('#iconShowPasswordInscription').on('click',function(e){
    e.preventDefault();
    var passwordValue=$('#registration_form_Password').val();
    var passwordType=$('#registration_form_Password').attr('type');
    if (passwordType == 'password') {
      $('#registration_form_Password').attr('type','text');
      $(this).html('<i class="fas fa-eye"></i>')

    }else {
      $('#registration_form_Password').attr('type','password');
      $(this).html('<i class="fas fa-eye-slash"></i>')
    }

  });


});
