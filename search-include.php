<?php
/*
Plugin Name: Search Include
Plugin URI: 
Description: Add search engines results in your wordpress search
Version: 1.0.3
Author: Rémi Goyard
Author URI: http://www.mimiz.fr/
*/
require_once 'SearchInclude.class.php';
require_once dirname(__FILE__).'/Core/SearchEngine.php';
new SearchIncludePlugin(is_admin());
function _search_include_plugin() {
	return SearchIncludePlugin::includeSearch();
}