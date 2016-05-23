<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $noteEmployee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $noteEmployee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Note Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noteEmployees form large-9 medium-8 columns content">
    <?= $this->Form->create($noteEmployee) ?>
    <fieldset>
        <legend><?= __('Edit Note Employee') ?></legend>
        <?php
            echo $this->Form->input('note');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('employee_id', ['options' => $employees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
