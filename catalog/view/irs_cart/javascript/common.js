// Cart add remove functions
var carttoadd = {
	'addtocart': function(product_id, quantity) {
		if ($('.hide-cart .outofstock a[onclick="cart.add(\'' + product_id + '\');"]').length) {
            return false;
        }
		$.ajax({
			url: 'index.php?route=checkout/cart/add',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					if (!Journal.showNotification(json['success'], json['image'], true)) {
                        $('.alert, .text-danger').remove();

                        $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
					
					if (json['go_to_cart'] && json['text_go_to_cart']) {
						var go_to_cart="carttoadd.checkoutredirect('"+json['product_id']+"');";
						//var html='<a href="'+json['go_to_cart']+'" data-toggle="tooltip" title="'+json['text_go_to_cart']+'" class="btn btn-primary btn-lg btn-block cart-custom-button"><i ></i>'+json['text_go_to_cart']+'</a>';
						var html='<button class="button hint--top cart-custom-button go_to_cart'+product_id+'" type="button" onclick="'+go_to_cart+'"><i ></i> <span class="hidden-xs hidden-sm hidden-md">'+json['text_go_to_cart']+'</span></button>';
						$( '.go_to_cart'+product_id ).replaceWith(html);
					}
					// Need to set timeout otherwise it wont update the total
					setTimeout(function () {
						/*$('#cart-total').html(json['total']);*/
						$('#cart-total').html(json['item-count']);
					}, 100);

					if (Journal.scrollToTop) {
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                    }

					$('#cart  ul').load('index.php?route=common/cart/info ul li');
				}
			},
			
		});
	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
                $('#cart > button > a > span').button('loading');
            },
            complete: function() {
                $('#cart > button > a > span').button('reset');
            },
			success: function(json) {
				if (json['product_id'] && json['minimum']) {
					var buttononclick="carttoadd.addtocart('"+json['product_id']+"', '"+json['minimum']+"');";
					var grid_and_list='<a onclick="'+buttononclick+'" class="button hint--top go_to_cart'+json['product_id']+'" data-hint="'+json['button_cart']+'"><i class="button-left-icon"></i><span class="button-cart-text">'+json['button_cart']+'</span><i class="button-right-icon"></i></a>';
					$( '.go_to_cart'+json['product_id'] ).replaceWith(grid_and_list);
					var product_page='<button type="button" id="button-cart" data-loading-text="'+json['text_loading']+'" class="button product_go_to_cart'+json['product_id']+'"><span class="button-cart-text">'+json['button_cart']+'</span></button>';
					if(json['product_option_value_id']){
						//product_option_value_id
						$('.product_go_to_cart_remove'+json['product_option_value_id']).replaceWith(product_page);
					} else {
						$('.product_go_to_cart'+json['product_id']).replaceWith(product_page);
					}
				}
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
                    /*$('#cart-total').html(json['total']);*/
                    $('#cart-total').html(json['item-count']);
                }, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('#cart ul').load('index.php?route=common/cart/info ul li');
                }
			},
		});
	},
	'checkoutredirect': function(product_id) {
			window.location='index.php?route=checkout/cart';
	}
}
$(document).ready(function() {
	$(document).on("change",".product_option_go_to_cart",function(){
		var product_option_value_id = $(this).val();
		var product_option_id=$(this).attr("product_option_id");
		//var option="option["+product_option_id+"]="+product_option_value_id;
		var product_id=$("input[name='product_id']").val();
		$.ajax({
			url: 'index.php?route=common/go_to_cart/getCartproductoptionid',
			type: 'post',
			data: 'product_id=' + product_id + '&product_option_id='+product_option_id+'&product_option_value_id='+product_option_value_id,
			dataType: 'json',
			success: function(json) {
				if (json['success'] == 1) {
					var html='<a href="'+json['go_to_cart']+'" data-toggle="tooltip" title="'+json['text_go_to_cart']+'" class="button cart-custom-button product_go_to_cart product_go_to_cart_remove'+product_option_value_id+'"><i ></i> '+json['text_go_to_cart']+'</a>';
					$( '.product_go_to_cart' ).replaceWith(html);
					
				} else {
					var product_page='<button type="button" id="button-cart" data-loading-text="'+json['text_loading']+'" class="button product_go_to_cart"><span class="button-cart-text">'+json['button_cart']+'</span></button>';
					$( '.product_go_to_cart' ).replaceWith(product_page);
				}
			}
		});
	});
});

