<?php

namespace loginModel;

require_once ("Database/database.php");

	class LoginModel{
		
		private static $admin = "Admin";
		
		/**
		 * @var string
		 */
		
		public $batCave = "2avunw3fuhegunwsgåojwq938th98h2wgvå823v89";
		
		/**
		 * @var string
		 */
		
		private static $loginSess = "login";
		
		/**
		 * @var string
		 */
		
		private static $sessionController = "Session controller";
		
		/**
		 * @var string
		 */
		
		private static $ip = "ip";
		
		/**
		 * @var string
		 */
		
		private static $browser = "browser";
		
		/**
		 * @var string
		 */
		
		private static $agent = "HTTP_USER_AGENT";
		
		/**
		 * @var string
		 */
		
		private static $remote = "REMOTE_ADDR";
		
		/**
		 * innehåller klassen Database
		 */
		private $DataBaseClass;
		
		/**
		 * @var string
		 */
		public static $sessUserName = "sessionUserName";
		
		public function __construct(){
			
			$this->DataBaseClass = new \database\Database();
		}
		
		/**
		 * @param userName string
		 * @param passWord string
		 * @return bool, kontrollerar ifall det användaren
		 * matat in stämmer och retunerar i så fall true
		 */
	 	public function LoginModel($userName, $passWord){
			
			if($this->DataBaseClass->OpenDataBase()){
					
				$selectSql = 'SELECT * FROM `User` WHERE `Username` = ?';
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				$stmt->bind_param("s", $userName);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($db_userName, $db_passWord);
				$stmt->fetch();
				$this->DataBaseClass->CloseDataBase();
				
				if($stmt->num_rows == 1){
					if($db_passWord == $passWord){
						$this->LoginSuccess($userName);
						return true;
					}
				}
				else{
					return false;
				}
			}			
			return false;
	 	}
		
		/**
		 * @param userName string
		 * @return bool, hämtar ut ett användarnamn
		 */
		public function Getdb_name($userName){
			
			if($this->DataBaseClass->OpenDataBase()){
					
				$selectSql = 'SELECT * FROM `User` WHERE `Username` = ?';
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				$stmt->bind_param("s", $userName);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($db_userName, $db_passWord);
				$stmt->fetch();
				$this->DataBaseClass->CloseDataBase();
				
				return $db_userName;
			}
		}

		/**
		 * @return string, Skickar det inte allt 
		 * för uppenbara lösenordet för cookie
		 */
		
		public function GetBatCave(){
			
			return $this->batCave;
		}
		
		/**
		 * Startar sessionen för inloggad
		 */
		
		public static function LoginSuccess(){
			
			$_SESSION[self::$loginSess] = true;
			
		}
		
		/**
		 * @param userName string
		 * sätter in användarens namn som value i session
		 * för att hålla reda på vem som är inloggad
		 */
		public static function SetSessionUserName($userName){
			
			$_SESSION[self::$sessUserName] = $userName;
		}
		
		/**
		 * @return string, retunerar användaren som
		 * är inloggad.
		 */
		public static function GetSessionUserName(){
			
			if(isset($_SESSION[self::$sessUserName])){
				return $_SESSION[self::$sessUserName];
			}
		}
		
		/**
		 * Stoppar sessionen för inloggad
		 */
		public function LogoutModel(){

			unset($_SESSION[self::$loginSess]);
				
			if(isset($_SESSION[self::$sessUserName])){
					
				unset($_SESSION[self::$sessUserName]);
			}
		}
		
		/**
		 * @return bool, Kontrollerar ifall sessionen
		 * är satt och retunerar i så fall true
		 */
		public function AskLogin(){
			
			if(isset($_SESSION[self::$loginSess])){
				
				return true;
			}
			return false;
		}
		
		/**
		 * @param userName string
		 * @param comment string
		 * @param picName string
		 * @return id, Sparar användaren, kommentaren
		 * bildens url och skickar iväg dess primary key 
		 */
		public function SavePost($userName, $comment, $picName){

			if($this->DataBaseClass->OpenDataBase()){
				$insertSql = "INSERT INTO Post (Username, Comment, `URL`) VALUES (?,?,?)";
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($insertSql);
				$stmt->bind_param("sss", $userName, $comment, $picName);
				$stmt->execute();
				$stmt->store_result();
				$stmt->fetch();
				
				$id = $stmt->insert_id;
				
				return $id;
				
				$this->DataBaseClass->CloseDataBase();
			}
		}
		
		/**
		 * @return postArray
		 * Skriver ut alla poster i daturms ordning.
		 */
		public function LoadPost(){
			
			if($this->DataBaseClass->OpenDataBase()){
				$selectSql = "SELECT `PostID`, `Username`, `Comment`, `URL` FROM `Post` ORDER BY `Date` DESC";
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($postID, $postUserName, $comment, $postPic);
				
				$postArray = new PostArray();
			
				while($stmt->fetch()){
					$post = new Post($postID, $postUserName, $comment, $postPic);
					$postArray->add($post);
				}
				$this->DataBaseClass->CloseDataBase();
				
			return $postArray;
			}
		}
		
		/**
		 * @param id, int
		 * Tar bort posten. Kontrollerar ifall den inloggade och 
		 * den som lade upp posten är den samma. 
		 * Admin kan ta bort alla poster
		 */
		public function DeletePost($id){
			
			$sessUserName = $this->GetSessionUserName();
			if($this->DataBaseClass->OpenDataBase()){
				if($sessUserName == self::$admin){
					$selectSql = "DELETE FROM `Post` WHERE `PostID` = ?;";
				}
				else{
					$selectSql = "DELETE FROM `Post` WHERE `PostID` = ? AND `Username` = ?;";
				}
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				if($sessUserName == self::$admin){
					$stmt->bind_param('i', $id);
				}
				else{
					$stmt->bind_param('is', $id, $sessUserName);
				}
				$stmt->execute();
			
				$this->DataBaseClass->CloseDataBase();
			}
		}
		
		/**
		 * @param comment, string
		 * @param id, int
		 * Uppdaterar posten. Kontrollerar ifall den inloggade och 
		 * den som lade upp posten är den samma. 
		 * Admin kan uppdatera alla poster.
		 */
		public function UpdatePost($comment, $id){
				
			$sessUserName = $this->GetSessionUserName();
			
			if($this->DataBaseClass->OpenDataBase()){
				
				if($sessUserName == self::$admin){
					$selectSql = "UPDATE Post SET `Comment`= ? WHERE `PostID`= ?";
				}
				else{
					$selectSql = "UPDATE Post SET `Comment`= ? WHERE `PostID`= ? AND `Username` = ?";
				}
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				
				if($sessUserName == self::$admin){
					$stmt->bind_param('si', $comment, $id);
				}
				else{
					$stmt->bind_param('sis', $comment, $id, $sessUserName);
				}
				$stmt->execute();
			
				$this->DataBaseClass->CloseDataBase();
			}
		}
		
		/**
		 * @param id int
		 * @return db_comment, string
		 * Hämtar en specifik kommentar
		 */
		public function GetCommentValue($id){
			
			if($this->DataBaseClass->OpenDataBase()){
				
				$selectSql = 'SELECT `Comment` FROM `Post` WHERE `PostID` = ?';
				$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($db_comment);
				$stmt->fetch();
			}	
			$this->DataBaseClass->CloseDataBase();
			
			return $db_comment;
		}
		
		/**
		 * @param newpass, string
		 * @param sessUserName, string
		 * Uppdaterar det nya lösenordet
		 */
		public function UpdateUser($newPass, $sessUserName){

			if($this->DataBaseClass->OpenDataBase()){
				
			$selectSql = "UPDATE `User` SET `Password`= ? WHERE `Username`= ?";
			$stmt = $this->DataBaseClass->GetDataBase()->prepare($selectSql);
			$stmt->bind_param('ss', $newPass, $sessUserName);
			$stmt->execute();
			}
			$this->DataBaseClass->CloseDataBase();
		}
		/**
		 * @param pic, Array
		 * @return pic[name], string
		 * Kontrollerar bildens filtyp och lägger den
		 * upp den på servern.
		 */
		public function HandlePic($pic){
		
			$allowedExts = array("jpeg", "jpg", "png");
			$temp = explode(".", $pic["name"]);
			$extension = end($temp);
			if((($pic["type"] == "image/jpeg")
			|| ($pic["type"] == "image/jpg")
			|| ($pic["type"] == "image/png"))
			&& ($pic["size"] < 2000000)
			&& in_array($extension, $allowedExts)){
				
				while(file_exists("upload/" . $pic["name"])){
					$pic["name"] = "1". $pic["name"];
			    }
			    move_uploaded_file($pic["tmp_name"],
			    "upload/" . $pic["name"]);
				return $pic["name"];
			}
		}
		
		/**
		 * @return bool, Kontrollerar ifall sessionen stämmer,
		 * Om inte så tas sessionen bort och true retuneras 
		 */
		public function CheckIfSessionIsValid(){
			
			if(isset($_SESSION[self::$sessionController]) == false){
				$_SESSION[self::$sessionController] = array();
				$_SESSION[self::$sessionController][self::$browser] = $_SERVER[self::$agent];
				$_SESSION[self::$sessionController][self::$ip] = $_SERVER[self::$remote];
			}
			if($_SESSION[self::$sessionController][self::$browser] != $_SERVER[self::$agent]){
						
				unset($_SESSION[self::$loginSess]);
				return true;
			}
			return false;
		}
	}
	
	/**
	 * Skapa array-objekt d'r jag stoppar in
	 * posten från databasen
	 **/
	class PostArray {
		
		/**
		 * @var Array
		 */
		private $m_postArray = array();
		
		public function __construct() {
		}
		
		public function add (Post $post){
			array_push($this->m_postArray, $post);
		}
		/**
		 * @return m_postArray, Array
		 */
		public function get(){
			return $this->m_postArray;
		}
	}
	class Post {
		
		/**
		 * @var int
		 */
		private $m_postID;
		
		/**
		 * @var string
		 */
		private $m_postUserName;
		
		/**
		 * @var string
		 */
		private $m_comment;
		
		/**
		 * @var string
		 */
		private $m_postPic;
		

		public function __construct($postID, $postUserName, $comment, $postPic) {
			$this -> m_postID = $postID;
			$this -> m_postUserName = $postUserName;
			$this -> m_comment = $comment;
			$this-> m_postPic = $postPic;
		}
		
		/**
		 * @return m_postID, int
		 */
		public function getpostID() {
			return $this -> m_postID;
		}
		
		/**
		 * @return m_postUserName, string
		 */
		public function getpostUserName() {
			return $this -> m_postUserName;
		}
		
		/**
		 * @return m_comment, string
		 */
		public function getcomment() {
			return $this -> m_comment;
		}
		
		/**
		 * @return m_postPic, string
		 */
		public function getpostPic(){
			return $this-> m_postPic;
		}
	}


	