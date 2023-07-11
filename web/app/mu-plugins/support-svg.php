<?php
/**
 * Plugin Name: Support SVG
 * Description: Add SVG support to WordPress
 * Version: 1.0
 * Author: Pierre Lejeune
 * Author URI: https://pierrelejeune.fr/
 */

defined( 'ABSPATH' ) || die();


function get_svg_dimensions( $svg ){
	$svg = simplexml_load_file( $svg );
	if ( $svg === FALSE ) {
		$width = '0';
		$height = '0';
	} else {
		$attributes = $svg->attributes();
		$width = (string) $attributes->width;
		$height = (string) $attributes->height;

	}
	return (object) array( 'width' => $width, 'height' => $height );
}

function add_svg_to_mime_type( $mimes = array() ) {
	global $svg_options;
	if ( empty( $svg_options['restrict'] ) || current_user_can( 'administrator' ) ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	} else {
		return $mimes;
	}
}
add_filter( 'upload_mimes', 'add_svg_to_mime_type', 99 );

function check_svg_to_mime_type( $data, $file, $filename, $mimes ) {
	global $wp_version;
	if ( $wp_version !== '4.7.1' || $wp_version !== '4.7.2' ) {
		return $data;
	}
	$filetype = wp_check_filetype( $filename, $mimes );
	return [
		'ext'				=> $filetype['ext'],
		'type'				=> $filetype['type'],
		'proper_filename'	=> $data['proper_filename']
	];
}
add_filter( 'wp_check_filetype_and_ext', 'check_svg_to_mime_type', 10, 4 );

function check_svg_upload( $checked, $file, $filename, $mimes ) {
	if ( ! $checked['type'] ) {
		$check_filetype		= wp_check_filetype( $filename, $mimes );
		$ext				= $check_filetype['ext'];
		$type				= $check_filetype['type'];
		$proper_filename	= $filename;
		if ( $type && 0 === strpos( $type, 'image/' ) && $ext !== 'svg' ) $ext = $type = false;
		$checked = compact( 'ext','type','proper_filename' );
	}
	return $checked;
}
add_filter( 'wp_check_filetype_and_ext', 'check_svg_upload', 10, 4 );

function create_svg_metadata( array $metadata, int $attachment_id ) {
	$mime = get_post_mime_type( $attachment_id );

	if ( $mime == 'image/svg+xml' ) {

		$svg_path = get_attached_file( $attachment_id );
		$upload_dir = wp_upload_dir();
		$relative_path = str_replace(trailingslashit($upload_dir['basedir']), '', $svg_path);
		$filename = basename( $svg_path );

		$dimensions = get_svg_dimensions( $svg_path );

		$metadata = array(
			'width'		=> intval($dimensions->width),
			'height'	=> intval($dimensions->height),
			'file'		=> $relative_path
		);
		$sizes = array();
		foreach ( get_intermediate_image_sizes() as $s ) {
			$sizes[$s] = array( 'width' => '', 'height' => '', 'crop' => false );
			if ( isset( $_wp_additional_image_sizes[$s]['width'] ) )
				$sizes[$s]['width'] = intval( $_wp_additional_image_sizes[$s]['width'] ); // For theme-added sizes
			else
				$sizes[$s]['width'] = get_option( "{$s}_size_w" ); // For default sizes set in options
			if ( isset( $_wp_additional_image_sizes[$s]['height'] ) )
				$sizes[$s]['height'] = intval( $_wp_additional_image_sizes[$s]['height'] ); // For theme-added sizes
			else
				$sizes[$s]['height'] = get_option( "{$s}_size_h" ); // For default sizes set in options
			if ( isset( $_wp_additional_image_sizes[$s]['crop'] ) )
				$sizes[$s]['crop'] = intval( $_wp_additional_image_sizes[$s]['crop'] ); // For theme-added sizes
			else
				$sizes[$s]['crop'] = get_option( "{$s}_crop" ); // For default sizes set in options

			$sizes[$s]['file'] =  $filename;
			$sizes[$s]['mime-type'] =  'image/svg+xml';
		}
		$metadata['sizes'] = $sizes;
	}
	return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'create_svg_metadata', 10, 3 );

function return_svg_front( $response, $attachment, $meta ) {
	if ( $response['mime'] == 'image/svg+xml' && empty( $response['sizes'] ) ) {
		$svg_path = get_attached_file( $attachment->ID );
		if ( ! file_exists( $svg_path ) ) {
			$svg_path = $response['url'];
		}
		$dimensions = get_svg_dimensions( $svg_path );

		$response['sizes'] = array(
			'full' => array(
				'url' => $response['url'],
				'width' => $dimensions->width,
				'height' => $dimensions->height,
				'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait'
			)
		);

	}
	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'return_svg_front', 10, 3 );