<?php

/**
 * Bridges a few Jetpack conditional functions to be global, so that Query Monitor can test them
 */

defined( 'ABSPATH' ) or die();

if ( class_exists( 'Jetpack' ) ) {
	if ( method_exists( 'Jetpack', 'is_active' ) && ! function_exists( 'qm_jetpack_is_active' ) ) {
		function qm_jetpack_is_active() {
			return Jetpack::is_active();
		}
	}

	if ( method_exists( 'Jetpack', 'is_development_version' ) && ! function_exists( 'qm_jetpack_is_development_version' ) ) {
		function qm_jetpack_is_development_version() {
			return Jetpack::is_development_version();
		}
	}

	if ( method_exists( 'Jetpack', 'is_staging_site' ) && ! function_exists( 'qm_jetpack_is_staging_site' ) ) {
		function qm_jetpack_is_staging_site() {
			return Jetpack::is_staging_site();
		}
	}
}
