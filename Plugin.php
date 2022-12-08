<?php namespace Pensoft\Mails;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function registerPermissions()
    {
        return [
            'pensoft.mails.edit_mails' => [
                'tab' => 'Mails',
                'label' => 'Manage mails'
            ],
            'pensoft.mails.replace_from' => [
                'label' => 'Manage replace from field',
                'tab' => 'Replace options',
                'order' => 200,
                'roles' => ['developer']
            ],
            'pensoft.mails.replace_to' => [
                'label' => 'Manage replace to field',
                'tab' => 'Replace options',
                'order' => 200,
                'roles' => ['developer']
            ],
            'pensoft.mails.add_reply_to' => [
                'label' => 'Manage add reply to field',
                'tab' => 'Replace options',
                'order' => 200,
                'roles' => ['developer']
            ],
            'pensoft.mails.name_append' => [
                'label' => 'Manage name append field',
                'tab' => 'Replace options',
                'order' => 200,
                'roles' => ['developer']
            ],
        ];
    }
}
