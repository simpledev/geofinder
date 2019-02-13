# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/simpledev/geofinder.svg?style=flat-square)](https://packagist.org/packages/simpledev/geofinder)
[![Build Status](https://img.shields.io/travis/simpledev/geofinder/master.svg?style=flat-square)](https://travis-ci.org/simpledev/geofinder)
[![Quality Score](https://img.shields.io/scrutinizer/g/simpledev/geofinder.svg?style=flat-square)](https://scrutinizer-ci.com/g/simpledev/geofinder)
[![Total Downloads](https://img.shields.io/packagist/dt/simpledev/geofinder.svg?style=flat-square)](https://packagist.org/packages/simpledev/geofinder)

This package can find latitude and longitude from jpeg photos metadata.

## Installation

You can install the package via composer:

```bash
composer require simpledev/geofinder:dev-master
```

## Usage Example

``` php
use Simpledev\Geofinder\Geofinder;

if(!empty($_FILES['photo']))
{
	$photo = $_FILES['photo'];
	$finder = new Geofinder();
	$coords = $finder->getCoords($photo['tmp_name']);

	var_dump($coords); //return array(2) { ["latitude"]=> float(47.977730555556) ["longitude"]=> float(-4.4286277777778) } or false if geolocation not found

	if($coords){
		$lat = $coords['latitude']; //get latitude
		$lng = $coords['longitude']; //get longitude

		//do something with latitude and longitude
	}
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Fabien LE CORRE](https://github.com/simpledev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).