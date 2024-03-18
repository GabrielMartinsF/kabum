<?php 

namespace App\Entity;

class ClientEntity
{   
    private $id_cliente;
    private $nome;
    private $data_nascimento;
    private $cpf;
    private $rg;
    private $telefone;
    private $address;
    

/**
* Get the value of id_cliente
*
* @return  mixed
*/
public function getId_cliente()
{
return $this->id_cliente;
}

/**
* Set the value of id_cliente
*
* @param   mixed  $id_cliente  
*
* @return  self
*/
public function setId_cliente($id_cliente)
{
$this->id_cliente = $id_cliente;
return $this;
}

/**
* Get the value of nome
*
* @return  mixed
*/
public function getNome()
{
return $this->nome;
}

/**
* Set the value of nome
*
* @param   mixed  $nome  
*
* @return  self
*/
public function setNome($nome)
{
$this->nome = $nome;
return $this;
}

/**
* Get the value of data_nascimento
*
* @return  mixed
*/
public function getData_nascimento()
{
return $this->data_nascimento;
}

/**
* Set the value of data_nascimento
*
* @param   mixed  $data_nascimento  
*
* @return  self
*/
public function setData_nascimento($data_nascimento)
{
$this->data_nascimento = $data_nascimento;
return $this;
}

/**
* Get the value of cpf
*
* @return  mixed
*/
public function getCpf()
{
return $this->cpf;
}

/**
* Set the value of cpf
*
* @param   mixed  $cpf  
*
* @return  self
*/
public function setCpf($cpf)
{
$this->cpf = $cpf;
return $this;
}

/**
* Get the value of rg
*
* @return  mixed
*/
public function getRg()
{
return $this->rg;
}

/**
* Set the value of rg
*
* @param   mixed  $rg  
*
* @return  self
*/
public function setRg($rg)
{
$this->rg = $rg;
return $this;
}

/**
* Get the value of telefone
*
* @return  mixed
*/
public function getTelefone()
{
return $this->telefone;
}

/**
* Set the value of telefone
*
* @param   mixed  $telefone  
*
* @return  self
*/
public function setTelefone($telefone)
{
$this->telefone = $telefone;
return $this;
}

/**
* Get the value of address
*
* @return  mixed
*/
public function getAddress()
{
return $this->address;
}

/**
* Set the value of address
*
* @param   mixed  $address  
*
* @return  self
*/
public function setAddress($address)
{
$this->address = new AddressEntity;
return $this;
}
}