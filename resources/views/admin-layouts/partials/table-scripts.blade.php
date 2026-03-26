<script>
    $(document).ready(function () {
        // Toggle Filter
        $('.btn-show-table-options').on('click', function() {
            $('.table-configuration-wrap').slideToggle();
        });

        // Check all
        $('#check-all').on('change', function () {
            $('.bulk-checkbox').prop('checked', $(this).is(':checked'));
            updateBulkDeleteButton();
        });

        $(document).on('change', '.bulk-checkbox', function () {
            updateBulkDeleteButton();
        });

        function updateBulkDeleteButton() {
            let checkedCount = $('.bulk-checkbox:checked').length;
            if (checkedCount > 0) {
                $('#bulk-delete').show().text(`Delete (${checkedCount})`);
            } else {
                $('#bulk-delete').hide();
            }
        }

        // Live Search (client-side)
        let searchTimer;
        let tableId = '{{ $tableId ?? "dataTable" }}';
        $('#table-search').on('keyup', function () {
            clearTimeout(searchTimer);
            let query = $(this).val().toLowerCase();
            searchTimer = setTimeout(function() {
                $('#' + tableId + ' tbody tr').each(function () {
                    let text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(query) > -1);
                });
            }, 300);
        });

        // Add more filter
        $('.add-more-filter').on('click', function() {
            let template = $('.sample-filter-item-wrap').html();
            $('.filter-items-wrap').append(template);
        });

        // Remove filter item
        $(document).on('click', '.btn-remove-filter-item', function() {
            $(this).closest('.filter-item').remove();
        });

        // Handle per_page change
        $('#table-per-page').on('change', function() {
            let perPage = $(this).val();
            let url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        });

        // Bulk Delete Action
        $('#bulk-delete').on('click', function () {
            let ids = [];
            $('.bulk-checkbox:checked').each(function () {
                ids.push($(this).val());
            });

            if(ids.length === 0) return;

            let bulkDeleteUrl = '{{ $bulkDeleteUrl ?? "" }}';
            if(!bulkDeleteUrl) {
                console.error('Bulk delete URL not provided');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${ids.length} items!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete selected!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: bulkDeleteUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function (response) {
                            if (response.success || response.status) {
                                Swal.fire('Deleted!', response.message, 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });

        // Individual Delete (Generic Class)
        $(document).on('click', '.delete-confirm-btn', function (e) {
            e.preventDefault();
            let url = $(this).data('url') || $(this).attr('href');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            Swal.fire('Deleted!', 'Item has been deleted.', 'success').then(() => {
                                window.location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });

        // Individual Approve (Generic Class)
        $(document).on('click', '.approve-confirm-btn', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            
            Swal.fire({
                title: 'Confirm Approval?',
                text: "Are you sure you want to approve this product?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            Swal.fire('Approved!', response.message || 'Product has been approved.', 'success').then(() => {
                                window.location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
