<?php 

namespace App\Entity;
class UserEntity
{
    private $id_user;
    private $login;
    private $senha;

/**
* Get the value of id_user
*
* @return  mixed
*/
public function getId_user()
{
return $this->id_user;
}

/**
* Set the value of id_user
*
* @param   mixed  $id_user  
*
* @return  self
*/
public function setId_user($id_user)
{
$this->id_user = $id_user;
return $this;
}

/**
* Get the value of login
*
* @return  mixed
*/
public function getLogin()
{
return $this->login;
}

/**
* Set the value of login
*
* @param   mixed  $login  
*
* @return  self
*/
public function setLogin($login)
{
$this->login = $login;
return $this;
}

/**
* Get the value of senha
*
* @return  mixed
*/
public function getSenha()
{
return $this->senha;
}

/**
* Set the value of senha
*
* @param   mixed  $senha  
*
* @return  self
*/
public function setSenha($senha)
{
$this->senha = $senha;
return $this;
}
}