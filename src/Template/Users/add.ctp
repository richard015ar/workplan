<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Administrators'), ['controller' => 'Administrators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Administrator'), ['controller' => 'Administrators', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Note Employees'), ['controller' => 'NoteEmployees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note Employee'), ['controller' => 'NoteEmployees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Note Items'), ['controller' => 'NoteItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note Item'), ['controller' => 'NoteItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Note Plans'), ['controller' => 'NotePlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note Plan'), ['controller' => 'NotePlans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
            echo $this->Form->input('last_login');
            echo $this->Form->input('full_name');
            echo $this->Form->input('role_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
