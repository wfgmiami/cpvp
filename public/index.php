<?php
// Controler
	
	require_once("../classes/class.Authentication.php");	
	require_once("../classes/class.Session.php");
	require_once("../classes/class.Database.php");
	require_once("../classes/class.Logging.php");
	
	$Session 		= new TSession();
	$Authentication = new TAuthentication();   	
	$Database 		= new TDatabase();
	$Logging 		= new TLogging();

	$Logging->log("Starting script.");
	
	$ControllerVars['loggedin'] = 0;	
	
	if ($Authentication->isAuthorized()) {
   	   	// logged in
    		$ControllerVars['loggedin'] = 1;
   	} else {
		if ($_POST['submit'] == 'Submit') {
			if ($Authentication->checkUserPass()) {
				$ControllerVars['loggedin'] = 1;
				$Authentication->successfulLogin();				
			} else {
				$Authentication->failedLogin();		
			}
		} 			
	}
	echo "Login status is: ".$ControllerVars['loggedin'];
	if ($ControllerVars['loggedin'] == 0) {		
		$content = file_get_contents("../templates/loginform.html");
		echo $content;			 	
	}		
	die;
	
	if ($_SERVER['REQUEST_URI'] !== '/'){
    	$content = file_get_contents("../templates/index.html");
		preg_match('!name/([a-z]+)!imsx',$_SERVER['REQUEST_URI'], $pmatches);
		$content = str_replace('{text}','Hello '. $pmatches[1], $content);	
		echo $content;
   	} else {
      	       echo "you are not on the home page";
   	}			
