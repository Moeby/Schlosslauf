<?php

class User
{
    protected $id;
    protected $username;
    protected $password;
    protected $salt;
    protected $name;
    protected $first_name;
    protected $email;
    protected $country;
    protected $language;
    protected $street;
    protected $location;
    protected $area_code;
    protected $admin_code;
    protected $group;

    /*public function  __construct($id, $username, $password, $salt, $name, $first_name, $email, $country, $language, $street, $location, $area_code, $admin_code, $group) {
        $this->id         = $id;
        $this->username   = $username;
        $this->password   = $password;
        $this->salt       = $salt;
        $this->name       = $name;
        $this->first_name = $first_name;
        $this->email      = $email;
        $this->country    = $country;
        $this->language   = $language;
        $this->street     = $street;
        $this->location   = $location;
        $this->area_code  = $area_code;
        $this->admin_code = $admin_code;
        $this->group      = $group;
    }*/

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getAreaCode()
    {
        return $this->area_code;
    }

    /**
     * @return mixed
     */
    public function getAdminCode()
    {
        return $this->admin_code;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $area_code
     */
    public function setAreaCode($area_code)
    {
        $this->area_code = $area_code;
    }

    /**
     * @param mixed $admin_code
     */
    public function setAdminCode($admin_code)
    {
        $this->admin_code = $admin_code;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }
}