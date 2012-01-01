<?php 
require_once dirname(__FILE__).'/Core/SearchEngine.php';
require_once dirname(__FILE__).'/SearchIncludeValidator.class.php';
/**
 * 
 * @author mimiz.fr
 *
 */
class SearchIncludePlugin
{
	private $_pluginsDir = null;
	
	/**
	 * Plugin Constructor
	 */
	public function __construct($is_admin)
	{
		$this->_pluginsDir = dirname(__FILE__);
		if( $is_admin ) {
			add_action('admin_menu', array(&$this,'addMenuPage') );
			add_action( 'admin_init', array(&$this,'registerSettings' ) );
		}
		wp_enqueue_style('search-include-base',self::getDefaultStyle());
		wp_enqueue_style('search-include-theme',self::getStyle());
		
	}
	
	public function registerSettings() {
		register_setting( 'search-include', 'search-include-engines', 'SearchIncludeValidator::urls');
	}
	
	public function addMenuPage() {
		add_options_page(__('Search Include', 'search-include'), __('Search Include', 'search-include'), 'manage_options', 'searchincludesettings', array(&$this, 'showOptionPage'));
	}
	
	public function showOptionPage () {
		ob_start();
		include_once(dirname(__FILE__).'/option_page.php');
		$options = ob_get_contents();
		ob_end_clean();
		echo $options;
	}
	
	/**
	 * Load a search Engine object from its name
	 * 
	 * @param string $name
	 * @return SearchEngine
	 */
	public function loadEngine($name) {
		$base_dir = $this->_pluginsDir . '/searchengines';
		$file = $base_dir . '/'.$name.'.php';
		//var_dump($file);
		if (file_exists($file)) {
			require_once $file;
			return new $name();
		}
		return null;
	}
	/**
	 * 
	 * Enter description here ...
	 */
	public static function includeSearch ()
	{
// 		wp_enqueue_style('search-include-base',self::getDefaultStyle());
// 		wp_enqueue_style('search-include-theme',self::getStyle());
		$self = new SearchIncludePlugin(false);
		$values = get_option("search-include-engines", array());
		
		$content = '<div id="search-includes">';
		foreach ($values as $engine ) {
			$e = $self->loadEngine($engine);
			$content .= '<div>';
			$content .= '<div class="search-include-engine">
							<strong>'.$e->getName().'</strong> : <a href="'.sprintf($e->getUrl(),get_search_query()).'" target="_blank">'.__('See Search ...', 'search-include').'</a>
						</div>';
			$content .= $e->search(get_search_query());
			$content .= '</div>';
		}
		$content .= '</div>';
		// need to look for includes urls
		// foreach urls i'll wrote a search results block (maybe autohide some of them)
		
		return '<h2 class="search-include-title">'.__('Search Include Results', 'search-include').'</h2>' . $content ;
		 
	}
	
	public static function getDefaultStyle() {
		return WP_PLUGIN_URL . '/search-include/themes/search-include.css';
	}
	public static function getStyle() {
		return WP_PLUGIN_URL . '/search-include/themes/'.get_template().'.css';
	}
}

?>