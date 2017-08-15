# API v1.0

## Auth
### Login

Request:
```
POST /auth
Content-Type: application/json
{
    "nikname": "my nikname",
    "password": "password"
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "token": "your new {{access_token}}"
}
```

### Logout

Request:
```
DELETE /auth
Authorization: Bearer {{access_token}}
```
Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```

## User



## Expense


