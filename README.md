# Icarros SDK
This open-source library allows you to integrate Icarros into your app. Learn more about the provided samples, documentation, integrating the SDK into your app, accessing source code, and more at https://paginasegura.icarros.com.br/apidocs/index.html

## Dependencies
List of dependencies for use sdk

  - PHP >= 5.4
  - Curl
  - Composer 
  - Apache

## Features!
  - Import data from Icarros system to use in your aplication
  - Create forms in your application, update inventory, and get the list of leads.

You can also:
  - Generate access authorization
  - Generate access token 
  - Access your icarros account
  - Get everything you need 

The Website of iCarros Ltda, is intended to disclose advertisements, surveys, as well as any information and news relating to motor car. This application allows you to make requests in icarros and use many resources, like: leads, inventory, create forms in your application, new ads registration in icarros account.

## Give Feedback
Please report bugs or issues to https://github.com/Veloccer/icarros/issues

## Get Start

### include class
#### OAuth - Autentication
```sh
include('app/authentication/OAuth.php');
```

#### Inventory - Other functions
```sh
include('app/inventory/Inventory.php');
```

## Instalation
step by step - not ready

## Access Token
### Step 1 - Authorization
The authorization sequence is started when your application uses the OAuth class and the getAccessAuthorization function to obtain the authorization code, the parameters that must be passed are described in the example below.

| Param | Description| 
| ------ | ------ |
| response_type | Determines that the authentication server must return an authorization code.
| client_id | Identifies the client making the request
| redirect_uri | Determines where the response will be sent. The customer will need to provide this URL and go to the iCarros customer service team to register on the Authorization Server.
| scope | Identifies the type of access your app is requesting. Eg for inventory integration the request is 'anuciantepj' what does it mean advertiserpj. For integration of assembler offers the request is grouped. The usersite permission is required.

```sh
$params = new \stdClass();
$params->response_type= 'code';
$params->client_id= 'your_client_id';
$params->redirect_uri= 'your_redirect_url';
$params->scope=$data['scope1, scope2, ...']; /*ex: anunciantepj*/
$params->grant_type='authorization_code';

$access = new OAuth($params);
$authorization = $access->getAccessAuthorization($params);
```

### Step 2 - Access Token
After receiving the authorization code it is necessary to use a new function called getAccessToken($params) with the authorization code as parameter, in addition to the previous values, observe the example below.

| Param | Description| 
| ------ | ------ |
| scope | Determines that the authentication server must return an authorization code.
| client_id | Identifies the client making the request
| redirect_uri | Determines where the response will be sent. The customer will need to provide this URL and go to the iCarros customer service team to register on the Authorization Server.
| client_secret | Identifies the type of access your app is requesting. Eg for inventory integration the request is 'anuciantepj' what does it mean advertiserpj. For integration of assembler offers the request is grouped. The usersite permission is required.
|grant_type|  As defined in the OAuth 2.0 specification, this field must contain the "authorization_code" value.

```sh
$authorization = $access->getAccessAuthorization($params);

$params = new \stdClass();
$params->client_id= 'your_client_id';
$params->redirect_uri= 'your_redirect_url';
$params->scope= $authorization;
$params->client_secret = 'your_client_secret'
$params->grant_type='authorization_code';
$accesToken = $access->getAccessToken($params);
$token = $acessToken->access_token; /*Must be stored for future requests*/ 
```

### Step 3 - Reflesh Token
The application must store the update token for future use and use the access token to access the iCarros APIs. Once the access token expires, the application must use the getRefreshtoken($data) update function to get a new access token.
Along with the access token (access_token) the authorization server will send a session refresh token (refresh_token), as well as other relevant data such as the token expiration time (expires_in), and an id token (id_token). The return is in JSON format.
Access tokens have limited lifespan - usually no more than 1 hour. If you need access to the iCarros API beyond the lifetime of a single access token, you can get a new token using the refresh_token.

| Param | Description| 
| ------ | ------ |
| refresh_token | The refresh token, value returned at the request of the token.
| client_id | Identifies the client making the request
| client_secret | Identifies the type of access your app is requesting. Eg for inventory integration the request is 'anuciantepj' what does it mean advertiserpj. For integration of assembler offers the request is grouped. The usersite permission is required.
|grant_type|  As defined in the OAuth 2.0 specification, this field must contain the "refresh_token" value.

```sh
$accesToken = $access->getAccessToken($params);

$params = new \stdClass();
$params->client_id= 'your_client_id';
$params->refresh_token= $accesToken->refresh_token;
$params->client_secret = 'your_client_secret';
$params->grant_type='refresh_token';
$accesToken = $access->getRefreshToken($params);
```

