<?php
namespace Mpociot\BotMan\Conversations;
namespace Mpociot\BotMan\Storages;
require __dir__ . '/vendor/autoload.php';

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;

use Mpociot\BotMan\Facebook\ElementButton;
use Mpociot\BotMan\Facebook\ButtonTemplate;
use Mpociot\BotMan\Facebook\ListTemplate;
use Mpociot\BotMan\Facebook\GenericTemplate;
use Mpociot\BotMan\Facebook\ReceiptTemplate;
use Mpociot\BotMan\Facebook\ReceiptElement;
use Mpociot\BotMan\Facebook\ReceiptAddress;
use Mpociot\BotMan\Facebook\ReceiptSummary;
use Mpociot\BotMan\Facebook\ReceiptAdjustment;
use Mpociot\BotMan\Facebook\Element;
use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Answer;
 use Mpociot\BotMan\Message;
 use Mpociot\BotMan\Question;
use Illuminate\Support\Collection;
use Mpociot\BotMan\Interfaces\StorageInterface;
$config = [
    'hipchat_urls' => [
        'YOUR-INTEGRATION-URL-1',
        'YOUR-INTEGRATION-URL-2',
    ],
    'nexmo_key' => 'YOUR-NEXMO-APP-KEY',
    'nexmo_secret' => 'YOUR-NEXMO-APP-SECRET',
    'microsoft_bot_handle' => 'YOUR-MICROSOFT-BOT-HANDLE',
    'microsoft_app_id' => 'YOUR-MICROSOFT-APP-ID',
    'microsoft_app_key' => 'YOUR-MICROSOFT-APP-KEY',
    'slack_token' => 'YOUR-SLACK-TOKEN-HERE',
    'telegram_token' => 'YOUR-TELEGRAM-TOKEN-HERE',
    'facebook_token' => 'EAAKPKwkKvfwBAI1AQB7y3GcfGZCgLnYZBI88E4Hbnor9EVVOO39yOdTUfSNQVfu9ZBZButTzygNMtMdwAoNpkPpz8E8WiBfQN22Gv5QZDZD',
    'facebook_app_secret' => '3361625144091bfbf468f',
    'wechat_app_id' => 'YOUR-WECHAT-APP-ID',
    'wechat_app_key' => 'YOUR-WECHAT-APP-KEY',
];

// create an instance  4f0f61733f321a9036e0c7e17a447e00
$botman = BotManFactory::create($config);
// In your BotMan controller
$botman->verifyServices('xxx_xxx');
// give the bot something to listen for.

$botman->hears('hello', function (BotMan $bot) {
	 $bot->typesAndWaits(2);
	 $user = $bot->getUser();
	
	  $bot->reply('Namaskar '.$user->getFirstName().' '.$user->getLastName());
    $bot->reply('Let me assist you with your query You can type cancel or x at any pont to exit this conversion.
Thease Services are offered by eMitra.');
	$bot->reply('Please enter your mobile address for one time registration.');
	
	
});
$botman->hears('([0-9]+)', function ($bot, $number) {
	
    $bot->reply('Thank You for your registration.' );
	$bot->reply('This is a Your default '.$number.' For all Transctions.');
	
	 $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('To get started,check our provided services and select or type.Thease services are provided by eMitra.')
	->addButton(ElementButton::create('Services')->type('postback')->payload('Services'))
	
->addButton(ElementButton::create('Bill Payment')->type('postback')->payload('Bill Payment'))	
->addButton(ElementButton::create('Kiosk Locater')->type('postback')->payload('Kiosk Locater'))
	
);
});
$botman->hears('Hi', function ($bot) {

	
	 $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('To get started,check our provided services and select or type.Thease services are provided by eMitra.')
	->addButton(ElementButton::create('Services')->type('postback')->payload('Services'))
	
->addButton(ElementButton::create('Bill Payment')->type('postback')->payload('Bill Payment'))	
->addButton(ElementButton::create('Kiosk Locater')->type('postback')->payload('Kiosk Locater'))
	
);
});

//bill payment

$botman->hears('Bill Payment', function ($bot) {
	 $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('Please select the option. Which bill do you want to pay?')
	->addButton(ElementButton::create('Electricity')->type('postback')->payload('Electricity'))
	->addButton(ElementButton::create('PHED')->type('postback')->payload('PHED'))
->addButton(ElementButton::create('Mobile Bill')->type('postback')->payload('Mobile Bill'))	
	
);});
 
 
 //services
 $botman->hears('Services', function ($bot) {
	 $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('Please select the option.')
	->addButton(ElementButton::create('Status')->type('postback')->payload('Status'))
	->addButton(ElementButton::create('Service Rate')->type('postback')->payload('Service Rate'))

	
);});

