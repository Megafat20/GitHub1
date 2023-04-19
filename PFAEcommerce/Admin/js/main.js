$(document).ready(function () {
  

  $(".login-btn").on("click", function () {
    $.ajax({
      url: "/Admin/classes/Credentials.php",
      method: "POST",
      data: $("#admin-login-form").serialize(),
      success: function (response) {
        console.log(response);
        var resp = $.parseJSON(response);
        if (resp.status == 202) {
          $("#admin-register-form").trigger("reset");
          //$(".message").html('<span class="text-success">'+resp.message+'</span>');
          window.location.href =
            window.origin + "/PFAEcommerce/Admin/Administrateur.php";
        } else if (resp.status == 303) {
          $(".message").html(
            '<span class="text-danger">' + resp.message + "</span>"
          );
        }
      },
    });
  });
});
