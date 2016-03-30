angular
	.module('wpDataAppendSettings', [])
		.controller('SettingsController', function($scope){
			$scope.formMaps = [
					{					
						title: 'Megan',
						id: 3,
						firstName: {
							title: 'First Name',
							id: 1
						},
						lastName: {
							title: 'Last Name',
							id: 1
						},
						email: {
							title: 'Email',
							id: 1
						},
						address: {
							title: 'Address',
							id: 1
						},
						addressLine2: {
							title: 'Address Line 2',
							id: 1
						},
						city: {
							title: 'City',
							id: 1
						},
						state: {
							title: 'State',
							id: 1
						},
						zip: {
							title: 'Zip Code',
							id: 1
						}
					}
				];

		})

		.controller('FormToAppendController', ['$scope','$http', function($scope, $http){
			$scope.gfFormObject = null;
			$scope.formFields = null;
			

			$scope.getFormFields = function() {
				if(!$scope.formId) return;

				var req = {
					 method: 'POST',
					 url: dataAppendAdmin.ajaxUrl,
					 data: { action: 'get_gf_form_object', form_id: $scope.formId }
				}

				$http(req).then(function(response){
					console.log(response);
				});
			};

			$scope.getFormFields();
		}]);