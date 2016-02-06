<?php

	
	require_once("../classes/class.Authentication.php");	
	class TParseURI {
		function __construct($uri) {
			$this->Authentication = new TAuthentication();   	
			$this->doAuthentication();
			
			preg_match('!^/([^/]+)!ismx', $uri, $pmatches);
		
			$className = $pmatches[1];
			
			if (strlen($className) > 32) {
				die("unexpected error");
			}
					
			$className = preg_replace('![^a-z0-9]!ismx', '', $className);
			
			if (file_exists("../classes/pages/class.".$className.".php")) {
				require_once("../classes/pages/class.".$className.".php");
				$pageClass = new TPageClass($className);
				
			 } else {
					die('page not found');
			}
							 


			// Root URL  : http://www.cpvp.com/	
			if ($uri == '/') {
				$this->pageName = 'root';
			}

			// /signup   : http://www.cpvp.com/signup
			if ($uri == '/signup') {
				$this->pageName = 'signup';
			}

			// /login   : http: //www.cpvp.com/login
		    if ($uri == '/login') {
			 	$this->pageName = 'login';
			}			
			
		}
		
		function getPageName(){
			return $this->pageName;
		}

		function doAuthentication() {
			if ($_POST['submit'] == 'Submit') {
				
				if ($this->Authentication->checkUserPass()) {
					$ControllerVars['loggedin'] = 1;
					$this->Authentication->successfulLogin();				
				} else {
					$this->Authentication->failedLogin();		
				}
			}	
			
			$ControllerVars['loggedin'] = 0;

		   // if ($this->Authentication->isAuthorized()) {
			  if ($_SESSION['loggedin']) {
	   		   // logged in
					$ControllerVars['loggedin'] = 1;
			} else {
				// not logged in

			}
		
			if ($ControllerVars['loggedin'] == 0) {		
			  //echo "Not logged in <br />";
			} else {
			//	echo "Logged in <br />";
			}
			
		}

	}
