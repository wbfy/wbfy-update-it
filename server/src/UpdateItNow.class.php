<?php
/**
 * Main Update It! Now control class
 */
class wbfy_ui_UpdateItNow
{
    /**
     * Set auto update as required
     */
    public function init()
    {
        add_filter('allow_major_auto_core_updates', array($this, 'enableMajor'));
        add_filter('allow_minor_auto_core_updates', array($this, 'enableMinor'));
        add_filter('auto_update_plugin', array($this, 'enablePlugins'));
        add_filter('auto_update_theme', array($this, 'enableThemes'));

    }

    public function enableMajor()
    {
        $settings = wbfy_ui_Options::getInstance()->settings;
        if ($settings['update']['core']['major']) {
            return true;
        }
        return false;
    }

    public function enableMinor()
    {
        $settings = wbfy_ui_Options::getInstance()->settings;
        if ($settings['update']['core']['minor']) {
            return true;
        }
        return false;
    }

    public function enablePlugins()
    {
        $settings = wbfy_ui_Options::getInstance()->settings;
        if ($settings['update']['themes']) {
            return true;
        }
        return false;
    }

    public function enableThemes()
    {
        $settings = wbfy_ui_Options::getInstance()->settings;
        if ($settings['update']['themes']) {
            return true;
        }
        return false;
    }
}
