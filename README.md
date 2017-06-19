# revel-php

[![Build Status](https://travis-ci.org/ensembleau/revel-php.svg?branch=master)](https://travis-ci.org/ensembleau/revel-php)

A PHP SDK for interacting with the Revel Systems API.

## installation.

    $ composer require ensembleau/revel-php

## usage:

Create a new `Revel` instance:
    
    $revel = new Revel('domain', 'secret', 'key');

Access various API endpoints through this instance, e.g.

    // Get all products.
    $products = $revel->products()->all();
    
    // Get an establishment.
    $establishment = $revel->establishments()->findById(1);
    
    // Submit an online order.
    $revel->ordering()->submit(Order::one($revel, [
        // Order content.
        // ...
    ]));