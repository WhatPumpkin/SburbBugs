<!doctype html>
<html>
    <head>
        <title>Bug Report #<?php echo $id; ?></title>
        <style>.json_string:before, .json_string:after { content: '"'; }</style>
    </head>
    <body>
        <h1><?php echo $ip; ?> at <?php echo htmlspecialchars($referrer); ?> with <?php echo htmlspecialchars($browser); ?> on <?php echo htmlspecialchars($os); ?></h1>
        <img src="<?php echo $canvas; ?>"><br>
        <hr>
        <p><?php echo htmlspecialchars($report); ?></p>
        <hr>
        <p><pre><?php echo htmlspecialchars($save); ?></pre></p>
        <hr>
        <p><?php echo $debugger; ?></p>
    </body>
</html>