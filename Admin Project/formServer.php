<?php
require_once("includes/db_connection.php");
require_once("includes/functions.php");

//Customers Section  Start <<================================>>

//Add customar
if (isset($_POST['addCustomer'])) {
    $name = $_POST["customer_name"];
    $address = $_POST["customer_address"];
    $phone = $_POST["customer_phone"];
    $email = $_POST["customer_email"];
    $sql = "INSERT INTO customers(customer_name,customer_address,customer_phone,customer_email,customer_status) VALUES('$name','$address','$phone','$email',1)";
    $query = $con->query($sql);
    if ($query) {

        echo "Customer Added";
    } else {
        echo "Customer Add Failed";
    }
}

//Update Customar - Mosharrof
if (isset($_POST['updateCustomer'])) {
    $id = $_POST['updateCustomer'];
    $name = $_POST["customer_name"];
    $address = $_POST["customer_address"];
    $phone = $_POST["customer_phone"];
    $email = $_POST["customer_email"];
    $sql = "UPDATE customers SET customer_name='$name', customer_address='$address', customer_phone='$phone', customer_email='$email' WHERE customer_id = $id";
    $query = $con->query($sql);
    if ($query) {
        echo "Customer Updated";
    } else {
        echo "Failed";
    }
}

//Delete customar - Mosharrof
if (isset($_GET['customer_id'])) {
    $id = $_GET['customer_id'];
    $sql = "UPDATE customers SET customer_status=0 WHERE customer_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_customers.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Restore customar - Mosharrof
if (isset($_GET['restore_customer_id'])) {
    $id = $_GET['restore_customer_id'];
    $sql = "UPDATE customers SET customer_status = 1 WHERE customer_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_customer.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Parmanently Delete Customer - Mosharrof
if (isset($_GET['par_delete_customer_id'])) {
    $id = $_GET['par_delete_customer_id'];
    $sql = "DELETE FROM customers WHERE customer_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_customer.php");
    } else {
        echo "Data Not Deleted ";
    }
}
//Customers Section  End <<================================>>


//Products Section  Start <<================================>>

//Add product Mosharrof

if (isset($_POST["addProduct"])) {
    $product_name = $_POST["product_name"];
    $product_brand = $_POST["product_brand"];
    $product_category = $_POST["product_category"];
    $product_sub_category = $_POST["product_sub_category"];
    $product_unit = $_POST["product_unit"];
    $product_sku = $_POST["product_sku"];
    $product_price = $_POST["product_price"];
    $product_buying_price = $_POST["buying_price"];
    $product_desc = $_POST["product_desc"];
    $pd_img_name = $_FILES["product_image"]["name"];
    $pd_img_tmpname = $_FILES["product_image"]["tmp_name"];
    $imageName = '';

    if ($pd_img_name !== '') {
        $imageName = 'product_' . time() . '_' . rand(100000, 100000000) . '.' . pathinfo($pd_img_name, PATHINFO_EXTENSION);
    }

    $sql = "INSERT INTO products(product_name,brand_id,category_id,sub_category_id,unit_id,sku,selling_price,buying_price,product_image,description, product_status) VALUES('$product_name','$product_brand','$product_category','$product_sub_category','$product_unit','$product_sku','$product_price','$product_buying_price','$imageName','$product_desc', 1)";
    $query = $con->query($sql);
    if ($query) {
        move_uploaded_file($pd_img_tmpname, 'uploads/images/' . $imageName);
        echo "Product Added";
    } else {
        echo "Product Add Faild";
    }
}

//Update Product - Mosharrof 

if (isset($_POST["updateProduct"])) {
    $product_id = $_POST['updateProduct'];
    $product_name = $_POST["product_name"];
    $product_brand = $_POST["product_brand"];
    $product_category = $_POST["product_category"];
    $product_unit = $_POST["product_unit"];
    $product_sku = $_POST["product_sku"];
    $product_price = $_POST["product_price"];
    $product_buying_price = $_POST["buying_price"];
    $product_desc = $_POST["product_desc"];
    // $product_img_name=$_POST["image_name"];
    $pd_img_name = $_FILES["product_image"]["name"];
    $pd_img_tmpname = $_FILES["product_image"]["tmp_name"];

    $imageName = 'product_' . time() . '_' . rand(100000, 100000000) . '.' . pathinfo($pd_img_name, PATHINFO_EXTENSION);

    if (!empty($pd_img_name)) {
        $sql = "UPDATE products SET product_name='$product_name',brand_id='$product_brand',category_id='$product_category',unit_id='$product_unit',sku='$product_sku',selling_price='$product_price', buying_price = '$product_buying_price',product_image= '$imageName',description='$product_desc' WHERE product_id =  $product_id";
    } else {
        $sql = "UPDATE products SET product_name='$product_name',brand_id='$product_brand',category_id='$product_category',unit_id='$product_unit',sku='$product_sku',selling_price='$product_price',buying_price = '$product_buying_price' ,description='$product_desc' WHERE product_id =  $product_id";
    }

    $query = $con->query($sql);
    if ($query) {
        if (!empty($pd_img_name)) {
            move_uploaded_file($pd_img_tmpname, 'uploads/images/' . $imageName);
        }
        echo "Product Updated";
    } else {
        echo "Update Product Failed";
    }
}

