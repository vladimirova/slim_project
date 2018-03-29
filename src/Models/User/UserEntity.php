<?php

namespace Application\Models\User;


use Application\Models\BaseEntity;

class UserEntity extends BaseEntity
{
    protected $user_id = 0;

    protected $user_name = '';

    protected $email = '';

    protected $password = '';

    protected $role_id = 1;

    public function setRoleId($id)
    {
        $this->role_id = $id;

        return $this;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->user_id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->user_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->user_name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
