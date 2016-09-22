<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="page-header"><h2>Modificar Usuario</h2></div>
	
		<?= $this->Form->create($user,['novalidate']) ?>
		
		<fieldset>
			<?= $this->element('users/fields') ?>
		
			
		</fieldset>
		<?= $this->Form->button(__('Modificar')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
