<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    var $uses = array('Article', 'Comment'); 

	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('all');
    }
    public function all()
    {
        $articles = $this->Articles->find('all')->contain([
			'Comments' => function ($q) {
							   return $q
									->select()
									->where(['Comments.approved' => true]);
							}
				]);
        $this->set(compact('articles'));
    }


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //$this->set('articles', $this->paginate($this->Articles));
        //$this->set('_serialize', ['articles']);
        $articles = $this->Articles->find('all')->contain(['Comments']);
        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id)
    {
        $articlesTable = TableRegistry::get('Articles');
		$articles = $articlesTable->find('all', array('conditions' => array('id' => $id)))->contain([
			'Comments' => function ($q) {
							   return $q
									->select()
									->where(['Comments.approved' => true]);
							}
				]);
        $this->set(compact('articles'));

    }
    public function increasecomment($id){
		$articlesTable = TableRegistry::get('Articles');
		$article = $articlesTable->get($id); 
		$article->commentCount += 1;
		$articlesTable->save($article);
		return $this->redirect('/articles/view/'.$id);

	}
	
	public function comments($id){
		$commentsTable = TableRegistry::get('Comments');
		$comments = $commentsTable->find('all', array('conditions' => array('article_id' => $id)));
        $this->set(compact('comments'));
	}

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $now = Time::now();
		$articlesTable = TableRegistry::get('Articles');
		$count = $articlesTable->find('all');
		$newArticleId = $count->last()->id +1;
        $query = $this->Articles->Tags->find('list', [
				'keyField' => 'id',
				'valueField' => 'value'
			]);

        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
         $this->set('article', $article);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Article = $this->Articles->get($id);
        if ($this->Articles->delete($Article)) {
            $this->Flash->success(__('The Article with id: {0} has been deleted.', h($id)));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
         return $this->redirect($this->referer());
    }
    //to publish articles
    public function publish($id)
    {
        $this->request->allowMethod(['post', 'publish']);

        $Article = $this->Articles->get($id);
        $Article['publish'] = "True";
        if ($this->Articles->save($Article)) {
            $this->Flash->success(__('The Article with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }

    public function draft($id)
    {
        $this->request->allowMethod(['post', 'draft']);

        $Article = $this->Articles->get($id);
        $Article['publish'] = "False";
        if ($this->Articles->save($Article)) {
            $this->Flash->success(__('The Article with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    //allow comments to publish
    public function allow($id)
    {
        $articlesTable = TableRegistry::get('Articles');

        $Article = $articlesTable->get($id);
        $Article['commentsAllowed'] = true;
        if ($articlesTable->save($Article)) {
            $this->Flash->success(__('The Article with id: {0} has been updated.', h($id)));
            return $this->redirect($this->redirect($this->referer()));
        }
    }

    //block the articles comment
    public function block($id)
    {
		$articlesTable = TableRegistry::get('Articles');

        $Article = $articlesTable->get($id);
        $Article['commentsAllowed'] = false;
        if ($articlesTable->save($Article)) {
            $this->Flash->success(__('The Article with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    //for login
    public function login()
    {
        if ($this->request->is('post')) {
            $login = $this->request->data;
            if($login['username'] == 'admin' && $login['password'] == 'cakephp'){
                    $this->Flash->success(__('Successfully Logged In!!'));
                    return $this->redirect($this->referer());
                }
            
            $this->Flash->error(__('Please enter right username/password!!!'));
        }
    }
    //for authorization purpose
    public function isAuthorized($user) {
        print($this->request->action);
        if($this->request->action === 'add') {
            return true;
        }

        if(in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
