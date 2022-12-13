$(document).ready(function () {
    //when click plus button
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        //  $price=$parentNode.find('#pizzaPrice').val();
        $price = Number(
            $parentNode.find("#pricePizza").html().replace("MMK", "")
        );

        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " MMK");

        summaryCalculation();
    });

    //when click minus button
    $(".btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number(
            $parentNode.find("#pricePizza").html().replace("MMK", "")
        );
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " MMK");

        summaryCalculation();
    });

    //calculate final price
    function summaryCalculation() {
        //total
        $totalPrice = 0;
        $("#orderTable tbody tr").each(function (index, row) {
            $totalPrice += Number(
                $(row).find("#total").text().replace("MMK", "")
            );
        });
        $("#subTotalPrice").html(`${$totalPrice} MMK`);
        $("#finalPrice").html(`${$totalPrice + 3000} MMK`);
    }
});
