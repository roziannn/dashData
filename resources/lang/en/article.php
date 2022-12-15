<?php


return [
    // ...

    'unavailable_audits' => 'No Activity available',
    'created' => '<strong>:user_first_name :user_last_name</strong> create this user',
    'updated'            => [
        'metadata' => '<strong>:user_first_name :user_last_name</strong> updated this record',
        'modified' => [
            'first_name' => 'First name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'last_name' => 'Last name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'nip' => 'Nip has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'roles' => 'Roles has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'email' => 'Email has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'password' => 'Password has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'last_login_at' => 'Last login at <strong>:new</strong>'
        ],
    ],

    // ...
];
?>