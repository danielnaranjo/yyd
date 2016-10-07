<?php 

	// comienza el formulario
	$model = $this->uri->segment(1);
	$action = $this->uri->segment(2);
	if($action=='new'){
		$btn = "Agregar nuevo";
	} else {
		$btn = "Actualizar";
	}
	
	echo form_open($model.'/'.$action, ['class'=>"form-horizontal", 'role'=>"form"]);

	foreach ($fields as $field){
		
		// campo clave
		if($field->name==$model."_id") { 
			echo form_hidden($field->name);
		} else {

			// begin boostrap
			echo '<div class="form-group">';

			// label
			if($field->name!=$model."_id") {
				if (!preg_match("/_id/i", $field->name)) {
					echo form_label($field->name, $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				} else {
					// Property_id -> Property
					echo form_label(substr(($field->name),0,-3), $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				}
			}
			// nombre/clase/etc
			$atributes = array(
			    'name'          => $field->name,
			    'id'            => $field->name,
			    'placeholder'   => $field->name,
			    'maxlength'     => $field->max_length,
			    'class'			=>	'form-control',
			    'autocomplete'	=> 'off' 
			);

			/*
			// campo requerido
			if($field->default!=null){
				$requerido = array('required' => 'true');
				array_push($atributes, $requerido);
			}
			*/

			// boostrap
			echo '	<div class="col-md-9">';
			// input/textare/file/password/hidden	
			switch ($field->type) {
				case 'int':
					/*if($field->name!=$model."_id") { 
						echo form_input($atributes);
					} else {
						$options = array( '-1' => 'SELECCIONA' );
						echo form_dropdown($atributes, $options);
					}*/
					if($field->name!=$model."_id") { 
						if (!preg_match("/_id/i", $field->name)) {
							echo form_input($atributes);
						} else {
							$options = array( '-1' => 'SELECCIONA' );
							//Recibe el nombre de la tabla
							foreach ($tables as $table) {
								array_push($options, $table['name']);
							}
							echo form_dropdown($atributes, $options, $options[0]);
						}
					}
					break;
				case 'text':
					echo form_textarea($atributes);
					break;
				case 'char':
					if($field->name=="level") {
						if($this->session->userdata('level')==2){
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'Administrador', '1' => 'Gerente de Proyecto', '2' => 'Broker' );
					} else if($field->name=="status") {
						if($this->session->userdata('level')==2){
							$atributes['disabled'] = 'disabled';
						}
						if($action=='new'){
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'NO', '1' => 'SI' );
					} else {
						$options = array( '-1' => 'SELECCIONA' );
					}
					echo form_dropdown($atributes, $options);
					break;
				case 'varchar':
					//echo form_input($field->name)."<br>";
					if($field->name=="password") {
						if($this->session->userdata('level')==2){
							$atributes['disabled'] = 'disabled';
						}
						echo form_password($atributes);
						echo '<span id="helpBlock" class="help-block">Nota: Por cuestiones de seguridad no se muestra el password</span>';
					} else if($field->name=="file") {
						echo form_upload($atributes);
						echo '<span id="helpBlock" class="help-block">Nota: Formatos soportados JPG, PNG, GIF</span>';
					} else {
						if($field->name=="email") {
							if($this->session->userdata('level')==2){
								$atributes['disabled'] = 'disabled';
							}
						}
						echo form_input($atributes);
					}
					break;
				case 'timestamp':
					$datestring = '%Y-%m-%d %h:%i:%s';
					$time = time();
					if($this->session->userdata('level')==2){
						$atributes['disabled'] = 'disabled';
					}
					if($action=='new'){
						// si es fecha, deshabilito
						$atributes['readonly'] = 'true';
					}
					echo form_input($atributes, mdate($datestring, $time));
					break;
				case 'decimal':
					echo form_input($atributes);
					break;
				default:
					//echo form_input($field->name)."<br>";  
					break;
			}
			echo ' </div>';//.col-md-9
			echo '</div>';//.form-group
		}
	}

	// botonera
	echo '<div class="form-actions">';
	echo ' 	<div class="row">';
	echo ' 		<div class="col-md-offset-3 col-md-9">';
	echo form_submit('Submit', $btn, ['class'=>'btn blue']);
	// solo si es nuevo
	if($action=='new'){
		echo form_reset('reset', 'Borrar', ['class'=>'btn default']);
	}
	echo '   	</div>';
	echo '	</div>';
	echo '</div>';
	
	// cerrar formulario
	echo form_close();
	//echo json_encode($fields);// test purpose
?>
<script>var data = <? echo json_encode($result) ?>;setTimeout(function(){console.log('fire', data);$.each(data, function (index, value) {$('#'+index).val(value);})}, 300);</script>