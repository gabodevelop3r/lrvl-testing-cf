<?php

namespace Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase; # esta linea se reemplaza por la libreria browser kit
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $baseUrl = 'http://localhost';


}
