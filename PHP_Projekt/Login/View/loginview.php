<?php

namespace loginView;

	class LoginView{
		
		/**
		 * @var int
		 */
		const USER_NOT_LOGGEDIN = 0;
		
		/**
		 * @var int
		 */
		const USER_ALREADY_LOGGEDIN = 1;
		
		/**
		 * @var int
		 */
		const MISSING_USERNAME = 2;
		
		/**
		 * @var int
		 */
		const MISSING_PASSWORD = 3;
		
		/**
		 * @var int
		 */
		const BAD_USERNAME_PASSWORD = 4;
		
		/**
		 * @var int
		 */
		const USER_LOGGED_OUT = 5;
		
		/**
		 * @var int
		 */
		const FAILED_COOKIE = 6;
		
		/**
		 * @var int
		 */
		const SESSION_THIEF = 7;
		
		/**
		 * @var int
		 */
		const FAILED_CONNECT_TO_DATABASE = 8;
		
		/**
		 * @var int
		 */
		const BAD_USERNAME = 9;
		
		/**
		 * @var int
		 */
		const EMPTY_COMMENT = 10;
		
		/**
		 * @var int
		 */
		const EMPTY_EDIT_COMMENT = 11;
		
		/**
		 * @var int
		 */
		const UPDATE_MISSING_PASSWORD = 12;
		
		/**
		 * @var int
		 */
		const UPDATE_PASSWORD_TO_SHORT = 13;
		
		/**
		 * @var int
		 */
		const UPDATE_PASSWORD_SUCCESS = 14;
		
		/**
		 * @var int
		 */
		const UPDATE_NO_VALID_PASS = 15;
		
		/**
		 * @var string
		 */
		public $userName;
		
		/**
		 * @var string
		 */
		
		public $passName;
		
		/**
		 * @var string
		 */
		public static $userID ="userID";
		
		/**
		 * @var string
		 */
		public static $passID ="passID";
		
		/**
		 * @var string
		 */
		public static $newPass = "newPass";
		/**
		 * @var string
		 */
		private $postID = 'postID';
		
		/**
		 * @var string
		 */
		public static $loginButton = "loginButton";
		
		/**
		 * @var string
		 */
		public static $logoutButton = "logoutButton";
		
		/**
		 * @var string
		 */
		public static $autologinID = "autoLogin";
		
		/**
		 * @var string
		 */
		private static $cookieUser = "cookieUser";
		
		/**
		 * @var string
		 */
		private static $cookiePass = "cookiePass";
		
		/**
		 * @var string
		 */
		public $safeKey = "safeKey";
		
		/**
		 * @var string
		 */
		public $message;
		
		/**
		 * @var string
		 */
		public $outMessage;
		
		/**
		 * @var string
		 */
		public $loginMessage;
		
		/**
		 * @var string
		 */
		public $keepme;
		
		/**
		 * @var string
		 */
		private static $RegPage = "Register/Controller/regcontroller.php";
		
		/**
		 * @var string
		 */
		private static $home = "Home/Controller/homecontroller.php";
		
		/**
		 * @var string
		 */
		private static $profile = "Profile/Controller/profilecontroller.php";
		
		/**
		 * @var string
		 */
		private static $settings = "Register/Controller/regcontroller.php";
		
		/**
		 * @var string
		 */
		private static $comment ="comment";
		
		/**
		 * @var string
		 */
		private static $postButton = "postButton";
		
		/**
		 * @var string
		 */
		private $makeEditMenu;
		
		/**
		 * @var string
		 */
		private static $picFile = "picFile";
		
		/**
		 * @var string
		 */
		private static $picButton = "picButton";
		
		/**
		 * @var string
		 */
		private static $editCloseButton = "editCloseButton";
		
		/**
		 * @var string
		 */
		private static $updateUser = "updateUser";
		
		/**
		 * @var string
		 */
		private static $postClassName = "postClass";
		
		/**
		 * @var string
		 */
		private  $edit = "edit";
		
		/**
		 * @var string
		 */
		private  $delete = "delete";
		
		/**
		 * @var string
		 */
		private $editMenuButton = "editmenubutton";
		
		/**
		 * @var string
		 */
		private static $editForm = "editForm";
		
		/**
		 * @var string
		 */
		private $postMessage;
		
		/**
		 * @var string
		 */
		private static $updateButton = "updatebutton";
		
		/**
		 * @var string
		 */
		private $html;


		public function __construct() {
			
			$this->title = 'Page 31. Not logged in.';
			$this->body = $this->firstPage();
		}
		
		/**
		 * @return string, retunerar innehållet av vad
		 * användaren matat som användarnamn.
		 */

		public static function GetUserName(){
		
			if(isset($_POST[self::$userID])){

				return $_POST[self::$userID];
			}
		}
		
		/**
		 * @return string, retunerar innehållet av vad
		 * användaren matat som användarnamn.
		 */
		
		public static function GetStripUserName(){
				
			if(isset($_POST[self::$userID])){
				return strip_tags($_POST[self::$userID]);
			}
		}
		
		/**
		 * @return string, Iretunerar innehållet av
		 * vad användaren matat in som lösenord.
		 */
		
		public static function GetPassWord(){
		
			if(isset($_POST[self::$passID])){

				return $_POST[self::$passID];
			}
		}
		
		/**
		 * @return bool, retunerar true om man trycker på login knappen
		 */
		
		public static function TryLogin(){
		
			if(isset($_POST[self::$loginButton])){
			
				return true;
			}
			return false;
		}
		
		/**
		 * return bool, retunerar true om man trycker
		 * på logga ut knappen och tar bort kakorna.
		 */
		
		public static function TryToLogout(){
		
			if(isset($_POST[self::$logoutButton])){
				
				self::DestroyCookie();
				
				return true;
			}
			return false;
		}
		
		/**
		 * @return string, retunerar innehållet av vad
		 * användaren matat som användarnamn.
		 */

		public static function GetComment(){

			if(isset($_POST[self::$comment])){

				return strip_tags($_POST[self::$comment]);
			}
		}
		
		/**
		 * @param messageType integer
		 * sätter meddelande beroende på vad för variabel som tas emot,
		 * annars så sätts den till null.
		 */
		
		public function setMessage($messageType = 0) {
			switch($messageType) {
				case self::MISSING_PASSWORD:
					$this->message = "<p class = 'felinloggning'>Password is missing</p>";
					break;
				case self::MISSING_USERNAME:
					$this->message = "<p class = 'felinloggning'>Username is missing</p>";
					break;
				case self::BAD_USERNAME_PASSWORD:
					$this->message = "<p class = 'felinloggning'>Username or password is wrong</p>";
					break;
				case self::USER_LOGGED_OUT:
					$this->message = "<p class = 'felinloggning'>You have logged out</p>";
					break;
				case self::FAILED_COOKIE:
					$this->message = "<p class = 'felinloggning'>No valid cookie</p>";
					break;
				case self::SESSION_THIEF:
				$this->message ="<p class = 'felinloggning'>Don't steal the session please</p>";
					break;
				case self::FAILED_CONNECT_TO_DATABASE:
					$this->message = "<p class = 'felinloggning'>Failed to connect to the database. Please try again later</p>";
					break;
				case self::BAD_USERNAME:
					$this->message = "<p class = 'felinloggning'>No valid letters in username</p>";
					break;
				case self::USER_ALREADY_LOGGEDIN:
				case self::USER_NOT_LOGGEDIN:
				default:
					$this->message = (string) NULL;
					break;
			}
		}
		
		/**
		 * @param $postMessageType integer
		 * sätter meddelande beroende på vad för variabel som tas emot,
		 * annars så sätts den till null.
		 */
		public function setPostMessage($postMessageType = 0){
			
			switch($postMessageType) {
			case self::EMPTY_COMMENT:
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'><p class = 'felmeddelande'>Please write somthing</p></div>";
					break;
			case self::EMPTY_EDIT_COMMENT:
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'>You must write somthing in the edit form</p></div>";
					break;
			case self::UPDATE_MISSING_PASSWORD:
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'>Password is missing</p></div>";
					break;
			case self::UPDATE_PASSWORD_TO_SHORT:
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'>At least 6 letters in your password</p></div>";
					break;
			case self::UPDATE_PASSWORD_SUCCESS:
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'>The new password have been saved</p></div>";
					break;
			case self::UPDATE_NO_VALID_PASS;
					$this->postMessage = "<div class = 'divwrongpost'><p class = 'wrongpost'>Invalid letters in password</p></div>";
					break;
				default:
					$this->postMessage = (string) NULL;
					break;
			}
		}
		
		/**
		 * Visar första sidan
		 */
		
		public function ShowFirstPage(){
			
			$this->title = 'Page 31. Logged in';
			$this->body = $this->firstPage();
		}
		
		/**
		 * Sidan som ska visas när man är inloggad
		 */
		
		public function ShowLoginPage($loginSess, $html){

			$this->title = 'Page 31. Logged in.';
			$this->body = $this->loginPage($loginSess, $html);
		}
		
		/**
		 * @return bool, retunerar true om "Håll mig inloggad" boxen är markerad
		 */
		
		public function AutoLogin(){
				
			if(isset($_POST[self::$autologinID])){
				return true;
			}
			return false;
		}		
		
		/**
		 * @param userName string
		 * @param batCave string
		 * skapar kakorna, sätter tid, namn och value
		 */
		
		public function MakeCookie($stripUserName, $batCave){
			
			$cookieTime = time() + 3000;
			
			file_put_contents("cookieTime.txt", "$cookieTime");
			
	 		setcookie(self::$cookieUser, $stripUserName, $cookieTime);
			$cryptPass = md5($batCave, $this->safeKey);
		
			$value = setcookie(self::$cookiePass, $cryptPass, $cookieTime);
	 	}
		
		/**
		 * @return string, retunerar cookieUser
		 */
		public function GetCookieUserName(){

			if(isset($_COOKIE[self::$cookieUser])){
				
				return $_COOKIE[self::$cookieUser];
			}
		}
		
		/**
		 * @return bool, retunerar true om kakorna är satta
		 */
		
		public function CookieExist(){
			
			if(isset($_COOKIE[self::$cookieUser]) && (isset($_COOKIE[self::$cookiePass]))){
					
				return true;
			}
			return false;
		}
		
		/**
		 * Tar bort kakorna
		 */
		
		public static function DestroyCookie(){
			
			setcookie(self::$cookieUser, "", time()-9999999);
			
			setcookie(self::$cookiePass, "", time()-9999999);
		}
		
		/**
		 * @param userName string
		 * @param batCave string
		 * @return bool, kollar av kakornas tid och 
		 * value och retunerar true om det stämmer
		 */
		
		public function CheckIfValidCookie($db_userName, $batCave){
			
			$timeFile = file_get_contents("cookieTime.txt");
			
			if($timeFile > time()){
				
				if($_COOKIE[self::$cookieUser] == $db_userName && 
					$_COOKIE[self::$cookiePass] == md5($batCave, $this->safeKey)){
		
					return true;
				}	
			}
			return false;
		}
		
		/**
		 * @return string, matar ut webbplattsens första sidan
		 */
			
		public function firstPage(){
				
			return "<div class = 'divform'><a class = 'registerlink' href='". self::$RegPage ."'>Register</a></div>
					<form class = 'form' action='?login' method='post' enctype='multipart/form-data'>
						<div class = 'divlogged'>
						<h2 class = 'logged' >Not logged in</h2>
						</div>
						<fieldset class = 'fieldset'>
							<legend>Login - Type your username and password</legend>
							<label for='userID' >Username :</label>
							<input type='text' size='20' name='".self::$userID."' 
							id='".self::$userID."' value= '". self::GetStripUserName()."'/>
							<label for='passID' >Password  :</label>
							<input type='password' size='20' name='".self::$passID."'
							id='".self::$passID."' value='' />
							<label for='autologinID' >Remember me  :</label>
							<input type='checkbox' name='".self::$autologinID."' id='".self::$autologinID."' />
							<input type='submit' name='".self::$loginButton."'  value='Log in' />
						</fieldset>
					</form>";
		}
		
		/**
		 * @return string, matar ut inlägg som ska visas när man är inloggad.
		 */
		
		public function ShowPost(\loginmodel\PostArray $postArray){
			
				foreach($postArray->get() as $post) {
					
					$this->html .= "<div class = 'loadpostclass'><p class = 'userNameClass'>
					".$post->getpostUserName().":"."</p>
					<div class = 'commentClass'><p class = '".self::$postClassName."'>" . $post->getcomment()."</p></div>" ;
					if($post->getpostPic() == null){
						
					}
					else{
						$this->html .= "<div class = 'divpostpic'><a href = 'upload/".$post->getpostPic()."' title = 'pic'>
						<img class = 'postpic' src='upload/".$post->getpostPic()."' alt = 'pic''></a></div>";
					}
					$this->html .= $this->DoEditButton($post->getpostID())."
					".$this->DoDeleteButton($post->getpostID())."</div> ";
				
				}
				return $this->html;
			
		}
		
		/**
		 * @return bool, retunerar true om man tryckt på $postbutton
		 */
		
		public function TriedToPost(){
			if(isset($_POST[self::$postButton])){
				return true;		
			}
			return false;
			
		}
		
		/**
		 * @return bool, retunerar true om man vill ändra lösenord
		 */
		public function WantToUpdateUser(){
			
			if(isset($_POST[self::$updateUser])){
				
				return true;
			}
			return false;
		}
		
		/**
		 * @return bool, retunerar true om man försöker ändra lösenord
		 */
		public function TriedToUpdateUser(){
			
			if(isset($_POST[self::$updateButton])){
					
				return true;
			}
			return false;
		}
		
		/**
		 * @return string, retunerar det nya lösenordet
		 */
		public function StripGetNewPass(){
			
			if(isset($_POST[self::$updateButton])){
				
				return strip_tags($_POST[self::$newPass]);
			}
		}
		
		/**
		 * @return string, retunerar det nya lösenordet
		 */
		public function GetNewPass(){
			
			if(isset($_POST[self::$updateButton])){
				
				return ($_POST[self::$newPass]);
			}
		}
		
		/**
		 * @return Array, retunerar en bild
		 */
		public function GetPic(){
			
			if(isset($_POST[self::$postButton])){
				
				if($_FILES[self::$picFile]['size'] > 0){
				return $_FILES[self::$picFile];
				}
			}
		}
		
		/**
		 * @param loginSess string
		 * @param html string
		 * @return Skriver ut sidan 
		 * som ska visar när man ä inloggad
		 */
		public function loginPage($loginSess, $html){
				
			return "<div class = 'divloggedin'>
				<h2 class = 'loginlogged'> ".$loginSess." Logged in</h2></div><div class = 'divupdate'>
				<form class = 'updateform' method='post' action='?post' method 'post' enctype='multipart/form-data'>
				<input class = 'updateUserButton' type='submit' name='".self::$updateUser."' value='Change Password' />
				</form></div><div class = 'divpicform'>
				<form class = 'picform' action='' method='post' enctype='multipart/form-data''>
				<input class = 'picbutton'type='submit' name='".self::$picButton."' value='Upload Picture'>
				</form></div><div class = 'divlogout'>
				<form class = 'logoutform' action='?logout' method='post' enctype='multipart/form-data'>
				<input class = 'logoutbutton' type='submit' name='".self::$logoutButton."'  value='Log out' />
				</form></div>".$this->postMessage."<div class = 'divloggedinform'>
				<form class = 'postform' method='post' action='?post' method 'post' enctype='multipart/form-data'>
				<textarea class = 'posttextarea' type='text' name='".self::$comment."' rows='10' cols='75'></textarea>
				<input class = 'postbutton' type='submit' name='".self::$postButton."'  value='Post' />
				<div class = 'divpic'>
				<label class = 'piclabel' for='file'>Upload Picture:</label>
				<input class = 'picfile' type='file' name='".self::$picFile."' id='".self::$picFile."'></div>
				</form></div><div class='allPostClass'>".$html."</div>";
		}
		
		/**
		 * matar ut grundstrukturen som alltid ska visas
		 */
		
		public function showPage() {
				
			echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0
				Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
		        <html xmlns='http://www.w3.org/1999/xhtml'> 
				<head> 
				<title>$this->title</title>
				<link href='style.css' rel='stylesheet' type='text/css'>
			    <meta http-equiv='content-type' content='text/html; charset=utf-8' />   
			    </head> <body>
				<div class = 'container'><div class = 'header'>
			    <h1 class = 'Page31'>Page 31</h1></div>
			    <div class = 'content'>
			    $this->body<div class = 'divfelinloggning'>
			    $this->message </div></div>
			    <div class = 'footer'>
				<p class = 'ansvarig'> Responsible for the website : Måns Schütz</p>
				</div></div></body></html>";
		}
		
		/**
		 * @return bool, retunerar true om man trycker på delete knappen
		 */
		public function TriedToDeletePost(){
			if(isset($_POST[$this->delete])){
					
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * @return bool, retunerar true om man trycker på edit knappen
		 */
		public function TriedToEditPost(){
			
			if(isset($_POST[$this->editMenuButton])){

				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * @return bool, retunerar true om man trycker på edit knappen
		 */
		public function WantToEditPost(){
			if(isset($_POST[$this->edit])){
					
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * @return string, retunerar id'et på posten
		 * i knapparna edit och delete 
		 */
		public function GetPostID(){
			
			if(isset($_POST[$this->delete])){
				return $_POST[$this->delete];
			}
			if(isset($_POST[$this->edit])){
				return $_POST[$this->edit];
			}
		}
		
		/**
		 * @param postID int
		 * @return string, retunerar delete-knappen
		 * för varje post.
		 */
		public function DoDeleteButton($postID){
			$deleteButton = "<div class = 'divdelete'><form method='POST'>
			<input type='hidden' value='". $postID ."' name='". $this->delete ."' />
			<input type='submit' value='Delete' /></form></div>";
			return $deleteButton;
		}
		
		/**
		 * @param postID int
		 * @return string, retunerar edit-knappen
		 * för varje post.
		 */
		public function DoEditButton($postID){
			$editButton = "<div class = 'divedit'><form method='POST'>
			<input type='hidden' value='". $postID ."' name='". $this->edit ."' />
			<input type='submit' value='Edit' /></form></div>";
			return $editButton;
		}
		
		/**
		 * @param postID int
		 * @param comment string
		 * @return string, retunerar menyn för
		 * uppdatering ut av inlägget.
		 */
		public function EditMenu($postID, $comment){
			
			return "<div id ='gray'> <div id = 'editmenu'>
			<form method='post' action='?post' method 'post' enctype='multipart/form-data'>
			<textarea class = 'editform' type='text' name='".self::$editForm."' rows='4' cols='30'>".$comment."</textarea>
			<input type='hidden' value='". $postID ."' name='". $this->editMenuButton ."' />
			<input type='submit' value='Edit Post' />
			</form>
			</div></div>";
		}
		
		/**
		 * @return string, retunerar formuläret
		 * för att uppdatera lösenordet
		 */
		public function UpdateUser(){
			
			return "<div class = 'gray'><div class = 'updateUserClass'> <form method='post' enctype='multipart/form-data'>
							<label for='passID' >Password  :</label>
							<input type='password' size='20' name='".self::$newPass."'
							id='".self::$newPass."' value='' />
							<input type='submit' name='".self::$updateButton."'  value='Update' />
					</form></div></div> ";
		}
		
		/**
		 * @return string, retunerar uppdateringen
		 * i posten.
		 */
		public function GetEditMenuForm(){

			if(isset($_POST[self::$editForm])){

				return strip_tags($_POST[self::$editForm]);
			}
		}
		
		/**
		 * @return string, retunerar edit-knappen
		 * när man är klar med sin uppdatering.
		 */
		public function GetEditMenuButton(){
			
			if(isset($_POST[$this->editMenuButton])){
				
				return $_POST[$this->editMenuButton];
			}
		}
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	