<?php 
 class data_base 
 {
 	public $con;
	public function __construct() 
	 	{
	 		$this->con = new PDO("mysql:host=localhost;dbname=sarapulov","sarapulov","neto0982", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	    }
    public function show($sql) // выводит данные
    {
    	$con_db = $this->con->prepare($sql);
        $con_db->execute();
        $result = $con_db->fetchALL(PDO::FETCH_ASSOC);
        if ($result === false) 
        {
            return [];
        }
        return $result;
    }
    public function exec($sql) // заносит данные или обновляет
    {
    	$con_db = $this->con->prepare($sql);
        $result = $con_db->execute();
        return $result;
    }

 }