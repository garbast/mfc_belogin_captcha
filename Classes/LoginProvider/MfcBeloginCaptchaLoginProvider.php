<?php
namespace Mfc\MfcBeloginCaptcha\LoginProvider;

/**
 * Class MfcBeloginCaptchaLoginProvider
 * @package Mfc\MfcBeloginCaptcha\LoginProvider
 */
class MfcBeloginCaptchaLoginProvider extends \TYPO3\CMS\Backend\LoginProvider\UsernamePasswordLoginProvider
{
    /**
     * @param \TYPO3\CMS\Fluid\View\StandaloneView $view
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer
     * @param \TYPO3\CMS\Backend\Controller\LoginController $loginController
     */
    public function render(
        \TYPO3\CMS\Fluid\View\StandaloneView $view,
        \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer,
        \TYPO3\CMS\Backend\Controller\LoginController $loginController
    ) {
        parent::render($view, $pageRenderer, $loginController);
        $view->setTemplatePathAndFilename(
            \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                'EXT:mfc_belogin_captcha/Resources/Private/Templates/Login.7x.html'
            )
        );
    }
}
