<?php
namespace App\Library\Services\Contracts;
  
Interface PaymentGatewayInterface
{
    public function checkData();
    public function processPayment();
}