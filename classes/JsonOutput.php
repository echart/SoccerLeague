<?
/**
 * @user: echart
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
