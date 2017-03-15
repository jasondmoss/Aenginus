<?php

/**
 * Ænginus: Laravel Website Engine.
 *
 * @package    Laravel
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/aenginus/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/aenginus/
 */

namespace Aenginus\Config;

use App\Configuration;
use Aenginus\Exception\UnConfigurableException;

/**
 * ConfigureHelper.
 *
 * @trait
 */
trait ConfigureHelper
{

    /**
     * ...
     *
     * @param string $key
     * @param string $defaultValue
     *
     * @return string
     * @access public
     */
    public function getConfig($key, $defaultValue = null)
    {
        if (!isset($this->configuration) ||
            !isset($this->configuration->config[$key]) ||
            empty($this->configuration->config[$key])
        ) {
            return $defaultValue;
        }

        return $this->configuration->config[$key];
    }


    /**
     * ...
     *
     * @param string $key
     * @param string $defaultValue
     *
     * @return boolean
     * @access public
     */
    public function getBoolConfig($key, $defaultValue = false)
    {
        $default = $defaultValue ? 'true' : 'false';

        return $this->getConfig($key, $default) == 'true';
    }


    /**
     * ...
     *
     * @access public
     * @abstract
     */
    public abstract function getConfigKeys();


    /**
     * ...
     *
     * @param array $array
     *
     * @return boolean
     * @access public
     *
     * @throws UnConfigurableException
     */
    public function saveConfig($array)
    {
        if (!$this->configuration) {
            $configuration = $this->innerSetConfigKeys(new Configuration(), $array);

            return $this->configuration()->save($configuration);
        }

        return $this->innerSetConfigKeys($this->configuration, $array)->save();
    }


    /**
     * ...
     *
     * @param \App\Configuration $configuration
     * @param array              $array
     *
     * @return \App\Configuration
     * @access public
     */
    private function innerSetConfigKeys(Configuration $configuration, $array)
    {
        $config = $configuration->config;
        foreach ($array as $key => $value) {
            if (in_array($key, $this->getConfigKeys())) {
                $config[$key] = $value;
            }
        }
        $configuration->config = $config;

        return $configuration;
    }
}

/* <> */
