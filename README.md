# laravel-authorization-addons
[![Join the chat at https://gitter.im/GeneaLabs/laravel-authorization-addons](https://badges.gitter.im/GeneaLabs/laravel-authorization-addons.svg)](https://gitter.im/GeneaLabs/laravel-authorization-addons?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Travis](https://img.shields.io/travis/GeneaLabs/laravel-authorization-addons.svg)](https://travis-ci.org/GeneaLabs/laravel-authorization-addons)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/d3824055-39b0-4206-b44e-8018071cc6ef.svg)](https://insight.sensiolabs.com/projects/d3824055-39b0-4206-b44e-8018071cc6ef)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/GeneaLabs/laravel-authorization-addons.svg)](https://scrutinizer-ci.com/g/GeneaLabs/laravel-authorization-addons)
[![Coveralls](https://img.shields.io/coveralls/GeneaLabs/laravel-authorization-addons.svg)](https://coveralls.io/github/GeneaLabs/laravel-authorization-addons)
[![GitHub (pre-)release](https://img.shields.io/github/release/GeneaLabs/laravel-authorization-addons/all.svg)](https://github.com/GeneaLabs/laravel-authorization-addons)
[![Packagist](https://img.shields.io/packagist/dt/GeneaLabs/laravel-authorization-addons.svg)](https://packagist.org/packages/genealabs/laravel-authorization-addons)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/GeneaLabs/laravel-authorization-addons/master/LICENSE)

Additional helper methods and blade directives to help with more complex authorization queries.

## Usage
### `@canAny (iterable $abilities, $model)`
Checks if any one of the abilities is authorized for the given model.
```php
@canAny (['create', 'edit'], $post)
```

### `@canEvery (iterable $abilities, string $model)`
Checks if all of the abilities are authorized for the given model.
```php
@canAny (['create', 'edit', 'remove'], $post)
```

### `@elseCanAny (iterable $abilities, string $model)`
Same as `@canAny`, but allowing for multiple conditionals when checking
authorizations.

### `@elseCanEvery (iterable $abilities, string $model)`
Same as `@canEvery`, but allowing for multiple conditionals when checking
authorizations.

### Inverse Methods:
The following inverse methods are also available, along with the same signatures
as their counterparts:
- `@cannotAny`
- `@cannotEvery`
- `@elseCannotAny`
- `@elseCannotEvery`
