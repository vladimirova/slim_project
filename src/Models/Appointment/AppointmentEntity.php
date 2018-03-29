<?php

namespace Application\Models\Appointment;

use Application\Models\AppointmentStatus\AppointmentStatusEntity;
use Application\Models\AppointmentHour\AppointmentHourEntity;
use Application\Models\BaseEntity;
use Application\Models\User\UserEntity;

class AppointmentEntity extends  BaseEntity
{
    protected $appointment_id = 0;

    protected $user_id = 0;

    protected $lawyer_id = 0;

    protected $hour_id = 0;

    protected $status_id = 0;

    protected $date = '';

    protected $description = '';

    private $status = null;

    private $hour = null;

    private $lawyer = null;

    public function __construct($attributes = null)
    {
        parent::__construct($attributes);

        $this->status = isset($attributes['status_name']) ? new AppointmentStatusEntity($attributes) : null;
        $this->hour = isset($attributes['hour_id']) ? new AppointmentHourEntity($attributes) : null;
        $this->lawyer = isset($attributes['user_name']) ? new UserEntity($attributes) : null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->appointment_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->appointment_id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getLawyerId()
    {
        return $this->lawyer_id;
    }

    /**
     * @param int $lawyer_id
     */
    public function setLawyerId($lawyer_id)
    {
        $this->lawyer_id = $lawyer_id;
    }

    /**
     * @return int
     */
    public function getHourId()
    {
        return $this->hour_id;
    }

    /**
     * @param int $hour_id
     */
    public function setHourId($hour_id)
    {
        $this->hour_id = $hour_id;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param int $status_id
     */
    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param null $hour
     */
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    /**
     * @return null
     */
    public function getLawyer()
    {
        return $this->lawyer;
    }

    /**
     * @param null $lawyer
     */
    public function setLawyer($lawyer)
    {
        $this->lawyer = $lawyer;
    }


}
