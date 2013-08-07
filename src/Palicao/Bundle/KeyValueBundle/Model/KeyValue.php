<?php

namespace Palicao\Bundle\KeyValueBundle\Model;

abstract class KeyValue {
    
    /**
     * @var string
     */
    protected $key;
    
    /**
     * @var string
     */
    protected $value;
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
        
        return $this;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }
    
}