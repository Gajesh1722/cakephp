<!-- File: src/Template/Articles/index.ctp -->
<div> 
    <div>
        <div>
            <? if($this->request->session()->read('Auth.User.id') > 0){ ?>
            <div>
				<?= $this->Html->link('Add Article', ['controller' => 'Articles', 'action' => 'add']) ?>

            </div>
            <div>
				<?= $this->Html->link('home', ['controller' => 'users', 'action' => 'home']) ?>

            </div>
            <div>
				<?= $this->Html->link('Posts', ['controller' => 'users','action' => 'posts']) ?>
            </div>
				<?php 
				if($this->request->session()->read('Auth.User.role') == 'admin'){ 
				?>
            <div>
				<?= $this->Html->link('Users', ['controller' => 'users', 'action' => 'all']) ?>
            </div>
            <div>
				<?= $this->Html->link('Comments', ['controller' => 'Comments', 'action' => 'index']) ?>
            </div>
				<?php } ?>
            <div>
				<?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
						</div>
				<?	}else{ ?>
            <div>
				<?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
            </div>
				<?	} ?>
			</div>
		</div>
		<div>
        <h1>All Articles </h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Comments</th>
                <th>Allow Comments</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>       
                </td>                
                <td><?= $article->date ?></td>
                <td><?= $this->Html->link($article->commentCount, ['action' => 'comments', $article->id]) ?> </td>
                <td>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>       
                </td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $article->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                </td>
                <td>
                    
                    <?php 
//                       var_dump($article->publish);
                        if($article->publish){
                            echo $this->Form->postLink(
                                'Draft',
                                ['action' => 'draft', $article->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Publish',
                                ['action' => 'publish', $article->id],
                                ['confirm' => 'Are you sure?']);

                        }
    
                    ?>
                </td>
                <td>
                    
                    <?php 
//                       var_dump($article->publish);
                        if($article->commentsAllowed){
                            echo $this->Form->postLink(
                                'Block',
                                ['action' => 'block', $article->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Allow',
                                ['action' => 'allow', $article->id],
                                ['confirm' => 'Are you sure?']);

                        }
    
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>