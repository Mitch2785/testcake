<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 */
class BookmarksController extends AppController
{
	public function isAuthorized($user){
	
		if(isset($user['role']) and $user['role'] === 'user'){
			if(in_array($this->request->action,['add','index'])){
				return true;
			}
			
			if(in_array($this->request->action,['edit','delete'])){
				$id = $this->request->params['pass'][0];
				$bookmark = $this->Bookmarks->get($id);
				if($bookmark->user_id == $user['id']){
					return true;
				}
			}
			
		}
		return parent::isAuthorized($user);
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
            /* 'contain' => ['Users'] */
            'conditions' => ['user_id' => $this->Auth->user('id')],
			'order' =>['id' =>'desc']
        ];
        $bookmarks = $this->paginate($this->Bookmarks);
		$this->set('bookmarks',$bookmarks);
        /* $this->set(compact('bookmarks'));
        $this->set('_serialize', ['bookmarks']); */
    }

    /**
     * View method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('bookmark', $bookmark);
        $this->set('_serialize', ['bookmark']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmark = $this->Bookmarks->newEntity();
        if ($this->request->is('post')) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
			$bookmark->user_id = $this->Auth->user('id');
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success(__('enlace creado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('No se creo el enlace.'));
            }
        }
       /*  $users = $this->Bookmarks->Users->find('list', ['limit' => 200]); */
        $this->set(compact('bookmark', 'users'));
        /* $this->set('_serialize', ['bookmark']); */
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmark = $this->Bookmarks->get($id/* , [      'contain' => []   ] */);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
			$bookmark->user_id = $this->Auth->user('id');
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success(__('se actualizó.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('no se eliminó el enlace.'));
            }
        }
        /* $users = $this->Bookmarks->Users->find('list', ['limit' => 200]); */
        $this->set(compact('bookmark', 'users'));
        /* $this->set('_serialize', ['bookmark']); */
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('The bookmark has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
