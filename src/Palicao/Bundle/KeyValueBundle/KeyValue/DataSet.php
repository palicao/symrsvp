<?php

namespace Palicao\Bundle\KeyValueBundle\KeyValue;

class DataSet implements \ArrayAccess {
    
    private $data;
    
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }
    
    public function offsetGet ($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
    
    public function offsetSet ($offset, $value)
    {
        $this->data[$offset] = $value;
    }
    
    public function offsetUnset ($offset)
    {
        unset($this->data[$offset]);
    }
    
    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }
    
    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }
    
}

?>
