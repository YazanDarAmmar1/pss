var mq = window.matchMedia("(max-width: 1000px)");
var isMobile = mq.matches;
var isArabic = document.querySelector('body').classList.contains('lang-ar');

var marginFromLeft = getPageLeftMargin();
// AOS.init({disable: 'mobile',duration: 1000});

document.addEventListener("DOMContentLoaded", function() {
  
  sliders();

  modals();

  toggleClass();

  toggleTabs();

  accordions();

  initVideoJS();

  init__photoSwipe(); // gallery

  styling();

  initMobileNumber();
  stickyHeader();
  selectFields()

  // #custom
  togglePasswordInput()
  verificationCode()
  goUp()


  forms()

  cartTable()

  share()

  tooltip()

  amountsBox()

  copy()

  filtersProfile()

});

function getPageLeftMargin() {
  var header = document.querySelector('header.header');
  if (header) {
    var computedContainerStyle = getComputedStyle(header);
    var headerHeight = computedContainerStyle.getPropertyValue('height');
    document.documentElement.style.setProperty('--header-height', `${headerHeight}`);
  }
  var container = document.querySelector('.container');
  if (container) {
    var computedContainerStyle = window.getComputedStyle(container);
    
    paddingFromLeft = computedContainerStyle.getPropertyValue('margin-left');
    const paddingoffset = parseFloat(paddingFromLeft.replace('px', ''));
    document.documentElement.style.setProperty('--container-offset-normal', `${paddingoffset}px`);
    document.documentElement.style.setProperty('--container-offset-negative', `${-paddingoffset}px`);
    return computedContainerStyle.getPropertyValue('margin-left')
  }
  
  

  return 0;
}

function sliders() {
  var dynamicSliders = document.querySelectorAll('[dynamic-slider]');
  if (dynamicSliders.length > 0) {
    dynamicSliders.forEach(function (slider) {
      const slides = slider.querySelectorAll('.swiper-slide');
      if (slides.length === 0) {
        return;
      }
      var root = slider.closest('[slider-section]');
      var id = generateID();
      var options = {
        slidesPerView: 1,
        spaceBetween: 0,
      };
  
      // # ARROWS
      var arrowLeft = root.querySelector('[arrow-left]');
      var arrowRight = root.querySelector('[arrow-right]');
  
      if (arrowLeft) {
        arrowLeft.id = `left_arr_${id}`;
        arrowRight.id = `right_arr_${id}`;
  
        options.navigation = {
          nextEl: `#left_arr_${id}`,
          prevEl: `#right_arr_${id}`,
        };
      }
  
      // # PAGINATION
      var customPagination = root.querySelector(".swiper-custom-pagination");
  
      if (customPagination) {
        options.pagination = {
          el: customPagination,
          clickable: true,
        };
      }

      // # spaceBetween
      var spaceBetween = slider.getAttribute('space-between');
      if (spaceBetween) {
        options.spaceBetween = +spaceBetween;
      }
  
      // # per view
      var perViewAttribute = slider.getAttribute('per-view');
      if (perViewAttribute) {
        options.slidesPerView = +perViewAttribute;
      }

      // # fade
      var fadeAttribute = slider.getAttribute('fade');
      if (fadeAttribute === 'true') {
        options.effect = 'fade';
      }
      var isCentered = slider.getAttribute('is-centered');
      if (isCentered != undefined) {
        options.centeredSlides = true;
      }

      var dynamicBullets = slider.getAttribute('dynamic-bullets');
      if (dynamicBullets) {
        options.pagination = {
          el: customPagination,
          dynamicBullets: true,
          clickable: true,
        };
      }
  
      // # breakpoints
      var responsiveAttribute = slider.getAttribute('responsive');
  
      if (responsiveAttribute) {
        var breakpoints = JSON.parse("[" + responsiveAttribute + "]");
        var grid = slider.getAttribute('grid');
        var breakpointsConfig = {};
        breakpoints.forEach(function (breakpoint, index) {
          var perView = breakpoint[0];
          var spaceBetween = breakpoint[1];
          
          var info = {
            slidesPerView: perView,
            spaceBetween: spaceBetween,
          };
  
          if (index === 0) {
            if (grid) {
              info.grid = {
                rows: grid[0],
              }
            };
            breakpointsConfig[320] = info;
          }
          if (index === 1) {
            if (grid) {
              info.grid = {
                rows: grid[1],
              }
            };
            breakpointsConfig[800] = info;
          }
          if (index === 2) {
            if (grid) {
              info.grid = {
                rows: grid[2],
              }
            };
            breakpointsConfig[1100] = info;
          }
        });

        // #disable on
        var currentWindowWidth = window.innerWidth;
        if (breakpoints[0][0] == 0 && currentWindowWidth < 800) {
          return 
        }
  
        options.breakpoints = breakpointsConfig;
      }

      var slidesPerGroup = slider.getAttribute('slides-per-group');
      if (slidesPerGroup) {
        var groupValues = slidesPerGroup.split(',').map(Number);
        options.breakpoints = options.breakpoints || {};

        options.breakpoints[320] = {
          ...(options.breakpoints[320] || {}),
          slidesPerGroup: groupValues[0] || 1, // Mobile
        };
        options.breakpoints[800] = {
          ...(options.breakpoints[800] || {}),
          slidesPerGroup: groupValues[1] || groupValues[0] || 1, // Tablet
        };
        options.breakpoints[1100] = {
          ...(options.breakpoints[1100] || {}),
          slidesPerGroup: groupValues[2] || groupValues[1] || groupValues[0] || 1, // Desktop
        };
      }
  
      // # loop
      var loopAttribute = slider.getAttribute('loop');
      if (loopAttribute) {
        options.loop = true;
      }
  
      // # autoplay
      var autoplayAttribute = slider.getAttribute('auto-play');
      if (autoplayAttribute) {
        options.autoplay = {
          delay: +autoplayAttribute,
          disableOnInteraction: false,
        };
      }
  
      var swiper = new Swiper(slider, options);
    });
  }

  var matchSlidesHeight = document.querySelectorAll('[equal-height]');
  if (matchSlidesHeight) {
    matchSlidesHeight.forEach(function (element) {
      var tallestSlideHeight = 0;
    
      element.querySelectorAll('.swiper-slide').forEach(function (slide) {
        var slideHeight = slide.offsetHeight;
    
        if (slideHeight > tallestSlideHeight) {
          tallestSlideHeight = slideHeight;
        }
      });
    
      element.querySelectorAll('.swiper-slide').forEach(function (slide) {
        slide.style.height = tallestSlideHeight + 'px';
      });
    });

  }

  if (document.querySelector('[banner]')) {
    $('[banner]').each(function(){
      $(this).slick({
        variableWidth: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 8000,
        pauseOnHover: false,
        cssEase: 'linear'
      });
    })
  }
}

