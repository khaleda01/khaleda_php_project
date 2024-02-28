$(document).ready(function () {
  // Toggle theme
  $(document).on("click", "#themeToggleBtn", function () {
    $("body").toggleClass("dark-mode");
  });

  //Listining

  // Form submission
  $(document).on("submit", "form", function (event) {
    event.preventDefault();
    let form = $(this).closest("form");
    formSubmit(form[0]);
  });

  // Link actions
  $(document).on("click", "a", function (event) {
    let target = $(this);
    if (target.closest("a") && target.attr("data-disabled") !== "true") {
      let loading = $("#loading");

      let url = target.attr("href");
      include(event, url);
    }
  });

  // Include function
  function include(event, url) {
    event.preventDefault();
    let breadcrumb = $("#lastBreadCrumb");
    let container = $(".main_content");
    let loading = $("#loading");
    let loadingAnimation = `
    <div class="sk-chase">
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
    </div>
`;
    let breadCrumbValue = url
      .split("/")
      .pop()
      .split(".")
      .slice(0, -1)
      .join("")
      .replace(/_/g, " ")
      .replace(/\b\w/g, (char) => char.toUpperCase());

    $.ajax({
      url: url,
      type: "POST",
      beforeSend: function () {
        container.html("");
        loading.html(loadingAnimation);
      },
      success: function (response) {
        loading.html("");
        container.html(response);
        breadcrumb.text(breadCrumbValue);
      },
      error: function () {
        loading.text("Error");
      },
    });
  }

  // Form submission
  function formSubmit(form) {
    let formData = new FormData(form);
    let loading = $("#loading");
    let responseContainer = $("#response");
    responseContainer.html("Submitting...");
    // for (const entry of formData.entries()) {
    //   console.log(entry[0], entry[1]);
    // }
    $.ajax({
      url: "formServer.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        form.querySelector('[type ="submit"]').setAttribute("disabled", "");
      },
      success: function (response) {
        swal({
          title: "Congratulations!",
          text: response,
          icon: "success",
          button: "Ok!",
        });
        responseContainer.html("");
        form.querySelector('[type ="submit"]').removeAttribute("disabled");
      },
      error: function () {
        console.error("AJAX request failed.");
      },
    });
  }

  //product information Table colum hide

  $(document).on("load", "#product_information_table", function () {
    $("#product_information_table tr td:nth-child(6)").hide();
  });

  // Product information modal
  $(document).on("click", ".view", function () {
    let row = $(this).closest("tr");
    let productId = row.find("td").eq(1).text();
    let productName = row.find("td").eq(2).text();
    let productBrand = row.find("td").eq(3).text();
    let productCategory = $(this).closest("tr").find("td").eq(4).text();
    console.log(productCategory);
    let productSubCategory = $(this).closest("tr").find("td").eq(5).text();
    let productUnit = $(this).closest("tr").find("td").eq(6).text();
    let productSKU = $(this).closest("tr").find("td").eq(7).text();
    let productPrice = $(this).closest("tr").find("td").eq(8).text();
    let productDescription = $(this).closest("tr").find("td").eq(10).text();
    let productImage = $(this).closest("tr").find("img").attr("src");

    $("#product_view_modal").find(".modal-body td").eq(0).text(productId);
    $("#product_view_modal").find(".modal-body td").eq(1).text(productName);
    $("#product_view_modal").find(".modal-body td").eq(2).text(productBrand);
    $("#product_view_modal").find(".modal-body td").eq(3).text(productCategory);
    $("#product_view_modal").find(".modal-body td").eq(4).text(productSubCategory);
    $("#product_view_modal").find(".modal-body td").eq(5).text(productUnit);
    $("#product_view_modal").find(".modal-body td").eq(6).text(productSKU);
    $("#product_view_modal")
      .find(".modal-body td")
      .eq(7)
      .text(productPrice + "Tk");
    $("#product_view_modal").find(".modal-body td").eq(8).text(productDescription);
    $("#product_view_modal").find("img").attr("src", productImage);
  });

  // Retriving Sub Categories by Category ID
  $(document).on("change", "[name='product_category']", function () {
    let categoryId = $(this).val();
    let subCategoryDropdown = $("[name='product_sub_category']");
    console.log(categoryId);
    $.ajax({
      url: "pages/get_subCategories.php",
      method: "GET",
      data: { category_id: categoryId },
      beforeSend: function () {
        $("[name='product_sub_category']").empty().append("<option selected disabled>Loading</option>");
      },
      success: function (response) {
        subCategoryDropdown.empty().html(response);
      },
      error: function () {
        console.log("Error");
      },
    });
  });

  //Listening the Product Search Field
  let debounceTimer;
  $(document).on("input", "#product_search", function (e) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
      let inputValue = e.target.value;
      $.ajax({
        url: "pages/get_all_products.php",
        method: "POST",
        // dataType: "json",
        data: {
          search: inputValue,
        },
        beforeSend: function () {
          console.log("sending");
        },
        dataType: "json",
        success: function (response) {
          console.log(response);
          $(".products_group").empty();
          productObj = response;
          console.log(productObj);

          productObj.forEach(function (p) {
            // Defining Selling or Buying price
            let stock = parseInt(p.total_stock);
            let price;
            if ($("input[type=submit]").val() == "Create Purchase Order") {
              price = p.buying_price;
            } else {
              price = p.selling_price;
            }

            $(".products_group").append(`
          <div class="card product d-inline-block p-1" style="width: 10rem">
                    <div class="img_container"><img src="uploads/images/${p.product_image}"
                            class="card-img-top img-fluid" alt="..."></div>
                    <div class="card-body">
                        <h5 class="card-title small">
                        ${p.product_name}
                        </h5>
                        <h6>
                            <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                            ${price}
                        </h6>
                        <h6 id="prodcut_stock" style="font-size:14px; color:grey">
                        Stock: ${stock} ${p.unit_name}
                        </h6>
                        <button class="add_product btn d-block mx-auto w-100 mybtn-hightlight" data-sku="${p.sku}" data-sellingPrice="${price}"
                            value="${p.product_id}">ADD</button>
                    </div>
                </div>
          `);
          });
        },
        error: function () {
          console.log("error");
        },
        complete: function () {
          console.log("completed");
        },
      });
    }, 300);
  });

  // Listening The Add prodcut Button and Add product to the Invoice
  $(document).on("click", ".add_product", function (e) {
    let stock = e.target.parentNode.parentNode.querySelector("#prodcut_stock").innerText;
    stock = stock.replace("Stock: ", "");
    let productName = e.target.parentNode.parentNode.querySelector(".card-title").innerText;
    let productId = e.target.value;
    let sku = e.target.getAttribute("data-sku");
    let selling_price = e.target.getAttribute("data-sellingPrice");
    selling_price = selling_price.toLocaleString("en-IN", { maximumFractionDigits: 2 });
    let productImage = e.target.parentNode.parentNode.querySelector("img").getAttribute("src");
    $("#sales_order_table").append(`
          <tr>
             <td>${sku}</td>
             <td>${productName}</td>
             <td><img style="width: 30px" src="${productImage}">
             </td>
             <td>${stock}</td>
             <td class="quantity"><input class="form-control" style="width:60px" type="number" value="1" name="quantity[]"></td>
             <td class="selling_price">${selling_price}</td>
             <td class="total_price">${selling_price}</td>
             <td><i class="delete_row fa-solid fa-x" style="color:red"></i></td>
             <input type="hidden" value ="${productId}" name="productId[]">
          </tr>
       `);
    calSubTotal();
  });

  //Listing Quantity and Total price Calculation
  $(document).on("change", ".quantity", function (e) {
    let quantity = e.target.value;
    let price = e.target.parentNode.parentNode.querySelector(".selling_price").innerText;
    let totalPrice = quantity * price;
    let totalElement = e.target.parentNode.parentNode.querySelector(".total_price");
    totalElement.innerText = totalPrice.toFixed(2);
    calSubTotal();
  });

  //Listing the Delete Row and Delete the data
  $(document).on("click", ".delete_row", function (e) {
    let row = e.target.parentNode.parentNode;
    row.remove();
    calSubTotal();
  });

  //SubTotal Funciton Defination
  function calSubTotal() {
    // Calculating The Subtotal Price
    let sum = 0;
    $(".total_price").each(function () {
      let totalPrice = $(this).text();
      totalPrice = parseInt(totalPrice);
      sum += isNaN(totalPrice) ? 0 : totalPrice;
    });
    let subTotal = sum.toLocaleString("en-IN", { maximumFractionDigits: 2 });
    $("#sub_total").text("Sub Total: " + subTotal + " Tk.");
  }

  //listening the customer phone for retriving customer data
  $(document).on("keypress", ".customer_phone", function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
      let phoneNumber = $(".customer_phone").val();
      $.ajax({
        url: "pages/get_customerInfo.php",
        method: "POST",
        data: {
          customer_search: phoneNumber,
        },
        dataType: "json",
        beforeSend: function () {
          $("input[type='submit']").attr("disabled", "");
        },
        success: function (response) {
          //removing  Customer data from the form
          $("input[name='existing_customer']").remove();

          let matchCount = response.length;
          if (matchCount === 1) {
            $("#customer_match_count").text("Customer Match Found");
            addDisabledAttr();

            $("form").find(".form-control").attr("style", "border: 1px solid green");
            $("input[name='customer_phone']").eq(0).val(response[0].customer_phone);
            $("input[name='customer_id'").val(response[0].customer_id);
            $("input[name='customer_name'").val(response[0].customer_name);
            $("input[name='customer_email'").val(response[0].customer_email);
            $("input[name='customer_address'").val(response[0].customer_address);
            $("form").prepend("<input type='hidden' name='existing_customer'>");
          } else if (matchCount === 10) {
            //remove green border style
            $("form").find(".form-control").removeAttr("style");
            addDisabledAttr();
            removeInputValue();
            changeDisabledPlaceholderText();
            //Writing matched data
            $("#customer_match_count").text("More than 10 Matches Found");
          } else if (matchCount === 0) {
            $("#customer_match_count").text("No match Enter Customer Data");
            //remove green border style
            $("form").find(".form-control").removeAttr("style");
            removeDisabledInput();
            changeEnterPlaceholderText();
            removeInputValue();
          } else {
            $("#customer_match_count").text(matchCount + " Matches Found");
            removeInputValue();
            changeDisabledPlaceholderText();
          }

          $("input[type='submit']").removeAttr("disabled");
        },
        error: function () {},
      });
    }, 1000);
  });

  //fucntion defination for customer data retriving

  function removeDisabledInput() {
    // removing disabled input
    $("form").find(".form-control").not(":eq(1)").removeAttr("disabled");
  }
  function changeEnterPlaceholderText() {
    // Changing placeholder text
    $("input[name='customer_phone'").attr("placeholder", "Enter Customer Phone");
    $("input[name='customer_id'").attr("placeholder", "Customer ID will be generated");
    $("input[name='customer_name'").attr("placeholder", "Enter Customer Name");
    $("input[name='customer_email'").attr("placeholder", "Enter Customer Email");
    $("input[name='customer_address'").attr("placeholder", "Enter Customer Address");
  }
  function changeDisabledPlaceholderText() {
    // Changing placeholder text
    $("input[name='customer_phone'").attr("placeholder", "Enter Customer Phone");
    $("input[name='customer_id'").attr("placeholder", "ID will be loaded");
    $("input[name='customer_name'").attr("placeholder", "Name will be loaded");
    $("input[name='customer_email'").attr("placeholder", "Email will be loaded");
    $("input[name='customer_address'").attr("placeholder", "Address will be loaded");
  }
  function addDisabledAttr() {
    //Adding disabled attribute
    $("input[name='customer_id']").attr("disabled", "");
    $("input[name='customer_name']").attr("disabled", "");
    $("input[name='customer_email']").attr("disabled", "");
    $("input[name='customer_address']").attr("disabled", "");
  }
  function removeInputValue() {
    //removing input value
    $("input[name='customer_id'").val("");
    $("input[name='customer_name'").val("");
    $("input[name='customer_email'").val("");
    $("input[name='customer_address'").val("");
  }

  //listening the supplier phone for retriving supplier data ==============================
  $(document).on("keyup", ".supplier_phone", function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
      let phoneNumber = $(".supplier_phone").val();
      $.ajax({
        url: "pages/get_supplierInfo.php",
        method: "POST",
        data: {
          supplier_search: phoneNumber,
        },
        dataType: "json",
        beforeSend: function () {
          $("input[type='submit']").attr("disabled", "");
        },
        success: function (response) {
          console.log(response);
          //removing  supplier data from the form
          $("input[name='existing_supplier']").remove();

          let matchCount = response.length;
          if (matchCount === 1) {
            $("#supplier_match_count").text("supplier Match Found");
            supplieraddDisabledAttr();

            $("form").find(".form-control").attr("style", "border: 1px solid green");
            $("input[name='supplier_phone']").eq(0).val(response[0].supplier_phone);
            $("input[name='supplier_id'").val(response[0].supplier_id);
            $("input[name='supplier_name'").val(response[0].supplier_name);
            $("input[name='supplier_email'").val(response[0].supplier_email);
            $("input[name='supplier_address'").val(response[0].supplier_address);
            $("form").prepend("<input type='hidden' name='existing_supplier'>");
          } else if (matchCount === 10) {
            //remove green border style
            $("form").find(".form-control").removeAttr("style");
            supplieraddDisabledAttr();
            supplierremoveInputValue();
            supplierchangeDisabledPlaceholderText();
            //Writing matched data
            $("#supplier_match_count").text("More than 10 Matches Found");
          } else if (matchCount === 0) {
            $("#supplier_match_count").text("No match Enter supplier Data");
            //remove green border style
            $("form").find(".form-control").removeAttr("style");
            supplierremoveDisabledInput();
            supplierchangeEnterPlaceholderText();
            supplierremoveInputValue();
          } else {
            $("#supplier_match_count").text(matchCount + " Matches Found");
            supplierremoveInputValue();
            supplierchangeDisabledPlaceholderText();
          }

          $("input[type='submit']").removeAttr("disabled");
        },
        error: function () {
          console.log("error");
        },
      });
    }, 300);
  });

  //fucntion defination for supplier data retriving

  function supplierremoveDisabledInput() {
    // removing disabled input
    $("form").find(".form-control").not(":eq(1)").removeAttr("disabled");
  }
  function supplierchangeEnterPlaceholderText() {
    // Changing placeholder text
    $("input[name='supplier_phone'").attr("placeholder", "Enter supplier Phone");
    $("input[name='supplier_id'").attr("placeholder", "supplier ID will be generated");
    $("input[name='supplier_name'").attr("placeholder", "Enter supplier Name");
    $("input[name='supplier_email'").attr("placeholder", "Enter supplier Email");
    $("input[name='supplier_address'").attr("placeholder", "Enter supplier Address");
  }
  function supplierchangeDisabledPlaceholderText() {
    // Changing placeholder text
    $("input[name='supplier_phone'").attr("placeholder", "Enter supplier Phone");
    $("input[name='supplier_id'").attr("placeholder", "ID will be loaded");
    $("input[name='supplier_name'").attr("placeholder", "Name will be loaded");
    $("input[name='supplier_email'").attr("placeholder", "Email will be loaded");
    $("input[name='supplier_address'").attr("placeholder", "Address will be loaded");
  }
  function supplieraddDisabledAttr() {
    //Adding disabled attribute
    $("input[name='supplier_id']").attr("disabled", "");
    $("input[name='supplier_name']").attr("disabled", "");
    $("input[name='supplier_email']").attr("disabled", "");
    $("input[name='supplier_address']").attr("disabled", "");
  }
  function supplierremoveInputValue() {
    //removing input value
    $("input[name='supplier_id'").val("");
    $("input[name='supplier_name'").val("");
    $("input[name='supplier_email'").val("");
    $("input[name='supplier_address'").val("");
  }

  // Resizeable section

  // Create a MutationObserver instance
  const observer = new MutationObserver(function (mutationsList) {
    mutationsList.forEach(function (mutation) {
      if (mutation.addedNodes) {
        mutation.addedNodes.forEach(function (node) {
          if (node.matches && node.matches(".split")) {
            document.dispatchEvent(new Event("splitElementAdded"));
          }
        });
      }
    });
  });

  observer.observe(document, { childList: true, subtree: true });

  document.addEventListener("splitElementAdded", function () {
    Split(["#split-0", "#split-1"], {
      gutterSize: 9,
    });
  });

  //ChartJS
  const reportChart = document.getElementById("reportChart");

  //get Last 7 days Sales Data
  let sevenDaysData = [];
  let sevenDaysDate = [];
  $.ajax({
    url: "pages/get_last_7days_sales.php",
    dataType: "json",
    method: "POST",
    data: { sevenDaysData: "" },
    success: function (response) {
      response.forEach(function (each) {
        sevenDaysData.push(each.total_sales);
        sevenDaysDate.push(each.sales_date);
      });
      new Chart(reportChart, {
        type: "bar",
        data: {
          labels: sevenDaysDate,
          datasets: [
            {
              label: "Last 7 Days Sales Data",
              data: sevenDaysData,
              backgroundColor: "#F39C12",
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    },
  });
  // Categories Product
  let CategoriesName = [];
  let CategorisProducts = [];
  const reportChart2 = document.getElementById("reportChart-2");
  $.ajax({
    url: "pages/get_last_7days_sales.php",
    dataType: "json",
    method: "POST",
    data: { categoriesProduct: "" },
    success: function (response) {
      response.forEach(function (each) {
        CategoriesName.push(each.category_name);
        CategorisProducts.push(each.total_products);
      });
      new Chart(reportChart2, {
        type: "pie",
        data: {
          labels: CategoriesName,
          datasets: [
            {
              label: "Last 7 Days Sales Data",
              data: CategorisProducts,
              backgroundColor: ["#66ADFF", "#4CDEC1", "#FFC169", "#FF758C", "#F39C12"],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    },
  });
});