//service status
$botman->hears('Status', function ($bot) {
	  $bot->reply('Please Enter receipt number to get the status of your application.' );
	
	
	 //$bot->startConversation(new getstatus);
	
	
});
$botman->hears('abc', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Your application status is under process.' );
	
$bot->reply(ButtonTemplate::create('Can i inform you when it is approved.')
	->addButton(ElementButton::create('Yes')->type('postback')->payload('syes'))
	->addButton(ElementButton::create('No')->type('postback')->payload('sno'))
);
});
$botman->hears('syes', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('thank you. I will inform you when it was done.' );
	


});
$botman->hears('sno', function ($bot) {
	$bot->typesAndWaits(2);
	$bot->reply('Say Hi any time to fetch eMitra services' );
    $bot->reply('Thank you.' );
	 


});

//
//service rate
$botman->hears('Service Rate', function ($bot) {
	  $bot->reply('There are 383 service rate list found.Here are some list.' );
	   $bot->reply('Please type or select one of this  service name.' );
	  
	
	$bot->reply(ListTemplate::create()
	->useCompactView()
	->addGlobalButton(ElementButton::create('view more')->payload('viewm')->type('postback'))
	->addElement(
		Element::create('APPLICATION FOR RENEWAL OF DEALERS LICENSE FOR SEED')
			->subtitle('AGRICULTURE DEPARTMENT')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('View Rate')
				->payload('view1')->type('postback'))
	)
	->addElement(
		Element::create('Amendment in Seed License')
			->subtitle('AGRICULTURE DEPARTMENT')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('View Rate')
				->payload('view2')->type('postback')
			)
	)
);

	 //$bot->startConversation(new getstatus);
	
	
});
$botman->hears('viewm', function ($bot) {
	 
	$bot->reply(ListTemplate::create()
	->useCompactView()
	->addGlobalButton(ElementButton::create('view more')->payload('viewm1')->type('postback'))
	->addElement(
		Element::create('Amendment in fertilizer licence')
			->subtitle('	AGRICULTURE DEPARTMENT')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('View Rate')
				->payload('view3')->type('postback'))
	)
	->addElement(
		Element::create('Application for Sale Permission')
			->subtitle('AGRICULTURE DEPARTMENT')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('View Rate')
				->payload('view4')->type('postback')
			)
	)
);

	 //$bot->startConversation(new getstatus);
	
	
});

$botman->hears('view1', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Service Rate.' );
	 $bot->reply('Service Commission Charge: 32' );

});
// Electricity bill
$botman->hears('Electricity', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Using Your defalut no.7501429163.' );
	  $bot->reply('Checking your bill details' );
 $bot->reply('Amount To Be Paid 1000' );
 $bot->reply(ButtonTemplate::create('Can you pay your bill?')
	->addButton(ElementButton::create('Yes')->type('postback')->payload('eyes'))
	->addButton(ElementButton::create('No')->type('postback')->payload('eno'))
);
});

$botman->hears('eyes', function ($bot) {
	$bot->typesAndWaits(2);
   $bot->reply(ButtonTemplate::create('Please select the payment gateways.')
	->addButton(ElementButton::create('Credit card')->type('postback')->payload('cc'))
	->addButton(ElementButton::create('Debit Card')->type('postback')->payload('dc'))
->addButton(ElementButton::create('Mobile Wallet')->type('postback')->payload('mw'))	
	
);
});
$botman->hears('cc', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Credit card Details' );
	 $bot->reply('Your Credit card Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(1000)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(1000)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('dc', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Debit card Details' );
	 $bot->reply('Your Debit card Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(1000)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(1000)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('mw', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Mobile Wallet Details' );
	 $bot->reply('Your Mobile Wallet Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(1000)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(1000)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('eno', function ($bot) {
	$bot->typesAndWaits(2);
	 $bot->reply('Please pay your bill before are due date are over.' );
	 $bot->reply('Say Hi any time to fetch eMitra services' );
    $bot->reply('Thank you.');
	

});

// Electricity bill
$botman->hears('Mobile Bill', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Using Your defalut no.7501429163.' );
	
	$bot->reply('What is your phone oreator e.g. BSNL/IDEA/MTS/VODAFONE' );
	  
 $bot->reply('Amount To Be Paid 500' );
 $bot->reply(ButtonTemplate::create('Can you pay your bill?')
	->addButton(ElementButton::create('Yes')->type('postback')->payload('myes'))
	->addButton(ElementButton::create('No')->type('postback')->payload('mno'))
);
});

