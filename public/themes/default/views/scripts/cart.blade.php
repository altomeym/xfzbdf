<?php foreach($carts as $cart){ ?>
<?php
	// this is the query on my side
  // $cart = \App\Models\Cart::with('inventories')->latest()->first();
	// these are vaiables
  $customer_id = $cart->customer_id;
  $item_count = $cart->item_count;
  $quantity = $cart->quantity;
  $total = $cart->total;
  $discount = $cart->discount;
  $shipping = $cart->shipping;
  $packaging = $cart->packaging;
  $handling = $cart->handling;
  $taxes = $cart->taxes;
  $grand_total = $cart->grand_total;
  $coupon_id = $cart->coupon_id;
?>
<script>
  dataLayer = [{
    'customer_id': "{{ $customer_id }}",
    'item_count': "{{ $item_count }}",
    'quantity': "{{ $quantity }}",
    'total': "{{ $total }}",
    'discount': "{{ $discount }}",
    'shipping': "{{ $shipping }}",
    'packaging': "{{ $packaging }}",
    'handling': "{{ $handling }}",
    'taxes': "{{ $taxes }}",
    'grand_total': "{{ $grand_total }}",
    'coupon_id': "{{ $coupon_id }}",
    'inventories': [
      <?php foreach($cart->inventories as $key => $pro): ?>
          {
              cart_id: "{{ $pro->pivot->cart_id }}",
              product_id: "{{ $pro->product_id }}",
              item_description: "{{ $pro->pivot->item_description }}",
              quantity: "{{ $pro->pivot->quantity }}",
              unit_price: "{{ $pro->pivot->unit_price }}",
          },
      <?php endforeach; ?>
    ]
  }];
</script>
<?php } ?>
<script type="text/javascript">
  "use strict";;
  (function($, window, document) {
    $(document).ready(function() {
      // Check if specific cart is given
      var expressId = '{{ $expressId }}';

      if ('' != expressId) {
        apply_busy_filter('body');

        // Scroll screen to target element
        $('#cartId' + expressId)[0].scrollIntoView({
          behavior: 'smooth',
          block: 'start',
          offsetTop: 50
        });

        // Auto Submit the cart If its express checkout
        $("form#formId" + expressId).submit();
      }
    });
  }(window.jQuery, window, document));
</script>
