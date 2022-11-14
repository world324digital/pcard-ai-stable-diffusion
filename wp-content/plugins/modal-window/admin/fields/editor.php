<?php
/**
 * Template for field Editor
 *
 * @package     Wow_Plugin
 * @copyright   Wow-Company <helper@wow-company.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$label   = ! empty( $arg['label'] ) ? $arg['label'] : '';
$attr    = ! empty( $arg['attr'] ) ? $arg['attr'] : '';
$help    = ! empty( $arg['help'] ) ? $arg['help'] : '';
$icon    = ! empty( $arg['icon'] ) ? $arg['icon'] : '';
$tooltip = ! empty( $arg['tooltip'] ) ? $arg['tooltip'] : '';

$mce_buttons =  'bold, italic, underline, alignleft, aligncenter, alignright, link, unlink, strikethrough, removeformat, charmap, undo, redo, fontselect, fontsizeselect, forecolor, styleselect';

$mce_buttons_2 = 'fontselect, fontsizeselect, forecolor, styleselect';

$settings = array(
	'wpautop'       => 0,
	'media_buttons' => 1,
	'textarea_name' => '' . $attr['name'] . '',
	'textarea_rows' => 5,
	'quicktags'     => array(
		'id' => $attr['id'],
		'buttons' => 'strong,em,link,del,close'
	),
	'tinymce' => array(
		'toolbar1' => $mce_buttons,
		'toolbar2' => $mce_buttons_2,
    ),

);

?>
<?php if ( ! empty( $label ) ) : ?>
    <label class="label">
		<?php echo esc_attr( $label ); ?>
		<?php if ( ! empty( $tooltip ) ) : ?>
            <span class="is-primary has-tooltip-multiline has-tooltip-right"
                  data-tooltip="<?php echo esc_attr( $tooltip ); ?>">
                <span class="wow-help dashicons dashicons-editor-help"></span>
            </span>
		<?php endif; ?>
    </label>
<?php endif; ?>
    <div class="field">

        <div class="control">
			<?php wp_editor( $attr['value'], $attr['id'], $settings ); ?>
        </div>
    </div>
<?php if ( ! empty( $help ) ) : ?>
    <p class="help is-info"><?php echo esc_attr( $help ); ?></p>
<?php endif; ?>