<?php
/**
 * System – Admin Secret Key
 *
 * Protects the Joomla administrator panel by requiring a secret word
 * in the URL query string on first access.  Once verified the session
 * is marked and the key is not needed again until the session expires.
 *
 * Usage: add ?<your_key> to the admin URL, e.g.
 *        https://example.com/administrator/?mySecretWord
 *
 * @package     Admin Secret Key
 * @copyright   Copyright (C) 2026 JOD. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;

class PlgSystemAdminkey extends CMSPlugin
{
    public function onAfterInitialise(): void
    {
        // Old-style (non-PSR-4) plugins must use Factory::getApplication()
        // because $this->getApplication() returns null at this early stage.
        $app = Factory::getApplication();

        if (!$app->isClient('administrator')) {
            return;
        }

        $secret = trim((string) $this->params->get('secret_key', ''));

        if ($secret === '') {
            return;
        }

        $session = $app->getSession();

        if ($session->get('adminkey_verified', false)) {
            return;
        }

        // Key is used as a parameter NAME: /administrator/?mysecret
        $query = Uri::getInstance()->getQuery(true);

        if (array_key_exists($secret, $query)) {
            $session->set('adminkey_verified', true);
            return;
        }

        $redirectUrl = trim((string) $this->params->get('redirect_url', ''));
        $app->redirect($redirectUrl !== '' ? $redirectUrl : Uri::root());
    }
}
