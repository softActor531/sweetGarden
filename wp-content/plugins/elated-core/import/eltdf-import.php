<?php
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
class satineElatedImport {

	public $message = "";
	public $attachments = false;
	function __construct() {
		add_action('admin_menu', array(&$this, 'eltdf_admin_import'));
		add_action('admin_init', array(&$this, 'eltdf_register_theme_settings'));

	}
	function eltdf_register_theme_settings() {
		register_setting( 'eltdf_options_import_page', 'eltdf_options_import');
	}

	function init_eltdf_import() {
		if(isset($_REQUEST['import_option'])) {
			$import_option = $_REQUEST['import_option'];
			if($import_option == 'content'){
				$this->import_content('satine_content.xml');
			}elseif($import_option == 'custom_sidebars') {
				$this->import_custom_sidebars('custom_sidebars.txt');
			} elseif($import_option == 'widgets') {
				$this->import_widgets('widgets.txt','custom_sidebars.txt');
			} elseif($import_option == 'options'){
				$this->import_options('options.txt');
			}elseif($import_option == 'menus'){
				$this->import_menus('menus.txt');
			}elseif($import_option == 'settingpages'){
				$this->import_settings_pages('settingpages.txt');
			}elseif($import_option == 'complete_content'){
				$this->import_content('satine_content.xml');
				$this->import_options('options.txt');
				$this->import_widgets('widgets.txt','custom_sidebars.txt');
				$this->import_menus('menus.txt');
				$this->import_settings_pages('settingpages.txt');
				$this->message = esc_html__("Content imported successfully", "eltdf-core");
			}
		}
	}

	public function import_content($file){
		ob_start();
		require_once(ELATED_CORE_ABS_PATH . '/import/class.wordpress-importer.php');
		$eltdf_import = new WP_Import();
		set_time_limit(0);

		$eltdf_import->fetch_attachments = $this->attachments;
		$returned_value = $eltdf_import->import($file);
		if(is_wp_error($returned_value)){
			$this->message = esc_html__("An Error Occurred During Import", "eltdf-core");
		}
		else {
			$this->message = esc_html__("Content imported successfully", "eltdf-core");
		}
		ob_get_clean();
	}

	public function import_widgets($file, $file2){
		$this->import_custom_sidebars($file2);
		$options = $this->file_options($file);
		foreach ((array) $options['widgets'] as $eltdf_widget_id => $eltdf_widget_data) {
			update_option( 'widget_' . $eltdf_widget_id, $eltdf_widget_data );
		}
		$this->import_sidebars_widgets($file);
		$this->message = esc_html__("Widgets imported successfully", "eltdf-core");
	}

	public function import_sidebars_widgets($file){
		$eltdf_sidebars = get_option("sidebars_widgets");
		unset($eltdf_sidebars['array_version']);
		$data = $this->file_options($file);
		if ( is_array($data['sidebars']) ) {
			$eltdf_sidebars = array_merge( (array) $eltdf_sidebars, (array) $data['sidebars'] );
			unset($eltdf_sidebars['wp_inactive_widgets']);
			$eltdf_sidebars = array_merge(array('wp_inactive_widgets' => array()), $eltdf_sidebars);
			$eltdf_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets($eltdf_sidebars);
		}
	}

	public function import_custom_sidebars($file){
		$options = $this->file_options($file);
		update_option( 'eltdf_sidebars', $options);
		$this->message = esc_html__("Custom sidebars imported successfully", "eltdf-core");
	}

	public function import_options($file){
		$options = $this->file_options($file);
		update_option( 'eltdf_options_satine', $options);
		$this->message = esc_html__("Options imported successfully", "eltdf-core");
	}