function openModal(modal) {
  document.querySelector('[modal-name="' + modal + '"]').classList.add('active', 'transition-in');
  document.body.classList.add('overflow-hidden');

  if (!document.body.hasAttribute('opened-modal') || document.body.getAttribute('opened-modal') === '') {
    document.body.setAttribute('opened-modal', modal);
  } else if (!document.body.getAttribute('opened-modal').includes(modal)) {
    document.body.setAttribute('opened-modal', document.body.getAttribute('opened-modal') + ',' + modal);
  }
}

function closeModal(modal) {
  var modalElement = document.querySelector('[modal-name="' + modal + '"]');

  if (modalElement) {
    modalElement.classList.remove('active');

    if (modalElement.hasAttribute('has-video')) {
      modalElement.querySelector('[target]').innerHTML = '';
    }
  }

  var openedModals = (document.body.getAttribute('opened-modal') || '').split(',');
  var remainingModals = openedModals.filter(function(m) {
    return m !== modal;
  });

  document.body.setAttribute('opened-modal', remainingModals.join());

  if (remainingModals.length === 0) {
    document.body.classList.remove('overflow-hidden');
  }
}

function modals() {
  // close modal
  document.body.addEventListener("click", function (event) {
    var closeModalButton = event.target.closest("[close-modal]");
    if (closeModalButton) {
      var modal = closeModalButton.getAttribute('close-modal');
      closeModal(modal);
    }
  });

  // open modal
  document.body.addEventListener("click", function (event) {
    var openModalButton = event.target.closest("[open-modal]");
    if (openModalButton) {
      var modal = openModalButton.getAttribute('open-modal');
      openModal(modal);
    }
  });
}

function generateID(){
  return "id" + Math.random().toString(16).slice(2)
}

function accordions() {
  document.querySelectorAll('[acc-head]').forEach(function (accHead) {
    accHead.addEventListener('click', function () {
      accHead.closest('[accordion-item]').classList.toggle('active');
      accHead.nextElementSibling.display = 'block';
    });
  });
}

