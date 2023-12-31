$(document).ready(function () {
    var form = "#create-form";

    $(form).on("submit", function (event) {
        event.preventDefault();
        var url = $(this).attr("data-action");
        console.log(url);
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $(form).trigger("reset");
                alert(response.success);
            },
            error: function (response) {},
        });
    });
});
