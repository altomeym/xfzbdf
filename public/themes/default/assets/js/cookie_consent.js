// this is viible when px are greater than or equal to 992px
var topHeaderStrip = document.querySelector('.header__top-inner');
// this is viible when px are greater than or equal to 992px
var stickyHeaderBasedOnItWhenVisible = document.querySelector('.header__navigation');

var stickyHeader = document.querySelector('.header__main');
// alert( stickyHeader.clientHeight);
var contentWrapper1 = document.querySelector('#content-wrapper');

var headerSearch = document.querySelector('.header__search');

window.addEventListener('scroll', function () {
//   headerSearch.style.removeProperty("display");
  if (window.matchMedia('(min-width: 992px)').matches && window.pageYOffset > topHeaderStrip.clientHeight) {
    stickyHeader.classList.add("headerSticky1");
    stickyHeaderBasedOnItWhenVisible.style.marginTop = stickyHeader.clientHeight + "px";
    stickyHeader.classList.add("headerShadow");
  }else if(window.matchMedia('(max-width: 991px)').matches) {
    stickyHeader.classList.add("headerSticky1");
    contentWrapper1.style.paddingTop = stickyHeader.clientHeight + "px";
    if(window.pageYOffset == 0){
      stickyHeader.classList.remove("headerShadow");
    }else{
      stickyHeader.classList.add("headerShadow");
    }
  }else{
    stickyHeader.classList.remove("headerSticky1");
    stickyHeader.classList.remove("headerShadow");
    stickyHeaderBasedOnItWhenVisible.style.marginTop = 0;
    contentWrapper1.style.marginTop = 0;
  }
  // console.log(contentWrapper1.offsetTop);
  // console.log(stickyHeader.clientHeight);
    // if (window.pageYOffset > stickyHeader.offsetTop && stickyHeader.offsetTop != 0) {
        // console.log("992");
        // stickyHeader.classList.add("headerSticky");
        // if(window.matchMedia('(min-width: 992px)').matches){
        //   stickyHeaderBasedOnItWhenVisible.style.marginTop = stickyHeader.clientHeight + "px";
        // }else if(window.matchMedia('(min-width: 768px) and (max-width: 991px)').matches){
        //   contentWrapper1.style.marginTop = stickyHeader.clientHeight + "px";
        // }
        // if(stickyHeaderBasedOnItWhenVisible.style.display !== 'none'){
          // stickyHeaderBasedOnItWhenVisible.style.marginTop = stickyHeader.clientHeight + "px";
        // }else{
        //   console.log(stickyHeader);
        //   contentWrapper1.style.marginTop = stickyHeader.clientHeight + "px";
        // }
    // }else if(window.matchMedia('(min-width: 576px) and (max-width: 991px)').matches) {
        // console.log("768 to 991");
        // if(window.pageYOffset != 0.001){
        //     stickyHeader.classList.add("headerSticky");
        //     contentWrapper1.style.marginTop = stickyHeader.clientHeight+ "px";
        // }else{
        //     stickyHeader.classList.remove("headerSticky");
        //     contentWrapper1.style.marginTop = 0;
        // }
    // }else if(window.matchMedia('(max-width: 575px)').matches && window.pageYOffset != 0) {
    //     // console.log("768 to 991");
    //     // console.log(stickyHeader);
    //     var stickyHeader2 = document.querySelector('.header__logo');
    //     // console.log(stickyHeader2);
    //     stickyHeader.classList.add("headerSticky");
    //     contentWrapper1.style.marginTop = stickyHeader2.clientHeight+ "px";
    // } else {
    //     stickyHeader.classList.remove("headerSticky");
    //     stickyHeaderBasedOnItWhenVisible.style.marginTop = 0;
    //     contentWrapper1.style.marginTop = 0;
    // }
})
