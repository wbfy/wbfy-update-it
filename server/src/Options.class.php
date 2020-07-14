<?php
/**
 * Update It! Admin options handler
 */
class wbfy_ui_Options
{
    public $settings = null;

    /**
     * Singleton
     *
     * @return object Singleton instance
     */
    public static function getInstance()
    {
        static $instance = null;
        if (is_null($instance)) {
            $me       = __CLASS__;
            $instance = new $me;
            return $instance;
        }
        return $instance;
    }

    /**
     * Load options from DB
     * Extend existing options to also include any new top level
     * options that may have been added during any plugin update
     */
    public function __construct()
    {
        $this->getDefaults();
        $settings = get_option('wbfy_ui');
        if (is_array($settings)) {
            $this->settings = wbfy_ui_Libs_Arrays::extend(
                $this->settings,
                $settings
            );
        }
    }

    /**
     * Delete options
     */
    public function drop()
    {
        delete_option('wbfy_ui');
    }

    /**
     * Called on plugin initialisation
     */
    public function init()
    {
        $this->getDefaults();
        add_option('wbfy_ui', $this->settings);
    }

    /**
     * Default options
     *
     * @return array Default options list
     */
    public function getDefaults()
    {
        $this->settings = array(
            'update'      => array(
                'plugins' => false,
                'themes'  => false,
                'core'    => array(
                    'major' => false,
                    'minor' => true,
                ),

            ),
            'config_data' => array(
                'on_deactivate' => 0,
                'on_delete'     => 1,
            ),
        );
    }
}
