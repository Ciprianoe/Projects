<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;// trabajar con formularios dinamicos y validacion
use yii\helpers\Url; // para acer links o conexiones a links
?>

<a href="<?=Url::toRoute("site/view")?>">Listado de Usuarios</a>

<h1>Crear Usuario</h1>
<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
    "method" => "post",
 'enableClientValidation' => true,
]);
?>
<div class="form-group">
 <?= $form->field($model, "usuario")->input("text") ?>   
</div>
<div class="form-group">
 <?= $form->field($model, "nombre")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "apellido")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "dpto")->input("text") ?>   
</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>