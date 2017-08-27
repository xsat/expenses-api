# API v1.0

## 1. Auth
### 1.1. Login

Request:
```
POST /auth
Content-Type: application/json
{
    "email": "bob@email.com",
    "password": "12356"
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "token": "{{access_token}}"
}
```

### 1.2. Logout

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

## 2. User

### 2.1. Create user

Request:
```
POST /user
Content-Type: application/json
{
    "name": "Bob",
    "email": "bob@email.com",
    "password": "12356"
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "token": "{{access_token}}"
}
```

### 2.2. Update user

Request:
```
PUT /user
Authorization: Bearer {{access_token}}
Content-Type: application/json
{
    "name": "Bob",
    "email": "bob@email.com",
    "password": "12356"
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```

### 2.3. View user

Request:
```
GET /user
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "user_id": 1,
    "name": "Bob",
    "email": "bob@email.com"
}
```

### 2.4. Delete user

Request:
```
DELETE /user
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```

## 3. Expense

### 3.1. Create expense

Request:
```
POST /expense
Authorization: Bearer {{access_token}}
Content-Type: application/json
{
    "note": "I bought an espresso", // optional
    "cost": 15.00,
    "spent_date": "2017-01-01 12:12:12" // optional
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "expense_id": 2,
    "user_id": 17,
    "note": "I bought an espresso",
    "cost": 15,
    "spent_date": "2017-01-01 12:12:12"
}
```

### 3.2. Update expense

Request:
```
PUT /expense/{{expense_id}}
Authorization: Bearer {{access_token}}
Content-Type: application/json
{
    "note": "I bought an espresso", // optional
    "cost": 20.00,
    "spent_date": "2017-01-01 12:12:12" // optional
}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```


### 3.3. View expense

Request:
```
GET /expense/{{expense_id}}
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "expense_id": 2,
    "user_id": 17,
    "note": "I bought an espresso",
    "cost": 15,
    "spent_date": "2017-01-01 12:12:12"
}
```

### 3.4. Delete expense

Request:
```
DELETE /expense/{{expense_id}}
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```


### 3.4. View expense list

Request:
```
GET /expense
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{}
```