### Step 4 - Offline Token
It is useful for applications that need to be able to do some actions on behalf of the user, even after it terminates the current session. With a refresh token offline, you can access icarros APIs at any time, on behalf of the user who granted it, until that user revokes that authorization or the client is inactive for a long period of time (6 months).
For example, imagine you needs to update inventory every day at midnight. This application needs to perform this access without the client entering the system with his password and authorize, every time. To do this, the user authorizes the application to have an offline refresh token, instead of the classic refresh token, at the time of its first authentication. The only change you need to make to offline token request is to add scope = offline_access parameter during the authorization request to the iCarros server (step 1).

```sh
$params = new \stdClass();
$params->response_type= 'code';
$params->client_id= 'your_client_id';
$params->redirect_uri= 'your_redirect_url';
$params->scope= ['anunciantepj', 'offline_access'];
$params->grant_type='authorization_code';

$access = new OAuth($params);
$authorization = $access->getAccessAuthorization($params);
```

## List Operations
List of functions and operations that can be used by sdk

### using token
For all requests using integration sdk it is necessary to pass the token to an object $data.
```sh
$data = new \stdClass();
$data->token = $token; /* Token got on authentication */
```

### getColors
Returns the encoding for the colors field to be used for ad inclusion
```sh
$inventory = new Inventory();
$colors = $inventory->getColors($data);
```
#### return
type  | description
----- | --------
array | ['id'=>id, 'nome'=>]

### getEquipments
Returns the encoding for the equipments field (optional for the car) to be used for ad inclusion
```sh
$inventory = new Inventory();
$equipments = $inventory->getEquipments($data);
```

### getFuelTypes
Returns the encoding for the fuel field to be used for ad inclusion
```sh
$inventory = new Inventory();
$fuel = $inventory->getFuelTypes($data);
```

### GetMakes
Returns the list of tags and their encoding in iCarros
```sh
$inventory = new Inventory();
$makes = $inventory->getMakes($data);
```

### GetModels
Returns the list of templates and their encoding in iCarros. The tag is associated with make id.
```sh
$inventory = new Inventory();
$data->makeId = $make->id; /* Belong to the make, represented by id in make. */
$models = $inventory->getModels($data);
```

### GetModelsLauch 
Returns the list of newly released templates and their encoding in iCarros. The tag is associated with id.
```sh
$inventory = new Inventory();
$modelsLaunch = $inventory->getModelsLaunch($data);
```

### getPublishProviders
Returns the destinations in which ads can be published
```sh
$inventory = new Inventory();
$publish = $inventory->getPublishProviders($data);
```

### getReviews
Returns the Reviews of a model according to the year
```sh
$inventory = new Inventory();
$data->modelYear=YYYY;
$data->modelId=$model->id; /* Belong to the model, represented by id in model. */
$reviews = $inventory->getReviews($data);
```

### getTransmissions
Returns the encoding for the transmission field to be used for ad inclusion
```sh
$inventory = new Inventory();
$transmissions = $inventory->getTransmissions($data);
```

### getTrims
Returns the list of versions and their encoding in iCarros. Versions are a specialization of the model and are associated with it by the id.
```sh
$inventory = new Inventory();
$data->makeId= $make->id; /* Belong to the make, represented by id in make. */
$data->modelYear=YYYY;
$data->modelId=$model->id; /* Belong to the model, represented by id in model. */
$trim = $inventory->getTrims($data);
```

### getPricestats
Returns the minimum, average and maximum price announced for the car in iCarros (Brazil and, if possible, in the state) along with the Fipe price.
```sh
$inventory = new Inventory();
$data->trimId= $trim-> id; /* Belong to the trim, represented by id in trim. */
$data->year= YYYY;
$data->km= 25000; /* amount of km */ 
$pricestats = $inventory->getPricestats($data);
```

### getDealer
List of Dealers to which this login has access
```sh
$inventory = new Inventory();
$dealer = $inventory->getDealer($data);
```

### getDealerCalls
Search for incoming calls.
```sh
$inventory = new Inventory();
$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$dealerCalls = $inventory->getDealerCalls($data);
```

### getDealerInventory
List the dealer's current inventory (inventory are many deals)
```sh
$inventory = new Inventory();
$data->dealerId = deale->id; /* Belong to the dealer, represented by id in dealer. */
$inventory = $inventory->getDealerInventory($data);
```

