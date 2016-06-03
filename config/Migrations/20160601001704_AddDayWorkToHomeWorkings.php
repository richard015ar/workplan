<?php
use Migrations\AbstractMigration;

class AddDayWorkToHomeWorkings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('home_workings');
        $table->addColumn('day_work', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->removeColumn('date');
        $table->update();
    }
}
