/**
 * wacp-frontend.js
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.2.1
 */

jQuery(document).ready(function($) {
    "use strict";

    if( typeof yith_wacp == 'undefined' )
        return;


    var popup       = $('#yith-wacp-popup'),
        overlay     = popup.find( '.yith-wacp-overlay'),
        close       = popup.find( '.yith-wacp-close'),
        close_popup = function(){
            // remove class to html
            $('html').removeClass( 'yith_wacp_open' );
            // remove class open
            popup.removeClass( 'open' );
            // after 2 sec remove content
            setTimeout(function () {
                popup.find('.yith-wacp-content').html('').perfectScrollbar('destroy');
            }, 1000);

            $(document).trigger( 'yith_wacp_popup_after_closing' );
        },
        // center popup function
        center_popup = function () {
            var t = popup.find( '.yith-wacp-wrapper'),
                window_w = $(window).width(),
                window_h = $(window).height(),
                width    = ( ( window_w - 60 ) > yith_wacp.popup_size.width ) ? yith_wacp.popup_size.width : ( window_w - 60 ),
                height   = ( ( window_h - 120 ) > yith_wacp.popup_size.height ) ? yith_wacp.popup_size.height : ( window_h - 120 );

            t.css({
                'left' : (( window_w/2 ) - ( width/2 )),
                'top' : (( window_h/2 ) - ( height/2 )),
                'width'     : width + 'px',
                'height'    : height + 'px'
            });
        };



    $( window ).on( 'resize yith_wacp_popup_changed', center_popup );

    $('body').on( 'added_to_cart wacp_single_added_to_cart', function( ev, fragmentsJSON, cart_hash, button ){

        if( typeof fragmentsJSON == 'undefined' )
            fragmentsJSON = $.parseJSON( sessionStorage.getItem( wc_cart_fragments_params.fragment_name ) );

        $.each( fragmentsJSON, function( key, value ) {

            if ( key == 'yith_wacp_message' ) {

                // add content
                var popup_content = popup.find('.yith-wacp-content');
                popup_content.html( value );

                // check if popup is still open, if yes, update it.
                if( popup.hasClass('open') ) {

                    // update scroll
                    if( typeof $.fn.perfectScrollbar != 'undefined' ) {
                        popup_content.perfectScrollbar('update');
                    }
                    // then scroll to Top
                    popup_content.scrollTop(0);

                    $(document).trigger( 'yith_wacp_popup_changed', [ popup ] );
                }
                else {
                    $(document).trigger( 'yith_wacp_popup_before_opening', [ popup ] );

                    // init action in popup
                    init_action_popup();

                    // position popup
                    center_popup();

                    //scroll
                    if( typeof $.fn.perfectScrollbar != 'undefined' ) {
                        popup.find('.yith-wacp-content').perfectScrollbar({
                            suppressScrollX : true
                        });
                    }

                    if( yith_wacp.is_mobile ) {
                        // add class to html for prevent page scroll on mobile device
                        $('html').addClass( 'yith_wacp_open' );
                    }
                    popup.addClass('open');

                    $(document).trigger( 'yith_wacp_popup_after_opening', [ popup ] );
                }

                return false;
            }
        });
    });

    popup.on( 'click', 'a.continue-shopping', function (e) {
        if( $(this).attr('href') != '#' ) {
            return;
        }
        e.preventDefault();
        close_popup();
    });

    // Close box trigger
    overlay.on( 'click', close_popup );
    close.on( 'click', function(ev){
        ev.preventDefault();

        close_popup();
    });


    var init_action_popup = function(){
        // remove from cart ajax
        $( document ).on( 'click', '.yith-wacp-remove-cart', function(ev) {
            ev.preventDefault();


            var table = $(this).parents('table'),
                data = {
                    action: yith_wacp.actionremove,
                    item_key: $(this).data('item_key'),
                    context: 'frontend'
                };

            table.block({
                message   : null,
                overlayCSS: {
                    background: '#fff url(' + yith_wacp.loader + ') no-repeat center',
                    opacity   : 0.5,
                    cursor    : 'none'
                }
            });

            $.ajax({
                url: yith_wacp.ajaxurl.toString().replace( '%%endpoint%%', yith_wacp.actionremove ),
                data: data,
                dataType: 'html',
                success: function( res ) {

                    if( res != '' ) {
                        popup.find('.yith-wacp-content').html( res );

                        $(document).trigger( 'yith_wacp_popup_changed', [ popup ] );
                    }
                    else {
                        close_popup();
                    }
                }
            });
        })
    };

    /*######################################
     ADD TO CART AJAX IN SINGLE PRODUCT PAGE
    ########################################*/

    $(document).on( 'submit', yith_wacp.form_selectors, function( ev ) {

        if( typeof wc_cart_fragments_params === 'undefined' || ! yith_wacp.enable_single ) {
            return;
        }

        var $supports_html5_storage,
            $private = false,
            t = $(this),
            button = t.find( 'button[type="submit"]'),
            exclude = t.find( 'input[name="yith-wacp-is-excluded"]' ),
            is_one_click = t.find('input[name="_yith_wocc_one_click"]').val() == 'is_one_click';

        try {
            $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

            window.sessionStorage.setItem( 'wc', 'test' );
            window.sessionStorage.removeItem( 'wc' );
        } catch( err ) {
            $supports_html5_storage = false;
            if ( err.code == DOMException.QUOTA_EXCEEDED_ERR && window.sessionStorage.length == 0) {
                $private = true
            }
        }


        // check if excluded
        if( exclude.length || $private || is_one_click )
            return;

        ev.preventDefault();

        $(document).trigger( 'yith_wacp_adding_cart_single' );

        button.addClass('loading')
            .removeClass('added');

        var form = t.serializeArray();
        // if button as name add-to-cart get it and add to form
        if( button.attr('name') && button.attr('name') == 'add-to-cart' && button.attr('value') ){
            form.push({ name: 'add-to-cart', value: button.attr('value') });
        }
        // add action
        form.push({ name: "action", value: yith_wacp.actionadd }, { name: "context", value: "frontend" } );

        $.ajax({
            url: yith_wacp.ajaxurl.toString().replace( '%%endpoint%%', yith_wacp.actionadd ),
            data: $.param( form ),
            dataType: 'json',
            type: 'POST',
            success: function( res ) {

                // add error notice
                if( res.msg ) {

                    // add mess and scroll to Top
                    t.parents( 'div.product' ).before( res.msg );
                    $('body').animate({
                        scrollTop: 0
                    }, 500);

                    // reset button
                    button.removeAttr( 'disabled')
                        .removeClass( 'loading');

                    return false;
                }

                // refresh fragments
                var $ajax_url,
                    $data_ajax = {
                        product_id: res.prod_id,
                        variation_id: res.variation_id,
                        quantity: res.quantity,
                        ywacp_is_single: 'yes',
                        context: 'frontend'
                    };

                /** Support wc 2.3.x **/
                if( typeof wc_cart_fragments_params.wc_ajax_url !== 'undefined' ) {
                    $ajax_url = wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments');
                }
                else {
                    $ajax_url = wc_cart_fragments_params.ajax_url;
                    $data_ajax.action = 'woocommerce_get_refreshed_fragments';
                }

                $.ajax({
                    url: $ajax_url,
                    type: 'POST',
                    data: $data_ajax,
                    success: function( data ) {
                        if ( data && data.fragments ) {

                            $.each( data.fragments, function( key, value ) {
                                $( key ).replaceWith( value );
                            });

                            if ( $supports_html5_storage ) {
                                sessionStorage.setItem( wc_cart_fragments_params.fragment_name, JSON.stringify( data.fragments ) );
                                sessionStorage.setItem( 'wc_cart_hash', data.cart_hash );
                            }

                            $( 'body' ).trigger( 'wc_fragments_refreshed' )
                                .trigger( 'wacp_single_added_to_cart' );

                            // remove disabled from submit button
                            button.removeAttr( 'disabled')
                                .removeClass( 'loading')
                                .addClass('added');
                        }
                    }
                });
            }
        });
    });


    $(document).on( 'yith_wacp_popup_after_opening yith_wacp_popup_changed', function() {
        if( typeof $.yith_wccl != 'undefined' && typeof $.fn.wc_variation_form != 'undefined' ) {
            // not initialized
            $(document).find( '.variations_form:not(.initialized)' ).each( function() {
                $(this).wc_variation_form();
            });
            $.yith_wccl();
        }

        // compatibility with lazyload
        if( typeof thb_lazyload != 'undefined' ) {
            thb_lazyload.update();
        }

    });
});