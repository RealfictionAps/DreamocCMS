<div align="center" style="width: 600px;">
<h1 style="margin-left: -50px;">Dreamoc SD Configurator</h1>
<div style="position:absolute; margin-top: -35px; margin-left: 470px;">
<a style="margin-left: 10px;" class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=hd3conf">?</a>
<script type="text/javascript">
		$(document).ready(function() {
		$("#help").fancybox({
			maxWidth	: 700,
			maxHeight	: 900,
			fitToView	: false,
			width		: '70%',
			height		: '90%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
</script>
</div>

	<script type="text/javascript">
$(document).ready(function(){
    var form = $('#formdchp'),
        original = form.serialize()

    form.submit(function(){
        window.onbeforeunload = null
    })

    window.onbeforeunload = function(){
        if (form.serialize() != original)
            return 'You have made changes to your settings. Are you sure you want to leave? If you leave, your settings will not be stored and your Dreamoc(s) will not be updated.'
    }
})
</script>
	<?php
	include('hd3-configurator/index.php');
	?>
</div>