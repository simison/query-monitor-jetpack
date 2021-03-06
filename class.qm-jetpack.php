<?php

class QM_Jetpack {

	public static function init() {
		if ( ! class_exists( 'QM_Activation' ) || ( defined( 'QM_DISABLED' ) && QM_DISABLED ) || ! class_exists( 'Jetpack' ) ) {
			return;
		}

		// Collector
		if( class_exists( 'QM_Collectors' ) ) {
			require_once( dirname( __FILE__ ) . '/class.qm-jetpack-collector.php' );
			QM_Collectors::add( new QM_Jetpack_Collector() );
		}

		// Outputter
		add_filter( 'qm/outputter/html', array( __CLASS__, 'get_output' ), 999, 2 );

		// Conditionals
		add_filter( 'query_monitor_conditionals', array( __CLASS__, 'get_conditionals' ) );
	}

	public static function get_output(array $output, QM_Collectors $collectors) {
		if ( class_exists( 'QM_Output_Html' ) ) {
			require_once( dirname( __FILE__ ) . '/class.qm-jetpack-output.php' );

			if ( $collector = QM_Collectors::get( 'jetpack' ) ) {
				$output[ 'jetpack' ] = new QM_Jetpack_Output( $collector );
			}
		}
		return $output;
	}

	/**
	 * Add Jetpack conditionals to Query Monitor
	 *
	 * See `global-conditionals.php` for bridged global helper functions
	 */
	public static function get_conditionals( array $conditionals ) {
		require_once( dirname( __FILE__ ) . '/global-conditionals.php' );

		return array_merge( $conditionals, array(
			'jetpack_is_atomic_site',
			'qm_jetpack_is_active',
			'qm_jetpack_is_development_version',
			'qm_jetpack_is_staging_site',
		 ) );
	}
}
