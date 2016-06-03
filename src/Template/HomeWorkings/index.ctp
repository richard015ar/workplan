<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Home Working'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homeWorkings index large-9 medium-8 columns content">
    <h3><?= __('Home Workings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('state') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homeWorkings as $homeWorking): ?>
            <tr>
                <td><?= $this->Number->format($homeWorking->id) ?></td>
                <td><?= $homeWorking->has('user') ? $this->Html->link($homeWorking->user->id, ['controller' => 'Users', 'action' => 'view', $homeWorking->user->id]) : '' ?></td>
                <td><?= $this->Number->format($homeWorking->state) ?></td>
                <td><?= h($homeWorking->date) ?></td>
                <td><?= h($homeWorking->created) ?></td>
                <td><?= h($homeWorking->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $homeWorking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homeWorking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $homeWorking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeWorking->id)]) ?>
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
