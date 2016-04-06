angular
	.module('wpDataAppendSettings', [])

		.directive('ngReallyClick', [function() {
		    return {
		        restrict: 'A',
		        link: function(scope, element, attrs) {
		            element.bind('click', function() {
		                var message = attrs.ngReallyMessage;
		                if (message && confirm(message)) {
		                    scope.$apply(attrs.ngReallyClick);
		                }
		            });
		        }
		    }
		}])

		.controller('SettingsController', ['$scope','$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike){
			$scope.formMaps = [];

			$scope.addFormMap = function(){
				$scope.formMaps.push({
					formId: null,
					firstNameFieldId: null,
					lastNameFieldId: null,
					emailFieldId: null,
					addressFieldId: null,
					address2FieldId: null,
					cityFieldId: null,
					stateFieldId: null,
					zipFieldId: null,
					enableTowerData: true,
					enableWealthEngine: true
				});
			};

			$scope.getSavedFormMaps = function(){
				var req = {
					method: 'POST',
					url: dataAppendAdmin.ajaxUrl,
					data: $httpParamSerializerJQLike({ 'action': 'get_saved_data_append_settings' }),
					headers: {
					 	'Content-Type': 'application/x-www-form-urlencoded'
					}
				}

				$http(req).then(function(response) {
					$scope.formMaps = response.data;
				});
			};

			$scope.getSavedFormMaps();
		}])

		.controller('FormToAppendController', ['$scope','$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike){
			$scope.gfFormObject = null;
			$scope.formFields = null;
			$scope.currentlyEditing = false;

			$scope.getFormFields = function() {
				if(!$scope.form.formId) return;

				var req = {
					method: 'POST',
					url: dataAppendAdmin.ajaxUrl,
					data: $httpParamSerializerJQLike({ 'action': 'get_gf_form_object', 'form_id': $scope.form.formId }),
					headers: {
					 	'Content-Type': 'application/x-www-form-urlencoded'
					}
				}

				$http(req).then(function(response) {
					$scope.formFields = response.data.fields;
				});
			};

			$scope.removeFormMap = function(formMaps, index) {
				formMaps.splice(index, 1);
			};

			$scope.init = function() {
				if(!$scope.form.formId) $scope.currentlyEditing = true;
			};

			$scope.init();
		}]);