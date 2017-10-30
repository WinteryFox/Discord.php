<?php
	include_once __DIR__ . '/Message.php';

	abstract class Channel {
		public $discordToken;
		public $id;
		public $type;
		
		public function sendMessage($content, $embed) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$this->id}/messages");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"content":"' . $content . '", "embed": {' . $embed . '}}');
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Authorization: Bot {$this->discordToken}";
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
		}
		
		public function getMessage($messageId) {
			return new Message($this->discordToken, $this->id, $messageId);
		}
		
		public function getMessages($amount) {
			if ($amount > 100)
				$amount = 100;
			else if ($amount < 0)
				$amount = 0;
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$this->id}/messages?json=" . urlencode(json_encode('{"limit":' . $amount . '}')));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot {$this->discordToken}";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$result = json_decode($result);
			var_dump($result);
			
			$messages = array();
			foreach ($result as $message) {
				$messages[] = new Message($message->id);
			}
			return $messages;
		}
	}
?>