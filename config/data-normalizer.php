<?php

// config for Deller/DataNormalizer
return [
    'phone' => [
        'default_country' => 'DE',
        'format' => 'E164',
        'strict_validation' => false,
    ],
    'email' => [
        'trim_whitespace' => true,
        'lowercase' => true,
    ],
];
