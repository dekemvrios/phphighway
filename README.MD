# README

## HighWay

HighWay é um mecanismo desenvolvido para abstrair o processo de gerenciamento de rotas a partir do Slim Framework 3


## Como instalar?

Esse pacote foi estruturado para ser instalado por meio do composer

```
composer require solis/highway
``` 

## Como utilizar?

Primeiramente é necessário definir um schema, representando as rotas a serem criadas para a aplicação 

```
[
    {
       "request": {
         "uri": "/sample/get/",
         "method": "GET",
         "controller": {
           "class": "Sample\\Classes\\Sample",
           "method": "find"
         }
       },
       "middleware": {
          "auth"
        },
       "response": {
         "sType": "withJson"
       }
    }
]
```

Crie uma instancia da classe SlimHighWay e utilize o método estático make para vincular novas rotas a respectiva instancia

```
use HighWay\Wrappers\SlimApp\SlimHighWay;

$routes = json_decode(file_get_contents('src/Routes/sample.json'), true)

$app = SlimHighWay::make($routes);

$app->run();
```

O SlimHighWay será responsável por criar instâncias de rotas utilizadas pelo Slim Framework 3 de acordo com as especificações existentes no schema.