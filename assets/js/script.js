/**
 * Conj Lite scripts & custom methods
 *
 * @since       1.2.0
 * @package     conj-lite
 * @author      MyPreview (Github: @mahdiyazdani, @mypreview)
 */
(function( window, $, undefined ) {
    'use strict';

    var conjLite = {
        cache: function() {
            conjLite.els = {};
            conjLite.vars = {};
            // No DOM cache
            conjLite.vars.is_rtl = ( 'undefined' !== typeof conj_lite_vars )  ?  conj_lite_vars.is_rtl  :  null;
            conjLite.vars.is_mobile = ( 'undefined' !== typeof conj_lite_vars )  ?  conj_lite_vars.is_mobile  :  null;
            // DOM cache
            conjLite.els.offcanvas = $( '#handheld-offcanvas' );
            conjLite.els.handheld = $( '#handheld-slinky-menu' );
            conjLite.els.iframes = $( 'iframe[src*="youtube"], iframe[src*="vimeo"], iframe[src*="dailymotion"], iframe[src*="soundcloud"], iframe[src*="mixcloud"], iframe[src*="google.com/maps"]' );
        },

        ready: function() {
            conjLite.cache();
            conjLite.load();
        },

        // Run on page load
        load: function() {
            // Call for methods
            conjLite.iframeFitVids();

            if ( conjLite.els.offcanvas.length ) {
                conjLite.initOffcanvas();
            } // End If Statement
        },

        // Initializing accesible offcanvas
        initOffcanvas: function() {
            conjLite.els.offcanvas.offcanvas( {
                resize: ! conjLite.vars.is_mobile,
                closeButtonClass: 'close-btn',
                triggerButton: '.js-handheld-offcanvas-toggler',
                modifiers: conjLite.vars.is_rtl  ?  'right,overlay,push'  :  'left,overlay,push',
                onInit: function() {
                    conjLite.initSlinky( conjLite.els.handheld );
                }
            } );
        },

        // Initializing slinky nav
        initSlinky: function( element ) {
            element.find( '> div' ).slinky( {
                resize: true,
                title: true
            } );
        },

        // Initialize `fitVids` to display fluid width video embeds.
        iframeFitVids: function() {
            if ( ! conjLite.els.iframes.parents( '.wp-has-aspect-ratio' ).length ) {
                conjLite.els.iframes.parent().fitVids();
            } // End If Statement
        }

    };

    $( document ).ready( conjLite.ready() );

} )( this, jQuery );