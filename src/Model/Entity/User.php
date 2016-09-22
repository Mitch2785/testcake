<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $pass
 * @property string $role
 * @property bool $activo
 * @property \Cake\I18n\Time $fecha_creacion
 * @property \Cake\I18n\Time $fecha_modificacion
 *
 * @property \App\Model\Entity\Bookmark[] $bookmarks
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
	
	protected function _setPassword($value){
		if(!empty($value)){
			$hasher = new DefaultPasswordHasher();
			return $hasher->hash($value);
		}else{
			$id_user=$this->properties['id'];
			$user = TableRegistry::get('Users')->recoverPassword($id_user);
			return $user;
		}
	}
}
