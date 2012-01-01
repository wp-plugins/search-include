<?php
require_once dirname(__FILE__).'/../Core/SearchEngine.php';
class Bing extends SearchEngine {
	protected $_name = "Bing";
	protected $_description = "The Microsfot Search Engine";
	protected $_url = "http://www.bing.com/search?q=%s";
	protected $_content_id = 'results_area';
	protected $_navigation_id = null; // navigation is included in result area
	protected $_xpath_for_results ='//div[@id="results"]//li';
	protected $_xpath_for_link ='//h3';
	protected $_xpath_for_description ='//p';
	protected $_xpath_for_url ='//cite';
}