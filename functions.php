<?php
require 'connection.php';
/**
 * Zeever functions and definitions
 *
 * @author Jegstudio
 * @package zeever
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

defined('ZEEVER_VERSION') || define('ZEEVER_VERSION', '1.0.9');
defined('ZEEVER_DIR') || define('ZEEVER_DIR', trailingslashit(get_template_directory()));
defined('ZEEVER_URI') || define('ZEEVER_URI', trailingslashit(get_template_directory_uri()));

require get_parent_theme_file_path('inc/autoload.php');
require get_parent_theme_file_path('inc/helper.php');
require get_parent_theme_file_path('inc/wptt-webfont-loader.php');


Zeever\Init::instance();

// ----------------------------insert Data in db table----------------------------------------

function callback_show_data_form()
{
	global $wpdb;
	$table_name = "wp_show_data";
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$form_data = array();
	foreach ($email as $key => $value) {
		if ($value != "" && $dob[$key] != "" && $name[$key] != "") {
			$form_data[] = array(
				"name" => $name[$key],
				"email" => $value,
				"dob" => $dob[$key]
			);
		}
	}
	$form_values = serialize($form_data);
	$wpdb->insert($table_name, array(
		'user_info' => $form_values
	));
	echo json_encode(['code' => 200, "message" => "Data inserted successfully."]);
	die;
}
add_action("wp_ajax_show_data_forms", "callback_show_data_form");
add_action("wp_ajax_nopriv_show_data_forms", "callback_show_data_form");


// --------------------------------show_db data in table-----------------------------

// function callback_get_datas()
// {
// 	global  $wpdb;
// 	$all_datas = $wpdb->get_results("SELECT * FROM `wp_show_data` WHERE `ID`");
// 	$info = array();

// 	foreach ($all_datas as $d) {
// 		$id = $d->ID;
// 		$userInfo = $d->user_info;
// 		$user_info = unserialize($userInfo);
// 		$name = $user_info['name'];
// 		$email = $user_info['email'];
// 		$dob = $user_info['dob'];

// 		$info[] = array(
// 			"ID" => $id,
// 			"user_info" => $user_info,
// 			// "name" => $name,
// 			// "email" => $email,
// 			// "dob" => $dob,


// 		);
// 	}

// 	return  $info;
// }

add_action("wp_ajax_get_datas", "callback_get_data_form");
add_action("wp_ajax_nopriv_get_datas", "callback_get_data_form");


// --------------------------------show_db data in table-----------------------------

function get_my_data()
{
	global $wpdb;
	if (!empty($_GET['param']) && $_GET['param'] == "get_data_param") {
		$get_results = $wpdb->get_results("SELECT * FROM `wp_show_data` ORDER BY `ID` DESC");
		$user_data = array();
		if (!empty($get_results)) {
			foreach ($get_results as $results) {
				$user_information = unserialize($results->user_info);
				$user_id = $results->ID;

				$user_data[] = array(
					"id" => $user_id,
					"user_info" => $user_information
				);
			}
		}
		echo json_encode(["code" => 200, "data" => $user_data, "message" => "User data get successfully."]);
	}
	die;
}
add_action("wp_ajax_get_data_action", "get_my_data");
