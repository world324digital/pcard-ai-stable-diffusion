<?php
/**
 * Public Class
 *
 * @package     Wow_Plugin
 * @subpackage  Public
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

namespace modal_window;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Wow_Plugin_Public {

	private $info;

	public function __construct( $info ) {

		$this->plugin = $info['plugin'];
		$this->url    = $info['url'];
		$this->rating = $info['rating'];

		add_shortcode( 'Wow-Modal-Windows', array( $this, 'shortcode' ) );
		add_shortcode( $this->plugin['shortcode'], array( $this, 'shortcode' ) );

		add_shortcode( 'videoBox', array( $this, 'video_shortcode' ) );
		add_shortcode( 'buttonBox', array( $this, 'button_shortcode' ) );
		add_shortcode( 'iframeBox', array( $this, 'iframe_shortcode' ) );

		// Shortcodes for columns
		add_shortcode( 'w-row', array( $this, 'shortcode_row' ) );
		add_shortcode( 'w-column', array( $this, 'shortcode_columns' ) );

		// shortcode for icon
		add_shortcode( 'wow-icon', array( $this, 'shortcode_icon' ) );

		add_action( 'wp_footer', array( $this, 'display' ) );

	}

	function shortcode( $atts ) {
		ob_start();
		require plugin_dir_path( __FILE__ ) . 'shortcode.php';
		$shortcode = ob_get_contents();
		ob_end_clean();

		return $shortcode;
	}

	function shortcode_icon( $atts ) {
		ob_start();
		require plugin_dir_path( __FILE__ ) . 'shortcode_icon.php';
		$shortcode = ob_get_contents();
		ob_end_clean();

		return $shortcode;
	}

	function shortcode_row( $atts, $content = null ) {
		return '<div class="wow-col">' . do_shortcode( $content ) . '</div>';
	}

	function shortcode_columns( $atts, $content = null ) {
		extract( shortcode_atts( array( 'width' => "", 'align' => '' ), $atts ) );
		$width = ! empty( $width ) ? $width : '12';
		$align = ! empty( $align ) ? $align : 'left';

		return '<div class="wow-col-' . $width . '" style="text-align: ' . $align . '">' . do_shortcode( $content ) . '</div>';
	}

	function button_shortcode( $atts, $content ) {
		$atts = shortcode_atts( array(
			'type'      => 'close',
			'link'      => '',
			'target'    => '_blank',
			'color'     => 'white',
			'bgcolor'   => 'mediumaquamarine',
			'size'      => 'normal',
			'fullwidth' => 'no',
		), $atts, 'buttonBox' );

		$size      = 'is-' . $atts['size'];
		$button    = '';
		$fullwidth = ( $atts['fullwidth'] === 'yes' ) ? 'is-fullwidth' : '';
		if ( $atts['type'] === 'close' ) {
			$button = '<button class="ds-button ds-close-popup ' . esc_attr( $size ) . ' ' . esc_attr( $fullwidth ) . '" style="color:' . esc_attr( $atts['color'] ) . '; background:' . esc_attr( $atts['bgcolor'] ) . '">' . esc_attr( $content ) . '</button>';
		} elseif ( $atts['type'] === 'link' ) {
			$button = '<a href="' . esc_url( $atts['link'] ) . '" target="' . esc_attr( $atts['target'] ) . '" class="ds-button ' . esc_attr( $size ) . ' ' . esc_attr( $fullwidth ) . '" style="color:' . esc_attr( $atts['color'] ) . '; background:' . esc_attr( $atts['bgcolor'] ) . '">' . esc_attr( $content ) . '</a>';
		}

		return $button;
	}

	function video_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id'     => '',
			'from'   => 'youtube',
			'width'  => '560',
			'height' => '315',
		), $atts, 'videoBox' );

		if ( empty( $atts['id'] ) ) {
			return false;
		}

		if ( $atts['from'] === 'youtube' ) {
			$url = 'https://www.youtube.com/embed/';
		} elseif ( $atts['from'] === 'vimeo' ) {
			$url = 'https://player.vimeo.com/video/';
		}

		$video = '<iframe width="' . absint( $atts['width'] ) . '" height="' . absint( $atts['height'] ) . '" src="' . esc_url( $url ) . esc_attr( $atts['id'] ) . '" allow=autoplay frameborder="0" ></iframe>';

		return $video;
	}

	function iframe_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'link'   => '',
			'width'  => '560',
			'height' => '450',
			'id'     => '',
			'class'  => '',
			'style'  => '',
		), $atts, 'iframeBox' );

		$extra = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
		$extra .= ! empty( $atts['class'] ) ? ' class="' . esc_attr( $atts['class'] ) . '"' : '';
		$extra .= ! empty( $atts['style'] ) ? ' style="' . esc_attr( $atts['style'] ) . '"' : '';

		$iframe = '<iframe width="' . absint( $atts['width'] ) . '" height="' . absint( $atts['height'] ) . '" src="' . esc_url( $atts['link'] ) . '"' . wp_kses_post($extra) . '></iframe>';

		return $iframe;
	}



	function display() {
		require plugin_dir_path( __FILE__ ) . 'display.php';
	}


	private function check_cookie( $param, $id ) {
		$popupcookie = true;
		if ( $param['use_cookies'] === 'yes' ) {
			$namecookie = 'wow-modal-id-' . $id;
			if ( ! isset( $_COOKIE[ $namecookie ] ) ) {
				$popupcookie = true;
			} else {
				$popupcookie = false;
			}
		}
		if ( $param['use_cookies'] === 'no' ) {
			$popupcookie = true;
		}

		return $popupcookie;
	}



	private function check( $param, $id ) {
		$check   = true;
		$cookie  = $this->check_cookie( $param, $id );

		if ( empty($param['test_mode']) ) {
			if ( $cookie === false ) {
				$check = false;
			}

		} else {
			if ( ! current_user_can( 'administrator' ) ) {
				$check = false;
			}
		}

		return $check;
	}

}