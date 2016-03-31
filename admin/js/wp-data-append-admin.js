angular
	.module('wpDataAppendSettings', [])
		.controller('SettingsController', function($scope){
			$scope.formMaps = [];

			$scope.addFormMap = function(){
				$scope.formMaps.push({});
			};
		})

		.controller('FormToAppendController', ['$scope','$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike){
			$scope.gfFormObject = null;
			$scope.formFields = null;

			$scope.getFormFields = function() {
				if(!$scope.formId) return;

				$scope.formFields = null;

				var req = {
					 method: 'POST',
					 url: dataAppendAdmin.ajaxUrl,
					 data: $httpParamSerializerJQLike({ 'action': 'get_gf_form_object', 'form_id': $scope.formId }),
					 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}

				$http(req).then(function(response){
					$scope.formFields = response.data.fields;
				});
			};

		}]);