<div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Add Supplier</h4>
    <form id="addSupplier" method="post">
        <div class="form-group">
            <label for="">Supplier Name:</label>
            <input class="form-control" name="supplier_name" type="text" placeholder="Enter Supplier Name">
        </div>
        <div class="form-group">
            <label for="">Supplier address:</label>
            <input class="form-control" name="supplier_address" type="text" placeholder="Enter Supplier Address">
        </div>
        <div class="form-group">
            <label for="">Supplier Phone:</label>
            <input class="form-control" name="supplier_phone" type="text" placeholder="Enter Supplier Phone">
        </div>
        <div class="form-group">
            <label for="">Supplier Email:</label>
            <input class="form-control" name="supplier_email" type="text" placeholder="Enter Supplier Phone">
        </div>
        <br>
        <input type="hidden" name="addSupplier">
        <input type="submit" class="mybtn-hightlight btn" value="Add Supplier">
    </form>
    <div id="response"></div>
</div>