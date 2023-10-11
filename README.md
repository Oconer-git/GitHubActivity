# GitHubActivity
API for managing a list of names in a SQL database. It provides endpoints for creating, reading, updating, and deleting name records.

## API Description
This API allows you to perform basic CRUD (Create, Read, Update, Delete) operations on a list of names stored in a MySQL database. You can use this API to add, retrieve, update, and delete name records.

## API Endpoints
The following are the available endpoints of the API:

1. **Create a Name**
   - Endpoint: `/postName`
   - Method: `POST`
   - Description: Add a new name to the database.
   - Request Payload:
     ```json
     {
         "lname": "Lastname",
         "fname": "Firstname"
     }
     ```
   
2. **Get All Names**
   - Endpoint: `/getName`
   - Method: `GET`
   - Description: Retrieve a list of all names in the database.

3. **Delete a Name**
   - Endpoint: `/delName/{id}`
   - Method: `DELETE`
   - Description: Delete a name record with a specific ID from the database.

4. **Update a Name**
   - Endpoint: `/updateName/{id}`
   - Method: `PUT`
   - Description: Update a name record with a specific ID in the database.
   - Request Payload:
     ```json
     {
         "lname": "UpdatedLastname",
         "fname": "UpdatedFirstname"
     }
     ```


## Request Payload
### `POST /postName`
- Endpoint for inserting information into the database.
- Request payload structure (JSON):

    ```json
    {
        "lname": "Last Name",
        "fname": "First Name"
    }
    ```

### `PUT /updateName/{id}`
- Endpoint for updating information into the database.
- Request payload structure (JSON):

    ```json
        {
        "lname": "New Last Name",
        "fname": "New First Name"
    }
     ```

## Response
The API responses follow a JSON format and may include the following structures:

 - Success Response:

    ```json
    {
        "status": "success",
        "data": {...}
    }
    ```

 - Error Response

    ```json
    {
        "status": "error",
        "message": "Error message here"
    }
    
    ```


## Usage
Provide codeexamples or instructions on how to use your API.

### Insert Data
To insert data into the database, make a POST request to the following endpoint:
    ```POST http://localhost/api/public/postName```

- Provide the required JSON payload in the request body.


### Get Data
To retrieve a list of data from the database, make a GET request to the following endpoint:
    ```GET http://localhost/api/public/getName```

- Provide the required JSON payload in the request body.


### Update Data
To update data in the database, make a PUT request to the following endpoint, specifying the ID of the record to be updated:
    ```PUT http://localhost/api/public/updateName/{id}```

- Provide the required JSON payload in the request body.

### Delete Data
To delete data from the database, make a DELETE request to the following endpoint, specifying the ID of the record to be deleted:
    ```DELETE http://localhost/api/public/delName/{id}```

- Provide the required JSON payload in the request body.

Make sure to replace http://localhost with the appropriate base URL for your API. Use a tool like Postman to interact with the API endpoints.


## License
Apache License

## Contributors
github: LaptopNaAcer
github: Gabbbbb21

## Contact
information for inquiries or support
contact: donellpie@gmail.com

