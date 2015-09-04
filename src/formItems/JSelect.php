<?php namespace JetCMS\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;
use SleepingOwl\Admin\FormItems\select;

class JSelect extends select
{
	public function options($options = null)
	{
		if (is_null($options))
		{
			if ( ! is_null($this->model()) && ! is_null($this->display()))
			{
				$this->loadOptions();
			}
			$options = $this->options;
			/*asort($options);*/
			return $options;
		}
		$this->options = $options;
		return $this;
	}
}