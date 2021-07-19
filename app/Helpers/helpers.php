<?php
use SIS\User;

function active($path)
{
	return request()->is($path) ? "active":"";
}

/**
 * Determina si usuario cuenta con acceso al sistema o no
 * 
 * @param User $user 
 * @return boolean
*/
function tiene_acceso(User $user){
	foreach($user->roles as $r){
		if( $r->slug == 'no-access'){
			return false;
		}
	}
	return true;
}

/**
 * Determina si un usuario cuenta con un rol
 * 
 * @param User $user 
 * @return boolean
 *  		TRUE: si tiene rol
 * 			FALSE: si no tiene el rol
*/
function tieneRol(User $user, $slug){
	foreach($user->roles as $r){
		if( $r->slug == $slug ){
			return true;
		}
	}
	return false;
}


/**
 * Obtiene todos los roles de un usuario concatenados y entre parentesis
 * 
 * @param User $user 
 * @return String de la forma: 
 * 			- ('Tecnico', 'Encargado', 'Invitado')
 */
function getAllRole(User $user){
	$tmp = '(';
	foreach($user->roles as $r){		
		//$tmp .= ucfirst( strtolower($r->name) ) . ', ' ;		
		$tmp .= $r->name . ', ' ;		
	}
	$tmp = substr( $tmp, 0, -2 );//Elimina ultima coma ', '
	$tmp .= ')';
	return $tmp;
}

/**
 * De un usuario con tipo de rol 'encargado', retorna su otro rol
 * es decir, de que area esta encargado
 * 
 * @return String $slug 
*/
function slugTipoEncargado(User $user){
	$slug='';
    if( $user->isRole('desarrollo') ){
        $slug = 'desarrollo';                    
    }elseif( $user->isRole('tecnico') ){
        $slug = 'tecnico';
    }elseif( $user->isRole('redes') ){
        $slug = 'redes';
    }elseif( $user->isRole('data') ){
        $slug = 'data';
    }
	return $slug;		
}


/**
 * Retorna un array con los ID de usuarios que no sean
 * - encargados
 * - administradores
 * - que no tengan acceso
*/
function idsTecnicos(){
	$users = User::get();
	$ids = array();

	foreach($users as $user){
		if(tiene_acceso($user)){
			if( !tieneRol($user, 'encargado') ){
				if( !tieneRol($user, 'guest') ){
					if( !tieneRol($user, 'admin') ){
						if( !tieneRol($user, 'supervisor') ){
							array_push($ids, $user->id);
						}
					}
				}
			}			
		}
	}
	return $ids;
}

/**
 * Retorna un array con los ID de usuarios que sean
 * - encargados
 * - y tengan acceso al sistema 
*/
function idsEncargados(){
	$users = User::get();
	$ids = array();

	foreach($users as $user){
		if(tiene_acceso($user)){
			if( tieneRol($user, 'encargado') ){
				array_push($ids, $user->id);				
			}			
		}
	}
	return $ids;
}

/**
 * Obtiene a todos los usuarios que no tengan acceso al sistema
 * 
 * @return array [1,3,56,...]
*/
function usuarios_sin_acceso(){
	$users = User::get();
	$ids = array();

	foreach($users as $user){
		if(!tiene_acceso($user)){
			array_push($ids, $user->id);			
		}
	}
	return $ids;
}


