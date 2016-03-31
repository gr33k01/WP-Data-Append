<?php 

$forms = GFAPI::get_forms(); 

$f_id = $this->option_prefix . '_forms_to_append'; 
?>

<div class="forms-to-append" ng-controller="SettingsController as settings">

	<input type="hidden" value="{{formMaps}}" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"/>

	<div class="form-to-append" ng-repeat="form in formMaps" ng-controller="FormToAppendController as formMap" ng-model="formMaps">

		<div class="setting-column">
			<label>Form</label>
			<select ng-model="form.formId" ng-change="getFormFields()" ng-init="getFormFields()">
				 <option value="">Select a Form to Map</option>
			<?php foreach($forms as $form) : ?>
				<option value="<?php echo $form["id"]; ?>"><?php echo '(' . $form['id'] . ') ' . $form["title"]; ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		<div class="setting-column">
			<label>First Name Field</label>
			<select ng-disabled="!form.formId" ng-model="form.firstNameFieldId" >
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Last Name Field</label>
			<select ng-disabled="!form.formId" ng-model="form.lastNameFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Email Field</label>
			<select ng-disabled="!form.formId" ng-model="form.emailFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Field</label>
			<select ng-disabled="!form.formId" ng-model="form.addressFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Line 2 Field</label>
			<select ng-disabled="!form.formId" ng-model="form.address2FieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>City Field</label>
			<select ng-disabled="!form.formId" ng-model="form.cityFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>State Field</label>
			<select ng-disabled="!form.formId" ng-model="form.stateFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Zip Field</label>
			<select ng-disabled="!form.formId" ng-model="form.zipFieldId">
				<option value="">Select a Field</option>
				<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
			</select>
		</div>
	</div>

	<a class="button button-secondary" ng-click="addFormMap()">Add Form to Data Append</a>
</div>

