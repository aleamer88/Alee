<?php
$API_KEY = 'f9LHodD0cOJjsGw8YouaFaz86G28N75BP8gwb0QXATwhBrO34W97VqTaKQckNogB0aYmyT72iKN_h7TqD2cg9Q';
$Dev_id = "600132988929,582808527990";
$urlimg = "https://dev-bdel.pantheonsite.io/wp-admin/Bemo/Picsart_23-07-29_11-35-01-317.jpg";
$as = [600132988929,595759354893];
$update_info = "55330098";
mkdir("information_");
define('API_KEY',$API_KEY);
function setWebhook($Link){
$url = "https://botapi.tamtam.chat/subscriptions?access_token=".API_KEY;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array("Content-Type: application/json");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(["url"=>$Link]));
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
return $resp;
}
echo setWebhook("https://".$_SERVER['SERVER_NAME']. "" . $_SERVER['SCRIPT_NAME']);
$Adminset = json_decode(file_get_contents("information_/Ad".$update_info.".json"),true);
$settings = json_decode(file_get_contents("information_/st".$update_info.".json"),true);
$mute = json_decode(file_get_contents("information_/mute".$update_info.".json"),true);
$lock = json_decode(file_get_contents("information_/lock".$update_info.".json"),true);
$second = json_decode(file_get_contents("information_/second".$update_info.".json"),true);
$groups = json_decode(file_get_contents("information_/groups".$update_info.".json"),true);
$Special  = json_decode(file_get_contents("information_/Special".$update_info.".json"),true);
$Admin  = json_decode(file_get_contents("information_/Admin".$update_info.".json"),true);
$owner = json_decode(file_get_contents("information_/owner".$update_info.".json"),true);
$replies = json_decode(file_get_contents("information_/replies".$update_info.".json"),true);
$public = json_decode(file_get_contents("information_/public".$update_info.".json"),true);
$true = json_decode(file_get_contents("information_/true".$update_info.".json"),true);
$dev = json_decode(file_get_contents("information_/dev".$update_info.".json"),true);
// start rank //
function is_bot($user){
global $update_info;
if($user == $update_info){
$is_bot = true;
}else{
$is_bot = false;
}
return $is_bot;
}
function is_dev($user){
global $as;
if(in_array($user,$as)){
$is_de = true;
}else{
$is_de = false;
}
return $is_de;
}
function is_deved($user){
global $dev;
if(is_bot($user)){
$is_dfe = true;
}elseif(is_dev($user)){
$is_dfe = true;
}elseif(in_array($user,$dev["dev"])){
$is_dfe = true;
}else{
$is_dfe = false;
}
return $is_dfe;
}
function is_creator($user, $chat){
global $API_KEY;
$infoad = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chat.'/members?access_token='.$API_KEY.'&user_ids='.$user));
$is_owner = $infoad->members[0]->is_owner; 
$is_admin = $infoad->members[0]->is_admin; 
$is_user_id = $infoad->members[0]->user_id;
if(is_bot($user)){
$is_cr = true;
}elseif(is_deved($user)){
$is_cr = true;
}elseif($is_owner == "true" && $is_admin =="true"){
$is_cr = true;
}else{
$is_cr = false;
}
return $is_cr;
}
function is_owner($user, $chat){
global $API_KEY;
global $owner;
$infoad = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chat.'/members?access_token='.$API_KEY.'&user_ids='.$user));
$is_owner = $infoad->members[0]->is_owner; 
$is_admin = $infoad->members[0]->is_admin; 
$is_user_id = $infoad->members[0]->user_id;
if(is_bot($user)){
$is_ow = true;
}elseif(is_creator($user, $chat)){
$is_ow = true;
}elseif(!$is_owner == "true" && $is_admin =="true"){
$is_ow = true;
}elseif(in_array($user,$owner[$chat])){
$is_ow = true;
}else{
$is_ow = false;
}
return $is_ow;
}
function is_admin($user, $chat){
global $Admin;
if(is_bot($user)){
$is_ad = true;
}elseif(is_creator($user, $chat)){
$is_ad = true;
}elseif(is_owner($user, $chat)){
$is_ad = true;
}elseif(in_array($user,$Admin[$chat])){
$is_ad = true;
}else{
$is_ad = false;
}
return $is_ad;
}
function is_Special($user, $chat){
global $Special;
if(is_dev($user)){
$is_sp = true;
}elseif(is_bot($user)){
$is_sp = true;
}elseif(is_deved($user)){
$is_sp = true;
}elseif(is_creator($user, $chat)){
$is_sp = true;
}elseif(is_owner($user, $chat)){
$is_sp = true;
}elseif(is_admin($user, $chat)){
$is_sp = true;
}elseif(in_array($user,$Special[$chat])){
$is_sp = true;
}else{
$is_sp = false;
}
return $is_sp;
}
function rank($user, $chat){
if(is_dev($user)){
$is_rank = "المطور الاساسي";
}elseif(is_bot($user)){
$is_rank = "البوت";
}elseif(is_deved($user)){
$is_rank = "المطور";
}elseif(is_creator($user,$chat)){
$is_rank = "منشئ اساسي";
}elseif(is_owner($user,$chat)){
$is_rank = "منشئ";
}elseif(is_admin($user,$chat)){
$is_rank = "ادمن";
}elseif(is_Special($user,$chat)){
$is_rank = "مميز";
}else{
$is_rank = "عضو";
}
return $is_rank;
}



// end rank //
function edit_value($msg_id, $Tab, $text = null){
if ($text != null) {
$content = [
'message_id' => "$msg_id",'text' => "$text", 'attachments' => [
[
'type' => 'inline_keyboard', 'payload' => [
'buttons' => $Tab,
],
],
],
];
} else {
$content = [
'message_id'  => $msg_id,
'attachments' => [[
'type' => 'inline_keyboard', 'payload' => [
'buttons' => $Tab,
],
],
],
];
}
$url = "https://botapi.tamtam.chat/messages?access_token=".API_KEY."&message_id=".$msg_id;
$curl = curl_init();
$content = json_encode($content);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
if ($content) {
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
}
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($content))
);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
if ($result === false) {
$result = json_encode(['ok' => false, 'curl_error_code' => curl_errno($curl), 'curl_error' => curl_error($curl)]);
}
curl_close($curl);
return json_decode($result, true);
}
function bobt($method,$data){
if($method){
$url = "https://botapi.tamtam.chat/messages?access_token=".API_KEY."&user_id=".$method."&disable_link_preview=true";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
 echo $res;
}
}
function bot($method,$data){
if($method){
$url = "https://botapi.tamtam.chat/messages?access_token=".API_KEY."&chat_id=".$method."&disable_link_preview=true";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
 echo $res;
}
}
function bot1($method,$data){
if($method){
$url = "https://botapi.tamtam.chat/answers/constructor?access_token=".API_KEY."&session_id=".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
 echo $res;
}}
function answers($callback,$data){
if($callback){
$url = "https://botapi.tamtam.chat/answers?access_token=".API_KEY."&callback_id=".$callback;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
 return json_decode($res);
}
}
function unpin($chat){
$url = "https://botapi.tamtam.chat/chats/".$chat."/pin?access_token=".API_KEY;
$content = ['chat_id'=>$chat];
$curl = curl_init();
$content = json_encode($content);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($content))
);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);
return json_decode($result, true);
}
function pin($chat, $msgid){
$url = "https://botapi.tamtam.chat/chats/".$chat."/pin?access_token=".API_KEY;
$data = ["message_id"=>$msgid,"notify"=>"true"];
$curl = curl_init();
$data = json_encode($data);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($data))
);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);
return json_decode($result, true);
}


function kickChatMember($user_id, $chat){
$url = "https://botapi.tamtam.chat/chats/".$chat."/members?access_token=".API_KEY."&user_id=".$user_id."&block=true";
$content = ['chat_id'=>$chat];
$curl = curl_init();
$content = json_encode($content);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($content))
);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);
return json_decode($result, true);
}

function deleteMessage($method){
    $url = "https://botapi.tamtam.chat/messages?access_token=".API_KEY."&message_id=".$method;
          $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        //curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $res = curl_exec($ch);
            echo $res;
}
function edit_bot_info($content){
$url = "https://botapi.tamtam.chat/me?access_token=".API_KEY;
$curl = curl_init();
$content = json_encode($content);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
if ($content) {
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
}
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($content))
);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
if ($result === false) {
$result = json_encode(['ok' => false, 'curl_error_code' => curl_errno($curl), 'curl_error' => curl_error($curl)]);
}
curl_close($curl);
return json_decode($result, true);
}

