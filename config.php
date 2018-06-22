<?php

class Config{

    private static $configList=[
      'true'=>true
    ];

    public static function get($configKey){
        return Config::$configList[$configKey];
    }
}