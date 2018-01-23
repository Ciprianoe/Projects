<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormUsuarios extends model{

public $id_usuario;
public $usuario;
public $nombre;
public $apellido;
public $dpto;

public function rules()
 {
  return [
   ['id_usuario', 'integer', 'message' => 'Id incorrecto'],
   ['usuario', 'required', 'message' => 'Campo requerido'],
   ['usuario', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['usuario', 'match', 'pattern' => '/^.{3,15}$/', 'message' => 'Mínimo 3 máximo 15 caracteres'],   
   ['nombre', 'required', 'message' => 'Campo requerido'],
   ['nombre', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['nombre', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['apellido', 'required', 'message' => 'Campo requerido'],
   ['apellido', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['apellido', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],
   ['dpto', 'required', 'message' => 'Campo requerido'],
   ['dpto', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['dpto', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],  
  ];
 }
 
}