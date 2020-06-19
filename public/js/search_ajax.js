$(document).ready(function(){
  $('#upload').hide();
  $('#ajax_search').keyup(function (e) {
    e.preventDefault();
    $('#formSearch').submit();
  });
  $('#formSearch').on('submit',function(e){
    e.preventDefault();
    var form=$(this);
    var text=$('#ajax_search').val();
    $('#upload').show();
    //  alert(form.find('action');
    if ($.trim(text) !== '') {
      $.ajax({
        url: "https://127.0.0.1:8000/search-ajax",
        method:'POST',
        data:{search:text},
        dataType:'text',
        processData:false,
        contentType:false,
        cache:false,
        error:function(xhr){
          alert('Une erreur a été capturée '+xhr.status + " "+ xhr.statusText);
        },
        success: function(data){
          $('#upload').hide();
          $('#resultat').html(data);
        }
      });
    }else {
      $('#upload').hide();
      $('#resultat').html('');
    }
  });

});
