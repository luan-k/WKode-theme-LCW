jQuery(document).ready(function ($) {
  // Replace 'number_field' with the unique name you gave to the ACF Number field
  const numberInput = $("#used_price_number_field_admin input");
  if (numberInput) {
    console.log(numberInput);

    numberInput.on("input", function (e) {
      // Remove dots and commas from the input value
      var sanitizedValue = $(this).val().replace(/[.,]/g, "");

      // Update the input value with the sanitized value
      $(this).val(sanitizedValue);
    });
  }
});