//Delete Product - Mosharrof
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $sql = "UPDATE products SET product_status=0 WHERE product_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_products.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Restore Product - Mosharrof
if (isset($_GET['restore_product_id'])) {
    $id = $_GET['restore_product_id'];
    $sql = "UPDATE products SET product_status = 1 WHERE product_id = $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_product.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Parmanently Product Delete - Mosharrof
if (isset($_GET['par_delete_product_id'])) {
    $id = $_GET['par_delete_product_id'];
    $sql = "DELETE FROM products WHERE product_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_product.php");
    } else {
        echo "Data Not Deleted ";
    }
}
//Products Section  End <<================================>>

//Categoris Section  Start <<================================>>
// Add Category Data Insert
if (isset($_POST["addCategory"])) {
    $categoryName = $_POST["categoryName"];

    $sql = "INSERT INTO categories(category_name, category_status) VALUES('$categoryName',1)";
    $query = $con->query($sql);
    if ($query) {
        echo "Category Added";
    }
}

//Update Category 

if (isset($_POST['updateCategory'])) {
    $categoryName = $_POST['categoryName'];
    $id = $_POST['updateCategory'];

    $sql = "UPDATE categories SET category_name = '$categoryName' WHERE category_id = $id ";
    $query = $con->query($sql);
    if ($query) {
        echo "Category Updated";
    } else {
        echo "Failed";
    }
}

//Category Data Delete
if (isset($_GET['categoryDelete'])) {
    $id = $_GET['categoryDelete'];
    $sql = "UPDATE categories SET category_status = 0 WHERE category_id = $id";
    $delete = $con->query($sql);
    if ($delete) {
        header("Location: pages/all_categories.php");
    }
}


// Add Sub Category
if (isset($_POST['addSubCategory'])) {
    $categoryId = $_POST['categoryId'];
    $subCategoryName = $_POST['subCategoryName'];

    $sql = "INSERT INTO sub_categories(sub_category_name,category_id,sub_category_status) VALUES('$subCategoryName', $categoryId, 1)";
    $insert = $con->query($sql);
    if ($insert) {
        echo "Sub Category Added";
    } else {
        echo "Sub Category Insertion Failed";
    }

}

// Update SubCategory - Sk Miraj

if (isset($_POST['updateSubCategory'])) {
    $id = $_POST['updateSubCategory'];
    $categoryId = $_POST['categoryId'];
    $subCategoryName = $_POST['subCategoryName'];

    $sql = "UPDATE sub_categories SET sub_category_name = '$subCategoryName', category_id= $categoryId WHERE sub_category_id = $id";

    $query = $con->query($sql);
    if ($query) {
        echo "Sub Category Updated";
    } else {
        echo "Sub Category Update Failed";
    }
}
//Categoris Section  End <<================================>>


//Brands Section  Start <<================================>>

//Add Brand - Mosharrof
if (isset($_POST['addbrand'])) {
    $brandName = $_POST['brandName'];
    $sql = "INSERT INTO brands(brand_name,brand_status) VALUES('$brandName',1)";
    $query = $con->query($sql);
    if ($query) {
        echo "Brand Added";
    } else {
        echo "Data Upload Failed";
    }
}

// Update Brand -Mosharrof
if (isset($_POST['editBrand'])) {
    $id = $_POST['editBrand'];
    $brandName = $_POST['brandName'];
    $sql = "UPDATE brands SET brand_name='$brandName', brand_status=1 WHERE brand_id = $id";
    $query = $con->query($sql);
    if ($query) {
        echo "Brand Updated";
    } else {
        echo "Data Upload Failed";
    }
}

//Delete Brand - Mosharrof
if (isset($_GET['brandDelete'])) {
    $id = $_GET['brandDelete'];
    $sql = "UPDATE brands SET brand_status=0 WHERE brand_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_brands.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Restore Brand -Mosharrof 
if (isset($_GET['restore_brand'])) {
    $id = $_GET['restore_brand'];
    $sql = "UPDATE brands SET brand_status=1 WHERE brand_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_brand.php");
    } else {
        echo "Data Not Restored ";
    }
}

