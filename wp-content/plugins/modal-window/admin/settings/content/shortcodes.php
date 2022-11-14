<?php
/**
 * Shortcode Generation for Popup Box
 *
 * @package     WP_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shortcode_type = array(
	'label'   => esc_attr__( 'Shortcode Type', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_type',
		'value' => 'button',
	],
	'options' => [
		'button' => esc_attr__( 'Button', 'modal-window' ),
		'video'  => esc_attr__( 'Video', 'modal-window' ),
		'icon'   => esc_attr__( 'Icon', 'modal-window' ),
		'iframe' => esc_attr__( 'Iframe', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Select the shortcode type.', 'modal-window' ),
);

//region Video

$shortcode_video_from = array(
	'label'   => esc_attr__( 'Video Hosting', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_video_from',
		'value' => isset( $param['shortcode_video_from'] ) ? $param['shortcode_video_from'] : 'youtube',
	],
	'options' => [
		'youtube' => esc_attr__( 'YouTube', 'modal-window' ),
		'vimeo'   => esc_attr__( 'Vimeo', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Set the resource for Video.', 'modal-window' ),
);

$shortcode_video_id = array(
	'label'   => esc_attr__( 'Video ID', 'modal-window' ),
	'attr'    => [
		'id'          => 'shortcode_video_id',
		'value'       => '',
		'placeholder' => esc_attr__( 'Enter video ID', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Set the video ID.', 'modal-window' ),
);

$shortcode_video_width = array(
	'label'   => esc_attr__( 'Video Width', 'modal-window' ),
	'attr'    => [
		'name'  => 'param[shortcode_video_width]',
		'id'    => 'shortcode_video_width',
		'value' => '560',
		'min'   => '0',
		'step'  => '1',
	],
	'addon'   => [
		'unit' => 'px',
	],
	'tooltip' => esc_attr__( 'Set the video width.', 'modal-window' ),
);

$shortcode_video_height = array(
	'label'   => esc_attr__( 'Video Height', 'modal-window' ),
	'attr'    => [
		'name'  => 'param[shortcode_video_height]',
		'id'    => 'shortcode_video_height',
		'value' => '315',
		'min'   => '0',
		'step'  => '1',
	],
	'addon'   => [
		'unit' => 'px',
	],
	'tooltip' => esc_attr__( 'Set the video height.', 'modal-window' ),
);
//endregion

//region Shortcode Button
$shortcode_btn_type = array(
	'label'   => esc_attr__( 'Button Type', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_type',
		'value' => 'close',
	],
	'options' => [
		'close' => esc_attr__( 'Popup Close Button', 'modal-window' ),
		'link'  => esc_attr__( 'Button with Link', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Set the type of the popup button', 'modal-window' ),
);

$shortcode_btn_size = array(
	'label'   => esc_attr__( 'Button Size', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_size',
		'value' => 'normal',
	],
	'options' => [
		'small'  => esc_attr__( 'Small', 'modal-window' ),
		'normal' => esc_attr__( 'Normal', 'modal-window' ),
		'medium' => esc_attr__( 'Medium', 'modal-window' ),
		'large'  => esc_attr__( 'Large', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Select the size of the button.', 'modal-window' ),
);

$shortcode_btn_fullwidth = array(
	'label'   => esc_attr__( 'Full Width', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_fullwidth',
		'value' => isset( $param['shortcode_btn_fullwidth'] ) ? $param['shortcode_btn_fullwidth'] : '',
	],
	'options' => [
		''    => esc_attr__( 'No', 'modal-window' ),
		'yes' => esc_attr__( 'Yes', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Set the fullwidth option for button.', 'modal-window' ),
);

$shortcode_btn_text = array(
	'label'   => esc_attr__( 'Button Text', 'modal-window' ),
	'attr'    => [
		'name'        => 'param[shortcode_btn_text]',
		'id'          => 'shortcode_btn_text',
		'value'       => 'Close Popup',
		'placeholder' => esc_attr__( 'Enter Text', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Set the text for button.', 'modal-window' ),
);

$shortcode_btn_color = array(
	'label'   => esc_attr__( 'Text Color', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_color',
		'value' => '#ffffff',
	],
	'tooltip' => esc_attr__( 'Set the color for button text.', 'modal-window' ),
);

$shortcode_btn_bgcolor = array(
	'label'   => esc_attr__( 'Background Color', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_bgcolor',
		'value' => '#00d1b2',
	],
	'tooltip' => esc_attr__( 'Set the color for button background.', 'modal-window' ),
);

$shortcode_btn_link = array(
	'label'   => esc_attr__( 'Link', 'modal-window' ),
	'attr'    => [
		'id'          => 'shortcode_btn_link',
		'value'       => '',
		'placeholder' => esc_attr__( 'Enter URL', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Enter the URL for button link', 'modal-window' ),
);

$shortcode_btn_target = array(
	'label'   => esc_attr__( 'Target', 'modal-window' ),
	'attr'    => [
		'id'    => 'shortcode_btn_target',
		'value' => '_blank',
	],
	'options' => [
		'_blank' => esc_attr__( 'New tab', 'modal-window' ),
		'_self'  => esc_attr__( 'Same tab', 'modal-window' ),
	],
	'tooltip' => esc_attr__( 'Target for opening the URL.', 'modal-window' ),
);
//endregion

// Icon includes
$icons_dir = $this->plugin['dir'];
include_once( $icons_dir . 'vendors/fontawesome/icons.php' );
$icons_new = array();
foreach ( $icons as $key => $value ) {
	$icons_new[ $value ] = $value;
}

$icongenerate = array(
	'label'   => esc_attr__( 'Select Icon', 'modal-window' ),
	'attr'    => [
		'id'    => 'icongenerate',
		'value' => '',
		'class' => 'icons',
	],
	'options' => $icons_new,
	'tooltip' => 'Select the Icon',
	'icon'    => '',
);

$color_icon = array(
	'label' => esc_attr__( 'Color', 'modal-window' ),
	'attr'  => [
		'id'    => 'color_icon',
		'value' => '#797979',
	],
);

$size_icon = array(
	'label' => esc_attr__( 'Size', 'modal-window' ),
	'attr'  => [
		'id'    => 'size_icon',
		'value' => '24',
		'min'   => '1',
		'step'  => '1',
	],
	'addon' => [
		'unit' => 'px',
	]
);

$link_icon = array(
	'label' => esc_attr__( 'Link', 'modal-window' ),
	'attr'  => [
		'id'          => 'link_icon',
		'value'       => '',
		'placeholder' => 'https://examole.com',
	],
);

$target_icon = array(
	'label'   => esc_attr__( 'Select Icon', 'modal-window' ),
	'attr'    => [
		'id'    => 'target_icon',
		'value' => '_blank',
	],
	'options' => [
		'_blank' => esc_attr__( 'In a new window', 'modal-window' ),
		'_self'  => esc_attr__( 'In the same window', 'modal-window' ),
	],
);

$iframe_link = array(
	'label'   => esc_attr__( 'Iframe link', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_link',
		'value' => '',
		'placeholder' => 'https://',
	],
);

$iframe_width = array(
	'label'   => esc_attr__( 'Width', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_width',
		'value' => '600',
	],
);

$iframe_height = array(
	'label'   => esc_attr__( 'Height', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_height',
		'value' => '450',
	],
);

$iframe_id = array(
	'label'   => esc_attr__( 'ID', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_id',
		'value' => '',
	],
);

$iframe_class = array(
	'label'   => esc_attr__( 'Class', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_class',
		'value' => '',
	],
);

$iframe_style = array(
	'label'   => esc_attr__( 'Style', 'modal-window' ),
	'attr'    => [
		'id'    => 'iframe_style',
		'value' => '',
	],
);


?>

<div id="popupShortcode" style="display:none;">

    <div id="shortcodeBuilder">
        <div class="columns is-t-margin">
            <div class="column is-one-third">
				<?php $this->select( $shortcode_type ); ?>
            </div>
        </div>

        <div class="columns is-multiline video-box">
            <div class="column is-one-third">
				<?php $this->select( $shortcode_video_from ); ?>
            </div>

            <div class="column is-one-third">
				<?php $this->input( $shortcode_video_id ); ?>
            </div>
            <div class="column is-one-third ">
				<?php $this->number( $shortcode_video_width ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->number( $shortcode_video_height ); ?>
            </div>
            <div class="column is-full content">
                <span class="has-text-weight-bold">You can find the video ID in URL on video webpage:</span>
                <ul>
                    <li>YouTube video ID - letters after an equal sign (=);</li>
                    <li>Vimeo video ID - numbers that come after the slash (/)</li>
                </ul>
            </div>
        </div>

        <div class="columns is-multiline button-box">
            <div class="column is-one-third">
				<?php $this->select( $shortcode_btn_type ); ?>
            </div>
            <div class="column is-one-third ">
				<?php $this->select( $shortcode_btn_size ); ?>
            </div>
            <div class="column is-one-third ">
				<?php $this->select( $shortcode_btn_fullwidth ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->input( $shortcode_btn_text ); ?>
            </div>
            <div class="column is-one-third shortcode-btn-link">
				<?php $this->input( $shortcode_btn_link ); ?>
            </div>
            <div class="column is-one-third shortcode-btn-link">
				<?php $this->select( $shortcode_btn_target ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->color( $shortcode_btn_color ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->color( $shortcode_btn_bgcolor ); ?>
            </div>
        </div>

        <div class="columns is-multiline icon-box">
            <div class="column is-one-third">
				<?php $this->select( $icongenerate ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->color( $color_icon ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->number( $size_icon ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->input( $link_icon ); ?>
            </div>
            <div class="column is-one-third">
				<?php $this->select( $target_icon ); ?>
            </div>

        </div>

        <div class="columns is-multiline iframe-box">
            <div class="column is-one-third">
			    <?php $this->input( $iframe_link ); ?>
            </div>
            <div class="column is-one-third">
			    <?php $this->number( $iframe_width ); ?>
            </div>
            <div class="column is-one-third">
	            <?php $this->number( $iframe_height ); ?>
            </div>

            <div class="column is-one-third">
		        <?php $this->input( $iframe_id ); ?>
            </div>
            <div class="column is-one-third">
		        <?php $this->input( $iframe_class ); ?>
            </div>
            <div class="column is-one-third">
		        <?php $this->input( $iframe_style ); ?>
            </div>
        </div>


    </div>

    <div class="columns shortcode-preview" id="shortcodeBtnBuilder">
        <div class="column is-full">
            <label class="label"><?php esc_html_e( 'Preview', 'modal-window' ); ?>:</label>
            <div class="has-text-centered" id="shortcodeBtnPreview"></div>
        </div>
    </div>

    <div class="columns">
        <div class="column is-full">
            <label class="label"><?php esc_attr_e( 'Shortcode', 'modal-window' ); ?>:</label>
            <div class="shortcodeBox has-text-centered" id="shortcodeBox"></div>
        </div>
    </div>

    <button class="button button-primary button-large is-size-6 is-radiusless" id="shortcodeInsert">
        <span>Insert Shortcode</span>
    </button>

</div>