$(function() {

    $("#trade-form").submit(function(e) {
        e.preventDefault();
        var values = $("#trade-form").serialize();

        var coin = $("#coin").val();
        var amount = $("#amount").val();
        var price = $("#price").val();
        var difference = $("#difference").val();

        $("#trade-form")[0].reset();
        $('#trade-table tbody').prepend("<tr><td>"+ coin + "</td><td>" + amount + "</td><td>" + price + "</td><td>" + difference + "</td><td>Just now...</td></tr>");
        $('#trade-table tr:last').remove();

        $.ajax({
            type: "POST",
            url: "trade-handler.php",
            data: values,
            success: function(data) {
                tradeToast();
            },
            error: function () {
                alert("FAILURE");
            }
        });

    });
});

function tradeToast() {
    var x = document.getElementById("toast_new_info");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}