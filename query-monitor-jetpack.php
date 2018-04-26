<?php
/*
Plugin Name: Query Monitor Jetpack
Plugin URI:  http://github.com/simison/query-monitor-jetpack
Description: Extends Query Monitor plugin with Jetpack section.
Version:     1.0
Author:      Mikael Korpela
Author URI:  http://www.mikaelkorpela.fi
License:     GPL2

Query Monitor Jetpack is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
Query Monitor Jetpack is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Query Monitor Jetpack .
If not, see https://www.gnu.org/licenses/gpl-2.0.en.html
*/

defined( 'ABSPATH' ) or die();

require_once( plugin_dir_path( __FILE__ ) . 'class.qm-jetpack.php' );

add_action( 'plugins_loaded', array( 'QM_Jetpack', 'init' ) );
