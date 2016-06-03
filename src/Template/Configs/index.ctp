<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Config'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configs index large-9 medium-8 columns content">
    <h3><?= __('Configs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('key') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configs as $config): ?>
            <tr>
                <td><?= $this->Number->format($config->id) ?></td>
                <td><?= h($config->created) ?></td>
                <td><?= h($config->modified) ?></td>
                <td><?= h($config->key) ?></td>
                <td><?= h($config->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $config->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $config->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $config->id], ['confirm' => __('Are you sure you want to delete # {0}?', $config->id)]) ?>
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
