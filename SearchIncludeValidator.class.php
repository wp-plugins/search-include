<?php
class SearchIncludeValidator {
	
	
	public static function urls($input) {
		$engines = SearchEngine::getAllSearchEnginesName();
		foreach($input as $name) {
			if (! in_array($name, $engines)) {
				throw new Exception("Include Search $name is not a valid search Engine");
			}
		}
		return $input;
	}
}