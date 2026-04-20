<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UI Style
    |--------------------------------------------------------------------------
    | Which CSS framework to apply to the input by default.
    | Options: 'tailwind', 'bootstrap', 'none'
    |
    | You can override this per-component with the :style="'bootstrap'" prop.
    */
    'style' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Decimal Digits
    |--------------------------------------------------------------------------
    | How many decimal places to display/format by default.
    */
    'decimals' => 2,

    /*
    |--------------------------------------------------------------------------
    | Separators
    |--------------------------------------------------------------------------
    | Decimal and thousands separators used for display and keyboard filtering.
    | Italian/EU convention: decimal=',', thousands='.'
    | US/UK convention:      decimal='.', thousands=','
    */
    'decimal_separator'   => ',',
    'thousands_separator' => '.',

];
