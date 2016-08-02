$('#logo').change(function(e){
  e.preventDefault();
  var formData = new FormData();
  formData.append('file', $('input[type=file]')[0].files[0]);
  $.ajax({
    url: "../../../club/1/logotemp/",
    type: "POST",
    data:  formData,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      console.log(data);
      $('#modal_crop').prop('checked',true);
      $('#logotemp').attr('src','../../../assets/img/logos/temp/'+data);
      $('#logotemp').Jcrop({maxSize:[200,200],minSize:[200,200]});
    },
    error: function(data){console.log(data);}
  });

});
