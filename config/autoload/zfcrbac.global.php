<?php

return [
    'zfc_rbac' => [/*
        'guards' => ['ZfcRbac\Guard\RouteGuard' => [
                'articles/create' => ['auteur']
            ],
            'ZfcRbac\Guard\RouteGuard' => [
                'zfcuser/login'    => ['member'],
                'zfcuser/register' => ['member'], // required if registration is enabled
                'zfcuser*'         => ['user'] // includes logout, changepassword and changeemail
            ],
        ],*/
        // 'protection_policy' => \ZfcRbac\Guard\GuardInterface::POLICY_ALLOW,
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [
                'auteur' => [
                    'children'    => ['member'],
                    'permissions' => ['create']
                ],
                'member' => [
                    'permissions' => ['view']
                ]
            ]
        ],

        'unauthorized_strategy' => [
            'template' => 'error/403'
        ],        
    ]
];