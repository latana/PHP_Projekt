<?php

namespace register;
	
	$start = new Register();
	
	class Register {
		
		private static $createNewUser = "Register";
		private static $regUser = "Register";
		private static $regName = "RegName";
		private static $regPass = "RegPass";
		private static $repRegPass = "RepRegPass";
		private static $back = "../index.php";
		private static $regButton = "Registrera";
		private $message = "";

		
		public function __construct(){
			
			$this->RegController();
		}
		
		private function RegController(){
	
			if($this->CheckRegLength()){
				$this->CheckDataBase();
			}
			echo $this->getRegisterBox();
		}
		
		private function GetRegName(){
			
			if($_POST){
				return $_POST[self::$regName];
			}
		}
		
		private function GetStripRegName(){
				
			if($_POST){
				return strip_tags($_POST[self::$regName]);
			}
		}
		
		private function GetRegPass(){
			
			if($_POST){	
				return $_POST[self::$regPass];
			}
		}
		
		private function TryReg(){
			
			if($_POST[self::$regButton]){
				return true;
			}
			return false;
		}
		
		private function CheckRegLength(){
			
			if($_POST){
				
				if(strlen($_POST[self::$regName]) < 3 && strlen($_POST[self::$regPass]) < 6){
						
					$this->message = "<p> Användarnamn är för kort. Minst 3 tecken </p>";	
					$this->message .= "<p> Lösenordet är för kort. Minst 6 tecken </p>";
					return false;
				}
				
				if(strlen($_POST[self::$regName]) < 3){
						
					$this->message = "<p> Användarnamn är för kort. Minst 3 tecken </p>";
					return false;
				}
			
				if(strlen($_POST[self::$regPass]) < 6){
					
					$this->message = "<p> Lösenordet är för kort. Minst 6 tecken </p>";
					return false;
				}
				
				if($this->GetStripRegName() !== $this->GetRegName()){
					
					$this->message = "<p> Ogiltiga tecken som användarnamn </p>";
					return false;
				}
			
				if($_POST[self::$regPass] !== $_POST[self::$repRegPass]){
					
					$this->message = "<p> Lösenorden matchar inte </p>";
					return false;
				}
				return true;
			}
		}
		
		private function CheckDataBase(){
			
			$regUser = $_POST[self::$regName];
			$regPass = $_POST[self::$regPass];
			
			strip_tags($regUser);
			strip_tags($regPass);
			
			$key = true;
			
			$connMyBase = mysqli_connect("latana.se.mysql", "latana_se", "123456", "latana_se");

			if (mysqli_connect_errno()){
				
				$this->message = "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($connMyBase,"SELECT * FROM Users");
			
				while($row = mysqli_fetch_array($result)){
	
					if($regUser == $row[0] || $regUser == "Admin"){
						
						$this->message = "<p>Användare finns redan</p>";
						$key = false;
						break;
					}
				}
			
			if($key == true){
				
			mysqli_query($connMyBase,"INSERT INTO Users (Username, Password)
					VALUES ('$regUser', '$regPass')");
					$this->message = "<p> Registreringen av ny användare lyckades </p> ";
			}
					$connMyBase->close();
		}
		
		
	}
