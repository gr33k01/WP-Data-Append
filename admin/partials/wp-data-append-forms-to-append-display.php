<?php 

$forms = GFAPI::get_forms(); ?>

<div class="forms-to-append" ng-controller="SettingsController as settings">
	<div class="form-to-append" ng-repeat="form in formMaps" ng-controller="FormToAppendController as form">
		<div class="setting-column">
			<label>Form</label>
			<select ng-model="formId" ng-change="getFormFields()">
				<option value="0">Select a Form to Map</option>
			<?php foreach($forms as $form) : ?>
				<option value="<?php echo $form["id"]; ?>"><?php echo $form["title"]; ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		<div class="setting-column">
			<label>First Name Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Last Name Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Address Line 2 Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>City Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>State Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>

		<div class="setting-column">
			<label>Zip Field</label>
			<select disabled="disabled">
				<option value="0">Select a Field</option>
			</select>
		</div>
	</div>
</div>