<script>
    $(document).ready(function () {

        <?php if($this->session->flashdata("success")):?>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: '<?php echo $this->session->flashdata("success"); ?>',
                showConfirmButton: false,
                timer: 3000
            })
        <?php endif; ?>

        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:2,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:false,
                    loop:false
                }
            }
        });

        var x = window.matchMedia("(max-width: 560px)");
        ResponsiveCalendar(x);
        x.addListener(ResponsiveCalendar);

        LTCalendar.prototype.openDayWindow = function(date){
            var now = new Date();
            var day = new Date(date);
            this.calendarModalDate.textContent = this.days[day.getDay()] + ", " + day.getDate() + " de " + this.months[day.getMonth()] + " de " + day.getFullYear();
            
            var dateSelect =day.toISOString().slice(0,10);

            var pusher = new Pusher('191dbef1780135573650');
            var channel = pusher.subscribe('chatglobal');
            bookingTimer(dateSelect);

            <?php if(!empty( $this->session->login_id('id'))):?>
            channel.bind('my_event', function(data) {
                var ses_id =<?php echo $this->session->login_id('id');?>;

                if(data.id == ses_id){
                
                }else{
                    bookingTimer(dateSelect);
                }
            });
            <?php endif; ?>

            $(document).on("click",".card-hour", function(){
                generateBooking(dateSelect,this.id);
                $( this ).off( event );
             });

            this.calendarModalDate.setAttribute('data-date', day);
            this.calendarModal.classList.add("calendar-modal-active");
        };

        var calendar = new LTCalendar();

    });

    function bookingTimer(dateSelect) { 
        $.ajax({
            url: "customer/SoccerField/getTime",
            type:"POST",
            data:{date:dateSelect},
            dataType:"json",
            success:function(resp){ 
                var html=new Array();
                $.each(resp,function(key, value){ 
                    html.push (
                       ' <div class="col-lg-2 col-md-4">'+
                            '<div class="card-hour" id="'+value.id+'">'+
                               ' <p>' +ConvertTime(value.inicio)+' - '+ConvertTime(value.final)+'</p>'+
                            '</div>'+
                        '</div>'
                    );
                });
                $('.list').html(html);
            }
        });
    }

    function generateBooking(dateSelect,idSoccerField) {
        $.ajax({
            url: "customer/PreBooking/save",
            type:"POST",
            data:{date:dateSelect,id:idSoccerField},
            dataType:"json",
            success:function(resp){
                window.location.href="proceso-reserva";
            },
            error: function() {
                <?php  if($this->session->login_id("reservafutbolc")): ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Para realizar una nueva reserva cancela tu reserva pendiente',
                        confirmButtonText: `Ok`,
                    }).then((result) => {
                        window.location.href="proceso-reserva";
                    });
                <?php else: ?>
                    window.location.href="signin";
                <?php endif; ?>
            }
        });
    }

    function ConvertTime (time) {
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
        if (time.length > 1) {
            time = time.slice (1,2);
            time[1] = +time[0] < 12 ? ' am' : ' pm';
            time[0] = +time[0] % 12 || 12;
        }
        return time.join ('');
    }

    function ResponsiveCalendar(x){
        days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        var html=new Array();

        $.each(days, function( key, value ) {
            if (x.matches) {
            html.push('<p>'+value.slice(0,2)+'</p>');
            } else {
            html.push('<p>'+value+'</p>');
            }
        });

        $(".namesday").html(html);
    }

</script>
</body>

</html>