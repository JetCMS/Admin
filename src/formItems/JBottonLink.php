<?php namespace JetCMS\Admin\FormItems;

use SleepingOwl\Admin\FormItems\BaseFormItem;

class JBottonLink extends BaseFormItem
{
	protected $issetObject = true;
	protected $labelNonObject = null;
	protected $url;
	protected $label;
	protected $valueUrl = [];

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
				return view('jetcms::admin.formitem.botton_link',['lable'=>$this->label,'url'=>false,'labelNonObject'=>$this->labelNonObject]);;
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
		return view('jetcms::admin.formitem.botton_link',['lable'=>$this->label,'url'=>$url]);
	}
}