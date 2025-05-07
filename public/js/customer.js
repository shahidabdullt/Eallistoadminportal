$(document).ready(function() {
    // Edit button click
    $('.editinvoice-btn').click(function(){
        const invoiceId = $(this).data('id');
        console.log(invoiceId)
        $.ajax({
            url:`/customers/invoices/${invoiceId}/edit`,
            type:'GET',
            success:function(data){
                $('#invoiceId').val(data.id);
                // $('#userIdinvoice').val(data.user.id);
                $('#username').val(data.user.username);
                console.log(username);
                $('#amount').val(data.amount);
                $('#status').val(data.status);
                $('#date').val(data.date);
                $('#edit-invoices').show();
            },
            
            error: function() {
                alert('Failed to fetch invoice data');
            }
        });
    });
    $('.edit-btn').click(function() {
        // console.log(5);
        const userId = $(this).data('id');
        console.log(userId);
        // console.log(userId);
        // $('#editcustmers').show();
        // AJAX to fetch user data
        // $.ajax({
        //     url: `/customers/${userId}/edit`,
        //     type: 'GET',
        //     success: function(data) {
        //         $('#userId').val(data.id);
        //         $('#userName').val(data.name);
        //         $('#userEmail').val(data.email);
        //         $('#editForm').show();
        //     },
            // error: function() {
            //     alert('Failed to fetch customer data');
            // }
        // });
        $.ajax({
            url:`/customers/customers/${userId}/edit`,
            type:'GET',
            success:function(data){
                $('#userId').val(data.id);
                $('#userName').val(data.username);
                $('#userEmail').val(data.email);
                $('#address').val(data.address);
                $('#mobile').val(data.mobile);
                $('#editcustomers').show();
            },
            error: function() {
                alert('Failed to fetch customer data');
            }
        });
    });
    $('#registerbtn').click(function(){
        // console.log(5);
        const formData=$('#editcustomerform').serialize();
        const userId = $('#userId').val();
        if (!userId) {
            console.error('User ID is missing');
            return;
        }
        console.log(userId);
        console.log(formData);
        $.ajax({
            url:`/customers/customers/${userId}/update`,
            type:'PUT',
            data:formData,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success:function(data){
             alert('customerupdated sucessfully');
             $('#editcustmers').hide();
             location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseJSON);
                alert('Failed to update customer: ' + (xhr.responseJSON.message || 'Unknown error'));
            }
        });
    })
    $('#invoiceUpdateBtn').click(function(){
        // console.log(5);
        const formData=$('#edit-invoices-form').serialize();
        const invoceId = $('#invoiceId').val();
        // const userId=$('#userIdinvoice').val();
        if (!invoceId) {
            console.error('invoceId  is missing');
            return;
        }
        console.log(invoceId);
        // console.log('userid',userId);
        console.log(formData);
        // formData.append('userId', userId);
        $.ajax({
            url:`/customers/invoices/${invoceId}/update`,
            type:'PUT',
            data:formData,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success:function(data){
             alert('invoicesupdated sucessfully');
             $('#edit-invoices').hide();
             location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseJSON);
                alert('Failed to update invoice: ' + (xhr.responseJSON.message || 'Unknown error'));
            }
        });
    })
    // Submit form using AJAX
    // $('#editCustomerForm').submit(function(e) {
    //     e.preventDefault();
    //     const formData = $(this).serialize();
    //     const userId = $('#userId').val();

    //     $.ajax({
    //         url: `/customers/${userId}`,
    //         type: 'PUT',
    //         data: formData,
    //         success: function(response) {
    //             alert('Customer updated successfully');
    //             $('#editForm').hide();
    //             location.reload();
    //         },
    //         error: function() {
    //             alert('Failed to update customer');
    //         }
    //     });
    // });
});