	public function import_menus($file){
		global $wpdb;
		$eltdf_terms_table = $wpdb->prefix . "terms";
		$this->menus_data = $this->file_options($file);
		$menu_array = array();
		foreach ($this->menus_data as $registered_menu => $menu_slug) {
			$term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $eltdf_terms_table where slug=%s", $menu_slug), ARRAY_A);
			if(isset($term_rows[0]['term_id'])) {
				$term_id_by_slug = $term_rows[0]['term_id'];
			} else {
				$term_id_by_slug = null;
			}
			$menu_array[$registered_menu] = $term_id_by_slug;
		}
		set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );

	}
	public function import_settings_pages($file){
		$pages = $this->file_options($file);
		foreach($pages as $eltdf_page_option => $eltdf_page_id){
			update_option( $eltdf_page_option, $eltdf_page_id);
		}
	}

	public function file_options($file){
		$file_content = "";
		$file_for_import = get_template_directory() . '/includes/import/files/' . $file;
		/*if ( file_exists($file_for_import) ) {
			$file_content = $this->eltdf_file_contents($file_for_import);
		} else {
			$this->message = esc_html__("File doesn't exist", "eltdf-core");
		}*/
		$file_content = $this->eltdf_file_contents($file);
		if ($file_content) {
			$unserialized_content = unserialize(base64_decode($file_content));
			if ($unserialized_content) {
				return $unserialized_content;
			}
		}
		return false;
	}

	function eltdf_file_contents( $path ) {
		$url      = "http://export.elated-themes.com/".$path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
	}

	function eltdf_admin_import() {
		if (eltdf_core_theme_installed()) {
			global $satine_Framework;

			$slug = "_tabimport";
			$this->pagehook = add_submenu_page(
				'satine_elated_theme_menu',
				'Elated Options - Elated Import',                   // The value used to populate the browser's title bar when the menu page is active
				'Import',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'satine_elated_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
				array($satine_Framework->getSkin(), 'renderImport')
			);

			add_action('admin_print_scripts-'.$this->pagehook, 'satine_elated_enqueue_admin_scripts');
			add_action('admin_print_styles-'.$this->pagehook, 'satine_elated_enqueue_admin_styles');
			//$this->pagehook = add_menu_page('Elated Import', 'Elated Import', 'manage_options', 'eltdf_options_import_page', array(&$this, 'eltdf_generate_import_page'),'dashicons-download');
		}
	}

}

function eltdf_init_import_object(){
	global $satine_import_object;
	$satine_import_object = new satineElatedImport();
}

add_action('init', 'eltdf_init_import_object');

if(!function_exists('eltdf_core_data_import')){
	function eltdf_core_data_import(){
		global $satine_import_object;

		if ($_POST['import_attachments'] == 1)
			$satine_import_object->attachments = true;
		else
			$satine_import_object->attachments = false;

		$folder = "satine/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$satine_import_object->import_content($folder.$_POST['xml']);

		die();
	}

	add_action('wp_ajax_eltdf_core_data_import', 'eltdf_core_data_import');
}

if(!function_exists('eltdf_core_import_widgets')){
	function eltdf_core_import_widgets(){
		global $satine_import_object;

		$folder = "satine/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$satine_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

		die();
	}

	add_action('wp_ajax_eltdf_core_import_widgets', 'eltdf_core_import_widgets');
}

if(!function_exists('eltdf_core_options_import')){
	function eltdf_core_options_import(){
		global $satine_import_object;

		$folder = "satine/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$satine_import_object->import_options($folder.'options.txt');

		die();
	}

	add_action('wp_ajax_eltdf_core_options_import', 'eltdf_core_options_import');
}

if(!function_exists('eltdf_core_other_import')){
	function eltdf_core_other_import(){
		global $satine_import_object;

		$folder = "satine/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$satine_import_object->import_options($folder.'options.txt');
		$satine_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
		$satine_import_object->import_menus($folder.'menus.txt');
		$satine_import_object->import_settings_pages($folder.'settingpages.txt');

		die();
	}

	add_action('wp_ajax_eltdf_core_other_import', 'eltdf_core_other_import');
}