function init__photoSwipe() {
  // <div class="swiper-wrapper" photo-swipe-root>
  //   <img class="object-fit pointer" photo-swipe img-src="https://robohash.org/1" width="100%" src="https://robohash.org/1" height="389" />
  // </div>
  // <!-- #photo swipe template -->
  //     <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  //       <div class="pswp__bg"></div>
  //       <div class="pswp__scroll-wrap">
  //           <div class="pswp__container">
  //               <div class="pswp__item"></div>
  //               <div class="pswp__item"></div>
  //               <div class="pswp__item"></div>
  //           </div>
  //           <div class="pswp__ui pswp__ui--hidden">
  //               <div class="pswp__top-bar">
  //                   <div class="pswp__counter"></div>
  //                   <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
  //                   <button class="pswp__button pswp__button--share" title="Share"></button>
  //                   <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
  //                   <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
  //                   <div class="pswp__preloader">
  //                       <div class="pswp__preloader__icn">
  //                           <div class="pswp__preloader__cut">
  //                               <div class="pswp__preloader__donut"></div>
  //                           </div>
  //                       </div>
  //                   </div>
  //               </div>
  //               <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
  //                   <div class="pswp__share-tooltip"></div>
  //               </div>
  //               <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
  //               </button>
  //               <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
  //               </button>
  //               <div class="pswp__caption">
  //                   <div class="pswp__caption__center"></div>
  //               </div>
  //           </div>
  //       </div>
  //     </div>
  //     <!-- ##photo swipe template -->
  if (document.querySelector('[photo-swipe]')) {
    function initPhotoSwipe(images, startIndex) {
      var pswpElement = document.querySelector('.pswp');
    
      var psImages = images.map(function (img) {
        var videoSrc = img.getAttribute('data-video');
        if (videoSrc) {
          return {
            html: `<video class="pswp-video" controls width="100%"><source src="${videoSrc}" type="video/mp4"></video>`,
          };
        }
        return {
          src: img.getAttribute('img-src'),
          w: 1,
          h: 1,
        };
      });
    
      var options = { index: startIndex };
    
      var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, psImages, options);
    
      // Add class to body when PhotoSwipe opens
      gallery.listen('initialZoomIn', function () {
        document.body.classList.add('pswp-open');
        handleVideoPlayback(gallery);
      });
    
      // Remove class when PhotoSwipe closes
      gallery.listen('close', function () {
        document.body.classList.remove('pswp-open');
        stopAllVideos(); // Stop all videos when closing
      });
    
      // Listen for slide changes to handle video playback
      gallery.listen('afterChange', function () {
        handleVideoPlayback(gallery);
      });
    
      // Ensure images get correct dimensions
      gallery.listen('gettingData', function (index, item) {
        if (!item.html && (item.w < 3 || item.h < 3)) {
          var img = new Image();
          img.onload = function () {
            item.w = this.width;
            item.h = this.height;
            gallery.invalidateCurrItems();
            gallery.updateSize(true);
          };
          img.src = item.src;
        }
      });
    
      gallery.init();
    }
    
    // Handle click event on [photo-swipe] elements
    function handlePhotoSwipeClick(event) {
      var root = event.target.closest('[photo-swipe-root]');
    
      if (root) {
        var images = root.querySelectorAll('[photo-swipe]');
        var clickedImageIndex = Array.from(images).indexOf(event.target);
    
        if (clickedImageIndex !== -1) {
          var imagesInRoot = Array.from(images);
          initPhotoSwipe(imagesInRoot, clickedImageIndex);
        }
      }
    }
    
    // Play video only when it's in the current slide
    function handleVideoPlayback(gallery) {
      var videos = document.querySelectorAll('.pswp-video');
      videos.forEach((video) => video.pause()); // Pause all videos
    
      var currentSlide = gallery.currItem.container;
      if (currentSlide) {
        var video = currentSlide.querySelector('.pswp-video');
        if (video) {
          video.play(); // Play only the video in the current slide
        }
      }
    }
    
    // Stop all videos when closing PhotoSwipe
    function stopAllVideos() {
      var videos = document.querySelectorAll('.pswp-video');
      videos.forEach((video) => {
        video.pause();
        video.currentTime = 0; // Reset video time
      });
    }
    
    document.addEventListener('click', function (event) {
      if (event.target.matches('[photo-swipe]')) {
        handlePhotoSwipeClick(event);
      }
    });
    
  }
}

