<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Note Plans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notePlans form large-9 medium-8 columns content">
    <?= $this->Form->create($notePlan) ?>
    <fieldset>
        <legend><?= __('Add Note Plan') ?></legend>
        <?php
            echo $this->Form->input('note');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('plan_id', ['options' => $plans]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
