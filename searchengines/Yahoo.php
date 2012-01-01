<?php
require_once dirname(__FILE__).'/../Core/SearchEngine.php';
class Yahoo extends SearchEngine {
	protected $_name = "Yahoo";
	protected $_description = "The Yahoo Search Engine";
	protected $_url = "http://fr.search.yahoo.com/search?p=%s";
	protected $_content_id = 'main';
	protected $_navigation_id = 'pg';
	protected $_xpath_for_results ='//div[@id="main"]/div[@id="web"]/ol/li'; // from _content_id
	protected $_xpath_for_link ='//h3';
	protected $_xpath_for_description ='//div[@class="abstr"]';
	protected $_xpath_for_url ='//span[@class="url"]';
}