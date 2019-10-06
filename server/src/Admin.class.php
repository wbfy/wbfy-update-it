<?php
class wbfy_ui_Admin
{
    /**
     * Initialise Update It! options page
     * Set up actions and filters for Admin functions
     */
    public function init()
    {
        register_setting(
            'wbfy_ui_options', // Option group.
            'wbfy_ui', // Option name (in wp_options)
            array($this, 'validate') // Sanitation callback
        );
        add_filter('plugin_action_links_wbfy-update-it/wbfy-update-it.php', array($this, 'pluginPageSettingsLink'));
        $this->registerForm();
    }

    /**
     * Add 'settings' option onto WP Plugins page
     *
     * @param array  $links links for WP Plugin page
     * @return array $links With new settings link added
     */
    public function pluginPageSettingsLink($links)
    {
        $url = esc_url(
            add_query_arg(
                'page',
                'wbfy-update-it',
                get_admin_url() . 'admin.php'
            )
        );
        $settings_link = "<a href='$url'>" . __('Settings', 'wbfy-update-it') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * Add Update It! to settings menu
     */
    public function addToMenu()
    {
        add_options_page(
            __('Update It!', 'wbfy-update-it'), // Page title
            __('Update It!', 'wbfy-update-it'), // Menu title
            'manage_options', // Capability/permission required
            'wbfy-update-it', // Page slug (unique id)
            array($this, 'render') // Renderer callback
        );
    }

    /**
     * Add form and settings
     */
    private function registerForm()
    {
        // Plugin update settings section
        add_settings_section(
            'wbfy_ui_update', // ID
            __('Update', 'wbfy-update-it'), // Section name
            array($this, 'sectionUpdate'), // Title HTML callback
            'wbfy_ui_options' // register_setting::option group NOT page slug!
        );

        // Core major
        add_settings_field(
            'wbfy_ui_update_major', // ID
            __('WordPress Core (Major)', 'wbfy-update-it'), // Label
            array($this, 'fieldUpdateMajor'), // Field HTML callback
            'wbfy_ui_options', // register_setting::option group NOT page slug!
            'wbfy_ui_update' // Section ID
        );

        // Core minor
        add_settings_field(
            'wbfy_ui_update_minor', // ID
            __('WordPress Core (Minor)', 'wbfy-update-it'), // Label
            array($this, 'fieldUpdateMinor'), // Field HTML callback
            'wbfy_ui_options', // register_setting::option group NOT page slug!
            'wbfy_ui_update' // Section ID
        );

        // Update settings fields
        add_settings_field(
            'wbfy_ui_update_plugins', // ID
            __('Plugins', 'wbfy-update-it'), // Label
            array($this, 'fieldUpdatePlugins'), // Field HTML callback
            'wbfy_ui_options', // register_setting::option group NOT page slug!
            'wbfy_ui_update' // Section ID
        );

        add_settings_field(
            'wbfy_ui_update_themes', // ID
            __('Themes', 'wbfy-update-it'), // Label
            array($this, 'fieldUpdateThemes'), // Field HTML callback
            'wbfy_ui_options', // register_setting::option group NOT page slug!
            'wbfy_ui_update' // Section ID
        );

        // Config data settings fields
        add_settings_section(
            'wbfy_ui_config_data',
            __('Configuration Data', 'wbfy-update-it'),
            array($this, 'sectionConfigData'),
            'wbfy_ui_options'
        );

        add_settings_field(
            'wbfy_ui_config_data_on_deactivate',
            __('Deactivated', 'wbfy-update-it'),
            array($this, 'fieldConfigDataOnDeactivate'),
            'wbfy_ui_options',
            'wbfy_ui_config_data'
        );

        add_settings_field(
            'wbfy_ui_config_data_on_delete',
            __('Deleted', 'wbfy-update-it'),
            array($this, 'fieldConfigDataOnDelete'),
            'wbfy_ui_options',
            'wbfy_ui_config_data'
        );
    }

    /**
     * Update settings header
     */
    public function sectionUpdate()
    {
        echo '<p>' . __('Choose what to automatically update:', 'wbfy-update-it') . '</p>';
    }

    /**
     * Render update plugins field
     */
    public function fieldUpdatePlugins()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_update_plugins',
                'name'  => 'wbfy_ui[update][plugins]',
                'value' => $options->settings['update']['plugins'],
                'label' => __('', 'wbfy-update-it'),
            )
        );
    }

    /**
     * Render update themes field
     */
    public function fieldUpdateThemes()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_update_themes',
                'name'  => 'wbfy_ui[update][themes]',
                'value' => $options->settings['update']['themes'],
                'label' => __('', 'wbfy-update-it'),
            )
        );
    }

    /**
     * Render core major field
     */
    public function fieldUpdateMajor()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_update_major',
                'name'  => 'wbfy_ui[update][core][major]',
                'value' => $options->settings['update']['core']['major'],
                'label' => __('', 'wbfy-update-it'),
            )
        );
    }

    /**
     * Render core minor field
     */
    public function fieldUpdateMinor()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_update_minor',
                'name'  => 'wbfy_ui[update][core][minor]',
                'value' => $options->settings['update']['core']['minor'],
                'label' => __('', 'wbfy-update-it'),
            )
        );
    }

    /**
     * Render Config Data options header
     */
    public function sectionConfigData()
    {
        echo '<p>' . __('Remove all configuration data for this plugin when it is:', 'wbfy-update-it') . '</p>';
    }

    /**
     * Render on_deactivate field
     */
    public function fieldConfigDataOnDeactivate()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_config_data_on_deactivate',
                'name'  => 'wbfy_ui[config_data][on_deactivate]',
                'value' => $options->settings['config_data']['on_deactivate'],
            )
        );
    }

    /**
     * Render on_delete/uninstall field
     */
    public function fieldConfigDataOnDelete()
    {
        $options = wbfy_ui_Options::getInstance();
        echo wbfy_ui_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_ui_config_data_on_delete',
                'name'  => 'wbfy_ui[config_data][on_delete]',
                'value' => $options->settings['config_data']['on_delete'],
            )
        );
    }

    /**
     * Validate and sanitize inputs
     */
    public function validate($input)
    {
        $input['update']['plugins']       = (isset($input['update']['plugins'])) ? true : false;
        $input['update']['themes']        = (isset($input['update']['themes'])) ? true : false;
        $input['update']['core']['minor'] = (isset($input['update']['core']['minor'])) ? true : false;
        $input['update']['core']['major'] = (isset($input['update']['core']['major'])) ? true : false;
        return $input;
    }

    /**
     * Render Update It! options page
     */
    public function render()
    {
        if (!current_user_can('update_plugins')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'wbfy-update-it'));
        }

        wp_enqueue_style(
            'wbfy-update-it-css',
            plugins_url('/wbfy-update-it/resources/css/wbfy-update-it.min.css'),
            false,
            WBFY_UI_VERSION
        );

        echo wbfy_ui_Libs_WordPress_Functions::render(
            'server/skin/admin.php',
            wbfy_ui_Options::getInstance()->settings
        );
    }
}
