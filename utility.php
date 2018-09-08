public function push_notify($notification_message = ['test' => 'test'], $notification_data = ['the' => 'data'])
{
  $notification_id = $this->$notify_id;
  $message = $notification_message;
  $playerId = $notification_id;
  $content = array($message);
  $fields = array(
      'app_id' => env('ONE_SIGNAL_APP_ID'),
      //'included_segments' => array('All'),
      //'include_player_ids' => array("6908506e-cf1e-4fbf-b70c-d950a342d701"),
      'include_player_ids' => array($playerId),
      'data' => array("the" => "data"),
      'contents' => $content,
  );
  $fields = json_encode($fields);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;
      charset=utf-8', 'Authorization: Basic ' . env('ONE_SIGNAL_AUTHORIZATION_CODE')));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}
