<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Note Plan'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notePlans index large-9 medium-8 columns content">
    <h3><?= __('Note Plans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('plan_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notePlans as $notePlan): ?>
            <tr>
                <td><?= $this->Number->format($notePlan->id) ?></td>
                <td><?= h($notePlan->created) ?></td>
                <td><?= h($notePlan->modified) ?></td>
                <td><?= $notePlan->has('user') ? $this->Html->link($notePlan->user->id, ['controller' => 'Users', 'action' => 'view', $notePlan->user->id]) : '' ?></td>
                <td><?= $notePlan->has('plan') ? $this->Html->link($notePlan->plan->id, ['controller' => 'Plans', 'action' => 'view', $notePlan->plan->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notePlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notePlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notePlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notePlan->id)]) ?>
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
