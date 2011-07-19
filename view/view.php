<?php

abstract class view
{
	protected $show_behavior;
	protected $dispatcher;
	protected $protected = false;
	protected $tpl;
	static protected $instance_view;
	
	public function __construct($controller)
	{
		$this->tpl = singletonTemplate::getInstance();
		$this->dispatcher = Event_Dispatcher::getInstance();
	}
	
	public static function _getViewInstance()
	{
		return self::$instance_view;
	}
	
	public function _Show()
	{
		$this->show_behavior->_show();
	}
	
	public function _setShowBehavior(showbehavior $showbehavior)
	{
		$this->show_behavior = $showbehavior;
	}
	
	public function _getShowBehavior()
	{
		return $this->show_behavior;
	}
	
	public function _getProtectionState()
	{
		return $this->protected;
	}
}
?>