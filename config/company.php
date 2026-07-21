<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Operator identity
    |--------------------------------------------------------------------------
    |
    | Legal details of the site operator, substituted into the bracket tokens
    | ([OPERATOR NAME], [ADDRESS], ...) of the admin-managed legal pages at
    | render time (see LegalPageController). The contact email intentionally
    | reuses mail.from.address so the whole site shares one address.
    |
    */

    'name' => env('COMPANY_NAME'),

    'address' => env('COMPANY_ADDRESS'),

    'registration_number' => env('COMPANY_REGISTRATION_NUMBER'),

    'vat_id' => env('COMPANY_VAT_ID'),

];
