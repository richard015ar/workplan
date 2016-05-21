<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property \Cake\I18n\Time $last_login
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $full_name
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Administrator[] $administrators
 * @property \App\Model\Entity\Employee[] $employees
 * @property \App\Model\Entity\NoteEmployee[] $note_employees
 * @property \App\Model\Entity\NoteItem[] $note_items
 * @property \App\Model\Entity\NotePlan[] $note_plans
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
