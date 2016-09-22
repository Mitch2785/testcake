<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	public function beforeFilter(\Cake\Event\Event $event){
		parent::beforeFilter($event);
		$this->Auth->allow(['add']);
	}
	
	public function isAuthorized($user){
		if(isset($user['role']) and $user['role'] === 'user'){
			if(in_array($this->request->action,['home','view','logout'])){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}

	public function login(){
		if($this->request->is('post')){
			$user = $this->Auth->identify();
			if($user){
				 $this->Auth->setUser($user);
				 return $this->redirect($this->Auth->redirectUrl());
			}else{
				$this->Flash->error('Datos invalidos, intentar de nuevo',['key' =>'auth']);
			}
		}
		
		if($this->Auth->user()){
			return $this->redirect(['controller' => 'Users','action' => 'home']);
		}
	}
	public function logout(){
		return $this->redirect($this->Auth->logout());
	}

	public function home(){
		$this->render();
	}

	public function index(){
		/* $usuarios = $this->Users->find('all'); */
		$usuarios = $this->paginate($this->Users);
		$this->set('users',$usuarios);
	}
	
	public function view($id){
		$user = $this->Users->get($id);
		$this->set('user', $user);
	}
	
	public function add(){
		$user = $this->Users->newEntity();
	
		if($this->request->is('post')){
			/* debug($this->request->data); */
			
			/* $user = $this->Users->patchEntity($user,$this->request->data, ['validate' => false]); */
			$user = $this->Users->patchEntity($user,$this->request->data);
			
			$user->role = "user";
			$user->activo = 1;
			
			if($this->Users->save($user)){
				$this->Flash->success('Se guardo el user');
				return $this->redirect(['controller' => 'Users', 'action' => 'login']);
			}else{
				$this->Flash->error($this->validationErrors );
				$this->Flash->error('no se creo usuario');
			}
		}
		
		$this->set(compact('user'));
	}
	
	public function edit($id = null){
		$user = $this->Users->get($id);
		if($this->request->is(['patch','post','put'])){
			$user = $this->Users->patchEntity($user, $this->request->data);
			if($this->Users->save($user)){
				$this->Flash->success('Usuario Modificado');
				return $this->redirect(['action'=>'index']);
			}else{
				$this->Flash->error('Usuario no Modificado, intentar de nuevo');
			}
		}
		$this->set(compact('user'));
	}
	
	public function delete($id = null){
		
		$this->request->allowMethod(['post','delete']);
		$user = $this->Users->get($id);
		
		if($this->Users->delete($user)){
			$this->Flash->success('Usuario Eliminado');
		}else{
			$this->Flash->error('Usuario no se eliminó');
		}
		return $this->redirect(['controller' => 'Users','action' => 'index']);
	}
}