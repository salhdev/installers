<?php
namespace Composer\Installers;

class LESKInstaller extends BaseInstaller
{
    protected $locations = array(
        'module' => 'app/Modules/{$name}/',
        'theme' => 'resourses/themes/{$name}/'
    );

    /**
     * Format package name.
     *
     * For package type lesk-module, cut off a trailing '-plugin' if present.
     *
     * For package type lesk-theme, cut off a trailing '-theme' if present.
     *
     */
    public function inflectPackageVars($vars)
    {
        if ($vars['type'] === 'lesk-module') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'lesk-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

    protected function inflectPluginVars($vars)
    {
        $vars['name'] = preg_replace('/LESK-Module_/', '', $vars['name']);
        $vars['name'] = preg_replace('/-module$/', '', $vars['name']);
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }

    protected function inflectThemeVars($vars)
    {
        $vars['name'] = preg_replace('/LESK-Theme_/', '', $vars['name']);
        $vars['name'] = preg_replace('/-theme$/', '', $vars['name']);
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
