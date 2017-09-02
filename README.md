# API documentation

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
    "email": "bob@email.com"
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

### 2.5. Update user password

Request:
```
PUT /user/password
Authorization: Bearer {{access_token}}
Content-Type: application/json
{
    "password": "12356"
}
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

### 3.5. View expense list

Available params:

* offset  // default **0**
* limit  // default **10**
* order // default **expiry_date**
    - expiry_date 
    - expense_id
    - note
* sort // default **desc**
    - desc
    - asc
* search
* from_date // example *2017-01-01 00:00:00*
* to_date // example *2017-12-31 23:59:59*

Request:
```
GET /expense
Authorization: Bearer {{access_token}}
```

Response:
```
HTTP/1.x 200 OK
Content-Type: application/json
{
    "offset": 0,
    "limit": 10,
    "total": 12,
    "list": [
        {
            "expense_id": 7,
            "user_id": 34,
            "note": "I bought an espresso",
            "cost": 15,
            "spent_date": "2017-01-01 12:12:12"
        },
        
        ...
    ]
}
```
