<?php
class FrontController {
	protected $_controller, $_action, $_params, $_body;
	static $_instance;

	public static function getInstance() {
		if(!(self::$_instance instanceof self))
			self::$_instance = new self();
		return self::$_instance;
	}

	private function __construct(){
		$request = $_SERVER['REQUEST_URI'];

		$splits = explode('/', trim($request,'/'));

		$this->_controller = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : 'BlockController';
		$this->_action = !empty($splits[1]) ? explode('?', $splits[1])[0].'Action' : 'getAction';
		if(!empty($_SERVER['QUERY_STRING'])){
			parse_str($_SERVER['QUERY_STRING'], $urlparams);
			$this->_params = $urlparams;
		}

	}

	public function route() {
		if(class_exists($this->getController(), $autoload = true)) {
			$rc = new ReflectionClass($this->getController());
			if($rc->isSubclassOf('IController')) {
				if($rc->hasMethod($this->getAction())) {
					$controller = $rc->newInstance();
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
				} else {
					throw new Exception("Action");
				}
			} else {
				throw new Exception("500");
			}
		} else {
			throw new Exception("Controller");
		}
	}

	public function getParams() {
		return $this->_params;
	}

	public function getController() {
		return $this->_controller;
	}

	public function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

	public function getAction() {
		return $this->_action;
	}

	public function getBody() {
		return $this->_body;
	}

	public function setBody($body) {
		$this->_body = $body;
	}
}