<?php
return
    [
        'password'        =>
            [
                'min_length' => 5,
                'max_length' => 64,
                'pattern'    => '^(?=.*[a-zA-Z])[a-zA-Z\d!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+$',
            ],

        'strong_password' =>
            [
                // at least 1 uppercase letter, 1 lowercase letter and 1 number,
                // special character is invalid.
                'pattern' => '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]+$',
            ],

        'cell_phone'      =>
            [
                'pattern' => '^((\+?\d\d)|(\(\+\d\d\)))?1\d{10}$',
            ],

        'email'           =>
            [
                'pattern' => '^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$',
            ],

        'user_name'       =>
            [
                'min_length' => 4,
                'max_length' => 48,
                'pattern'    => '^[a-z0-9_-]+$',
            ],

        'company_name'    =>
            [
                'min_length' => 1,
                'max_length' => 255,
            ],
    ];