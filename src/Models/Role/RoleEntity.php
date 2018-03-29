<?php
/**
 * Created by PhpStorm.
 * User: nonka
 * Date: 25.03.18
 * Time: 14:44
 */

namespace Application\Models\Role;


use Application\Models\BaseEntity;

class RoleEntity extends BaseEntity
{
    protected $role_id = 0;

    protected $role_name = '';

    protected $system_name = '';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->role_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->role_id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->role_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->role_name = $name;
    }

    /**
     * @return string
     */
    public function getSystemName()
    {
        return $this->system_name;
    }

    /**
     * @param string $system_name
     */
    public function setSystemName($system_name)
    {
        $this->system_name = $system_name;
    }
}