function styling() {
  var fullHalfElements = document.querySelectorAll('[full-half]');
  var elementsArray = Array.from(fullHalfElements);

  elementsArray.forEach(function (element) {
      element.style.width = 'calc(100% + ' + marginFromLeft + ')';
  });
}

function toggleClass() {
  var elementsWithToggleClass = document.querySelectorAll('[toggle-class]');
  if (elementsWithToggleClass.length > 0) {
    elementsWithToggleClass.forEach(function(element) {
      element.addEventListener('click', function() {
        var toggleClass = element.getAttribute('toggle-class');
        var selector = element.getAttribute('selector');
        var isRelative = element.hasAttribute('relative');
        var targetElements;
        if (isRelative) {
          var parentRoot = element.closest(selector);
          parentRoot.classList.toggle(toggleClass);
        } else {
          targetElements = document.querySelectorAll(selector);
          targetElements.forEach(function(targetElement) {
            targetElement.classList.toggle(toggleClass);
          });
        }

      });
    });

  }
}

function toggleTabs() {
  $('[toggle]').click(function() {
    var eSelector = $(this).attr('toggle');
    var allTabs = eSelector.substr(0, 3);

    if (eSelector.includes('all')) {
        // Show all tabs when the "All" button is clicked
        $('[data-toggle-tab^=' + allTabs + ']').addClass('active');
        
        var allBtns = $('[toggle^=' + allTabs + ']');
        $(allBtns).removeClass('active');
        
        var btn = $('[toggle=' + eSelector + ']');
        $(btn).addClass('active').siblings().removeClass('active');
    } else {
        var allBtns = $('[toggle^=' + allTabs + ']');
        $(allBtns).removeClass('active');
    
        var btn = $('[toggle=' + eSelector + ']');
        $(btn).addClass('active').siblings().removeClass('active');
    
        var elList = $('[data-toggle-tab^=' + allTabs + ']');
        $(elList).removeClass('active');
    
        var element = $('[data-toggle-tab=' + eSelector + ']');
        $(element).addClass('active');
    }
});

$('[toggle-fade]').click(function() {
  var eSelector = $(this).attr('toggle-fade');
  var allTabs = eSelector.substr(0, 3);

  if (eSelector.includes('all')) {
      // Show all tabs when the "All" button is clicked
      $('[data-toggle-fade^=' + allTabs + ']').fadeIn().addClass('active');
      
      var allBtns = $('[toggle-fade^=' + allTabs + ']');
      $(allBtns).removeClass('active');
      
      var btn = $('[toggle-fade=' + eSelector + ']');
      $(btn).addClass('active').siblings().removeClass('active');
  } else {
      var allBtns = $('[toggle-fade^=' + allTabs + ']');
      $(allBtns).removeClass('active');
  
      var btn = $('[toggle-fade=' + eSelector + ']');
      $(btn).addClass('active').siblings().removeClass('active');
  
      var elList = $('[data-toggle-fade^=' + allTabs + ']');
      $(elList).hide().removeClass('active');
  
      var element = $('[data-toggle-fade=' + eSelector + ']');
      $(element).fadeIn().addClass('active');
  }
});


}

var stringToHTML = function (str,parent) {
	var parser = new DOMParser();
	var doc = parser.parseFromString(str, 'text/html');
    var childsLengh = doc.body.children.length
    for (var i = 0; i < childsLengh; i++) {
        parent.appendChild(doc.body.children[0]);
    }
};

function initVideoJS() {
  var videoElements = document.querySelectorAll('.video-el');
  if (videoElements.length > 0) {
    // <video id="my-video" class="video-js video-el object-fit vjs-default-skin w-100" poster="layout/image/video-img.jpeg" controls preload="auto" width="640" height="360">
    //    <source src="layout/image/article-vid.mp4" type="video/mp4">
    // </video>
    videoElements.forEach(function(videoElement) {
      var ID = videoElement.id;
      if (!ID) {
        ID = generateID();
        videoElement.id = ID;
      }
      var player = videojs(ID);
    });
  }
}

