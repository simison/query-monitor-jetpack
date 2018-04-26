<?php

class QM_Jetpack_Collector extends QM_Collector {
	public $id = 'jetpack';
	public $data = array();

	public function name() {
		return 'Jetpack';
	}

	public function process() {
		$this->data['connection'] = $this->get_connection();
		$this->data['options'] = $this->get_options();
		$this->data['constants'] = $this->get_constants();
	}

	private function get_connection() {
		$data = array();

		if ( class_exists( 'Jetpack_Options' ) && method_exists( 'Jetpack_Options', 'get_option' ) ) {
			$data['id'] = Jetpack_Options::get_option( 'id' );
		}

		if ( method_exists( 'Jetpack', 'get_master_user_email' ) ) {
			$data['master_user_email'] = Jetpack::get_master_user_email();
		}

		return $data;
	}

	private function get_options() {
		$data = array();

		if ( class_exists( 'Jetpack_Options' ) ) {
			$all_jp_options = method_exists( 'Jetpack_Options', 'get_all_jetpack_options' ) ? (array) Jetpack_Options::get_all_jetpack_options() : array();
			$wp_options = method_exists( 'Jetpack_Options', 'get_all_wp_options' ) ? (array) Jetpack_Options::get_all_wp_options() : array();
		}

		if ( method_exists( 'Jetpack_Options', 'get_option' ) ) {
			foreach( $all_jp_options as $option ) {
				$data[ $option ] = Jetpack_Options::get_option( $option );
			}
		}

		foreach( $wp_options as $option ) {
			$data[ $option ] = get_option( $option );
		}

		return $data;
	}

	private function get_constants() {
		$constants = array(
			'JETPACK__API_BASE',
			'JETPACK__API_VERSION',
			'JETPACK__GLOTPRESS_LOCALES_PATH',
			'JETPACK__MINIMUM_WP_VERSION',
			'JETPACK__PLUGIN_DIR',
			'JETPACK__PLUGIN_FILE',
			'JETPACK__VERSION',
			'JETPACK__WPCOM_JSON_API_HOST',
			'JETPACK_CLIENT__AUTH_LOCATION',
			'JETPACK_CLIENT__HTTPS',
			'JETPACK_MASTER_USER',
			'JETPACK_PROTECT__API_HOST',
		);

		$data = array();

		foreach( $constants as $constant ) {
			$data[ $constant ] = defined( $constant ) ? constant( $constant ) : 'undefined';
		}

		return $data;
	}
}
