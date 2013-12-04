<?php

namespace regmodel;

require_once ("../../Database/database.php");

	class RegModel{
		
		private $DataBaseClass;
		
		
		public function __construct(){
			
			$this->DataBaseClass = new \database\Database();
		}
		
		public function CheckIfValid($userName, $password){
			
			if($this->DataBaseClass->OpenDataBase()){
				
				$selectSql = 'SELECT `Username` FROM `User` WHERE `Username` = ?';
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				$stmt->bind_param("s", $userName);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($db_userName);
				$stmt->fetch();
			
				if($db_userName == $userName){
					return false;
					$this->DataBase->close();
				}
			}
			return true;
		}
		
		public function InsertIntoDataBase($userName, $password){
				
			$insertSql = "INSERT INTO User (Username, Password) VALUES (?, ?)";
			$stmt = $this->DataBaseClass->GetDataBase()->prepare($insertSql);
			$stmt->bind_param("ss", $userName, $password);
			$stmt->execute();
			$stmt->store_result();
			$stmt->fetch();
				
			$this->DataBaseClass->CloseDataBase();
			return true;
		}
	}
	
	
	
	
	
	