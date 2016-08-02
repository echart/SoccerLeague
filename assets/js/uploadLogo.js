// $('#logoupload').change(function(e){
//   // var formData = new FormData();
//   // formData.append('file', $('input[type=file]')[0].files[0]);
//   // $.ajax({
//   //   url: "../../../club/1/logotemp/",
//   //   type: "POST",
//   //   data:  formData,
//   //   contentType: false,
//   //   cache: false,
//   //   processData:false,
//   //   success: function(data){
//   //
//   //   },
//   //   error: function(data){console.log(data);}
//   // });
//
// });

$(document).ready(function(){
  var croppicContaineroutputMinimal = {
				uploadUrl:'logosave',
				cropUrl:'logotemp',
				modal:false,
				doubleZoomControls:false,
		    rotateControls: false,
        modal:true,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload')},
				onAfterImgUpload: function(){ console.log('onAfterImgUpload')},
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContaineroutput = new Croppic('logo', croppicContaineroutputMinimal);
});