//Parmanently Delete Brand - Mosharrof
if (isset($_GET['par_brandDelete'])) {
    $id = $_GET['par_brandDelete'];
    $sql = "DELETE FROM brands WHERE brand_id = $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_brand.php");
    } else {
        echo "Data Not Deleted ";
    }
}
//Brands Section  End <<================================>>

//Units Section  Start <<================================>>

//Add Unit - Mosharrof
if (isset($_POST['addunit'])) {
    $unitName = $_POST['unitName'];
    $sql = "INSERT INTO units(unit_name,unit_status) VALUES('$unitName',1)";
    $query = $con->query($sql);
    if ($query) {
        echo "Unit Added";
    } else {
        echo "Data Upload Failed";
    }
}

// Update Unit -Mosharrof
if (isset($_POST['editUnit'])) {
    $id = $_POST['editUnit'];
    $brandName = $_POST['UnitName'];
    $sql = "UPDATE units SET unit_name='$brandName', unit_status=1 WHERE unit_id = $id";
    $query = $con->query($sql);
    if ($query) {
        echo "Unit Updated";
    } else {
        echo "Data Upload Failed";
    }
}

//Delete Unit - Mosharrof
if (isset($_GET['unitDelete'])) {
    $id = $_GET['unitDelete'];
    $sql = "UPDATE units SET unit_status=0 WHERE unit_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_units.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Restore Unit -Mosharrof 
if (isset($_GET['restore_unit'])) {
    $id = $_GET['restore_unit'];
    $sql = "UPDATE units SET unit_status=1 WHERE unit_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_unit.php");
    } else {
        echo "Data Not Restored ";
    }
}

//Parmanently Delete Unit - Mosharrof
if (isset($_GET['par_unitDelete'])) {
    $id = $_GET['par_unitDelete'];
    $sql = "DELETE FROM units WHERE unit_id = $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_unit.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Units Section  End <<================================>>

//Users Section  Start <<================================>>
//Add user - Ali Hasan
if (isset($_POST['add_user'])) {
    $user_name = $_POST['i_user_name'];
    $user_username = $_POST['i_user_username'];
    $user_email = $_POST['i_user_email'];
    $user_phone = $_POST['i_user_phone'];
    $user_pass = $_POST['i_user_pass'];
    $user_repass = $_POST['i_user_repass'];
    $user_role = $_POST['i_user_role'];
    $user_image = $_FILES['i_user_photo']["name"];
    $user_tmpname = $_FILES['i_user_photo']["tmp_name"];
    $imageName = '';

    if ($user_image !== '') {
        $imageName = 'user_' . time() . '_' . rand(100000, 10000000) . '.' . pathinfo($user_image, PATHINFO_EXTENSION);
    } else {
        $imageName = 'avatar.png';
    }

    $insest = "INSERT INTO users(user_name,user_username,user_email,user_phone,user_password,role_id,user_image)
     VALUES('$user_name','$user_username','$user_email','$user_phone','$user_pass','$user_role','$imageName')";
    $query = $con->query($insest);
    if ($query) {
        move_uploaded_file($user_tmpname, 'uploads/images/' . $imageName);
        echo "User Added";
    } else {
        echo "failed";
    }
}

// Update user - Ali hasan
if (isset($_POST['update_user'])) {
    $id = $_POST['update_user'];
    $user_name = $_POST['i_user_name'];
    $user_username = $_POST['i_user_username'];
    $user_email = $_POST['i_user_email'];
    $user_phone = $_POST['i_user_phone'];
    $user_role = $_POST['i_user_role'];
    $user_image = $_FILES['i_user_photo']["name"];
    $user_tmpname = $_FILES['i_user_photo']["tmp_name"];

    $imageName = 'user_' . time() . '_' . rand(100000, 10000000) . '.' . pathinfo($user_image, PATHINFO_EXTENSION);
    if ($user_image !== '') {
        $sql = "UPDATE users set
        user_name='$user_name',user_username='$user_username',user_email='$user_email',user_phone='$user_phone',role_id='$user_role',user_image='$imageName'
        Where user_id=$id";
    } else {
        $sql = "UPDATE users set
        user_name='$user_name',user_username='$user_username',user_email='$user_email',user_phone='$user_phone',role_id='$user_role'  Where user_id=$id";
    }

    $query = $con->query($sql);
    if ($query) {
        if (!empty($user_image)) {
            move_uploaded_file($user_tmpname, 'uploads/images/' . $imageName);
        }
        echo "User Updated";
    } else {
        echo "Update Faild";
    }

}
//Users Section  End <<================================>>

//Role Section  Start <<================================>>
// role - Ali Hasan

if (isset($_POST['add_role'])) {
    $role_name = $_POST['i_role_name'];

    $insests = "INSERT INTO roles(role_name)  
    VALUES('$role_name')";
    $query = $con->query($insests);
    if ($query) {
        echo "Role Added";
    } else {
        echo "failed";
    }
}
//Delete Role - Mosharrof 

if (isset($_GET['roleDelete'])) {
    $id = $_GET['roleDelete'];
    $sql = "DELETE FROM roles WHERE role_id = $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_role.php");
    } else {
        echo "Data Not Deleted ";
    }
}


