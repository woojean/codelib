<?php

class Pinyin
{
    protected static $inst = NULL;
    protected $map = array();

    public static function instance()
    {
        if (NULL == self::$inst) {
            self::$inst = new Pinyin();
        }

        return self::$inst;
    }

    function __construct()
    {
        $filePath = __dir__. '/pinyin.db';
        if (file_exists($filePath)) {
            $records = file($filePath);
            foreach ($records as $record) {
                $record = trim($record);
                $this->map[substr($record, 0, 3)] = substr($record, 4, strlen($record) - 3);
            }
        }
    }

    public function transform($str)
    {
        return $this->make($str, FALSE);
    }

    public function transformInitial($str)
    {
        return $this->make($str, TRUE);
    }

    protected function make($str, $isInitial = FALSE)
    {
        $str = trim($str);
        $newStr = "";
        $len = strlen($str);

        if ($len < 2) {
            return $str;
        }

        for ($i = 0; $i < $len; $i++) {
            if (ord($str[$i]) > 0x80) {
                $c = substr($str, $i, 3);
                $i = $i + 2;
                if (isset($this->map[$c])) {
                    if ($isInitial) {
                        $newStr .= $this->map[$c][0];
                    } else {
                        $newStr .= $this->map[$c];
                    }

                } else {
                    $newStr .= "_";
                }
            } else if (preg_match('/^[a-zA-Z0-9]$/', $str[$i])) {
                $newStr .= strtolower($str[$i]);
            } else {
                $newStr .= "_";
            }
        }

        return $newStr;
    }
}

//  ========================== demo ==================================
$pinyin = Pinyin::instance();
echo $pinyin->transform('测试');  // ceshi
echo $pinyin->transformInitial('测试');  // cs