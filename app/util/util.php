<?php
class util{

	function arrayToXML($data, &$xml_data ) {
		foreach( $data as $key => $value ) {
			if( is_numeric($key) ){
				$key = 'item'.$key; //dealing with <0/>..<n/> issues
			}
			if( is_array($value) ) {
				$subnode = $xml_data->addChild($key);
				$this->arrayToXML($value, $subnode);
			} else {
				$xml_data->addChild("$key",htmlspecialchars("$value"));
			}
		}
	}
	
	function toLowerCase(&$id,&$route,&$id2,&$route2){
		if (!empty($id))
			$id = strtolower($id);
		if (!empty($route))
			$route = strtolower($route);
		if (!empty($id2))
			$id2 = strtolower($id2);
		if (!empty($route2))
			$route2 = strtolower($route2);
	}

}

?>