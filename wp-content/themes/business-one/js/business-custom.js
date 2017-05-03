jQuery(function($){

    
    $('body').imagesLoaded(function(){

        $('.page-loader').delay(700).fadeOut();

        $('.page-loader').find('img').fadeOut();

    });


	 $('.fade').slick({
        dots: false,
        infinite: true,
        speed: 750,
        fade: true,
        slide: 'div',
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed:5000

    });   


  


    $('.h-product').hover(function(){

        $(this).find('.p-name').stop().animate({
            left : '40px'
        },{queue:false}).fadeIn();

    },function(){

        $(this).find('.p-name').stop().animate({
            left: '20px'
        },{queue:false}).fadeOut();

    });   



    $('.h-card').hover(function(){

        $(this).find('img').stop().animate({

            top:'-60px',
            opacity:'.4'

        },{duration:200});


        $(this).find('.team-desc').stop().animate({

            bottom:'7px'

        },{duration:200});


        $(this).find('.team-social').stop().animate({
            opacity:'1'
        },750);

    },function(){

         $(this).find('img').stop().animate({

            top:'0',
            opacity:'1'

        },{duration:200});


         $(this).find('.team-desc').stop().animate({

            bottom:'-50px'

        },{duration:200});


          $(this).find('.team-social').stop().animate({
            opacity:'0'
        },150);

    });



     $('.autoplay').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000
    });



     $('.section-blog .h-entry').hover(function(){

        $(this).find('img').stop().fadeTo(150,.5);

        $(this).find('.entry-title').stop().animate({
            left:'35px',
            opacity:'1'

        },450);

     },function(){

        $(this).find('img').stop().fadeTo(150,1);

        $(this).find('.entry-title').stop().animate({
            left:'10px',
            opacity:'0'

        },250);

     });





    $('.blog-wrap').imagesLoaded(function(){

         $('.blog-wrap').masonry({

            columnWidth: '.col-sm-4.col-md-3',
            gutterWidth: 30,

          });

    });


    $('.top-navigation').find('li').hover(function(){

        $(this).children('ul').stop().fadeToggle(200);

        $(this).children('ul').siblings('a').stop().toggleClass('active');

    });


    $('.fixed-menu').find('li').hover(function(){

        $(this).children('ul').stop().fadeToggle(150);

        $(this).children('ul').siblings('a').toggleClass('active');

    });



    $('.blog-header .nav.navbar-nav').find('li').hover(function(){

        $(this).children('ul').stop().fadeToggle(150);

        $(this).children('ul').siblings('a').toggleClass('active');

    });


    $('.blog-justify').click(function(){

        $('.blog-mobile-menu').stop().slideToggle(150);

        $(this).find('.fa').stop().toggleClass('active');

    });



    $('.portfolioContainer').imagesLoaded(function(){

         $('.portfolioContainer').masonry({

            columnWidth: '.col-sm-6.col-md-4.col-lg-3',
            gutterWidth: 30,

          });

    });   


     

     $('.featured-heading').fitText(1.4);

     $('.heading-divider').fitText(1.6);

     $('.heading-blog').fitText(1.6);



     function menu_appearing(){

         if($(window).width()>992){


            $(window).scroll(function(){

                

                if($(window).scrollTop() > 610){
                    $('.fixed-menu').slideDown(150);
                }else{
                    $('.fixed-menu').slideUp(100);
                }

            });

        }

     }

     $(window).resize(menu_appearing);
     menu_appearing();

   



     $(function() {
        $('.scroll').bind('click', function(event) {
            var $anchor = $(this);
            var headerH = $('#navigation').outerHeight();
            $('html, body').stop().animate({
                scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
            }, 1200, 'easeOutExpo');

            event.preventDefault();
        });
    });


    $('.mobile-justify').click(function(){

        $('.mobile-menu').slideToggle(150);

        $('.fa-align-justify').toggleClass('active');        

    });


    $('.mobile-menu').find('a').click(function(){

        $('.mobile-menu').slideUp();

        $('.fa-align-justify').removeClass('active');

    });



    $(window).scroll(function(){


      
        var tophght=300;
        

        if($('section').hasClass('section-about')){

            if($(window).scrollTop() > $('#about').offset().top - tophght){

            

            $('.progress-bar').each(function(){

                var prog_val=$(this).attr('aria-valuenow');

                $(this).width(prog_val+'%');

            });



            $('.section-about').animate({

                    paddingTop:'5em',
                    opacity:1

                },{duration:1000});

            }

        }

        
        if($('section').hasClass('section-divider-one')){

            if($(window).scrollTop() > $('#divider-one').offset().top - tophght){

                $('.section-divider-one').find('.heading-divider').animate({

                    right:0,

                    opacity:1

                },1000);

            }
        }


        if($('section').hasClass('section-portfolio')){

             if($(window).scrollTop() > $('#portfolio').offset().top - tophght){

                $('.portfolioFilter').animate({

                    paddingTop:0,
                    opacity:1

                },1000);

            }

         }
        

        if($('section').hasClass('section-service')){

             if($(window).scrollTop() > $('#service').offset().top - tophght){

                $('.service-wrap').animate({

                    right:0,
                    opacity:1

                },1000);

            } 

         }


        if($('div').hasClass('extra-service-wrap')){

             if($(window).scrollTop() > $('.extra-service-wrap').offset().top - tophght){

                $('.extra-service-wrap').animate({

                   opacity:1

                },1000);

            }

        }



        if($('section').hasClass('section-team')){

            if($(window).scrollTop() > $('#team').offset().top - 500){

                $('.section-team').animate({

                    paddingTop:'5em',
                   opacity:1,


                },1000);

            }

        }


         if($('section').hasClass('section-client')){

            if($(window).scrollTop() > $('#client').offset().top - 500){

                $('#client .slick-list').animate({

                   opacity:1,
                   left:0


                },1000);

            }

        }


        if($('section').hasClass('section-blog')){

            if($(window).scrollTop() > $('#blog').offset().top - tophght){

                $('.blog-wrap').animate({

                   opacity:1

                },1300);

            }

        }
        




    });


        $('.section-divider-one').parallax();

        $('.section-service').parallax(); 

        $('.section-client').parallax();


       


      


       $('.fa-search').click(function(){

        $('#searchform').submit();

       });


       $('form#comment-form').find('input[type="submit"]').addClass('btn');

       $('.widget-content').find('select').addClass('form-control');

       $('.wpcf7-form').find('input, textarea').addClass('form-control');

       $('.wpcf7-form').find('input[type="submit"]').removeClass('form-control');

       $('.wpcf7-form').find('input[type="submit"]').addClass('btn btn-success');



});