
<?php $weeverapp = new WeeverApp(); ?>
<div class="modal-content" id="preview-app-dialog-webkit"><iframe id="preview-app-dialog-frame" width="320" height="480" rel="<?php echo esc_url( WeeverConst::LIVE_SERVER . '/app/' . $weeverapp->primary_domain ); ?>"></iframe></div>
<div class="modal-content" id="preview-app-dialog-no-webkit">

<strong>Scan This Code</strong> using a QR code reader on a touch-based smart phone to preview your app!

<p><img src="<?php echo $weeverapp->qr_code_private; ?>"  class="wx-qr-imgprev" /></p>

<p>Want to preview your app right from the browser?  Use a WebKit browser such as <a href="http://support.google.com/chrome/bin/answer.py?hl=en&answer=95346">Google Chrome</a> or <a href="http://www.apple.com/safari/">Safari</a></p>
</div>