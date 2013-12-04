<?php

namespace loginController;

require_once 'Login/View/loginview.php';
require_once 'Login/Model/loginmodel.php';

	class LoginController{
		
		/**
		 * innehåller klassen Model
		 */
		
		private $classLoginModel;
		
		/**
		 * innehåller klassen View
		 */
		private $classLoginView;
		
		/**
		 * @var string
		 */
		private $html;
		
		public function __construct() {
			
			$this->classLoginModel = new \loginModel\LoginModel();
			$this->classLoginView = new \loginView\LoginView();
			$this-> startEngine();
		}
		
		/**
		 * Kontrollerar sessions, cookie och
		 * vad användaren har gjort tidigare
		 */
		private function startEngine(){
				
			$stripUserName = $this->classLoginView->GetStripUserName();
			
			if($this->classLoginModel->CheckIfSessionIsValid()){
					
				$this->classLoginView->setMessage(\loginView\LoginView::SESSION_THIEF);
			}
			$this->CookieController();
			
			$userSessName = $this->classLoginModel->GetSessionUserName();
			
			if(!$this->classLoginModel->AskLogin() && !$this->classLoginView->TryLogin()){
				
			} else if($this->classLoginView->TryToLogout()) {
				$this->classLoginView->setMessage(\loginView\LoginView::USER_LOGGED_OUT);
				$this->classLoginModel->LogoutModel();
			}
			else{
				if ($this->classLoginModel->AskLogin()) {
					
					$this->HandlePost();			
					$this->classLoginView->ShowLoginPage($userSessName, $this->html);
				}
				else{
					$this->UserAndPassController();
				}
			}
			$this->classLoginView->showPage();
		}
		
		/**
		 * Kontrollerar vad användaren har matat in
		 * och skickar meddelande beroende på situation
		 */
		private function UserAndPassController(){
			
			$userName = trim($this->classLoginView->GetUserName());
			$passWord = trim($this->classLoginView->GetPassWord());
			$stripUserName = $this->classLoginView->GetStripUserName();
			$batCave = $this->classLoginModel->GetBatCave();
			
			if (empty($stripUserName)) {
						
				$this->classLoginView->setMessage(\loginView\LoginView::MISSING_USERNAME);	
			}
			else if(empty($passWord)) {
						
				$this->classLoginView->setMessage(\loginView\LoginView::MISSING_PASSWORD);
			}
			else if($userName != $stripUserName){
				
				$this->classLoginView->setMessage(\loginView\LoginView::BAD_USERNAME);
			}
			else if ($this->classLoginModel->LoginModel($stripUserName, $passWord)) {
					
				if($this->classLoginView->AutoLogin()){
					$this->classLoginView->MakeCookie($stripUserName, $batCave);
				}
				$this->classLoginModel->SetSessionUserName($stripUserName);
				$userSessName = $this->classLoginModel->GetSessionUserName();
				$this->HandlePost();
				$this->classLoginView->ShowLoginPage($userSessName, $this->html);
			}
			else {
				$this->classLoginView->setMessage(\loginView\LoginView::BAD_USERNAME_PASSWORD);
			}
		}
		
		/**
		 * Kontrollerar ifall kakorna är satta
		 * för att sedan kontrollera om deras värden stämmer
		 */
		private function CookieController(){
			
			$batCave = $this->classLoginModel->GetBatCave();
			$userName = $this->classLoginView->GetCookieUserName();
			$db_userName = $this->classLoginModel->Getdb_name($userName);

			
			if(!$this->classLoginModel->AskLogin() && $this->classLoginView->CookieExist()){
				
				if($this->classLoginView->CheckIfValidCookie($db_userName, $batCave)){
						$this->classLoginModel->LoginSuccess();
						$this->classLoginModel->SetSessionUserName($db_userName);
				}
				else{
					$this->classLoginView->setMessage(\loginView\LoginView::FAILED_COOKIE);
					$this->classLoginView->DestroyCookie();
				}
			}
		}
		
		/**
		 * Hanterar alla posterna och deras crud
		 */
		private function HandlePost(){
			
			$comment = trim($this->classLoginView->GetComment());
			$pic = $this->classLoginView->GetPic();
			$userSessName = $this->classLoginModel->GetSessionUserName();
			
			if($this->classLoginView->TriedToPost()){
			
				if(empty($comment)){
					$this->classLoginView->setPostMessage(\loginView\LoginView::EMPTY_COMMENT);
				}
				else{
					$picName = $this->classLoginModel->HandlePic($pic);
					$this->classLoginModel->SavePost($userSessName, $comment, $picName);
				}
			}
			if($this->classLoginView->TriedToDeletePost()){
				
				$this->classLoginModel->DeletePost($this->classLoginView->GetPostID());
			}
			if($this->classLoginView->WantToEditPost() || $this->classLoginView->TriedToEditPost()){
				
				$db_comment = $this->classLoginModel->GetCommentValue($this->classLoginView->GetPostID());
				
				if($this->classLoginView->TriedToEditPost()){
					
					 $form = trim($this->classLoginView->GetEditMenuForm());
					 $id = $this->classLoginView->GetEditMenuButton();
					 
					 if(empty($form)){
					 	$this->classLoginView->setPostMessage(\loginView\LoginView::EMPTY_EDIT_COMMENT);
					 }
					 else{
					 	$this->classLoginModel->UpdatePost($form, $id);
					 }
				}
				else{
					$this->html = $this->classLoginView->EditMenu($this->classLoginView->GetPostID(), $db_comment);
				}
			}
			$this->UserUpdate();
		    $this->html .= $this->classLoginView->ShowPost($this->classLoginModel->LoadPost());
		}
		
		/**
		 * Uppdaterar lösenordet
		 */
		private function UserUpdate(){

			if($this->classLoginView->WantToUpdateUser() || $this->classLoginView->TriedToUpdateUser()){
				
				if($this->classLoginView->TriedToUpdateUser()){

					$newPass = trim($this->classLoginView->StripGetNewPass());
					$notStriptNewPass = ($this->classLoginView->GetNewPass());
					
					if($newPass !== $notStriptNewPass){
						$this->classLoginView->setPostMessage(\loginView\LoginView::UPDATE_NO_VALID_PASS);
					}
					
					else if($this->NewUserController($newPass)){
							
						$userSessName = $this->classLoginModel->GetSessionUserName();
						$this->classLoginModel->UpdateUser($newPass, $userSessName);
						$this->classLoginView->setPostMessage(\loginView\LoginView::UPDATE_PASSWORD_SUCCESS);
						return true;
					}
				}
				$this->html = $this->classLoginView->UpdateUser();
			}
		}
		
		/**
		 * Skötter meddelandena för det nya lösenordet
		 */
		private function NewUserController($newPass){
			
			if(empty($newPass)){
						$this->classLoginView->setPostMessage(\loginView\LoginView::UPDATE_MISSING_PASSWORD);
				return false;
			}
			if( 6 > (strlen($newPass))){
						$this->classLoginView->setPostMessage(\loginView\LoginView::UPDATE_PASSWORD_TO_SHORT);
				return false;
			}
			else{
				return true;
			}
		}
	}