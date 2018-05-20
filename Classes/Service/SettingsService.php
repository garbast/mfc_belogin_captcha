<?php
namespace Mfc\MfcBeloginCaptcha\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Fischer <typo3@marketing-factory.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Provide a way to get the configuration just everywhere
 *
 * Example
 * $pluginSettingsService =
 * $this->objectManager->get('Tx_News_Service_SettingsService');
 *
 * @package Mfc\MfcBeloginCaptcha\ViewHelpers
 */
class SettingsService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var array
     */
    protected static $settings = [];

    /**
     * Returns all settings.
     *
     * @param string $extensionKey
     *
     * @return array
     */
    public function getSettings($extensionKey = 'mfc_belogin_captcha')
    {
        if (!isset(self::$settings[$extensionKey])) {
            if (class_exists(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)) {
                $this->settings = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
                )->get('mfc_belogin_captcha');
            } else {
                self::$settings[$extensionKey] = !is_array(
                    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extensionKey]
                ) ?
                    unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extensionKey]) :
                    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extensionKey];
            }
        }

        return self::$settings[$extensionKey];
    }

    /**
     * Returns the settings at path $path, which is separated by ".",
     * e.g. "pages.uid".
     * "pages.uid" would return $this->settings['pages']['uid'].
     *
     * If the path is invalid or no entry is found, false is returned.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function getByPath($path)
    {
        return \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getPropertyPath($this->getSettings(), $path);
    }


    /**
     * Filles extension settings of EXT:recaptcha with values of mfc_belogin_captcha
     */
    public function prepareRecaptchaSettings()
    {
        $mfcBeloginCaptchaSettings = $this->getSettings('mfc_belogin_captcha');
        $recaptchaSettings = array_merge($this->getSettings('recaptcha'), $mfcBeloginCaptchaSettings);

        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['recaptcha'] = serialize($recaptchaSettings);

        if (!isset($recaptchaSettings['public_key']) || empty($recaptchaSettings['public_key'])) {
            \TYPO3\CMS\Core\Utility\GeneralUtility::sysLog(
                'Recaptcha public key was empty.',
                'mfc_belogin_captcha',
                \TYPO3\CMS\Core\Utility\GeneralUtility::SYSLOG_SEVERITY_WARNING
            );
        }
    }
}
