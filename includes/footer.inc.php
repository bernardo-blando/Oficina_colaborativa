<!-- jquery, popper and bootstrap js -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<script src="js/calendar.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<!-- <script src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>-->
<!-- swiper js -->
<script src="vendor/swiper/js/swiper.min.js"></script>

<!-- template custom js -->
<script src="js/main.js"></script>

<!-- page level script -->
    <script>
        $(window).on('load', function() {
            /* swiper slider carousel */
            var swiper = new Swiper('.small-slide', {
                slidesPerView: 'auto',
                spaceBetween: 0,
            });

            var swiper = new Swiper('.news-slide', {
                slidesPerView: 5,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    },
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    }
                }
            });

            /* notification view and hide*/
            setTimeout(function() {
                $('.notification').addClass('active');
                setTimeout(function() {
                    $('.notification').removeClass('active');
                }, 3500);
            }, 500);
            $('.closenotification').on('click', function() {
                $(this).closest('.notification').removeClass('active')
            });
        });
	
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            effect: 'fade',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

    
    </script>
	
	<!--<script type="text/javascript"> 
        $(window).load(function() { 
            $(".carousel .carousel-item").each(function() { 
                var i = $(this).next(); 
                i.length || (i = $(this).siblings(":first")), 
                  i.children(":first-child").clone().appendTo($(this)); 
                
                for (var n = 0; n < 4; n++)(i = i.next()).length || 
                  (i = $(this).siblings(":first")), 
                  i.children(":first-child").clone().appendTo($(this)) 
            }) 
        }); 
    </script> -->

<!-- <script>

    /* Create an array with the values of all the input boxes in a column */
    $.fn.dataTable.ext.order['dom-text'] = function  ( settings, col )
    {
        return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
            return $('input', td).val();
        } );
    }

    /* Create an array with the values of all the input boxes in a column, parsed as numbers */
    $.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
    {
        return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
            return $('input', td).val() * 1;
        } );
    }

    /* Create an array with the values of all the select options in a column */
    $.fn.dataTable.ext.order['dom-select'] = function  ( settings, col )
    {
        return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
            return $('select', td).val();
        } );
    }

    /* Create an array with the values of all the checkboxes in a column */
    $.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
    {
        return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
            return $('input', td).prop('checked') ? '1' : '0';
        } );
    }

    /* Initialise the table with the required column ordering data types*/

    $(document).ready(function() {
        $('#example').DataTable( {
            "columns": [
                null,
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text-numeric" },
                { "orderDataType": "dom-select" },
                { "orderDataType": "dom-text-numeric" }
            ]
        } );
    } );




</script> -->

<script>
    $(function() {
        var isXS = false,
            $accordionXSCollapse = $('.accordion-xs-collapse');

        // Window resize event (debounced)
        var timer;
        $(window).resize(function () {
            if (timer) { clearTimeout(timer); }
            timer = setTimeout(function () {
                isXS = Modernizr.mq('only screen and (max-width: 767px)');

                // Add/remove collapse class as needed
                if (isXS) {
                    $accordionXSCollapse.addClass('collapse');

                    $('.accordion-xs-toggle').show();
                } else {
                    $accordionXSCollapse.removeClass('collapse');

                    $('.accordion-xs-toggle').hide();
                }
            }, 100);
        }).trigger('resize'); //trigger window resize on pageload

        // Initialise the Bootstrap Collapse
        $accordionXSCollapse.each(function () {
            $(this).collapse({ toggle: false });
        });

        // <a href="https://www.jqueryscript.net/accordion/">Accordion</a> toggle click event (live)
        $(document).on('click', '.accordion-xs-toggle', function (e) {
            e.preventDefault();

            var $thisToggle = $(this),
                $targetRow = $thisToggle.parent('.tr'),
                $targetCollapse = $targetRow.find('.accordion-xs-collapse');

            if (isXS && $targetCollapse.length) {
                var $siblingRow = $targetRow.siblings('.tr'),
                    $siblingToggle = $siblingRow.find('.accordion-xs-toggle'),
                    $siblingCollapse = $siblingRow.find('.accordion-xs-collapse');

                $targetCollapse.collapse('toggle'); //toggle this collapse
                $siblingCollapse.collapse('hide'); //close siblings

                $thisToggle.toggleClass('collapsed'); //class used for icon marker
                $siblingToggle.removeClass('collapsed'); //remove sibling marker class
            }
        });
    });
</script>