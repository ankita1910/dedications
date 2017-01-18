(function(){
	var myApp = angular
	.module("myApp", [])
	.controller("myController", function($scope, $http, $window){
		$http.get("http://dedications:81/dedications/insite/api/giftcards")
		.then(function(response){
			$scope.jsonData = response.data;
			console.log($scope.jsonData);
		});

		$scope.categoryNameArray = [];
		$scope.setFilter = function (categoryName){

					//returns -1 if the element is not present in the array
					if ($.inArray(categoryName, $scope.categoryNameArray) > -1) {
			        	//splice adds or remove the items in the array passed
			        	$scope.categoryNameArray.splice($.inArray(categoryName, $scope.categoryNameArray), 1);
			        } else {
			        	$scope.categoryNameArray.push(categoryName);
			        }
			    }

			    //returns category name for filter
			    $scope.categoryName = function(giftcard) {
			    	if ($scope.categoryNameArray.length > 0) {
			    		if ($.inArray(giftcard.giftcard_cat_name, $scope.categoryNameArray) < 0)
			    			return;
			    	}
			    	return giftcard.giftcard_cat_name;
			    }

			    $scope.goToEditPage = function(categoryName, subCategoryName){
			    	console.log(subCategoryName);
			    	$window.location.href = "../insite/editGiftcard.php?cname=" + categoryName + "&cat=" + subCategoryName;
			    }

			    $scope.editPage = function(giftcard_id){
			    	$window.location.href = "../insite/editGiftcard.php?giftcard_id=" + giftcard_id;
			    }
			});
})();

$(document).on('ready', function() {
			$('.trending-showcase').slick({
				autoplay: true,
				dots:true,
				arrows:true,
				slidesToShow:1,
				slidesToScroll:1,
				responsive: [{ 
					breakpoint: 500,
					settings: {
						dots: false,
						arrows: false,
						infinite: false,
						slidesToShow: 1,
						slidesToScroll: 1
					} 
				}]
			});
		});