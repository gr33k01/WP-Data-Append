<?php 

$forms = GFAPI::get_forms(); ?>

<div class="forms-to-append" ng-controller="SettingsController as settings">
	<div class="form-to-append" ng-repeat="form in formMaps" ng-controller="FormToAppendController as form">
		<div class="setting-column">
			<label>Form</label>
			<select ng-model="formId" ng-change="getFormFields()">
				 <option value="">Select a Form to Map</option>
			<?php foreach($forms as $form) : ?>
				<option value="<?php echo $form["id"]; ?>"><?php echo '(' . $form['id'] . ') ' . $form["title"]; ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		<div class="setting-column">
			<label>First Name Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="firstNameFieldId" >
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Last Name Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="lastNameFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Email Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="emailFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="addressFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Line 2 Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="address2FieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>City Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="cityFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>State Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="stateFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Zip Field</label>
			<select ng-disabled="!formId" ng-options="'(' + field.id + ') ' + field.label for field in formFields | orderBy:'id' track by field.id" ng-model="zipFieldId">
				<option value="">Select a Field</option>
			</select>
		</div>
	</div>

	<a class="button button-secondary" ng-click="addFormMap()">Add Form to Data Append</a>
</div>

