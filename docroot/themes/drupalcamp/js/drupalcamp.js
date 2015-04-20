(function ($, Drupal) {

  Drupal.behaviors.inputButton = {
    attach: function (context, settings) {
      $('link[href="//cdn-images.mailchimp.com/embedcode/classic-081711.css"]').remove();
    }
  };

})(jQuery, Drupal);
