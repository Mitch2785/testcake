<h2>bienvenido <?= $this->Html->link($current_user['nombre'],['controller' =>'Users', 'action'=>'view', $current_user['id']]) ?></h2>