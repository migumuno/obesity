/*
Plugin Name: Redirect Main Site To Sub-Site
Description: Redirect 'main-site' to 'main-site/sub-site/'
Version: 0.1
Author: WPSE
Author URI: http://www.obesity.es
License: GPL2
*/

add_action('parse_request', 'redirect_to_sub_site');
function redirect_to_sub_site(){
    global $wp;
    if('main-site' === $wp->request){

        $url = 'http://www.obesity.es/blog/es/';

        wp_redirect($url, 301);

        exit;
    }
}