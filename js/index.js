$(document).ready(function() {
  var key = location.pathname.split("/")[1];
  if (key.length > 0) {
    get(key);
  }
  $("#dynhostname").text(location.hostname + "/");
	$("#homelink").attr("href","http://"+location.hostname);
});
function checkRecaptcha() {
  res = $("#g-recaptcha-response").val();

  if (res == "" || res == undefined || res.length == 0) return false;
  else return true;
}

var xmlHTTP = new XMLHttpRequest();

$("form").submit(function(e) {
  var postData = $(this).serializeArray();
  var formURL = $(this).attr("action");
  if (!checkRecaptcha()) {
    $("#novaild").show();
    return false;
  }
  $.ajax({
    url: formURL,
    type: "POST",
    data: postData,
    success: function(data, textStatus, jqXHR) {
      if (data == "FALSE") {
        $("#customurl").addClass("form-control-warning");
        $("#customdiv").addClass("has-danger");
        $(".form-control-feedback").show();
      } else {
        $(".alert-success").show();
        var workingurl = location.hostname + "/" + data;
        $("#successurl").text(workingurl);
        $("#successurl").attr("href", data);
      }
    }
  });
  e.preventDefault(); //STOP default action
  e.unbind(); //unbind. to stop multiple form submit.
});

function get(key) {
  xmlHTTP.open("GET", "get.php?linkkey=" + key, true);
  xmlHTTP.send();
  xmlHTTP.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#input").val(xmlHTTP.responseText);
    }
  };
}