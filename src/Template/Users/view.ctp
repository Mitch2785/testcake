<div class="well">
	<h2><?= $user->nombre ?></h2>
	<dl>
		<dt>Nombre</dt>
		<dd><?= $user->nombre ?></dd>
		<dt>Apellido</dt>
		<dd><?= $user->apellido ?></dd>
		<dt>email</dt>
		<dd><?= $user->email ?></dd>
		<dt>habilitado</dt>
		<dd><?= $user->activo ? 'SI' : 'NO' ?></dd>
		<dt>Fecha Creacion</dt>
		<dd><?= $user->fecha_creacion->nice() ?></dd>
		<dt>Fecha Modificacion</dt>
		<dd><?= $user->fecha_modificacion->nice() ?></dd>
		
	</dl>
</div>