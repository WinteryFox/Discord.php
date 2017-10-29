<?php
	include_once __DIR__ . '/Channel.php';

	class DMChannel extends Channel {
		public function __construct($recipientId) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/users/@me/channels");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"recipient_id":"' . $recipientId . '"}');
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Authorization: Bot $discordToken";
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$result = json_decode($result);
			$this->id = $result->id;
			$this->type = $result->type;
			if ($this->type != 1) {
				throw new Exception("The requested channel doesn't appear to be a DM channel.");
			}
		}
	}
?>