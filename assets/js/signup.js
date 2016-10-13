function signup(){
  var country=$("input[name='country']").val();
  var login=$("input[name='login']").val();
  var password=$("input[name='userpass1']").val();
  var clubname=$("input[name='clubname']").val();
  if(country!='BR'){

  }else{
    if(country=='' || login=='' || password=='' || clubname==''){

    }else{
      $.ajax({
        url: 'controllers/_register.php',
        type: 'POST',
        dataType: 'json',
        data: {lng:$("input[name='lng']").val(),lat:$("input[name='lat']").val(), country: $("input[name='country']").val(),refeer: $("input[name='refeer']").val(),login: $("input[name='login']").val(), password:$("input[name='userpass1']").val(),clubname:$("input[name='clubname']").val()},
        beforeSend: function(data){

        },
        success: function(data){
          console.log(data);
          if(typeof data.error != 'undefined'){

          }else{

          }
        },
        error: function(data){
          console.log(data);

        }
      });
    }
  }
}
var map;
