var currentStep = 1;

$(document).ready( function () {
  $(".next-step").click( function () {
    $(".step-container .step-separator[data-step='" + currentStep + "']").addClass('active');

    currentStep++;

    $(".step-container .step[data-step='" + currentStep + "']").addClass('active');

  });
})