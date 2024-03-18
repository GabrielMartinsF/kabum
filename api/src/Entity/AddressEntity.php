<?php 

namespace App\Entity;
class AddressEntity
{
    private $id_endereco;
    private $logradouro; 
    private $logradouro_numero; 
    private $logradouro_complemento; 
    private $logradouro_bairro; 
    private $logradouro_cep; 
    private $logradouro_cidade; 
    private $logradouro_estado; 
    private $id_cliente;

/**
* Get the value of id_endereco
*
* @return  mixed
*/
public function getId_endereco()
{
return $this->id_endereco;
}

/**
* Set the value of id_endereco
*
* @param   mixed  $id_endereco  
*
* @return  self
*/
public function setId_endereco($id_endereco)
{
$this->id_endereco = $id_endereco;
return $this;
}

/**
* Get the value of logradouro
*
* @return  mixed
*/
public function getLogradouro()
{
return $this->logradouro;
}

/**
* Set the value of logradouro
*
* @param   mixed  $logradouro  
*
* @return  self
*/
public function setLogradouro($logradouro)
{
$this->logradouro = $logradouro;
return $this;
}

/**
* Get the value of logradouro_numero
*
* @return  mixed
*/
public function getLogradouro_numero()
{
return $this->logradouro_numero;
}

/**
* Set the value of logradouro_numero
*
* @param   mixed  $logradouro_numero  
*
* @return  self
*/
public function setLogradouro_numero($logradouro_numero)
{
$this->logradouro_numero = $logradouro_numero;
return $this;
}

/**
* Get the value of logradouro_complemento
*
* @return  mixed
*/
public function getLogradouro_complemento()
{
return $this->logradouro_complemento;
}

/**
* Set the value of logradouro_complemento
*
* @param   mixed  $logradouro_complemento  
*
* @return  self
*/
public function setLogradouro_complemento($logradouro_complemento)
{
$this->logradouro_complemento = $logradouro_complemento;
return $this;
}

/**
* Get the value of logradouro_bairro
*
* @return  mixed
*/
public function getLogradouro_bairro()
{
return $this->logradouro_bairro;
}

/**
* Set the value of logradouro_bairro
*
* @param   mixed  $logradouro_bairro  
*
* @return  self
*/
public function setLogradouro_bairro($logradouro_bairro)
{
$this->logradouro_bairro = $logradouro_bairro;
return $this;
}

/**
* Get the value of logradouro_cep
*
* @return  mixed
*/
public function getLogradouro_cep()
{
return $this->logradouro_cep;
}

/**
* Set the value of logradouro_cep
*
* @param   mixed  $logradouro_cep  
*
* @return  self
*/
public function setLogradouro_cep($logradouro_cep)
{
$this->logradouro_cep = $logradouro_cep;
return $this;
}

/**
* Get the value of logradouro_cidade
*
* @return  mixed
*/
public function getLogradouro_cidade()
{
return $this->logradouro_cidade;
}

/**
* Set the value of logradouro_cidade
*
* @param   mixed  $logradouro_cidade  
*
* @return  self
*/
public function setLogradouro_cidade($logradouro_cidade)
{
$this->logradouro_cidade = $logradouro_cidade;
return $this;
}

/**
* Get the value of logradouro_estado
*
* @return  mixed
*/
public function getLogradouro_estado()
{
return $this->logradouro_estado;
}

/**
* Set the value of logradouro_estado
*
* @param   mixed  $logradouro_estado  
*
* @return  self
*/
public function setLogradouro_estado($logradouro_estado)
{
$this->logradouro_estado = $logradouro_estado;
return $this;
}

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
}