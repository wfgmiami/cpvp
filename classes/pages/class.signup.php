<?php 

	class TPageClass {
		function __construct($className) {
		    // echo "signup class";
			// echo "<br />";
			
			if (file_exists("../templates/pages/".$className.".html")) {		
				$content = file_get_contents("../templates/pages/".$className.".html");
				echo $content;
			} else {
				echo "Page content not found.";
			}
		}
	}
