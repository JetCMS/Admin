<?php namespace JetCMS\Admin\FormItems;

use Input;
use SleepingOwl\Admin\FormItems\BaseFormItem;

class JMigx extends BaseFormItem
{
    protected $issetObject = true;
    protected $labelNonObject = null;
    protected $url;
    protected $label;
    protected $valueUrl = [];

    protected $model;
    protected $options = [];

    function __construct($path, $label = null)
    {
        $this->label = $label;
        $parts = explode(".", $path);
        if (count($parts) > 1) {
            $this->path = $path;
            $this->name = $parts[0] . "[" . implode("][", array_slice($parts, 1)) . "]";
            $this->attribute = implode(".", array_slice(explode(".", $path), -1, 1));
        } else {
            $this->path = $path;
            $this->name = $path;
            $this->attribute = $path;
        }
    }

    public function url($url = null)
    {
        if (is_null($url))
        {
            return $this->url;
        }
        $this->url = $url;
        return $this;
    }

    public function valueUrl($valueUrl = null)
    {
        if (is_null($valueUrl))
        {
            return $this->valueUrl;
        }
        $this->valueUrl = $valueUrl;
        return $this;
    }

    public function label($label = null)
    {
        if (is_null($label))
        {
            return $this->label;
        }
        $this->label = $label;
        return $this;
    }

    public function labelNonObject($labelNonObject = null)
    {
        if (is_null($labelNonObject))
        {
            return $this->labelNonObject;
        }
        $this->labelNonObject = $labelNonObject;
        return $this;
    }

    public function issetObject($issetObject)
    {
        if (is_null($issetObject))
        {
            return $this->issetObject;
        }
        $this->issetObject = $issetObject;
        return $this;
    }

    public function render($view = null)
    {

        if ($this->issetObject)
        {
            if (!$this->instance->id)
            {
                return view('jetcms::admin.formitem.jmigx',[
                    'lable'=>$this->label,
                    'url'=>false,
                    'labelNonObject'=>$this->labelNonObject,
                    'field'=>$this->instance->field_array,
                    'options'=>$this->options
                ]);
            }
        }

        if (sizeof($this->valueUrl) == 0)
        {
            $this->valueUrl = ['id' => $this->instance->id];
        }

        $url = $this->url;
        foreach ($this->valueUrl as $key => $value)
        {
            $url = str_replace(':'.$key, $value, $url);
        }
        return view('jetcms::admin.formitem.jmigx',[
            'lable'=>$this->label,
            'url'=>$url,
            'field'=>$this->instance->field_array,
            'options'=>$this->options
        ]);
    }

    public function options($options = null)
    {
        if (is_null($options))
        {
            if ( ! is_null($this->model()) && ! is_null($this->display()))
            {
                $this->loadOptions();
            }
            $options = $this->options;
            asort($options);
            return $options;
        }
        $this->options = $options;
        return $this;
    }

    public function value()
    {
        $instance = $this->instance();
        if ( ! is_null($value = old($this->path())))
        {
            return $value;
        }
        $input = Input::all();
        if (($value = array_get($input, $this->path())) !== null)
        {
            return $value;
        }
        if ( ! is_null($instance) && ! is_null($value = $instance->getAttribute($this->attribute())))
        {
            return $value;
        }
        return $this->defaultValue();
    }

    public function path($path = null)
    {
        if (is_null($path))
        {
            return $this->path;
        }
        $this->path = $path;
        return $path;
    }

    public function attribute($attribute = null)
    {
        if (is_null($attribute))
        {
            return $this->attribute;
        }
        $this->attribute = $attribute;
        return $attribute;
    }

    public function save()
    {

        $attribute = $this->attribute();
        if (Input::get($this->path()) === null) {
            $value = null;
        } else {
            $value = $this->value();
        }
        $this->instance()->$attribute = $value;
    }
}