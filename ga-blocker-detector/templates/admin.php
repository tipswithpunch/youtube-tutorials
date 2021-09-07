<h1>GA Blocker Detector</h1>
<p>Enter your Google Analytics ID. <a href="https://www.youtube.com/watch?v=dNtciz-7Ips" target="_blank">How to find GA ID?</a></p>

<form method="post" action="options.php">

    <?php
        settings_fields( 'gbdcustomsettings' );
        do_settings_sections( 'gbdcustomsettings' )
    ?>

    <input type="text" id="uaId" name="uaId" placeholder="UA-1087634-1" value="<?php echo sanitize_text_field( get_option( 'uaId' ) ); ?>">
    <input type="submit" value="Save">
    
</form>
