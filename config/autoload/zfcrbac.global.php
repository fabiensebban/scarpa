<?php

return [
    'zfc_rbac' => [

        // 'protection_policy' => \ZfcRbac\Guard\GuardInterface::POLICY_ALLOW,
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [
                'auteur' => [
                    'permissions' => ['editArticle']
                ]
            ]
        ],

        'unauthorized_strategy' => [
            'template' => 'error/403'
        ],        
    ]
];