<?php /*
Plugin Name: WP Memory
Plugin URI: http://wpmemory.com
Description: Check For High Memory Usage, include result in the Site Health Page and Give Suggestions.
Version: 1.2
Author: Bill Minozzi
Domain Path: /language
Author URI: http://billminozzi.com
Text Domain: wpmemory
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}
// ob_start();
if (is_admin()) {
    add_action('admin_init', 'wpmemory_add_admstylesheet');
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'wp_memory_plugin_settings_link');
$wpmemory_memory['limit'] = (int) ini_get('memory_limit');
// Debug
//$wpmemory_memory['limit'] = 64;
// update_option('wp_memory_limit_option', '64');

if ($wpmemory_memory['limit'] < 128) {
    $wp_memory_limit_option =   get_option('wp_memory_limit_option');
    if ($wp_memory_limit_option > $wpmemory_memory['limit'])
        $wpmemory_memory['limit'] = $wp_memory_limit_option;
}
$wpmemory_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
if (!is_numeric($wpmemory_memory['usage']) or $wpmemory_memory['usage'] < 1) {
    $wpmemory_memory['usage'] = 1;
}
$wpmemory_mb = 'MB';
if (defined("WP_MEMORY_LIMIT")) {
    $wpmemory_memory['wp_limit'] = trim(WP_MEMORY_LIMIT);
    $wpmemory_memory['wp_limit'] = substr($wpmemory_memory['wp_limit'], 0, strlen($wpmemory_memory['wp_limit']) - 1);
} else {
    $wpmemory_memory['wp_limit'] = 40;
}
if (!is_numeric($wpmemory_memory['wp_limit'])) {
    $wpmemory_memory['wp_limit'] = 40;
}
$perc = $wpmemory_memory['usage'] / $wpmemory_memory['wp_limit'];
// $perc = 100;
if ($perc > .7) {
    $wpmemory_memory['color'] = 'red';
} else {
    $wpmemory_memory['color'] = 'green';
}
$wpmemory_usage_content = __('Current memory WordPress Limit', 'wpmemory') . ': ' . $wpmemory_memory['wp_limit'] . $wpmemory_mb . '&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;';
$wpmemory_usage_content .= '<span style="color:' . $wpmemory_memory['color'] . ';">';
$wpmemory_usage_content .= 'Your usage now: ' . $wpmemory_memory['usage'] .
    'MB &nbsp;&nbsp;&nbsp;';
$wpmemory_usage_content .= '</span>';
$wpmemory_usage_content .= '<br />';
$wpmemory_usage_content .= '</strong>';
if ($perc > .7) {
    $wpmemory_label = 'Critical';
    $wpmemory_status = 'critical';
    $wpmemory_description = $wpmemory_usage_content . sprintf('<p>%s</p>', __('Run your site with High Memory Usage, can result in behaving slowly, or pages fail to load, you get random white screens of death or 500 internal server error. Basically, the more content, features and plugins you add to your site, the bigger your memory limit has to be. Increase the WP Memory Limit is a standard practice in WordPress. You can manually increase memory limit in WordPress by editing the wp-config.php file. You can find instructions in the official WordPress documentation (Increasing memory allocated to PHP). Just click the link below: ', 'wpmemory'));
    $wpmemory_actions = sprintf('<p><a href="%s">%s</a></p>', 'https://codex.wordpress.org/Editing_wp-config.php', __('WordPress Help Page', 'wpmemory'));
} else {
    $wpmemory_label = 'Performance';
    $wpmemory_status = 'good';
    $wpmemory_description = __('Pass', 'wpmemory') . '.';
    $wpmemory_actions =     '';
}
add_filter('site_status_tests', 'wpmemory_add_memory_test');
register_activation_hook(__FILE__, 'wpmemory_activation');
add_filter('debug_information', 'wpmemory_add_debug_info');
register_activation_hook(__FILE__, 'wpmemory_admin_notice_activation_hook');
add_action('wp_loaded', 'wp_memory_init');
add_action('admin_notices', 'wp_memory_activ_message');
if (isset($_GET['page']) && $_GET['page'] == 'wp_memory_admin_page') {
    if (isset($_POST['process']) && $_POST['process'] == 'wp_memory_admin_page') {
        //get limit
        if (isset($_POST['wp_memory_checkbox'])) {
            $wp_memory_limit = sanitize_text_field($_POST['wp_memory_checkbox']);
            //update options
            if ($wp_memory_limit == '1')
                update_option('wp_memory_limit_option', '128');
        }
    }
}
function wpmemory_memory_test()
{
    global $wpmemory_memory, $wpmemory_usage_content, $wpmemory_label, $wpmemory_status, $wpmemory_description, $wpmemory_actions;
    $result = array(
        'badge' => array(
            'label' => $wpmemory_label,
            'color' => $$wpmemory_memory['color'],
        ),
        'test' => 'wpmemory_test',
        // status: Section the result should be displayed in. Possible values are good, recommended, or critical.
        'status' => $wpmemory_status,
        'label' => __('Memory Usage', 'wpmemory'),
        'description' => $wpmemory_description . '  ' . $wpmemory_usage_content,
        'actions' => $wpmemory_actions
    );
    return $result;
}
function wpmemory_add_debug_info($debug_info)
{
    global $wpmemory_usage_content;
    $debug_info['wpmemory'] = array(
        'label' => __('Memory Usage', 'wpmemory'),
        'fields' => array(
            'memory' => array(
                'label' => __('Memory Usage information', 'wpmemory'),
                'value' => strip_tags($wpmemory_usage_content),
                'private' => true
            )
        )
    );
    return $debug_info;
}
function wpmemory_activation()
{
    global $wp_version;
    if (version_compare(PHP_VERSION, '5.3', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        load_plugin_textdomain('wpmemory', false, dirname(plugin_basename(__FILE__)) . '/language/');
        $plugin_data    = get_plugin_data(__FILE__);
        $plugin_version = $plugin_data['Version'];
        $plugin_name    = $plugin_data['Name'];
        wp_die('<h1>' . __('Could not activate plugin: PHP version error', 'wpmemory') . '</h1><h2>PLUGIN: <i>' . $plugin_name . ' ' . $plugin_version . '</i></h2><p><strong>' . __('You are using PHP version', 'wpmemory') . ' ' . PHP_VERSION . '</strong>. ' . __('This plugin has been tested with PHP versions 5.3 and greater.', 'wpmemory') . '</p><p>' . __('WordPress itself <a href="https://wordpress.org/about/requirements/" target="_blank">recommends using PHP version 7 or greater</a>. Please upgrade your PHP version or contact your Server administrator.', 'wpmemory') . '</p>', __('Could not activate plugin: PHP version error', 'wpmemory'), array(
            'back_link' => true
        ));
    }
    if (version_compare($wp_version, '5.2') < 0) {
        deactivate_plugins(plugin_basename(__FILE__));
        load_plugin_textdomain('wpmemory', false, dirname(plugin_basename(__FILE__)) . '/language/');
        $plugin_data    = get_plugin_data(__FILE__);
        $plugin_version = $plugin_data['Version'];
        $plugin_name    = $plugin_data['Name'];
        wp_die('<h1>' . __('Could not activate plugin: WordPress need be 5.2 or bigger.', 'wpmemory') . '</h1><h2>PLUGIN: <i>' . $plugin_name . ' ' . $plugin_version . '</i></h2><p><strong>' . __('Please, Update WordPress to Version 5.2 or bigger to use this plugin.', 'wpmemory') . '</strong>', array(
            'back_link' => true
        ));
    }
}
function wp_memory_activ_message()
{
    if (get_transient('wpmemory-admin-notice')) {
        echo '<div class="updated"><p>';
        $bd_msg = '<h2>';
        $bd_msg .= __('WP Memory  Plugin was activated!', "antihacker");
        $bd_msg .= '</h2>';
        $bd_msg .= '<h3>';
        $bd_msg .= __('For details and help, take a look at WP Memory  at your left menu, Tools', "antihacker");
        $bd_msg .= '<br />';
        $bd_msg .= ' <a class="button button-primary" href="admin.php?page=wp_memory_admin_page">';
        $bd_msg .= __('or click here', "antihacker");
        $bd_msg .= '</a>';
        echo $bd_msg;
        echo "</p></h3></div>";
        delete_transient('wpmemory-admin-notice');
    }
}
function wpmemory_admin_notice_activation_hook()
{
    /* Create transient data */
    set_transient('wpmemory-admin-notice', true, 5);
}
function wp_memory_init()
{
    add_management_page(
        'WP Memory',
        'WP Memory',
        'manage_options',
        'wp_memory_admin_page', // slug
        'wp_memory_admin_page'
    );
}
function wpmemory_check_memory()
{
    global $wpmemory_memory;
    $wpmemory_memory['limit'] = (int) ini_get('memory_limit');
    $wpmemory_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
    if (!defined("WP_MEMORY_LIMIT")) {
        $wpmemory_memory['msg_type'] = 'notok';
        return;
    }
    $wpmemory_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT);
    if ($wpmemory_memory['wp_limit'] > 9999999)
        $wpmemory_memory['wp_limit'] = ($wpmemory_memory['wp_limit'] / 1024) / 1024;
    if (!is_numeric($wpmemory_memory['usage'])) {
        $wpmemory_memory['msg_type'] = 'notok';
        return;
    }
    if (!is_numeric($wpmemory_memory['limit'])) {
        $wpmemory_memory['msg_type'] = 'notok';
        return;
    }
    if ($wpmemory_memory['usage'] < 1) {
        $wpmemory_memory['msg_type'] = 'notok';
        return;
    }
    $wplimit = $wpmemory_memory['wp_limit'];
    $wplimit = substr($wplimit, 0, strlen($wplimit) - 1);
    $wpmemory_memory['wp_limit'] = $wplimit;
    $wpmemory_memory['percent'] = $wpmemory_memory['usage'] / $wpmemory_memory['wp_limit'];
    $wpmemory_memory['color'] = 'font-weight:normal;';
    if ($wpmemory_memory['percent'] > .7) $wpmemory_memory['color'] = 'font-weight:bold;color:#E66F00';
    if ($wpmemory_memory['percent'] > .85) $wpmemory_memory['color'] = 'font-weight:bold;color:red';
    $wpmemory_memory['msg_type'] = 'ok';
    return $wpmemory_memory;
}
function wp_memory_admin_page()
{
    global $wpmemory_memory;
    //display form
    echo '<div class="wrap-wpmemory ">' . "\n";
    echo '<h2 class="title">PHP and WordPress Memory</h2>' . "\n";
    echo '<p class="description"> This plugin check For High Memory Usage and include the result in the Site Health Page.';
    echo 'This plugin also Check Memory status and allows you to increase the Php Server Memory without editing any file, if the value is less than 128MB.</p>' . "\n";
    $mb = 'MB';
    echo '<hr>';
    echo 'WordPress Memory Limit (*): ' . $wpmemory_memory['wp_limit'] . $mb .
        '&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;';
    $perc = $wpmemory_memory['usage'] / $wpmemory_memory['wp_limit'];
    if ($perc > .7)
        echo '<span style="color:' . $wpmemory_memory['color'] . ';">';
    echo 'Your usage now: ' . $wpmemory_memory['usage'] .
        'MB &nbsp;&nbsp;&nbsp;';
    if ($perc > .7)
        echo '</span>';
    echo '|&nbsp;&nbsp;&nbsp;   Total Php Server Memory (**): ' . $wpmemory_memory['limit'] .
        'MB';
    echo '<hr>';
    echo '<br />';
    echo '(*)Instructions to increase WordPress Memory Limit:';
    echo '<a href="http://wpmemory.com/fix-low-memory-limit/">Click Here to Tips</a>';
    echo '<br />';
    echo '<br />';
    echo '(**) The Total Php Server Memory is the PHP "Memory Limit" usually defined on your php.ini file.';
    echo '<a href="http://wpmemory.com/php-memory-limit/">Click Here to learn more</a>';
    if ($wpmemory_memory['limit'] < 128) {
        echo ' We can increase it without touch your php.ini file. Just mark below and click save changes.';
        echo '<form class="wpmemory -form" method="post" action="admin.php?page=wp_memory_admin_page">' . "\n";
        echo '<input type="hidden" name="process" value="wp_memory_admin_page"/>' . "\n";
        echo '<br />' . "\n";
        echo '<input type="checkbox" id="wp_memory_checkbox" name="wp_memory_checkbox" value="1">';
        echo '<label for="wp_memory_checkbox"> Increase the memory limit to 128 GB</label>';
        echo '<br />';
        echo '<br />';
        echo '<input class="wpmemory -submit" type="submit" value="Update" />';
        echo '</form>' . "\n";
    }
    echo '<div class="main-notice">';
    echo '</div>' . "\n";
    echo '</div>';
}
function wp_memory_plugin_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=wp_memory_admin_page">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
function wpmemory_add_admstylesheet()
{
    wp_register_style('wpmemory ', plugin_dir_url(__FILE__) . 'wpmemory.css');
    wp_enqueue_style('wpmemory ');
}
function wpmemory_add_memory_test($tests)
{
    $tests['direct']['wpmemory_plugin'] = array(
        'label' => __('WP Memory Test', 'wpmemory'),
        'test' => 'wpmemory_memory_test'
    );
    return $tests;
}
//$out = trim(ob_get_clean());
//var_dump($out);