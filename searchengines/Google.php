<?php
require_once dirname(__FILE__).'/../Core/SearchEngine.php';

class Google extends SearchEngine {
	
	protected $_name = "Google";
	protected $_description = "The Main Search Engine";
	protected $_url = 'http://www.google.com/search?q=%s';
	protected $_content_id = 'center_col';
	protected $_navigation_id = 'nav';
	protected $_xpath_for_results ='//div[@id="res"]//ol/li'; // from _content_id
	protected $_xpath_for_link ='//h3[@class="r"]';
	protected $_xpath_for_description ='//div[@class="s"]';
	protected $_xpath_for_url ='//cite';
}