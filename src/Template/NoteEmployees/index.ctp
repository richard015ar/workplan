<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Note Employee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noteEmployees index large-9 medium-8 columns content">
    <h3><?= __('Note Employees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('employee_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($noteEmployees as $noteEmployee): ?>
            <tr>
                <td><?= $this->Number->format($noteEmployee->id) ?></td>
                <td><?= h($noteEmployee->created) ?></td>
                <td><?= h($noteEmployee->modified) ?></td>
                <td><?= $noteEmployee->has('user') ? $this->Html->link($noteEmployee->user->id, ['controller' => 'Users', 'action' => 'view', $noteEmployee->user->id]) : '' ?></td>
                <td><?= $noteEmployee->has('employee') ? $this->Html->link($noteEmployee->employee->id, ['controller' => 'Employees', 'action' => 'view', $noteEmployee->employee->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $noteEmployee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $noteEmployee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $noteEmployee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteEmployee->id)]) ?>
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
