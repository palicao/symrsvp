<?php

namespace Palicao\Bundle\KeyValueBundle\Tests\KeyValue;

use Palicao\Bundle\KeyValueBundle\KeyValue\DataSet;

class DataSetTest extends \PHPUnit_Framework_TestCase {
    
    public function testArrayAndObjectAccess() {
        $data = new DataSet;
        $data['key1'] = 'value1';
        $data['key2'] = 'value2';
        
        $this->assertEquals($data['key1'], 'value1');
        $this->assertEquals($data['key2'], 'value2');
        $this->assertEquals($data->key1, 'value1');
        $this->assertEquals($data->key2, 'value2');
        
        $data->key3 = 'value3';
        $data->key4 = 'value4';
        
        $this->assertEquals($data['key3'], 'value3');
        $this->assertEquals($data['key4'], 'value4');
        $this->assertEquals($data->key3, 'value3');
        $this->assertEquals($data->key4, 'value4');
        
        $data->key1 = 'new_value1';
        $this->assertEquals($data['key1'], 'new_value1');
    }
    
}