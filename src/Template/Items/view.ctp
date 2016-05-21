<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Items'), ['controller' => 'NoteItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Item'), ['controller' => 'NoteItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Plan') ?></th>
            <td><?= $item->has('plan') ? $this->Html->link($item->plan->id, ['controller' => 'Plans', 'action' => 'view', $item->plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $this->Number->format($item->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($item->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($item->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($item->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Note Items') ?></h4>
        <?php if (!empty($item->note_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Item Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->note_items as $noteItems): ?>
            <tr>
                <td><?= h($noteItems->id) ?></td>
                <td><?= h($noteItems->item_id) ?></td>
                <td><?= h($noteItems->note) ?></td>
                <td><?= h($noteItems->created) ?></td>
                <td><?= h($noteItems->modified) ?></td>
                <td><?= h($noteItems->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NoteItems', 'action' => 'view', $noteItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NoteItems', 'action' => 'edit', $noteItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NoteItems', 'action' => 'delete', $noteItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
