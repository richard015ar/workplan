<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note Employee'), ['action' => 'edit', $noteEmployee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note Employee'), ['action' => 'delete', $noteEmployee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteEmployee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Note Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="noteEmployees view large-9 medium-8 columns content">
    <h3><?= h($noteEmployee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $noteEmployee->has('user') ? $this->Html->link($noteEmployee->user->id, ['controller' => 'Users', 'action' => 'view', $noteEmployee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Employee') ?></th>
            <td><?= $noteEmployee->has('employee') ? $this->Html->link($noteEmployee->employee->id, ['controller' => 'Employees', 'action' => 'view', $noteEmployee->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($noteEmployee->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($noteEmployee->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($noteEmployee->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($noteEmployee->note)); ?>
    </div>
</div>
