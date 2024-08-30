/*!
 * Filter Everything common admin 1.8.6
 */
(function($) {
    "use strict";

    $(document).ready(function (){
        let wpcUserAgent = navigator.userAgent.toLowerCase();
        let wpcIsAndroid = wpcUserAgent.indexOf("android") > -1;
        let wpcAllowSearchField = 0;
        if(wpcIsAndroid) {
            wpcAllowSearchField = Infinity;
        }

        // Common JS code
        $(document).on('click', '#show_bottom_widget', function (e){
            if ( $(this).is(':checked') ) {
                $('#show_open_close_button').parent('label').addClass('wpc-inactive-settings-field');
                $('.wpc-bottom-widget-compatibility').addClass('wpc-opened');
            } else {
                $('#show_open_close_button').parent('label').removeClass('wpc-inactive-settings-field');
                $('.wpc-bottom-widget-compatibility').removeClass('wpc-opened');
            }
        });

        $(document).on('click', '#use_color_swatches', function (e){
            if ( $(this).is(':checked') ) {
                $('.wpc-color-swatches-taxonomies').addClass('wpc-opened');
            } else {
                $('.wpc-color-swatches-taxonomies').removeClass('wpc-opened');
            }
        });

        $('#wpc_primary_color').wpColorPicker({
            defaultColor: '',
            palettes: [ '#0570e2', '#f44336', '#E91E63', '#007cba', '#65BC7B', '#FFEB3B', '#FFC107', '#FF9800', '#607D8B'],
        });

        $('#wpc_term_color').wpColorPicker({
            defaultColor: '',
            palettes: [ '#0000FF', '#808080', '#008000', '#FF0000', '#FFFF00', '#FFA500', '#00bfff', '#7F00FF', '#FFFFFF'],
        });

        $('.wpc-help-tip').tipTip({
            'attribute': 'data-tip',
            'fadeIn':    50,
            'fadeOut':   50,
            'delay':     200,
            'keepAlive': true,
            'maxWidth': "220px",
        });

        $( '.wpc-sortable-table' ).sortable({
            items: "tr.pro-version.wpc-sortable-row",
            delay: 150,
            placeholder: "wpc-filter-field-shadow",
            refreshPositions: true,
            cursor: 'move',
            handle: ".wpc-order-sortable-handle-icon",
            axis: 'y',
            update: function( event, ui ) {
                renderTableOrder();
            },

        });

        $(document).on( 'click', '.free-version .wpc-field-sortable-handle', function (){
            alert( wpcFiltersAdminCommon.prefixesOrderAvailableInPro );
        });

        $("#show_terms_in_content").select2({
            width: '80%',
            placeholder: wpcFiltersAdminCommon.chipsPlaceholder,
            minimumResultsForSearch: wpcAllowSearchField,
            tags: true
        });

        $("#color_swatches_taxonomies").select2({
            width: '80%',
            placeholder: wpcFiltersAdminCommon.colorSwatchesPlaceholder,
            minimumResultsForSearch: wpcAllowSearchField,
            tags: false,
        });

        $('body').on('click', '.wpc-notice-dismiss', function (e){
            e.preventDefault();

            let requestParams      = {};
            requestParams._wpnonce = $(this).data('nonce');
            let dismissAction      = $(this).data('action');

            wp.ajax.post( dismissAction, requestParams )
                .always( function( response ) {
                    // $spinner.removeClass( 'is-active' );
                    var $el = $( '.license-notice' );
                    $el.fadeTo( 100, 0, function() {
                        $el.slideUp( 100, function() {
                            $el.remove();
                        });
                    });
                })
        });

        // on upload button click
        $( document ).on( 'click', '.wpc-upload', function( event ){

            event.preventDefault(); // prevent default link click and page refresh

            const button = $(this)
            const imageId = button.next().next().val();

            const customUploader = wp.media({
                title: 'Insert image', // modal window title
                library : {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type : 'image'
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false
            }).on( 'select', function() { // it also has "open" and "close" events
                const attachment = customUploader.state().get( 'selection' ).first().toJSON();
                button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
                button.next().show(); // show "Remove image" link
                button.next().next().val( attachment.id ); // Populate the hidden field with image ID
            })

            // already selected images
            customUploader.on( 'open', function() {

                if( imageId ) {
                    const selection = customUploader.state().get( 'selection' )
                    let attachment = wp.media.attachment( imageId );
                    attachment.fetch();
                    selection.add( attachment ? [attachment] : [] );
                }

            })

            customUploader.open()
        });

        // on remove button click
        $( document ).on( 'click', '.wpc-remove', function( event ){
            wpcHideTheRemoveButton( $(this) );
        });

        $( document ).ajaxSuccess( function(e, request, settings) {
            let params = new URLSearchParams( settings.data );
            let action = params.get('action');

            if( action === 'add-tag' ){
                // clear form
                $("#wpc_term_img, #wpc_term_color").val('');
                $(".wpc-remove").hide();
                wpcHideTheRemoveButton( $("a.wpc-remove") );

                $(".wpc-color-picker .wp-picker-clear").trigger('click');
            }
            // else {
            //     console.log( settings.data );
            // }
        });


    }); // End $(document).ready();

    $(document).on('click', '.wpc-error.is-dismissible > .notice-dismiss', function (e){
            e.preventDefault();

            let $button = $( this );
            let $el = $button.parent('.wpc-error');

            $el.fadeTo( 100, 0, function() {
                $el.slideUp( 100, function() {
                    $el.remove();
                });
            });
            $el.append( $button );
    });

    function renderTableOrder()
    {
        let num = 0;
        $("tr.wpc-sortable-row").each( function ( index, element ) {
            num = (index + 1);
            $(element).find('.wpc-order-td').text(num);
        });
    }

    function wpcHideTheRemoveButton( element ){
        // event.preventDefault();
        const button = element; //$(this);
        button.next().val( '' ); // emptying the hidden field
        button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
    }

})(jQuery);