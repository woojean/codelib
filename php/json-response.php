<?php
/**

 */

CONST SUCCESS = TRUE;
CONST FAILED = FALSE;

class Ret
{
    public $result;
    public $message;
    public $data;
    public $code;

    function __construct($result = TRUE, $message, $data = '', $code = NULL)
    {
        $this->result = $result;
        $this->message = $message;
        $this->data = $data;
        $this->code = $code;
    }

    function __toString()
    {
        return json_encode([
            'result' => $this->result,
            'message'=>$this->message,
            'data' => $this->data,
            'code' => $this->code,
        ]);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getResult()
    {
        return $this->result;
    }

    public static function responseError($message, $code = NULL)
    {
        self::responseJSON(FAILED, [],$message, $code);
    }

    public static function responseData($data)
    {
        self::responseJSON(SUCCESS, $data);
    }

    public static function responseJSON($result, $message,$data, $code = NULL)
    {
        header("Access-Control-Allow-Origin:*");
        header("content-type:application/json; charset=uft-8");
        $ret = ['result' => $result, 'code' => $code];
        $ret['data'] = $data;
        $ret['message'] = $message;
        
        echo json_encode($ret);
        exit();
    }
}

//  ========================== demo ==================================
$result = SUCCESS;
$message = 'ok!';
$data = [
    'key1'=>'value1',
    'key2'=>'value2',
    'key3'=>'value3'
];
$code = 1;

echo Ret::responseJSON($result, $message,$data, $code);



