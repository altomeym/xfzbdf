@extends('admin.layouts.master')
@section('page-style')
<link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet">
<link href="https://www.jqueryscript.net/demo/Highly-Customizable-jQuery-Toast-Message-Plugin-Toastr/build/toastr.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@endsection
@section('page-script')
{{-- <script src="{{ theme_asset_url('js/cookie_consent.js?v=1.0.004') }}"></script> --}}
<script src="{{ theme_asset_url('js/eislideshow.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script>
  // initilized swal
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  // initial scrolling position
  var $subCatSlider = $('.sub-cat-slider');
  scrollWidth = $subCatSlider.scrollLeft();
  if(scrollWidth > 0){
    $('.sub-cat-scroll .left').removeClass('d-none');
  }

  $('.sub-cat-scroll .left').click(function() {
    event.preventDefault();
    var $subCatSlider=$('.sub-cat-slider');
    $($subCatSlider).animate({
      scrollLeft: "-=140px"
    }, "slow");

    var newScrollLeft = $subCatSlider.scrollLeft(),
    width = $subCatSlider.outerWidth(),
    scrollWidth = $subCatSlider.scrollWidth;
    if (newScrollLeft <= 50) {
      $(this).addClass('d-none')
    }else{
      if($('.sub-cat-scroll .right').hasClass('d-none')){
        $('.sub-cat-scroll .right').removeClass('d-none');
      }
    }
  });

  $('.sub-cat-scroll .right').click(function() {
    // alert(1);
    event.preventDefault();
    var $subCatSlider=$('.sub-cat-slider');
    $($subCatSlider).animate({
      scrollLeft: "+=140px"
    }, "slow");

    var newScrollLeft = $subCatSlider.scrollLeft();
    // console.log(newScrollLeft);
    // console.log("newScrollLeft");
    var width = $subCatSlider.outerWidth();
    // console.log(width);
    // console.log("newScrollLeft");
    var scrollWidth = $subCatSlider.get(0).scrollWidth;
    // console.log(scrollWidth);
    // console.log("newScrollLeft");
    if(scrollWidth - newScrollLeft - parseInt(width) < 50) {
      $(this).addClass('d-none')
    }else{
      if($('.sub-cat-scroll .left').hasClass('d-none')){
        $('.sub-cat-scroll .left').removeClass('d-none');
      }
    }
  });
    
  $("textarea").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
  }).on("input", function () {
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
  });

  $('.focus-edit').click(function() {
    var $target = $(this).parent().find('.textable');
    var _target_val = $target.val();
    $target.val('').focus().val(_target_val);
  });

  $.fn.dataAzAttributeAjax = async function(_this, url, method) {
    var data = {};
    $.each(_this.attributes, function(index, attr) {
      if(attr.name.substr(0,7) == 'data-az'){
        newName = attr.name.replace(/-/g,'_');
        newName = newName.replace(/data_az_/g,'');
        console.log(newName);
        data[newName] = this.value;
      }
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    const ot = await $.ajax({
      url: url,
      type: method,
      dataType: 'json',
      data: data,
      success: function(data) {
        // console.log(data);
        // toastr[data.toastr](data.msg);
      },
      error: function(xhr) {
        // console.log(xhr);
        if (xhr.status == 422) {
          // if input validation failed
          // every input after should have empty div tag <div></div>
        }
      }
    });
    // const json = JSON.stringify(ot);
    return ot;
  };

  $.fn.formAzAjax = async function(thisForm,isRefresh,resetInput) {
    const ot = await $.ajax({
      url: $(thisForm).attr('action'),
      type: $(thisForm).attr('method'),
      dataType: 'json',
      data: new FormData(thisForm),
      processData: false,
      contentType: false,
      success: function(data) {
        // console.log(data);
        // toastr[data.toastr](data.msg);

        if(isRefresh == 'yes'){
          if(data.redirect){
            window.location = data.redirect
          }else{
            location.reload(true);
          }
        }
        if(resetInput){
          resetInputFormId = $(thisForm).attr('id');
          $.each($(resetInputFormId +' :input'),function(){
            if($(thisForm).attr('name') != '_method' && $(thisForm).attr('name') != '_token'){
              $(thisForm).val('');
            }
          });
        }
        // ot = 1;
      },
      error: function(xhr) {
        if (xhr.status == 422) {
          // if input validation failed
          // every input after should have empty div tag <div></div>
          $.each(xhr.responseJSON.errors,function(field_name,error){
            findFiled = $(thisForm).find('[name='+field_name+']');
            var errorELementId = 'ajErrorDiv'+field_name;
            if ($("#"+errorELementId).length > 0){
              $("#"+errorELementId).text(error);
            }else{
              findFiled.after('<div class="text-strong text-danger" id="' +errorELementId+ '">' +error+ '</div>')
            }
            // toastr["error"](error);
            // findFiled.next().html('<div class="text-strong text-danger">' +error+ '</div>')
          })
        }
        // ot = 0;
      }
    });
    // const json = JSON.stringify(ot);
    return ot;
  };

  $.fn.simpleAzAjax = async function(url, method, data = {}) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    const ot = await $.ajax({
      url: url,
      type: method,
      dataType: 'json',
      data: data,
      success: function(data) {
        // console.log(data);
        // toastr[data.toastr](data.msg);
      },
      error: function(xhr) {
        // console.log(xhr);
        if (xhr.status == 422) {
          // if input validation failed
          // every input after should have empty div tag <div></div>
        }
      }
    });
    // const json = JSON.stringify(ot);
    return ot;
  };

  $('#popularLinksSetion').on('click', '.popular-link-trash',function () {
    // alert(1);
    $target = $(this).parent();
    var dataPost = {
      'type': 'popular',
      'index': $target.data('index'),
    };
   
    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        output = $.fn.simpleAzAjax("{{ route('admin.shop-appearance.delete') }}", 'DELETE', dataPost);
        output.then(function(data) {
          toastr[data.toastr](data.message, data.title);
          $("#popularLinksSetion").find('[data-index="'+ $target.data('index') +'"]').remove();///.fadeOut('slow', this.remove);
          $("#popularLinksSetion").children().each(function (index) {
            var $currentElement = $(this);
            console.info($currentElement.data('index'));
            $currentElement.attr('data-index', index);
            console.info($currentElement.data('index'));
          });

        }).catch(e => {
          console.log(e);
          // handle catch
          // $("#loader").addClass("d-none");
          if (e.status == 422) {
            toastr['error']('Please fix the input filed errors', 'Error')
          }else{
            toastr['error']('Something went wrong', 'Error')
          }
        });
      }
    });
  });

  $('#popularLinksModal').on('show.bs.modal', function (event) {
    var target = $(event.relatedTarget).parent();
    $('#popularLinksModal').find('input[name="popular_link_text"]').val(target.data('title'));
    $('#popularLinksModal').find('input[name="popular_link"]').val(target.data('url'));
    $('#popularLinksModal').find('input[name="index"]').val(target.data('index'));
    $('#popularLinksModal').find('input[name="action"]').val(target.data('action'));
  });

  // jquery call
  $('#submitplinks').submit(function(e) {
    // console.log('ad');
    // $("#loader").removeClass("d-none");
    e.preventDefault();
    output = $.fn.formAzAjax(this,'no','no');
    output.then(function(data) {
      newItemHTML = `
          <span href="${data.data.link}" style="border-radius:10px; color:#000; font-weight:bold; padding:5px 10px; margin:0 5px; border:1px solid #000" data-index="${data.data.index}" data-title="${data.data.title}" data-url="${data.data.link}" data-action="${data.data.action}">
            ${data.data.title} <i class="pl-2 fa fa-edit text-success-2 pointer" data-toggle="modal" data-target="#popularLinksModal"></i> <i class="pl-2 fa fa-times text-danger pointer popular-link-trash"></i>
          </span>
        `;
      if(data.data.action == 'edit'){
        $("#popularLinksSetion").find('[data-index="'+data.data.index +'"]').parent().html(newItemHTML);
      }else{
        $("#popularLinksSetion").append(newItemHTML);
      }

      $('#popularLinksModal').modal('hide');
      // handle success
      // $("#loader").addClass("d-none");
      toastr[data.toastr](data.message, data.title)
    }).catch(e => {
      console.log(e);
      // handle catch
      // $("#loader").addClass("d-none");
      // console.log(e.status);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });

  $('#sliderLinksSection').on('click', '.slider-link-trash',function () {
    // alert(1);
    $target = $(this).closest('.subcat-on-cat');
    var dataPost = {
      'type': 'slider',
      'index': $target.data('index'),
    };
   
    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        output = $.fn.simpleAzAjax("{{ route('admin.shop-appearance.delete') }}", 'DELETE', dataPost);
        output.then(function(data) {
          toastr[data.toastr](data.message, data.title);
          $("#sliderLinksSection").find('[data-index="'+ $target.data('index') +'"]').remove();///.fadeOut('slow', this.remove);
          $("#sliderLinksSection").children().each(function (index) {
            if(index != 0 && index != 1){
              newIndex = index - 2;
              console.log(newIndex);
              var $currentElement = $(this);
              $currentElement.attr('data-index', newIndex);
            }
          });

          if($('.subcat-on-cat').length < 8){
            $('#section2-check').addClass('text-grey');
            $('#section2-check').removeClass('text-success-2');
          }
        }).catch(e => {
          console.log(e);
          // handle catch
          // $("#loader").addClass("d-none");
          if (e.status == 422) {
            toastr['error']('Please fix the input filed errors', 'Error')
          }else{
            toastr['error']('Something went wrong', 'Error')
          }
        });
      }
    });
  });

  $('#sliderLinksModal').on('show.bs.modal', function (event) {
    var target = $(event.relatedTarget).closest('.subcat-on-cat');
    $('#sliderLinksModal').find('input[name="slider_link_text"]').val(target.data('title'));
    $('#sliderLinksModal').find('input[name="slider_link"]').val(target.data('url'));
    $('#sliderLinksModal').find('input[name="index"]').val(target.data('index'));
    $('#sliderLinksModal').find('input[name="action"]').val(target.data('action'));
  });

  // jquery call
  $('#submitslinks').submit(function(e) {
    // console.log('ad');
    // $("#loader").removeClass("d-none");
    e.preventDefault();
    output = $.fn.formAzAjax(this,'no','no');
    output.then(function(data) {
      // console.log(data);
      // var newItemHTML = `
      //   <a href="${data.data.link}" class="card mr-1 subcat-on-cat" style="max-height:120px">
      //     <div class="card-body">
      //       <img src="${data.data.image}"height="70px" width="70px">
      //       <span class="d-block mt-2 text-color sub-cat-name">${data.data.title}</span>
      //     </div>
      //   </a>
      // `;
      var newItemHTML = `<a href="#" class="card mr-1 subcat-on-cat" style="max-height:120px" data-index="${data.data.index}" data-title="${data.data.link}" data-url="${data.data.link}" data-action="edit">
        <div class="card-body position-rlative">
          <div class="position-absolute top-0 right-0 p-3">
            <i class="pl-2 fa fa-edit text-success-2 pointer" data-toggle="modal" data-target="#sliderLinksModal"></i>
            <i class="pl-2 fa fa-times text-danger pointer slider-link-trash"></i>
          </div>
          <img src="${data.data.image}" height="70px" width="70px" />
          <span class="d-block mt-2 text-color sub-cat-name">${data.data.title}</span>
        </div>
      </a>`;


      if(data.data.action == 'edit'){
        position = parseInt(data.data.index) + 2;
        $("#sliderLinksSection").find('[data-index="'+ data.data.index +'"]').remove();
        $("#sliderLinksSection").children(`:nth-child(${position})`).after(newItemHTML);
        // $(newItemHTML).insertBefore($("#sliderLinksSection").find('[data-index="'+ position +'"]'));
      }else{
        $secondLast = $('.subcat-add-new').prev();
        $(newItemHTML).insertAfter($secondLast);
        if($('.subcat-on-cat').length < 8){
          var remaining = 8 - $('.subcat-on-cat').length;
          toastr['info'](`You need ${remaining} more items to visible this on your profile`, 'Info')
        }else{
          $('#section2-check').addClass('text-success-2');
          $('#section2-check').removeClass('text-grey');
        }
      }
      
      $('#sliderLinksModal').modal('hide');

      // handle success
      // $("#loader").addClass("d-none");
      toastr[data.toastr](data.message, data.title)
    }).catch(e => {
      console.log(e);
      // handle catch
      // $("#loader").addClass("d-none");
      // console.log(e.status);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });

  // calling dataAzAttributeAjax
  $(".update-shop-appearance").on('change',function(){
    var url = $(this).attr('data-url');
    var value = $(this).val();
    var type = $(this).attr('data-az-type');
    $(this).attr('data-az-value', $(this).val());
    // console.log(url);
    // alert($(this).attr('data-az-value'));
    $output = $.fn.dataAzAttributeAjax(this, url, 'POST');
    $output.then(function(data) {
      if(type == "heading" && value == ''){
        $("#section1-check").addClass("text-grey");
        $("#section1-check").removeClass("text-success-2");
      }else if(type == "heading"){
        $("#section1-check").addClass("text-success-2");
        $("#section1-check").removeClass("text-grey");
      }
     // toastr[data.toastr](data.msg);
      // handle success
      // console.log(data.toastr);
      toastr[data.toastr](data.message, data.title)
      // $("#loader").addClass("d-none");
    }).catch(e => {
      // handle catch
      // console.log(e);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });
  
  $('.load-hot-products').click(function() {
    $('#loadHotProductModal').modal('show');
    $.ajax({
      url: "{{ route('admin.catalog.product.getMoreList') }}",
      type: 'GET',
      processData: false,
      contentType: false,
      success: function(data) {
        // $("#appendingproducts").append('ad');
        product = '';
        var $selected_products = $(".load-hot-products").attr("data-hot-product");
        var arr = $selected_products.split(',');
        // console.log(arr);
        $(data.data).each((index, element) => {
          if(element.inventory){
            if(arr.includes(element.id + '')) {
              isCheckedClass = '';
              // console.log(1);
            }else{
              isCheckedClass = 'd-none';
              // console.log(2);
            }
            product += `
              <div class="pointer hot-product-on-select" style="position:relative; height:80px;" data-id="${element.id}">
                <div class="clearfix" style="width:100%">
                  <div class="pull-left p-2" style="height:80px;width:100px;">
                    ${element.image}
                  </div>
                  <div class="pull-left pl-2 pt-2 fw-bold">
                    ${element.name}
                  </div>
                  <div class="pull-right" style="right:10px; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                    <i class="fa fa-2x fa-check-circle text-success-2 ${isCheckedClass}"></i>
                  </div>
                </div>
              </div>
              <hr class="m-1"/>
            `;
          }
        });
        $("#appendingproducts2").html(product);
        // console.log(data);
      },
      error: function(xhr) {
        // console.log(xhr);
      }
    });
  });

  $('#loadHotProductModal').on('click', '.hot-product-on-select',function() {
    var $selected_products = $(".load-hot-products").attr("data-hot-product");
    var arr = $selected_products.split(',');
    var array = $.grep(arr, function(n){ return (n); });
    var product_id = $(this).attr('data-id');
    var $target = $(this).find('.fa-check-circle');
    // if($target.hasClass('d-none')){
      // if(array.length >= 1){
        $('.hot-product-on-select').find('.fa-check-circle').addClass('d-none');
        array = [product_id];
        // toastr['info']('You can\'t select more items', 'Info')
        // return false;
      // }
      $target.removeClass('d-none');
      // array.remove(product_id);
      // array.push(product_id);
    // }else{
    //   $target.addClass('d-none');
    //   array = $.grep(array, function(value) {
    //     return value != product_id;
    //   });
    // }
    // console.log(array);
    var arrString = array.join(",");
    // console.log(arrString);
    $(".load-hot-products").attr("data-hot-product", arrString);
    
  });

  $('#saveHotProductId').on('click',function() {
    var selected_products = $(".load-hot-products").attr("data-hot-product");
    var dataPost = {
      'type': 'hot',
      'hot_product': selected_products,
    };
    
    $output = $.fn.simpleAzAjax("{{ route('admin.shop-appearance.save') }}", 'POST', dataPost);
    $output.then(function(data) {
      // alert(1);
      // console.log(data.additional);
      // data.additional.images
      // data.additional.name
      // data.additional.min_price
      // data.additional.max_price
      // data.additional.description
      images = '';
      $(data.additional.images).each((index, element) => {
        // console.log(element.path);
        images += `<div class="week-deal__slider-item slick-slide slick-active" data-slick-index="0" aria-hidden="true" style="width: 280px;" tabindex="-1" role="tabpanel" id="slick-slide00" aria-describedby="slick-slide-control00">
          <img src="{{url('/image')}}/${element.path}?p=medium" />
        </div>`;
      });
      $("#images").html(images);
      $("#name").html(data.additional.inventory.title);
      // $("#description").text(data.additional.description.substring(0,10));
      text = $("#description").html(data.additional.description).text();
      $("#description").text(text.substring(0,72) + '...');

      if(data.additional.inventory){
        offer = Number(data.additional.inventory.offer_price).toFixed("{{ config('system_settings.decimals', 2) }}");
        price = Number(data.additional.inventory.sale_price).toFixed("{{ config('system_settings.decimals', 2) }}");//new Date(offer_end)
        if(offer > 0 && offer != price && new Date(data.additional.inventory.offer_start) <= new Date() && new Date(data.additional.inventory.offer_end) >= new Date()){
          hasOffer = '';
        }else{
          hasOffer = 'd-none';
        }
        offer = "{{ get_system_currency() }}" + offer;
        price = "{{ get_system_currency() }}" + price;
      }else{
        offer = price = '';
        hasOffer = 'd-none';
      }

      $("#min_price").html(offer);
      $("#max_price").html(price);
      $("#max_price").addClass(hasOffer);
      toastr[data.toastr](data.message, data.title)
      $("#loadHotProductModal").modal('hide');

      $.fn.section4Check();
      // $("#loader").addClass("d-none");
    }).catch(e => {
      // handle catch
      console.log(e);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });

  $('.load-featured-products').click(function() {
    $('#loadFeaturedProductModal').modal('show');
    $.ajax({
      url: "{{ route('admin.catalog.product.getMoreList') }}",
      type: 'GET',
      processData: false,
      contentType: false,
      success: function(data) {
        // $("#appendingproducts").append('ad');
        product = '';
        var $selected_products = $(".load-featured-products").attr("data-featured-products");
        var arr = $selected_products.split(',');
        // console.log(arr);
        $(data.data).each((index, element) => {
          if(arr.includes(element.id + '')) {
            isCheckedClass = '';
            // console.log(1);
          }else{
            isCheckedClass = 'd-none';
            // console.log(2);
          }
          // console.log(element);
          if(element.inventory){
            product += `
              <div class="pointer product-on-select" style="position:relative; height:80px;" data-id="${element.id}">
                <div class="clearfix" style="width:100%">
                  <div class="pull-left p-2" style="height:80px;width:100px;">
                    ${element.image}
                  </div>
                  <div class="pull-left pl-2 pt-2 fw-bold">
                    ${element.name}
                  </div>
                  <div class="pull-right" style="right:10px; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                    <i class="fa fa-2x fa-check-circle text-success-2 ${isCheckedClass}"></i>
                  </div>
                </div>
              </div>
              <hr class="m-1"/>
            `;
          }
        });
        $("#appendingproducts").html(product);
        // console.log(data);
      },
      error: function(xhr) {
        // console.log(xhr);
      }
    });
  });

  $('#loadFeaturedProductModal').on('click', '.product-on-select',function() {
    var $selected_products = $(".load-featured-products").attr("data-featured-products");
    var arr = $selected_products.split(',');
    var array = $.grep(arr, function(n){ return (n); });

    var product_id = $(this).attr('data-id');
    var $target = $(this).find('.fa-check-circle');
    if($target.hasClass('d-none')){
      if(array.length >= 4){
        toastr['info']('You can\'t select more items', 'Info')
        return false;
      }
      $target.removeClass('d-none');
      // array.remove(product_id);
      array.push(product_id);
    }else{
      $target.addClass('d-none');
      array = $.grep(array, function(value) {
        return value != product_id;
      });
    }
    // console.log(array);
    var arrString = array.join(",");
    // console.log(arrString);
    $(".load-featured-products").attr("data-featured-products", arrString);
    
  });

  $('#saveFeaturedProductsIds').on('click',function() {
    var selected_products = $(".load-featured-products").attr("data-featured-products");
    var dataPost = {
      'type': 'feature',
      'featured_products': selected_products,
    };
    
    $output = $.fn.simpleAzAjax("{{ route('admin.shop-appearance.save') }}", 'POST', dataPost);
    $output.then(function(data) {
      // alert(1);
      // console.log(data.additional);
      html = '';
      // $offer = get_formated_price($item->current_sale_price(), config('system_settings.decimals', 2));
      // $price = get_formated_price($item->sale_price, config('system_settings.decimals', 2));

      $(data.additional).each((index, element) => {
        offer = price = '';
        hasOffer = 'd-none';
        if(element.inventory){
          // console.log(element.images);
          image = '';
          $(element.images).each((index, image_) => {
            // console.log(element.path);
            image = `{{url('/image')}}/${image_.path}?p=small`;
            console.log(image);
          });
        
          offer = Number(element.inventory.offer_price).toFixed("{{ config('system_settings.decimals', 2) }}");
          price = Number(element.inventory.sale_price).toFixed("{{ config('system_settings.decimals', 2) }}");//new Date(offer_end)
          if(offer > 0 && offer != price && new Date(element.inventory.offer_start) <= new Date() && new Date(element.inventory.offer_end) >= new Date()){
            hasOffer = '';
          }else{
            hasOffer = 'd-none';
          }
          offer = "{{ get_system_currency() }}" + offer;
          price = "{{ get_system_currency() }}" + price;
    
          html += `<div class="best-seller__item">
            <div class="best-seller__item-inner">
              <div class="best-seller__item-image">
                <a href="#" tabindex="0">
                  <img src="${image}" data-name="product_image">
                </a>
              </div>
              <div class="best-seller__item-details">
                <div class="best-seller__item-details-inner">
                  <div class="best-seller__item-name">
                    <a href="#" tabindex="0">${element.inventory.title}</a>
                  </div>
                  <div class="best-seller__item-rating">
                    <a href="javascript:void(0)" tabindex="0">
                      <i class="fa fa-star"></i>
                    </a>
                    <a href="javascript:void(0)" tabindex="0">
                      <i class="fa fa-star"></i>
                    </a>
                    <a href="javascript:void(0)" tabindex="0">
                      <i class="fa fa-star"></i>
                    </a>
                    <a href="javascript:void(0)" tabindex="0">
                      <i class="fa fa-star"></i>
                    </a>
                    <a href="javascript:void(0)" tabindex="0">
                      <i class="fa fa-star"></i>
                    </a>
                  </div>
                  <div class="best-seller__item-price">
                    <p class="feature__items-price-new box-price-new">
                      ${offer}
                    </p>
                    <p class="feature__items-price-old box-price-old ${hasOffer}">
                      ${price}
                    </p>
                  </div>
                  <div class="best-seller__item-utility">
                    <a class="button product-link itemQuickView" href="#" tabindex="0">
                      <i class="fal fa-search-plus"></i>
                    </a>
                    <a href="javascript:void(0)" data-link="#" class="button add-to-wishlist" style="" tabindex="0">
                      <i class="fal fa-heart"></i>
                    </a>
                    <a data-link="#" class="button button--cart sc-add-to-cart" style="cursor: pointer;" tabindex="0">
                      <i class="fal fa-shopping-cart"></i>
                      Add to Cart
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>`;

        }
      });
      
      $('#selected-featured-items').html(html);
      toastr[data.toastr](data.message, data.title)

      $("#loadFeaturedProductModal").modal('hide');
      $.fn.section4Check();
      // $("#loader").addClass("d-none");
    }).catch(e => {
      // handle catch
      console.log(e);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });

  $.fn.section4Check = async function() {
    var selected_products = $(".load-hot-products").attr("data-hot-product");
    var $selected_products = $(".load-featured-products").attr("data-featured-products");
    var arr = $selected_products.split(',');
    var array = $.grep(arr, function(n){ return (n); });
    if(array.length >= 4 && selected_products){
      $('#section4-check').addClass('text-success-2');
      $('#section4-check').removeClass('text-grey');
    }else{
      $('#section4-check').addClass('text-grey');
      $('#section4-check').removeClass('text-success-2');
    }
  };
  
  //
  $('.mediaclick').on('click',function() {
    type = $(this).attr('data-type');
    $(".mediaclick").removeClass('text-success-2');
    $(this).addClass('text-success-2');
    if(type == 'image'){
      $("#mediaUploadVideo").addClass('d-none');
      $("#mediaUploadImage").removeClass('d-none');
    }else{
      $("#mediaUploadVideo").removeClass('d-none');
      $("#mediaUploadImage").addClass('d-none');
    }
  });

  // jquery call
  $('#saveMedia').submit(function(e) {
    // console.log('ad');
    // $("#loader").removeClass("d-none");
    e.preventDefault();
    output = $.fn.formAzAjax(this,'no','no');
    output.then(function(data) {
      console.log(data);
      $('#section3MediaModal').modal('hide');
      // handle success
      // $("#loader").addClass("d-none");
      toastr[data.toastr](data.message, data.title)
    }).catch(e => {
      console.log(e);
      // handle catch
      // $("#loader").addClass("d-none");
      // console.log(e.status);
      // $("#loader").addClass("d-none");
      if (e.status == 422) {
        toastr['error']('Please fix the input filed errors', 'Error')
      }else{
        toastr['error']('Something went wrong', 'Error')
      }
    });
  });
</script>

@endsection

@section('content')
  <div class="box-">
    <div class="box-header with-border-">
      {{-- <h3 class="box-title">{{ trans('app.shop_appearance') }}</h3> --}}
    </div> <!-- /.box-header -->
    <div class="box-body p-0">
      <?php //print_r(auth()->user()->toArray()); ?>

      {{-- Add popular links modal --}}
      <div class="modal fade" id="popularLinksModal" tabindex="-1" role="dialog" aria-labelledby="popularLinksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="popularLinksModalLabel">
                {!! trans('app.popular_links') !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </h5>
            </div>
            <div class="modal-body">
              <form id="submitplinks" action="{{ route('admin.shop-appearance.save') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="popular" />
                <input type="hidden" name="action" />
                <input type="hidden" name="index" />
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{!! trans('app.text') !!}</label>
                  <input type="text" class="form-control" name="popular_link_text">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{!! trans('app.link') !!}</label>
                  <input type="text" class="form-control" name="popular_link" placeholder="{{ url('/') }}">
                  <small>{!! trans('app.only_company_links_are_allowed', ['company' => config('company.name')]) !!}</small>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('app.close') !!}</button>
              <button type="submit" class="btn btn-primary" form="submitplinks">{!! trans('app.save') !!}</button>
            </div>
          </div>
        </div>
      </div>

      {{-- Add slider links modal --}}
      <div class="modal fade" id="sliderLinksModal" tabindex="-1" role="dialog" aria-labelledby="sliderLinksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sliderLinksModalLabel">
                {!! trans('app.slider_links') !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </h5>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route' => ['admin.shop-appearance.save'], 'files' => true, 'id' => 'submitslinks']) !!}
                <input type="hidden" name="type" value="slider" />
                <input type="hidden" name="action" />
                <input type="hidden" name="index" />
                <div class="form-group">
                  <label class="col-form-label">{!! trans('app.link') !!}</label>
                  <input type="text" class="form-control" name="slider_link_text">
                </div>
                <div class="form-group">
                  <label class="col-form-label">{!! trans('app.link') !!}</label>
                  <input type="file" name="slider_link_image" style="color:#000000" />
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{!! trans('app.link') !!}</label>
                  <input type="text" class="form-control" name="slider_link" placeholder="{{ url('/') }}">
                  <small>{!! trans('app.only_company_links_are_allowed', ['company' => config('company.name')]) !!}</small>
                </div>
              {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('app.close') !!}</button>
              <button type="submit" class="btn btn-primary" form="submitslinks">{!! trans('app.save') !!}</button>
            </div>
          </div>
        </div>
      </div>

      {{-- Load hot Products modal --}}
      <div class="modal fade" id="loadHotProductModal" tabindex="-1" role="dialog" aria-labelledby="loadFeaturedProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loadHotProductModalLabel">
                {!! trans('app.hot_product') !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </h5>
            </div>
            <div class="modal-body">
              <div id="appendingproducts2"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('app.close') !!}</button>
              <button type="submit" class="btn btn-primary"id="saveHotProductId">{!! trans('app.save') !!}</button>
            </div>
          </div>
        </div>
      </div>

      {{-- Load featured Products modal --}}
      <div class="modal fade" id="loadFeaturedProductModal" tabindex="-1" role="dialog" aria-labelledby="loadFeaturedProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loadFeaturedProductModalLabel">
                {!! trans('app.featured_products') !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </h5>
              
            </div>
            <div class="modal-body">
              <div id="appendingproducts"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('app.close') !!}</button>
              <button type="submit" class="btn btn-primary"id="saveFeaturedProductsIds">{!! trans('app.save') !!}</button>
            </div>
          </div>
        </div>
      </div>

      {{-- Secton 3 Midea modal --}}
      <div class="modal fade" id="section3MediaModal" tabindex="-1" role="dialog" aria-labelledby="section3MediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="section3MediaModalLabel">
                {!! trans('app.media_selection') !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </h5>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="w-100 fw-bold text-center mb-3">{!! trans('app.please_select_image_or_video') !!}</div>
                  <div class="d-inline mr-2 p-2 pointer mediaclick" data-type="image">
                    <i class="fa fa-5x fa-image"></i>
                  </div>
                  <div class="d-inline p-2 pointer mediaclick" data-type="video">
                    <i class="fa fa-5x fa-video-camera"></i>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-12 col-md-6">
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.shop-appearance.save'], 'files' => true, 'id' => 'saveMedia']) !!}
                      @csrf
                      <input type="hiden" name="type" value="banners" />
                      <div class="form-group d-none" id="mediaUploadImage">
                        <label for="recipient-name" class="col-form-label">{!! trans('app.select_image') !!}</label>
                        <input class="form-control" type="file" name="image" />
                      </div>
                      <div class="form-group d-none" id="mediaUploadVideo">
                        <label for="recipient-name" class="col-form-label">{!! trans('app.youtube_video_url') !!}</label>
                        <input type="text" class="form-control" name="video" placeholder="https://youtube.com">
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('app.close') !!}</button>
              <button type="submit" class="btn btn-primary" form="saveMedia">{!! trans('app.save') !!}</button>
            </div>
          </div>
        </div>
      </div>

      {{-- @desktop
        @include('admin.shop_appearance.partials.slider')
      @elsedesktop
        @include('admin.shop_appearance.partials.mobile-slider')
      @enddesktop --}}
      <section class="mb-3">
        <div id="ei-slider" class="ad-ei-slider container p-0"><div class="ei-slider-loading" style="display: none;">{!! trans('app.loading') !!}</div>
          <ul class="ei-slider-large">
            <li style="opacity: 1; z-index: 2;" style="position:relative;">
              <img src="https://tiejet.com/image/images/gZjrWPO8iteQX0ghgPfSD6vr18JmIQMDnfILxPdw.jpg?p=full" alt="Website visitors into customer" style="width: 1260px; height: 432.469px; margin-left: 0px; margin-top: -81.2344px;">
              <i class="fa fa-2x fa-check-circle {{ $shop_appearance && $shop_appearance->heading_text ? 'text-success-2' : 'text-grey' }}" id="section1-check" style="position:absolute; top:10px; right:10px;"></i>
              <div class="mx-2 mx-md-5 ad-slider-content">
                <div class="header__search ml-md-2 my-1">
                  <div class="ad-find-perfect fw-bold mb-3">
                    {!! trans('app.find_the_perfect') !!}
                    <i>
                      <input type="text" value="{{ $shop_appearance && $shop_appearance->heading_text ? $shop_appearance->heading_text : 'freelancer' }}" class="textable update-shop-appearance" onkeypress="this.style.width = (((this.value.length + 1) * 8) + 100) + 'px';" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="heading" style="width:180px;"/></i>
                      <i class="fa fa-edit focus-edit text-success-2" style="color:#00000; top:5px; right:10px; cursor:pointer;"></i>
                      {!! trans('app.services_for_your_business') !!}
                  </div>
                  <div class="search-box">
                    <div class="search-box__input">
                      <input placeholder="{{ trans('theme.main_searchbox_placeholder') }}" type="text" readonly>
                    </div>
                    <div class="search-box__button">
                      <button type="submit" class="navbar-search-submit" onclick="document.getElementById('search-categories-form').submit()">
                        <i class="fal fa-search"></i>
                      </button>
                    </div>
                  </div>
                  <!-- Tanding Keywords under the search box starts -->    
                  <div class="hot-words mt-3">
                    <strong>{!! trans('app.popular') !!}:</strong>
                    <div class="d-inline" id="popularLinksSetion">
                      @if($shop_appearance && $shop_appearance->popular_links)
                        @foreach($shop_appearance->popular_links as $index => $popular)
                          <span href="#" class="pp-links" data-index="{{ $index }}" data-title="{{ @$popular['title'] }}" data-url="{{ @$popular['link'] }}" data-action="edit">
                            {{ @$popular['title'] }} <i class="pl-2 fa fa-edit text-success-2 pointer" data-toggle="modal" data-target="#popularLinksModal"></i> <i class="pl-2 fa fa-times text-danger pointer popular-link-trash"></i>
                          </span>
                        @endforeach
                      @endif
                    </div>
                    <a class="mx-2 d-inline pointer" data-action="add" data-toggle="modal" data-target="#popularLinksModal" style="border-radius:10px; color:#000; font-weight:bold; padding:5px 10px; border:1px solid #000">
                      <i class="fa fa-plus"></i>
                    </a>
                  </div>
                  <!--test Ends-->
                </div>
              </div>
            </li>
          </ul><!-- ei-slider-large -->
        </div>
      </section>

      <!-- Featured category stat -->
      <section class="mt-1 mb-0 translX0 container">
        <div class="row mb-2 sub-cat-scroll position-relative">
          @if($shop_appearance && $shop_appearance->slider_links && count($shop_appearance->slider_links) > 6)
            <i class="fa fa-2x fa-check-circle text-success-2" id="section2-check" style="position:absolute; top:0px; right:0px; z-index:999"></i>
          @else
            <i class="fa fa-2x fa-check-circle text-grey" id="section2-check" style="position:absolute; top:0px; right:0px; z-index:999"></i>
          @endif
          <div class="col-12 px-3 sub-cat-slider d-flex" id="sliderLinksSection">
            <span class="left d-none pointer">
              <span class="svg-qv icon-chevron" aria-hidden="true">
                  <svg width="8" height="15" viewBox="0 0 8 15" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.2279 0.690653L7.84662 1.30934C7.99306 1.45578 7.99306 1.69322 7.84662 1.83968L2.19978 7.5L7.84662 13.1603C7.99306 13.3067 7.99306 13.5442 7.84662 13.6907L7.2279 14.3094C7.08147 14.4558 6.84403 14.4558 6.69756 14.3094L0.153374 7.76518C0.00693607 7.61875 0.00693607 7.38131 0.153374 7.23484L6.69756 0.690653C6.84403 0.544184 7.08147 0.544184 7.2279 0.690653Z"></path>
                  </svg>
              </span>
            </span>
            <span class="right d-none d-md-block pointer">
              <span class="svg-qv icon-chevron" aria-hidden="true">
                <svg width="8" height="16" viewBox="0 0 8 16" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.772126 1.19065L0.153407 1.80934C0.00696973 1.95578 0.00696973 2.19322 0.153407 2.33969L5.80025 8L0.153407 13.6603C0.00696973 13.8067 0.00696973 14.0442 0.153407 14.1907L0.772126 14.8094C0.918563 14.9558 1.156 14.9558 1.30247 14.8094L7.84666 8.26519C7.99309 8.11875 7.99309 7.88131 7.84666 7.73484L1.30247 1.19065C1.156 1.04419 0.918563 1.04419 0.772126 1.19065Z"></path>
                </svg>
              </span>
            </span>
            
            @if($shop_appearance && $shop_appearance->slider_links)
              @foreach($shop_appearance->slider_links as $indexSlider => $slider)
                <a href="#" class="card mr-1 subcat-on-cat" style="max-height:120px" data-index="{{ $indexSlider }}" data-title="{{ @$slider['title'] }}" data-url="{{ @$slider['link'] }}" data-action="edit">
                  <div class="card-body position-rlative">
                    <div class="position-absolute top-0 right-0 p-3">
                      <i class="pl-2 fa fa-edit text-success-2 pointer" data-toggle="modal" data-target="#sliderLinksModal"></i>
                      <i class="pl-2 fa fa-times text-danger pointer slider-link-trash"></i>
                    </div>
                    <img src="{{ @$slider['image'] }}" height="70px" width="70px">
                    <span class="d-block mt-2 text-color sub-cat-name">{{ @$slider['title'] }}</span>
                  </div>
                </a>
              @endforeach
            @endif
            
            <span class="card mr-1 subcat-add-new subcat-on-cat pointer" style="max-height:120px" data-action="add">
              <div class="card-body" data-toggle="modal" data-target="#sliderLinksModal">
                <i class="fa fa-2x fa-plus" style="padding:20px 50px; font-size:40px; height:70px; width:70px"></i>
                <span class="d-block mt-2 text-color sub-cat-name">{!! trans('app.add_new') !!}</span>
              </div>
            </span>
          </div>
        </div>
      </section>

      {{-- bussiness highlights --}}
      <section class="position-relative">
        {{-- <div class="" style="background-color:#fff; padding:3px 6px; position:absolute; top:10px; right:10px; z-index:10;">
          <i class="fa fa-5x fa-check-circle text-success-2" id="section2-check"></i>
        </div> --}}
        <div class="shell-banner-">
          <div class="container mb-4 py-3 px-5" style="background-color:rgb(17, 17, 109);">
            <div class="shell-banner__inner-">
              <div class="row">
                  <div class="col-lg-6 col-12 my-2 px-2">
                    <div class="image-banner- ">
                      <div class="shell-banner__box- ">
                        <div class="shell-banner__img-">
                          <div class="my-4" style="position:relative">
                            <i class="fa fa-edit focus-edit SHDF"></i>
                            <textarea type="text" class="t1 textable update-shop-appearance" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="info_heading">{{ $shop_appearance && $shop_appearance->info_section_heading ? $shop_appearance->info_section_heading : 'A business solution designed for teams' }}</textarea>
                          </div>
                          <div class="my-4" style="position:relative">
                            <i class="fa fa-edit focus-edit SHDF"></i>
                            <textarea type="text" class="t2 textable update-shop-appearance" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="info_paragraph">{{ $shop_appearance && $shop_appearance->info_section_paragraph ? $shop_appearance->info_section_paragraph : 'Upgrade to a curated experience packed with tools and benefits, dedicated to businesses' }}</textarea>
                          </div>
                          {{-- {{ $shop_appearance && $shop_appearance->heading_text ? $shop_appearance->heading_text : 'freelancer' }} --}}
                          
                          @php
                            $point1 = $point2 = $point3 = 'Connect to freelancers with proven business experience';
                            if($shop_appearance && $shop_appearance->info_section_bullets){
                              $bullet_points = $shop_appearance->info_section_bullets;
                              if(isset($bullet_points[0]) && $bullet_points[0] != ''){
                                $point1 = $bullet_points[0];
                              }

                              if(isset($bullet_points[1]) && $bullet_points[1] != ''){
                                $point2 = $bullet_points[1];
                              }
                              
                              if(isset($bullet_points[2]) && $bullet_points[2] != ''){
                                $point3 = $bullet_points[2];
                              }
                            }
                          @endphp
                          <div class="my-2 clearfix" style="position:relative">
                            <i class="fa fa-edit focus-edit" id="SGD3"></i>
                            <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                            <textarea type="text" class="pull-left t3 textable update-shop-appearance" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="info_bullets" data-az-bullet="1">{{ $point1 }}</textarea>
                          </div>
                          <div class="my-2 clearfix position-relative">
                            <i class="fa fa-edit focus-edit" id="SGD2"></i>
                            <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                            <textarea type="text" class="pull-left t3 textable update-shop-appearance" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="info_bullets" data-az-bullet="2">{{ $point2 }}</textarea>
                          </div>
                          <div class="my-2 clearfix" style="position:relative">
                            <i class="fa fa-edit focus-edit" id="SGD"></i>
                            <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                            <textarea type="text" class="pull-left t3 textable update-shop-appearance" data-url="{{ route('admin.shop-appearance.save') }}" data-az-type="info_bullets" data-az-bullet="3">{{ $point3 }}</textarea>
                          </div>
                        </div>
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6 col-12 my-2 px-2">
                    <div class="image-banner pt-1">
                      <div class="shell-banner__box position-relative">
                        <div class="shell-banner__img">
                          @php $match; @endphp
                          @if($shop_appearance && preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $shop_appearance->info_section_banners, $match))
                            <iframe width="200" src="https://www.youtube.com/embed/{{$match[4]}}" style="height:300px">
                            </iframe>
                          @elseif($shop_appearance && $shop_appearance->info_section_banners)
                            <img src="{{ $shop_appearance->info_section_banners }}" alt="Banner Image" title="Banner Image" height="200px"/>
                          @else
                            <img src="https://tiejet.com/image/images/R4OYuN8rydUrmwKlnbXzD6sLs2OnrVO11Mnz6frw.png?p=full">
                          @endif
                        </div>
                        <a id="fg-ico" data-toggle="modal" data-target="#section3MediaModal">
                          <i class="fa fa-2x fa-picture-o"></i>
                        </a>
                      </div>                  
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Deal of Day start -->
      <section class="position-relative">
        @php
          $section4_check = 'text-grey';
          if($shop_appearance && $shop_appearance->featured_products){
            if(count($shop_appearance->featured_products) >= 4 && $shop_appearance->hot_product){
              $section4_check = 'text-success-2';
            }
          }
        @endphp
        <i class="fa fa-2x fa-check-circle {{ $section4_check }}" id="section4-check"></i>
        <div class="best-deal">
          <div class="container">
            <div class="best-deal__inner">
              <div class="row">
                <div class="col-lg-8">
                  <div class="best-deal__col">
                    <div class="best-deal__header">
                      <div class="sell-header">
                        <div class="sell-header__title">
                          <h2>{!! trans('app.deal_of_the_day') !!}</h2>
                        </div>
                        <div class="header-line">
                          <span></span>
                        </div>
                      </div>
                    </div>
                    @php
                      $name = '';
                      $images = [];
                      $min_price = '';
                      $max_price = '';
                      $description = '';

                      if($shop_appearance && $shop_appearance->hot_product){
                        $hot_product = \App\Models\Product::with(['inventory','images'])->where('id', $shop_appearance->hot_product)->first();
                        if($hot_product){
                          $name = $hot_product->inventory->title;
                          $images = $hot_product->images;
                          $offer = get_formated_price($hot_product->inventory->current_sale_price(), config('system_settings.decimals', 2));
                          $price = get_formated_price($hot_product->inventory->sale_price, config('system_settings.decimals', 2));
                          // $min_price = get_formated_price($hot_product->inventory->min_price, config('system_settings.decimals', 2));
                          // $max_price = get_formated_price($hot_product->inventory->max_price, config('system_settings.decimals', 2));
                          $description = $hot_product->description;
                        }
                      }
                    @endphp
                    <div class="week-deal">
                      <i class="fa fa-edit load-hot-products text-success-2" data-hot-product="{{ $shop_appearance && $shop_appearance->hot_product ? $shop_appearance->hot_product : '' }}" style="position:absolute; top:2px; right:2px; cursor:pointer; z-index:9"></i>
                      <div class="week-deal__label">{!! trans('app.hot') !!}</div>
                      <div class="week-deal__inner">
                        @if($shop_appearance && $shop_appearance->hot_product)
                        <div class="week-deal__slidhot_product->er deal-slider slick-initialized slick-slider slick-dotted">
                          <div class="slick-list draggable">
                            <div class="slick-track" id="images">
                              @foreach($images as $image)
                              <div class="week-deal__slider-item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" style="width: 280px;" tabindex="-1">
                                <img src="{{ url("image/$image->path") }}?p=medium">
                              </div>
                              @endforeach
                            </div>
                          </div>
                          <ul class="slick-dots" style="" role="tablist">
                            {{-- <li class="slick-active" role="presentation">
                              <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00" aria-label="1 of 4" tabindex="-1">1</button>
                            </li>--}}
                          </ul>
                        </div>
                        <div class="week-deal__details">
                          <div class="week-deal__details-name h2" id="name">
                            {{ $name }}
                          </div>  
                          <div class="week-deal__details-price">
                            <p>
                              <span class="regular-price" id="min_price">
                                {!! $offer !!}
                              </span>
                              
                              <span class="old-price @if($offer != $price && $shop_appearance->inventory && !$shop_appearance->inventory->hasOffer()) d-none @endif " id="max_price">
                                {!! $price !!}
                              </span>
                            </p>
                          </div>
                          <div class="week-deal__details-description" id="description">
                            {!! \Str::limit($description, 200) !!}
                          </div>
                          <div class="week-deal__details-list">
                            {{-- <ul>
                              <li><i class="fal fa-check"></i> <span>You get: 1 Logo Design</span></li>
                              <li><i class="fal fa-check"></i> <span>Estimated Delivery Time: 24 Hours</span></li>
                              <li><i class="fal fa-check"></i> <span>Delivery includes: Source File (AI EPS, Vector, PS)</span></li>
                            </ul> --}}
                          </div>
                          <div class="week-deal-btns mt-4">
                            <span class="sc-add-to-cart px-4 py-2- -py-md-3 pointer" tabindex="0">
                              <i class="fa fa-shopping-cart"></i>
                              <span class="d-none d-sm-inline-block">{!! trans('app.add_to_card') !!}</span>
                            </span>  
                            <span data-link="#" class="add-to-wishlist px-4 py-2- -py-md-3 pointer">
                              <i class="fa fa-heart"></i> {!! trans('app.add_to_wishlist') !!}
                            </span>
                          </div>
                        </div>
                        @else
                          <div class="week-deal__slidhot_product->er deal-slider slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                              <div class="slick-track" id="images">
                              </div>
                            </div>
                            <ul class="slick-dots" style="" role="tablist">
                            </ul>
                          </div>
                          <div class="week-deal__details">
                            <div class="week-deal__details-name" id="name">
                            </div>  
                            <div class="week-deal__details-price">
                              <p>
                                <span class="regular-price" id="min_price">
                                </span>
                                <span class="old-price" id="max_price">
                                </span>
                              </p>
                            </div>
                            <div class="week-deal__details-description" id="description">
                              <div>{!! trans('app.you_have_not_selected_the_hot_prdocut') !!}</div>
                            </div>
                            <div class="week-deal__details-list">
                            </div>
                            <div class="week-deal-btns mt-4">
                              <span data-link="#" class="sc-add-to-cart pointer sp-4" tabindex="0">
                              </span>  
                              <span href="#" data-link="#" class="add-to-wishlist p-4" style="">
                              </span>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="best-deal__col">
                    <div class="best-deal__header">
                      <div class="sell-header">
                        <div class="sell-header__title">
                          <h2>{!! trans('app.featured') !!}</h2>
                        </div>
                        <div class="header-line">
                          <span></span>
                        </div>
                        {{-- <div class="best-deal__arrow">
                          <ul>
                            <li>
                              <button class="left-arrow slider-arrow best-seller-left slick-arrow" style="">
                                <i class="fal fa-chevron-left"></i>
                              </button>
                            </li>
                            <li>
                              <button class="right-arrow slider-arrow best-seller-right slick-arrow" style="">
                                <i class="fal fa-chevron-right"></i>
                              </button>
                            </li>
                          </ul>
                        </div> --}}
                      </div>
                    </div>
                    <div class="best-seller bs">
                      @php
                        if($shop_appearance && $shop_appearance->featured_products){
                          $featured = implode(',',$shop_appearance->featured_products);
                          $featured_items = \App\Models\Product::with(['inventory',
                              'inventory.avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                              'inventory.images:path,imageable_id,imageable_type'
                            ])->whereIn('id', $shop_appearance->featured_products)->get();

                          $featured_items = $featured_items->pluck('inventory');
                          // print_r($featured_items);
                        }else{
                          $featured = '';
                          $featured_items = [];
                        }
                      @endphp
                      <i class="fa fa-edit load-featured-products text-success-2" data-featured-products="{{ $featured }}" style="position:absolute; top:-8px; right:10px; cursor:pointer; z-index:9"></i>
                      <div class="best-seller__slider best-seller-slider slick-initialized slick-slider">
                        <div class="slick-list -draggable">
                          <div class="slick-track" style="opacity: 1; width: 1950px; transform: translate3d(-350px, 0px, 0px);">
                            <div class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" style="width: 350px;" tabindex="-1">
                            </div>
                            <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 390px;" tabindex="0">
                              <div id="selected-featured-items">
                                @foreach($featured_items as $item)
                                  @if($item)
                                    @php
                                      $image = get_inventory_img_src($item, 'small');
                                      $offer = get_formated_price($item->current_sale_price(), config('system_settings.decimals', 2));
                                      $price = get_formated_price($item->sale_price, config('system_settings.decimals', 2));
                                    @endphp
                                    <div class="best-seller__item">
                                      <div class="best-seller__item-inner">
                                        <div class="best-seller__item-image">
                                          <a href="#" tabindex="0">
                                            <img src="{{ $image }}" data-name="product_image">
                                          </a>
                                        </div>
                                        <div class="best-seller__item-details">
                                          <div class="best-seller__item-details-inner">
                                            <div class="best-seller__item-name">
                                              <a href="#" tabindex="0">{!! \Str::limit($item->title, 80) !!}</a>
                                            </div>
                                            {{-- <div class="best-seller__item-rating">
                                              <a href="javascript:void(0)" tabindex="0">
                                                <i class="fa fa-star"></i>
                                              </a>
                                              <a href="javascript:void(0)" tabindex="0">
                                                <i class="fa fa-star"></i>
                                              </a>
                                              <a href="javascript:void(0)" tabindex="0">
                                                <i class="fa fa-star"></i>
                                              </a>
                                              <a href="javascript:void(0)" tabindex="0">
                                                <i class="fa fa-star"></i>
                                              </a>
                                              <a href="javascript:void(0)" tabindex="0">
                                                <i class="fa fa-star"></i>
                                              </a>
                                            </div> --}}
                                            <div class="best-seller__item-price">
                                              <p class="feature__items-price-new box-price-new">
                                                {{ $offer }}
                                              </p>
                                              @if ($item->hasOffer())
                                                <p class="feature__items-price-old box-price-old">
                                                  {{ $price }}
                                                </p>
                                              @endif
                                            </div>
                                            <div class="best-seller__item-utility">
                                              <a class="button product-link itemQuickView" href="#" tabindex="0">
                                                <i class="fa fa-search-plus"></i>
                                              </a>
                                              <a href="#" data-link="#" class="button add-to-wishlist" style="" tabindex="0">
                                                <i class="fa fa-heart"></i>
                                              </a>
                                              <a data-link="#" class="button button--cart sc-add-to-cart" style="cursor: pointer;" tabindex="0">
                                                <i class="fa fa-shopping-cart"></i>
                                                {!! trans('app.add_to_card') !!}
                                              </a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                @endforeach
                                @if(!$featured_items)
                                  <div>{!! trans('app.you_have_not_selected_the_featured_prdocut') !!}</div>
                                @endif
                              </div>
                            </div>
                          </div>
                        <div>
                      </div>
                    <div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

@endsection
