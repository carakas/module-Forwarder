<?php

namespace Frontend\Modules\Forwarder;

use Frontend\Core\Engine\Base\Config as BaseConfig;

/**
 * This is the configuration-object for the Forwarder module
 *
 * @author Lander Vanderstraeten <lander_vanderstraeten@hotmail.com>
 */
final class Config extends BaseConfig
{
    /**
     * The default action
     *
     * @var string
     */
    protected $defaultAction = 'Index';

    /**
     * The disabled actions
     *
     * @var array
     */
    protected $disabledActions = array();
}

