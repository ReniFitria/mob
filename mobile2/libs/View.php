<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.html';	
		}
		else {
			//require 'views/header.php';
			require 'views/' . $name . '.html';
		//	require 'views/footer.php';	
		}
	}
}