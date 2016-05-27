<?php 

$forms = GFAPI::get_forms(); 
$f_id = $this->option_prefix . '_forms_to_append'; ?>

<div class="forms-to-append" ng-controller="SettingsController as settings">
	<a class="button button-secondary" 
			ng-click="addFormMap()"
			ng-disabled="formsToAppendForm.$invalid">Add Form to Data Append</a>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Settings" 
            ng-disabled="formsToAppendForm.$invalid">

	<input type="hidden" value="{{formMaps}}" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"/>

	<div class="forms-list" ng-form="formsToAppendForm">
		<div class="form-to-append" 
			ng-repeat="form in formMaps" 
			ng-controller="FormToAppendController as formMap" 
			ng-model="formMaps">

			<div class="setting-column">				
				<select ng-model="form.formId" 
						ng-change="getFormFields()" 
						ng-init="getFormFields()"
						ng-disabled="!currentlyEditing"
						ng-required="true">

					 <option value="">Select a Form to Append Data To</option>
				<?php foreach($forms as $form) : ?>
					<option value="<?php echo $form["id"]; ?>"><?php echo '(' . $form['id'] . ') ' . $form["title"]; ?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Full Name Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.fullNameFieldId" 
						ng-required="form.formId != null">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filter:{type:'name'}" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
					<option value="none">Use Multiple Text Fields</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullNameFieldId == 'none'">
				<label>First Name Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.firstNameFieldId" 
						ng-required="form.formId != null && form.fullNameFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullNameFieldId == 'none'">
				<label>Last Name Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.lastNameFieldId"
						ng-required="form.formId != null && form.fullNameFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<br />

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Email Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.emailFieldId"
						ng-required="form.formId != null">>

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<br />

			<div class="setting-column" ng-show="currentlyEditing">
				<label>Full Address Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.fullAddressFieldId"
						ng-required="form.formId != null">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filter:{type:'address'}" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
					<option value="none">Use Multiple Text Fields</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullAddressFieldId == 'none'">
				<label>Address Line 1 Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.address1FieldId"
						ng-required="form.formId != null && form.fullAddressFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullAddressFieldId == 'none'">
				<label>Address Line 2 Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.address2FieldId"
						ng-required="form.formId != null && form.fullAddressFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullAddressFieldId == 'none'">
				<label>City Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.cityFieldId"
						ng-required="form.formId != null && form.fullAddressFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullAddressFieldId == 'none'">
				<label>State Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.stateFieldId"
						ng-required="form.formId != null && form.fullAddressFieldId == 'none'">

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="setting-column" ng-show="currentlyEditing && form.fullAddressFieldId == 'none'">
				<label>Zip Field</label>
				<select ng-disabled="!form.formId || !currentlyEditing" 
						ng-model="form.zipFieldId"
						ng-required="form.formId != null && form.fullAddressFieldId == 'none'">	

					<option value="">Select a Field</option>
					<option ng-repeat="field in formFields | orderBy: 'id' | filterFieldTypes" value="{{ field.id }}">({{ field.id }}) {{ field.label }}</option>
				</select>
			</div>

			<div class="checkboxes" ng-show="currentlyEditing">
				<div class="checkbox-group">
					<input type="checkbox" id="enableTowerData{{$index}}" name="enableTowerData{{$index}}"
						ng-model="form.enableTowerData"
						ng-disabled="!currentlyEditing" />
					<label for="enableTowerData{{$index}}">Enable TowerData</label>
				</div>
				<div class="checkbox-group">
					<input type="checkbox" id="enableWealthEngine{{$index}}" name="enableWealthEngine{{$index}}" 
						ng-model="form.enableWealthEngine" 
						ng-disabled="!currentlyEditing"/>
					<label for="enableWealthEngine{{$index}}">Enable WealthEngine</label>
				</div>
			</div>

			<div class="actions">
				<a class="edit" ng-click="done($index)">{{ currentlyEditing ? 'Done' : 'Edit'}}</a>
				<span>|</span>
				<a class="remove"					
					ng-click="removeFormMap(formMaps, $index)">Remove</a>
			</div>
		</div>
	</div>
</div>


