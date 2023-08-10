# Laravel Emsika SMS

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

TSend an SMS through the Emsika SMS gateway. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require shengamo/laravel-emsika-sms
```

## Usage

Add these values to your .env file. These are the details you get from your Emsika account.
``` bash
    EMSIKA_SOURCE_ADDRESS=
    EMSIKA_USERNAME=
    EMSIKA_PASSWORD=
    EMSIKA_URL=
    EMSIKA_DEFAULT_TIMEOUT=90
```
### Step 1
1. Run the migration.
2. Add a message to the EmsikaOutbox model.
   2. ```EmsikaOutbox::create(['phone','message']);```
3. Add the sms to the schedule in the App\Console\Kernel.php file
   4. ``` bash
      protected function schedule(Schedule $schedule)
      {
          $schedule->command('send:sms')->everyMinute();
      }
      ```
## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email support@shengamo.com instead of using the issue tracker.

## Credits

- [Mo Malenga][link-author]

[//]: # (- [All Contributors][link-contributors])

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/shengamo/laravel-emsika-sms.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/shengamo/laravel-emsika-sms.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/shengamo/laravel-emsika-sms/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/shengamo/laravel-emsika-sms
[link-downloads]: https://packagist.org/packages/shengamo/laravel-emsika-sms
[link-travis]: https://travis-ci.org/shengamo/laravel-emsika-sms
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/shengamo
[link-contributors]: ../../contributors
