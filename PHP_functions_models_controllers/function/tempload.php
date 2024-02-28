<?php 
	function TempLoad($name, $tempVars){
		extract($tempVars);
		ob_start();
		require $name;
		$content = ob_get_clean();
		return $content;
	}
?>