function initMobileNumber() {
  if (document.querySelectorAll('[mobile-number]').length > 0) {
    document.querySelectorAll('[mobile-number]').forEach(function(element) {
        var ID = element.id;
        if (!ID) {
            ID = generateID();
            element.id = ID;
        }
        var inputField = document.getElementById(ID);
        // intlTelInput(inputField, {
        //   initialCountry: "bh",
        //   separateDialCode: true,
        //   geoIpLookup: function(callback) {
        //       // Use the "ipinfo.io" service to look up the user's country
        //       $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //           var countryCode = (resp && resp.country) ? resp.country : "";
        //           callback(countryCode);
        //       });
        //   },
        //   preferredCountries: ["bh", "ae", "us", "gb", "eg", "kw", "om", "qa", "sa"],
        //   excludeCountries: ["il"],
        // });
        $(inputField).intlTelInput({
          initialCountry: "bh",
          separateDialCode: true,
          geoIpLookup: function(callback) {
              // Use the "ipinfo.io" service to look up the user's country
              $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "";
                  callback(countryCode);
              });
          },
          preferredCountries: ["bh", "ae", "us", "gb", "eg", "kw", "om", "qa", "sa"],
          excludeCountries: ["il"],
      });
    });
}
}

function stickyHeader() {
  if (document.querySelector('.header')) {
    const headerEl = document.querySelector('header.header');
    const headerHeight = headerEl.offsetHeight;
    function handleScroll() {
      const scrolled = window.scrollY;
    
      if (scrolled > headerHeight) {
        document.body.classList.add('scroll');
      } else {
        document.body.classList.remove('scroll');
      }
    }
    handleScroll()
    window.addEventListener('scroll', handleScroll);
  }
}



function forms() {
  if (document.querySelector('[form-inside]')) {
    document.querySelectorAll('[form-inside] form .form-control').forEach(function(element) {
      element.addEventListener('keydown', handleFocusBlur);
      element.addEventListener('blur', handleFocusBlur);
      element.addEventListener('focus', handleFocusBlur);
    });
    
    function handleFocusBlur(event) {
        var element = event.target;
        var isFilled = element.value.length > 0;
        var isTextarea = element.tagName.toLowerCase() === 'textarea';
        var fieldBox = element.closest('.form-group');
    
        if (isTextarea) {
            if (isFilled || element === document.activeElement) {
                fieldBox.classList.add('filled');
            } else {
                fieldBox.classList.remove('filled');
            }
        } else {
            if (isFilled || element === document.activeElement) {
                fieldBox.classList.add('filled');
            } else {
                fieldBox.classList.remove('filled');
            }
        }
    }
  
  }
}

function selectFields() {
  if (document.querySelector('[init-select]')) {
    $('[init-select]').each(function(){
      $(this).niceSelect();
    })
  }
}

function goUp() {
  if ($('.go-up-btn').length > 0) {
    $(window).on('scroll', function () {
      const show = $(this).scrollTop() > $(window).height() / 2;
      $('.go-up-btn').toggleClass('active', show);
    });
  
    $('.go-up-btn').on('click', function() {
      $('html, body').animate({ scrollTop: 0 }, 400);
    });

  }
}

function cartTable() {
  if ($('[table-edit-amount-before-edit]').length > 0) {
    $('[table-edit-amount-before-edit] [switcher]').click(function(){
      $(this).parents('[table-edit-amount-edit-root]').toggleClass('active');
      if ($(this).parents('[table-edit-amount-edit-root]').hasClass('active')) {
        $(this).parents('[table-edit-amount-edit-root]').find('.amount-input').select();
      }
    })
  }
}

function share() {
  $('[share]').click(function () {
      var link = $(this).attr('share');
      
      if (!navigator.share) {
          $('body').append(`<textarea id="share-link">${link}</textarea>`);
          document.getElementById('share-link').select();
          document.execCommand("Copy");
          $('#share-link').remove();
      } else {
          var title = $(this).attr('share-title');
          navigator.share({
              title: title,
              url: link
          }).catch(console.error);
      }
  });
}

function tooltip() {
  $('[data-toggle="tooltip"]').each(function() {
      var isOnClick = false;
      var isNormalTip = $(this).hasClass('normal-tip');
      var self = $(this);
      if ($(this).attr('click') !== undefined) {
          isOnClick = true;
      }

      var options = {
          content: this.getAttribute('data-title'),
          theme: 'main-theme',
          placement: 'bottom',
          onCreate: function(instance) {
              var tooltip = instance.popper;
              
              if (isNormalTip) {
                  tooltip.setAttribute('customize-css', 'without-check');
              } else if ($(self).attr('theme')) {
                  
                  tooltip.setAttribute('customize-css', $(self).attr('theme'));
              }
          }
      }
      if (isOnClick) {
          options.trigger = 'click';
      }
      var tooltip = tippy(this, options);
      $(this).on('click', function() {
          
          // Hide the tooltip after 3 seconds
          setTimeout(function() {
              tooltip.hide();
          }, 3000);
      });
  });
}

