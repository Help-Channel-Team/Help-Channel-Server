<?php
return [
	'USER' => [
		'type' => 1,
		'ruleName' => 'userGroup',
	],
    'TECH' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'ADMIN' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'TECH', 'USER'
        ],
    ]
];
