<?php
    // window controller
    // *****************
    $campaign = app('db')->select("SELECT * FROM campaigns where id = $cid and affiliateId = $aid");
    if (!$campaign) {
        echo 'Incorrect API request';
        exit;
    }
    $all_content = file_get_contents(env('STREAMERS_SOURCE', true));
    $content_json = json_decode($all_content, true);
    foreach ($content_json as $member) {
        if (
            // selecting streamer
            isset($member) && isset($member['onlineparams']) &&
            isset(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls']) &&
            json_decode($member['onlineparams'], true)['roomMode'] != 'private' &&
            json_decode($member['onlineparams'], true)['roomMode'] != 'pause' &&
            $member['onlinestatus'] != 'vip' &&
            $member['primarycat'] == $campaign[0]->primaryCategory
        )
        {
            $streamer_name = $member['screenname'];
            $streamer_profile_img = json_decode($member['onlineparams'], true)['publicData']['profilePic'];
            $stream_src = array_values(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls'])[0];
            break;
        };
    };
    // var_dump($member);
    // *****************
?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
        <link rel="stylesheet" type="text/css" href="/assets/main_style.css">
    </head>
    <body>
        <div id="overlay">
            <div class="overlay_online">Online</div>
            <?php echo $streamer_name ?>
        </div>
        <video id="video"></video>
        <script>
            var video = document.getElementById('video');
            var videoSrc = 'https:<?php echo $stream_src ?>';
            if (Hls.isSupported()) {
                var hls = new Hls();
                hls.loadSource(videoSrc);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, function() {
                    video.play();
                });
            }
            else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = videoSrc;
                video.addEventListener('loadedmetadata', function() {
                    video.play();
                });
            }
        </script>
    </body>
</html>



