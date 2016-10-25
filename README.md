# Bright Nucleus Static Facade

[![Latest Stable Version](https://img.shields.io/packagist/v/brightnucleus/static-facade.svg)](https://packagist.org/packages/brightnucleus/static-facade)
[![Total Downloads](https://img.shields.io/packagist/dt/brightnucleus/static-facade.svg)](https://packagist.org/packages/brightnucleus/static-facade)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/brightnucleus/static-facade.svg)](https://packagist.org/packages/brightnucleus/static-facade)
[![License](https://img.shields.io/packagist/l/brightnucleus/static-facade.svg)](https://packagist.org/packages/brightnucleus/static-facade)

Abstract static Facade class to wrap around shared object instances for convenient access.

## Table Of Contents

* [Installation](#installation)
* [Basic Usage](#basic-usage)
    * [Extending The StaticFacade Class](#extending-the-staticfacade-class)
    * [Using The StaticFacadeTrait Trait](#using-the-staticfacadetrait-trait)
* [Contributing](#contributing)
* [License](#license)

## Installation

The best way to use this package is through Composer:

```BASH
composer require brightnucleus/static-facade
```

## Basic Usage

To create a static Facade, you can either extend the `StaticFacade` class or use the `StaticFacadeTrait`, depending on whether you need to extend an existing class or not.

Such a static Facade will then forward any static method calls it gets to the instance of the object it is wrapping as a dynamic method call.

As an example, let's say you have a `UserRepository` class to fetch users from. If you can't have that shared instance just be injected through the constructor (which would avoid a static coupling), you would normally either have a way of getting the shared instance through a static call (`UserRepository::getInstance()`) or have a Service Locator to get the shared instance (`Services::get('UserRepository')`). This produces cumbersome code, as every interaction with such a class consists of two separate steps.

To make this more convenient, you can provide a static Facade that abstracts away the fetching of the shared instance.

Example:

```PHP
// Without a static Facade.
$userRepository = Services::get( 'UserRepository' );
$user = $userRepository->find( $userID );

// With a static Facade.
$user = UserRepository::find( $userID );
```

> Note: This creates a tight coupling within the consuming code to the static Facade itself. This is great for getting around limitations in legacy code, and is preferable to coupling your code to the actual class being used, as you have another layer abstraction and can modify/replace the actual class as needed. However, you should **always prefer having your dependencies be injected at runtime without creating such a tight coupling**.

### Extending The StaticFacade Class

You would typically extend the `StaticFacade` class if you don't need to have your Facade extend another existing class.

Example:

```PHP
<?php declare(strict_types = 1);

namespace Example\Project;

use BrightNucleus\StaticFacade\StaticFacade;

class UserRepository extends StaticFacade
{
    
    protected static function getFacadeInstance()
    {
        // Return the shared instance of the object you are wrapping here. 
    }
}
```

### Using The StaticFacadeTrait Trait

If your Facade already extends another class, you cannot use the `StaticFacade` class, as PHP does not allow for multiple inheritance. In this case, you can make use of the `StaticFacadeTrait` that provides the same functionality.

Example:

```PHP
<?php declare(strict_types = 1);

namespace Example\Project;

use BrightNucleus\StaticFacade\StaticFacadeTrait;

class UserRepository extends AbstractRepository
{
    
    use StaticFacadeTrait;

    protected static function getFacadeInstance()
    {
        // Return the shared instance of the object you are wrapping here. 
    }
}
```

### Exception Thrown On Missing Method

By default, a `BrightNucleus\Exception\BadMethodCallException` with a detailed message is thrown when an unknown method is called through the Facade.

To provide custom exceptions, you can override the `getFacadeException` method, that has the following signature:

```PHP
protected static function getFacadeException(string $method, array $arguments) : Exception
```

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2016 Alain Schlesser, Bright Nucleus

This code is licensed under the [MIT License](LICENSE).
