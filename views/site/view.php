<?php
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("site/create")?>">Crear Nuevo Usuario</a>

<h3> Lista de Usuarios </h3>

<table class="table table-bordered">
	
		<tr>
			<th>Id Usuario</th>
			<th>Usuario</th>		
			<th>Nombre</th>		
			<th>Apellido</th>
			<th>Departamento</th>
			<th></th>
			<th></th>				
		</tr>
<?php
// con este foreach es que se reliza la extracion de los datos
foreach ($model as $row ):
?>
<tr>
	<td><?= $row->id_usuario?></td>
	<td><?=$row->usuario?></td>
	<td><?=$row->nombre?></td>
	<td><?=$row->apellido?></td>
	<td><?=$row->dpto?></td>
	<td><a href="#">Editar</a></td>
	<td><a href="#">Eliminar</a></td>
</tr>


<?php endforeach ?>
</table>