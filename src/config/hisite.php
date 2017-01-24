<?php
/**
 * Tools to use API as ActiveRecord for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-hiart
 * @package   yii2-hiart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

return empty($params['hiart.enabled']) ? [] : [
    'modules' => array_filter([
        'debug' => empty($params['debug.enabled']) ? null : [
            'panels' => [
                'hiart' => [
                    'class' => \hiqdev\hiart\debug\DebugPanel::class,
                ],
            ],
        ],
    ]),
    'components' => array_filter([
        $params['hiart.dbname'] => array_filter([
            'class' => \hiqdev\hiart\hiart\Connection::class,
            'name' => $params['hiart.dbname'],
            'requestClass' => $params['hiart.requestClass'],
        ]),
    ]),
    'container' => [
        'singletons' => [
            \hiqdev\hiart\ConnectionInterface::class => function () {
                return Yii::$app->get($params['hiart.dbname']);
            },
        ],
    ],
];
