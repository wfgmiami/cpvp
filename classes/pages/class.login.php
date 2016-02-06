<?php 

	class TPageClass {
		function __construct($className) {
			// echo "Login class";
			// echo "<br />";	
			$content = file_get_contents("../templates/pages/".$className.".html");
			echo $content;
		}
	}
