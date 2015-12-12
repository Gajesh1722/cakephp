<!-- File: src/Template/Articles/add.ctp -->

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
        <h1>Add Article</h1>
            <?php
                echo $this->Form->create($article);
                echo $this->Form->input('title');
                echo $this->Form->input('content', ['rows' => '10']);
                echo $this->Form->input('publish', array('type' => 'checkbox', 'name' => 'publish'));
                echo $this->Form->input('comments', array('type' => 'checkbox', 'name' => 'comments'));

                echo $this->Form->button(__('Save'));
                echo $this->Form->end();
            ?>
        </div>
</div>
