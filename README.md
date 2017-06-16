# revel-php

[![Build Status](https://travis-ci.org/ensembleau/revel-php.svg?branch=master)](https://travis-ci.org/ensembleau/revel-php)

A PHP SDK for interacting with the Revel Systems API.

## usage:

Create a new `Revel` instance:
    
    $revel = new Revel('domain', 'secret', 'key');

Access various API endpoints through this instance, e.g.

    $products = $revel->products()->all();
    $establishment = $revel->establishments()->findById(1);