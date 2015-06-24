$(document).ready(function() {
	/* if DHCP on then disable  */
	$("input[name='ip']").prop('readonly', true).val('192.168.0.2');
	$("input[name='mask']").prop('readonly', true).val('255.255.255.0');
	$("input[name='gateway']").prop('readonly', true).val('192.168.0.1');
	$("input[name='dns']").prop('readonly', true).val('168.95.1.1');
	$("input[name='dns_alt']").prop('readonly', true).val('168.95.1.1');
	
	$('.ipbox input').addClass('disfld');
	
	$("#dhcp_set").click(function(){
	$('.ipbox input').addClass('disfld');
    $("input[name='ip']").prop('readonly', true).val('192.168.0.2');
	$("input[name='mask']").prop('readonly', true).val('255.255.255.0');
	$("input[name='gateway']").prop('readonly', true).val('192.168.14.254');
	$("input[name='dns']").prop('readonly', true).val('168.95.1.1');
	$("input[name='dns_alt']").prop('readonly', true).val('168.95.1.1');
	
	});
	/* if DHCP Off  then Editable  */
	$("#dhcp_set1").click(function(){
	    $('.ipbox input').removeClass('disfld');
		$("input[name='gateway']").prop('readonly', false).val('');
		$("input[name='ip']").prop('readonly', false).val('');
		$("input[name='mask']").prop('readonly', false).val('');
		$("input[name='dns']").prop('readonly', false).val('');
		$("input[name='dns_alt']").prop('readonly', false).val('');
	});
	
	
	  // Tooltip only Text
        $('.masterTooltip').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
		
		
		/*  Auto Time   */
		$("#auto_time_value").addClass('disfld');
		$("#auto_time_value").prop('readonly', true).val('12:30:00');
		$("#auto_time1").click(function(){
			$("#auto_time_value").removeClass('disfld');
			$("#auto_time_value").prop('readonly', false).val('');
	   });
	   $("#auto_time2").click(function(){
			$("#auto_time_value").addClass('disfld');
			$("#auto_time_value").prop('readonly', true).val('12:30:00');
	   });
		/*  ntp_options1  */
		$("#ntp_ip").addClass('disfld');
		$("#ntp_ip").prop('readonly', true).val('204.152.184.72');
		$("#ntp_options2").click(function(){
			$("#ntp_ip").removeClass('disfld');
			$("#ntp_ip").prop('readonly', false).val('');
	   });
	   $("#ntp_options1").click(function(){
			$("#ntp_ip").addClass('disfld');
			$("#ntp_ip").prop('readonly', true).val('204.152.184.72');
	   });
	   
	   /*  autopower_options1  */
		$("#poweron_time").addClass('disfld');
		$("#poweroff_time").addClass('disfld');
		$("#poweron_time").prop('readonly', true).val('07:30:00');
		$("#poweroff_time").prop('readonly', true).val('20:00:00');
		$("#autopower_options1").click(function(){
			$("#poweron_time").removeClass('disfld');
			$("#poweroff_time").removeClass('disfld');
			$("#poweron_time").prop('readonly', false).val('');
			$("#poweroff_time").prop('readonly', false).val('');
	   });
	   $("#autopower_options2").click(function(){
			$("#poweron_time").addClass('disfld');
			$("#poweron_time").prop('readonly', true).val('07:30:00');
			$("#poweroff_time").addClass('disfld');
			$("#poweroff_time").prop('readonly', true).val('20:00:00');
	   }); 
	   
	   /*  spotlight_options1  */
		//$("#manual_step").addClass('disfld');
		//$("#manual_step").prop('readonly', true).val('75');
		$("#spotlight_options2").click(function(){
			$("#manual_step").addClass('disfld');
			$("#manual_step").prop('readonly', true).val('75');
	     });
	    $("#spotlight_options1").click(function(){
			
			$("#manual_step").removeClass('disfld');
			$("#manual_step").prop('readonly', false).val('');
	     });
	

});

