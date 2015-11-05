<?php
require_once "UltimateOAuth.php";
session_start();
if (!isset($_SESSION['uo'])) {
      echo '<div class="well">ログインしていません</div>';
      die();
}
$uo = $_SESSION['uo'];
$tweetid = $_GET['tweeturl'];
if (!strpos($tweetid, "/photo/1") === FALSE) {
      $tweetid = substr($str,0,strlen($str)-8);
}
if (!strpos($tweetid, "twitter.com") === FALSE) {
      $endpos = strrpos($tweetid, "/");
      $endpos++;
      $tweetid = substr( $tweetid, $endpos , strlen($tweetid)-$endpos );
}
$response = $uo->get('statuses/show',array('id' => $tweetid));
if (isset($response->extended_entities->media[0]->video_info->variants[0]->url)) {
      for ($i=0; $i < 2; $i++) {
            foreach ($response->extended_entities->media[0]->video_info->variants as $key => $value) {
                  if ($i == 0) {
                        if (isset($value->bitrate)) {
                              $bitrate[] = $value->bitrate;
                        }else{
                              continue;
                        }
                  }else{
                        if (isset($value->bitrate)) {
                              if ($value->bitrate == $max_bitrate) {
                                    $video_url[] = $value->url;
                              }
                        }
                  }
            }
            if ($i == 0) {
                  $max_bitrate = max($bitrate);
            }
      }
      $loop_continue = FALSE;
      foreach ($video_url as $key => $value) {
            if ($loop_continue == FALSE && !strpos($value, "mp4") === FALSE) {
                  echo '<div class="col-sm-4"><div class="thumbnail"><video src="'.$value.'" class="img-responsive" ></video><div class="caption">'.$value.'<p><a href="'.$value.'" class="btn btn-default" role="button">Download</a></p></div></div></div>';
                  $loop_continue = TRUE;
            }
      }
}
 ?>
