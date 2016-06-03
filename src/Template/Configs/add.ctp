<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configs form large-9 medium-8 columns content">
    <?= $this->Form->create($config) ?>
    <fieldset>
        <legend><?= __('Add Config') ?></legend>
        <?php
            echo $this->Form->input('key');
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