function amountsBox() {
  if ($('[amount-box-root]').length > 0) {
    $('[amount-box-root] .amount-input').on('focus', function () {
      $(this).select(); // select value
      $(this).closest('[amount-box-root]').addClass('active');
    }).on('blur', function () {
      $(this).closest('[amount-box-root]').removeClass('active');
      // $(this).siblings('[val-lbl]').html($(this).val())
    });
  }  
}

function togglePasswordInput() {
  $('[toggle-password-btn]').click(function(){
    const root = $(this).parents('[password-input-root]');
    $(root).toggleClass('active');
    const isActive = $(root).hasClass('active');
    $(root).find('[password-input]').attr('type',!isActive ? 'password' : 'text')
  })
}

function verificationCode() {
  if ($('[verification-code]').length > 0) {
      $('[verification-code]').each(function(){
          const inputs = $(this).find('[digit]');
          const KEYBOARDS = {
              backspace: 8,
              arrowLeft: 37,
              arrowRight: 39
          };
          
          function handleInput(e) {
              const input = $(e.target);
              const nextInput = input.next('input');
              if (nextInput.length && input.val()) {
              nextInput.focus();
              if (nextInput.val()) {
                  nextInput.select();
              }
              }
          }
          
          function handlePaste(e) {
              e.preventDefault();
              const paste = e.originalEvent.clipboardData.getData('text');
              inputs.each(function(i) {
              $(this).val(paste[i] || '');
              });
          }
          
          function handleBackspace(e) {
              const input = $(e.target);
              if (input.val()) {
              input.val('');
              return;
              }
              input.prev('input').focus();
          }
          
          function handleArrowLeft(e) {
              const previousInput = $(e.target).prev('input');
              if (!previousInput.length) return;
              previousInput.focus();
          }
          
          function handleArrowRight(e) {
              const nextInput = $(e.target).next('input');
              if (!nextInput.length) return;
              nextInput.focus();
          }
          
          inputs.eq(0).on('paste', handlePaste);
          inputs.on('input', handleInput);
          
          inputs.on('focus', function(e) {
              const input = $(this);
              setTimeout(function() {
              input.select();
              }, 0);
          });
          
          inputs.on('keydown', function(e) {
              switch (e.keyCode) {
              case KEYBOARDS.backspace:
                  handleBackspace(e);
                  break;
              case KEYBOARDS.arrowLeft:
                  handleArrowLeft(e);
                  break;
              case KEYBOARDS.arrowRight:
                  handleArrowRight(e);
                  break;
              default:
              }
          });
      })
  } 
}

function copy(){
  $(document).on('click', '[copy]', function () {
  const text = $(this).attr('copy');

  navigator.clipboard.writeText(text);

  tippy(this, {
    content: 'تم نسخ الرابط',
    trigger: 'manual',
    placement: 'top',
  }).show();

  setTimeout(() => this._tippy.destroy(), 1200);
});
}

function filtersProfile() {
  if ($('[toggle-filters-profile]').length > 0) {
    $('[toggle-filters-profile]').click(function(){
      const $btn = $(this);
      const type = $btn.attr('toggle-filters-profile');
      const root = $btn.closest('.profile-table-1');
      const allFilters = root.find('[filters-profile-row]');
      const filterType = allFilters.find('[type="' + type + '"]');
      const isAlreadyActive = $btn.hasClass('active');
      
    
      // reset buttons & filters inside this root only
      root.find('[toggle-filters-profile]').removeClass('active');
      allFilters.find('div[type]').removeClass('active').hide();
    
      if (isAlreadyActive) {
        // close all
        allFilters.removeClass('active').slideUp();
      } else {
        // open selected type
        $btn.addClass('active');
        allFilters.addClass('active').slideDown();
        filterType.addClass('active').show();
      }
    });
    

    
  }

  if ($('.request-paric-box').length > 0 && isMobile) {
    $('.request-paric-box .jd').click(function(){
      $(this).next('.cntnt').slideToggle();
    })
  }
}