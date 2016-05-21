<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Employees'), ['controller' => 'NoteEmployees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Employee'), ['controller' => 'NoteEmployees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Charge') ?></th>
            <td><?= h($employee->charge) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $employee->has('user') ? $this->Html->link($employee->user->id, ['controller' => 'Users', 'action' => 'view', $employee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Note Employees') ?></h4>
        <?php if (!empty($employee->note_employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Employee Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->note_employees as $noteEmployees): ?>
            <tr>
                <td><?= h($noteEmployees->id) ?></td>
                <td><?= h($noteEmployees->note) ?></td>
                <td><?= h($noteEmployees->created) ?></td>
                <td><?= h($noteEmployees->modified) ?></td>
                <td><?= h($noteEmployees->user_id) ?></td>
                <td><?= h($noteEmployees->employee_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NoteEmployees', 'action' => 'view', $noteEmployees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NoteEmployees', 'action' => 'edit', $noteEmployees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NoteEmployees', 'action' => 'delete', $noteEmployees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noteEmployees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Plans') ?></h4>
        <?php if (!empty($employee->plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('State') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Employee Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->plans as $plans): ?>
            <tr>
                <td><?= h($plans->id) ?></td>
                <td><?= h($plans->state) ?></td>
                <td><?= h($plans->created) ?></td>
                <td><?= h($plans->modified) ?></td>
                <td><?= h($plans->employee_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Plans', 'action' => 'view', $plans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Plans', 'action' => 'edit', $plans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Plans', 'action' => 'delete', $plans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
