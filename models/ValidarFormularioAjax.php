<?php
namespace app\models;
use Yii;
use yii\base\model;

class ValidarFormularioAjax extends model{
	public $nombre;
	public $email;

	public function rules()
	{
		return [
			['nombre', 'required', 'message' => 'Campo requerido'],
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['email', 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email','email_existe']
			
		];

	}
	public function attributelabels()
	{
		 return [
            'nombre' => 'Nombre:',
            'email' => 'Email:',
        ];
	}
/* vamos a crear un metodo que nos permitira
validar si algo existe en la base de datos de lo contrario nos retornara un error*/

/*
	para realizar la comprobacion se utilizara un foreach para recorrer cada array que exista o que este presente
*/
	
public function email_existe($attribute,$params)
{
	$email = ["ceem@gmail.com","aash@hotmail.com"];
	foreach ($email as $val) 
	{
		// con esta seccion realizamos la comprobacion del atributo email.
		if ($this->email==$val)
		{
			$this->addError($attribute, "Email existe" );
			return true;
		}		
		else 
		{
			return false;
		}
	}

}


}

?>