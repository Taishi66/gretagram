<?php

class SessionFacade {

	static private $user;

	static function setUserSession($user){
		static::$user = $user;
		$_SESSION['user'] = $user;
	}

	static function getUserSession(){
		if(empty(static::$user)){
			static::$user = $_SESSION['user'];
		}
		return static::$user;
	}

	static function getUserName(){
		return self::getUserSession()['name'];
	}
	static function getUserId(){
		return self::getUserSession()['id'];
	}

	static function clearSession(){
		unset($_SESSION['user']);
		unset(static::$user['user']);

	}
}