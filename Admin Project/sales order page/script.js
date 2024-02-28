// Add a product entry dynamically
function addProductEntry() {
    var productsContainer = document.getElementById("productsContainer");
  
    var productEntry = document.createElement("div");
    productEntry.className = "productEntry";
  
    var index = productsContainer.childElementCount + 1;
  
    var productLabel = document.createElement("label");
    productLabel.htmlFor = "product" + index;
    productLabel.textContent = "Product:";
  
    var productInput = document.createElement("input");
    productInput.type = "text";
    productInput.id = "product" + index;
    productInput.name = "product[" + index + "]";
    productInput.required = true;
  
    var quantityLabel = document.createElement("label");
    quantityLabel.htmlFor = "quantity" + index;
    quantityLabel.textContent = "Quantity:";
  
    var quantityInput = document.createElement("input");
    quantityInput.type = "number";
    quantityInput.id = "quantity" + index;
    quantityInput.name = "quantity[" + index + "]";
    quantityInput.required = true;
  
    var removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.textContent = "Remove";
    removeButton.onclick = function() { removeProductField(productEntry); };
  
    productEntry.appendChild(productLabel);
    productEntry.appendChild(productInput);
    productEntry.appendChild(quantityLabel);
    productEntry.appendChild(quantityInput);
    productEntry.appendChild(removeButton);
  
    productsContainer.appendChild(productEntry);
  }
  
  // Remove a product field
  function removeProductField(field) {
    field.remove();
  }
  