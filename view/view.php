<?php

/**
* 
* It's the abstract view class.
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

abstract class view
{
	/**
	 * 
	 * Holds the show_behavior
	 * @var showbehavior
	 */
	protected $show_behavior;
	
	/**
	 * 
	 * Holds the dispatcher object af the app
	 * @var dispatcher
	 */
	protected $dispatcher;
	
	/**
	 * 
	 * is the view protected
	 * @var boolean
	 */
	protected $protected = false;
	
	/**
	 * 
	 * Holds the template object
	 * @var singletonTemplate
	 */
	protected $tpl;
	
	/**
	 * 
	 * Holds an array wich roles can view the view
	 * @var Array
	 */
	protected $allowed_roles;
	
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