### createDeal
Create a new ad
```sh
$inventory = new Inventory();
$fields = new \stdClass();

$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */

/* id trim. */
$fields->trimId = 0;
/* car year */
$fields->productionYear = YYYY;
/* model year */
$fields->modelYear = YYYY;
/* doors number */
$fields->doors = 0;
/* color id */
$fields->colorId = 0;
/* km number */
$fields->km = 0;
/* price */
$fields->price = 0;
/* Resale price */
$fields->priceResale = 0;
/* fuel id*/
$fields->fuelId = 0;
/* plate car */
$fields->plate = "";
/* some text */
$fields->text= "";
/* dealer id */
$fields->dealerId= 0;
/* when ads initical */
$fields->initialDateDisplay = '2017-01-01T13:14:01.429Z';
/* when ads stop */
$fields->dateDisplayEnd = '2017-01-31T13:14:01.429Z';
/* equipments id */
$fields->equipmentsIds = [];
/* photos ids*/
$fields->photosIds=[];

$data->fields = $fields;
$dealId = $inventory->createDeal($data);
```

### deleteDealer
Delete an ad
```sh
$inventory = new Inventory();
/* Belong to the dealer, represented by id in dealer. */
$data->dealerId = dealer->id; 
/* Belong to the deal, represented by id in deal. */
$data->dealId; 
$dealerCalls = $inventory->deleteDeal($data);
```


### getDataDeal
Returns the current data of the requested ad
```sh
$inventory = new Inventory();
/* Belong to the dealer, represented by id in dealer. */
$data->dealerId = dealer->id; 
/* Belong to the deal, represented by id in deal. */
$data->dealId; 
$dealerCalls = $inventory->getDataDeal($data);
```

### updateDeal
Update ad with uploaded data
```sh
$inventory = new Inventory();
$fields = new \stdClass();

$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->dealId = deal->id; /* Belong to the deal, represented by id in deal. */

/* id deal. */
fields->dealId = 0; /*id belong the deal will update */
/* id trim. */
$fields->trimId = 0;
/* car year */
$fields->productionYear = YYYY;
/* model year */
$fields->modelYear = YYYY;
/* doors number */
$fields->doors = 0;
/* color id */
$fields->colorId = 0;
/* km number */
$fields->km = 0;
/* price */
$fields->price = 0;
/* Resale price */
$fields->priceResale = 0;
/* fuel id*/
$fields->fuelId = 0;
/* plate car */
$fields->plate = "";
/* some text */
$fields->text= "";
/* dealer id */
$fields->dealerId= 0;
/* when ads initical */
$fields->initialDateDisplay = '2017-01-01T13:14:01.429Z';
/* when ads stop */
$fields->dateDisplayEnd = '2017-01-31T13:14:01.429Z';
/* equipments id */
$fields->equipmentsIds = [];
/* photos ids*/
$fields->photosIds=[];

$data->fields = $fields;
$dealId = $inventory->updateDealer($data);
```

### createNewPicture
Creates a new image for the informed ad
```sh
$inventory = new Inventory();
$fields = new \stdClass();

$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->dealId = deal->id; /* Belong to the deal, represented by id in deal. */

/* Image code in base64 */
$fields->content = "";
/* type mime */
$fields->mimetype = ""; /*image/jpeg or image/png*/

$data->fields = $fields;
$imageId = $inventory->createNewPicture($data);
```

### deletePicture
Removes an ad image
```sh
$inventory = new Inventory();

$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->dealId = deal->id; /* Belong to the deal, represented by id in deal. */
$data->imageId = $image->id; /* Belong to the image, represented by id in image. */

$image = $inventory->deletePicture($data);
```

### reorderPicture
Reorder the ad images in the order they were sent (ids of the images separated by underline eg 123_432_9832)
```sh
$inventory = new Inventory();

$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->dealId = deal->id; /* Belong to the deal, represented by id in deal. */
$data->imageId = $image->id; /* Belong to the image, represented by id in image. */

$images = $inventory->reorderPicture($data);
```

### getLeads
Returns all email and financing leads (grouped by user) in the last 90 days
```sh
$inventory = new Inventory();
$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$leads = $inventory->getLeads($data);
```

### getLeadsSiceDate
Search for email and financing leads (grouped by user) from the requested date
```sh
$inventory = new Inventory();
$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->data=yyyyMMddHHmmss;
$leads = $inventory->getLeadsSiceDate($data);
```

### getInvoicesBetweenDates
List invoices betwen dates
```sh
$inventory = new Inventory();
$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$data->data=yyyyMMddHHmmss;
$data->initial_data = yyyy-mm-dd
$data->final_date = yyyy-mm-dd
$leads = $inventory->getLeadsSiceDate($data);
```

### getProducts
```sh
$inventory = new Inventory();
$data->dealerId = dealer->id; /* Belong to the dealer, represented by id in dealer. */
$leads = $inventory->getProducts($data);
```
# Error
```sh
array(2) { 
    ["status"]=> string(4) "fail" 
    ["message"]=> string(101) "Mensage Error!" 
  } 
```

# License
Icarros SDK is Copyright © 2017 haganicolau.

It is free software, and may be redistributed under the terms specified in the [LICENSE.txt](https://github.com/Veloccer/icarros/blob/master/LICENSE.txt)