$botman->hears('myes', function ($bot) {
	$bot->typesAndWaits(2);
   $bot->reply(ButtonTemplate::create('Please select the payment gateways.')
	->addButton(ElementButton::create('Credit card')->type('postback')->payload('mcc'))
	->addButton(ElementButton::create('Debit Card')->type('postback')->payload('mdc'))
->addButton(ElementButton::create('Mobile Wallet')->type('postback')->payload('mmw'))	
	
);
});
$botman->hears('mcc', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Credit card Details' );
	 $bot->reply('Your Credit card Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(500)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(500)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('dc', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Debit card Details' );
	 $bot->reply('Your Debit card Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(500)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(500)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('mw', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Checking Your Mobile Wallet Details' );
	 $bot->reply('Your Mobile Wallet Details is ok.' );
	 $user = $bot->getUser();
	 $bot->reply(
	ReceiptTemplate::create()
		->recipientName(''.$user->getFirstName().' '.$user->getLastName())
		->merchantName('Visa')
		->orderNumber('7501429163')
		->timestamp('1428444852')
		->orderUrl('http://aida.ai')
		->currency('INR')
		->paymentMethod('VISA')
		->addElement(ReceiptElement::create('Electricity Bill')->price(15.99)->image('http://aida.ai/img/botman-body.png'))
		
		->addAddress(ReceiptAddress::create()
			->street1('Kota')
			->city('kota')
			->postalCode(324010)
			->state('Rajasthan')
			->country('India')
		)
		->addSummary(ReceiptSummary::create()
			->subtotal(500)
			->shippingCost(0)
			->totalTax(0)
			->totalCost(500)
		)
		->addAdjustment(ReceiptAdjustment::create('Laravel Bonus')->amount(5))
);


});
$botman->hears('mno', function ($bot) {
	$bot->typesAndWaits(2);
  	 $bot->reply('Please pay your bill before are due date are over.' );
	 $bot->reply('Say Hi any time to fetch eMitra services' );
    $bot->reply('Thank you.');

});


//kiosk locater

$botman->hears('Kiosk Locater', function ($bot) {
	$bot->typesAndWaits(2);
    $bot->reply('Which district kiosk you are looking for?' );
	
	
});

$botman->hears('Kota', function ($bot) {
	$bot->typesAndWaits(2);
	$bot->reply('looking for kiosk details in kota' );
	
   $bot->reply(ButtonTemplate::create('please select address type')
	->addButton(ElementButton::create('Urban')->type('postback')->payload('Urban'))
	->addButton(ElementButton::create('Rural')->type('postback')->payload('Rural'))

	
);
});
$botman->hears('Urban', function ($bot) {
	$bot->typesAndWaits(2);
    //$bot->reply('please enter Municipanly name' );
	 
	 
	 $bot->reply(GenericTemplate::create()
	->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
	->addElements([
		Element::create('Kiosk Name')
			->subtitle('Kiosk Address and Mobile Number')
			->image('http://aida.ai/img/botman-body.png')
			->addButton(ElementButton::create('Visit')->url('https://www.google.co.in/maps/place/UIT+Auditorium,+Sector+-+A,+Rangbari,+Kota,+Rajasthan+324010/@25.1296034,75.8305925,17z/data=!4m13!1m7!3m6!1s0x396f84ed7e2235a9:0xfad31938f404fdc4!2sUIT+Auditorium,+Sector+-+A,+Rangbari,+Kota,+Rajasthan+324010!3b1!8m2!3d25.1294264!4d75.8328775!3m4!1s0x396f84ed7e2235a9:0xfad31938f404fdc4!8m2!3d25.1294264!4d75.8328775?hl=en'))
			->addButton(ElementButton::create('call')
				->payload('call')->type('postback')),
		Element::create('Kiosk Name')
			->subtitle('Kiosk Address and Mobile Number')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('Search More')
				->url('http://emitra.rajasthan.gov.in/content/emitra/en/Kiosklocator.html')
				
			)
			->addButton(ElementButton::create('call')
				->payload('call')->type('postback'))
	])
);

});
$botman->hears('Rural', function ($bot) {
	$bot->typesAndWaits(2);
    //$bot->reply('please enter Municipanly name' );
	 
	 $bot->reply(GenericTemplate::create()
	->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
	->addElements([
		Element::create('Kiosk Name')
			->subtitle('Kiosk Address and Mobile Number')
			->image('http://aida.ai/img/botman-body.png')
			->addButton(ElementButton::create('Visit')->url('https://www.google.co.in/maps/place/UIT+Auditorium,+Sector+-+A,+Rangbari,+Kota,+Rajasthan+324010/@25.1296034,75.8305925,17z/data=!4m13!1m7!3m6!1s0x396f84ed7e2235a9:0xfad31938f404fdc4!2sUIT+Auditorium,+Sector+-+A,+Rangbari,+Kota,+Rajasthan+324010!3b1!8m2!3d25.1294264!4d75.8328775!3m4!1s0x396f84ed7e2235a9:0xfad31938f404fdc4!8m2!3d25.1294264!4d75.8328775?hl=en'))
			->addButton(ElementButton::create('call')
				->payload('call')->type('postback')),
		Element::create('Kiosk Name')
			->subtitle('Kiosk Address and Mobile Number')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('visit')
				->url('http://emitra.rajasthan.gov.in/content/emitra/en/Kiosklocator.html')
				
			)
			->addButton(ElementButton::create('call')
				->payload('call')->type('postback'))
	])
);


});

$botman->hears('cancel', function ($bot) {
	$bot->typesAndWaits(2);
	 $bot->reply('Say Hi any time to fetch eMitra services' );
	$bot->reply('Thank You.' );

});
$botman->hears('x', function ($bot) {
	$bot->typesAndWaits(2);
	 $bot->reply('Say Hi any time to fetch eMitra services' );
	$bot->reply('Thank You.' );
	
   
});









$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands.');
});
// start listening
$botman->listen();

?>