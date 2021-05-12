# /api/postits

### GET
Give all postits entries with this json pattern :  
```
[  
    {  
        postItID : int,  
        postItTitle: varchar,  
        postItBody: text,  
        postItStatus: varchar,  
        postItActualPosition: varchar,  
        postItColor: varchar,  
    },  
]  
```

return http response code 200 if success or 500 if failure

### POST
Create a postit in the database, in the body of the request. The pattern wanted is :

```
[  
    {  
        postItID : null,  
        postItTitle: varchar,  
        postItBody: text,  
        postItStatus: varchar,  
        postItActualPosition: varchar,  
        postItColor: varchar,  
    },  
]  
```
return http response code 201 if success or 500 if failure


# api/postit/{id}
### PUT
Update the postit with postit data in request body : 
```
[  
    {  
        postItID : int,  
        postItTitle: varchar,  
        postItBody: text,  
        postItStatus: varchar,  
        postItActualPosition: varchar,  
        postItColor: varchar,  
    },  
]  
```

return http response code 200 if success or 500 if failure


### DELETE

Delete the postit with this id in the database
return http response code 200 if success or 500 if failure
