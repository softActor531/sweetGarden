<?php
/*
   Class: SatineElatedFramework
   A class that initializes Elated Framework
*/
class SatineElatedFramework {

    private static $instance;
    public $eltdfOptions;
    public $eltdfMetaBoxes;
    private $skin;

    private function __construct() {
        $this->eltdfOptions = SatineElatedOptions::get_instance();
        $this->eltdfMetaBoxes = SatineElatedMetaBoxes::get_instance();
    }
    
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getSkin() {
        return $this->skin;
    }

	public function setSkin(SatineElatedSkinAbstract $skinObject) {
		$this->skin = $skinObject;
	}
}

/**
 * Class SatineElatedSkinManager
 *
 * Class that used like a factory for skins.
 * It loads required skin file and instantiates skin class
 */
class SatineElatedSkinManager {
    /**
     * @var this will be an instance of skin
     */
    private $skin;

    /**
     * @see ElatedSkinManager::setSkin()
     */
    public function __construct() {
        $this->setSkin();
    }

    /**
     * Loads wanted skin, instantiates skin class and stores it in $skin attribute
     * @param string $skinName skin to load. Must match skin folder name
     */
    private function setSkin($skinName = 'elated') {

        if($skinName !== '') {
            if(file_exists(get_template_directory().'/framework/admin/skin/'.$skinName.'/skin.php')) {
                require_once get_template_directory().'/framework/admin/skin/'.$skinName.'/skin.php';

                $skinName = ucfirst($skinName).'Skin';

                $this->skin = new $skinName();
            }
        } else {
            $this->skin = false;
        }
    }

    /**
     * Returns current skin object. It $skin attribute isn't set it calls setSkin method
     *
     * @return mixed
     *
     * @see ElatedSkinManager::setSkin()
     */
    public function getSkin() {
        if(empty($this->skin)) {
            $this->setSkin();
        }

        return $this->skin;
    }
}

/**
 * Class SatineElatedSkinAbstract
 *
 * Abstract class that each skin class must extend
 */
abstract class SatineElatedSkinAbstract {
    /**
     * @var string
     */
    protected $skinName;
    /**
     * @var array of styles that skin will be including
     */
    protected $styles;
    /**
     * @var array of scripts that skin will be including
     */
    protected $scripts;
    /**
     * @var array of icons names for each menu item that theme is adding
     */
    protected $icons;
    /**
     * @var array of menu items positions of each menu item that theme is adding
     */
    protected $itemPosition;

    /**
     * Returns skin name attribute whenever skin is used in concatenation
     * @return mixed
     */
    public function __toString() {
		return $this->skinName;
	}

    /**
     * @return mixed
     */
    public function getSkinName() {
		return $this->skinName;
	}

    /**
     * Loads template part with params. Uses locate_template function which is child theme friendly
     * @param $template string template to load
     * @param array $params parameters to pass to template
     */
    public function loadTemplatePart($template, $params = array()) {
        if(is_array($params) && count($params)) {
            extract($params);
        }

        if($template !== '') {
            include(satine_elated_find_template_path('framework/admin/skin/'.$this->skinName.'/templates/'.$template.'.php'));
        }
    }

    /**
     * Goes through each added scripts and enqueus it
     */
    public function enqueueScripts() {
        if(is_array($this->scripts) && count($this->scripts)) {
            foreach ($this->scripts as $scriptHandle => $scriptPath) {
                wp_enqueue_script($scriptHandle);
            }
        }
    }

    /**
     * Goes through each added styles and enqueus it
     */
    public function enqueueStyles() {
        if(is_array($this->styles) && count($this->styles)) {
            foreach ($this->styles as $styleHandle => $stylePath) {
                wp_enqueue_style($styleHandle);
            }
        }
    }

    /**
     * Echoes script tag that generates global variable that will be used in TinyMCE
     */
    public function setShortcodeJSParams() { ?>
		<script>
			window.eltdfSCIcon = '<?php echo satine_elated_get_skin_uri().'/assets/img/admin-logo-icon.png'; ?>';
			window.eltdfSCLabel = '<?php echo esc_html(ucfirst($this->skinName)); ?> Shortcodes';
		</script>
	<?php }

    /**
     * Formates skin name so it can be used in concatenation
     * @return string
     */
    public function getSkinLabel() {
		return ucfirst($this->skinName);
	}

    /**
     * Returns URI to skin folder
     * @return string
     */
    public function getSkinURI() {
        return get_template_directory_uri().'/framework/admin/skin/'.$this->skinName;
    }

    /**
     * Here options page content will be generated
     * @return mixed
     */
    public abstract function renderOptions();

	/**
	 * Here backup options page will be generated
	 * @return mixed
	 */
	public abstract function renderBackupOptions();
    /**
     * Here import page will be generated
     * @return mixed
     */
    public abstract function renderImport();

    /**
     * Here all scripts will be registered
     * @return mixed
     */
    public abstract function registerScripts();

    /**
     * Here all styles will be registered
     * @return mixed
     */
    public abstract function registerStyles();

}

