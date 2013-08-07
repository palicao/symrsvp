<?php

namespace Palicao\Bundle\KeyValueBundle\Model;

abstract class FieldDefinition {
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $label;
    
    /**
     * @var string
     */
    protected $type;
    
    /**
     * @var array
     */
    protected $choices;
    
    /**
     * @var bool
     */
    protected $is_required;
    
    /**
     * @var bool
     */
    protected $is_email;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getChoices() {
        return $this->choices;
    }

    public function setChoices($choices) {
        $this->choices = $choices;
    }

    public function getIsRequired() {
        return $this->is_required;
    }

    public function setIsRequired($is_required) {
        $this->is_required = $is_required;
    }

    public function getIsEmail() {
        return $this->is_email;
    }

    public function setIsEmail($is_email) {
        $this->is_email = $is_email;
    }
    
}