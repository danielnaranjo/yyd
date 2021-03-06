<?php
// http://stackoverflow.com/a/24854930
// https://www.codeigniter.com/userguide3/general/helpers.html
if ( ! function_exists('traducir')) {
    function traducir($arg){
		$originales = array(

			'firstname'		=>	'nombre',
			'lastname'		=>	'apellido', 
			'city'			=>	'ciudad', 
			'country'		=>	'país', 
			'level'			=>	'Tipo', 
			'registered'	=>	'fecha',
			'property'		=>	'propiedad',
			'property_id'	=>	'Proyecto',
			'name'			=>	'nombre',
			'address'		=>	'dirección',
			'province'		=>	'provincia',
			'account'		=>	'cuenta',
			'instructions'	=>	'instrucciones',
			'currency'		=>	'divisa',
			'type'			=>	'tipo',
			'amount'		=>	'precio',
			'number'		=>	'número',
			'square'		=>	'dimensiones',
			'price'			=>	'precio',
			'comission'		=>	'comisión',
			'file'			=>	'archivo',
			'description'	=>	'descripción',
			'phone'			=>	'teléfono',
			'notes'			=>	'comentarios',
			'status'		=>	'estado',
			'price_mts'		=>	'precio por mts',
			'price_feet'	=>	'precio por pies',
			'total_mts'		=>	'total mts',
			'total_feet'	=>	'total pies',

			'orientation'	=>	'orientación',
			'floors'		=>	'pisos',
			'lobby'			=>	'lobby',
			'unities'		=>	'unidades',
			'coordinates'	=> 	'coordenadas GPS',
			'date'			=> 	'Fecha',

			'client'		=> 	'Compradores',
			'bank'			=>	'Formas de pago',
			'property_amenities'	=> 'Amenities',
			'administrator'	=> 'Usuarios',

			'property_photo'	=> 'Fotografias',
			'caption'		=>	'descripción',
			'property_parking' => 'Parking',
		);
		return strtr( $arg, $originales );
    }
}