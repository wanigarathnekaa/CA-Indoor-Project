    $(document).ready(function() {
        $('#invoice_date input').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#invoice_due_date input').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
    $(document).ready(function() {
        // Initialize datepicker for invoice_date input field
        $('#invoice_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    
        // Initialize datepicker for invoice_due_date input field
        $('#invoice_due_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
