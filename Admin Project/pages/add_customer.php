<div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Add Customer</h4>
    <form id="addCustomer" method="post">
        <div class="form-group">
            <label for="">Customer Name:</label>
            <input class="form-control" name="customer_name" type="text" placeholder="Enter Customer Name">
        </div>
        <div class="form-group">
            <label for="">Customer address:</label>
            <input class="form-control" name="customer_address" type="text" placeholder="Enter Customer Address">
        </div>
        <div class="form-group">
            <label for="">Customer Phone:</label>
            <input class="form-control" name="customer_phone" type="text" placeholder="Enter Customer Phone">
        </div>
        <div class="form-group">
            <label for="">Customer Email:</label>
            <input class="form-control" name="customer_email" type="text" placeholder="Enter Customer Phone">
        </div>
        <br>
        <input type="hidden" name="addCustomer">
        <input type="submit" class="mybtn-hightlight btn" value="Add Customer">
    </form>
    <div id="response"></div>
</div>