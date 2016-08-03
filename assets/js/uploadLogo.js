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
				onAfterImgCrop:function(data){ console.log(data)},
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContaineroutput = new Croppic('logo', croppicContaineroutputMinimal);
});
