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
Content-Type: application/json
{
    "token": "your new token"
}
```

### Logout

Request:
```
POST /auth
```
Response:
```
Content-Type: application/json
{
    "token": "your new token"
}
```

## User

## Expense


