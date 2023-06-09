<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Riders</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{asset('frontend/images/logo.png')}}" type="image/x-icon" />

  <!-- bootstrap css -->
  <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
  <!-- style css -->
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
  <!-- Responsive-->
  <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
  <!-- fevicon -->
  <link rel="icon" href="{{asset('frontend/images/fevicon.png')}}" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="{{asset('frontend/css/jquery.mCustomScrollbar.min.css')}}">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

  <style>
    .hide_field,
    .major_hide {
      display: none;
    }

    #form .error {
      color: red;
    }

    #product_image {
      height: 200px;
    }
  </style>

</head>
<!-- body -->

<body class="main-layout">
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="{{asset('frontend/images/loading.gif')}}" alt="#" /></div>
  </div>
  <!-- end loader -->
  @include("frontend.layouts.navbar")


  @yield('main-content')



  @include("frontend.layouts.footer")
  <!-- end footer -->
  <!-- Javascript files-->
  <script src="{{asset("frontend/js/jquery.min.js")}}"></script>
  <script src="{{asset("frontend/js/popper.min.js")}}"></script>
  <script src="{{asset("frontend/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{asset("frontend/js/jquery-3.0.0.min.js")}}"></script>
  <!-- sidebar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
  <script src="{{asset("frontend/js/jquery.mCustomScrollbar.concat.min.js")}}"></script>

  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script src="{{asset("frontend/js/jquery-ui.min.js")}}"></script>
  <script src="{{asset("frontend/js/jquery.slicknav.js")}}"></script>
  <script src="{{asset("frontend/js/mixitup.min.js")}}"></script>
  <script src="{{asset("frontend/js/owl.carousel.min.js")}}"></script>

  <script src="{{asset("frontend/js/custom.js")}}"></script>
  <script src="{{asset("frontend/js/cart.js")}}"></script>
  <script>
    $(document).ready(function() {

      date.min = new Date().toISOString().split("T")[0];

      var today = new Date();
      var tomorrow = new Date();
      tomorrow.setDate(today.getDate() - 1);


      $('<style type="text/css"> .ui-datepicker-current { display: none; } </style>').appendTo("head");

      $(document).ready(function() {
        $("#date").datepicker({
          "showButtonPanel": false,

          dateFormat: 'dd-mm-yy',
          minDate: +1
        });
      });




    });
  </script>

  <script>
    $(document).ready(function() {

      $("#normal_price").on("click", function() {
        if ($('#normal_price').is(':checked')) {

          $(".hide_field").slideDown(500);

        } else {
          $(".hide_field").slideUp(500);
        }

      })

      $("#major_price").on("click", function() {
        if ($('#major_price').is(':checked')) {

          $(".major_hide").slideDown(500);

        } else {
          $(".major_hide").slideUp(500);
        }

      })




      $('input[type="radio"]').click(function() {
        $(".check_class").attr("checked", false);
        $(this).attr("checked", true);
      });


      $("#location").on("change", function() {

        let location = $(this).val();

        $.ajax({

          url: "{{url('location_price')}}",
          data: {
            location
          },
          success: function(data) {

            let check_price = $("#check_price").val();
            let total_price = parseInt(check_price) + parseInt(data);
            $("#price").val(data);
            $("#total_price").val(total_price);
          }


        })

      });



      //    validation form code




    })


    $("form").validate({
      rules: {
        // no quoting necessary
        name: "required",
        number: "required",
        date: "required",
        time: "required",
        brand: "required",
        model: "required",
        year: "required",
        normal: "required",
        service: "required",
        location: "required",
        price: "required",
      }
    });
  </script>
  <script>
    //  cart page script start 
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on("click", ".qtybtn", function() {
      var $button = $(this);
      var maxValue = $button.closest("tr").find("#maxVal").val();
      var oldValue = $button.parent().find("input").val();
      if ($button.hasClass("inc")) {
        if (oldValue == maxValue) {
          var newVal = parseFloat(oldValue);
          alert(`You cannot add more than ${newVal}`);
        } else {
          var newVal = parseFloat(oldValue) + 1;
        }

      } else {
        // Don't allow decrementing below zero
        if (oldValue > 1) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 1;
        }
      }
      $button.parent().find("input").val(newVal);
      var updated_qty = $button.parent().find("input").val();
      let val_tr = $(this).parents("tr").attr("data-id");
      $.ajax({
        url: '{{ route("update-cart") }}',
        method: "patch",
        data: {
          _token: '{{ csrf_token() }}',
          id: val_tr,
          quantity: updated_qty
        },
        success: function(response) {
          if (response.data == 1) {
            total = parseInt(response.total);
            $button.parents("tr").children('.shoping__cart__total').html('$' + response.price);
            $("#subTotal").html('$' + total);
            $("#Total").html('$' + total);

          }
        }
      });
    });
    $(document).on("click", "#remove_cart", function(e) {
      e.preventDefault();
      var ele = $(this);
      var rid = ele.parents("tr").attr("data-id");
      if (confirm("Are you sure want to remove?")) {
        $.ajax({
          url: '{{ route("remove-cart") }}',
          method: "DELETE",
          data: {
            _token: '{{ csrf_token() }}',
            id: rid
          },
          success: function(response) {
            if (response.total > 0) {
              ele.parents("tr").hide();
            } else {
              $("#cart_exist").hide();
              $("#empty_cart").show();
              // location.reload();
            }
            $("#counter").html(response.total);
            $("#subTotal").html('$' + response.subTotal);
            $("#Total").html('$' + response.subTotal);
          }
        });
      }
    });
    // cart page script end
  </script>
  @yield('custom_scripts')
</body>

</html>