report = '';
$('.ban').on('click',function(){
  if(confirm('Você tem certeza?')){
    ban(this);
  }
})

function ban(){
  var id_report = $('#id_reported').val();
  $.ajax({
    url : '../../admin/ban',
    method: 'POST',
    dataType: 'JSON',
    data : {id_club:id_report, id_report:report},
    success : function(response){
      notification('Usuário Banido!','danger');
      $('.modal-close').trigger('click');
      $('label[report="'+report+'"]').closest('tr').remove();
    },
    error : function(response){
      console.log(response);
    }
  });
}

$('.shield').on('click',function(){
  if(confirm('Você tem certeza?')){
    shield(this);
  }
})

function shield(){
  var id_report = $('#id_reported').val();
  $.ajax({
    url : '../../admin/shield',
    method: 'POST',
    dataType: 'JSON',
    data : {id_club:id_report, id_report:report},
    success : function(response){
      notification('Escudo retirado!','danger');
      $('.modal-close').trigger('click');
      $('label[report="'+report+'"]').closest('tr').remove();
    },
    error : function(response){
      console.log(response);
    }
  });
}

$('.money').on('click',function(){
  if(confirm('Você tem certeza?')){
    money(this);
  }
})

function money(){
  var id_report = $('#id_reported').val();
  $.ajax({
    url : '../../admin/money',
    method: 'POST',
    dataType: 'JSON',
    data : {id_club:id_report, id_report:report},
    success : function(response){
      notification('Multa aplicada!','danger');
      $('.modal-close').trigger('click');
      $('label[report="'+report+'"]').closest('tr').remove();
    },
    error : function(response){
      console.log(response);
    }
  });
}

function getReport(label){
  report = $(label).attr('report');
  $.ajax({
    url : '../../helpers/ajax/admin.report.php',
    method: 'POST',
    dataType: 'JSON',
    data : {id_report:report},
    success : function(response){
      console.log(response);
      console.log(response.data);
      $('#club').val(response.data[0].club);
      $('#reported').val(response.data[0].club_reported);
      $('#id_club').val(response.data[0].id_club);
      $('#id_reported').val(response.data[0].id_club_reported);
      $('#reason').val(response.data[0].reason);
      $('#desc').val(response.data[0].description);
    },
    error : function(response){
      console.log(response);
    }
  });
}
