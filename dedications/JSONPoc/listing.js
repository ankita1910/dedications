var myApp = angular
			.module("myApp", [])
			.controller("myController", function($scope, $http){
				$http.get("listing.json")
				.then(function(response){
					$scope.jsonData = response.data;
				});
				$scope.getColor = getColor;

				$scope.setFilter = function (categoryName){
					$scope.categoryName = {category:categoryName};

				}
			});

			function getColor(){
				colorDetails = ['red', 'blue', 'black','orange', 'yellow'];
				var minNumber = 0; 
				var maxNumber = 4;
				var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber);
				return(colorDetails[randomnumber]);
			}