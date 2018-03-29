<?php
/**
 * Created by PhpStorm.
 * User: nonka
 * Date: 25.03.18
 * Time: 17:11
 */

namespace Application\Models\AppointmentStatus;


use Application\Models\BaseEntity;

class AppointmentStatusEntity extends BaseEntity
{
    protected $status_id = 0;

    protected $type = 0;

    protected $status_name = '';

    protected $system_name = '';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->status_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->status_id = $id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->status_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->status_name = $name;
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
