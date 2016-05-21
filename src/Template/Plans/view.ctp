<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Plan'), ['action' => 'edit', $plan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plan'), ['action' => 'delete', $plan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Note Plans'), ['controller' => 'NotePlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note Plan'), ['controller' => 'NotePlans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="plans view large-9 medium-8 columns content">
    <h3><?= h($plan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Employee') ?></th>
            <td><?= $plan->has('employee') ? $this->Html->link($plan->employee->id, ['controller' => 'Employees', 'action' => 'view', $plan->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($plan->id) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $this->Number->format($plan->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($plan->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($plan->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($plan->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Plan Id') ?></th>
                <th><?= __('State') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($plan->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->plan_id) ?></td>
                <td><?= h($items->state) ?></td>
                <td><?= h($items->description) ?></td>
                <td><?= h($items->created) ?></td>
                <td><?= h($items->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Note Plans') ?></h4>
        <?php if (!empty($plan->note_plans)): ?>
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
            <?php foreach ($plan->note_plans as $notePlans): ?>
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
