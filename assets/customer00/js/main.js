$(document).ready(function() {

    var height = $(window).scrollTop();

    if(height < 1 | $(window).width() < 960) {
        $(".header").removeClass("header-white");
    }else{
        $(".header").addClass("header-white");
    }

    $(window).resize(function(){
        if ($(window).width() < 960) {  
            $(".header").removeClass("header-white");
            $(".nav").css( "display","none");
            $(".menu").css( "display","block");
        }else{
            $(".nav").css( "display","block");
            $(".menu").css( "display","none");
        }     
    });

    $(window).scroll(function() {
        var height = $(window).scrollTop();
        if(height  < 1  | $(window).width() < 960) {
            $(".header").removeClass("header-white");
        }else{
            $(".header").addClass("header-white");
        }
    });

    $(".menu").on("click", function(){
        $(".nav").css( "display","block");
        $(this).hide();
    });

    $(".close").on("click", function(){
        $(".nav").css( "display","none");
        $(".menu").css( "display","block");
    });
    
    $(document).on("click", ".nav", function(e){
        if (e.offsetX > $(this)[0].offsetWidth) {
            $(".nav").css( "display","none");
            $(".menu").css( "display","block");
        } 
       
   });
    
});