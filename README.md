# WaveApp

Simple PHP client for [WaveApp][wave-app]

The original documentation is available at: 
- [Wave - Developer Portal][wave-documentation-url]
- [API Reference][wave-api-schema]

To use WaveApp, you will need to [register][wave-create-an-app] on the developer portal.

## Requirement & Install
Open you composer.json file and add
```
"bhaktaraz/waveapp":"v1.0"
```
and go to the location of your composer file in terminal and run
```
composer update
```

### Queries

- user
- countries
- country
- businesses
- business
- currencies
- currency
- accountTypes
- accountSubTypes

### Mutations

- customerCreate
- customerPatch
- customerDelete

- accountCreate
- accountPatch
- accountArchive

- productCreate
- productPatch
- productArchive

- salesTaxCreate
- salesTaxPatch
- salesTaxRateCreate
- salesTaxArchive

- moneyTransactionCreate

- invoiceCreate
- invoiceDelete
- invoiceSend
- invoiceApprove
- invoiceMarkSent

### How to use

#### Query
```
$waveapp = new \Bhaktaraz\WaveApp\WaveApp();
$countries = $waveapp->countries();

--- OR ---

$country = $waveapp->country(['code' => 'US']);
```

#### Mutation
```
$waveapp = new \Bhaktaraz\WaveApp\WaveApp();
$customer = [
    "input" => [
        "businessId" => "<REPLACE-THIS-WITH-THE-BUSINESS-ID>",
        "name" => "The Garuda Express",
        "firstName" => "Lokendra",
        "lastName" => "Saud",
        "displayId" => "Lokendra",
        "email" => "lokendra@thegarudaexpress.com",
        "mobile" => "980000000000",
        "phone" => "01-955555",
        "fax" => "",
        "address" => [
            "addressLine1" => "Mahadevsthan",
            "addressLine2" => "Baneshwor",
            "city" => "Kathmandu",
            "postalCode" => "440466",
            "countryCode" => "NP"
        ],
        "tollFree" => "",
        "website" => "",
        "internalNotes" => "",
        "currency" => "NPR",
        "shippingDetails" => [
            "name" => "Lokendra",
            "phone" => "9800000000",
            "instructions" => "Hey",
            "address" => [
                "addressLine1" => "Mahadevsthan",
                "addressLine2" => "Baneshwor",
                "city" => "Kathmandu",
                "postalCode" => "440466",
                "countryCode" => "NP"
            ]
        ]
    ] 
];

$newCustomer = $waveapp->customerCreate($customer, "CustomerCreateInput");
```

[wave-app]: https://www.waveapps.com/
[wave-documentation-url]: https://developer.waveapps.com/hc/en-us/categories/360001114072
[wave-api-schema]: https://developer.waveapps.com/hc/en-us/articles/360019968212-API-Reference
[wave-create-an-app]: https://developer.waveapps.com/hc/en-us/sections/360003012132-Create-an-App