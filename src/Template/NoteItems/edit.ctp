<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $noteItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $noteItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Note Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noteItems form large-9 medium-8 columns content">
    <?= $this->Form->create($noteItem) ?>
    <fieldset>
        <legend><?= __('Edit Note Item') ?></legend>
        <?php
            echo $this->Form->input('item_id', ['options' => $items]);
            echo $this->Form->input('note');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
