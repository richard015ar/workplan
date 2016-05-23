<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Administrator'), ['action' => 'edit', $administrator->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Administrator'), ['action' => 'delete', $administrator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $administrator->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Administrators'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Administrator'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="administrators view large-9 medium-8 columns content">
    <h3><?= h($administrator->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $administrator->has('user') ? $this->Html->link($administrator->user->id, ['controller' => 'Users', 'action' => 'view', $administrator->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($administrator->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($administrator->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($administrator->modified) ?></td>
        </tr>
    </table>
</div>
