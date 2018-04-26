<?php

class QM_Jetpack_Output extends QM_Output_Html {
	public function __construct( QM_Collector $collector ) {
		parent::__construct( $collector );
		add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 999 );
		add_filter( 'qm/output/menu_class', array( $this, 'admin_class' ) );
	}

	public function output() {
		$data = $this->collector->get_data();

		echo '<div class="qm qm-non-tabular" id="' . esc_attr( $this->collector->id() ) . '">';
		echo '<div class="qm-boxed qm-boxed-wrap">';

		if ( ! empty( $data['connection'] ) ) {
			$this->output_connection( $data[ 'connection' ] );
		}

		if ( ! empty( $data['constants'] ) ) {
			$this->output_constants( $data[ 'constants' ] );
		}

		if ( ! empty( $data['options'] ) ) {
			$this->output_options( $data[ 'options' ] );
		}

		echo '</div>';
		echo '</div>';
	}

	private function output_connection( $connection ) {
		echo '<div class="qm-section">';
		echo '<h2>' . __( 'Connection', 'qm-jetpack' ) . '</h2>';
		echo '<table>';
		echo '<tbody>';

		// Blog ID
		echo '<tr>';
		echo '<th scope="row">' . __( 'ID', 'qm-jetpack' ) . '</th>';
		echo '<td>' . ( isset( $connection['id'] ) ? esc_html( $connection['id'] ) : 'undefined' ) . '</td>';
		echo '</tr>';

		// Master user email
		echo '<tr>';
		echo '<th scope="row">' . __( 'Master user email', 'qm-jetpack' ) . '</th>';
		echo '<td>' . ( isset( $connection['master_user_email'] ) ? esc_html( $connection['master_user_email'] ) : 'undefined' ) . '</td>';
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	}

	private function output_options( $options ) {
		echo '<div class="qm-section">';
		echo '<h2>' . __( 'Options', 'qm-jetpack' ) . '</h2>';
		echo '<table>';
		echo '<tbody>';

		foreach( $options as $name => $value ) {
			echo '<tr>';
			echo '<th scope="row">' . esc_html( $name ) . '</th>';
			if ( gettype( $value ) === 'array' || gettype( $value ) === 'object' ) {
				echo '<td><pre>' . esc_html( var_export( $value, true ) ) . '</pre></td>';
			} else {
				echo '<td>' . esc_html( var_export( $value, true ) ) . '</td>';
			}
			echo '</tr>';
		}

		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	}

	private function output_constants( $constants ) {
		echo '<div class="qm-section">';
		echo '<h2>' . __( 'Constants', 'qm-jetpack' ) . '</h2>';
		echo '<table>';
		echo '<tbody>';

		foreach( $constants as $name => $value ) {
			echo '<tr>';
			echo '<th scope="row">' . esc_html( $name ) . '</th>';
			echo '<td>' . esc_html( var_export( $value, true ) ) . '</td>';
			echo '</tr>';
		}

		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	}

	/**
	 * @param array $class
	 *
	 * @return array
	 */
	public function admin_class( array $class ) {
		$class[] = 'qm-jetpack';
		return $class;
	}

	public function admin_menu( array $menu ) {
		$menu[] = $this->menu( array(
			'id'    => 'qm-jetpack',
			'href'  => '#qm-jetpack',
			'title' => 'Jetpack'
		) );

		return $menu;
	}
}
