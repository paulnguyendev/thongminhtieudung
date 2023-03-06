const courseCard = {
    slickConfigNormal(dots = false, arrows = false, xlSlides = 4, lgSlides = 3, mdSlides = 2, smSlides = 1, Slides = 1) {
      return {
        slidesToScroll: 1,
        slidesToShow: 4,
        rows: 1,
        centerMode: false,
        lazyLoad: 'ondemand',
        arrows,
        dots,
        infinite: true,
        variableWidth: false,
        responsive: [
          {
            breakpoint: 4320,
            settings: {
              slidesToShow: xlSlides,
              slidesToScroll: xlSlides,
            }
          },
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: lgSlides,
              slidesToScroll: lgSlides,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: mdSlides,
              slidesToScroll: mdSlides,
              dots: true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: smSlides,
              slidesToScroll: smSlides,
              dots: true,
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: Slides,
              slidesToScroll: Slides,
              dots: true,
              autoplay: true,
              autoplaySpeed: 5000
            }
          },
        ]
      }
    },

    slickConfigCourseDetail(dots = false, arrows = false, xlSlides = 3, lgSlides = 2, mdSlides = 2, smSlides = 1, Slides = 1) {
      return {
        rows: 1,
        centerMode: false,
        arrows,
        dots,
        infinite: true,
        variableWidth: false,
        responsive: [
          {
            breakpoint: 4320,
            settings: 'unslick',
          },
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: lgSlides,
              slidesToScroll: lgSlides,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: mdSlides,
              slidesToScroll: mdSlides,
              dots: true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: smSlides,
              slidesToScroll: smSlides,
              dots: true,
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: Slides,
              slidesToScroll: Slides,
              dots: true,
              autoplay: true,
              autoplaySpeed: 5000
            }
          },
        ]
      }
    },

    //TODO: Nhan add link qua trang Search nhe
    htmlImageSeeMore(numberSlide, seeMoreLink = '') {
      let html = '';
      seeMoreLink = (seeMoreLink.length > 1) ? seeMoreLink + '/580030?utm_source=kyna.site&utm_medium=coursedetail_banner' : '#';

      if (numberSlide == 1) {
        if ($(window).width() > 992) {
          return html = `
          <div class="card-course-seemore card-course-seemore__2">
              <a href="${seeMoreLink}" class="card-course-seemore__link">
                  <img class="card-course-seemore__image"
                       src="/img/card-course-seemore-2.jpg"
                       alt="seemore">
              </a>
          </div>`;
        } else {
          return html = `
          <div class="card-course-seemore card-course-seemore__1">
              <a href="${seeMoreLink}" class="card-course-seemore__link">
                  <img class="card-course-seemore__image"
                       src="/img/card-course-seemore-1.jpg"
                       alt="seemore">
              </a>
          </div>`;
        }
      }
      if (numberSlide == 2) {
        return html = `
          <div class="card-course-seemore card-course-seemore__1">
              <a href="${seeMoreLink}" class="card-course-seemore__link">
                  <img class="card-course-seemore__image"
                       src="/img/card-course-seemore-1.jpg"
                       alt="seemore">
              </a>
          </div>`;
      }
    },

    _handleSlick() {
      let slickCollection = $('.slick__slider--normal');
      slickCollection.each((index, value) => {
        let layoutType = $(value).data('slick-type');
        let numberSlide = $(value).data('number-card');
        let slickElement = $(value).data('slick-class');
        let config = courseCard.slickConfigNormal();
        let seeMoreLink = $(value).data('see-more-link');

        if (layoutType == 'course-detail') {
          config = courseCard.slickConfigCourseDetail();
          if (numberSlide < 3) {
            $(value).append(courseCard.htmlImageSeeMore(numberSlide, seeMoreLink));
          }
        }

        $(`.${slickElement}__slider`).slick(config);
        if ($(window).width() < 992) {
          courseCard.sliderArrowBottom(`${slickElement}__slider`);
        }
      });
    }
    ,

    sliderArrowBottom(sliderClass) {
      let prevButton = '<button type="button" class="slick-prev slick-arrow-sm slick-arrow-bottom" aria-label="slick-button"></button>';
      let nextButton = '<button type="button" class="slick-next slick-arrow-sm slick-arrow-bottom" aria-label="slick-button"></button>';
      let slickListWidth = $(`.${sliderClass} .slick-list`).width();
      let slickDotWidth = $(`.${sliderClass} .slick-dots`).width();
      let spacingCustomArrows = (slickListWidth - slickDotWidth - 80) / 2;
      $(`.${sliderClass} .slick-dots`).after(prevButton);
      $(`.${sliderClass} .slick-dots`).after(nextButton);
      $(`.${sliderClass} .slick-prev`).css('left', spacingCustomArrows);
      $(`.${sliderClass} .slick-next`).css('right', spacingCustomArrows);
      $(`.${sliderClass} .slick-prev`).on('click', () => {
        $(`.${sliderClass}`).slick('slickPrev');
      });
      $(`.${sliderClass} .slick-next`).on('click', () => {
        $(`.${sliderClass}`).slick('slickNext');
      });
    }
    ,

    handleAnimation() {
      let windowWidth = $(window).width();
      if (windowWidth > 1199) {
        $('.card-course').each(function (index, value) {
          const id = $(value).attr('data-id');
          const title = $(value).find('.heading-card__main').text();
          const uploadDate = $(value).attr('data-upload-date');
          const duration = $(value).attr('data-duration');
          const userEnroll = $(value).attr('data-user-enroll');
          const description = $(value).attr('data-description');
          const promoText = $(value).attr('data-promo-text');
          const isBestSeller = $(value).attr('data-is-best-seller');
          const courseUrl = $(value).find('.card-link').attr('href');
          const loggedUser = $('head').data('user-id') ? 1 : 0;
          const itemFree = $(value).data('course-item-free');

          let promotionText = '';
          if (promoText == '' || promoText == undefined) {
            promotionText = ``;
          } else {
            promotionText = `${promoText} `;
          }
          let timer;
          let course = {
            id,
            title,
            uploadDate,
            duration,
            userEnroll,
            description,
            promoText,
            isBestSeller,
            courseUrl,
          };
          $(value).popover({
            placement: 'auto right',
            trigger: 'manual',
            container: 'body',
            html: true,
            content() {
              const statusItem = parseInt($(value).attr('data-status-item'));
              let previewButton = ``;
              if ($(`.card-course[data-id=${id}]`).find('.cta-open-video').hasClass('none-video')) {
                previewButton = '';
              } else {
                previewButton = `<a class="cta-course-preview cta-course-preview-hover btn-ripple"><i class="fas fa-play"></i></a>`;

              }
              let durationElement = '';
              if (duration != undefined && duration.length > 1 && duration != '0 phút') {
                durationElement = ` <span class="card-hover__info-item">
                                                <i class="fas fa-clock"></i>
                                               ${duration}
                                            </span>
                                            <i class="fas fa-circle"></i>`
              }
              ;
              let result = `
                                <div class="card-hover">
                                    <div class="card-hover__wrapper">
                                        <div class="card-hover__title">
                                            ${course.title}
                                        </div>
                                        <div class="card-hover__feature">
                                           ${promotionText}
                                        </div>
                                        <div class="card-hover__info">
                                        ${course.isBestSeller == 1 ? `<span class="card-hover__info-item badget-red">Bestseller</span>` : ``}
                                            <span class="card-hover__info-item">
                                            <i class="fas fa-calendar-check"></i>
                                                    ${course.uploadDate}
                                            </span>
                                        </div>
                                        <div class="card-hover__info">
                                            ${durationElement}
                                          
                                            <span class="card-hover__info-item">
                                                <i class="fas fa-user"></i>
                                                ${course.userEnroll} học viên
                                            </span>
                                        </div>
                                       
                                        <div class="card-hover__description">
                                            ${course.description}
                                            <div class="card-hover__description-fade-bottom"></div>
                                        </div>
                                        <div class="card-hover__cta">
                                            <a href="${course.courseUrl}" target="_blank" class="cta-course-detail btn-outline-green">Chi tiết</a>
                                            <div>
                                            ${previewButton}
                                            `;

              if (statusItem === 2) {
                result += `<a href="/lop-hoc/${course.id}" class="cta-add-to-cart btn-outline-green btn-circle go-to-class" title="Vào lớp học">
                                        <i class="far fa-sign-in-alt"></i>
                                    </a>`;
              } else if (itemFree && loggedUser === 0) {
                result += `<a class="request-login btn-outline-green btn-circle" href="/dang-nhap" data-toggle="modal"data-target="#k-popup-account-login" data-ajax="" data-push-state="false" title="Thêm vào khoá học">
                                            <i class="fas fa-plus" style="margin-right: 0"></i>
                                        </a>`;
              } else if (itemFree && loggedUser === 1) {
                result += ` <a class="btn-outline-green btn-circle" href="#" id="addToMyCourse" data-course="${course.id}" title="Thêm vào khoá học">
                                            <i class="fas fa-plus" style="margin-right: 0"></i>
                                        </a>`;
              } else if (statusItem === 3) {
                result += `<a class="cta-add-to-cart btn-outline-green btn-circle already-in-cart" disabled data-toggle="tooltip" data-placement="top" data-animation="false" title="Đã thêm vào giỏ hàng">
                                            <i class="far fa-cart-plus"></i>
                                        </a>`;
                $('.already-in-cart').prop('disabled', true);
              } else {
                result += `<a href="#" class="cta-add-to-cart btn-outline-green btn-circle go-to-cart add-to-cart" data-pid="${course.id}" action="AddToCart" label="${course.title}" title="Thêm vào giỏ hàng">
                                            <i class="far fa-shopping-cart"></i>
                                        </a>`;
              }

              result += `</div>
                                        </div>
                                    </div>
                                </div>`;
              return result;
            }
          }).hover(function () {
            timer = setTimeout(() => {
              $('body').find('.popover').popover('hide');
              $(this).popover("show");
              $('.cta-course-preview-hover').on('click', function (e) {
                e.preventDefault();
                $(`.card-course[data-id=${id}]`).find('.cta-open-video').click();
                $('body').find('.popover').popover('hide');
              });
            }, 300);
            $('body').find(".popover").on("mouseleave", function () {
              $(this).popover('hide');
            });
          }, function () {
            var _this = this;
            setTimeout(function () {
              if (!$(".popover:hover").length) {
                $('body').find('.popover').popover('hide');
              }
            }, 100);
            clearTimeout(timer)
          });
        })
      }
    }
    ,

    handleVideo() {
      let player = videojs('video-preview__player');
      videojs('video-preview__player', {
        controls: true,
        autoplay: true,
        preload: 'metadata',
      });
      let videoSrc;
      $('.cta-open-video').on('click', function (e) {
        e.preventDefault();
        videoSrc = $(this).attr('data-source');
        $('#video-modal').modal('show');
        player.src(videoSrc);
        player.play();
        return
      });
      $('#video-modal').on('shown.bs.modal', function (e) {
        player.play();
      });
      $('#video-modal').on('hidden.bs.modal', function (e) {
        player.pause();
      });
    }
    ,

    ClickDropDownCart() {
      $('.cart.dropdown').addClass('open');
      $('footer').after('<div id="shadown-cart-click" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 11;background: black;opacity: 0.5;"></div>');
      $('#shadown-cart-click').on('click', () => {
        $('.cart.dropdown').remove('open');
        $('#shadown-cart-click').remove();
      });
      setTimeout(() => {
        $('.cart.dropdown').removeClass('open');
        $('#shadown-cart-click').remove();
      }, 4000);
    }
    ,

    handleAddToCart() {
      $(document).on('click', '#shadown-cart-click', function () {
        $('.cart.dropdown').removeClass('open');
        $('#shadown-cart-click').remove();
      });
      $(document).on('mouseleave', '.popover', function () {
        $('body').find('.popover').each((index, value) => {
          $(value).fadeOut(300);
        });
      });
      $('body').on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        $('body').find('.popover').popover('hide');
        var pid = $(this).data('pid');
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
          url: '/cart/default/add',
          type: 'POST',
          data: {
            pid: pid,
            _csrf: csrfToken
          },
          success: function (response) {
            if (response.result) {
              countCart = countCart + 1;
              sendData = true;

              // update total count
              $('.k-header-info .cart .count-number').html(response.totalCount);
              $('.k-details-cart-right .count-number').html(response.totalCount);
              $('#detail-icon-cart .detail-number').html(response.totalCount);
              if ($('.add-to-cart.k-popup').length > 0) {
                $('.k-popup-lesson .k-popup-lesson-close').click();
              }

              var isDetailPage = $('.add-to-cart').parents('body').hasClass('k-detail');
              if (isDetailPage) {
                $('html, body').animate({scrollTop: 0}, 200);
              }
              // update shot cart html at header
              $('#k-header-form-cart').parent().replaceWith(response.content);

              // update course card data
              let courseCards = $('*[data-id="' + pid + '"]');
              courseCards.each(function (index) {
                $(this).attr('data-status-item', '3');
              });
              let courseCardsDetail = $(`.add-to-cart[data-pid=${pid}]`);
              courseCardsDetail.each(function (index, value) {
                $(this).removeClass('go-to-cart add-to-cart register');
                $(this).find('i.far').removeClass('fa-shopping-cart').addClass('fa-cart-plus');
                $(this).addClass('already-in-cart');
                if ($(value).hasClass('btn-outline-grey')) {
                  $(value).click();
                }
                ;
              });

              // show drop down cart
              courseCards.ClickDropDownCart();

              if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                window.location.href = '/gio-hang';
              }
            } else {
              // Failed
              console.log(response.error);
            }
          }
        });
      });
    }
    ,

    init: function () {
      // this._handleSlick();
      this.handleAnimation();
      this.handleVideo();
      this.handleAddToCart();
    }
  }
;

$(document).ready(function () {
  courseCard.init();
});
