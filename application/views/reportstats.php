<!doctype html>
<html>
    <head>
        <title>Bug Report Stats</title>
    </head>
    <body>
        <h1>There are <?php echo $total; ?> bug reports.</h1>
        <div style="width: 20%; float: left;">
            <h3>OSes</h3>
            <p>
<?php foreach($os as $name => $count) { ?>
                <?php echo anchor("/report/listing/?os=".urlencode(htmlspecialchars($name)), htmlspecialchars($name)." ($count)"); ?><br>
<?php } ?>
            </p>
        </div>
        <div style="width: 20%; float: left;">
            <h3>Browsers</h3>
            <p>
<?php foreach($browser as $name => $count) { ?>
                <?php echo anchor("/report/listing/?browser=".urlencode(htmlspecialchars($name)), htmlspecialchars($name)." ($count)"); ?><br>
<?php } ?>
            </p>
        </div>
        <div style="width: 20%; float: left;">
            <h3>IP Addresses</h3>
            <p>
<?php foreach($ip as $name => $count) { ?>
                <?php echo anchor("/report/listing/?ip=".urlencode(htmlspecialchars($name)), htmlspecialchars($name)." ($count)"); ?><br>
<?php } ?>
            </p>
        </div>
        <div style="width: 39%; float: left;">
            <h3>Referrers</h3>
            <p>
<?php foreach($referrer as $name => $count) { ?>
                <?php echo anchor("/report/listing/?referrer=".urlencode(htmlspecialchars($name)), htmlspecialchars($name)." ($count)"); ?><br>
<?php } ?>
            </p>
        </div>
    </body>
</html>