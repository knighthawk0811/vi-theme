/**
 * File meta_box.js.
 *
 * Adds functionality to the custom post meta box
 *
 * used for the secondary featured images
 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
 */

/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('#vi-secondary-image-button').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: featured_image_02.title,
            button: { text:  featured_image_02.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#vi-secondary-image-id').val(media_attachment.id);
            $("#vi-secondary-image").attr("src",media_attachment.url);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });
    // Runs when the image button is clicked.
    $('#vi-secondary-image-button-remove').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // Sends the attachment URL to our custom image input field.
        $('#vi-secondary-image-id').val(0);
        $("#vi-secondary-image").attr("src",0);

    });
});