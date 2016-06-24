<?
/**
 * Class to handle data and transform it in JSON
 * Ex:
 * JsonOutput::jsonHeader();
 * echo JsonOutput::error(404,'Unable to connect');
 */
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
	 * @param  array $data containing data to return
	 * @return json return the data array as json
	 */
    public static function load(array $data){
    	return json_encode($data);
    }
    /**
     * set data to success json format API
     * @param  array $data containing data to return as success
     * @return json       return the data array as json in success json format API
     */
    public static function success($data){
      $data=array('data'=>$data);
      return self::load($data);
    }
    /**
     * set data to error json format API
     * @param  array $data containing data to return as error
     * @return json       return the data array as json in error json format API
     */
    public static function error($code, $message){
      $data=array('code'=>$code,'message'=>$message);
      $data=array('error'=>$data);
      return self::load($data); 
    }
}
/*
following the model bellow:

A JSON object MUST be at the root of every JSON API request and response containing data. This object defines a document’s “top level”.

A document MUST contain at least one of the following top-level members:

data: the document’s “primary data”
errors: an array of error objects
meta: a meta object that contains non-standard meta-information.
The members data and errors MUST NOT coexist in the same document.

Ex:

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




