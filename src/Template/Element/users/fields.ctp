<?php
	echo $this->Form->input('nombre');
	echo $this->Form->input('apellido');
	echo $this->Form->input('email');
	echo $this->Form->input('password',['label' =>'Contraseña', 'value' => '' ]);
	
	/* echo $this->Form->input('role',['options' =>['admin'=>'administrador','user'=>'usuario']]);
	echo $this->Form->input('activo'); */
	
	echo $this->Form->input('fecha_creacion');
	echo $this->Form->input('fecha_modificacion');
?>