/*
   Class: SatineElatedOptions
   A class that initializes Elated Options
*/
class SatineElatedOptions {

    private static $instance;
    public $adminPages;
    public $options;
    public $optionsByType;

    private function __construct() {
        $this->adminPages = array();
        $this->options = array();
        $this->optionsByType = array();
    }
    
	public static function get_instance() {
	
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
	
		return self::$instance;
	}

    public function addAdminPage($key, $page) {
        $this->adminPages[$key] = $page;
    }

    public function getAdminPage($key) {
        return $this->adminPages[$key];
    }

    public function adminPageExists($key) {
        return array_key_exists($key, $this->adminPages);
    }

    public function getAdminPageFromSlug($slug) {
		foreach ($this->adminPages as $key=>$page ) {
			if ($page->slug == $slug)
				return $page;
		}
      
		return;
    }

    public function addOption($key, $value, $type = '') {
        $this->options[$key] = $value;

        $this->addOptionByType($type, $key);
    }

    public function getOption($key) {
        if(isset($this->options[$key])) {
            return $this->options[$key];
        }

        return;
    }

    public function addOptionByType($type, $key) {
        $this->optionsByType[$type][] = $key;
    }

    public function getOptionsByType($type) {
        if(array_key_exists($type, $this->optionsByType)) {
            return $this->optionsByType[$type];
        }

        return false;
    }

    public function getOptionValue($key) {
        global $satine_options;

        if(array_key_exists($key, $satine_options)) {
            return $satine_options[$key];
        } elseif(array_key_exists($key, $this->options)) {
            return $this->getOption($key);
        }

        return false;
    }
}

/*
   Class: SatineElatedAdminPage
   A class that initializes Elated Admin Page
*/
class SatineElatedAdminPage implements iSatineElatedLayoutNode {

    public $layout;
    private $factory;
    public $slug;
    public $title;
    public $icon;

    function __construct($slug="", $title="", $icon = "") {
        $this->layout = array();
        $this->factory = new SatineElatedFieldFactory();
        $this->slug = $slug;
        $this->title = $title;
        $this->icon = $icon;
    }

    public function hasChidren() {
        return (count($this->layout) > 0)?true:false;
    }

    public function getChild($key) {
        return $this->layout[$key];
    }

    public function addChild($key, $value) {
        $this->layout[$key] = $value;
    }

    function render() {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iSatineElatedRender $child) {
        $child->render($this->factory);
    }
}

/*
   Class: SatineElatedMetaBoxes
   A class that initializes Elated Meta Boxes
*/
class SatineElatedMetaBoxes {

    private static $instance;
    public $metaBoxes;
    public $options;

    private function __construct() {
        $this->metaBoxes = array();
        $this->options = array();
    }
    
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addMetaBox($key, $box) {
        $this->metaBoxes[$key] = $box;
    }

    public function getMetaBox($key) {
        return $this->metaBoxes[$key];
    }

    public function addOption($key, $value) {
        $this->options[$key] = $value;
    }

    public function getOption($key) {
        if(isset($this->options[$key])) {
            return $this->options[$key];
        }
        
        return;
    }

    public function getMetaBoxesByScope($scope) {
        $boxes = array();

        if(is_array($this->metaBoxes) && count($this->metaBoxes)) {
            foreach($this->metaBoxes as $metabox) {
                if(is_array($metabox->scope) && in_array($scope, $metabox->scope)) {
                    $boxes[] = $metabox;
                } elseif($metabox->scope !== '' && $metabox->scope === $scope) {
                    $boxes[] = $metabox;
                }
            }
        }

        return $boxes;
    }
}

/*
   Class: SatineElatedMetaBox
   A class that initializes Elated Meta Box
*/
class SatineElatedMetaBox implements iSatineElatedLayoutNode {

    public $layout;
	private $factory;
	public $scope;
	public $title;
	public $hidden_property;
	public $hidden_values = array();
    public $name;

    function __construct($scope="", $title="",$hidden_property="", $hidden_values = array(), $name = '') {
        $this->layout = array();
		$this->factory = new SatineElatedFieldFactory();
		$this->scope = $scope;
		$this->title = $this->setTitle($title);
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
        $this->name = $name;
    }

    public function hasChidren() {
        return (count($this->layout) > 0)?true:false;
    }

    public function getChild($key) {
        return $this->layout[$key];
    }

    public function addChild($key, $value) {
        $this->layout[$key] = $value;
    }

    function render() {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iSatineElatedRender $child) {
        $child->render($this->factory);
    }

	public function setTitle($label) {
		global $satine_Framework;

		return $satine_Framework->getSkin()->getSkinLabel().' '.$label;
 	}
}

if (!function_exists( 'satine_elated_init_framework_variable')) {
    function satine_elated_init_framework_variable() {
        global $satine_Framework;

        $satine_Framework = SatineElatedFramework::get_instance();
        $eltdfSkinManager = new SatineElatedSkinManager();
        $satine_Framework->setSkin($eltdfSkinManager->getSkin());
    }

    add_action('satine_elated_before_options_map', 'satine_elated_init_framework_variable');
}