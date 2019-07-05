# jobs

This website is an internal project for [Increaseo](https://www.increaseo.com/). 
Thanks to this website, we can manage all the tasks which have to be done.<br>
![Increaseo](https://media.licdn.com/dms/image/C510BAQHhgvihBsFNjA/company-logo_200_200/0?e=2159024400&v=beta&t=MkOLX3NblHZ5BcWoda_UK2SzAWsy6P1xPLrz11hfEqg)


## Getting Started


### Installation

First of all create a git repository on your computer : 
``` 
>  mkdir increaseo_wip
>  cd increaseo_wip
>  git init
```

It's almost done, you just have to clone the project : 
```
>  git clone https://github.com/increaseo/jobs.git
```


### Running Project

Last step, to run the website, you've to use this command:
```
>  cd jobs\job
>  composer install
```
You have to create a ``.env``, you can copy ``.env.example`` and rename it in ``.env``. In that file, your informations like database, mail, ...
```
>  php artisan key:generate
>  php artisan serve
```
Well done! now you can use the website.


## Build With
* [Laravel](https://laravel.com/) - The website framework used
* [jQuery](https://jquery.com/)
* [Datatables](https://datatables.net/reference/option/) - Used to create table
* [WorkFlowMax](https://www.workflowmax.com/api/overview) - Used to get Increaseo data
* [GuzzleHttp](http://docs.guzzlephp.org/en/stable/) - Used to exploit WorkFlowMax


## WorkFlowMax 

In the ``.env``, you can set your ``API_KEY`` and ``ACCOUNT_KEY``.

### GET Request
To get every jobs, you've to use :
```
https://api.workflowmax.com/job.api/current?apiKey=' . env('API_KEY') . '&accountKey='. env('ACCOUNT_KEY');
```
It's a ``GET Request`` so this command will list all jobs (Name, Start date, Due data, Manager,...). <br>

I'll use that Request to show how use a GET Request. We've to use Guzzle to ask these data : 
```php
<?php
use GuzzleHttp\Client;

$client = new Client();

$res = $client->request(
            'GET',
            'https://api.workflowmax.com/job.api/current?apiKey=' . env('API_KEY') . '&accountKey='. env('ACCOUNT_KEY')
        );
        
return simplexml_load_string($res->getBody());  
?>
```

You can use the method for every ``GET Request`` from WorkFlowMax, you just have to adapt the url.


### POST Request
To add a note to a job, you've to use :
```
https://api.workflowmax.com/job.api/note?apiKey=' . env('API_KEY') . '&accountKey=' . env('ACCOUNT_KEY');
```
It's a ``POST Request`` so this command will add a job. <br>

I'll use that Request to show how use a POST Request. We've to use Guzzle to add our data : 
```php
<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

$container = [];
$history = Middleware::history($container);
$stack = HandlerStack::create();
$stack->push($history);

$client = new Client(['handler' => $stack]);

$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
                <Note>
                    <Job>Complete Job Name</Job>
                    <Title>Complete Title</Title>
                    <Text>Complete Text</Text>
                </Note>';
                
$url = 'https://api.workflowmax.com/job.api/note?apiKey=' . env('API_KEY') . '&accountKey=' . env('ACCOUNT_KEY');

$request = new Request(
            'POST',
            $url,
            ['Content-Type' => 'text/xml; charset=UTF8'],
            $xml,
            ['debug' => true]
        );

$client->send($request);

$res = "";
foreach ($container as $transaction) {
    $res = $res . "\n" . (string) $transaction['request']->getBody();
}

return $res;
?>
```
You can use the method for every ``POST Request`` from WorkFlowMax, you just have to adapt the XML field and the url.


## Author
* **Mark Bucknell** 
* **Benjamin Démolin**


## Contributor
You can use the `staging` branch to do a pull request!