(function ($, Drupal) {

  $.fn.datacheck = function() {
      // alert("working");
      // $("#custom-user-details-form").submit();

      $(document).ready(function() {
              //     $(".form-text").blur(function(){
              //       alert("This input field has lost its focus.");
              //     });
              // Get references to the checkbox and permanent address fields
              var checkbox = $('#edit-same-address');
              var permanentAddressFields = $('.form-item-permanent-address');

              // Hide permanent address fields on page load if checkbox is checked
              if (checkbox.is(':checked')) {
                permanentAddressFields.hide();
              }

              // Attach a change event listener to the checkbox
              checkbox.on('change', function() {
                // If checkbox is checked, hide the permanent address fields
                if ($(this).is(':checked')) {
                  permanentAddressFields.hide();
                } else {
                  // If checkbox is unchecked, show the permanent address fields
                  permanentAddressFields.show();
                }
              });
            });

  };

}(jQuery, Drupal));

// (function ($, Drupal, drupalSettings) {
//   Drupal.behaviors.myModuleBehavior = {
//     attach: function (context, settings) {
//       // Access the variable passed from PHP.
//       var vari_body1 = drupalSettings.shrey_exercise.vari_body;
//       alert(vari_body1)
//       $('body').css('background',vari_body1);
//     }
//   };
// })(jQuery, Drupal, drupalSettings);
