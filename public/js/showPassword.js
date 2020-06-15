$(document).ready(function() {
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

});
