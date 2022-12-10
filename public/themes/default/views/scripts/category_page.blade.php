<script>
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
  
    // amony my brands move scrollbar to right
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

    //When ever the modal is shown the below code will execute.
  $(".modal").on("shown.bs.modal", function()  {
    var urlReplace = "#" + $(this).attr('id'); 
    history.pushState(null, null, urlReplace); 
  });

  // This code gets executed when the back button is clicked, hide any/open modals.
  $(window).on('popstate', function() { 
    $(".modal").modal('hide');
  });
  </script>