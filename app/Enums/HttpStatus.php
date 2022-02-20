<?php
namespace App\Enums;
class HttpStatus
{
	public const OK = 200;
	public const CREATED = 201;
	public const NOCONTENT = 204;
	public const BADREQUEST = 400;
	public const FORBIDDEN = 403;
	public const TEAPOT = 418;
	public const ERROR = 500;
	public static function OK ()
	{
		return  __('http.200');
	}
	public static function CREATED ()
	{
		return  __('http.201');
	}
	public static function NOCONTENT ()
	{
		return  __('http.204');
	}
	public static function BADREQUEST ()
	{
		return  __('http.400');
	}
	public static function FORBIDDEN ()
	{
		return  __('http.403');
	}
	public static function TEAPOT ()
	{
		return  __('http.418');
	}
	public static function ERROR ()
	{
		return  __('http.500');
	}
}
