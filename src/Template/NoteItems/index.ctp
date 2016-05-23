<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Note Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noteItems index large-9 medium-8 columns content">
    <h3><?= __('Note Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('item_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($noteItems as $noteItem): ?>
            <tr>
                <td><?= $this->Number->format($noteItem->id) ?></td>
                <td><?= $noteItem->has('item') ? $this->Html->link($noteItem->item->id, ['controller' => 'Items', 'action' => 'view', $noteItem->item->id]) : '' ?></td>
                <td><?= h($noteItem->created) ?></td>
                <td><?= h($noteItem->modified) ?></td>
                <td><?= $noteItem->has('user') ? $this->Html->link($noteItem->user->id, ['controller' => 'Users', 'action' => 'view', $noteItem->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $noteItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $noteItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $noteItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
