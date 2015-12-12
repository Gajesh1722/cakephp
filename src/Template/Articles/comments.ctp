<!-- File: src/Template/Articles/comments.ctp -->
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
        <h1> Article Comments </h1>
        <table>
            <tr>
                <th>Content</th>
                <th>Date</th>
                <th>Author name</th>
                <th>Author Email</th>
                <th>Status</th>
            </tr>

            <?php foreach ($comments as $comment): ?>
            <tr>
                <td>
                    <?= $this->Html->link($comment->content, ['action' => 'view', $comment->id]) ?>       
                </td>                
                <td><?= $comment->date ?></td>
                <td><?= $comment->authorName ?></td>
                <td><?= $comment->authorEmail ?></td>
				<td>
                <?php 
//                       var_dump($comment->approved);
                        if($comment->approved){
                            echo $this->Form->postLink('Disapprove',array(
								'controller'=>'Comments', 
								'action' => 'disapproveComment',
								$comment->id),
                                ['confirm' => 'Are you sure?']);
						}else {
							echo $this->Form->postLink('Approve',array(
								'controller'=>'Comments', 
								'action' => 'approveComment',
								$comment->id),
								['confirm' => 'Are you sure?']);
						}
    
                    ?>
				</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>