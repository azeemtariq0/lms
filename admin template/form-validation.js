$(document).ready(function () {

    $("#form").validate({
        rules: {
            name: {
                required: true,
                minlength: 10,
                maxlength: 50
            },
            price: {
                required: true,
                number: true,
                min: 1000,
                max: 15000
            },
            description: {
                required: true,
                minlength: 30,
                maxlength: 500
            },
            category: {
                required: true
            },
            file: {
                required: true
            },
            "type[]": {
                required: true
            },
            rating: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Product Name is required",
                minlength: "Product Name must be at least 10 characters",
                maxlength: "Product Name must be no more than 50 characters"
            },
            price: {
                required: "Price is required",
                number: "Price must be a number",
                min: "Price must be at least 1000",
                max: "Price must be no more than 15000"
            },
            description: {
                required: "Description is required",
                minlength: "Description must be at least 30 characters",
                maxlength: "Description must be no more than 500 characters"
            },
            category: {
                required: "Category is required"
            },
            file: {
                required: "Product Image is required"
            },
            "type[]": {
                required: "Please select at least 1 type",
                checkboxMin: "Please select at least 1 type",
                checkboxMax: "Please select no more than 2 types"
            },
            rating: {
                required: "Rating is required",
            }
        },
        errorElement: "span",
        errorClass: "text-red-500 text-xs",
        errorPlacement: function (error, element) {
            if (element.attr("name") == "type[]" || element.attr("name") == "rating") {
                error.insertAfter($(element).parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            alert("Form is valid! Submitting...");
        }
    });


    function calculateAmount(row) {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const rate = parseFloat(row.find('.rate').val()) || 0;
        const amount = qty * rate;
        row.find('.amount').val(amount.toFixed(2));
    }

    // Update amount on qty or rate change
    $(document).on('input', '.qty, .rate', function () {
        const row = $(this).closest('.detail-row');
        calculateAmount(row);
    });

    // Add new row template
    function addRow() {
        const newRow = `
                <tr class="detail-row">
                    <td class="p-2">
                        <select name="product_id[]" class="form-input">
                            <option value="">Select Product</option>
                            <option value="1">Laptop</option>
                            <option value="2">Mouse</option>
                            <option value="3">Keyboard</option>
                        </select>
                    </td>
                    <td class="p-2">
                        <input type="text" name="description[]" class="form-input">
                    </td>
                    <td class="p-2">
                        <input type="number" name="qty[]" class="form-input qty" min="1">
                    </td>
                    <td class="p-2">
                        <input type="number" name="rate[]" class="form-input rate" min="0" step="0.01">
                    </td>
                    <td class="p-2">
                        <input type="number" name="amount[]" class="form-input amount" readonly>
                    </td>
                    <td class="p-2 flex space-x-1">
                        <div class="relative group">
                            <button type="button" class="delete-row action-danger">
                                <i class="fa-solid fa-trash text-gray-500 group-hover:text-rose-600 transition-all"></i>
                            </button>
                            <span class="tooltip-left group-hover:!block">Delete Row</span>
                        </div>
                        <div class="relative group">
                            <button type="button" class="insert-row action-success">
                                <i class="fa-solid fa-plus text-gray-500 group-hover:text-emerald-600 transition-all"></i>
                            </button>
                            <span class="tooltip-right group-hover:!block">Add Row</span>
                        </div>
                    </td>
                </tr>
            `;
        $('#detailsBody').append(newRow);
        calculateAmount($('#detailsBody .detail-row:last')); // Initialize amount for new row
    }

    // Insert row after current row
    $(document).on('click', '.insert-row', function () {
        const currentRow = $(this).closest('.detail-row');
        const newRow = $(addRow()).insertAfter(currentRow); // Add and insert after
    });

    // Delete row
    $(document).on('click', '.delete-row', function () {
        const rowCount = $('#detailsBody .detail-row').length;
        if (rowCount > 1) {
            $(this).closest('.detail-row').remove();
        } else {
            alert("Cannot delete the last row!");
            // Optionally reset the row instead of deleting
            const row = $(this).closest('.detail-row');
            row.find('input').val('');
            row.find('.amount').val('0.00');
            row.find('select').val('');
        }
    });







});