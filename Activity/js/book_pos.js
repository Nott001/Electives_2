/*============================================================
  Robert's Book Store — order form glue
  Used by: fiction.php, classics.php, scifi.php,
           mystery.php, nonfiction.php
  All calculations happen in PHP (includes/book_pos.php);
  this only fills in fields and submits the form.
============================================================ */

$(function () {
    var $form = $("#order_form");

    // Asks PHP to recompute the Discount Amount / Discounted Amount
    function preview() {
        $form.find(".default-submit").trigger("click");
    }

    // Clicking a book cover fills in its name and price
    $(".pic_option").css("cursor", "pointer").on("click", function () {
        var name = $(this).find(".book_title").text();
        var price = Number($(this).find(".book_price").text().replace(/[^\d.]/g, ""));
        $("#item_name").val(name);
        $("#price").val(price);
        if (!(Number($("#qty").val()) > 0)) $("#qty").val(1);
        preview();
    });

    $('input[name="discount"]').on("change", preview);

    // Clicking anywhere on a saved row selects it for UPDATE
    $("#order_list").on("click", "tbody tr", function (e) {
        if (!$(e.target).is(".select-row")) $(this).find(".select-row").trigger("click");
    });
});
