<?php
/*
Plugin Name: Forest Themes List
Plugin URI: http://www.mediaclaim.it/forest-themes-list-wp-plugin/
Description: Forest Themes List è un plugin NON UFFICIALE della EnvantoMarket che visualizza una galleria di temi di ThemeForest al fine di poter realizzare un preventivo per i propri clienti. ( Forest Themes List is an EnvantoMarket's UNOFFICIAL plugin that show a gallery themes from ThemeForest to be able to create a pricing for its customers. ) - SHORTCODE: [ftl_gallery]
Version: 0.1
Author: MediaClaim (Fabrizio Zippo)
Author URI: http://www.mediaclaim.it
Requires at least: 4.0
Tested up to: 4.1
Tags: gallery, themeforest, evanto, template, theme
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo __( 'Questo è un plugin di Wordpress, non puoi accedervi direttamente.', 'forest-themes-list' );
	exit;
}

class Forest_Themes_List {
	
	/**
   * FTL Options object
   *
   * @access    private
   * @since     0.1
   *
   * @var       array
   */
  public $ftl_options;
	/**
   * PHP5 constructor method.
   *
   * This method adds other methods to specific hooks within WordPress.
   *
   * @uses      add_action()
   *
   * @access    public
   * @since     0.1
   *
   * @return    void
   */
  public function __construct() {
    $this->_constants();
    $this->_includes();
    $this->_hooks();
  }
  
  /**
   * Defines the constants for use within the plugin.
   *
   * @access    private
   * @since     0.1
   *
   * @return    void
   */
  protected function _constants() {
	/* Plugin Name */
    define( '_FTL_PLUGIN_NAME', 'Forest Themes List' );
	/* Plugin Version */
    define( '_FTL_PLUGIN_VER', '0.1' );
	/* Plugin Directory Path */  
	define( "_FTL_PLUGIN_DIR", plugin_dir_path( __FILE__ ) );
	/* Plugin Directory URL */
	define( "_FTL_PLUGIN_URL", plugin_dir_url( __FILE__ ) ); 
	/* Plugin Slug */
    define( '_FTL_PLUGIN_SLUG', 'forest-themes-list' );
  }
  
  /**
   * Include required files
   *
   * @since     0.1
   * @access    private
   *
   * @return    void
   */
  protected function _includes() {
    /* load required files 
	$include = array();
    foreach ( $include as $file )
      require_once( _FTL_PLUGIN_DIR . 'includes/' . $file . '.php' );*/
  }
  
  /**
   * Setup the default filters and actions
   *
   * @uses      add_action()  To add various actions
   *
   * @access    private
   * @since     0.1
   *
   * @return    void
   */
  protected function _hooks() {  
    /* Show ThemeForest WP Themes Gallery */
	add_shortcode( 'ftl_gallery', array( $this, 'ftl_gallery' ) );
	/* Load text domain */
    add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) );
	/* Add admin menu */
	add_action( 'admin_menu', array( $this, 'ftl_menu' ), 101 );
	/* Loaded during admin init */
    add_action( 'admin_init', array( $this, 'ftl_admin_init' ) );
	$this->ftl_options = get_option( _FTL_PLUGIN_SLUG );
  }
  
  /**
     * Loads the text domain.
     *
     * @return    void
     *
     * @access    private
     * @since     0.1
     */
    public function _load_textdomain() {

      load_plugin_textdomain( 'forest-themes-list', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
      
    }
  
  /**
   * Show ThemeForest WP Themes
   *
   * @uses      add_action()  To add various actions
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_gallery($atts){
	$ftl_category = !empty($atts['category']) ? $atts['category'] : 'wordpress' ; 
	$ftl_selectedTheme_input = !empty($atts['input']) ? $atts['input'] : NULL ;
	$ftl_options = $this->ftl_options;
	/* Load scripts */
	wp_enqueue_script( 'jquery-webui-popover-js', _FTL_PLUGIN_URL . 'js/jquery.webui-popover.min.js', array('jquery','jquery-ui-tooltip'), _FTL_PLUGIN_VER, true ); 
	wp_register_script( 'forest-themes-list-js', _FTL_PLUGIN_URL . 'js/forest-themes-list.js', false , _FTL_PLUGIN_VER, true ); 
	/* Translation array for forest-themes-list.js */
	$translation_array = array( 
							"ftl_bt_seleziona" => __('Seleziona','forest-themes-list'),
							"ftl_selected_theme" => __('Hai selezionato il tema','forest-themes-list'),
							"ftl_return" => __('Ritorna ai temi','forest-themes-list')
							);
	wp_localize_script( 'forest-themes-list-js', 'ftl_lang', $translation_array );
	wp_enqueue_script( 'forest-themes-list-js' );
	/* Load Styles */
	 wp_enqueue_style( 'jquery-webui-popover-css', _FTL_PLUGIN_URL . 'css/jquery.webui-popover.min.css', false, _FTL_PLUGIN_VER, 'all' );
	 wp_enqueue_style( 'forest-themes-list-css', _FTL_PLUGIN_URL . 'css/forest-themes-list.css', false, _FTL_PLUGIN_VER, 'all' );
	 wp_enqueue_style( 'dashicons' );
	 /* Shortcode output */
	require (_FTL_PLUGIN_DIR."templates/gallery.php");
	return $html_shortcode;
  } 
  
   /**
   * Adds the FTL menu item
   *
   * @access    private
   * @since     1.0
   *
   * @return    void
   */
  public function ftl_menu() {    
    add_options_page( _FTL_PLUGIN_NAME, _FTL_PLUGIN_NAME, 'manage_options', _FTL_PLUGIN_SLUG, array( $this, 'ftl_menu_page' ) );   
  }
  
  /**
   * FTL Admin Options Page
   *
   * @access    private
   * @since     0.1
   *
   * @return    string    Returns the verification form & themes list
   */
  public function ftl_menu_page() {
    if ( ! current_user_can( 'manage_options' ) )
      wp_die( __( 'Non hai sufficienti permessi per accedere a questa pagina.', 'forest-themes-list' ) ); 
	  
	/* read in existing API value from database */
    $options = $this->ftl_options;

    /* display environment errors */
    if ( ! empty( $options['ftl_errors'] ) ) {
      foreach ( $options['ftl_errors'] as $k => $v ) {
        if ( empty( $options['dismissed_errors'][$k] ) ) {
          echo '<div class="error below-h2">' . $v . '</div>';
        }
      }
    }
	
	$user_name = ( isset( $options['user_name'] ) ) ? $options['user_name'] : '';
	  
    require (_FTL_PLUGIN_DIR."templates/admin-option-page.php");

  }
  
  /**
   * Registers the settings for the updater
   *
   * @access    private
   * @since     0.1
   *
   * @return    void
   */
  public function ftl_admin_init() {
    //$this->_admin_update_check();
    //$this->_admin_init_before();
    register_setting( _FTL_PLUGIN_SLUG, _FTL_PLUGIN_SLUG );
    add_settings_section( 'ftl_field_evanto_username_description', __( 'Informazioni Account Evanto', 'forest-themes-list' ), array( $this, 'ftl_field_evanto_username_description' ), _FTL_PLUGIN_SLUG );
	add_settings_field( 'user_name', __( 'Evanto Username', 'forest-themes-list' ), array( $this, 'ftl_field_evanto_username_input' ), _FTL_PLUGIN_SLUG, 'ftl_field_evanto_username_description' );
	add_settings_section( 'ftl_field_price_description', __( 'Informazioni Cambio Valuta', 'forest-themes-list' ), array( $this, 'ftl_field_price_description' ), _FTL_PLUGIN_SLUG );
	add_settings_field( 'price_change', __( '1$ equivale a', 'forest-themes-list' ), array( $this, 'ftl_field_price_change_input' ), _FTL_PLUGIN_SLUG, 'ftl_field_price_description' );
	add_settings_field( 'price_symbol', __( 'in', 'forest-themes-list' ), array( $this, 'ftl_field_price_symbol_input' ), _FTL_PLUGIN_SLUG, 'ftl_field_price_description' );
	add_settings_section( 'ftl_field_form_description', __( 'Opzioni Avanzate', 'forest-themes-list' ), array( $this, 'ftl_field_form_description' ), _FTL_PLUGIN_SLUG );
	add_settings_field( 'ftl_field_active_form', __( 'Attiva la selezione', 'forest-themes-list' ), array( $this, 'ftl_field_active_form' ), _FTL_PLUGIN_SLUG, 'ftl_field_form_description' );
  }
  
  /**
   * Evanto Username description
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_evanto_username_description() {
    _e( 'Se hai un account Evanto, puoi inserire qu&igrave; il tuo username, così da poter guadagnare con l\'<a href="http://themeforest.net/make_money/affiliate_program" target="_blank">affiliazione ad EvantoMarket</a>. (<a href="https://account.envato.com/sign_in?to=themeforest" target="_blank">Evanto login</a>)', 'forest-themes-list' );
  }
  
  /**
   * Evanto Username text field
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_evanto_username_input() {
    $options = $this->ftl_options;
    echo '<input type="text" class="regular-text" name="' . _FTL_PLUGIN_SLUG . '[user_name]" value="' . esc_attr( $options['user_name'] ) . '" />';
  }
  
   /**
   * Currency Exchange description
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_price_description() {
    _e( 'Indica quì di seguito le informazioni per il cambio valuta. Es. 1$ equivale a 0.82 in €. (Per conoscere il cambio valuta vai su <a href="http://www.valute.it/" target="_blank">http://www.valute.it/</a>)', 'forest-themes-list' );
  }
  
  /**
   * Currency Exchange value
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_price_symbol_input() {
    $options = $this->ftl_options;
    echo '<input type="text" class="regular-text" name="' . _FTL_PLUGIN_SLUG . '[price_symbol]" value="' . esc_attr( $options['price_symbol'] ) . '" placeholder="€" style="width:7em" />';
  }
  
  /**
   * Currency Symbol
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_price_change_input() {
    $options = $this->ftl_options;
    echo '<input type="text" class="regular-text" name="' . _FTL_PLUGIN_SLUG . '[price_change]" value="' . esc_attr( $options['price_change'] ) . '" placeholder="00.00" style="width:7em" /><p class="description">'. __('Usa il punto per separare i decimali.','forest-themes-list').'</p>';
  }
  
  /**
   * Form Options Description
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_form_description() {
    _e( 'Abilitando questa opzione verrà visualizzato il pulsante di selezione del template che invia il riferimento al modulo successivo per un\'eventuale richiesta di preventivo.', 'forest-themes-list' );
  }
  
  /**
   * Active select button for send selected theme to next form
   *
   * @access    private
   * @since     0.1
   *
   * @return    string
   */
  public function ftl_field_active_form() {
    $options = $this->ftl_options;
    $html = '<input type="checkbox" id="active_form" name="' . _FTL_PLUGIN_SLUG . '[active_form]" value="1"' . checked( 1, $options['active_form'], false ) . '/>';
    $html .= '<label for="active_form">'.__('Visualizza il bottone <b>Seleziona</b> per inviare i dati al modulo successivo.','forest-themes-list').'</label>';

    echo $html;
  }
	
}

/**
 * Instantiates the Class
 *
 * @since     0.1
 * @global    object
 */
$Forest_Themes_List = new Forest_Themes_List();


?>