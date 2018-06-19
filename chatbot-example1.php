<?php

include ('line-bot.php');

$channelSecret = '4d2466fe67c5096d309d0ac512c245e7';
$access_token  = 'w+lIPN3ILj/c/+qkzROqMAHg53BSJJTTz2tLw2m0IkIz4Qfi+sdFp3TDb0XlRdV/KivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3YfIBX8PyNXKZ9z0571uVuapokc/bLdx4XtcbmP8fcSnrwdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) {
		
    $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));

    if ($bot->isSuccess()) {
        echo 'Succeeded!';
        exit();
    }

    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
    exit();

}
