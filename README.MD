# To run rcp server

```sh
$ docker-compose up
```

The RPC server will run on:

```sh
localhost:1337
```

# To run tests

```sh
$ cd ./app
$ phpunit
```

# Example POST request body

```json
{
	"jsonrpc": "2.0",
	"method": "parse",
	"params": ["+38111223435"],
	"id": "1"
}
```

# Example response

```json
{
    "jsonrpc": "2.0",
    "result": {
        "mno": "",
        "country": "RS",
        "countryDialingCode": 381,
        "number": "11223435",
        "isValid": true
    },
    "id": "1"
}
```

# Example response from mobile number

```json
{
    "jsonrpc": "2.0",
    "result": {
        "mno": "Telenor",
        "country": "RS",
        "countryDialingCode": 381,
        "number": "69445663",
        "isValid": true
    },
    "id": "1"
}
```