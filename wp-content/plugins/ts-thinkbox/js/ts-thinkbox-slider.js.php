<?php
	$effects = array("fade","scrollVert","scrollHorz","zoom","scrollUp","scrollDown","shuffle");
	$duration = 500;
	
	if(isset($_GET['dur'])){
		$duration = (is_numeric($_GET['dur']))? intval($_GET['dur']) : $duration;
	}
?>/*
Plugin Name: TS Thinkbox
Plugin URI: http://www.templatesquare.com/plugin
Description: TS Thinkbox is a wordpress plugin for displaying stylish testimonial etc.
Version: 1.0
Author: templatesquare
Author URI: http://www.templatesquare.com
License: GPL
*/

/*  Copyright 2010  TEMPLATESQUARE  (email : support@templatesquare.com)
	
	This file is part of TS Thinkbox
	
    TS Thinkbox is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// JavaScript Documentvar 
$ = jQuery.noConflict();
$(document).ready(function () {
	
	//define the needed variable
	var dur = <?php echo $duration;?>;
	var currel = 0;
	var conresizable = 1;
	// Don't execute code if it's IE6 or below cause it doesn't support it.
	if ($.browser.msie && $.browser.version < 7) return;
	
	// retrieve all elements dimension
	var heightcontents = new Array();
	var quotecontent = $(".ts-thinkbox-slider-quotecontent");
	quotecontent.each(function(idx,el){
		heightcontents[idx] = el.offsetHeight;
	});
	
	//use jQuery cycle to make the effect
    <?php 
	for($i=0;$i<count($effects);$i++){
		$cycletext = "
		$('.ts-thinkbox-slider-".$effects[$i]."').cycle({
			timeout :0,
			speed : dur,
			startingSlide : 0,
			fx : '".$effects[$i]."',
			containerResize : conresizable
		});
		\n\n";
		echo $cycletext;
	}
	?>
	
	//define the quotecontainer height with first current element
	$("#ts-thinkbox-slider-quotecontainer").css({'height' : heightcontents[currel]+'px'});
	
	//when the thumbslide is clicked
	$(".ts-thinkbox-slider-thumbslide").click(function(){
		var idx = parseInt($(this).attr("title"));
		$("#ts-thinkbox-slider-quotecontainer").cycle(idx);
		$("#ts-thinkbox-slider-quotecontainer").animate({
			'height' : heightcontents[idx]+'px'
		},dur,'linear');
		return false;
	});
	
	$(".ts-thinkbox-slider-thumbcont").walkingPointer({speed : dur});
  
});

// function to make the pointer moving
$ = jQuery.noConflict();
(function($) {
$.fn.walkingPointer = function(o) {
    o = $.extend({ fx: "linear", speed: 500, click: function(){} }, o || {});

    return this.each(function() {
        var me = $(this), noop = function(){},
            $pointer = $('.ts-thinkbox-slider-pointer'),
            $thumbslide = $(".ts-thinkbox-slider-thumbslide", this), curr = $(".tscurrentpointer", this)[0] || $($thumbslide[0]).addClass("tscurrentpointer")[0];
		var unusedLeft = $thumbslide[0].offsetLeft;
		var stcPointer = 7;


        $(this).click(noop);

        $thumbslide.click(function(e) {
			move(this);
			$thumbslide.removeClass("tscurrentpointer");
			$(this).addClass("tscurrentpointer");
			curr = $(this);
            return o.click.apply(this, [e, this]);
        });

        setCurr(curr);

        function setCurr(el) {
			var halfwidth = el.offsetWidth/2;
			halfwidth = parseInt(halfwidth);
			var bgPos = el.offsetLeft + halfwidth - unusedLeft - stcPointer;
            $pointer.css({ 'background-position': bgPos+"px 0px"});
            curr = el;
        };

        function move(el) {
			var halfwidth = el.offsetWidth/2;
			halfwidth = parseInt(halfwidth);
			var bgPos = el.offsetLeft + halfwidth - unusedLeft - stcPointer;
            $pointer.each(function() {
                $(this).dequeue(); }
            ).animate({
                backgroundPosition: bgPos+'px 0px'
            }, o.speed, o.fx);
        };

    });
};
})(jQuery);