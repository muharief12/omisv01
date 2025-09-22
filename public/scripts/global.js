$(() => {
    $("[data-expand]").on("click", function (e) {
        $(this).children("img").toggleClass("-rotate-180");
        let target = $(`#${$(this).data("expand")}`);
        target.slideToggle();
    });

    // Toggle manual payment details
    $("input[name=type]").on("change", function (e) {
        let target = $("#QRISPaymentDetail");
        if ($(this).is(":checked") && $(this).attr("id") == "QRISMethod")
            target.show();
        else target.hide();
    });
});