//Role Section  End <<================================>>

//Supplier Section  Start <<================================>>
//Add supplier
if (isset($_POST['addSupplier'])) {
    $name = $_POST["supplier_name"];
    $address = $_POST["supplier_address"];
    $phone = $_POST["supplier_phone"];
    $email = $_POST["supplier_email"];
    $sql = "INSERT INTO suppliers(supplier_name,supplier_address,supplier_phone,supplier_email,supplier_status) VALUES('$name','$address','$phone','$email',1)";
    $query = $con->query($sql);
    if ($query) {

        echo "Supplier Added";
    } else {
        echo "Supplier Add Failed";
    }
}
//Update Supplier
if (isset($_POST['updateSupplier'])) {
    $id = $_POST['updateSupplier'];
    $name = $_POST["supplier_name"];
    $address = $_POST["supplier_address"];
    $phone = $_POST["supplier_phone"];
    $email = $_POST["supplier_email"];
    $sql = "UPDATE suppliers SET supplier_name='$name', supplier_address='$address', supplier_phone='$phone', supplier_email='$email' WHERE supplier_id = $id";
    $query = $con->query($sql);
    if ($query) {
        echo "Supplier Updated";
    } else {
        echo "Failed";
    }
}

//Delete supplier
if (isset($_GET['supplier_id'])) {
    $id = $_GET['supplier_id'];
    $sql = "UPDATE suppliers SET supplier_status=0 WHERE supplier_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/all_suppliers.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Restore supplier
if (isset($_GET['restore_supplier_id'])) {
    $id = $_GET['restore_supplier_id'];
    $sql = "UPDATE suppliers SET supplier_status = 1 WHERE supplier_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_suppliers.php");
    } else {
        echo "Data Not Deleted ";
    }
}

//Parmanently Delete supplier
if (isset($_GET['par_delete_supplier_id'])) {
    $id = $_GET['par_delete_supplier_id'];
    $sql = "DELETE FROM suppliers WHERE supplier_id= $id";
    $query = $con->query($sql);
    if ($query) {
        header("location: pages/restore_suppliers.php");
    } else {
        echo "Data Not Deleted ";
    }
}
//Supplier Section  End <<================================>>

//Sales Order Section  Start <<================================>>
if (isset($_POST['create_order'])) {
    //function defination
    function insertToSalesOrder($con, $customerId, $productIds, $quantities)
    {
        // Inserting the Data to Sales Order Table & s_order product table
        $userId = $_SESSION['user_id'];
        $sql = "INSERT INTO sales_order(customer_id, sales_order_status,user_id) VALUES($customerId, 1, $userId)";

        $query = $con->query($sql);
        if ($query) {
            //Insert Data to s_order_product
            //get Sales order Id
            $sql = "SELECT * FROM sales_order WHERE sales_order_id = LAST_INSERT_ID()";
            $query = $con->query($sql);
            $data = $query->fetch_assoc();
            $salesOrderId = $data['sales_order_id'];
            foreach ($productIds as $index => $productId) {
                $quantity = $quantities[$index];
                $sql = "INSERT INTO s_order_product(sales_order_id, product_id, quantity) VALUES ($salesOrderId, $productId, $quantity)";
                $query = $con->query($sql);
            }
            echo "Order Created";


        }
    }

    //Inserting the Sales Order Table
    if (!empty(($_POST['customer_phone'])) && isset($_POST['existing_customer'])) {
        //retrive Customer ID
        $customerPhone = $_POST['customer_phone'];
        $productIds = $_POST['productId'];
        $quantities = $_POST['quantity'];
        $sql = "SELECT * FROM customers WHERE customer_phone = '$customerPhone'";
        $query = $con->query($sql);
        if ($query) {
            if ($query->num_rows === 1) {
                $data = $query->fetch_assoc();
                $customerId = $data['customer_id'];
                //function insert
                insertToSalesOrder($con, $customerId, $productIds, $quantities);
            }
        }
    } else if (!isset($_POST['productId'])) {
        echo "No product is selected";

    } else if (empty($_POST['customer_phone'])) {
        echo "Enter Customer Info";
    } else if (!empty($_POST['customer_name']) && !empty($_POST['customer_email'])) {
        //New Customer Query and previous sales order and s_order product data insert
        $customerPhone = $_POST['customer_phone'];
        $customerName = $_POST['customer_name'];
        $customerEmail = $_POST['customer_email'];
        $customerAddress = $_POST['customer_address'] ?? null;

        $sql = "INSERT INTO customers(customer_phone, customer_name, customer_email, customer_address, customer_status) VALUES ('$customerPhone', '$customerName', '$customerEmail', '$customerAddress',1)";
        $query = $con->query($sql);
        if ($query) {
            //Retriving inserted customer id
            $sql = "SELECT * FROM customers WHERE customer_id = LAST_INSERT_ID()";
            $query = $con->query($sql);
            $data = $query->fetch_assoc();
            $customerId = $data['customer_id'];
            $productIds = $_POST['productId'];
            $quantities = $_POST['quantity'];
            insertToSalesOrder($con, $customerId, $productIds, $quantities);


        }

    } else {
        echo "Customer info is Incomplete";
    }


}
//Sales Order Section  End <<================================>>


