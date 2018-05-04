<?php
namespace Mfc\MfcBeloginCaptcha\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Sebastian Fischer <typo@marketing-factory.de>
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

use TYPO3\CMS\Core\Utility\GeneralUtility;

class CaptchaService extends \TYPO3\CMS\Sv\AbstractAuthenticationService
{
    /**
     * Settings Service
     *
     * @var \Mfc\MfcBeloginCaptcha\Service\SettingsService
     */
    protected $settingsService;

    /**
     * @var \Evoweb\Recaptcha\Services\CaptchaService
     */
    protected $captchaService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->settingsService = GeneralUtility::makeInstance(\Mfc\MfcBeloginCaptcha\Service\SettingsService::class);
        $this->captchaService = GeneralUtility::makeInstance(\Evoweb\Recaptcha\Services\CaptchaService::class);
    }

    /**
     * Method adds a further authUser method.
     *
     * Will return one of following authentication status codes:
     * - 0 - captcha failed
     * - 100 - just go on. User is not authenticated but there is still no reason to stop
     *
     * @return int Authentication statuscode, one of 0 or 100
     */
    public function authUser()
    {
        $statusCode = 100;

        if (\Mfc\MfcBeloginCaptcha\Utility\LoginFailureUtility::failuresEqual(
            $this->settingsService->getByPath('failedTries')
        )) {
            $result = $this->captchaService->validateReCaptcha();

            if (!$result['verified']) {
                $statusCode = 0;
            }
        }

        return $statusCode;
    }
}
