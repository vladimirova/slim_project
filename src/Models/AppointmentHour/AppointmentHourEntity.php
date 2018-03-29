<?php
/**
 * Created by PhpStorm.
 * User: nonka
 * Date: 25.03.18
 * Time: 14:46
 */

namespace Application\Models\AppointmentHour;


use Application\Models\BaseEntity;

class AppointmentHourEntity extends BaseEntity
{
    protected $hour_id = 0;

    protected $from = '';

    protected $to = '';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->hour_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->hour_id = $id;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }
}
