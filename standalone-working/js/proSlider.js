(function($, document){
	$.fn.proSlider = function() {

		function sliderObj(min, max, step, value, classes, el) {
		    // Basic vars
		    this.min = min;
		    this.max = max;
		    this.step = step;
		    this.value = value;
		    this.classes = classes;
		    this.el = el;
		    this.bulb;
		    
		    // Validate for correct markup
		    if (!this.validate())
				return false;

			// Hide original input[range] and insert line and bulb
		    this.addMarkup();
		    
		    // Set new vars
		    this.width = this.el.prev('.sliderLine').width() - 30;
		    this.slice = this.width / ( (this.max - this.min) / this.step );
		    this.posFromLeft = (((this.value - this.min) / this.step ) * this.slice );
				
		    if (this.value != this.min || this.value != "" || this.value !== undefined)
				this.bulb.css('left', this.posFromLeft );
	
		    // Do the binding
		    this.bindToSelf( this );
		    
		    return true;
		}
		
		sliderObj.prototype.validate = function() {
		    if (this.el.attr('type') != 'range') 
				return false; // Not an input[type=range]
		    if (this.step === 0) 
				return false; // Division by 0
		    if (((this.max - this.min) % this.step) !== 0) 
				return false; // Steps aren't flush
		    if ( this.value > this.max || this.value < this.min )
				return false; // value out of range
				
		    return true;
		};
		    
		sliderObj.prototype.addMarkup = function() {
		    //Add slider markup
		    this.el.hide();
		    this.el.before("<div class='sliderLine " + this.classes + "'><div class='sliderBulb'>"+this.value+"</div></div>");
		    this.bulb = this.el.prev('.sliderLine').children('.sliderBulb');
		};
		
		    
		sliderObj.prototype.bindToSelf = function( self ) { 
		    
		    // Bind the events
		    this.bulb.on('mousedown.PS', function(e) {
		    	var $this 	= $(this),
					$input 	= $this.next('input'),
					startX 	= e.pageX,
					diff 	= 0,
					val 	= 0;
			
				$(document).on("mousemove.PS", function(e){ 
					diff 	= e.pageX - startX;
			    	startX 	= e.pageX;
			    	
			    	self.posFromLeft += diff;
				
					if (self.posFromLeft < 0 || self.posFromLeft > self.width) 
						return;	   
				 
					$this.css('left',self.posFromLeft);
			    
					// Calculate the input value based on bulb position
					val = self.min + (Math.round(self.posFromLeft / self.slice) * self.step);
					$this.text(val);
					$input.val(val);
				
				}); 
				$(document).on('mouseup.PS', function(){
					$(document).off("mousemove.PS");
				});
		    });
		};
	
		    
		return this.each(function() {
			// Create slider object
			var $this = $(this);
		   
			new sliderObj(
		   		parseInt($this.attr('min'), 10),
		   		parseInt($this.attr('max'), 10),
		   		parseInt($this.attr('step'), 10),
		   		parseInt($this.attr('value'), 10),
		   		$this.attr("class").slice(7),
		   		$this
		   	);
		});
	};
})(jQuery, document);