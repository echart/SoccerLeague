$(document).ready(function(){
  var video = document.querySelector("video");
  video.addEventListener("ended", function(){
    video.play();
  });
  if(document.body.clientWidth >= 900) {
    $('video').attr('autoplay', true);
    $('video').attr('preload', 'auto');
  }
});

function expandLogin(){
  $('div.viewsign').removeClass('expanded');
  $('div.viewlogin').toggleClass('expanded');
}
function expandSignin(){
  $('div.viewlogin').removeClass('expanded');
  $('div.viewsign').toggleClass('expanded');
}
function login(){
  $.ajax({
      url: 'controllers/_login.php',
      method: 'POST',
      dataType: 'JSON',
      data: {login: $("input[name='userlogin']").val(), password:$("input[name='userpass']").val()},
      beforeSend: function(){
        $('.viewlogin .return').html('');
        $('.viewlogin button').html('Carregando');
      },
      success: function(data){
        $('.viewlogin button').html('Realizar login');
        if(data.return=='denied'){
        $('.viewlogin .return').html('<br>Parece que os dados apresentados não conferem, você não pode entrar no seu clube');
        }else{
          $('.viewlogin .return').html('Sucesso, redirecionando...');
          setTimeout(function(){
            location.reload();
          },1000);
        }
      },
      error: function(data){
        console.log(data.responseText);
        $('.viewlogin button').html('Realizar login');
        $('.viewlogin .return').html('');
      }
  });
}
function register(){
  if($('#country').data('ddslick').selectedData==null){
    $('.viewsign .return').html('Ainda há dados a serem preenchidos.');
  }
  $.ajax({
      url: 'controllers/_register.php',
      method: 'POST',
      dataType: 'json',
      data: {refeer: $("input[name='refeer']").val(),login: $("input[name='userlogin1']").val(), password:$("input[name='userpass1']").val(), rpassword:$("input[name='reuserpass1']").val(), clubname:$("input[name='clubname']").val(), country: $('#country').data('ddslick').selectedData.value},
      beforeSend: function(data){
        $('.viewsign .return').html('');
        $('.viewsign button').html('Carregando');
      },
      success: function(data){
        if(typeof data.error != 'undefined'){
          response=data.error.code;
          console.log(data);
        }else{
          response='Seja bem vindo ao SoccerLeague, seu clube ' + data.data.clubname + ' foi criado com sucesso e os seus jogadores o aguardam para a primeira conversa!';
          console.log(data);
        }
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html(response);
      },
      error: function(data){
        console.log(data);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html('Estamos enfrentando um problema com o cadastro, tente novamente daqui a pouco!');
      }
  });
}

$('#country').ddslick({
    data: countriesData,
    width: 285,
    imagePosition: "left",
    selectText: "Selecione um país para seu clube",
    onSelected: function (data) {
        console.log(data);
    }
});
