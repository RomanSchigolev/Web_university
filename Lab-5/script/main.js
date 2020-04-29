$(document).ready(function() {

  // Модальное окно для товара
  $(document).on("click", ".view", function(event) {
    event.preventDefault();
    const product_id = $(this).attr("id");
    let options = {
      ajaxPrefix: "",
      ajaxData: {
        product_id
      },
      ajaxComplete: function() {
        this.buttons([{
          type: Dialogify.BUTTON_PRIMARY
        }]);
      }
    };
    new Dialogify("./modalProduct.php", options)
      .title("О товаре")
      .showModal();
  });

  // Сортировка таблицы
  $(document).on("click", ".column_title-link", function() {
    const columnName = $(this).attr("id");
    let order = $(this).data("order");
    let arrow = "";
    order == "DESC" ? arrow = "&nbsp;<span class='arrowOrder'>&darr;</span>" : arrow = "&nbsp;<span class='arrowOrder'>&uarr;</span>"
    $.ajax({
      url: "./fetch_productList.php",
      method: "POST",
      cache: false,
      data: {
        columnName,
        order
      },
      success: function(data) {
        $("#main_table").html(data);
        $(`#${columnName}`).append(arrow);
        $(`#${columnName}`).toggleClass("cellFill");
      }
    })
  });
});