<?php

namespace Admin\Model;

class User implements \ZfcUser\Entity\UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        $this->state = (int) $state;
        return $this;
    }

    public function exchangeArray($data)
    {
      $this->setId((isset($data['user_id'])) ? $data['user_id'] : null);
      $this->setUsername((isset($data['username'])) ? $data['username'] : null);
      $this->setEmail((isset($data['email'])) ? $data['email'] : null);
      $this->setDisplayName((isset($data['display_name'])) ? $data['display_name'] : null);
      $this->setState((isset($data['state'])) ? $data['state'] : null);
      $this->setPassword((isset($data['password'])) ? $data['password'] : null);
    }

	public function toArray()
	{
		return array(
			'user_id' 		=> $this->getId(),
			'username' 		=> $this->getUsername(),
			'display_name' 	=> $this->getDisplayName(),
			'email'			=> $this->getEmail(),
			'password' 		=> $this->getPassword(),
			'state'			=> $this->getState()
		);
	}
}
