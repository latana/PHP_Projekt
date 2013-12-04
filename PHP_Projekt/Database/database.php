<?php

namespace database;

	class Database{
		
		private $DataBase;
			
		public function OpenDataBase(){
			
			$this->DataBase = new \mysqli("latana.se.mysql", "latana_se", "Hemlig kod", "latana_se");
			
			if($this->DataBase->connect_errno > 0){
    			return false;
			}
			return true;
		}
		
		public function CloseDataBase(){
			
			$this->DataBase->close();
		}
		
		public function GetDataBase(){
			
			return $this->DataBase;
		}
	}
