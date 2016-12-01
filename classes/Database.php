<?php

class Database{
	protected $connection;

	public function __construct(){
		try {
			new PDO('mysql:host=localhost;dbname=webrorco_kinetic_task', "webrorco_kinetic", "!test7test",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connection = new PDO('mysql:host=localhost;dbname=webrorco_kinetic_task', "webrorco_kinetic", "!test7test");
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

    public function getRow($query, $params = []){
    	$result = $this->connection->prepare($query);
    	$result->execute($params);
    	return $result->fetch(); 
    }

    public function getRows($query, $params = []){
    	$result = $this->connection->prepare($query);
    	$result->execute($params);
    	return $result->fetchAll(); 
    }

    public function insert($query, $params = []){
    	$data = $this->connection->prepare($query);
    	$data->execute($params);
    	return true;
    }

    public function delete($query, $params = []){
    	$this->insert($query, $params);
    }

}