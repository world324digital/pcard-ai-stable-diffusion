<?php
/**
 * Icon shortcode
 *
 * @package     Public
 * @subpackage
 * @copyright   Copyright (c) 2017, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$params = shortcode_atts( array(
	'name'   => "",
	'size'   => "",
	'color'  => "",
	'link'   => "",
	'target' => "",
), $atts );

if ( ! empty( $params['size'] ) || ! empty( $params['color'] ) ) {
	$size  = ( ! empty( $params['size'] ) ) ? "font-size:" . $params['size'] . "px;" : '';
	$color = ( ! empty( $params['color'] ) ) ? "color:" . $params['color'] : '';
	$style = ' style="' . $size . $color . '"';
} else {
	$style = '';
}
if ( ! empty( $params['link'] ) ) {
	echo '<a href="' . esc_url($params['link']) . '" target="' . esc_attr($params['target']) . '"><i class="' . esc_attr($params['name']) . '"' . wp_kses_post($style) . '></i></a>';
} else {
	echo '<i class="' . esc_attr($params['name']) . '"' . wp_kses_post($style) . '></i>';
}

$fontawesome_url = $this->plugin['url'] . 'vendors/fontawesome/css/all.min.css';
wp_enqueue_style( 'fontawesome', $fontawesome_url, null, '5.6.3' );
