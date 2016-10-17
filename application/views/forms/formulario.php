<?php 
/*
	// comienza el formulario
	$model = $this->uri->segment(1);
	$action = $this->uri->segment(3);
	$nivel = $this->session->userdata('level');

	if($action=='edit'){
		$btn = "Actualizar";
		$ejecutar ="update"; //"update/".$this->uri->segment(4);
	} else {
		$btn = "Agregar nuevo";
		$ejecutar = "add";
	}
*/	
	//echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
	//echo form_label($ejecutar.$this->uri->segment(3));
function makeaform($fields, $model, $nivel, $action, $btn, $tables) {
	//$fields = $campos;
	foreach ($fields as $field){
		
		// campo clave
		if($field->name==$model."_id") { 
			$atribute = array(
			    'type'          => 	'hidden',
			    'name'          => 	$field->name,
			    'id'            => 	$field->name 
			);
			echo form_input($atribute);
		} else {

			// begin boostrap
			echo '<div class="form-group">';

			// label
			if($field->name!=$model."_id") {
				if (!preg_match("/_id/i", $field->name)) {
					echo form_label(traducir($field->name), $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				} else {
					// Property_id -> Property
					echo form_label(traducir(substr(($field->name),0,-3)), $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				}
			}
			// nombre/clase/etc
			$atributes = array(
			    'name'          => 	$field->name,
			    'id'            => 	$field->name,
			    'placeholder'   => 	traducir($field->name),
			    'maxlength'     => 	$field->max_length,
			    'class'			=>	'form-control',
			    'autocomplete'	=> 	'off' 
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
					if($field->name!=$model."_id") { 
						if (!preg_match("/_id/i", $field->name)) {
							echo form_input($atributes);
						} else {
							$options = array( '0' => 'Seleccionar' );
							//Recibe el nombre de la tabla
							foreach ($tables as $table) { // <- PENDIENTE CON ESTO!!!
								$options[$table['property_id']]=$table['name'];
							}
							echo form_dropdown($atributes, $options);//, $options[0]
						}
					}
					break;
				case 'text':
					echo form_textarea($atributes);
					break;
				case 'char':
					$selected="";
					if($field->name=="level") {
						if($nivel==2){
							$selected = 2;
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'Administrador', '1' => 'Gerente de Proyecto', '2' => 'Broker' );
					} else if($field->name=="status") {
						if($nivel==2){
							$atributes['disabled'] = 'disabled';
						}
						if($action=='new'){
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'NO', '1' => 'SI' );
					} else {
						$options = array( '0' => 'Seleccionar' );
					}
					
					if($nivel==1) {
						$selected = 1;
						unset($options[0]);
					}
					echo form_dropdown($atributes, $options, $selected);
					break;
				case 'varchar':
					if($field->name=="password") {
						if($nivel==2){
							$atributes['disabled'] = 'disabled';
						}
						echo form_password($atributes);
						echo '<span id="helpBlock" class="help-block">Nota: Por cuestiones de seguridad no se muestra el password</span>';
					} else if($field->name=="file") {
						if($action=='edit'){
							$atributes['disabled'] = 'disabled';
						}
						echo form_upload($atributes);
						echo '<span id="helpBlock" class="help-block">Nota: Formatos soportados JPG, PNG, GIF</span>';
					} else {
						if($field->name=="email" && $action!="new") {
							if($nivel==2){
								$atributes['disabled'] = 'disabled';
							}
						}
						echo form_input($atributes);
					}
					break;
				case 'timestamp':
					$datestring = '%Y-%m-%d %h:%i:%s';
					$time = time();
					if($nivel==2){
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
	//echo form_close();
	//echo json_encode($fields);// test purpose
}
?>