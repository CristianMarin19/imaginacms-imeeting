# imaginacms-imeeting (Provider Module)

## Install
```bash
composer require imagina/imeeting-module=v8.x-dev
```

## Enable the module
```bash
php artisan module:enable Imeeting
```

## Migration

```bash
php artisan module:migration Imeeting
```

## Providers

### Zoom (By Default)

#### Account and get configurations (App JWT)
Account: https://zoom.us/signin
	- Api Key
	- Api Secret

#### Add in env. file

	- ZOOM_API_KEY
	- ZOOM_API_SECRET


## Meeting Service

### Params
	Array meetingAttr (title,startTime,email, etc)
	Array entityAttr (id,type)
	String provider (optional)
	Array providerConnections (optional) (apiKey,secretKey, etc)

### Example

```php
// Example to create a meeting
// Zoom is Provider Defautl
	if(is_module_enabled('Imeeting')){

        // Meeting
        $dataToCreate['meetingAttr'] =[
            'title' => 'Reunion con Usuario - CitaId:'.$appointment->id,
            'startTime' => '27-08-2021 14:00:00',
             'email' => 'hostemail@email.com' //Host
        ];

        // Entity
        $dataToCreate['entityAttr'] =[
            'id' => $appointment->id,
            'type' => get_class($appointment),  
        ];

        $meeting = app('Modules\Imeeting\Services\MeetingService')->create($dataToCreate);

	}
```
