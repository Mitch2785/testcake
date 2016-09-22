<div class="row">
	<div class="col-md-12">
		<div class="page-header"><h2>Usuarios</h2></div>
	</div>
	<div class="">
		<table class="table table-striped table-hover">
			 <thead>
				<tr>
					<th><?= $this->Paginator->sort('id') ?></th>
					<th><?= $this->Paginator->sort('nombre') ?></th>
					<th><?= $this->Paginator->sort('apellido') ?></th>
					<th><?= $this->Paginator->sort('email') ?></th>
					<th><?= $this->Paginator->sort('fecha_creacion',['Fecha de creación']) ?></th>
					<th><?= $this->Paginator->sort('fecha_modificacion',['Fecha de modificación']) ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?= $this->Number->format($user->id) ?></td>
					<td><?= h($user->nombre) ?></td>
					<td><?= h($user->apellido) ?></td>
					<td><?= h($user->email) ?></td>
					<td><?= h($user->fecha_creacion) ?></td>
					<td><?= h($user->fecha_modificacion) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id],['class'=>'btn btn-small btn-info']) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class'=>'btn btn-small btn-primary']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],['class'=>'btn btn-small btn-danger', 'confirm' => __('seguro que quieres eliminar # {0}?', $user->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '','after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
