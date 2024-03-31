// show image when choose file
$('#val-image').on('change', (e) => {
    if(window.File && window.FileReader && window.FileList && window.Blob) {
        const files = e.target.files;
        console.log(files);
        const output = document.querySelector('.result');
        console.log(output);
        output.innerHTML = '';
        if (files.length == 1) {
            if (!files[0].type.match('image')) return;
            const picReader = new FileReader();
            picReader.addEventListener('load', function(event){
                const picFile = event.target;
                console.log(picFile);
                output.innerHTML += `<div class="col-md-12 text-center">
                <img style="width: 50%; height: 250px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="${picFile.result}" alt="#">
            </div>`;
            });
            picReader.readAsDataURL(files[0]);
            return;
        } else{
        for (let i = 0; i < files.length; i++) {
            if (i == 4) break;
            console.log(files[i]);
            if (!files[i].type.match('image')) continue;
            const picReader = new FileReader();
            picReader.addEventListener('load', function(event){
                const picFile = event.target;
                console.log(picFile);
                output.innerHTML += `<div class="col-md-3">
                <img style="width: 300px; height: 300px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="${picFile.result}" alt="#">
            </div>`;
            });
            picReader.readAsDataURL(files[i]);
        }
    }
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
})

$('.customerStatus').click(function(e) {
    e.preventDefault();
    const customerStatus = $(this).hasClass('btn-success') ? 'Inactive' : 'Active';
    const customerStatusId = $(this).data('itemid');
    $(this).toggleClass('btn-success btn-danger');
    $(this).html(customerStatus);

    console.log(customerStatusId);
    $.ajax({
        url: 'app/handle/changeStatusCustomer.php',
        data: { 
            id: customerStatusId,
            status: customerStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

$('.reviewStatus').click(function(e) {
    e.preventDefault();
    const reviewStatus = $(this).hasClass('btn-success') ? 'Inactive' : 'Active';
    const reviewStatusId = $(this).data('itemid');
    $(this).toggleClass('btn-success btn-danger');
    $(this).html(reviewStatus);

    console.log(reviewStatusId);
    $.ajax({
        url: 'app/handle/changeStatusReview.php',
        data: { 
            id: reviewStatusId,
            status: reviewStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

// add or edit category
$('#submit-category').click(function(e) {
    e.preventDefault();
    const categoryId = $('#val-category-id').val();
    const categoryName = $('#val-category-name').val();
    const categoryStatus = $('#val-category-status').val();
    $.ajax({
        url: 'app/handle/category.php',
        data: { 
            id: categoryId,
            name: categoryName,
            status: categoryStatus
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

$('#FormSubcategory').on('submit', function(e) {
    e.preventDefault();
    console.log("click submit info subcategory");
    $.ajax({
        type: 'POST',
        url: 'app/Handle/subcategory.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

//delete category
$('.sweet-confirm-custom').click(function(e) {
    e.preventDefault();
    var id = $(this).data('itemid');

    //check has class sweet-confirm-category
    let tableName = '';
    if($('.sweet-confirm-custom').hasClass('sweet-confirm-category')){
        console.log('has class sweet-confirm-category');
        tableName = 'categories';
    } else if($('.sweet-confirm-custom').hasClass('sweet-confirm-subcategory')){
        console.log('has class sweet-confirm-subcategory');
        console.log(id);
        tableName = 'subcategories';
    } else if($('.sweet-confirm-custom').hasClass('sweet-confirm-product')){
        console.log('has class sweet-confirm-product');
        console.log(id);
        tableName = 'products';
    } else if ($('.sweet-confirm-custom').hasClass('sweet-confirm-product-detail')){
        console.log('has class sweet-confirm-product-detail');
        console.log(id);
        tableName = 'products_sc';
    } else if ($('.sweet-confirm-custom').hasClass('sweet-confirm-discount')){
        console.log('has class sweet-confirm-discount');
        console.log(id);
        tableName = 'discounts';
    }

    swal(
        {
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: !1,
        },
        function () {
            console.log("cf" + id);
            $.ajax({
                url: 'app/handle/delete.php',
                data: {
                    id: id,
                    tableName: tableName
                },
                method: 'post',
                success: (response) => {
                    if (response == 'categories') {
                        sweetAlert("Oops...", "You cannot delete this category while the subcategory exists", "error");
                    } else if (response == 'subcategories') {
                        sweetAlert("Oops...", "You cannot delete this subcategory while the product exists", "error");
                    } else if (response == 'products') {
                        sweetAlert("Oops...", "You cannot delete this product while the product detail exists", "error");
                    } else{
                        $('tbody').html(response);
                        swal(
                            "Deleted !!",
                            "Hey, your imaginary file has been deleted !!",
                            "success"
                        );
                    }
                }
            })
        }
    );
});

// change category => subcategory
$('#val-category').change(function(e) {
    e.preventDefault();
    const categoryId = $(this).val();
    console.log(categoryId);
    $.ajax({
        url: 'app/handle/changeCategory.php',
        data: { 
            id: categoryId
        },
        method: 'post',
        success: (response) => {
            $('#val-sub-category').html(response);
        }
    })
});

// change size
$('#choose-size').change(function(e) {
    e.preventDefault();
    const sizeId = $(this).val();
    console.log(sizeId);
    $('#val-size-render').val(sizeId);
});

// change color
$('#choose-color').change(function(e) {
    e.preventDefault();
    const colorId = $(this).val();
    const colorRender = $('#color-render');
    console.log(colorId);
    $('#val-color-render').val(colorId);
    colorRender.html('');
    for (let i = 0; i < colorId.length; i++) {
        colorRender.append(`<div class="color-render-item product-color-${colorId[i]}"></div>`);
    }
});

// handle form product
$('#FormProduct').on('submit', function(e) {
    e.preventDefault();
    console.log("click submit info product");
    $.ajax({
        type: 'POST',
        url: 'app/Handle/product.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            $('.notification').html(response);
            // $('#val-product-name').val('');
        }
    })
});

// handle form product detail
$('#FormProductDetail').on('submit', function(e) {
    e.preventDefault();
    console.log("click submit info product detail");
    $.ajax({
        type: 'POST',
        url: 'app/Handle/productDetail.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

//handle form order
$('#submit-order-detail').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'app/handle/order.php',
        data: { 
            id: $('#val-order-id').val(),
            transaction: $('#val-transaction').val(),
            status: $('#val-order').val()
        },
        method: 'post',
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

//handle form discount
$('#FormDiscount').on('submit', function(e) {
    e.preventDefault();
    console.log("click submit info discount");
    $.ajax({
        type: 'POST',
        url: 'app/Handle/discount.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            $('.notification').html(response);
        }
    })
});

//handle form login
$('.login-form__btn').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'app/handle/login.php',
        data: { 
            email: $('#val-email').val(),
            password: $('#val-password').val()
        },
        method: 'post',
        // dataType: 'json',
        success: (response) => {
            if (response == 'dashboard.php') {  
                window.location.href = response;
            }
            else $('.notification').html(response);
        }
    })
});

// get value of date
$('#val-date').change(function(e) {
    console.log('change date');
    e.preventDefault();
    const date = $(this).val();
    let dateArr = date.split('-');
    let fromDate = dateArr[0].split('/');
    let toDate = dateArr[1].split('/');
    let fromDateStr = fromDate[2] + '-' + fromDate[0] + '-' + fromDate[1];
    let toDateStr = toDate[2] + '-' + toDate[0] + '-' + toDate[1];
    $.ajax({
        url: 'app/handle/revenue.php',
        data: { 
            fromDate: fromDateStr.replace(/\s/g, ''),
            toDate: toDateStr.replace(/\s/g, '')
        },
        method: 'post',
        success: (response) => {
            $('.res-data').html(response);
        }
    })
});