//Purchase Order Section  Start <<================================>>
if (isset($_POST['create_sales_order'])) {
    //function defination
    function insertToPurchaseOrder($con, $supplierId, $productIds, $quantities)
    {
        // Inserting the Data to Purchase Order Table & s_order product table
        $userId = $_SESSION['user_id'];
        $sql = "INSERT INTO purchase_order(supplier_id, purchase_order_status,user_id) VALUES($supplierId, 1, $userId)";

        $query = $con->query($sql);
        if ($query) {
            //Insert Data to s_order_product
            //get Sales order Id
            $sql = "SELECT * FROM purchase_order WHERE purchase_order_id = LAST_INSERT_ID()";
            $query = $con->query($sql);
            $data = $query->fetch_assoc();
            $purchaseOrderId = $data['purchase_order_id'];
            foreach ($productIds as $index => $productId) {
                $quantity = $quantities[$index];
                $sql = "INSERT INTO b_order_product(purchase_order_id, product_id, quantity) VALUES ($purchaseOrderId, $productId, $quantity)";
                $query = $con->query($sql);
                if ($query) {
                    echo "data Inserted";
                }
            }


        }
    }

    //Inserting the Sales Order Table
    if (!empty(($_POST['supplier_phone'])) && isset($_POST['existing_supplier'])) {
        //retrive supplier ID
        $supplierPhone = $_POST['supplier_phone'];
        $productIds = $_POST['productId'];
        $quantities = $_POST['quantity'];
        $sql = "SELECT * FROM suppliers WHERE supplier_phone = '$supplierPhone'";
        $query = $con->query($sql);
        if ($query) {
            if ($query->num_rows === 1) {
                $data = $query->fetch_assoc();
                $supplierId = $data['supplier_id'];
                //function insert
                insertToPurchaseOrder($con, $supplierId, $productIds, $quantities);
            }
        }
    } else if (!isset($_POST['productId'])) {
        echo "No product is selected";

    } else if (empty($_POST['supplier_phone'])) {
        echo "Enter supplier Info";
    } else if (!empty($_POST['supplier_name']) && !empty($_POST['supplier_email'])) {
        //New supplier Query and previous sales order and s_order product data insert
        $supplierPhone = $_POST['supplier_phone'];
        $supplierName = $_POST['supplier_name'];
        $supplierEmail = $_POST['supplier_email'];
        $supplierAddress = $_POST['supplier_address'] ?? null;

        $sql = "INSERT INTO suppliers(supplier_phone, supplier_name, supplier_email, supplier_address, supplier_status) VALUES ('$supplierPhone', '$supplierName', '$supplierEmail', '$supplierAddress',1)";
        $query = $con->query($sql);
        if ($query) {
            //Retriving inserted supplier id
            $sql = "SELECT * FROM suppliers WHERE supplier_id = LAST_INSERT_ID()";
            $query = $con->query($sql);
            $data = $query->fetch_assoc();
            $supplierId = $data['supplier_id'];
            $productIds = $_POST['productId'];
            $quantities = $_POST['quantity'];
            insertToPurchaseOrder($con, $supplierId, $productIds, $quantities);


        }

    } else {
        echo "supplier info is Incomplete";
    }


}
//Purchase Order Section  End <<================================>>















































?>