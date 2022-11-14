<?php
/**
 * Wow Company Class
 *
 * @package     Wow_Plugin
 * @subpackage  Includes/Wow_Company
 * @author      Dmytro Lobov <helper@wow-support.com>
 * @copyright   2019 Wow-Company
 * @license     GNU Public License
 * @version     1.0

 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates the menu in admin panel general for all Wow plugin
 *
 * @property string text_domain - Text domain for translate
 *
 * @since 1.0
 */
final class Wow_Company {
	
	public function __construct() {
		
		// Functions for Class
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'plugins_loaded', array( $this, 'plugin_check' ) );
		add_action('admin_enqueue_scripts', array( $this, 'admin_style') );
	}

	public function admin_style($hook) {

		wp_enqueue_style( 'wow-page', plugin_dir_url(__FILE__) .'about/style.css');

	}
	
	/**
	 * Register the plugin menu on sidebar menu in admin panel.
	 *
	 * @since 1.0
	 */
	public function add_menu() {
		$icon =
			'data:image/svg+xml;base64, PHN2ZyB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPHRpdGxlPldPVyBMT0dPPC90aXRsZT4KICAgIDxkZWZzPgogICAgICAgIDxsaW5lYXJHcmFkaWVudCB4MT0iNTAlIiB5MT0iMCUiIHgyPSI1MCUiIHkyPSIxMDAlIiBpZD0ibGluZWFyR3JhZGllbnQtMSI+CiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiNGN0NDNUYiIG9mZnNldD0iMCUiPjwvc3RvcD4KICAgICAgICAgICAgPHN0b3Agc3RvcC1jb2xvcj0iI0U4NkUyQyIgb2Zmc2V0PSIxMDAlIj48L3N0b3A+CiAgICAgICAgPC9saW5lYXJHcmFkaWVudD4KICAgICAgICA8bGluZWFyR3JhZGllbnQgeDE9IjUwJSIgeTE9IjAlIiB4Mj0iNTAlIiB5Mj0iMTAwJSIgaWQ9ImxpbmVhckdyYWRpZW50LTIiPgogICAgICAgICAgICA8c3RvcCBzdG9wLWNvbG9yPSIjRjdDQzVGIiBvZmZzZXQ9IjAlIj48L3N0b3A+CiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiNFODZFMkMiIG9mZnNldD0iMTAwJSI+PC9zdG9wPgogICAgICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICA8L2RlZnM+CiAgICA8ZyBpZD0iV09XLUxPR08iIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgICAgICAgPGcgaWQ9Ikdyb3VwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMTIuMDAwMDAwLCAxMDcuNTI2NTIxKSIgc3Ryb2tlPSJ1cmwoI2xpbmVhckdyYWRpZW50LTEpIiBzdHJva2Utd2lkdGg9IjM4Ij4KICAgICAgICAgICAgPHBhdGggZD0iTTAuNDMzMDEyNzAyLDg2LjkyNjkxNTggTDEwMC40MzMwMTMsMjYwLjEzMTk5NyBNMTAwLjQzMzAxMyw4Ni45MjY5MTU4IEwyMDAuNDMzMDEzLDI2MC4xMzE5OTcgTTM1MS41ODU3OTEsNS45OTUyMDQzM2UtMTUgTDIwMi4yNTU3MDcsMjYwLjE5MzI0NyIgaWQ9IkNvbWJpbmVkLVNoYXBlIj48L3BhdGg+CiAgICAgICAgPC9nPgogICAgICAgIDxwYXRoIGQ9Ik0yNTYsNDU2IEMzNjYuNDU2OTUsNDU2IDQ1NiwzNjYuNDU2OTUgNDU2LDI1NiBDNDU2LDE0NS41NDMwNSAzNjYuNDU2OTUsNTYgMjU2LDU2IEMxNDUuNTQzMDUsNTYgNTYsMTQ1LjU0MzA1IDU2LDI1NiBDNTYsMzY2LjQ1Njk1IDE0NS41NDMwNSw0NTYgMjU2LDQ1NiBaIiBpZD0iT3ZhbCIgc3Ryb2tlPSJ1cmwoI2xpbmVhckdyYWRpZW50LTIpIiBzdHJva2Utd2lkdGg9IjI4IiBzdHJva2UtZGFzaGFycmF5PSIxMTU1LjUyLDk5OTk5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgyNTYuMDAwMDAwLCAyNTYuMDAwMDAwKSByb3RhdGUoLTEzMi4wMDAwMDApIHRyYW5zbGF0ZSgtMjU2LjAwMDAwMCwgLTI1Ni4wMDAwMDApICI+PC9wYXRoPgogICAgPC9nPgo8L3N2Zz4=';
		add_menu_page( 'Wow Plugins', 'Wow Plugins', 'manage_options', 'wow-company', array(
			$this,
			'main_page',
		), $icon );
		add_submenu_page( 'wow-company', 'Welcome to Wow-Company', 'Welcome', 'manage_options', 'wow-company' );
	}
	
	/**
	 * Include the main file
	 */
	public function main_page() {
		require_once 'about/main.php';

	}

	// Save in database for Old version of Class Wow-Company
	public function plugin_check() {
		if ( isset( $_POST['wow_plugin_nonce_field'] ) ) {
			if ( ! empty( $_POST ) && wp_verify_nonce( $_POST['wow_plugin_nonce_field'], 'wow_plugin_action' ) &&
			     current_user_can( 'manage_options' ) ) {
				self:: save_data();
			}
		}
	}
	
	// Save in the database for older fersions
	public function save_data() {
		global $wpdb;
		$objItem = new WOW_DATA();
		$add     = ( isset( $_REQUEST["add"] ) ) ? sanitize_text_field( $_REQUEST["add"] ) : '';
		$data    = ( isset( $_REQUEST["data"] ) ) ? sanitize_text_field( $_REQUEST["data"] ) : '';
		$page    = sanitize_text_field( $_REQUEST["page"] );
		$id      = absint( $_POST['id'] );
		if ( isset( $_POST["submit"] ) ) {
			if ( sanitize_text_field( $_POST["add"] ) == "1" ) {
				$objItem->addNewItem( $data, $_POST );
				header( "Location:admin.php?page=" . $page . "&info=saved" );
				exit;
			} elseif ( sanitize_text_field( $_POST["add"] ) == "2" ) {
				$objItem->updItem( $data, $_POST );
				header( "Location:admin.php?page=" . $page . "&tool=add&act=update&id=" . $id . "&info=update" );
				exit;
			}
		}
	}
}

$wow_plugin = new Wow_Company();
