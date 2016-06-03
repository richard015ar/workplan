<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Home Working'), ['action' => 'edit', $homeWorking->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Home Working'), ['action' => 'delete', $homeWorking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeWorking->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Home Workings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Home Working'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="homeWorkings view large-9 medium-8 columns content">
    <h3><?= h($homeWorking->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $homeWorking->has('user') ? $this->Html->link($homeWorking->user->id, ['controller' => 'Users', 'action' => 'view', $homeWorking->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($homeWorking->id) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $this->Number->format($homeWorking->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($homeWorking->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($homeWorking->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($homeWorking->modified) ?></td>
        </tr>
    </table>
</div>
