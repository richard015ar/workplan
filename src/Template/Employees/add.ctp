<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Note Employees'), ['controller' => 'NoteEmployees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note Employee'), ['controller' => 'NoteEmployees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->input('charge');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
