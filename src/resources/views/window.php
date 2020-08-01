<?php 
    $all_content = file_get_contents("-");
    $content_json = json_decode($all_content, true);
    // var_dump(json_decode($content_json[0]['onlineparams'], true)['modeSpecific']['main']['hls']);
    foreach ($content_json as $member) {
        if (
            isset($member) && isset($member['onlineparams']) &&
            isset(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls'])
        )
        {
            $src = array_values(json_decode($member['onlineparams'], true)['modeSpecific']['main']['hls'])[0];
        };
    };
?>

<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/mediaelement@4.2.16/build/mediaelement-and-player.min.js"></script>
    </head>
    <body>
    <video src="https:<?php echo $src;?>" width="320" height="240"
		class="mejs__player"
		data-mejsoptions='{"pluginPath": "/path/to/shims/", "alwaysShowControls": "true"}'></video>

    </body>
</html>



