=== Plugin Name ===
Contributors: mimiz.fr
Donate link: http://www.mimiz.fr/
Tags: include search engine results
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 1.0.3
Add Search results from other sites when searching the blog !

== Description ==

This plugin allows you to include search results from other Search engine (such as Google, Bing, Yahoo ...) in your blog.
In order to use this plugin, you need to add a call to the function _search_include_plugin() in your search result template file (search.php)
You need to add the function call in the main div (id depends on your theme), for the default WP 3.3 theme (Twenty Eleven 1.2 by the WordPress team)  :
You need to edit the file search.php in the theme editor, and at the end of the file just replace : 

			<?php endif; ?>
    		</div>
    	</div>
    
        <?php get_sidebar(); ?>
<?php get_footer(); ?>

by 

			<?php endif; ?>
			<?php echo_search_include_plugin(); ?>
    		</div>
    	</div>
        <?php get_sidebar(); ?>
<?php get_footer(); ?>

You can add specific Search Engines (see the documentation to see how to do that).

== Installation ==

1. Download search-include zip archive
1. Extract the `search-include` directory
1. Upload the directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Settings > Search Include choose search engines to include
1. Modify the search results file of your theme as shown in the documentation
1. Test installation and configuration by doing a search on your blog

== Frequently Asked Questions ==

= When i do a search i have an eriror : failed to open stream: HTTP request failed! HTTP/1.0 503 Service Unavailable in =
 This error mean that your php.ini directive allow_url_include is set to Off. Many hosting providers disable this directive for security reasons.
 I’m trying to find a solution …

= what's next ? =
 * It will be possible to sort the way search engines appear.
 * Use of an accordion for hiding some engine(s).
 
== Screenshots ==

No screenshot for the moment

== Upgrade Notice ==

 Nothing To say

== Changelog ==

= 1.0.3 =
* First version of the plugin
