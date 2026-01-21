# Rest Api for sitting stage
## **The testing publication**

**[`https://meet.ekoemka.com.pl/v1/swagger.yaml`](https://meet.ekoemka.com.pl/v1/swagger.yaml)**

only for developer

[`https://localhost.gicior.eu/event-system/public/v1/swagger.yaml`](https://localhost.gicior.eu/event-system/public/v1/swagger.yaml)

## Reading the documentation

If your development environment does not format REST API documentation files, you can download or install a tool found at

<https://swagger.io/tools/swagger-ui/> or <https://petstore.swagger.io/>

## Authorization

The API requires an authorization token at the moment can you use a developer's key.

`emka-dev-ZmNmZWUwOWE1ZDgwZjEwNGIyZTdkZTA2ZGYwM2M3ZmE0MTQ3M2JiY2MxYmZmNzE3MjZhZjZlN2Y4M2U0ZDJlMw==`

## Examples

For getting the guest information

```ruby
### Get guest
GET https://meet.ekoemka.com.pl/v1/api/{{party}}/guests
Authorization: Bearer {{auth_token}}
Content-Type: application/json
```

For getting your ballroom stage configuration

```ruby
### Get ballroom stage configuration
GET https://meet.ekoemka.com.pl/v1/api/{{party}}/ballroom
Authorization: Bearer {{auth_token}}
Content-Type: application/json
```

For set stage configuration

```ruby
### Set ballroom stage structure
POST https://meet.ekoemka.com.pl/v1/api/{{party}}/ballroom
Authorization: Bearer {{auth_token}}
Content-Type: application/json

{
  "ballroom": {
    "config": {},
    "elements": [
      {
        "name": "Stół 1",
        "config": {
          "type": "table"
        },
        "chairs": [
          {
            "name": "Krzesło 1",
            "person": "a3e83881-ec22-11ee-bffc-0050569974dc",
            "plate": {
              "type": "vegetable"
            }
          },
          {
            "name": "Krzesło 2",
            "person": "a3e83881-ec22-11ee-bffc-0050569974oo",
            "plate": {
              "type": "standard"
            }
          }
        ]
      }
    ]
  }
}
```

## Important question

The API will analyze the ballroom scene data to look up the person ID and match it to a guest, as well as record the table name and venue name. Therefore, it will be essential that the names of the tables on the stage and the chairs within the table are unique.

![](image.png)


