<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://heyloyalty.com
 * @since      0.1
 *
 * @package    Wp_Heyloyalty
 * @subpackage Wp_Heyloyalty/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Heyloyalty
 * @subpackage Wp_Heyloyalty/admin
 * @author     René Skou rs@arnsbomedia.com
 */
class Wp_Heyloyalty_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    0.1
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $wp_heyloyalty;

    /**
     * The version of this plugin.
     *
     * @since    0.1
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * @since 1.0.0
     * @access private
     * @var string $option_name Option name of this plugin
     */
    private $option_name = 'heyloyalty';

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($wp_heyloyalty, $version)
    {

        $this->wp_heyloyalty = $wp_heyloyalty;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         * f         */

        wp_enqueue_style($this->wp_heyloyalty, plugin_dir_url(__FILE__) . 'css/wp-heyloyalty-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->wp_heyloyalty, plugin_dir_url(__FILE__) . 'js/wp-heyloyalty-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * add menu for plugin under settings in wp-admin
     */
    public function add_submenu()
    {

        add_submenu_page('options-general.php', 'wp-heyloyalty', 'wp-heyloyalty', 'manage_options', 'wp_heyloyalty', array(&$this, 'add_submenu_callback'));
    }

    /**
     * handler for main page view
     */
    public function add_submenu_callback()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/plugin-wp-heyloyalty-display.php';
    }

    /**
     * handler for settings on main page
     */
    public function register_setting()
    {
        add_settings_section($this->option_name . '_general', __('General', 'heyloyalty-api'),
            array($this, $this->option_name . '_general_api'), $this->wp_heyloyalty);
    }

    /**
     *
     */
    public function heyloyalty_general_api()
    {

    }

}
