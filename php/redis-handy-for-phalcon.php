<?php
/**
php.ini
extension = hprose.so
extension = seaslog.so
extension = swoole.so
extension = redis.so 
extension=phalcon.so
*/

use \Phalcon\Cache\Backend\Redis;

class MyRedis extends Redis
{
    CONST KEY_NOT_FOUNT = NULL;

    CONST DEFAULT_TTL   = 10800;  // 3 day
    CONST FOREVER_TTL   = -1;     
    CONST TODAY_TTL     = 0;

    CONST VALUE_TYPE_STRING = 'string';
    CONST VALUE_TYPE_HASH   = 'hash';
    CONST VALUE_TYPE_ZSET   = 'zset';
    CONST VALUE_TYPE_SET    = 'set';
    CONST VALUE_TYPE_JSON   = 'json';


    public function get($keyName, $deserialize = FALSE)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        $result = $this->_redis->get($keyName);
        if ($deserialize) {
            $result = json_decode($result, TRUE);
        }
        return $result;
    }

    public function set($key, $value, $ttl = -1)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        if (strlen($key) && ($value != NULL)) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }
            if ($ttl < 0) {
                $this->_redis->set($key, $value);
            } else {
                if ($ttl == self::TODAY_TTL) {
                    $ttl = strtotime(date('Y-m-d 23:59:59')) - time();
                }
                if ($ttl > 1) {
                    $this->_redis->setex($key, $ttl, $value);
                }
            }
        }
    }

    public function incrBy($key, $incr)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->incrBy($key, $incr);
    }

    public function decrBy($key, $incr)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->decrBy($key, $incr);
    }

    public function delete($key)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->delete($key);
    }

    public function hashGet($key, $hashKey, $unserialize = FALSE)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        $val = $this->_redis->hGet($key, $hashKey);
        if ($unserialize) {
            $val = json_decode($val, TRUE);
        }
        return $val;
    }

    public function hashIncrBy($key, $hashKey, $incr)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->hIncrBy($key, $hashKey, $incr);
    }

    public function hashGetAll($key)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        $hash = $this->_redis->hGetAll($key);
        if ($hash) {
            return array_map(function ($value) {
                $decodedValue = json_decode($value, TRUE);
                return $decodedValue === NULL ? $value : $decodedValue;
            }, $hash);
        }
        return $hash;
    }

    public function hashSet($key, $hashKey, $value)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return $this->_redis->hSet($key, $hashKey, $value);
    }

    public function hashMultiSet($key, $map)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        $mapVal = [];
        foreach ($map as $hashKey => $value) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }
            $mapVal[$hashKey] = $value;
        }
        return $this->_redis->hMSet($key, $mapVal);
    }


    public function hashMultiGet($key, $fields)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->hMGet($key, $fields);
    }

    public function hashDestroyField($key, $field)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }

        if (is_array($field)) {
            array_unshift($field, $key);
            return call_user_func_array(array($this->_redis, 'hDel'), $field);
        } else {
            return $this->_redis->hDel($key, $field);
        }
    }

    public function destroy($key)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->del($key);
    }

    public function expire($key, $ttl = MyRedis::TODAY_TTL)
    {
        if ($ttl == self::TODAY_TTL) {
            $ttl = strtotime(date('Y-m-d 23:59:59')) - time();
        }
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->expire($key, $ttl);
    }

    public function zAdd($key, $score, $value)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zAdd($key, $score, $value);
    }

    public function zRevRangeByScore($key, $max, $min, $options)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zRevRangeByScore($key, $max, $min, $options);
    }

    public function zRangeByScore($key, $min, $max, $options)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zRangeByScore($key, $min, $max, $options);
    }

    public function zRemove($key, $member)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zDelete($key, $member);
    }

    public function zIncrBy($key, $member, $score)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zIncrBy($key, $score, $member);
    }

    public function zInter($key, $subKeys)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zInter($key, $subKeys);
    }

    public function zUnion($key, $subKeys)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zUnion($key, $subKeys);
    }

    public function zScore($key, $member)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zScore($key, $member);
    }

    public function zSize($key)
    {
        if (is_null($this->_redis)) {
            $this->_connect();
        }
        return $this->_redis->zSize($key);
    }
}


//  ========================== demo ==================================

$frontCache = new \Phalcon\Cache\Frontend\Data(["lifetime" => 172800]);

$redisClient = new MyRedis($frontCache, [
    'host' => 'localhost',
    'port' => 6379,
    //'auth' => '',
    'persistent' => false
]);

$key = 'key';
$mapKey = 'map';
$map = [
    'key1'=>'value1',
    'key2'=>'value2',
    'key3'=>'value3'
];

$redisClient->set($key,json_encode($map));
var_dump($redisClient->get($key,TRUE));


$redisClient->hashMultiSet($mapKey,$map);
$arrOfMap = $redisClient->hashMultiGet($mapKey,['key1','key2','key3']);
var_dump($arrOfMap);