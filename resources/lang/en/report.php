<?php


return [
    // ...

    'unavailable_audits' => 'No Activity available',
    'created' => '<strong>:user_first_name :user_last_name</strong> created this report',
    'updated'            => [
        'metadata' => 'On :audit_created_at, <strong>:user_first_name :user_last_name</strong> updated this record',
        'modified' => [
            'report_date' => 'Report date has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'report_token' => 'Last name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'author' => 'Nip has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'inventarisCategory_name' => 'Roles has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'reporter_name' => 'Reporter name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'reporter_contact' => 'Reporter contact has been modified from <strong>:old</strong> to <strong>:new</strong> ',
            'department' => 'Department has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'details_problem' => 'Details problem has been updated to <strong>:new</strong>',

            'executor' => 'Executor has been added : <strong>:new</strong>',
            'status' => 'Status has been changes : <strong>:new</strong>',
            'service_type' => 'Service type has been selected : <strong>:new</strong>',
            'solution' =>  'Solution updated', 
        ],
    ],

    // ...
];
?>