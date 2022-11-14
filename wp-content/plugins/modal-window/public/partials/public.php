<?php
/**
 * Public final
 *
 * @package     Wow_Pluign
 * @subpackage  Public
 * @copyright   Copyright (c) 2019, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$close_type     = ! empty( $param['close_type'] ) ? $param['close_type'] : 'text';
$close_location = ! empty( $param['close_location'] ) ? $param['close_location'] : 'topRight';

$rotate_icon = ! empty( $param['rotate_icon'] ) ? ' ' . $param['rotate_icon'] : '';
if ( $param['button_type'] === '1' || empty( $param['button_type'] ) ) {
	$button_text = ( ! empty( $param['umodal_button_text'] ) ) ? $param['umodal_button_text'] : esc_attr__( 'Feedback' );
}
if ( ! empty( $param['include_overlay'] ) ) {
	$classoverlow = 'wow-modal-overlay';
	$overclose    = 'wow-modal-overclose';
} else {
	$classoverlow = '';
	$overclose    = '';
}

$content = do_shortcode( $param['content'] );


$modal = '';
if ( $param['umodal_button'] === 'yes' ) {
	echo '<div class="wow-modal-button-' . absint( $id ) . ' ' . esc_attr( $param['umodal_button_position'] ) . '" id="wow-modal-id-' . absint( $id ) . '">' . esc_html($button_text) . '</div>';
}
echo '<div id="wow-modal-overlay-' . absint( $id ) . '" class="' . esc_attr( $classoverlow ) . '" style="display:none;">';
echo '<div id="wow-modal-overclose-' . absint( $id ) . '" class="' . esc_attr( $overclose ) . '"></div>';
echo '<div id="wow-modal-window-' . absint( $id ) . '" class="wow-modal-window" style="display:none;">';
echo '<div id="wow-modal-close-' . absint( $id ) . '" class="mw-close-btn ' . esc_attr( $close_location ) . ' ' . esc_attr( $close_type ) . '"></div>';

echo '<div class="modal-window-content">';
if ( ! empty( $param['popup_title'] ) ) {
	echo '<div class="mw-title">' . esc_attr( $val->title ) . '</div>';
}

echo do_shortcode( wp_kses_post($param['content']) );
echo '</div></div></div>';
