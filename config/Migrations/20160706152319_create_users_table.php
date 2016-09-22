<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
		$tabla = $this->table('users');
		$tabla->addColumn('nombre','string',array('limit' => 100))
				->addColumn('apellido','string',array('limit' => 100))
				->addColumn('mail','string',array('limit' => 100))
				->addColumn('pass','string')
				->addColumn('rol','enum',array('values' => 'admin, user'))
				->addColumn('activo','boolean')
				->addColumn('fecha_creacion','datetime')
				->addColumn('fecha_modificacion','datetime')
				->create();
    }
}
