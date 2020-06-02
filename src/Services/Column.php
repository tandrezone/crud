<?php


namespace xbugs\crud\Services;


class Column
{
    public $name;
    public $type;
    public $values;
    public $label;

    public function __construct($name, $type, $values = null)
    {
        if(is_array($name)){
            $this->name = $name['name'];
            $this->label = $name['label'];
        } else {
            $this->name = $name;
            $this->label = ucfirst($this->name);
        }
        $this->type = $type;
        $this->values = $values;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

}
