<?

class JsonOutput{
	/**
	 * Set content type to json
	 * @return null don't return anything
	 */
	public static function jsonHeader(){
		header('Content-type: application/json');
	}
	/**
	 * set data to return as json
	 * @param  array $data data to return
	 * @return json return the data array as json
	 */
    public static function load(array $data){
    	return json_encode($data);
    }
}

/*
Exemplo 1
{
    status : "success",
    data : {
        "posts" : [
            { "id" : 1, "title" : "A blog post", "body" : "Some useful content" },
            { "id" : 2, "title" : "Another blog post", "body" : "More content" },
        ]
     }
}

{
    "status" : "error",
    "message" : "Unable to communicate with database"
}


Exemplo 2
{
  "data": {
    "id": 1001,
    "name": "Wing"
  }
}

{
  "error": {
    "code": 404,
    "message": "ID not found"
  }
}

http://jsonapi.org/format/

*/