function valid_url(urlToValidate){
	var myRegExp =/^(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
	if (!myRegExp.test(urlToValidate)){
		return false;
	}else{
		return true;
	}
}
/* check for numeric */
function IsNumeric(input)
{
    return (input - 0) == input && (''+input).replace(/^\s+|\s+$/g, "").length > 0;
}

/* check for ip address */
 function ValidateIPaddress(txtvalue)  
 {  
	 var ipformat = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/; 
	     ipformat = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/; 
	 if(txtvalue.match(ipformat))  
	 {  
	  //alert("You have entered valid IP address!.");
	   return true;
	 }  
	 else  
	 { 
	   return false;  
	 }  
 }
 /* form submit function */
 function submit_form(){
	ip = $("input[name='ip']").val();
	mask=$("input[name='mask']").val();
	gateway=$("input[name='gateway']").val();
	dns=$("input[name='dns']").val();
	dns_alt=$("input[name='dns_alt']").val();
	
	auto_time_value	=$("input[name='auto_time_value']").val();
	protocol_url	=$("input[name='protocol_url']").val();
	protocol_id		=$("input[name='protocol_id']").val();
	protocol_pw		=$("input[name='protocol_pw']").val();
	protocol_port	=$("input[name='protocol_port']").val();
	protocol_path	=$("input[name='protocol_path']").val();
	ntp_timezone	=$("input[name='ntp_timezone']").val();
	ntp_ip			=$("input[name='ntp_ip']").val();
	poweron_time	=$("input[name='poweron_time']").val();
	poweroff_time	=$("input[name='poweroff_time']").val();
	manual_step		=$("input[name='manual_step']").val();
	volume_setting	=$("input[name='volume_setting']").val();
	
	//msg = 'You have entered an invalid IP address!';
	if($("#dhcp_set").prop('checked')){
	$("input[name='ip']").css('border','1px solid #ccc');
	}
	if($("#dhcp_set1").prop('checked')){
	 if(ip==''){
		//alert('Please enter IP address');
		$("input[name='ip']").css('border','1px solid red');
		$("input[name='ip']").focus();
		return false;
	 } else{
		if(!ValidateIPaddress(ip)){
		 //alert('You have entered an invalid IP address!');  
		 $("input[name='ip']").css('border','1px solid red');
		 $("input[name='ip']").focus();
		 return false;
		}else{
		$("input[name='ip']").css('border','1px solid #ccc');
		}
	 }
	 /* Check Mask Ip Address */
	  if(mask==''){
		//alert('Please enter Mask address');
		$("input[name='mask']").css('border','1px solid red');
		$("input[name='mask']").focus();
		return false;
	 }else{
		 if(!ValidateIPaddress(mask)){
			 //alert('You have entered an invalid Mask address!');  
			 $("input[name='mask']").css('border','1px solid red');
			 $("input[name='mask']").focus();
			 return false;
			}else{
			 $("input[name='mask']").css('border','1px solid #ccc');
			}
	 }
	 /* Check gateway Ip Address */
	if(gateway==''){
		//alert('Please enter Gateway address');
		$("input[name='gateway']").css('border','1px solid red');
		$("input[name='gateway']").focus();
		return false;
	}else{
		 if(!ValidateIPaddress(gateway)){
			 //alert('You have entered an invalid Gateway address!');  
			 $("input[name='gateway']").css('border','1px solid red');
			 $("input[name='gateway']").focus();
			 return false;
			}else{
			 $("input[name='gateway']").css('border','1px solid #ccc');
			}
	}
	 /* Check dns Ip Address */
	 if(dns==''){
		//alert('Please enter Dns address');
		$("input[name='dns']").css('border','1px solid red');
		$("input[name='dns']").focus();
		return false;
	}else{
	 if(!ValidateIPaddress(dns)){
			 //alert('You have entered an invalid DNS address!');  
			 $("input[name='dns']").css('border','1px solid red');
			 $("input[name='dns']").focus();
			 return false;
			}else{
			 $("input[name='dns']").css('border','1px solid #ccc');
			}
	}
	 /* Check dns DNS Alt Address */
	 if(dns_alt==''){
		//alert('Please enter Dns_alt address');
		$("input[name='dns_alt']").css('border','1px solid red');
		$("input[name='dns_alt']").focus();
		return false;
	 } else{
		  if(!ValidateIPaddress(dns_alt)){
				 //alert('You have entered an invalid Dns Alt address!');  
				 $("input[name='dns_alt']").css('border','1px solid red');
				 $("input[name='dns_alt']").focus();
				 return false;
				}else{
				$("input[name='dns_alt']").css('border','1px solid #ccc');
				}
	 }
	}
	/* Check  auto_time_value   Address */
	if(auto_time_value==''){
	  //alert('Please enter Auto Time Value');
	  $("input[name='auto_time_value']").css('border','1px solid red');
	  $("input[name='auto_time_value']").focus();
     return false;
	}else{
		var check = validateTime(auto_time_value);
		if(!check){
			//alert('Please enter correct Time');
			$("input[name='auto_time_value']").css('border','1px solid red');
			$("input[name='auto_time_value']").focus();
			return false;
		}else{
		 $("input[name='auto_time_value']").css('border','1px solid #ccc');
		}
	}
	/* Check  protocol_url   Address */
	if(protocol_url==''){
	  //alert('Please enter Protocol Url');
	  $("input[name='protocol_url']").css('border','1px solid red');
	  $("input[name='protocol_url']").focus();
      return false;
	}else{
	
	  if(valid_url(protocol_url)){
	  $("input[name='protocol_url']").css('border','1px solid #ccc');
	  }else{
	  $("input[name='protocol_url']").css('border','1px solid red');
	  $("input[name='protocol_url']").focus();
	  return false;
	  }
	 
	
	
	}
	/* Check  protocol_port   Address */
	if(protocol_port==''){
	  //alert('Please enter Protocol Port');
	   $("input[name='protocol_port']").css('border','1px solid red');
	   $("input[name='protocol_port']").focus();
      return false;
	}else{
			var check = IsNumeric(protocol_port);
			if(!check){
				//alert('Please enter Numeric value');
				$("input[name='protocol_port']").css('border','1px solid red');
				 $("input[name='protocol_port']").focus();
				return false;
			}else{
				$("input[name='protocol_port']").css('border','1px solid #ccc');
			}
	}
	/* Check  protocol_id   Address */
	 if(protocol_id==''){
	 // alert('Please enter Protocol Id');
	   $("input[name='protocol_id']").css('border','1px solid red');
	    $("input[name='protocol_id']").focus();
      return false;
	}else{
	 $("input[name='protocol_id']").css('border','1px solid #ccc');
	
	}
	/* Check  protocol_pw   Address */
    if(protocol_pw==''){
	  //alert('Please enter Protocol Password');
	  $("input[name='protocol_pw']").css('border','1px solid red');
	  $("input[name='protocol_pw']").focus();
      return false;
	}else{
	$("input[name='protocol_pw']").css('border','1px solid #ccc');
	}
	/* Check  protocol_path   Address */
	 if(protocol_path==''){
	  //alert('Please enter Protocol Path');
	  $("input[name='protocol_path']").css('border','1px solid red');
	  $("input[name='protocol_path']").focus();
      return false;
	}else{
	 $("input[name='protocol_path']").css('border','1px solid #ccc');
	}
	/* Check  ntp_ip   Address */
	if(ntp_ip==''){
	  //alert('Please enter NTP IP');
	  $('#ntp_ip').css('border','1px solid red');
	  $("input[name='ntp_ip']").focus();
      return false;
	}else{
	     if(!ValidateIPaddress(ntp_ip)){
		 //alert('You have entered an invalid NTP IP address!');  
		 $('#ntp_ip').css('border','1px solid red');
		 $("input[name='ntp_ip']").focus();
		 return false;
		}else{
		$('#ntp_ip').css('border','1px solid #ccc');
		}	
	}
	/* Check  ntp_timezone    */
	if(ntp_timezone==''){
	  //alert('Please enter NTP Timezone');
	  $('#ntp_timezone').css('border','1px solid red');
	  $("input[name='ntp_timezone']").focus();
	  
      return false;
	}else{
	  var check = validateHhMm(ntp_timezone);
			if(!check){
				//alert('Please enter correct Time');
				$('#ntp_timezone').css('border','1px solid red');
				$("input[name='ntp_timezone']").focus();
				return false;
			}else{
				$('#ntp_timezone').css('border','1px solid #ccc');
			}	
	}
	/* Check  poweron_time    */
	if(poweron_time==''){
	  //alert('Please enter Power On Time');
	   $('#poweron_time').css('border','1px solid red');
	   $("input[name='poweron_time']").focus();
      return false;
	}else{  
			var check = validateTime(poweron_time);
			if(!check){
				$('#poweron_time').css('border','1px solid red');
				$("input[name='poweron_time']").focus();
				//alert('Please enter correct Time');
				return false;
			}else{
			 $('#poweron_time').css('border','1px solid #ccc');
			 
			}	
	}
	/* Check  poweroff_time    */
	if(poweroff_time==''){
	  //alert('Please enter Power Off Time');
	  $('#poweroff_time').css('border','1px solid red');
	  $("input[name='poweroff_time']").focus();
      return false;
	}else{
			var check = validateTime(poweroff_time);
			if(!check){
				//alert('Please enter correct Time');
				 $('#poweroff_time').css('border','1px solid red');
				 $("input[name='poweroff_time']").focus();
				return false;
			}else{
			 $('#poweroff_time').css('border','1px solid #ccc');
			}	
	}
	/* Check  manual_step    */
	 if(manual_step==''){
	  //alert('Please enter Manual Step');
	  $('#manual_step').css('border','1px solid red');
	  $("input[name='manual_step']").focus();
      return false;
	}else {
			var check = IsNumeric(manual_step);
			if(check){
				if(manual_step>100){
				$('#manual_step').css('border','1px solid red');
				$("input[name='manual_step']").focus();
				 //alert('You can enter 0 to 100');
				 return false;
				}else{
				 $('#manual_step').css('border','1px solid #ccc');
				}
			}else{
				//alert('Please enter Numeric value');
				$('#manual_step').css('border','1px solid red');
				$("input[name='manual_step']").focus();
				return false;
			}
	}
	/* Check  volume_setting    */
	 if(volume_setting==''){
	  //alert('Please enter Volume Setting');
	  $('#volume_setting').css('border','1px solid red');
	  $("input[name='volume_setting']").focus();
      return false;
	}else{
		 var check = IsNumeric(volume_setting);
			if(check){
				if(volume_setting>100){
				 //alert('You can enter 0 to 100');
				 $("input[name='volume_setting']").focus();
				 return false;
				}else{
				 $('#volume_setting').css('border','1px solid #CCCCCC');
				}
			}else{
			 //alert('Please enter Numeric value');
			  $('#volume_setting').css('border','1px solid red');
			  $("input[name='volume_setting']").focus();
				return false;
			}
	}
	return true;
 
 }
 
 /* validation for H:M:I */
 function validateTime(strTime) {
	var regex = new RegExp("([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])");
	if (regex.test(strTime)) {
		return true;
	} else {
		return false;
	}
}

/* validation for H:M */
function validateHhMm(strTime) {
	var regex = new RegExp("([0-1][0-9]|2[0-3]):([0-5][0-9])");
	var match = strTime.match( regex );
	if ( match ) {
	    var hour  = parseInt( match[1] );
	    var min  = parseInt( match[2] );
		 if(hour<=12){
		 if (regex.test(strTime)) {
			 return true;
			} else {
			return false;
			}
		}else {
		 return false;
		}
		if(min==undefined){
		 return false;
		}
	}else{
	  return false;
	}
}