<?php

namespace viewregister;

	class ViewRegister{
		
		/**
		 * @var int
		 */
		const USERNAME_TO_SHORT = 0;
		
		/**
		 * @var int
		 */
		const PASSWORD_TO_SHORT = 1;
		
		/**
		 * @var int
		 */
		const NO_VALID_USERNAME = 2;
		
		/**
		 * @var int
		 */
		const PASSWORD_NOT_MATCH = 3;
		
		/**
		 * @var int
		 */
		const BOTH_TO_SHORT = 4;
		
		/**
		 * @var int
		 */
		const FAILED_CONNECT_TO_DATABASE = 5;
		
		/**
		 * @var int
		 */
		const USERNAME_ALREADY_TAKEN = 6;
		
		/**
		 * @var int
		 */
		const CREATION_SUCCESS = 7;
		
		/**
		 * @var string
		 */
		public static $regUser = "Register";
		
		/**
		 * @var string
		 */
		public static $regName = "RegName";
		
		/**
		 * @var string
		 */
		public static $regPass = "RegPass";
		
		/**
		 * @var string
		 */
		public static $repRegPass = "RepRegPass";
		
		/**
		 * @var string
		 */
		private static $back = "../../index.php";
		
		/**
		 * @var string
		 */
		public static $regButton = "Registrera";
		
		/**
		 * @var string
		 */
		private $message = "";
		
		/**
		 * @var string
		 */
		private $DBmessage = "";
		
		
		public static function GetRegName(){
			
			if(isset($_POST[self::$regName])){
				return $_POST[self::$regName];
			}
		}
		
		public static function GetStripRegName(){
				
			if(isset($_POST[self::$regName])){
				return strip_tags($_POST[self::$regName]);
			}
		}
		
		public static function GetRegPass(){
			
			if(isset($_POST[self::$regPass])){	
				return strip_tags($_POST[self::$regPass]);
			}
		}
		
		public static function GetRepRegPass(){
			
			if(isset($_POST[self::$repRegPass])){	
				return $_POST[self::$repRegPass];
			}
		}
		
		public static function TryReg(){
			
			if(isset($_POST[self::$regButton])){
				return true;
			}
			return false;
		}
		
		public function setMessage($messageType = 0) {
			switch($messageType) {
				case self::USERNAME_TO_SHORT:
					$this->message = "<div class = 'divregfel'><p class = 'regfel'>Username is to short. At least 3 letters</p></div>";
					break;
				case self::PASSWORD_TO_SHORT:
					$this->message = "<div class = 'divregfel'><p class = 'regfel'>Password is to short. At least 6 letters</p></div>";
					break;
				case self::BOTH_TO_SHORT:
					$this->message = "<div class = 'divregfel'><p class = 'regfel'>Username must have 3 letters and password 6 letters</p></div>";
					break;
				case self::NO_VALID_USERNAME:
					$this->message = "<div class = 'divregfel'><p class = 'regfel'>No valid letters in username</p></div>";
					break;
				case self::PASSWORD_NOT_MATCH:
					$this->message = "<div class = 'divregfel'><p class = 'regfel'>Password doesn't match</p></div>";
					break;
				default:
					$this->message = (string) NULL;
					break;
			}
		}
		
		public function SetDataBaseMessage($messageType = 0){
			switch($messageType) {
				case self::FAILED_CONNECT_TO_DATABASE:
					$this->message = "<p>Connection with the database have failed.
											Please try again later.</p>";
					break;
				case self::USERNAME_ALREADY_TAKEN:
					$this->message = "<p>The username is in use. Please try somthing else.</p>";
					break;
				case self::CREATION_SUCCESS:
					$this->message = "<p>Success. Your welcome to login now.</p>";
					break;	
				default:
					$this->message = (string) NULL;
			}
		}
		
		public function ShowRegisterBox(){
					
			echo $this->GetRegisterBox();
		}
		
		public function GetRegisterBox(){
			
			$reghtml = "
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
		    <html xmlns='http://www.w3.org/1999/xhtml'> 
		    <head>
		    <title>Not Logged in</title>
		    <meta http-equiv='content-type' content='text/html; charset=utf-8' />   
		    <link href='../../style.css' rel='stylesheet' type='text/css'>
		    </head>
		    <div class = 'container'>
		    <div class = 'header'>
			<h1 class = 'Page31'>Page 31</h1></div>
		    <div class = 'content'>
		    <div class = 'divform'>
			<a class = 'registerlink' href='" . self::$back . "'>Tillbaka</a>
			</div>
			<div class = 'divlogged'>
			<h2 class = 'logged'>Not logged in</h2>
			</div>
				<form action='?".self::$regUser."' method='post'>
					<fieldset class = 'fieldset'>
						<legend>Write your username and password</legend>
						<label for='UserNameID' >Username :</label>
						<input type='text' size='20' name='".self::$regName."' id='UserNameID' value='".self::GetStripRegName()."' />
						<label for='PasswordID' >Password  :</label>
						<input type='password' size='20' name='" . self::$regPass . "' id='PasswordID' value='' />
						<label for='RepPasswordID' >Repeat password  :</label>
						<input type='password' size='20' name='" . self::$repRegPass . "' id='PasswordID' value='' />
						<input type='submit' name='".self::$regButton."'  value='".self::$regButton."' />
						".$this->message."
					</fieldset>
				</form>
				</div> <div class = 'footer'><p class = 'ansvarig'> Responsible for the website : Måns Schütz</p>
				</div>
				</div>";
				
			return $reghtml;
		}
	} 