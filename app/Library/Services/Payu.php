<?php
namespace App\Library\Services;

use App\Library\Services\Contracts\PaymentGatewayInterface;
  
class Payu implements PaymentGatewayInterface
{
	public function checkData(){
		return true;
	}
    public function processPayment()
    {
    	return true;
    }
}