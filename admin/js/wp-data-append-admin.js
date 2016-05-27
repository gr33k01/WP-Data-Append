var app = angular.module('wpDataAppendSettings', []);

app.filter('filterFieldTypes', function() {
	function filterFieldTypes(fields) {
		var returnFields = [],
			fieldTypes = ['text', 'email', 'select', 'radio', 'number'];
		for(var i = 0; i < fields.length; i++) {
			if(fieldTypes.indexOf(fields[i].type) > -1) {
				returnFields.push(fields[i]);
			}
		}
		return returnFields;
	};

	return filterFieldTypes;
});

app.controller('SettingsController', ['$scope','$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike){
	$scope.formMaps = [];

	$scope.addFormMap = function(){
		if($scope.formsToAppendForm.$invalid) return;
		$scope.formMaps.push({
			formId: null,
			fullNameFieldId: null,
			firstNameFieldId: null,
			lastNameFieldId: null,
			emailFieldId: null,
			fullAddressFieldId: null,
			address1FieldId: null,
			address2FieldId: null,
			cityFieldId: null,
			stateFieldId: null,
			zipFieldId: null,
			enableTowerData: true,
			enableWealthEngine: true,
			fromDb: false
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
			if(response.data.length > 0) {				
				$scope.formMaps = response.data;	
			}
		});
	};

	$scope.getSavedFormMaps();
}]);

app.controller('FormToAppendController', ['$scope','$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike){
	$scope.gfFormObject = null;
	$scope.formFields = null;
	$scope.currentlyEditing = false;
	$scope.waiting = false;

	$scope.getFormFields = function() {
		if(!$scope.form.formId) return;

		for(var i = 0; i < $scope.formMaps.length; i++) {
			if($scope.form.formId == $scope.formMaps[i].formId 
					&& !$scope.form.fromDb && $scope.formMaps[i].fromDb) {
				window.alert('This form has already been configured for data appends.');
				$scope.form.formId = null;
				return;
			}
		}

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

		if(!formMaps[index].fromDb) {
			formMaps.splice(index, 1);
			return;
		}

		var userConfirm = window.confirm('Removing will only stop future data appends. The Gravity Forms object will not be modified and previous data appends will be avaliable to view and export. Are you sure you want to remove this form from data appends?');
		if(!userConfirm) return;

		var req = {
			method: 'POST',
			url: dataAppendAdmin.ajaxUrl,
			data: $httpParamSerializerJQLike({ 'action': 'remove_form_map', 'formMapIndex': index }),
			headers: {
			 	'Content-Type': 'application/x-www-form-urlencoded'
			}
		}

		$scope.waiting = true;

		$http(req).then(function(response) {
			$scope.waiting = false;
			$scope.formFields = response.data.fields;
			formMaps.splice(index, 1);
		});			
	};

	$scope.init = function() {
		if(!$scope.form.formId) $scope.currentlyEditing = true;
	};

	$scope.done = function(index) {
		if(!$scope.formMaps[index].fromDb && $scope.form.formId == null) {
			$scope.formMaps.splice(index, 1);
			return;
		} 
		$scope.currentlyEditing = !$scope.currentlyEditing;
	};

	$scope.init();
}]);