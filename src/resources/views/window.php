<?php
    // window controller
    // *****************
    
    $all_content = file_get_contents(env('STREAMERS_SOURCE', true));
    $content_json = json_decode($all_content, true);
    // var_dump(json_decode($content_json[0]['onlineparams'], true)['modeSpecific']['main']['hls']);
    foreach ($content_json as $member) {
        if (
            isset($member) && isset($member['onlineparams']) &&
            isset(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls'])
        )
        {
            $stream_src = array_values(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls'])[0];
        };
    };
?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    </head>
    <body>
        <video id="video" style="height:100%;width:100%;"></video>
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



