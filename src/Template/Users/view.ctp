<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Administrators'), ['controller' => 'Administrators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Administrator'), ['controller' => 'Administrators', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Employees'), ['controller' => 'NoteEmployees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Employee'), ['controller' => 'NoteEmployees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Items'), ['controller' => 'NoteItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Item'), ['controller' => 'NoteItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Plans'), ['controller' => 'NotePlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Plan'), ['controller' => 'NotePlans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Full Name') ?></th>
            <td><?= h($user->full_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Role Id') ?></th>
            <td><?= $this->Number->format($user->role_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Login') ?></th>
            <td><?= h($user->last_login) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Administrators') ?></h4>
        <?php if (!empty($user->administrators)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->administrators as $administrators): ?>
            <tr>
                <td><?= h($administrators->id) ?></td>
                <td><?= h($administrators->created) ?></td>
                <td><?= h($administrators->modified) ?></td>
                <td><?= h($administrators->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Administrators', 'action' => 'view', $administrators->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Administrators', 'action' => 'edit', $administrators->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Administrators', 'action' => 'delete', $administrators->id], ['confirm' => __('Are you sure you want to delete # {0}?', $administrators->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($user->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Charge') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->created) ?></td>
                <td><?= h($employees->modified) ?></td>
                <td><?= h($employees->charge) ?></td>
                <td><?= h($employees->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Note Employees') ?></h4>
        <?php if (!empty($user->note_employees)): ?>
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
            <?php foreach ($user->note_employees as $noteEmployees): ?>
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
        <h4><?= __('Related Note Items') ?></h4>
        <?php if (!empty($user->note_items)): ?>
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
            <?php foreach ($user->note_items as $noteItems): ?>
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
    <div class="related">
        <h4><?= __('Related Note Plans') ?></h4>
        <?php if (!empty($user->note_plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Plan Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->note_plans as $notePlans): ?>
            <tr>
                <td><?= h($notePlans->id) ?></td>
                <td><?= h($notePlans->note) ?></td>
                <td><?= h($notePlans->created) ?></td>
                <td><?= h($notePlans->modified) ?></td>
                <td><?= h($notePlans->user_id) ?></td>
                <td><?= h($notePlans->plan_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NotePlans', 'action' => 'view', $notePlans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NotePlans', 'action' => 'edit', $notePlans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NotePlans', 'action' => 'delete', $notePlans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notePlans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
