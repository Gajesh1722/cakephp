<!-- File: src/Template/Articles/view.ctp -->
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
		<?php foreach($articles as $article): ?>
		<div>
			<div>
				<div>
					<div> 
						<?= $article['title'] ?>
					</div>
					<h5>Content</h5>
					<div>
						<?= $article['content'] ?>
					</div>
					<div>
					<h6>Date: <?= $article['date'] ?></h6>
					</div>
					<?php if($article['commentsAllowed']){ ?>
						<div class="row" >
						<h1>Add Comment</h1>
							<?php
								echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments', 'action'=>'add')));
								echo $this->Form->input('Name', array('name' => 'authorName'));
								echo $this->Form->hidden('article_id', array('value' => $article['id']));
								echo $this->Form->hidden('date', array('value' => $article['id']));
								echo $this->Form->input('E-Mail', array('name' => 'authorEmail'));
								echo $this->Form->input('content', ['rows' => '6']);
								echo $this->Form->button(__('Send'));
								echo $this->Form->end();
							?>
						</div>
						<?php } ?>
					<div class="comments">
						<h5>Comments</h5>
						<div class="comment">
							<? foreach($article['comments'] as $comment){ ?>
							<?= "<p>".$comment['authorName']."->".$comment['content']."</p>" ?>
							<? } ?> 
						</div>
					</div>
					
				</div>
			</div>
		</div>
	<?php endforeach; ?>   
		
		
		
</div>