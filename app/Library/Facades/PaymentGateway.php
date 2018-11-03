<?php
namespace App\Library\Facades;
use Illuminate\Support\Facades\Facade;

class PaymentGateway extends Facade{
    protected static function getFacadeAccessor() { 
 		return 'PaymentGateway'; 
    }
}