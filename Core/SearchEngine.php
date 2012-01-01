<?php
class SearchEngine {

	protected $_hide = false;
	protected $_group = '';
	protected $_name;
	protected $_description;
	protected $_url;
	protected $_content_id;
	protected $_navigation_id;

	/** Methods **/

	/**
	 * This method is used to execute search on a search engine
	 * 
	 * @param String $term the search string
	 */
	public function search($term) {
		
		$url = sprintf($this->_url, urlencode($term));
		$content = file_get_contents($url);
		libxml_use_internal_errors(false);
		$doc = new DOMDocument();
		@$doc->loadHTML($content);
		if ($this->_content_id ) {
			$element = $doc->getElementById($this->_content_id);
			
			$innerHTML = "";
			$xpath = new DOMXPath($doc);
			$children = $xpath->query($this->_xpath_for_results);
			foreach ($children as $child) {
				$desc = $xpath->query('.'.$this->_xpath_for_description, $child);
				$title = $xpath->query('.'.$this->_xpath_for_link, $child);
				$url = $xpath->query('.'.$this->_xpath_for_url, $child);
				$tmp_dom = new DOMDocument();
				if ($title->length > 0) {
					$tmp = $xpath->query('.//a', $title->item(0));
					// look for title and url
					$href = $tmp->item(0)->attributes->getNamedItem('href')->nodeValue;
					$text = $title->item(0)->textContent;
					// create title div
					$titleDiv = $tmp_dom->createElement('div');
					$titleDiv->setAttribute('class', 'search-include-result');
					$aDiv = $tmp_dom->createElement('a');
					$aDiv->setAttribute('href', $href);
					$aDiv->setAttribute('target', '_blank');
					$aDiv->appendChild($tmp_dom->createTextNode($text));
					$h3Div = $tmp_dom->createElement('h3');
					$h3Div->setAttribute('class', 'search-include-title');
					$h3Div->appendChild($aDiv);
					$titleDiv->appendChild($h3Div);
					$tmp_dom->appendChild($titleDiv);
					if ($desc->length > 0) {
						/*
						 $tmp_dom->createElement(
						 */
						$descDiv = $tmp_dom->createElement('div');
						$descDiv->setAttribute('class', 'search-include-description');
						$descdd = $tmp_dom->importNode($desc->item(0), true);
						$descDiv->appendChild($tmp_dom->createTextNode($descdd->textContent));
						$titleDiv->appendChild($descDiv);
					}
					if ($url->length > 0) {
						// 		        		$tmp_dom->appendChild($tmp_dom->importNode($url->item(0), true));
						$dDiv = $tmp_dom->createElement('div');
						$dDiv->setAttribute('class', 'search-include-url');
						$ddd = $tmp_dom->importNode($url->item(0), true);
						$dDiv->appendChild($ddd);
						$titleDiv->appendChild($dDiv);
					}
				}
				$innerHTML .= trim($tmp_dom->saveHTML());
			}
			return $innerHTML;
		}
		return 'ERROR'.$this->_name;
	}

	/** STATIC FUNCTION **/

	public static function getAllSearchEngines() {
		$engines = glob(dirname(__FILE__).'/../searchengines/*.php');

		$ret = array();
		foreach ($engines as $engineName) {
			// extract name
			include_once $engineName;
			$file_name = substr($engineName, strrpos($engineName, '/') + 1);
			$name = substr($file_name, 0, strrpos($file_name, '.'));
			array_push($ret, new $name());
		}
		return $ret;

	}

	public static function getAllSearchEnginesName() {
		$engines = glob(dirname(__FILE__).'/../searchengines/*.php');

		$ret = array();
		foreach ($engines as $engineName) {
			// extract name
			$file_name = substr($engineName, strrpos($engineName, '/') + 1);
			$name = substr($file_name, 0, strrpos($file_name, '.'));
			array_push($ret, $name);
		}
		return $ret;
	}

	/** GETTERS AND SETTERS **/

	public function getHide() {
		return $this->_hide;
	}

	public function setHide($hide) {
		$this->_hide = $hide;
	}

	public function getName() {
		return $this->_name;
	}

	public function setName($name) {
		$this->_name = $name;
	}

	public function getDescription() {
		return $this->_description;
	}

	public function setDesription($description) {
		$this->_description = $description;
	}

	public function getGroup() {
		return $this->_group;
	}

	public function setGroup($group) {
		$this->_group = $group;
	}

	public function getUrl() {
		return $this->_url;
	}

	public function setUrl($url) {
		$this->_url = $url;
	}

	/** SERIALIZATION **/

	public function __sleep() {

	}

	public function __wakeup() {

	}
}
