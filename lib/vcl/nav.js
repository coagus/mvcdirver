function show(controller, action, result, request) {
  request = request == '' ? '' : '&' + request;

  $.ajax({
    data: 'controller=' + controller + '&action=' + action + request,
    url: 'lib/vcl/driver.php',
    type: 'post',
    beforeSend: function() {
      $(result).html("Procesando, espere por favor...");
    },
    success: function(response) {
      $(result).html(response);
    }
  });
}
