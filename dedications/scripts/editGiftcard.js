var x;

$(document).ready(function(){
	
	
});
function handleFiles(fileInput) {
	var files = fileInput.files;
	for (var i = 0; i < files.length; i++) {
		var file = files[i];
		var imageType = /image.*/;

		if (!file.type.match(imageType)) {
			continue;
		}

		var img = document.createElement("img");
		img.classList.add("obj");
		img.file = file;
		img.width=100;
		img.height=100;
		$(fileInput).after(img);

		var reader = new FileReader();
		reader.onload = (function(aImg) { 
			return function(e) { 
				aImg.src = e.target.result; 
			}; 
		})(img);
		reader.readAsDataURL(file);
	}    
}

(function(){
	var app = angular
	.module("uploadApp", [])
	.controller("uploadController", function($scope, $http){

		function gup(parameterName) {
     // var url = location.href;
     parameterName = parameterName.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
      //var regexS = "[\\?&]"+parameterName+"=([^&#]*)";
      var regex = new RegExp( "[\\?&]"+parameterName+"=([^&#]*)" );
      var results = regex.exec(location.href);
      return results == null ? null : results[1];
  }
  x = gup('giftcard_id');

  $scope.colors = ["#EF4444", "#FAA31B", "#82C341", "#FFF000", "#88C6ED", "#009F75", "#394BA0"
  			  , "red", "#D54799", "#A290D4", "#6DD0F2", "#F59ABE", "#00AAA0", "#FF7A5A", "#FFB85F"
  			  , "#462066"];

  $scope.model = {bgColor: "", user_id:""};

  var apiUrl = "http://dedications:81/dedications/insite/api/quotes_images/" + x;
  $http.get(apiUrl)
  .then(function(response){
  	$scope.jsonData = response.data;
  	console.log($scope.jsonData);
  });

  $scope.saveGiftcard = function(){
  	var request = $http({
  		method: "post",
  		url:"http://dedications:81/dedications/insite/api/user_giftcards",
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
  		data:
  			'user_id='+encodeURIComponent($scope.model.user_id)+
  			'&giftcard_id='+encodeURIComponent(x)+
  			'&bgcolor=' + encodeURIComponent($scope.model.bgColor)+
  			'&quote=' + encodeURIComponent($scope.message == null || $scope.message == "" ? $scope.selectedQuote : $scope.message)+
  			'&image=' + encodeURIComponent("google.com")+
  			'&status=' + encodeURIComponent(0)+
  			'&receiver_email=' + encodeURIComponent($scope.receiverEmail)+
  			'&receiver_phone=' + encodeURIComponent("rt")+
        '&sending_date=' + encodeURIComponent($scope.date)
  		
  	});
  	request.success(function (data) {
  		console.log(data);
  	});
  }
});

})();