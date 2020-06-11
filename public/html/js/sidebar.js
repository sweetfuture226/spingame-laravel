var SidebarMenu = function() {
    var sidebarcontent = function() {
        $('#sidebar_click_btn').on('click', function() {
            $('#sidebar_container').fadeToggle( "fast", function() {
                $('#sidebar_container').toggleClass('open');
                $('.navbar-container').toggleClass('open');
            });
        });

        $('#sidebar_container>.overlay').on('click', function() {
            $('#sidebar_container').fadeOut( "fast", function() {
                $('#sidebar_container').removeClass('open');
                $('.navbar-container').removeClass('open');
            });
        })
    }

    return {
    // public functions
        init: function() {
            sidebarcontent();
        }
    };
}();

jQuery(document).ready(function() {
    SidebarMenu.init();
});
