<?php

namespace Application\Custom;

class Auth
{
    const SESSION_AUTH_KEY = 'auth_user';
    const SESSION_LAWYER_KEY = 'is_lawyer';

    protected $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function check()
    {
        return $this->session->has(self::SESSION_AUTH_KEY);
    }

    public function isLawyer()
    {
        return $this->session->get(self::SESSION_LAWYER_KEY);
    }

    public function id()
    {
        return $this->user()->getId();
    }

    public function user()
    {
        return $this->session->get(self::SESSION_AUTH_KEY);
    }

    public function authenticate($user)
    {
        $this->session->set(self::SESSION_AUTH_KEY, $user);
        $this->session->set(self::SESSION_LAWYER_KEY,  $user->getRoleId() == 2);
    }
}