<!-- File: src/Template/Users/all.ctp -->
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
        <h1> Users </h1>
        <table>
            <tr>
                <th>UserName</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
			<?php foreach ($users as $user): 
			?>
            <tr>
                <td>
                    <?= $user->username ?>       
                </td>                
                <td><?= $user->role ?></td>
                <td><?
				if($this->request->session()->read('Auth.User.role') == 'admin' && $this->request->session()->read('Auth.User.id') != $user->id){
						echo $this->Html->link('Delete', ['controller' => 'Users','action' => 'delete', $user->id]);

			}else{
						echo "---";
			}
					?>
				</td>
            </tr>
			<?php endforeach; ?>
        </table>
    </div>
</div>