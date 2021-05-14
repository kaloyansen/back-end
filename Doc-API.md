# /postits

### GET
Give all postits entries with this json pattern :  
```
    {  
        id : int,  
        title: varchar,  
        body: text,  
        status: varchar,  
        actualPosition: varchar,  
        color: varchar,  
    }
```

return http response code 200 if success or 500 if failure

### POST
Create a postit in the database, in the body of the request. The pattern wanted is :

```
    {    
        title: varchar,  
        body: text,  
        status: varchar,  
        actualPosition: varchar,  
        color: varchar,  
    }  
```
return http response code 201 if success or 500 if failure

# /postits/{id}

### PUT
Update the postit with postit data in request body : 
```
    {   
        title: varchar,  
        body: text,  
        status: varchar,  
        position: varchar,  
        color: varchar,  
    }
```

return http response code 200 if success or 500 if failure


### DELETE

Delete the postit with this id in the database
return http response code 200 if success or 500 if failure
