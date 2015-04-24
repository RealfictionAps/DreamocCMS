
<div align="center" style="width: 600px;">
<h1 style="margin-left: -50px;">Dreamoc HD3 Configurator</h1>
	<script type="text/javascript">
$(document).ready(function(){
    var form = $('#formdchp'),
        original = form.serialize()

    form.submit(function(){
        window.onbeforeunload = null
    })

    window.onbeforeunload = function(){
        if (form.serialize() != original)
            return 'You have made changes to your settings. Are you sure you want to leave?'
    }
})
</script>
	<?php
	include('hd3-configurator/index.php');
	?>
</div>