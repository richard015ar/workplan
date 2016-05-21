<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note Plan'), ['action' => 'edit', $notePlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note Plan'), ['action' => 'delete', $notePlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notePlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Note Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notePlans view large-9 medium-8 columns content">
    <h3><?= h($notePlan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $notePlan->has('user') ? $this->Html->link($notePlan->user->id, ['controller' => 'Users', 'action' => 'view', $notePlan->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Plan') ?></th>
            <td><?= $notePlan->has('plan') ? $this->Html->link($notePlan->plan->id, ['controller' => 'Plans', 'action' => 'view', $notePlan->plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notePlan->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($notePlan->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($notePlan->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($notePlan->note)); ?>
    </div>
</div>
