<?php
namespace Backend\Modules\Forwarder\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * This action will install the mini blog module.
 *
 * @author Lander Vanderstraeten <lander.vanderstraeten@wijs.be>
 */
class Installer extends ModuleInstaller
{
    /**
     * Install the module.
     */
    public function install()
    {
        $this->addModule('Forwarder');
        $this->importLocale(dirname(__FILE__).'/Data/locale.xml');
        $this->insertExtra($this->getModule(), 'widget', 'Forwarder', 'Forwarder');
    }
}
