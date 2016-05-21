<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note Item'), ['action' => 'edit', $noteItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note Item'), ['action' => 'delete', $noteItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Note Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="noteItems view large-9 medium-8 columns content">
    <h3><?= h($noteItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Item') ?></th>
            <td><?= $noteItem->has('item') ? $this->Html->link($noteItem->item->id, ['controller' => 'Items', 'action' => 'view', $noteItem->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $noteItem->has('user') ? $this->Html->link($noteItem->user->id, ['controller' => 'Users', 'action' => 'view', $noteItem->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($noteItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($noteItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($noteItem->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($noteItem->note)); ?>
    </div>
</div>