function CheckMk($vc,$from_id,$text=null,$message_id=null){
$stas = json_decode(file_get_contents("Adminset.json"),true);
if (count($stas["Channels"]) != 0){
foreach ($stas["Channels"] as $channel){
$Request = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$channel['id']."/members?access_token=#&user_ids=".$from_id));
if(!$Request->members[0]->user_id){
if($text){
$text = $text;
}else{
$text = "/start";
}
$ff = [[['type' => 'link', 'text' =>"قناة البوت", 'url' =>$channel['url']]],];
bot($vc,['text' =>"عذرا علـيك الاشترِاك بـ قنـٱة اݪبـوت 
━───━ ✵ ━───━
[‹ ꪎ¹˓ TEMM SWAT . ›](".$channel['url'].")",
"link"=>["type"=>"reply",
"mid"=>$message_id,],
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],"format"=>"markdown"]);
return true;
}
return false;
break;
}
}
}
function CheckChannels($vc,$from_id,$text=null,$message_id=null){
global $update_info;
$stas = json_decode(file_get_contents("information_/Ad".$update_info.".json"),true);
if (count($stas["Channels"]) != 0){
foreach ($stas["Channels"] as $channel){
$Request = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$channel['id']."/members?access_token=".API_KEY."&user_ids=".$from_id));
if(!$Request->members[0]->user_id){
if($text){
$text = $text;
}else{
$text = "/start";
}
$ff = [[['type' => 'link', 'text' =>"قناة البوت", 'url' =>$channel['url']]],];
bot($vc,['text' =>"عٰذِࢪاެ عٰݪيُكَ اެݪاެشِتِࢪاެكَ فِيُ قِتِاެهَ اެݪبُۅتِ
━───━ ✵ ━───━
[‹ ꪎ¹˓ SS2i . ›](".$channel['url'].")",
"link"=>["type"=>"reply",
"mid"=>$message_id,],
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],"format"=>"markdown"]);
return true;
}
return false;
break;
}
}
}
function ViewChannels($ch,$message_id){
global $update_info;
$sAAS = json_decode(file_get_contents("information_/Ad".$update_info.".json"),true);
if (count($sAAS["Channels"]) != 0){
$rf = "قنوات الاشتراك الإجبارية\nانقر فوق اسم القناة لحذفه 🗑";
for ($i=0; $i < count($sAAS["Channels"]); $i++) {
$Botsid = $sAAS["Channels"][$i]["id"];
$Botsurl = $sAAS["Channels"][$i]["url"];
$Botstitle = $sAAS["Channels"][$i]["title"];
$ff[$i]= [['type' => 'callback', 'text' =>$Botstitle, 'payload' =>'delch#'.$i],['type' => 'link', 'text' =>'الرابط', 'url' =>$Botsurl]];
}
$ff[]= [['type' => 'callback', 'text' => '➕', 'payload' => 'csaddChannel']];
$ff[]= [['type' => 'callback', 'text' => '➠رجوع', 'payload' => 'cle']];
}else{
$rf = "لا توجد قنوات للاشتراك الإجباري\nلإضافة قناة ، اضغط على (➕)";
$ff = [
[['type' => 'callback', 'text' => '➕', 'payload' => 'csaddChannel'],],
[['type' => 'callback', 'text' => '➠رجوع', 'payload' => 'cle'],],
];
}
edit_value($message_id, $ff,$rf);
}
$update = json_decode(file_get_contents('php://input'));
$update_type = $update ->update_type;
$message = $update->message;
$video= $message->body->attachments[0]->type['video'];
$photo= $message->body->attachments[0]->type['image'];
$sticker= $message->body->attachments[0]->type['sticker'];
$audio= $message->body->attachments[0]->type['audio'];
$contact= $message->body->attachments[0]->type['contact'];
$inline= $message->body->attachments[0]->type['inline_keyboard'];
$location= $message->body->attachments[0]->type['location'];
$document = $message->body->attachments[0]->type['file'];
$typddse =$message->body->attachments[0]->type;
$text = $message->body->text;
$data = $update->callback->payload;
$message_id = $update->message->body->mid;
$chat_type = $message->recipient->chat_type;
$payload = $update->payload;
$reply = $message->link->type['reply'];
$is_bot = $message->sender->is_bot;
$re_name = $message->link->sender->name;
$re_user_id = $message->link->sender->user_id;
$re_username = $message->link->sender->username;
if(!$re_username){
	$re_username = "لا يوجد";
}else{
    $re_username = "@".$re_username;
}
$re_message_id = $update->message->link->message->mid;
$attachments = $update->messagemessage->body->attachments[0]->type;
$link_type = $message->link->type;
if($update_type ==  'bot_started'){
$user_id = $update->user_id;
$chatId = $update->chat_id;
$name = $update->user->name;
$username = $update->user->username;
}elseif($update_type ==  'message_callback'){
$user_id = $update->callback->user->user_id;
$chatId = $update->message->recipient->chat_id;
$name = $update->callback->user->name;
$username = $update->callback->user->username;
}elseif($update_type ==  'message_created'){
$user_id = $update->message->sender->user_id;
$chatId = $update->message->recipient->chat_id;
$name = $update->message->sender->name;
$username = $update->message->sender->username;
}elseif($update_type ==  'message_edited'){
$user_id = $update->message->sender->user_id;
$chatId = $update->message->recipient->chat_id;
$name = $update->message->sender->name;
$username = $update->message->sender->username;
}elseif($update_type ==  'bot_added'){
$user_id = $update->user->user_id;
$chatId = $update->chat_id;
$name = $update->user->name;
$username = $update->user->username;
}elseif($update_type ==  'user_added'){
$user_id = $update->user->user_id;
$chatId = $update->chat_id;
$name = $update->user->name;
$username = $update->user->username;
}elseif($update_type ==  'user_removed'){
$user_id = $update->user->user_id;
$chatId = $update->chat_id;
$name = $update->user->name;
$username = $update->user->username;
}
if(!$username){
	$username = "لا يوجد";
}else{
    $username = "@".$username;
}
$isb_info = json_decode(file_get_contents('https://botapi.tamtam.chat/me?access_token='.API_KEY));
$idBot = $isb_info->user_id; 
$nameBot = $isb_info->name; 
$userBot = $isb_info->username;
if($update_type == "bot_started"){
if(isset($user_id)){
$mem = file_get_contents("information_/id".$update_info.".txt");
$memp = explode("\n",$mem);
if(!in_array($user_id,$memp)){
$endmem = fopen("information_/id".$update_info.".txt", "a") or die("Unable to open file!");
fwrite($endmem, "$user_id\n");
fclose($endmem);
}
}
if(in_array($user_id,$as)){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' =>'تعيين اسم البوت بالمجموعات', 'payload' =>"Edgbot"]],
[['type' => 'callback', 'text' =>'اذاعه بالخاص', 'payload' =>"cse"],['type' => 'callback', 'text' =>"اذاعه بالمجموعات", 'payload' =>"cse2"]],
[['type' => 'callback', 'text' =>"الاشتراك الاجباري", 'payload' =>"cs"],['type' => 'callback', 'text' =>'الاحصائيات', 'payload' =>"infoM"]],
[['type' => 'callback', 'text' =>'— — — — — — — — —', 'payload' =>"— — — — — — — — —"]],
[['type' => 'callback', 'text' =>'تغير صوره البوت', 'payload' =>"Ediphbot"],['type' => 'callback', 'text' =>"تغير اسم البوت", 'payload' =>"Edinambot"]],
[['type' => 'callback', 'text' =>"تغير يوزر البوت", 'payload' =>"Ediuserbot"],['type' => 'callback', 'text' =>'تغير وصف البوت', 'payload' =>"Edibiobot"]],
];
bobt($user_id,['text' =>"• اهلا بك عزيزي المطور في بوتك الخاص",
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],
]);
}
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
if(CheckMk($chatId,$user_id,null,null)){
return false;
}
if(CheckChannels($chatId,$user_id,null,null)){
return false;
}
bobt($user_id,['text'=>"اެضِغِطَ هَنِاެ ݪبُډء اެݪتِشِغِيُݪ 🇮🇶:- /start",
]);
}
if($chat_type == "dialog"){
if(CheckMk($chatId,$user_id,"/start",$message_id)){
return false;
}
if(CheckChannels($chatId,$user_id,"/start",$message_id)){
return false;
}
if($text == "/start"){
bobt($user_id,['text'=>"- اެهَݪاެ بُكَ فِيُ بوت حِمِاެيُهَ𝐓𝐀𝐌𝐓𝐀𝐌.
- ݪتِشِغِيُݪ اެݪبُۅتِ فِيُ مِجَمِۅعٰتِكَ اެݪطَيُفِهَ .
-  اެࢪسُݪ { تفعيل } ۅݪاެحِضِ اެݪسُࢪعٰهَ .
- لمعرفة لمزيد اضغط:- @SOOT-",
]);
}
}
if($update_type == "bot_added"){
bot($chatId,['text'=>"هلاولله 🖤اني بوت اوسكار 🖤للمطور علش الهكر🖤
↞للتفعيل  ↞ضيفني↞لمجموعتك ↞ارفع مسول ↞وارسل تفعيل🖤
⚚--------------------------⚚
قناه البوت @SOOT-
",
'attachments'=>[
                [
                    'type'=>'image',
                    'payload'=>[
                        'url'=>$urlimg
                        ]]],
]);
}
if($update_type ==  'user_added' && !$lock[$chatId]["user_added"]){
$we = isset($second[$chatId]["user_added"]) ? $second[$chatId]["user_added"] : "آِإَطلقٰٖ آِإَفَِڂِٰمَِٰ دڂِٰوَٖل ⚚ جُٖمَِٰآِإَل حٰٖسُآِإَبٰٖڪِٰ ↡

$username 
$name";
$we = str_replace(["#username","#name"],[$username,$name],$we);
bot($chatId,['text'=>$we,
]);
}
//chat
$info = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$Dev_id));
$dev_name = $info->members[0]->name;
$dev_username = $info->members[0]->username;
$chats_info = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'?access_token='.$API_KEY));
$link = isset($chats_info->link) ? $chats_info->link : "لا يوجد";
$owner_id = $chats_info->owner_id;
$info = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$owner_id));
$owner_name = $info->members[0]->name;
$owner_username = $info->members[0]->username;
if(!$owner_username){
	$owner_username = "لا يوجد";
}else{
    $owner_username = "@".$owner_username;
}
if($text){
if($true[$chatId][$text]){
$text = $true[$chatId][$text] or $text;
}
}
if($chat_type == "chat"){
    
switch ($text) {
    case 'تفعيل':
    case 'رتبتي':
    case 'كت':
    case 'ايدي':
    case 'معلوماتي':
    case 'قفل الصور':
    case 'قفل الصوت':
    case 'قفل الفيديو':
    case 'قفل الفايروس':
    case 'قفل الملصقات':
    case 'قفل الموقع':
    case 'قفل الفشار':
    case 'قفل الجهات':
    case 'قفل الملفات':
    case 'قفل الهمسه':
    case 'قفل البوتات':
    case 'قفل الترحيب':
    case 'قفل الهشتاك':
    case 'قفل المعرفات':
    case 'قفل الروابط':
    case 'قفل التوجيه':
    case 'فتح الصور':
    case 'فتح الصوت':
    case 'فتح الفيديو':
    case 'فتح الفايروس':
    case 'فتح الملصقات':
    case 'فتح الموقع':
    case 'فتح الفشار':
    case 'فتح الجهات':
    case 'فتح الملفات':
    case 'فتح الهمسه':
    case 'فتح البوتات':
    case 'فتح الترحيب':
    case 'فتح الهشتاك':
    case 'فتح المعرفات':
    case 'فتح الروابط':
    case 'فتح التوجيه':
if(CheckChannels($chatId,$user_id,$text,$message_id)){
return false;

}
        break;
}






switch ($text) {
    case 'تفعيل':
    case 'رتبتي':
    case 'كت':
    case 'ايدي':
    case 'معلوماتي':
    case 'قفل الصور':
    case 'قفل الصوت':
    case 'قفل الفيديو':
    case 'قفل الفايروس':
    case 'قفل الملصقات':
    case 'قفل الموقع':
    case 'قفل الفشار':
    case 'قفل الجهات':
    case 'قفل الملفات':
    case 'قفل الهمسه':
    case 'قفل البوتات':
    case 'قفل الترحيب':
    case 'قفل الهشتاك':
    case 'قفل المعرفات':
    case 'قفل الروابط':
    case 'قفل التوجيه':
    case 'فتح الصور':
    case 'فتح الصوت':
    case 'فتح الفيديو':
    case 'فتح الفايروس':
    case 'فتح الملصقات':
    case 'فتح الموقع':
    case 'فتح الفشار':
    case 'فتح الجهات':
    case 'فتح الملفات':
    case 'فتح الهمسه':
    case 'فتح البوتات':
    case 'فتح الترحيب':
    case 'فتح الهشتاك':
    case 'فتح المعرفات':
    case 'فتح الروابط':
    case 'فتح التوجيه':
if(CheckMk($chatId,$user_id,$text,$message_id)){
return false;

}
        break;
}
if($text == "تفعيل" && is_owner($user_id, $chatId)){
if(!in_array($chatId, $groups["groups"])){
bot($chatId,['text'=>"‹ :الاسم ( $name ) \n‹ : المعرف ( $username ) \n‹ : تم  تفعـيل المجمـوعهہ بنـجاح 📍.","link"=>["type"=>"reply","mid"=>$message_id]]);
$groups["groups"][] = $chatId;
file_put_contents("information_/groups".$update_info.".json",json_encode($groups,128|32|256));
bobt($Dev_id,['text'=>"› تم تفعيل البوت بمجموعه جديده \n\n› معلومات المنشئ :- \n› الاسم : ( $owner_name) \n› المعرف : ( $owner_username )\n› الرابط : $link"
]);
}else{
bot($chatId,['text'=>"‹ : تم تفعيل المجموعهہَ ساًبقا .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
$nbot = isset($settings["nbot"]) ? $settings["nbot"] : "بُيُمِۅ";
if ($text == $nbot || $text == "بوت"){
$aa = array("يُكَݪبُيُ كَۅݪ.","عٰٖيوَٖنَٖ ؟ $nbot","نِعٰسُاެنِ عٰاެډيُ شِۅيُ اެنِاެمِ؟.","يُمِكَ آِإَوَٖسُڪِٰآِإَࢪٖ اެݪطَيُفِ 🖤؟..");
$mesho = array_rand($aa,1);
bot($chatId,['text'=>$aa[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if(is_dev($user_id)){
if($text == "مسح المطورين" || $text == "مسح مطورين"){
bot($chatId,['text'=>"^^‹ : تم مسح المطورين بنجاح 📌^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
unset($dev["dev"]);
file_put_contents("information_/dev".$update_info.".json",json_encode($owner,128|32|256));
}
if($text == "المطورين" || $text == "مطورين"){
if(count($dev["dev"]) != 0){
for ($i=0; $i < count($dev["dev"]); $i++) {
$Eq = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$dev["dev"][$i]));
if(!$Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- ".$Eq->members[0]->name;
}elseif($Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- @".$Eq->members[0]->username;
}
}
bot($chatId,['text'=>"‹ : قائمة المطورين  ♡\n~ ~ ~ ~ ~ ~ ~ ~ ~\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"^^‹ : لا يوجد مطورين ♡^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
}
}
if($reply && $text == "رفع مطور"){
if(!in_array($re_user_id,$dev["dev"])){
$dev["dev"][] = $re_user_id;
file_put_contents("information_/dev".$update_info.".json",json_encode($dev,128|32|256));
bot($chatId,['text'=>"**‹ : تم رفعـهہ مطـور بالـبوتَ .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"^^‹ : تم رفعهُ مطور سابقا √^^",
"link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"
]);
}
}
if($reply && $text == "تنزيل مطور"){
if(in_array($re_user_id,$dev["dev"])){
$key = array_search($re_user_id,$dev["dev"]);
unset($dev["dev"][$key]);
$dev["dev"] = array_values($dev["dev"]);
file_put_contents("information_/dev".$update_info.".json",json_encode($dev,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِنِ ࢪتِبـة اެݪمِطَۅࢪ√ .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"**› العضو ليس مطورا في البوت**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#رفع مطور @(.*?)#',$text)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(!in_array($user_iduser,$dev["dev"])){
$dev["dev"][] = $user_iduser;
file_put_contents("information_/dev".$update_info.".json",json_encode($dev,128|32|256));
bot($chatId,['text'=>"**‹ :العـضو تم رفعـهہ مطـور  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"^^‹ : تم رفعا المطور سابقا √^^",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#تنزيل مطور @(.*?)#',$text)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(in_array($user_iduser,$dev["dev"])){
$key = array_search($user_iduser,$dev["dev"]);
unset($dev["dev"][$key]);
$dev["dev"] = array_values($dev["dev"]);
file_put_contents("information_/dev".$update_info.".json",json_encode($dev,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِطَۅࢪ  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"‹ : اެݪعٰضِۅ ݪيُسُ مِطَۅࢪ!",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
}
if ($text == "المجموعه"){
$acccha = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$chatId."?access_token=".$API_KEY),true);
$aa_title = $acccha[title];
$aa_chat_id = $acccha[chat_id];
$aa_messages_count = $acccha[messages_count];
$aa_participants_count = $acccha[participants_count];
bot($chatId,['text'=>"★اسم المجموعه↫ $aa_title 
★ايدي المجموعه↫$aa_chat_id 
★رسائل المجموعه↫ $aa_messages_count 
★اعضـاء المجموعه↫ $aa_participants_count ","link"=>["type"=>"reply","mid"=>$message_id]]);
}

if ($text == "الرابط"){
bot($chatId,['text'=>"✯︙ Link Group :
    $link","link"=>["type"=>"reply","mid"=>$message_id]]);
}
if ($text == "المنشئ"){
bot($chatId,['text'=>"  √︙اެݪمِنِشِئ اެݪمِجَمِۅعٰهَ اެݪاެسُاެسُيُ .
          ━─━─────━─────━─━
✧︙Name ↬ $owner_name 
✧︙uSer ↬ ❲ $owner_username ❳  ","link"=>["type"=>"reply","mid"=>$message_id]]);
}
if ($text == "المطور"){
bot($chatId,['text'=>"𝗖𝗼𝗿𝗲 𝗗𝗲𝘃𝗘𝗹𝗼𝗽𝗲𝗿
━───━ ★ ━───━
⌁︙Name ↬  •آـآݪۿڪࢪ𖠠عٰݪشِ •
⌁︙uSer ↬- ❲ @FFTFT❳  ","link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($reply && $text == "رفع منشئ" && is_creator($user_id, $chatId)){
if(!in_array($re_user_id,$owner[$chatId])){
$owner[$chatId][] = $re_user_id;
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
bot($chatId,['text'=>"‹ : تم رفعـهہ منـشئِ  بالـبوتَ.
","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› المنشئ تم رفعة مسبقاً √",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "تنزيل منشئ" && is_creator($user_id, $chatId)){
if(in_array($re_user_id,$owner[$chatId])){
$key = array_search($re_user_id,$owner[$chatId]);
unset($owner[$chatId][$key]);
$owner[$chatId] = array_values($owner[$chatId]);
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِنِشِئ بُاެݪبُۅتِ .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› اެݪعٰضِۅ ݪيُسُ مِنِشِئ بُاެݪبُۅتِ.",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#رفع مدير @(.*?)#',$text) && is_creator($user_id, $chatId) || preg_match('#رفع منشئ @(.*?)#',$text) && is_creator($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(!in_array($user_iduser,$owner[$chatId])){
$owner[$chatId][] = $user_iduser;
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ ࢪفِعٰهَ مِنِشِئ بُاެݪبُۅتِ.**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› اެݪمِنِشِئ تِمِ ࢪفِعٰهَ سُاެبُقِاެ♡",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#تنزيل مدير @(.*?)#',$text) && is_creator($user_id, $chatId) || preg_match('#تنزيل منشئ @(.*?)#',$text) && is_creator($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(in_array($user_iduser,$owner[$chatId])){
$key = array_search($user_iduser,$owner[$chatId]);
unset($owner[$chatId][$key]);
$owner[$chatId] = array_values($owner[$chatId]);
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِنِشِئ بُاެݪبُۅتِ  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› اެݪعٰضِۅ ݪيُسُ مِنِشِئ √.",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($text == "ايدي" or $text == "ا"){
$infoad = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$user_id));
$is_name = $infoad->members[0]->name; 
$is_user_id = $infoad->members[0]->user_id;
$is_username = $infoad->members[0]->username; 
$is_bio = isset($infoad->members[0]->description) ? $infoad->members[0]->description : "لا يوجد!";
$is_rank = rank($user_id, $chatId);
$is_active = $active[$abstfal]." ".$rate[$rate1];
$sId = isset($second[$chatId]["id"]) ? $second[$chatId]["id"] : "• ﮼ايديك︙$is_user_id 🎟️ ،
• اެسُمِكَ اެݪحِݪۅ︙ $is_name ،
• يُۅࢪِ࣪ࢪكَ اެݪحِݪۅ♡︙@$is_username 📌،
• ﮼ࢪسُاެئݪكَ اެݪجَمِيُݪهَ٪ ،
•  ࢪتِبُتِكَ ︙$is_rank  ،";
$sId = str_replace(["US","NAME","ID","RT"],["@$is_username",$is_name,$is_user_id,$is_rank],$sId);
bot($chatId,['text'=>$sId,"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
if(is_owner($user_id, $chatId)){
if ($text == "مسح كليشه الايدي"){
bot($chatId,['text'=>"‹ : تم مسح كـݪيشهہ الايدي بنجـاح .","link"=>["type"=>"reply","mid"=>$message_id]]);
unset($second[$chatId]["id"]);
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"]== "addid"){
if($text != "/start"){
bot($chatId,['text'=>"‹ : تم اضـافه كـݪيشهہ الايدي 🔻 .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$chatId]["id"] = $text;
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if ($text == "تعيين كليشه الايدي"){
bot($chatId,['text'=>"ارسل كليشة الايدي يمكن ان تحتوي على

لعرض المعرف : US
لعرض الايدي : ID
لعرض الاسم : NAME
 لعرض الرتبة : RT","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "addid";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}




if ($text == "مسح الترحيب"){
bot($chatId,['text'=>"‹ : تِمِ مِسُحِ اެݪتِࢪحِيُبُ√","link"=>["type"=>"reply","mid"=>$message_id]]);
unset($second[$chatId]["user_added"]);
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"]== "adtr"){
if($text != "/start"){
bot($chatId,['text'=>"‹ : تِمِ حِفِضِ اެݪاتِࢪحِيُبُ .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$chatId]["user_added"] = $text;
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if ($text == "اضف ترحيب"){
bot($chatId,['text'=>"› قم بأرسال كليشة الترحيب

↬ لعرض الاسم : #name
↬ لعرض المعرف : #username","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "adtr";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if ($text == "الترحيب"){
$we = isset($second[$chatId]["user_added"]) ? $second[$chatId]["user_added"] : "› انضم عضو جديد المجموعة 🥹
↬ معرف العضو :  $username 
↬ اسم العضو :  $name ";
bot($chatId,['text'=>$we,"link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($reply && $text == "رفع ادمن" && is_owner($user_id, $chatId)){
if(!in_array($re_user_id,$Admin[$chatId])){
$Admin[$chatId][] = $re_user_id;
file_put_contents("information_/Admin".$update_info.".json",json_encode($Admin,128|32|256));
bot($chatId,['text'=>"**‹ : اެݪعٰضِۅ تِمِ ࢪفِعٰهَ اެډمِنِ √ .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› الادمن تم رفعة مسبقاً .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "تنزيل ادمن" && is_owner($user_id, $chatId)){
if(in_array($re_user_id,$Admin[$chatId])){
$key = array_search($re_user_id,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($Admin,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪ اެݪعٰضِۅ مِنِ اެݪاެډمِنِ  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› العضو ليس ادمن بالفعل .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#رفع ادمن @(.*?)#',$text) && is_owner($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(!in_array($user_iduser,$Admin[$chatId])){
$Admin[$chatId][] = $user_iduser;
file_put_contents("information_/Admin".$update_info.".json",json_encode($Admin,128|32|256));
bot($chatId,['text'=>"**‹ : العضـو تم رفعـهہ ادمــنِ  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› الادمن تم رفعة مسبقاً .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#تنزيل ادمن @(.*?)#',$text) && is_owner($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = $infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(in_array($user_iduser,$Admin[$chatId])){
$key = array_search($user_iduser,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($Admin,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪ اެݪعٰضِۅ اެډمِنِ  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› هوة بالفعل ليس ادمن .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ؟",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "رفع مميز" && is_admin($user_id, $chatId)){
if(!in_array($re_user_id,$Special[$chatId])){
$Special[$chatId][] = $re_user_id;
file_put_contents("information_/Special".$update_info.".json",json_encode($Special,128|32|256));
bot($chatId,['text'=>"**‹ : اެݪعٰضِۅ تِمِ ࢪفِعٰهَ مِمِيُࢪِ࣪♡  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› تم رفعة مسبقاً .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "تنزيل مميز" && is_admin($user_id, $chatId)){
if(in_array($re_user_id,$Special[$chatId])){
$key = array_search($re_user_id,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($Special,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِمِيُࢪِ࣪.**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› هوة بالفعل ليس عضو مميز! ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#رفع مميز @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(!in_array($user_iduser,$Special[$chatId])){
$Special[$chatId][] = $user_iduser;
file_put_contents("information_/Special".$update_info.".json",json_encode($Special,128|32|256));
bot($chatId,['text'=>"**‹ :  تِمِ ࢪفِعٰهَ مِمِيُࢪِ࣪   .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› تم رفعة مسبقاً .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#تنزيل مميز @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(in_array($user_iduser,$Special[$chatId])){
$key = array_search($user_iduser,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($Special,128|32|256));
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪهَ مِمِيُࢪِ࣪ .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› هَۅةِ اެصِݪاެ ݪيُسُ مِمِيُࢪِ࣪",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"؟ تأكد من صحة اليوزر ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#تنزيل الكل @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(is_creator($user_iduser, $chatId)){
$rankT = rank($user_iduser, $chatId);
bot($chatId,['text'=>"**› عذرآ لايمكنـك تنزيـݪه! .
› لدية رتبة ⦅ $rankT ⦆**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
if(in_array($user_iduser,$Special[$chatId]) || in_array($user_iduser,$Admin[$chatId]) || in_array($user_iduser,$owner[$chatId])){
if(is_creator($user_id, $chatId)){
if(in_array($user_iduser,$owner[$chatId])){
$key = array_search($user_iduser,$owner[$chatId]);
unset($owner[$chatId][$key]);
$owner[$chatId] = array_values($owner[$chatId]);
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($user_iduser,$Admin[$chatId])){
$key = array_search($user_iduser,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($user_iduser,$Special[$chatId])){
$key = array_search($user_iduser,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}elseif(is_owner($user_id, $chatId)){
if(in_array($user_iduser,$Admin[$chatId])){
$key = array_search($user_iduser,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($user_iduser,$Special[$chatId])){
$key = array_search($user_iduser,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}elseif(is_admin($user_id, $chatId)){
if(in_array($user_iduser,$Special[$chatId])){
$key = array_search($user_iduser,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}
bot($chatId,['text'=>"**‹ : تم تنزيـݪهہ من جمـيع اݪـرتب  .**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› عذرآ لايمكنـك تنزيـݪهہ .
› العضو ليس لدية اي رتبة",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تأكد من صحة اليوزر ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "تنزيل الكل" && is_admin($user_id, $chatId)){
if(is_creator($re_user_id, $chatId)){
$rankT = rank($re_user_id, $chatId);
bot($chatId,['text'=>"**› عذرآ لايمكنـك تنزيـݪهہ .
› لدية رتبة ⦅ $rankT ⦆**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
if(in_array($re_user_id,$Special[$chatId]) || in_array($re_user_id,$Admin[$chatId]) || in_array($re_user_id,$owner[$chatId])){
if(is_creator($user_id, $chatId)){
if(in_array($re_user_id,$owner[$chatId])){
$key = array_search($re_user_id,$owner[$chatId]);
unset($owner[$chatId][$key]);
$owner[$chatId] = array_values($owner[$chatId]);
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($re_user_id,$Admin[$chatId])){
$key = array_search($re_user_id,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($re_user_id,$Special[$chatId])){
$key = array_search($re_user_id,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}elseif(is_owner($user_id, $chatId)){
if(in_array($re_user_id,$Admin[$chatId])){
$key = array_search($re_user_id,$Admin[$chatId]);
unset($Admin[$chatId][$key]);
$Admin[$chatId] = array_values($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($owner,128|32|256));
}
if(in_array($re_user_id,$Special[$chatId])){
$key = array_search($re_user_id,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}elseif(is_admin($user_id, $chatId)){
if(in_array($re_user_id,$Special[$chatId])){
$key = array_search($re_user_id,$Special[$chatId]);
unset($Special[$chatId][$key]);
$Special[$chatId] = array_values($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
}
bot($chatId,['text'=>"**‹ : تِمِ تِنِࢪِ࣪يُݪ اެݪكَݪ.**","format"=>"markdown",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› عٰذِࢪاެ ݪاެيُمِكَنِ تِنِࢪِ࣪يُݪهَ.
› العضو ليس لدية اي رتبة",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(is_special($user_id, $chatId)){
if($text == "ردود" || $text == "الردود"){
if(count($replies[$chatId]["rp"]) != 0){
for ($i=0; $i < count($replies[$chatId]["rp"]); $i++) {
if($replies[$chatId]["text"][$replies[$chatId]["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$replies[$chatId]["rp"][$i]." -> (رساله)";
}elseif($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$replies[$chatId]["rp"][$i]." -> (ملصق)";
}elseif($replies[$chatId]["audio"][$replies[$chatId]["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$replies[$chatId]["rp"][$i]." -> (صوت)";
}elseif($replies[$chatId]["image"][$replies[$chatId]["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$replies[$chatId]["rp"][$i]." -> (صوره)";
}elseif($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$replies[$chatId]["rp"][$i]." -> (فيديو)";
}
}
bot($chatId,['text'=>"›  قِاެئمِهَ اެݪࢪډۅډ ↯.\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› ݪيُسُ هَنِاެكَ ࢪډۅډ مِضِاެفِهَ","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "نينينيمسمشوضكسحظمطريرنص"){
if(count($mute[$chatId]) != 0){
for ($i=0; $i < count($mute[$chatId]); $i++) {
$Eq = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$mute[$chatId][$i]));
if(!$Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- ".$Eq->members[0]->name;
}elseif($Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- @".$Eq->members[0]->username;
}
}
bot($chatId,['text'=>"لك قائمه المكتومين! \n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› لايوجد مكتومين .","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "المميزين"){
if(count($Special[$chatId]) != 0){
for ($i=0; $i < count($Special[$chatId]); $i++) {
$Eq = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$Special[$chatId][$i]));
if(!$Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- ".$Eq->members[0]->name;
}elseif($Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- @".$Eq->members[0]->username;
}
}
bot($chatId,['text'=>"› قِاެئمِهَ اެݪمِمِيُࢪِ࣪يُنِ⇩\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› لايوجد مميزين .","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "الادمنيه" || $text == "الادمنية"){
if(count($Admin[$chatId]) != 0){
for ($i=0; $i < count($Admin[$chatId]); $i++) {
$Eq = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$Admin[$chatId][$i]));
if(!$Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- ".$Eq->members[0]->name;
}elseif($Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- @".$Eq->members[0]->username;
}
}
bot($chatId,['text'=>"› قائمة الادمنية ⇩\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› لايوجد ادمنية .","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "المدراء" || $text == "المنشئين"){
if(count($owner[$chatId]) != 0){
for ($i=0; $i < count($owner[$chatId]); $i++) {
$Eq = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chatId.'/members?access_token='.$API_KEY.'&user_ids='.$owner[$chatId][$i]));
if(!$Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- ".$Eq->members[0]->name;
}elseif($Eq->members[0]->username){
$msg = $msg."\n".($i+1)."- @".$Eq->members[0]->username;
}
}
bot($chatId,['text'=>"› قائمة المنشئين ⇩.\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› لايوجد منشئين .","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "الاوامر"){
bot($chatId,['text'=>"⊰❳ - هَنِاެاك 〈𝟑⦒ اެۅاެمِࢪ ݪعٰࢪضِهَاެ
┉┉┉┉┉┉┉⦖┉┉┉┉┉┉┉
   ⧔︙م1 -›ݪعٰࢪضِ اެۅاެمِࢪ اެݪحِمِاެيُهَ
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
⧔︙م2 -› عٰࢪضِ اެۅاެمِࢪ اެݪمِنِشِئيُنِ ۅ اެݪاެډمِنِيُهَ
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
⧔︙ م3 -› ݪعٰࢪضِ اެۅاެمِࢪ اެݪمِطَۅࢪيُنِ
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
•━━━━━ TEMM SWAT ━━━━━•

➹ 𝒂𝒍𝒍 𝒑𝒓𝒐𝒕𝒆𝒄𝒕𝒊𝒐𝒏 𝒐𝒓𝒅𝒆𝒓𝒔  
 ⌫︎- For more➙ @SOOT-
-"]);
}
}
if($text == "گچڤكمچأ" && is_admin($user_id, $chatId)){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪمڪتومين  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
unset($mute[$chatId]);
file_put_contents("information_/mute".$update_info.".json",json_encode($owner,128|32|256));
}
if($text == "مسح المميزين" && is_admin($user_id, $chatId)){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪمميزين  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
unset($Special[$chatId]);
file_put_contents("information_/Special".$update_info.".json",json_encode($owner,128|32|256));
}
if($text == "مسح الادمنيه" && is_owner($user_id, $chatId)){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪادمـنية  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
unset($Admin[$chatId]);
file_put_contents("information_/Admin".$update_info.".json",json_encode($owner,128|32|256));
}
if($text == "مسح المدراء" && is_creator($user_id, $chatId) || $text == "مسح المنشئين" && is_creator($user_id, $chatId)){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪمنشئين  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
unset($owner[$chatId]);
file_put_contents("information_/owner".$update_info.".json",json_encode($owner,128|32|256));
}
if($text == "مسح الردود" && is_owner($user_id, $chatId)){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪردود  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
for ($i=0; $i < count($replies[$chatId]["rp"]); $i++) {
if($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$i]]){
unset($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$i]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["audio"][$replies[$chatId]["rp"][$i]]){
unset($replies[$chatId]["audio"][$replies[$chatId]["rp"][$i]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["text"][$replies[$chatId]["rp"][$i]]){
unset($replies[$chatId]["text"][$replies[$chatId]["rp"][$i]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["image"][$replies[$chatId]["rp"][$i]]){
unset($replies[$chatId]["image"][$replies[$chatId]["rp"][$i]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["video"][$replies[$chatId]["rp"][$i]]){
unset($replies[$chatId]["video"][$replies[$chatId]["rp"][$i]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
}
unset($replies[$chatId]["rp"]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($reply && $text == "كشف" || $text == "رتبته"){
$rankT = rank($re_user_id, $chatId);
bot($chatId,['text'=>"𝘂𝗦𝗲𝗿𝗸 .⇝ $re_username
𝐑𝘂𝘁𝗕𝗮 .⇝ $rankT ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
if($text == "معلوماتي" || $text == "رتبتي"){
$rankT = rank($user_id, $chatId);
bot($chatId,['text'=>"𝘂𝗦𝗲𝗿𝗸 .⇝ $username 
  𝐑𝘂𝘁𝗕𝗮 .⇝ $rankT ",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
if(is_admin($user_id, $chatId)){
if($second[$user_id]["set"] == "replies2"){
if($text || $message->body->attachments[0]->type['audio']){
if($message->body->text){
if($text != "/start" && $text != "اضف رد" && $text != "اضف امر"){
$replies[$chatId]["text"][$second[$user_id]["re"]] = $text;
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
}
if($message->body->attachments[0]->payload->id && $message->body->attachments[0]->type['audio']){
$replies[$chatId]["audio"][$second[$user_id]["re"]] = $message->body->attachments[0]->payload->token;
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
bot($chatId,['text'=>"‹ : تِمِ حِفِضِ اެݪࢪډ .","link"=>["type"=>"reply","mid"=>$message_id]]);
if(!in_array($second[$user_id]["re"],$replies[$chatId]["rp"])){
$replies[$chatId]["rp"][] = $second[$user_id]["re"];
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
$second[$user_id]["re"] = false;
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($second[$user_id]["set"] == "replies1"){
if($text && $text != "/start" && $text != "اضف رد" && $text != "اضف امر"){
bot($chatId,['text'=>"› اެݪاެنِ اެࢪسُݪ اެݪاެمِࢪ اެݪذِيُ يُحِتِۅيُ عٰݪى بُصِمِهَ اެۅ ࢪسُاެݪهَ.","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["re"] = $text;
$second[$user_id]["set"] = "replies2";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($text == "اضف رد"){
bot($chatId,['text'=>"› أرسل الكلمه التي تريد عمل رد لها .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "replies1";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"] == "repliesdel"){
if($text && $text != "/start" && $text != "اضف رد" && $text != "اضف امر" && $text != "حذف رد"){
bot($chatId,['text'=>"‹ : تم حذف اݪرد بنـجاح .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
$key = array_search($text,$replies[$chatId]["rp"]);
if($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$key]]){
unset($replies[$chatId]["sticker"][$replies[$chatId]["rp"][$key]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["audio"][$replies[$chatId]["rp"][$key]]){
unset($replies[$chatId]["audio"][$replies[$chatId]["rp"][$key]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["text"][$replies[$chatId]["rp"][$key]]){
unset($replies[$chatId]["text"][$replies[$chatId]["rp"][$key]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["image"][$replies[$chatId]["rp"][$key]]){
unset($replies[$chatId]["image"][$replies[$chatId]["rp"][$key]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
if($replies[$chatId]["sticer"][$replies[$chatId]["rp"][$key]]){
unset($replies[$chatId]["sticer"][$replies[$chatId]["rp"][$key]]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
unset($replies[$chatId]["rp"][$key]);
$replies[$chatId]["rp"] = array_values($replies[$chatId]["rp"]);
file_put_contents("information_/replies".$update_info.".json",json_encode($replies,128|32|256));
}
}
if($text == "حذف رد"){
bot($chatId,['text'=>"› قم بارسال الكلمة التي تريد حذفها .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "repliesdel";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"] == "repold2"){
if($text && $text != "/start"){
bot($chatId,['text'=>"‹ : تم حفـض اݪامر بنـجاح   .","link"=>["type"=>"reply","mid"=>$message_id]]);
$true[$chatId]["List"][]= $text;
$true[$chatId][$second[$user_id]["re"]] = $second[$user_id]["re"];
$true[$chatId][$text]= $second[$user_id]["re"];
file_put_contents("information_/true".$update_info.".json",json_encode($true,128|32|256));
$second[$user_id]["re"] = false;
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($second[$user_id]["set"] == "repold"){
if($text && $text != "/start"){
bot($chatId,['text'=>"› ارسل الامر الجديد الان .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["re"] = $text;
$second[$user_id]["set"] = "repold2";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($text == "اضف امر" or $text == "تغير امر" or  $text == "تغيير امر" or $text == "اظف امر" or  $text == "وضع امر" or $text == "وظع امر"){
bot($chatId,['text'=>"ارسل الامر القديم 🇮🇶.","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "repold";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"] == "repdelold"){
if($text && $text != "/start"){
bot($chatId,['text'=>" تم حذف الامر  .","link"=>["type"=>"reply","mid"=>$message_id]]);
$key = array_search($true[$chatId][$true[$chatId][$text]],$true[$chatId]["List"]);
unset($true[$chatId]["List"][$key]);
$true[$chatId]["List"] = array_values($true[$chatId]["List"]);
unset($true[$chatId][$true[$chatId][$text]]);
unset($true[$chatId][$text]);
file_put_contents("information_/true".$update_info.".json",json_encode($true,128|32|256));
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($text == "حذف امر" or $text == "مسح امر"){
bot($chatId,['text'=>"› ارسل الامر القديم الان .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "repdelold";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($text == "مسح الاوامر المضافه" or $text == "حذف الاوامر المظافه"){
bot($chatId,['text'=>"‹ : تم مسح جميع اݪاوامر .","link"=>["type"=>"reply","mid"=>$message_id]]);
for($j=0;$j<count($true[$chatId]["List"]); $j++){
$deal = $true[$chatId]["List"][$j];
$d = $true[$chatId][$deal];
unset($true[$chatId][$d]);
unset($true[$chatId][$deal]);
}
unset($true[$chatId]["List"]);
file_put_contents("information_/true".$update_info.".json",json_encode($true,128|32|256));
}
if($text == "الاوامر المضافه" or $text == "الاوامر المظافه" or $text == "الاوامر الاحتياطيه" or $text == "الاوامر الجديده"){
if(count($true[$chatId]["List"]) != 0){
for ($i=0; $i < count($true[$chatId]["List"]); $i++) {
$Eq = $true[$chatId]["List"][$i];
$dr = $true[$chatId][$Eq];
$msg = $msg."\n".($i+1)."- ".$Eq." ~ ( ".$dr." )";
}
bot($chatId,['text'=>"› قائمه الاوامر المضافة ♡.\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"› لا يوجد اوامر مضافه ∅.","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($text == "م٢" || $text == "م2" || $text == "اوامر المنشئين"){
bot($chatId,['text'=>"#اوامر_المنشئ الاساسي↫⤈
↡ــــٓــــــٓــــــٓــ↡
رفع /تنزيل ↞منشئ
تنزيل الكل .
مسح المنشئين.
اضف /مسح.↞ ترحيب
مسح الردود 
↡
#اوامر المنشئ ↞مدير
↡ــــٓــــــٓــــــٓــ↡
رفع/تنزيل↞ادمن
مسح الردود  √
 تنزيل الكل√
اضف/ترحيب↠
↡ــــٓــــــٓــــــٓــ↡
#اوامر ↞الادمنيه♡
ٴ━──⇩──━ٴ
طرد / حظر / حضر ↫ بالرد او بالمعرف
★تثبيت
الغاء التثبيت  ↫ الرساله بالرد
اضف / حذف↫رد
كتم / بالرد او بالمعرف 
مسح ↫ للمسح لرسالة .
رفع مميز / تنزيل مميز
حذف الاوامر المضافه
اضف /حذف / مسح  ↫امر 
مسح المكتومين
مسح المميزين
تنزيل الكل
الاعدادات
الردود
♡ــــٓــــــٓــــــٓــــــٓــ♡
- Alosh —⊁ : @SS2i

  — — — — — — — — — \n","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
}
if($text == "م٣" || $text == "م3" || $text == "اوامر المطور" || $text == "اوامر المطورين"){
bot($chatId,['text'=>"⌁︙اوامر مطورين البوت ↯.↯.
         ━─━─────━─────━─━
› اެۅاެمِࢪ اެݪمِطَۅࢪ اެݪاެسُاެسُيُ 
— — — — —
› رفع مطور 
› تنزيل مطور 
› المطورين 
› جميع الاوامر بـالبوت يجب استخداما.
— — — — — — — — —
› #اެۅاެمِࢪ اެݪمِطَۅࢪ√.
— — — —
› اضف / حذف رد عام 
› الردود العامه 
› مسح الردود العامه 
› جميع الاوامر التي بالبوت يجب استخداما
━───━ ✵ ━───━ٴ
- Alosh—⊁ : @SS2i
 — — — — — — — — — \n","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
}
if($text == "م١" || $text == "م1" || $text == "اوامر الحمايه" || $text == "اوامر الادمنيه"){
bot($chatId,['text'=>"☽آِإَوَٖآِإَمَِٰࢪٖ آِإَلحٰٖمَِٰآِإَيُه☾
بٰٖوَٖتِٰ آِوَٖسُڪِٰآِࢪٖ
 
قٰٖفَِل ↞فَِتِٰحٰٖ ↞ آِإَلآِإَوَٖآِإَمَِٰࢪٖ
ــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـ
★قفل ♡ فتح↫الروابط
★قفل ♡ فتح↫المعرف
★قفل ♡ فتح↫البوتات
★قفل ♡ فتح↫المتحركه
★قفل ♡ فتح↫الملصقات
★قفل ♡ فتح↫الملفات
★قفل ♡ فتح↫الصور
★قفل ♡ فتح↫الفيديو
★قفل ♡ فتح↫الانلاين
★قفل ♡ فتح↫الدردشه
★قفل ♡ فتح↫التوجيه
★قفل ♡ فتح↫الاغاني
★قفل ♡ فتح↫الصوت
★قفل ♡ فتح↫الجهات
★قفل ♡ فتح↫الازرار
★قفل ♡ فتح↫الاغاني
★قفل ♡ فتح↫الهمسه
★قفل ♡ فتح↫التكرار
★قفل ♡ فتح↫التاك
★قفل ♡ فتح↫التعديل
★قفل ♡ فتح↫الفايروس
★قفل ♡ فتح↫الكلايش
★قفل ♡ فتح↫الهايشتاك
★قفل ♡ فتح↫الترحيب
★قفل ♡ فتح↫الفشار
★قفل ♡ فتح↫الكل
★قفل ♡فتح↫الردود
ــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـــ๋͜ﮧـ͜ާـٌـ
قِنِاެهَ اެݪبُۅتِ √ @SOOT-
 — — — — — — — — — \n","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
}
$setall = ["image","audio","sticker","location","offense","video","contact","file","inline_keyboard","spam","is_bot","user_added","hashtag","username","link","forward","msg"];
$setname = ["الصور","الصوت","الملصقات","الموقع","الفشار","الفيديو","الجهات","الملفات","الهمسه","الفايروس","البوتات","الترحيب","الهشتاك","المعرفات","الروابط","التوجيه♥️","الرسائل"];
if($text == "الاعدادات" or $text == "اعدادات"){
for ($i=0; $i < count($setall); $i++) {
if(!$lock[$chatId][$setall[$i]]){
$rd = "✅";
}else{
$rd = "✖";
}
$msg = $msg."\n".($i+1)."- ".$setname[$i]." -> ( ".$rd." )";
}
bot($chatId,['text'=>"› قائمه الاعدادات ⇩.\n— — — — — — — — —\n› العلامه ✅ تعني الامر مسموح به \n› العلامه ✖ تعني الامر غير مسموح به \n".$msg."\n— — — — — — — — —\n","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
}elseif($text == "قفل الكل"){
bot($chatId,['text'=>" -[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ  $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
for ($i=0; $i < count($setall); $i++) {
$lock[$chatId][$setall[$i]] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
}
}elseif($text == "فتح الكل"){
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
for ($i=0; $i < count($setall); $i++) {
$lock[$chatId][$setall[$i]] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
}
}elseif($text == "قفل الصور" || $text == "قفل المتحركه" || $text == "قفل المتحركة" || $text == "قفل المتحركات"){
$lock[$chatId]["image"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل البصمه" || $text == "قفل الاغاني" || $text == "قفل الصوت"){
$lock[$chatId]["audio"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الملصق" || $text == "قفل الملصقات"){
$lock[$chatId]["sticker"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)›
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الردود" || $text == "قفل ردود"){
$lock[$chatId]["replies"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الموقع"){
$lock[$chatId]["location"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الفشار"){
$lock[$chatId]["offense"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الفيديو"){
$lock[$chatId]["video"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الجهات"){
$lock[$chatId]["contact"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الملفات"){
$lock[$chatId]["file"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الازرار" || $text == "قفل الهمسه" || $text == "قفل الانلاين"){
$lock[$chatId]["inline_keyboard"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل التوجيه"){
$lock[$chatId]["forward"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الروابط" || $text == "قفل الرابط"){
$lock[$chatId]["link"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل المعرف" || $text == "قفل المعرفات" || $text == "قفل التاك" || $text == "قفل اليوزر" || $text == "قفل اليوزرات"){
$lock[$chatId]["username"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الهشتاك"){
$lock[$chatId]["hashtag"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الترحيب"){
$lock[$chatId]["user_added"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل البوتات"){
$lock[$chatId]["is_bot"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل السبام" || $text == "قفل الكلايش" || $text == "قفل الفايروس" || $text == "قفل الفايروس بالطرد"){
$lock[$chatId]["spam"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الصور" || $text == "فتح المتحركه" || $text == "فتح المتحركة" || $text == "فتح المتحركات"){
$lock[$chatId]["image"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح البصمه" || $text == "فتح الاغاني" || $text == "فتح الصوت"){
$lock[$chatId]["audio"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح المصق" || $text == "فتح الملصقات"){
$lock[$chatId]["sticker"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الردود" || $text == "فتح ردود"){
$lock[$chatId]["replies"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الموقع"){
$lock[$chatId]["location"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الفشار"){
$lock[$chatId]["offense"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الفيديو"){
$lock[$chatId]["video"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الجهات"){
$lock[$chatId]["contact"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الملفات"){
$lock[$chatId]["file"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الازرار" || $text == "فتح الهمسه" || $text == "فتح الانلاين"){
$lock[$chatId]["inline_keyboard"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح التوجيه"){
$lock[$chatId]["forward"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i
)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الروابط" || $text == "فتح الرابط"){
$lock[$chatId]["link"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح المعرف" || $text == "فتح المعرفات" || $text == "فتح التاك"){
$lock[$chatId]["username"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الهشتاك"){
$lock[$chatId]["hashtag"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الترحيب"){
$lock[$chatId]["user_added"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح البوتات"){
$lock[$chatId]["is_bot"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح السبام" || $text == "فتح الكلايش" || $text == "فتح الفايروس"){
$lock[$chatId]["spam"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "قفل الدردشه" || $text == "قفل المحادثه" || $text == "قفل الرسائل" || $text == "قفل الدردشة"){
$lock[$chatId]["msg"] = true;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($text == "فتح الدردشه" || $text == "فتح المحادثه" || $text == "فتح الرسائل" || $text == "فتح الدردشة"){
$lock[$chatId]["msg"] = false;
file_put_contents("information_/lock".$update_info.".json",json_encode($lock,128|32|256));
bot($chatId,['text'=>"-[ آِإَبٰٖڜࢪٖ يࢪٖوَٖحٰٖ آِإَوَٖسُڪِٰآِإَࢪٖ  🥺🖤.](https://tt.me/SS2i)
**- قـامَ البـوتَ بــ $text**","format"=>"markdown","link"=>["type"=>"reply","mid"=>$message_id]
]);
}elseif($reply && $text == "مسح"){
deleteMessage($message_id);
deleteMessage($re_message_id);
}elseif($reply && $text == "تثبيت"){
bot($chatId,['text'=>"› تم تثبيت الرساله بنجاح 🔺.","link"=>["type"=>"reply","mid"=>$message_id]]);
pin($chatId, $re_message_id);
}elseif($text == "الغاء تثبيت" || $text == "الغاء التثبيت"){
bot($chatId,['text'=>"› تم الغاء تثبيت الرساله بنجاح 🔻.","link"=>["type"=>"reply","mid"=>$message_id]]);
unpin($chatId);
}
if($reply && $text == "كتم" && is_admin($user_id, $chatId)){
if(is_special($re_user_id, $chatId)){
$rankT = rank($re_user_id, $chatId);
bot($chatId,['text'=>"› عذرا لا يمكنك كتم ( $rankT ) ❗",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
if(!in_array($re_user_id,$mute[$chatId])){
$mute[$chatId][] = $re_user_id;
file_put_contents("information_/mute".$update_info.".json",json_encode($mute,128|32|256));
bot($chatId,['text'=>"‹ : تم ڪتمـهہ بنـجاح  .",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› تم كتمه سابقا 🔹.","link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(!preg_match('#الغاء(.*?)#',$text)){
if(preg_match('#كتم @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(is_special($user_iduser, $chatId)){
$rankT = rank($user_iduser, $chatId);
bot($chatId,['text'=>"› عذرا لايمكنك ".$text." ( ".$rankT." ) ","link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
if(!in_array($user_iduser,$mute[$chatId])){
$mute[$chatId][] = $user_iduser;
file_put_contents("information_/mute".$update_info.".json",json_encode($mute,128|32|256));
bot($chatId,['text'=>"› الاسم : ( $nameuser ) \n› المعرف : ( $usernameuser ) \n‹ : تِمِ كَتِمِهَ 🖤 .","link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› تم كتمه مسبقا♡","link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"تاكد من اليوزر ⍨",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
}
if($reply && $text == "الغاء كتم" && is_admin($user_id, $chatId)){
if(in_array($re_user_id,$mute[$chatId])){
$key = array_search($re_user_id,$mute[$chatId]);
unset($mute[$chatId][$key]);
$mute[$chatId] = array_values($mute[$chatId]);
file_put_contents("information_/mute".$update_info.".json",json_encode($mute,128|32|256));
bot($chatId,['text'=>" تم الغاء الكتم ♡","link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"هوة ليس مكتوم ♡","link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if(preg_match('#الغاء كتم @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(in_array($user_iduser,$mute[$chatId])){
$key = array_search($user_iduser,$mute[$chatId]);
unset($mute[$chatId][$key]);
$mute[$chatId] = array_values($mute[$chatId]);
file_put_contents("information_/mute".$update_info.".json",json_encode($mute,128|32|256));
bot($chatId,['text'=>"› الاسم : ( $nameuser ) \n› المعرف : ( $usernameuser ) \n› تــم الغاء الكتم ♡",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}else{
bot($chatId,['text'=>"› هوة ليس مكتوم ♡",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}else{
bot($chatId,['text'=>"‹ : تاكد من اليوزر ♡",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
if($reply && $text == "طرد" || $reply && $text == "حظر" || $reply && $text == "حضر"){
if(is_special($re_user_id, $chatId)){
$rankT = rank($re_user_id, $chatId);
bot($chatId,['text'=>"› عذرا لا يمكنك".$text." ( ".$rankT." ) ","link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
kickChatMember($re_user_id, $chatId);
bot($chatId,['text'=>"› الاسم : ( $re_name ) \n› المعرف : ( $re_username ) \n› تم  ( $text ) بنجاح ♡","link"=>["type"=>"reply","mid"=>$message_id]
]);
}
if(preg_match('#طرد @(.*?)#',$text) && is_admin($user_id, $chatId) || preg_match('#حظر @(.*?)#',$text) && is_admin($user_id, $chatId) || preg_match('#حضر @(.*?)#',$text) && is_admin($user_id, $chatId)){
$user = explode('@', $text)[1];
$infoad = json_decode(file_get_contents("https://botapi.tamtam.chat/chats/".$user."?access_token=".$API_KEY));
$typeuser = $infoad->type;
$user_iduser = $infoad->dialog_with_user->user_id;
$nameuser = $infoad->dialog_with_user->name;
$usernameuser = "@".$infoad->dialog_with_user->username;
if($typeuser == "dialog"){
if(is_special($user_iduser, $chatId)){
$rankT = rank($user_iduser, $chatId);
bot($chatId,['text'=>" لايمكنك لديه رتبه◡̈ ".$text."\n ( ".$rankT." ) ","link"=>["type"=>"reply","mid"=>$message_id]
]);
return false;
}
bot($chatId,['text'=>" تم الطرد #بره الوصخ😹","link"=>["type"=>"reply","mid"=>$message_id]
]);
kickChatMember($user_iduser, $chatId);
}else{
bot($chatId,['text'=>"☾تاكد من اليوزر ☽",
"link"=>["type"=>"reply","mid"=>$message_id]
]);
}
}
} // صلاحيه ادمن
if(is_deved($user_id)){
if($text == "مسح الردود العامه"){
bot($chatId,['text'=>"^^‹ : تم مسح قـائـمة اݪردود العامه  .^^","link"=>["type"=>"reply","mid"=>$message_id],"format"=>"markdown"]);
for ($i=0; $i < count($public["rp"]); $i++) {
if($public["sticker"][$public["rp"][$i]]){
unset($public["sticker"][$public["rp"][$i]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["audio"][$public["rp"][$i]]){
unset($public["audio"][$public["rp"][$i]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["text"][$public["rp"][$i]]){
unset($public["text"][$public["rp"][$i]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["image"][$public["rp"][$i]]){
unset($public["image"][$public["rp"][$i]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["video"][$public["rp"][$i]]){
unset($public["video"][$public["rp"][$i]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
}
unset($public["rp"]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($text == "الردود العامه"){
if(count($public["rp"]) != 0){
for ($i=0; $i < count($public["rp"]); $i++) {
if($public["text"][$public["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$public["rp"][$i]." -> (رساله)";
}elseif($public["sticker"][$public["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$public["rp"][$i]." -> (ملصق)";
}elseif($public["audio"][$public["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$public["rp"][$i]." -> (صوت)";
}elseif($public["image"][$public["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$public["rp"][$i]." -> (صوره)";
}elseif($public["video"][$public["rp"][$i]]){
$msg = $msg."\n".($i+1)."- ".$public["rp"][$i]." -> (فيديو)";
}
}
bot($chatId,['text'=>"› قائمه الردود العامه .\n— — — — — — — — —\n".$msg,"link"=>["type"=>"reply","mid"=>$message_id]]);
}else{
bot($chatId,['text'=>"›  لا يوجد ردود ♡.","link"=>["type"=>"reply","mid"=>$message_id]]);
}
}
if($second[$user_id]["set"] == "public2am"){
if($text || $message->body->attachments[0]->type['video'] || $message->body->attachments[0]->type['image'] || $message->body->attachments[0]->type['sticker'] || $message->body->attachments[0]->type['audio']){
if($message->body->text){
if($text != "/start" && $text != "اضف رد" && $text != "اضف رد عام" && $text != "اضف امر"){
$public["text"][$second[$user_id]["re"]] = $text;
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
}
if($message->body->attachments[0]->payload->code && $message->body->attachments[0]->type['sticker']){
$public["sticker"][$second[$user_id]["re"]] = $message->body->attachments[0]->payload->code;
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($message->body->attachments[0]->payload->photo_id && $message->body->attachments[0]->type['image']){
$public["image"][$second[$user_id]["re"]] = $message->body->attachments[0]->payload->token;
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($message->body->attachments[0]->type['video'] && !$text && !$message->body->attachments[0]->payload->code && !$message->body->attachments[0]->type['sticker'] && !$message->body->attachments[0]->payload->photo_id && !$message->body->attachments[0]->type['image'] && !$message->body->attachments[0]->payload->id && !$message->body->attachments[0]->type['audio']){
$public["video"][$second[$user_id]["re"]] = $message->body->attachments[0]->payload->token;
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($message->body->attachments[0]->payload->id && $message->body->attachments[0]->type['audio']){
$public["audio"][$second[$user_id]["re"]] = $message->body->attachments[0]->payload->token;
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
bot($chatId,['text'=>"تم اضافة الرد ↫","link"=>["type"=>"reply","mid"=>$message_id]]);
if(!in_array($second[$user_id]["re"],$public["rp"])){
$public["rp"][] = $second[$user_id]["re"];
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
$second[$user_id]["re"] = false;
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($second[$user_id]["set"] == "public1am"){
if($text && $text != "/start" && $text != "اضف رد" && $text != "اضف رد عام" && $text != "اضف امر"){
bot($chatId,['text'=>"ارسل الرد الي يحتوي عــلى» بصمه او رساله«","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["re"] = $text;
$second[$user_id]["set"] = "public2am";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($text == "اضف رد عام"){
bot($chatId,['text'=>"› دز ♡الكلمه الي تريد تسوي اله رد يحلو♡.","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "public1am";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
if($second[$user_id]["set"] == "publicdelam"){
if($text && $text != "/start" && $text != "اضف رد" && $text != "اضف امر" && $text != "حذف رد"){
bot($chatId,['text'=>"› تم حذف الرد بنجاح .","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = false;
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
$key = array_search($text,$public["rp"]);
if($public["sticker"][$public["rp"][$key]]){
unset($public["sticker"][$public["rp"][$key]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["audio"][$public["rp"][$key]]){
unset($public["audio"][$public["rp"][$key]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["text"][$public["rp"][$key]]){
unset($public["text"][$public["rp"][$key]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["image"][$public["rp"][$key]]){
unset($public["image"][$public["rp"][$key]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
if($public["video"][$public["rp"][$key]]){
unset($public["video"][$public["rp"][$key]]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
unset($public["rp"][$key]);
$public["rp"] = array_values($public["rp"]);
file_put_contents("information_/public".$update_info.".json",json_encode($public,128|32|256));
}
}
if($text == "حذف رد عام"){
bot($chatId,['text'=>"› دز الكلمه الي تريد تحذفه يحلو♡.","link"=>["type"=>"reply","mid"=>$message_id]]);
$second[$user_id]["set"] = "publicdelam";
file_put_contents("information_/second".$update_info.".json",json_encode($second,128|32|256));
}
}
if($public["text"][$text]){
bot($chatId,['text'=>$public["text"][$text],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($public["image"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'image','payload'=>['token'=>$public["image"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($public["video"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'video','payload'=>['token'=>$public["video"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($public["audio"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'audio','payload'=>['token'=>$public["audio"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($public["sticker"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'sticker','payload'=>['code'=>$public["sticker"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
$a6 = array("  سؤال ينرفزك ؟🖤"," اخر همك في الحياة ؟","  أكثر شيء تغيّر في أسلوب حياتك بعد كورونا ؟💞💘","  لعبة بجوالك تلعبها دايم ؟","   فيه بحياتك شخص روحه مميزة ؟","  اكثر مكان تروحه لحالك ؟"," جرح الحبيب ولا جرح الصديق ؟?", "   شي تعترف انك فاشل فيه ؟💘","  موقف مريت فيه غيّر من حياتك ؟ ","هات كلام لشخص بدون ماتحط اسمه","علمنا عن تجربه خلت شخصيتك اقوى ؟","تصنف نفسك من الاشخاص المبدعين ؟","ممثلك المفضل ؟","تقدر تكتم مشاعرك ؟","اخر فلم دخلت له ف السينما ؟","جمال المكان يعتمد ","شي تعترف انك فاشل فيه ؟","أكبر غلطات عمرك ؟","أكثر شيء يُمكن أن تقدّره في الصداقات ؟","انجاز تفتخر فيه ؟","جملة من أغنية تحبها ؟","شيء مُستحيل يتغير فيك؟","وش ينادونك في البيت ؟","فنانك المفضل ؟","راضي عن نفسك ؟","اكثر ايموجي تستخدمه هالفتره بالكيبورد ؟","موقف خلاك تعصب مره ؟","تقدر تخفي ملامح","امدح نفسك باللغه العربيه الفصحى ؟","أكره شي عندك العناد ولا البرود ؟","كم باقي على عيد ميلادك ؟","متى يخوُنك التعبير  ؟","متى صار التغيير الكبير في شخصيتك ؟","نسبة رضاك عن نفسك من 10 ؟","قولها بلهجتك ( اذهب من امامي ) ؟","شي ودك فيه بس ماتتوقع يصير ؟","كيف تعرفت على أقرب أصحابك ؟","تؤمُن بمقولة إنسان ينسيّك انسان ؟","فكرت مره تنتحر 😂😂 ؟","مع او ضد مقولة ( محد يدوم ل احد ) ؟","‏- تقبل بالعودة لشخص كسر قلبك مرتين؟","‏ تكره أحد من قلبك ؟","لو بتغير اسمك ايش بيكون الجديد ؟"," ‏- للإناث | تقدّم إليكِ رجل مليونير لكنه مُقعد، هل تقبلين به؟","تتوقع أصدقائك الحاليين بكل امانه راح يوقفون معك بوقت الشدة ؟","‏- هل سبق ووقعت في حُب الشخص الخطأ ‏","‏هل تعتقد بان اصدقائك الحاليين هم فعلا اصدقاء؟","لو مسموح لك تقتل ثلاث بحياتك مين هم ؟","اس اللي تحب الهدوء ولا الإزعاج؟ ","   برنامج تكرهه ؟ "," لو فزعت/ي لصديق/ه وقالك مالك دخل وش بتسوي/ين؟ ","   امدح نفسك باللغه العربيه الفصحى ؟ "," ما هو أمنيتك؟ ","متى يوم ميلادك؟ ووش الهدية اللي نفسك فيه؟ "," وين تشوف نفسك بعد خمس سنوات؟ "," وين تشوف نفسك بعد خمس سنوات؟ ","  مكان تتمنى تسكن فيه ؟ ","كيف حال قلبك ؟ بخير ولا مكسور؟ ","لو يسألونك وش اسم امك تجاوبهم ولا تسفل فيهم؟ "," ألطف شخص مر عليك بحياتك؟ ","نسبة النعاس عندك حاليًا؟ ","وش مشروبك المفضل؟ او قهوتك المفضلة؟ "," كذبت في الاسئلة اللي مرت عليك قبل شوي؟ "," متى اخر مره قريت قرآن؟ "," اكبر غلطة بعمرك؟ "," أخر شي اكلته وش هو؟ "," قد جربت الدخان بحياتك؟ انلكفت ولا؟ "," إيموجي يوصف مزاجك حاليًا؟ "," عندك أصحاب كثير؟ ولا ينعد بالأصابع؟ ","تفضل التيكن او السنقل؟ "," لو زعلت بقوة وش بيرضيك ؟ "," وش برجك؟ "," لو قالو لك تتخلى عن شي واحد تحبه بحياتك وش يكون؟ "," أفضل أكلة تحبه لك؟ "," شيء جميل صار لك اليوم ؟ "," وش مشروبك المفضل؟ "," ردّك على شخص قال (أنا بطلع من حياتك)؟. "," كم فلوسك حاليا وهل يكفيك ام لا؟ "," اذا شفت احد على غلط تعلمه الصح ولا تخليه بكيفه؟ "," وش اجمل لهجة تشوفها؟ "," اذا قالو لك تسافر أي مكان تبيه وتاخذ معك شخص واحد وين بتروح ومين تختار؟ "," اكثر كذبة تقولها؟ "," بالعادة متى تنام؟ "," لو عندك فلوس وش السيارة اللي بتشتريها؟ "," عندك الشخص اللي يقلب الدنيا عشان زعلك؟ "," شيء تشوفه اكثر من اهلك ؟ "," دايم قوة الصداقة تكون بإيش؟ "," لو الجنسية حسب ملامحك وش بتكون جنسيتك؟ ","تحب تطق الميانة ولا ثقيل؟ "," اول حرف من اسم شخص تقوله? بطل تفكر فيني ابي انام؟ "," أنت بعلاقة حب الحين؟ ","الغيرة الزائدة شك؟ ولا زياده الحب؟ ","لو أغمضت عينيك الآن فما هو أول شيء ستفكر به؟ ","مع او ضد : النوم افضل حل لـ مشاكل الحياة؟ "," فُرصه تتمنى لو أُتيحت لك ؟ ","لقيت الشخص اللي يفهمك واللي يقرا افكارك؟ ","جربت شعور احد يحبك بس انت مو قادر تحبه؟ "," كم مره حبيت؟ "," من الناس اللي تحب الهدوء ولا الإزعاج؟ ","   برنامج تكرهه ؟ "," لو فزعت/ي لصديق/ه وقالك مالك دخل وش بتسوي/ين؟ ","   امدح نفسك باللغه العربيه الفصحى ؟ "," ما هو أمنيتك؟ ","متى يوم ميلادك؟ ووش الهدية اللي نفسك فيه؟ "," وين تشوف نفسك بعد خمس سنوات؟ "," وين تشوف نفسك بعد خمس سنوات؟ ","  مكان تتمنى تسكن فيه ؟ ","كيف حال قلبك ؟ بخير ولا مكسور؟ ","لو يسألونك وش اسم امك تجاوبهم ولا تسفل فيهم؟ "," ألطف شخص مر عليك بحياتك؟ ","نسبة النعاس عندك حاليًا؟ ","وش مشروبك المفضل؟ او قهوتك المفضلة؟ "," كذبت في الاسئلة اللي مرت عليك قبل شوي؟ "," متى اخر مره قريت قرآن؟ "," اكبر غلطة بعمرك؟ "," أخر شي اكلته وش هو؟ "," قد جربت الدخان بحياتك؟ انلكفت ولا؟ "," إيموجي يوصف مزاجك حاليًا؟ "," عندك أصحاب كثير؟ ولا ينعد بالأصابع؟ ","تفضل التيكن او السنقل؟ "," لو زعلت بقوة وش بيرضيك ؟ "," وش برجك؟ "," لو قالو لك تتخلى عن شي واحد تحبه بحياتك وش يكون؟ "," أفضل أكلة تحبه لك؟ "," شيء جميل صار لك اليوم ؟ "," وش مشروبك المفضل؟ "," ردّك على شخص قال (أنا بطلع من حياتك)؟. "," كم فلوسك حاليا وهل يكفيك ام لا؟ "," اذا شفت احد على غلط تعلمه الصح ولا تخليه بكيفه؟ "," وش اجمل لهجة تشوفها؟ "," اذا قالو لك تسافر أي مكان تبيه وتاخذ معك شخص واحد وين بتروح ومين تختار؟ "," اكثر كذبة تقولها؟ "," بالعادة متى تنام؟ "," لو عندك فلوس وش السيارة اللي بتشتريها؟ "," عندك الشخص اللي يقلب الدنيا عشان زعلك؟ "," شيء تشوفه اكثر من اهلك ؟ "," دايم قوة الصداقة تكون بإيش؟ "," لو الجنسية حسب ملامحك وش بتكون جنسيتك؟ ","تحب تطق الميانة ولا ثقيل؟ "," اول حرف من اسم شخص تقوله? بطل تفكر فيني ابي انام؟ "," أنت بعلاقة حب الحين؟ ","الغيرة الزائدة شك؟ ولا زياده الحب؟ ","لو أغمضت عينيك الآن فما هو أول شيء ستفكر به؟ ","مع او ضد : النوم افضل حل لـ مشاكل الحياة؟ "," فُرصه تتمنى لو أُتيحت لك ؟ "," اخر همك في الحياة ؟","  أكثر شيء تغيّر في أسلوب حياتك بعد كورونا ؟💞💘","  لعبة بجوالك تلعبها دايم ؟","   فيه بحياتك شخص روحه مميزة ؟","  اكثر مكان تروحه لحالك ؟"," جرح الحبيب ولا جرح الصديق ؟?", "   شي تعترف انك فاشل فيه ؟💘","  موقف مريت فيه غيّر من حياتك ؟ ","هات كلام لشخص بدون ماتحط اسمه","علمنا عن تجربه خلت شخصيتك اقوى ؟","تصنف نفسك من الاشخاص المبدعين ؟","ممثلك المفضل ؟","تقدر تكتم مشاعرك ؟","اخر فلم دخلت له ف السينما ؟","جمال المكان يعتمد ","شي تعترف انك فاشل فيه ؟","أكبر غلطات عمرك ؟","أكثر شيء يُمكن أن تقدّره في الصداقات ؟","انجاز تفتخر فيه ؟","جملة من أغنية تحبها ؟","شيء مُستحيل يتغير فيك؟","وش ينادونك في البيت ؟","فنانك المفضل ؟","راضي عن نفسك ؟","اكثر ايموجي تستخدمه هالفتره بالكيبورد ؟","موقف خلاك تعصب مره ؟","تقدر تخفي ملامح","امدح نفسك باللغه العربيه الفصحى ؟","أكره شي عندك العناد ولا البرود ؟","كم باقي على عيد ميلادك ؟","متى يخوُنك التعبير  ؟","متى صار التغيير الكبير في شخصيتك ؟","نسبة رضاك عن نفسك من 10 ؟","قولها بلهجتك ( اذهب من امامي ) ؟","شي ودك فيه بس ماتتوقع يصير ؟","كيف تعرفت على أقرب أصحابك ؟","تؤمُن بمقولة إنسان ينسيّك انسان ؟","فكرت مره تنتحر 😂😂 ؟","مع او ضد مقولة ( محد يدوم ل احد ) ؟","‏- تقبل بالعودة لشخص كسر قلبك مرتين؟","‏ تكره أحد من قلبك ؟","لو بتغير اسمك ايش بيكون الجديد ؟"," ‏- للإناث | تقدّم إليكِ رجل مليونير لكنه مُقعد، هل تقبلين به؟","تتوقع أصدقائك الحاليين بكل امانه راح يوقفون معك بوقت الشدة ؟","‏- هل سبق ووقعت في حُب الشخص الخطأ ‏","‏هل تعتقد بان اصدقائك الحاليين هم فعلا اصدقاء؟","لو مسموح لك تقتل ثلاث بحياتك مين هم ؟ "," أكثر جملة أثرت بك في حياتك؟ "," لو جاء شخص وعترف لك كيف ترده؟ "," إحساسك في هاللحظة؟ "," عندك شخص تسميه ثالث والدينك؟ ","ما الحاسة التي تريد إضافتها للحواس الخمسة؟ "," اسم قريب لقلبك؟ "," وش الإسم اللي دايم تحطه بالبرامج؟ "," من الناس اللي تتغزل بالكل ولا بالشخص اللي تحبه بس؟ "," نسبه الندم عندك للي وثقت فيهم ؟ "," شكد صارلك بل تام ؟ "," ككم مرة خانوك ؟ "," اخر مرة اتصلت كام وي منو ؟ "," اذا تزوجت شكد ناوي تخلف جهال ؟ "," دخلت وي احد علمود مصلحة ؟ "," ما هي نقاط الضعف في شخصيتك؟ "," أفضل ممارسة بالنسبة لك؟ "," كم أعلى مبلغ جمعته؟ "," انسان م تحب تتعامل معاه ابداً ؟ "," كيف علاقتك مع اهلك؟ رسميات ولا ميانة؟ "," وش الي تفكر فيه الحين؟ "," لو المقصود يقرأ وش بتكتب له؟ "," أطول مدة نمت فيها كم ساعة؟"," انت من الناس المؤدبة ولا نص نص؟ "," عندك اصدقاء غير جنسك؟ "," برأيك كم العمر المناسب للزواج؟ "," عمرك بكيت على شخص مات في مسلسل ؟ "," تتوقع إنك بتتزوج اللي تحبه؟ "," فيه شيء م تقدر تسيطر عليه ؟ "," كيف هي أحوال قلبك؟ "," لو صار سوء فهم بينك وبين شخص هل تحب توضحه ولا تخليه كذا  لان مالك خلق توضح ؟ "," العلاقه السريه دايماً تكون حلوه؟ "," ما أول مشروع تتوقع أن تقوم بإنشائه إذا أصبحت مليونير؟ "," ردّك على شخص قال (أنا بطلع من حياتك)؟. "," أفضل صفة تحبه بنفسك؟ "," ألطف شخص مر عليك بحياتك؟ "," الصداقة ولا الحب؟ "," تتقبل النصيحة من اي شخص؟ "," تنام بـ اي مكان ، ولا بس غرفتك ؟ "," اول طفل الك شنو تسمي ؟ "," شيء جميل صار لك اليوم ؟ ","عادي تتزوج من برا المدينه؟ "," اول ماتصحى من النوم مين تكلمه؟ "," اكتب تاريخ مستحيل تنساه "," وش اسم اول شخص تعرفت عليه فلتام ؟ "," مع او ضد : يسقط جمال المراة بسبب قبح لسانها؟ "," وش حاب تقول للاشخاص اللي بيدخل حياتك؟ "," أطول مكالمة كم ساعة؟","لو خيروك تصير مليونير ولا تتزوج الشخص اللي تحبه؟ "," أفضل وقت للسفر؟ الليل ولا النهار؟ "," لو الشخص اللي تحبه قال بدخل حساباتك بتعطيه ولا تكرشه؟ "," حزنك يبان بملامحك ولا صوتك؟ "," عندك الشخص اللي يكتب لك كلام كثير وانت نايم؟ "," أجمل مدينة؟ ","  اطول علاقة كنت فيها مع شخص؟"," وش نوع جوالك؟ واذا بتغيره وش بتأخذ؟ "," اخر مره بكيت ؟ "," تحب تعبر بالكتابة ولا بالصوت؟ "," شيء مستحيل انك تاكله ؟ "," اذا غلطت وعرفت انك غلطان تحب تعترف ولا تجحد؟ ","  مين اول شخص تكلمه اذا طحت بـ مصيبة ؟ "," أجمل اسم بنت بحرف الباء؟ "," اجمل دولة بنظرك ؟ "," كم مره خانوك ؟ "," عمرك زحفت لشخص ؟ "," منو تتمنى يمك ؟ "," أغلب وقتك تكون وين؟ "," كلمة تقولها للوالدين؟ ","‏- هل تعتقد أن هنالك من يراقبك بشغف؟ "," قد تمنيت شي وتحقق؟ "," تحبني ولاتحب الفلوس؟ "," شيء مستحيل ترفضه ؟. "," تحب الفلوس ؟ "," تحب السفر ؟ "," اخر مكالمة وي منو جانت ؟"," اخر علاقة شوكت انتهت ؟"," ناوي تدخل علاقة ؟ "," معجب بشخص ؟"," تحب من طرف واحد ؟ " );
if($text =="كت" or $text == "تويت"){
$mesho = array_rand($a6, 1);
bot($chatId,['text'=>$a6[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
$a7 = array(": 💔 هـذَآ ﺂࢦـඋَـﺂٱتَـہٛ (  $re_username  ) ﻧَنـزَِࢦنٱآ ﻣٛـטּِ ٱࢦڪٰﯾيَڪٰہٛ صٰٱࢪَ خَٱﯾيَسـٰہَ .");
if($text =="تنزيل كيك" or $text == "خايس"){
$mesho = array_rand($a7, 1);
bot($chatId,['text'=>$a7[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
$a8 = array(": 🤍 هـذَآ ﺂࢦحَـࢦـۅَ (  $re_username ) صُآِإَࢪٖ عٰٖسُل آِإَلڪِٰࢪٖوَٖبٰٖ  🍯.");
if($text =="رفع عسل" or $text == "عسل"){
$mesho = array_rand($a8, 1);
bot($chatId,['text'=>$a8[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
$a9 = array("ُهآِإَڎ آِإَلحٰٖآِإَتِٰ ↠ : ( $re_username ) ڪِٰيڪِٰ آِإَلڪِٰࢪٖوَٖبٰٖ 🍰.");
if($text =="رفع كيك" or $text == "كيك"){
$mesho = array_rand($a9, 1);
bot($chatId,['text'=>$a9[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
$a10 = array(": 💔 هـذَآ ﭑࢦۄصَخَہٛ ( $re_username ) نَٖزل مَِٰنَٖ آِإَلعٰٖسُل يعٰٖعٰٖ ࢪٖوَٖحٰٖ آِإَسُبٰٖحٰٖ🤢 .");
if($text =="تنزيل عسل" or $text == "محمض"){
$mesho = array_rand($a10, 1);
bot($chatId,['text'=>$a10[$mesho],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
} // داخل مجموعه
if(!$lock[$chatId]["replies"]){
if($replies[$chatId]["text"][$text]){
bot($chatId,['text'=>$replies[$chatId]["text"][$text],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($replies[$chatId]["image"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'image','payload'=>['token'=>$replies[$chatId]["image"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($replies[$chatId]["video"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'video','payload'=>['token'=>$replies[$chatId]["video"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($replies[$chatId]["audio"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'audio','payload'=>['token'=>$replies[$chatId]["audio"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
if($replies[$chatId]["sticker"][$text]){
bot($chatId,['text'=>"",'attachments'=>[['type'=>'sticker','payload'=>['code'=>$replies[$chatId]["sticker"][$text]]]],"link"=>["type"=>"reply","mid"=>$message_id]]);
}
}







$lock2 = json_decode(file_get_contents("information_/lock".$update_info.".json"));
$eer = $lock2->$chatId->sticker;
$eer2 = $lock2->$chatId->contact;
$eer3 = $lock2->$chatId->image;
$eer4 = $lock2->$chatId->audio;
$eer5 = $lock2->$chatId->location;
$eer6 = $lock2->$chatId->file;
$eer7 = $lock2->$chatId->video;
$eer8 = $lock2->$chatId->inline_keyboard;
$eer9 = $lock2->$chatId->forward;
$eer10 = $lock2->$chatId->msg;
$eer11 = $lock2->$chatId->spam;





















if(in_array($user_id,$mute[$chatId])){
deleteMessage($message_id);
}
if(!is_special($user_id, $chatId)){



if($message){  
    switch ($eer10) {
        case 'true':
deleteMessage($message_id);
            break;
}}

if($typddse == "sticker"){  
    switch ($eer) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "contact"){  
    switch ($eer2) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "image"){  
    switch ($eer3) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "audio"){  
    switch ($eer4) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "location"){  
    switch ($eer5) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "file"){  
    switch ($eer6) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "video"){  
    switch ($eer7) {
        case 'true':
deleteMessage($message_id);
            break;
}}
if($typddse == "inline_keyboard"){  
    switch ($eer8) {
        case 'true':
deleteMessage($message_id);
            break;
}}
$forward =$message->link->type;
if($forward == "forward"){  
    switch ($eer9) {
        case 'true':
deleteMessage($message_id);
            break;
}}


























    


if(strstr($text ,"@") == true && $lock[$chatId]["username"]){
deleteMessage($message_id);
}
if(strstr($text ,"#") == true && $lock[$chatId]["hashtag"]){
deleteMessage($message_id);
}
if($text && $lock[$chatId]["link"] && (strpos($text,'tt.me') or strpos($text,'telegram.me') or strpos($text,"t.me") or strpos($text,'T.me') or strpos($text,"T.Me") or strpos($text,"T.ME") or strpos($text,'.com') or strpos($text,"Telegram.me") or strpos($text,'://') or strpos($text,'www.') or strpos($text,".org") or strpos($text,'.online') or strpos($text,".net") or strpos($text,'.ml') or strpos($text,'.cf') or strpos($text,"http") or strpos($text,'https') or strpos($text,"HTTP"))!== false){
deleteMessage($message_id);
}
if($is_bot == "true" && $lock[$chatId]["is_bot"]){
deleteMessage($message_id);
}
if(preg_match("/(گواد)|(نيچ)|(كس)|(گس)|(عير)|(گواد)|(كواد)|(كحب)|(گحب)|(قواد)|(طيز)|(فرخ)|(منيو)|(نيج)|(نيق)|(نيك)|(دحب)|(ديس)|(مصه)|(تنح)|(طوبز)|(فروخ)|(واويد)|(مناوي)|(عيور)/",str_replace(['َ','ٕ','ُ','ُ','ِ','ٓ','ٰ','ٖ','ٔ','ْ','ٍ','ٌ','ٌ','ّ','ً','ـ','_','*','.'], null,$text)) && $lock[$chatId]["offense"]){
deleteMessage($message_id);
}
}

if($text && $lock[$chatId]["spam"]){
$plus = mb_strlen("$text");
if($text && 1000 < $plus or $plus < 0 or (strpos($text,'▓▓▓▓') or strpos($text,'●●●●') or strpos($text,"★✯✯★") or strpos($text,'═════') or strpos($text,"8.ꡓ.8.ꡓ.8.") or strpos($text,"鯳闦鱍") or strpos($text,'💣阝') or strpos($text,"鯿鰚📌🔪闪") or strpos($text,'伶〇〇侺') or strpos($text,'ぽぼ💿ぬぱざそ') or strpos($text,"ゑ💊💊ぽぼ") or strpos($text,'伶〇〇侺') or strpos($text,"💀輏陋") or strpos($text,'ぬぱざそ') or strpos($text,'ha: medal :') or strpos($text,"💉💉💉💉💉💉") or strpos($text,'ttݩ.ttݩ.ttݩ') or strpos($text,"鯿鰚📌🔪闪")or strpos($text,"نt.نt.نt.نt."))!== false){
kickChatMember($user_id, $chatId);
deleteMessage($message_id);
bot($chatId,['text'=>"› الاسم :  $name .\n› ارسل فايروس ونطرد بــ👟√"]);
}
}

if($update->message->constructor->username == "whisperbot"){
deleteMessage($message_id);
bot($chatId,['text'=>"عذرا يمكنك استخدام لبوت للهمسة فقط ♡\n› معرف البوت : \nhttps://tt.me/hmsabot ☣️","link"=>["type"=>"reply","mid"=>$message_id]]);
}


//// Dev ///
if(in_array($user_id,$as)){
if($text == "/start"){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' =>'تعيين اسم البوت بالمجموعات', 'payload' =>"Edgbot"]],
[['type' => 'callback', 'text' =>'اذاعه بالخاص', 'payload' =>"cse"],['type' => 'callback', 'text' =>"اذاعه بالمجموعات", 'payload' =>"cse2"]],
[['type' => 'callback', 'text' =>"الاشتراك الاجباري", 'payload' =>"cs"],['type' => 'callback', 'text' =>'الاحصائيات', 'payload' =>"infoM"]],
[['type' => 'callback', 'text' =>'— — — — — — — — —', 'payload' =>"— — — — — — — — —"]],
[['type' => 'callback', 'text' =>'تغير صوره البوت', 'payload' =>"Ediphbot"],['type' => 'callback', 'text' =>"تغير اسم البوت", 'payload' =>"Edinambot"]],
[['type' => 'callback', 'text' =>"تغير يوزر البوت", 'payload' =>"Ediuserbot"],['type' => 'callback', 'text' =>'تغير وصف البوت', 'payload' =>"Edibiobot"]],
];
bobt($user_id,['text' =>"• ★اهلا بك عزيزي المطور .",
"link"=>["type"=>"reply",
"mid"=>$message_id,],
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],
]);
}
if($data == "cle"){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' =>'تعيين اسم البوت بالمجموعات', 'payload' =>"Edgbot"]],
[['type' => 'callback', 'text' =>'اذاعه بالخاص', 'payload' =>"cse"],['type' => 'callback', 'text' =>"اذاعه بالمجموعات", 'payload' =>"cse2"]],
[['type' => 'callback', 'text' =>"الاشتراك الاجباري", 'payload' =>"cs"],['type' => 'callback', 'text' =>'الاحصائيات', 'payload' =>"infoM"]],
[['type' => 'callback', 'text' =>'— — — — — — — — —', 'payload' =>"— — — — — — — — —"]],
[['type' => 'callback', 'text' =>'تغير صوره البوت', 'payload' =>"Ediphbot"],['type' => 'callback', 'text' =>"تغير اسم البوت", 'payload' =>"Edinambot"]],
[['type' => 'callback', 'text' =>"تغير يوزر البوت", 'payload' =>"Ediuserbot"],['type' => 'callback', 'text' =>'تغير وصف البوت', 'payload' =>"Edibiobot"]],
];
edit_value($message_id, $ff,"• اهلا بك عزيزي المطور .");
}
if($data == "infoM"){
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"• احصائيات ( @".$userBot." )\n______\n- عدد الاعضاء :  ".count(explode("\n",file_get_contents("information_/id".$update_info.".txt")))."\n______\n- عدد المجموعات :  ".count($groups["groups"]));
}
$delch = explode('#',$data);
if($delch[0] == "delch"){
unset($Adminset["Channels"][$delch[1]]);
$Adminset["Channels"] = array_values($Adminset["Channels"]);
file_put_contents("information_/Ad".$update_info.".json",json_encode($Adminset,128|32|256));
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,'تم حذف القناه بنجاح');
}
if ($text && $settings[$user_id]["type"] == "csaddChannel" && !$data){
$isb_info = json_decode(file_get_contents('https://botapi.tamtam.chat/me?access_token='.$API_KEY));
$user_idBot = $isb_info->user_id; 
$chats_info = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$text.'?access_token='.$API_KEY));
$getstrpos = json_decode(file_get_contents('https://botapi.tamtam.chat/chats/'.$chats_info->chat_id.'/members?access_token='.$API_KEY.'&user_ids='.$user_idBot));
if($getstrpos->members[0]->is_admin){
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cs']],
];
bobt($user_id,['text' =>"•  تم اضافه قناتك بنجاح",
"link"=>["type"=>"reply",
"mid"=>$message_id,],
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],
]);
$Adminset["Channels"][] = [
'id'=>$chats_info->chat_id,
'title'=>mb_strimwidth($chats_info->title,0, 12, ".."),
"url"=>$chats_info->link
];
file_put_contents("information_/Ad".$update_info.".json",json_encode($Adminset,128|32|256));
$settings[$user_id]["type"] = false;
$settings[$user_id][$user_id] = false;
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
}else{
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cs']],
];
bobt($user_id,['text' =>"• حدث خطأ ما  تأكد من المعروف او من رفعي ادمن في القناة ⚠️",
"link"=>["type"=>"reply",
"mid"=>$message_id],
'attachments' =>[['type' => 'inline_keyboard','payload'=>['buttons'=>$ff,]]],
]);
}
}
if($data == "csaddChannel"){
$settings[$user_id]["type"] = "csaddChannel";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"قم برفع ( @".$usernameBot." ) مشرف بالقناه ثم ارسال معرف القناه مثال\n@zlcom");
}
if($data == "cs"){
ViewChannels($user_id,$message_id);
}
if ($text && $settings[$user_id]["type"] == "cse" && !$data){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• جار الاذاعه الى الخاص 🔆"]);
for($j=0;$j<count(explode("\n",file_get_contents("information_/id".$update_info.".txt"))); $j++){
bobt(explode("\n",file_get_contents("information_/id".$update_info.".txt"))[$j],['text'=>$text]);
}
bobt($user_id,['text' =>"تم الاذاعه 🌿☻..!!"]);
}
if($data == "cse"){
$settings[$user_id]["type"] = "cse";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"• ارسل رسالتك الان .");
}
if ($text && $settings[$user_id]["type"] == "cse2" && !$data){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• يتم الاذاعه بالمجموعات 🇮🇶"]);
for($j=0;$j<count(explode("\n",file_get_contents("information_/id".$update_info.".txt"))); $j++){
bot($groups["groups"][$j],['text'=>$text]);
}
bobt($user_id,['text' =>"تم الاذاعه بنجاح √"]);
}
if($data == "cse2"){
$settings[$user_id]["type"] = "cse2";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => '↞رجوع', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"• ارسل رسالتك الان .");
}
if ($text && $settings[$user_id]["type"] == "Edgbot" && !$data){
unset($settings[$user_id]);
$settings["nbot"] = $text;
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"تم حفظ اسم البوت بنجاح ( $text ) ✅"]);
}
if($data == "Edgbot"){
$settings[$user_id]["type"] = "Edgbot";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => '↞ رجوع', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"• ارسم البوت حاليا هو بأسم ( علوش ) .");
}
if ($text && $settings[$user_id]["type"] == "Edibiobot" && !$data){
edit_bot_info(['description'=>$text]);
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• تم حفض وصف البوت♡( $text ) √"]);
}
if($data == "Edibiobot"){
$settings[$user_id]["type"] = "Edibiobot";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => '↞ رجوع', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"قم بارسال الوصف الجديد للبوت الخاص بك");
}
if ($text && $settings[$user_id]["type"] == "Edinambot" && !$data){
edit_bot_info(['name'=>$text]);
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• تم حفظ اسم البوت √( $text ) "]);
}
if($data == "Edinambot"){
$settings[$user_id]["type"] = "Edinambot";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => ' رجوع', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"• قم بارسال اسم البوت الان .");
}
if($settings[$user_id]["type"] == "Ediuserbot" && !$data){
if(!preg_match('/[^a-zA-Z0-9]/i', $text)){
edit_bot_info(['username'=>$text]);
$url = "https://botapi.tamtam.chat/chats/".$text."?access_token=".API_KEY;
$ob = json_decode(file_get_contents($url));
if($ob->chat_id == null){
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• تم تغيير معرف البوت بنجاح ( $text ) ✅"]);
}else{
bobt($user_id,['text' =>"• عذرا اليوزر مستخدم."]);
}
}else{
bobt($user_id,['text' =>"• عذرا قم بارسال يوزر يحتوي على حروف انكليزيه وارقام فقط ."]);
}
}
if($data == "Ediuserbot"){
$settings[$user_id]["type"] = "Ediuserbot";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"قم بارسال معرف البوت الان");
}
if($settings[$user_id]["type"] == "Ediphbot" && !$data){
if(isset($update->message->body->attachments[0]->payload->token)){
$p_token = $update->message->body->attachments[0]->payload->token;
edit_bot_info(['photo' => ['token' =>$p_token]]);
unset($settings[$user_id]);
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
bobt($user_id,['text' =>"• تم تغير صورة البوت √!"]);
}
}
if($data == "Ediphbot"){
$settings[$user_id]["type"] = "Ediphbot";
file_put_contents("information_/st".$update_info.".json",json_encode($settings,128|32|256));
$ff = [
[['type' => 'callback', 'text' => 'رجوع↞؟', 'payload' => 'cle']],
];
edit_value($message_id, $ff,"قم الان بارسال صوره للبوت.");
}
}




$is_rank = rank($user_id, $chatId);
$linktext = $message->link->message->text;
$forward =$message->link->type;

if(mb_strlen($linktext) >= 1000 and $forward == "forward" and $is_rank == "مميز"){  
    switch ($eer11) {
        case 'true':
deleteMessage($message_id);
kickChatMember($user_id, $chatId);
            break;
}}


if(mb_strlen($linktext) >= 1000 and $forward != "forward" and $is_rank == "مميز"){  
    switch ($eer11) {
        case 'true':
deleteMessage($message_id);
kickChatMember($user_id, $chatId);
            break;
}}





if(mb_strlen($linktext) >= 1000 and $forward == "forward" and $is_rank == "عضو"){  
    switch ($eer11) {
        case 'true':
deleteMessage($message_id);
kickChatMember($user_id, $chatId);
            break;
}}


if(mb_strlen($linktext) >= 1000 and $forward != "forward" and $is_rank == "عضو"){  
    switch ($eer11) {
        case 'true':
deleteMessage($message_id);
kickChatMember($user_id, $chatId);
            break;
}}