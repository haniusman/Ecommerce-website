/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function() {
	//Change price and stock with size
	$("#selSize").change(function () {
		var idSize = $(this).val();
		$.ajax({
			type: 'get',
			url: '/get-product-price',
			data:{idSize:idSize},
			success:function(resp)
			{
               //alert(resp); return false;
				var arr = resp.split("#");
				$("#getPrice").html("PKR "+arr[0]);
				$("#price").val(arr[0]);
				if(arr[1] == 0)
				{
					$("#cartButton").hide();
					$("#Availability").text("Out Of Stock");
				}else{
                    $("#cartButton").show();
                    $("#Availability").text("In Stock");
                    //$("#getStock").val(arr[1]);
				}
			},error:function(){
				alert("Error");
			}
		});
    });


});

$(document).ready(function() {
    $(".changeImage").click(function () {
       var image = $(this).attr('src');
       $(".mainImage").attr("src",image);
    });

});

