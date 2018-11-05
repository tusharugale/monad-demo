## Monad Demo - E Shopping Application 

- Please use added public/db.sql file, so you can see products.
- Please login to use this application.
Email - tusharugale.work@gmail.com
Password - 123456789

## Basic

This application simply depicts the Ecommerce experience we have for online shopping.
- User see through products
- User add prodcts to cart
- Once cart has atleast one product, user can proceed for payment
- And Finally, Pays the amount through payment gateway.
- After that user can see these orders into "Orders" page.

## What makes this application special.

Facade - App\Library\Facades\PaymentGateway

Service Provider - App\Providers\PaymentGatewayServiceProvider

- This two features makes this application special.
If you go to PaymentGatewayServiceProvider, you can see I have bind "PaymentGateway" in register method, which will be bind the object of "Citrus" to container and at runtime any method or constructor requires this object can resolve it.

- We can swap the payment gateway at any time.
If you want to swap payment gateway in near future then using service provider is the best option, as you dont need to change the code in any controller or model. Just make a new entry in Service provider and return its object.

- So, Why we need Facade?
Facade can be looked as a black box, which can recieve a particular command or instruction and return the result, without user knowing about the internal complexities.
This is the same thing I have achived here. Facade "PaymentGateway" statically call the method from its Alias, and give a feeling of less complexity. Behing the scenes, it returns the name of the binding, which resolves this binding from service container, and from the resolved object(Citrus) calls the method (processPayment).