

<?php
// app/Helpers/helpers.php

if (! function_exists('getAcronym')) {
    function getAcronym($district) {
        $districts = [
            'Caloocan North' => 'CN',
            'Camanava' => 'CAVA',
            'CENTRAL' => 'CEN',
            'Makati' => 'MAK',
            'MAYNILA' => 'MAY',
            'Metro Manila East' => 'MME',
            'Metro Manila South' => 'MMS',
            'QUEZON CITY' => 'QC',
        ];
        return $districts[$district]?? $district;
    }
}