( function( $ ) {
    // ズーム倍率
    wp.customize( 'yoake_image_zoom', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--yoake-image-zoom', newval);
        });
    });
    // パン位置X
    wp.customize( 'yoake_image_pan_x', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--yoake-image-pan-x', newval);
        });
    });
    // パン位置Y
    wp.customize( 'yoake_image_pan_y', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--yoake-image-pan-y', newval);
        });
    });
} )( jQuery );
