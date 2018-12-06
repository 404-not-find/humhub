<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use humhub\modules\ui\menu\widgets\LeftNavigation;
use Yii;
use yii\helpers\Url;

/**
 * AccountMenuWidget as (usally left) navigation on users account options.
 *
 * @package humhub.modules_core.user.widgets
 * @since 0.5
 * @author Luke
 */
class AccountMenu extends LeftNavigation
{

    /**
     * @inheritdoc
     */
    public function init()
    {

        $controllerAction = Yii::$app->controller->action->id;
        $this->panelTitle = Yii::t('UserModule.widgets_AccountMenuWidget', '<strong>Account</strong> settings');

        $this->addItem([
            'label' => Yii::t('UserModule.widgets_AccountMenuWidget', 'Profile'),
            'icon' => '<i class="fa fa-user"></i>',
            'url' => Url::toRoute('/user/account/edit'),
            'sortOrder' => 100,
            'isActive' => ($controllerAction == "edit" || $controllerAction == "change-email" || $controllerAction == "change-password" || $controllerAction == "delete"),
        ]);

        $this->addItem([
            'label' => Yii::t('UserModule.account', 'E-Mail Summaries'),
            'icon' => '<i class="fa fa-envelope"></i>',
            'url' => Url::toRoute('/activity/user'),
            'sortOrder' => 105,
            'isActive' => (Yii::$app->controller->module->id == 'activity'),
        ]);

        $this->addItem([
            'label' => Yii::t('UserModule.account', 'Notifications'),
            'icon' => '<i class="fa fa-bell"></i>',
            'url' => Url::toRoute('/notification/user'),
            'sortOrder' => 106,
            'isActive' => (Yii::$app->controller->module->id == 'notification'),
        ]);

        $this->addItem([
            'label' => Yii::t('UserModule.widgets_AccountMenuWidget', 'Settings'),
            'icon' => '<i class="fa fa-wrench"></i>',
            'url' => Url::toRoute('/user/account/edit-settings'),
            'sortOrder' => 110,
            'isActive' => ($controllerAction == "edit-settings"),
        ]);

        $this->addItem([
            'label' => Yii::t('UserModule.widgets_AccountMenuWidget', 'Security'),
            'icon' => '<i class="fa fa-lock"></i>',
            'url' => Url::toRoute('/user/account/security'),
            'sortOrder' => 115,
            'isActive' => (Yii::$app->controller->action->id == "security"),
        ]);

        // Only show this page when really user specific modules available
        if (count(Yii::$app->user->getIdentity()->getAvailableModules()) != 0) {
            $this->addItem([
                'label' => Yii::t('UserModule.widgets_AccountMenuWidget', 'Modules'),
                'icon' => '<i class="fa fa-rocket"></i>',
                'url' => Url::toRoute('//user/account/edit-modules'),
                'sortOrder' => 120,
                'isActive' => (Yii::$app->controller->action->id == "edit-modules"),
            ]);
        }

        parent::init();
    }

}

?>
