jQuery(document).ready(function ($) {

    function ahadMain() {

        // doNothing function is for enabling hoverIntent to work with two layers.
        function doNothing() {
        }

        // Show the Admin Bar
        function adminBarIn() {
            $('#wpadminbar').animate({'top': '0px'}, ahab['ahab_anim_speed']);
            $('body').animate({'margin-top': '0px'}, ahab['ahab_anim_speed']);
            $('body').animate({'background-position-y': '0px'}, ahab['ahab_anim_speed']);
            if ('twentyfourteen' == themeName) {
                $('.admin-bar.masthead-fixed .site-header').animate({'top': '32px'}, ahab['ahab_anim_speed'])
            }
        }

        // Hide the Admin Bar
        function adminBarOut() {
            if (windowSize > 782) {
                $('#wpadminbar').animate({'top': '-32px'}, ahab['ahab_anim_speed']);
                $('body').animate({'margin-top': '-32px'}, ahab['ahab_anim_speed']);
                $('body').animate({'background-position-y': '-32px'}, ahab['ahab_anim_speed']);
                if ('twentyfourteen' == themeName) {
                    $('.admin-bar.masthead-fixed .site-header').animate({'top': '0px'}, ahab['ahab_anim_speed'])
                }
            }
            else {
                if (1 == ahabMobile) {
                    $('#wpadminbar').animate({'top': '-46px'}, ahab['ahab_anim_speed']);
                    $('body').animate({'margin-top': '-46px'}, ahab['ahab_anim_speed']);
                    $('body').animate({'background-position-y': '-46px'}, ahab['ahab_anim_speed']);
                    if ('twentyfourteen' == themeName) {
                        $('.admin-bar.masthead-fixed .site-header').animate({'top': '-46px'}, ahab['ahab_anim_speed'])
                    }
                }
            }
        }

        // check if page is in iframe & user is logged in - if so, customizer is active
        var isInIframe = (window.location != window.parent.location) ? true : false;
        if (!isInIframe && ($('#wpadminbar').length === 1)) {

            var themeName = ahab['theme_name'];
            var windowSize = $(window).width();
            var ahabMobile = ahab['ahab_mobile'];

            if (windowSize > 782) {
                $('#wpadminbar').css('top', '-32px');
                $('body').css('margin-top', '-32px');
                if ('twentyfourteen' == themeName) {
                    $('.admin-bar.masthead-fixed .site-header').css('top', '0px');
                }

            }
            else {
                if (1 == ahabMobile) {
                    $('#wpadminbar').css('z-index', '99999 !important');
                    $('#wpadminbar').css('cssText', 'z-index: 99999 !important; top: -46px;');
                    $('body').css('margin-top', '-46px');
                }
                else {
                    $('#wpadminbar').css('top', '0px');
                    $('body').css('margin-top', '0px');
                }
            }

            if ($('#hiddendiv').length == 0) {
                $('body').append('<div id=\'hiddendiv\'></div>');
            }

            autohide = $(this).find('#hiddendiv');
            autohide.css('width', '100%');
            if ((windowSize < 782) && (1 == ahabMobile)) {
                autohide.css('min-height', '46px');
            }
            else {
                autohide.css('min-height', '32px');
            }
            autohide.css('z-index', '99998'); // admin bar is at z-index: 99999;
            autohide.css('position', 'fixed');
            autohide.css('top', '0px');

            var configIn = {
                over       : adminBarIn, // function = onMouseOver callback (REQUIRED)
                sensitivity: 6,
                out        : doNothing // function = onMouseOut callback (REQUIRED)
            };
            var configOut = {
                over    : doNothing, // function = onMouseOver callback (REQUIRED)
                timeout : ahab['ahab_delay'], // number = milliseconds delay before onMouseOut
                interval: ahab['ahab_interval'], // number = millseconds interval for mouse polling
                out     : adminBarOut // function = onMouseOut callback (REQUIRED)
            };

            autohide.hoverIntent(configIn);
            $('#wpadminbar').hoverIntent(configOut);
        }

        // do something when key pressed - using jquery.hotkeys.js library
        // https://github.com/jeresig/jquery.hotkeys
        // and it's included in WordPress :)

        // build string for hotkey to add
        var hotKey = new Array();

        if (ahab['ahab_keyboard_alt'] == 'Alt') {
            hotKey.push('alt')
        }

        if (ahab['ahab_keyboard_ctrl'] == 'Ctrl') {
            hotKey.push('ctrl')
        }

        if (ahab['ahab_keyboard_shift'] == 'Shift') {
            hotKey.push('shift')
        }

        if (ahab['ahab_keyboard_char']) {
            hotKey.push(ahab['ahab_keyboard_char'])
        }

        $.hotkeys.add(hotKey.join('+'), function () {

            if ($('#wpadminbar').css('top') == '0px') {
                adminBarOut()
            }
            else {
                adminBarIn();
            }
        });
    }

    $(document).ready(ahadMain);
    $(window).on('resize', ahadMain);
});