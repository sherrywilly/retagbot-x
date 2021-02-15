<?php
error_reporting(0);
set_time_limit(0);
date_default_timezone_set('UTC');

require  'vendor/autoload.php';

$username = '';
$password = '';
$x = 1;
$sleep = 30;

$sleepFirst = 1;

$debug = false;
$truncatedDebug = false;




$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);



try {


    $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

    sleep(2);
    if (!$proxyAddress == null) {
        echo "\n[>] Proxy erorr! \n\n";
        $proxy = $ig->setProxy($proxyAddress);
    }
    echo "\n\e[1;33m-Trying To Log in\e[0m\n";
    $login = $ig->login($username, $password);
    echo "\n\e[1;37;42mLogin Success\e[0m\n";
} catch (Exception $e) {
    echo "\n\e[0;31mApprove Checkpoint\e[0m\n";
}

sleep(5);
$x = 'true';

while ($x){

    try {

        $userId = $ig->people->getUserIdForName($username);
        $maxId = null;
        $response = $ig->timeline->getUserFeed($userId, $maxId);
    
    
        foreach ($response->getItems() as $item) {
    
            $id  = $item->getId();
    
            $info = $ig->media->getInfo($id)->getItems();
            $checktag = $info[0]->getUsertags() ? true : false;
    
            $info = json_decode($info[0]);
            echo $info->code;
            if (@$info->caption->text == null) {
                $cap = '';
            } else {
                $cap = $info->caption->text;
            }
    
    
    
    
    
    
    
    
            $in = [
                ['position' => [0.1, 0.1], 'user_id' => $ig->people->getUserIdForName('pappya_gaikwad_official')],
                ['position' => [0.2, 0.2], 'user_id' => $ig->people->getUserIdForName('zaan._.malik')],
                ['position' => [0.3, 0.3], 'user_id' => $ig->people->getUserIdForName('selenagomez')],
                ['position' => [0.4, 0.4], 'user_id' => $ig->people->getUserIdForName('fajis._')],
                ['position' => [0.5, 0.5], 'user_id' => $ig->people->getUserIdForName('Insta_squadron')],
                ['position' => [0.6, 0.6], 'user_id' => $ig->people->getUserIdForName('_ba_s_im_')],
                ['position' => [0.7, 0.7], 'user_id' => $ig->people->getUserIdForName('Gangsters_united_')],
                ['position' => [0.8, 0.8], 'user_id' => $ig->people->getUserIdForName('___manu_micko')],
                // ['position' => [0.9, 0.9], 'user_id' => $ig->people->getUserIdForName('Shuraih._')],
                ['position' => [0.10, 0.10], 'user_id' => $ig->people->getUserIdForName('team_kalimayam')],
                ['position' => [0.11, 0.11], 'user_id' => $ig->people->getUserIdForName('mr_faisu_07')]
            ];
    
    
    
            $remove = [
                $ig->people->getUserIdForName('pappya_gaikwad_official'),
                $ig->people->getUserIdForName('zaan._.malik'),
                $ig->people->getUserIdForName('selenagomez'),
                $ig->people->getUserIdForName('fajis._'),
                $ig->people->getUserIdForName('Insta_squadron'),
                $ig->people->getUserIdForName('_ba_s_im_'),
                $ig->people->getUserIdForName('Gangsters_united_'),
                $ig->people->getUserIdForName('___manu_micko'),
                // $ig->people->getUserIdForName('Shuraih._'),
                $ig->people->getUserIdForName('team_kalimayam'),
                $ig->people->getUserIdForName('mr_faisu_07'),
            ];
    
    
            if ($checktag) {
    
                $tag = $ig->usertag->untagMedia($id, $remove, $cap);
                $tag = json_decode($tag);
                echo  '\n <br> untaging ---- >  ' . $tag->status;
                PHP_EOL;
                sleep(100);
            } else {
     
                $tag = $ig->usertag->tagMedia($id, $in, $cap);
                //tag
                $tag = json_decode($tag);
                echo  '\n <br> taging ---- >  ' . $tag->status;
                PHP_EOL;
                sleep(300);
            }
    
    
    
    
            // break;
        }
    } catch (\Exception $e) {
        echo 'Something went wrong: ' . $e->getMessage() . "\n";
    }
    

}

