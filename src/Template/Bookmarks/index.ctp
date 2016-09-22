<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h2>
				Mi lista
				<?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Nuevo',['controller' => 'Bookmarks' ,'action' => 'add'],['class'=>'btn btn-primary pull-right','escape'=>false]) ?>
			</h2>
		</div>
		<ul class="list-group">
			<?php  foreach ($bookmarks as $bookmark): ?>
		
			<li class="list-group-item">
				<h4 class="list-group-item-heading"><?= h( $bookmark->title) ?></h4>
				<p>
					<strong class="text-info">
						<small>
							<?= $this->Html->link( $bookmark->url, null,['target' =>'_blank']) ?>
						</small>
					</strong>
				</p>
				<p class="list-group-item-text"><?= h( $bookmark->description) ?></p>
				<br>
				<?= $this->Html->link( 'Editar',['controller' => 'Bookmarks' ,'action' => 'edit',$bookmark->id],['class'=>'btn btn-primary btn-small ']) ?>
				<?= $this->Form->postlink( 'Eliminar',['controller' => 'Bookmarks' ,'action' => 'delete',$bookmark->id],['confirm'=>'Eliminar enlace?','class'=>'btn btn-danger btn-small ']) ?>
				
			</li>
			
			<?php endforeach ?>
		</ul>
		<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '','after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
	</div>
</div>