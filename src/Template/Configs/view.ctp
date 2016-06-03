<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Config'), ['action' => 'edit', $config->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Config'), ['action' => 'delete', $config->id], ['confirm' => __('Are you sure you want to delete # {0}?', $config->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Config'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configs view large-9 medium-8 columns content">
    <h3><?= h($config->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Key') ?></th>
            <td><?= h($config->key) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($config->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($config->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($config->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($config->modified) ?></td>
        </tr>
    </table>
</div>
