<?php

use Phinx\Migration\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;

class CreateDataSeedMigration extends AbstractMigration
{
    public function up()
	{
		$faker = \Faker\Factory::create();
		$populator = new Faker\ORM\CakePHP\Populator($faker);
		
		$populator->addEntity('Users', 50,[
			'nombre' => function() use ($faker){
				return $faker->firstName();
			},
			'apellido' => function() use ($faker){
				return $faker->lastName();
			},
			'mail' => function() use ($faker){
				return $faker->safeEmail();
			},
			'pass' => function(){
				$hasher = new DefaultPasswordHasher();
				return $hasher->hash('hola');
			},
			'rol' => 'user',
			'active' => function(){
				return rand(0,1);
			},
			'fecha_creacion' => function() use ($faker){
				return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
			},
			'fecha_modificacion' => function() use ($faker){
				return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
			}
		]);
		
		$populator->execute();
	}
}
