/*============================================================
  Robert's Book Store — shared POS logic
  Used by: fiction.php, classics.php, scifi.php,
           mystery.php, nonfiction.php
============================================================ */

$(function () {
    // Discount rate per radio value
    var DISCOUNT_RATES = {
        senior: 0.20,
        card: 0.10,
        employee: 0.15,
        none: 0
    };

    var items = [];          // saved order lines
    var selectedIndex = -1;  // row picked from the order list (for UPDATE)

    // ---------- Helpers ----------
    function money(n) {
        return n.toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function round2(n) {
        return Math.round(n * 100) / 100;
    }

    function showMsg(text, type) {
        $("#order_msg").html(
            '<div class="alert alert-' + (type || "danger") + ' py-2 mb-2">' + text + "</div>"
        );
    }

    function clearMsg() {
        $("#order_msg").empty();
    }

    function discountType() {
        return $('input[name="discount"]:checked').val() || "none";
    }

    // Reads the item fields; returns null (and shows why) if they're invalid
    function readItem() {
        var name = $("#item_name").val().trim();
        var qty = Number($("#qty").val());
        var price = Number($("#price").val());

        if (!name) { showMsg("Enter the name of the item."); return null; }
        if (!Number.isInteger(qty) || qty <= 0) { showMsg("Quantity must be a whole number greater than 0."); return null; }
        if (!(price > 0)) { showMsg("Price must be greater than 0."); return null; }

        var type = discountType();
        var gross = qty * price;
        var discount = round2(gross * DISCOUNT_RATES[type]);
        return {
            name: name,
            qty: qty,
            price: price,
            type: type,
            discount: discount,
            amount: round2(gross - discount)
        };
    }

    // ---------- Live per-item computation ----------
    function updateItemPreview() {
        var qty = Number($("#qty").val());
        var price = Number($("#price").val());
        if (qty > 0 && price > 0) {
            var gross = qty * price;
            var discount = round2(gross * DISCOUNT_RATES[discountType()]);
            $("#disc_amount").val(money(discount));
            $("#discounted_amount").val(money(gross - discount));
        } else {
            $("#disc_amount, #discounted_amount").val("");
        }
    }

    function updateTotals() {
        var totalQty = 0, totalDisc = 0, totalAmount = 0;
        $.each(items, function (_, it) {
            totalQty += it.qty;
            totalDisc += it.discount;
            totalAmount += it.amount;
        });
        $("#total_qty").val(items.length ? totalQty : "");
        $("#total_disc").val(items.length ? money(totalDisc) : "");
        $("#total_disc_amount").val(items.length ? money(totalAmount) : "");
        $("#change").val("");
        return round2(totalAmount);
    }

    function renderList() {
        var $body = $("#order_list tbody").empty();
        if (!items.length) {
            $body.append('<tr class="empty-row"><td colspan="6">No items saved yet.</td></tr>');
            return;
        }
        $.each(items, function (i, it) {
            var $row = $("<tr>").attr("data-index", i).toggleClass("table-active", i === selectedIndex);
            $row.append($("<td>").text(i + 1));
            $row.append($("<td>").text(it.name));
            $row.append($("<td>").text(it.qty));
            $row.append($("<td>").text(money(it.price)));
            $row.append($("<td>").text(money(it.discount)));
            $row.append($("<td>").text(money(it.amount)));
            $body.append($row);
        });
    }

    function clearItemFields() {
        $("#item_name, #qty, #price, #disc_amount, #discounted_amount").val("");
        $('input[name="discount"][value="none"]').prop("checked", true);
        selectedIndex = -1;
    }

    function refresh() {
        updateTotals();
        renderList();
    }

    // ---------- Form events ----------
    $("#qty, #price").on("input", updateItemPreview);
    $('input[name="discount"]').on("change", updateItemPreview);
    $("#cash_given").on("input", function () { $("#change").val(""); });

    // Clicking a book cover fills in its name and price
    $(".pic_option").css("cursor", "pointer").on("click", function () {
        var name = $(this).find(".book_title").text();
        var price = Number($(this).find(".book_price").text().replace(/[^\d.]/g, ""));
        selectedIndex = -1;
        renderList();
        $("#item_name").val(name);
        $("#price").val(price);
        if (!(Number($("#qty").val()) > 0)) $("#qty").val(1);
        updateItemPreview();
        clearMsg();
        $("html, body").animate({ scrollTop: $(".order-section").offset().top - 20 }, 300);
    });

    // Clicking a saved row loads it back into the form for UPDATE
    $("#order_list").on("click", "tbody tr[data-index]", function () {
        selectedIndex = Number($(this).attr("data-index"));
        var it = items[selectedIndex];
        $("#item_name").val(it.name);
        $("#qty").val(it.qty);
        $("#price").val(it.price);
        $('input[name="discount"][value="' + it.type + '"]').prop("checked", true);
        updateItemPreview();
        renderList();
        showMsg("Editing item #" + (selectedIndex + 1) + ". Change the fields, then press UPDATE.", "info");
    });

    // ---------- Action buttons ----------
    $("#btn_save").on("click", function () {
        var item = readItem();
        if (!item) return;
        items.push(item);
        clearItemFields();
        refresh();
        showMsg("Saved <b>" + $("<span>").text(item.name).html() + "</b> to the order.", "success");
    });

    $("#btn_update").on("click", function () {
        if (selectedIndex < 0) {
            showMsg("Click an item in the order list first, then press UPDATE.");
            return;
        }
        var item = readItem();
        if (!item) return;
        var n = selectedIndex + 1;
        items[selectedIndex] = item;
        clearItemFields();
        refresh();
        showMsg("Updated item #" + n + ".", "success");
    });

    $("#btn_new").on("click", function () {
        items = [];
        clearItemFields();
        $("#cash_given").val("");
        refresh();
        clearMsg();
        $("#item_name").trigger("focus");
    });

    $("#btn_calculate").on("click", function () {
        if (!items.length) {
            showMsg("Save at least one item before calculating change.");
            return;
        }
        var total = updateTotals();
        var cash = Number($("#cash_given").val());
        if (!(cash > 0)) {
            showMsg("Enter the cash given.");
            return;
        }
        if (cash < total) {
            showMsg("Insufficient cash: P" + money(cash) + " given, P" + money(total) + " due.");
            return;
        }
        $("#change").val(money(round2(cash - total)));
        clearMsg();
    });

    // ---------- Calculator ----------
    var TARGET_LABELS = { qty: "Quantity", price: "Price", cash_given: "Cash Given" };
    var calcTarget = null;
    var $display = $("#calc_display");

    // Remember the last input field the user was on; ENTER sends the result there
    $("#qty, #price, #cash_given").on("focus", function () {
        calcTarget = this.id;
        $("#calc_target").text("→ " + TARGET_LABELS[calcTarget]);
    });

    function isOperator(ch) {
        return "+-*/".indexOf(ch) !== -1;
    }

    // Evaluates "num op num op ..." with * and / before + and -, without eval()
    function evaluate(expr) {
        var tokens = expr.match(/\d*\.?\d+|\d+\.|[+\-*/]/g);
        if (!tokens) return null;
        if (tokens[0] === "-") tokens.unshift("0");

        var terms = [Number(tokens[0])];
        var ops = [];
        for (var i = 1; i < tokens.length; i += 2) {
            var op = tokens[i];
            var num = Number(tokens[i + 1]);
            if (isNaN(num)) return null;
            if (op === "*") terms[terms.length - 1] *= num;
            else if (op === "/") {
                if (num === 0) return null;
                terms[terms.length - 1] /= num;
            } else {
                ops.push(op);
                terms.push(num);
            }
        }
        var result = terms[0];
        for (var j = 0; j < ops.length; j++) {
            result = ops[j] === "+" ? result + terms[j + 1] : result - terms[j + 1];
        }
        return round2(result);
    }

    $(".calc-grid .btn").not(".btn-enter").on("click", function () {
        var key = $(this).text();
        var expr = $display.val();
        if (expr === "Error") expr = "";
        var last = expr.slice(-1);

        if (isOperator(key)) {
            if (expr === "" && key !== "-") return;
            if (isOperator(last)) expr = expr.slice(0, -1);
        } else if (key === ".") {
            var current = expr.split(/[+\-*/]/).pop();
            if (current.indexOf(".") !== -1) return;
            if (current === "") key = "0.";
        }
        $display.val(expr + key);
    });

    $(".calc-grid .btn-enter").on("click", function () {
        var expr = $display.val().replace(/[+\-*/.]$/, "");
        if (!expr || expr === "Error") return;
        var result = evaluate(expr);
        if (result === null) {
            $display.val("Error");
            return;
        }
        $display.val(String(result));
        if (calcTarget) {
            var value = calcTarget === "qty" ? Math.round(result) : result;
            $("#" + calcTarget).val(value).trigger("input");
        }
    });

    $("#calc_clear").on("click", function () {
        $display.val("");
    });

    refresh();
});
