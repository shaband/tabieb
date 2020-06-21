<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Patient;
use App\Notifications\PrescriptionAdded;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'Website'
], function () {

    Route::get('/', 'HomeController@index');

    try {
        view()->share('settings', \App\Models\Setting::pluck('value', 'name'));
    } catch (Exception $e) {
    }
    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('/about', 'website.about')->name('about');
    Route::view('/policy', 'website.policy')->name('policy');
    Route::view('/contact', 'website.contact')->name('contact.show');
    Route::post('/contact', 'ContactController@send')->name('contact.send');
    Route::get('/appointment/search', 'ReservationController@search')->name('reservation.search');
    Route::get('/profile/{id}/doctor', 'ReservationController@doctorProfile')->name('reservation.doctor');
    Route::get('/certifications/{id}/doctor', 'ReservationController@doctorCertifications')->name('reservation.doctor.certification');

    //just for  نمشى الشغل  لسه فيه ال biling يارب العميل ينجز
    //TODO::show biling form  with comming data  and remove  reserve direct
    Route::get('reservation/reserve', 'ReservationController@createWithoutBilling')->name('reservation.reserve')->middleware(['patient.auth']);

    Route::match(['get', 'post'], '/quick-call', 'ReservationController@QuickCall')->middleware(['patient.auth'])->name('quick-call');
    Route::match(['get', 'post'], '/quick-call/response/{reservation_id}', 'ReservationController@QuickCall')->middleware(['doctor.auth'])->name('quick-call.accept');
    Route::match(['get', 'post'], '/quick-call/respond', 'ReservationController@QuickCallRespond')->middleware(['doctor.auth'])->name('quick-call.respond');
});
Route::get('/test', 'HomeController@test');


/*social login*/
Route::get('auth/{provider}/login', 'Auth\SocialController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');

Route::get('push', function () {
    $user = Socialite::driver('facebook')->userFromToken("EAAJRRXoLxYgBAOcHgxftNpDfOqkX2zUuDgW9ejeLMEe70NWB0675TH8GbTZCWwhUtIowshINifVNEmFUU7NQCDRe9JLPqj9L6RV0cXoYz0J6rmywsJEfJwwmHS2j1RjzLlluTWlTJ1dfjDOtZCVLsm3ljXGOLVlwEugYlXYMMbZCEZCWee1x");

    dd($user);

});

Route::get('pay', function () {


    $result = \App\Services\paytabs\PayTabsFacade::authentication();

    $result = \App\Services\paytabs\PayTabsFacade::create_pay_page(array(
        //Customer's Personal Information

        'cc_first_name' => "john",          //This will be prefilled as Credit Card First Name
        'cc_last_name' => "Doe",            //This will be prefilled as Credit Card Last Name
        'cc_phone_number' => "00973",
        'phone_number' => "33333333",
        'email' => "customer@gmail.com",

        //Customer's Billing Address (All fields are mandatory)
        //When the country is selected as USA or CANADA, the state field should contain a String of 2 characters containing the ISO state code otherwise the payments may be rejected.
        //For other countries, the state can be a string of up to 32 characters.
        'billing_address' => "manama bahrain",
        'city' => "manama",
        'state' => "manama",
        'postal_code' => "00973",
        'country' => "BHR",

        //Customer's Shipping Address (All fields are mandatory)
        'address_shipping' => "Juffair bahrain",
        'city_shipping' => "manama",
        'state_shipping' => "manama",
        'postal_code_shipping' => "00973",
        'country_shipping' => "BHR",

        //Product Information
        "products_per_title" => "Product1",   //Product title of the product. If multiple products then add “||” separator
        'quantity' => "1",                                    //Quantity of products. If multiple products then add “||” separator
        'unit_price' => "6",                                  //Unit price of the product. If multiple products then add “||” separator.
        "other_charges" => "91.00",                                     //Additional charges. e.g.: shipping charges, taxes, VAT, etc.

        'amount' => "97.00",                                          //Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
        'discount' => "1",                                                //Discount of the transaction. The Total amount of the invoice will be= amount - discount
        'currency' => "USD",                                            //Currency of the amount stated. 3 character ISO currency code


        //Invoice Information
        'title' => "John Doe",               // Customer's Name on the invoice
        "msg_lang" => "en",                 //Language of the PayPage to be created. Invalid or blank entries will default to English.(Englsh/Arabic)
        "reference_no" => "1231231",        //Invoice reference number in your system
        "cms_with_version" => "API USING PHP",

        //Website Information
        "site_url" => "facebook.com",      //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
        'return_url' => config('services.paytabs.redirect'),
        "paypage_info" => "1"
    ));

    echo "FOLLOWING IS THE RESPONSE: <br />";

    dd($result);
    print_r($result);
// echo '<script type="text/javascript">
//            window.location = "'.$result->payment_url.'"
//       </script>';
// $_SESSION['paytabs_api_key'] = $result->secret_key;


});

