/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */
// jshint ignore: start
(function($) {
  $(function() {
    $('.lazy').lazy();

  });
  if($(window).width() < 640) {
    $('img.uk-img-hidden').each(function(){
      $(this).removeAttr('data-src');
    });
  }


  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {



      init: function() {
        var fields = $('.ginput_container input, .uk-select, .textarea');
        var fieldsGroup = '.uk-form-group, .uk-search-field, .wpcf7-form-control-wrap';
        function formIsEmpty(el) {
          $(el).each(function () {
            var $this = $(this);
            var val = $this.val() + '';
            if (val.length > 0 && val !== 'null') {
              $this.parents(fieldsGroup).addClass('uk-is-not-empty');
              $this.parents(fieldsGroup).removeClass('uk-is-empty');
            } else {
              $this.parents(fieldsGroup).addClass('uk-is-empty');
              $this.parents(fieldsGroup).removeClass('uk-is-not-empty');
            }
          });
        }

        formIsEmpty(fields);

        fields.on('change keyup focusin focusout', function () {
          formIsEmpty($(this));
        });

        fields
          .on('focusin', function () {
            var $this = $(this);
            $this.parents(fieldsGroup).addClass('uk-is-focus');
          }).on('focusout', function () {
          var $this = $(this);
          $this.parents(fieldsGroup).removeClass('uk-is-focus');
        });



        $(window).on('load resize', function () {
          $('textarea').trigger('input');
          //$('textarea').textareaAutoSize();
        });


        var ElementsDirection = {
          $element: $('[data-position]'),
          $window: $(window),
          mouseX: 0,
          mouseY: 0,

          init: function() {
            var that = this;
            this.$window.on('load resize mousemove', function (event) {
              that.mouseX = event.pageX;
              that.mouseY = event.pageY;
              that.set();
            });
          },

          get: function(element){
            if (!event) {
              console.log('No event!');
              return;
            }

            var mouseX = this.mouseX;
            var mouseY = this.mouseY;

            var elementLeft = element.offset().left;
            var elementRight = elementLeft + this.$element.width();
            var elementTop = element.offset().top;
            var elementBottom = elementTop + element.height();


            if (mouseX > elementLeft && mouseX < elementRight && mouseY < elementTop) {
              return 'top';
            } else if (mouseX < elementLeft && mouseY < elementTop) {
              return 'top-left';
            } else if (mouseX < elementLeft && mouseY > elementTop && mouseY < elementBottom) {
              return 'left';
            } else if (mouseX < elementLeft && mouseY > elementBottom) {
              return 'down-left';
            } else if (mouseX > elementLeft && mouseX < elementRight && mouseY > elementBottom) {
              return 'down';
            } else if (mouseX > elementRight && mouseY > elementBottom) {
              return 'down-right';
            } else if (mouseX > elementRight && mouseY > elementTop && mouseY < elementBottom) {
              return 'right';
            } else if (mouseX > elementRight && mouseY < elementTop) {
              return 'top-right';
            } else {
              return 'front';
            }
          },

          set: function(){
            var that = this;

            this.$element.each(function () {
              var $this = $(this);
              $this.attr('uk-direction', 'front');
              $this.attr('uk-direction', that.get($this));
            });
          }

        };

        ElementsDirection.init();

        function shadow_hover(){
          if($('.uk-card-button').length){
            $('.uk-card-button a').on('mouseenter',function(){
              $(this).closest('.uk-card-client').addClass('uk-shadow');
            });
            $('.uk-card-button a').on('mouseleave',function(){
              $(this).closest('.uk-card-client').removeClass('uk-shadow');
            });
          }
        }

        shadow_hover();

        function heightDialog() {
          var parentDialog = $('.uk-section-dialog .uk-section-content');
          parentDialog.removeAttr('height');
          var heightDialog = $('.uk-dialog').height();
          parentDialog.outerHeight(heightDialog);
          parentDialog.find('.uk-dialog').first().addClass('uk-first-dialog');
        }

        heightDialog();
        $(window).resize(function(){
          heightDialog();
        });

        var count = 1;
        var timeOut;
        function loadMore(el) {
          $this = el;
          var parent = $this.parents('.uk-section-dialog');
          var postID = parent.data('id');
          var lengthItem = $('.length-answer').text();
          var childSec = parent.find('.uk-dialog-inner');
          //parent.outerHeight(childSec.height());


          parent.find('.uk-dialog').removeClass('uk-fade-in');
          parent.find('.uk-dialog').addClass('uk-first-dialog uk-fade-out');
          $.ajax({
            method: "POST",
            url: ajaxurl,
            dataType: 'HTML',
            data: {
              ID: postID,
              count: count,
              action: 'more_comments'
            },
            beforesend: function (data) {

            },
            success: function (data) {
              var child, dialog, arrCount;
              parent.find('.uk-section-content').append(data);
              dialog = parent.find('.uk-dialog-inner');

              parent.find('.uk-first-dialog').addClass('uk-fade-out');

              setTimeout(function () {
                dialog.addClass('uk-fade-in');
                heightDialog();
              }, 300);

              setTimeout(function () {
                parent.find('.uk-first-dialog').remove();

              }, 200);

              arrCount = dialog.data('count');
              child = dialog.children('.uk-dialog-item');

              dialog.removeClass('uk-dialog-inner');

              $('.progress_item').removeClass('show');
              if (count !== arrCount) {
                setTimeout(function () {
                  $('.progress_item').addClass('show');
                }, 100);
                timeOut = setTimeout(function () {
                  var el = $('.load-more');
                  loadMore(el);
                }, 5000);
              }
              if(count === (lengthItem-1)) {
                count = 0;
              } else {
                count++;
              }

            },
            error: function () {

            }
          });
        }
        $('.load-more').on('click', function () {
          $this = $(this);
          clearTimeout(timeOut);
          loadMore($this);
        });
        if($('.length-answer').length) {
          $('.progress_item').addClass('show');
          timeOut = setTimeout(function () {
            var el = $('.load-more');
            loadMore(el);
          }, 5000);
        }

        function addServiceListeners2() {
          var fields = $('.ginput_container input, .uk-select, .textarea');

          fields.on('change keyup focusin focusout', function () {
            formIsEmpty($(this));
          });

          fields
            .on('focusin', function () {
              var $this = $(this);
              $this.parents(fieldsGroup).addClass('uk-is-focus');
            }).on('focusout', function () {
            var $this = $(this);
            $this.parents(fieldsGroup).removeClass('uk-is-focus');
          });
        }
        function addServiceListeners(){
          $('.uk-pdf-download').removeClass('uk-hidden');

        }

        jQuery(document).bind('gform_confirmation_loaded', function(){
          addServiceListeners();

        });
        jQuery(document).bind('gform_post_render', function(){
          addServiceListeners2();

        });

        jQuery('#uk-tab-content').on('show', function() {
          UIkit.update(event = 'update');
        });

        //Intercom
        jQuery('.uk-intercom').click(function(e){
          new Intercom('show');
          e.preventDefault();
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        /* ---- particles.js config ---- */

        particlesJS("particles-js", {
          "particles": {
            "number": {
              "value": 100,
              "density": {
                "enable": true,
                "value_area": 400
              }
            },
            "color": {
              "value": "#ffffff"
            },
            "shape": {
              "type": "circle",
              "stroke": {
                "width": 0,
                "color": "#000000"
              },
              "polygon": {
                "nb_sides": 5
              },
              "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
              }
            },
            "opacity": {
              "value": 0.8,
              "random": false,
              "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
              }
            },
            "size": {
              "value": 3,
              "random": true,
              "anim": {
                "enable": false,
                "speed": 40,
                "size_min": 0.1,
                "sync": false
              }
            },
            "line_linked": {
              "enable": true,
              "distance": 150,
              "color": "#ffffff",
              "opacity": 0.4,
              "width": 1
            },
            "move": {
              "enable": true,
              "speed": 3,
              "direction": "none",
              "random": false,
              "straight": false,
              "out_mode": "out",
              "bounce": true,
              "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 1200
              }
            }
          },
          "interactivity": {
            "detect_on": "canvas",
            "events": {
              "onhover": {
                "enable": true,
                "mode": "grab"
              },
              "onclick": {
                "enable": true,
                "mode": "push"
              },
              "resize": true
            },
            "modes": {
              "grab": {
                "distance": 140,
                "line_linked": {
                  "opacity": 1
                }
              },
              "bubble": {
                "distance": 400,
                "size": 40,
                "duration": 2,
                "opacity": 8,
                "speed": 3
              },
              "repulse": {
                "distance": 200,
                "duration": 0.4
              },
              "push": {
                "particles_nb": 4
              },
              "remove": {
                "particles_nb": 2
              }
            }
          },
          "retina_detect": true
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS

        // Slick slider main section
        var time = 2;
        var $bar,
          $slick,
          isPause,
          tick,
          percentTime;
        var $slider = $('.uk-section-main .uk-h1');
        $slider.slick({
          dots: true,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear',
          arrows: false,
          autoplay:true,
          autoplaySpeed: 5000
        });

        $('.slick-dots li').removeClass('slick-active');
        setTimeout(function(){
          $('.slick-dots li:first-child').addClass('slick-active2');
        },100);
        setInterval(function(){
          $('.slick-dots li:first-child').removeClass('slick-active2');
        },5000)

        jQuery('#gform_2 input, #gform_2 textarea').each(function(){
          var tabIndex = jQuery(this).attr('tabindex');
          jQuery(this).attr('tabindex',1+tabIndex );
        })


      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);



})(jQuery); // Fully reference jQuery after this point.
