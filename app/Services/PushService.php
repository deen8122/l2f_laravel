<?php

namespace App\Services;

use App\Models\Letter;
use App\Models\User;

class PushService {

	public static function checkLetters() {
		l('checkLetters');
		$currentTime = time();//1639750115

		$letters = Letter::orderBy('id', 'desc')->with('user')->where('future_time', '<', $currentTime)->paginate(10);
		l(count($letters));
		foreach ($letters as $letter) {
			l($letter->user_id);
			l($letter->user);
			//Email уведомление + emails_to
			$sendResult = self::sendEmail($letter->user, $letter);
			//Push увеодмление
			//self::sendPushNotification($letter);
		}
	}

	/*
	 * 
	 */

	public static function sendEmail(User $user, Letter $letter) {
		log2file('sendPushNotification', [env('FIREBASE_API_KEY'),$user,$letter]);
	}

	public static function sendPushNotification(User $user, Letter $letter): bool {

		if (env('APP_ENV') == 'local') {
			log2file('sendPushNotification', [env('FIREBASE_API_KEY'),]);
			return true;
		}
		$client = new Client();
		$client->setApiKey(env('FIREBASE_API_KEY'));
		$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

		$message = new Message();
		$message->setPriority('high');
		$message->addRecipient(new Device('_YOUR_DEVICE_TOKEN_'));
		$message
			->setNotification(new Notification('some title', 'some body'))
			->setData(['key' => 'value'])
		;

		$response = $client->send($message);
		var_dump($response->getStatusCode());
		var_dump($response->getBody()->getContents());
	}

}
