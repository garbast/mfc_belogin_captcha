<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


/** @noinspection PhpUndefinedVariableInspection */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    $_EXTKEY,
    'auth',
    'Mfc\\MfcBeloginCaptcha\\Service\\CaptchaService',
    array(
        'title' => 'Backend Login Captcha Service',
        'description' => 'Extends the authentication with a captcha protection after an amount of login failed',
        'subtype' => 'authUserBE',
        'available' => true,
        'priority' => 70,
        'quality' => 75,
        'os' => '',
        'exec' => '',
        'className' => 'Mfc\\MfcBeloginCaptcha\\Service\\CaptchaService',
    )
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['loginProviders'][1441369732] = array(
    'provider' => Mfc\MfcBeloginCaptcha\LoginProvider\MfcBeloginCaptchaLoginProvider::class,
    'sorting' => 70,
    'icon-class' => 'fa-captcha',
    'label' => 'Test'
);
;
