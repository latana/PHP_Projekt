<?php

namespace controllerregister;

require_once '../View/regview.php';
require_once '../Model/regmodel.php';

$start = new ControllerRegister();

	class ControllerRegister{
		
		/**
		 * innehåller klassen database i register mappen
		 */
		
		private $RegModelClass;
		
		/**
		 * innehåller klassen View i register mappen
		 */
		private $RegViewClass;
		
		/**
		 * innehåller klassen database i database mappen
		 */
		private $DataBaseClass;
		
		public function __construct(){
			
			$this->RegModelClass = new \regmodel\RegModel();
			$this->RegViewClass = new \viewregister\ViewRegister();
			$this->DataBaseClass = new \database\DataBase();
			$this->userName = $this->RegViewClass->GetRegName();
			$this->strippUserName= trim($this->RegViewClass->GetStripRegName());
			$this->password = trim($this->RegViewClass->GetRegPass());
			$this->repRegPass = $this->RegViewClass->GetRepRegPass();
			$this->StartRegister();
		}
		
		private function StartRegister(){
			
				if($this->RegViewClass->TryReg()){
					if($this->UserAndPassController()){
						if($this->DataBaseClass->OpenDataBase()){
							if($this->RegModelClass->CheckIfValid($this->userName, $this->password)){
								if($this->RegModelClass->InsertIntoDataBase($this->userName, $this->password)){
									$this->RegViewClass->SetDataBaseMessage(\viewregister\ViewRegister::CREATION_SUCCESS);
								}
							}
							else{
								$this->RegViewClass->SetDataBaseMessage(\viewregister\ViewRegister::USERNAME_ALREADY_TAKEN);
							}
						}
						else{
							$this->RegViewClass->SetDataBaseMessage(\viewregister\ViewRegister::FAILED_CONNECT_TO_DATABASE);
						}
					}
				}
				$this->RegViewClass->ShowRegisterBox();
		}
		
		private function UserAndPassController(){
			
			if((strlen($this->userName) < 3) && (strlen($this->password) < 6)){
				$this->RegViewClass->setMessage(\viewregister\ViewRegister::BOTH_TO_SHORT);
				return false;
			}
			else if(strlen($this->userName) < 3){
				$this->RegViewClass->setMessage(\viewregister\ViewRegister::USERNAME_TO_SHORT);
				return false;
			}
			else if(strlen($this->password) < 6){
				$this->RegViewClass->setMessage(\viewregister\ViewRegister::PASSWORD_TO_SHORT);
				return false;
			}
			else if($this->userName !== $this->strippUserName){
				$this->RegViewClass->setMessage(\viewregister\ViewRegister::NO_VALID_USERNAME);
				return false;
			}
			else if($this->password !== $this->repRegPass){
				$this->RegViewClass->setMessage(\viewregister\ViewRegister::PASSWORD_NOT_MATCH);
				return false;
			}
			return true;
		}
	}

	
	
	
	
	
	
	
	
	