<?php 

$forms = GFAPI::get_forms(); 
$f_id = $this->option_prefix . '_forms_to_append'; ?>

<div class="forms-to-append" ng-controller="SettingsController as settings">

	<input type="hidden" value="{{formMaps}}" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"/>

	<div class="forms-list">
		<div class="form-to-append" 
			ng-repeat="form in formMaps" 
			ng-controller="FormToAppendController as formMap" 
			ng-model="formMaps">


			<div class="setting-column">
				<!-- <label>Form to Map</label> -->
				<select ng-model="form.formId" 
						ng-change="getFormFields()" 
						ng-init="getFormFields()"
						ng-disabled="!currentlyEditing">
					 <option value="">Select a Form to Append Data To</option>
				<?php foreach($forms as $form) : ?>
					<option value="<?php echo $form["id"]; ?>"><?php echo '(' . $form['id'] . ') ' . $form["title"]; ?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>First Name Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.firstNameFieldId" >

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Last Name Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.lastNameFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Email Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.emailFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Address Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.addressFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Address Line 2 Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.address2FieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>City Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.cityFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>State Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.stateFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Zip Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.zipFieldId">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id'" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="checkboxes" ng-show="currentlyEditing">
				<div class="checkbox-group">
					<input type="checkbox" id="enableTowerData"
						ng-model="form.enableTowerData"
						ng-disabled="!currentlyEditing" />
					<label for="enableTowerData">Enable TowerData</label>
				</div>
				<div class="checkbox-group">
					<input type="checkbox" id="enableWealthEngine" 
						ng-model="form.enableWealthEngine" 
						ng-disabled="!currentlyEditing"/>
					<label for="enableWealthEngine">Enable WealthEngine</label>
				</div>
			</div>

			<div class="actions">
				<a class="edit" ng-click="currentlyEditing = !currentlyEditing">{{ currentlyEditing ? 'Done' : 'Edit'}}</a>
				<span>|</span>
				<a class="remove"
					ng-really-message="Removing will only stop future data appends. The Gravity Forms object will not be modified and previous data appends will be avaliable to view and export. Are you sure you want to remove this form from data appends?"
					ng-really-click="removeFormMap(formMaps, $index)">Remove</a>
			</div>
		</div>
	</div>

	<div class="buttons">
		<a class="button button-secondary" ng-click="addFormMap()">Add Form to Data Append</a>
	</div>
</div>

