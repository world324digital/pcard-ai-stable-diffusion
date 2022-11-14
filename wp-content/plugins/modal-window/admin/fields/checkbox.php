<?php
/**
 * Template for field checkbox
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

$add_field_class = ! empty( $arg['attr']['class'] ) ? ' ' . $arg['attr']['class'] : '';
$field_classes   = 'is-radiusless ' . $add_field_class;

$checked = ! empty( $attr['value'] ) ? 'checked' : '';

?>

    <div class="field">
        <label class="label checkbox" for="<?php echo esc_attr( $attr['id'] ); ?>">
            <input type="hidden" name="<?php echo esc_attr( $attr['name'] ); ?>">
            <input class="<?php echo esc_attr( $field_classes ); ?>"
                   type="checkbox" <?php
                    foreach ( $attr as $key => $val ) {
                        if ( $key == 'class' || $key == 'value' ) {
                            continue;
                        }
                        echo esc_attr( $key ) . '="' . esc_attr( $val ) . '"';
                    }

                    if ( ! empty( $arg['func'] ) ) {
	                    echo 'onclick="' . esc_attr( $arg['func'] ) . '();"';
                    }

            ?> <?php echo esc_attr($checked);?> value="1">
			<?php echo esc_attr( $label ); ?>
			<?php if ( ! empty( $tooltip ) ) : ?>
                <span class="is-primary has-tooltip-multiline has-tooltip-right"
                      data-tooltip="<?php echo esc_attr( $tooltip ); ?>">
                    <span class="wow-help dashicons dashicons-editor-help"></span>
                </span>
			<?php endif; ?>
        </label>
    </div>
<?php if ( ! empty( $help ) ) : ?>
    <p class="help is-info"><?php echo esc_attr( $help ); ?></p>
<?php endif; ?>