<?php

class View{
	public static function createView($view, $param){
		foreach ($param as $key => $value) {
			$$key = $value;
		}

		$upPrefix = "";
		if (isset($uplevel)){
			for ($i = 0; $i<$uplevel; $i++){
				$upPrefix .= '../';
			}
		}

		ob_start();
		include 'view/'.$view;
		$content = ob_get_contents();
		ob_end_clean();
		
		ob_start();
		include 'view/layout/layout.php';
		$include = ob_get_contents();
		ob_end_clean();
		return $include;
	}
}
?>