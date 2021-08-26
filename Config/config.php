<?php

return [
    'name' => 'Imeeting',
    'providerName' => 'imeeting',

    /*
    * Providers
    */
    'providers' => [

        /*
        * Provider
        */
        'zoom' => [
            'name' => 'zoom',
            'apiUrl' => 'https://api.zoom.us/v2/',
            'defaulValuesMeeting' => [
                'topic' => 'Meeting Shedule with User',
                'duration' => 30
            ]
        ]


    ]

    
    
    
];
