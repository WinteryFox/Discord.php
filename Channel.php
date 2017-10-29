<?php
	abstract class Channel {
		public $id;
		public $type;
		
		public function sendMessage($content, $embed) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/$this->id/messages");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"content":"' . $content . '", "embed": {' . $embed . '}}');
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
		}
		
		public function getMessage($messageId) {
			$ch = curl_init();
			
			echo "https://discordapp.com/api/v6/channels/{$this->id}/messages/{$messageId}";
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/$this->id/messages/$messageId");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot $discordToken";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			return $result;
		}
		
		public function getMessages($amount) {
			if ($amount > 100)
				$amount = 100;
			else if ($amount < 0)
				$amount = 0;
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/$this->id/messages?json=" . urlencode(json_encode('{"limit":' . $amount . '}')));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot $discordToken";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			return $result;
		}
	}
?>