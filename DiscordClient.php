<?php
	include_once __DIR__ . '/api/Rest.php';

	class DiscordClient {
		public static $token;
		
		public function __construct($token) {
			self::$token = $token;
		}
		
		public function getChannel($id) {
			return Rest::fetchChannel($id);
		}
		
		public function getOrCreateDMChannel($id) {
			return Rest::fetchDMChannel($id);
		}
	}
?>