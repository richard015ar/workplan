<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Note Plans'), ['controller' => 'NotePlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note Plan'), ['controller' => 'NotePlans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="plans form large-9 medium-8 columns content">
    <?= $this->Form->create($plan) ?>
    <fieldset>
        <legend><?= __('Add Plan') ?></legend>
        <?php
            echo $this->Form->input('state');
            echo $this->Form->input('employee_id', ['options' => $employees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
