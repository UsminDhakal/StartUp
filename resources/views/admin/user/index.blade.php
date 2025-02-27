<x-admin-layout>

    <div class="modal" id="faqModal" style=" background-color: rgba(0, 0, 0, 0.7);">
        <form id="faqModalForm" class="modal-dialog modal-dialog-centered">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabelHeading"></h5>
                    <button type="button" class="btn-close" id="faqModalClose"></button>
                </div>
                <div class="modal-body row">
                    <input type="text" name="id" id="id" class="form-control" placeholder=""
                        style="display: none;" />

                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Add title here" />
                        </div>
                        <div class="col mt-2">
                            <label for="email" class="form-label">Email<span
                                    class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email here" />
                        </div>
                        
                        <div class="col mt-2">
                            <label for="phone" class="form-label">Phone Number<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="Enter phone here" />
                        </div>

                        <div class="col mt-2">
                            <label for="equity" class="form-label">Equity<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="equity" name="equity" class="form-control"
                                placeholder="Enter equity here" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" id="modal_close">Close</button>
                    <button id="faqModalSubmit" class="btn btn-primary"></button>
                </div>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden rounded-lg shadow" style="border-radius: 10px; ">
        <div class="card">
            <div class=" table-responsive border" style="border-radius: 10px;">
                <table id="faq_listing" class="table table-striped " style="width: 100%;">
                    <thead>
                        <tr class="">
                            <th colspan="7">
                                <button type="button" id="button-modal" class="btn btn-primary">
                                    Add User
                                </button>
                            </th>
                        </tr>
                        <tr class="thead">
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Equity</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y" id="body_attendance_listing_2">
                        <!-- Your table body content here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        (function($) {
            // All Scripts regarding Units -----------------
            var faq_listing_table = $('#faq_listing').DataTable({
                "dom": "<'row '<'col-sm-12'tr>>" +
                    "<'d-flex gap-3 my-2 px-4 flex-md-row flex-column  justify-content-md-between align-items-center'<'justify-content-center'i><'justify-content-center'l><'justify-content-md-between'p>>",
                "aLengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, "100"]
                ],
                "iDisplayLength": 10,
                "language": {
                    zeroRecords: "<div class='px-4 py-3 w-full flex justify-center space-x-1' role='alert'><i class='ti-info-alt'></i>No <b> User </b> found.</div>",
                    search: "",
                    searchPlaceholder: "{{ __('Search') }}",
                    "processing": "<div class='square-box-loader'><div class='square-box-loader-container'><div class='square-box-loader-corner-top'></div><div class='square-box-loader-corner-bottom'></div></div><div class='square-box-loader-square'></div></div>",
                    paginate: {
                        'previous': '{{ __('Previous') }}',
                        'next': '{{ __('Next') }}'
                    }
                },
                "bSort": false,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "stateSave": true,
                "ajax": {
                    "url": "{{ route('admin.user.ajax.list') }}",
                    "data": function(d) {
                        d.ajax = 1;
                        console.log("Ajax Request Data:", d);
                    }
                },
                "createdRow": function(row, data, dataIndex, cells) {
                    console.log(data);
                    if (data.is_read == 0) {
                        $(row).css({
                            "background-color": "#b3e9b3",
                        });
                    }
                },
                "columns": [{
                        "data": function(row, type, set, meta) {
                            return row.sn;
                        },
                        "name": "sn",
                        "orderable": true,
                    },
                    {
                        "data": function(row, type, set, meta) {
                            return row.name;
                        },
                        "name": "title",
                        "orderable": false,
                    }, {
                        "data": function(row, type, set, meta) {


                            return row.email;
                        },
                        "name": "email",
                        "orderable": false,
                    },
                    {
                        "data": function(row, type, set, meta) {


                            return row.phone;
                        },
                        "name": "description",
                        "orderable": false,
                    },
                    {
                        "data": function(row, type, set, meta) {


                            return `<span class="badge bg-success">${row.equity}</span>`;
                        },
                        "name": "description",
                        "orderable": false,
                    },

                    {
                        "data": function(row, type, set, meta) {
                            var createdDate = moment(row
                                .created_at);
                            return `
                                <div>
                                    ${createdDate.format('YYYY-MM-DD')}<br>
                                    <span data-id="${row.id}" class="badge bg-label-primary">
                                       ${moment.duration(moment().diff(createdDate)).humanize()} ago
                                    </span>
                                </div>`;
                        },
                        "name": "created_at",
                        "orderable": true,
                    },
                    {
                        "data": function(row, type, set, meta) {
                            var destroy = '<button data-id="' + row.id +
                                '" class="btn btn-icon delete-faq-button">' +
                                '<span class="iconify" data-icon="material-symbols:delete"  data-width="20"></span>' +
                                '</button>'

                            return destroy;
                        },
                        "name": "delete",
                        "orderable": true,
                    },
                ],
            });


            //Opening of Model
            $('#faq_listing').on('click', '#button-modal', function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }
                $('#faqModal').show();
                $('#faqModalLabelHeading').html("Add User Details");
                $('#faqModalSubmit').html("Add User");
                $("#id").val('');
            });

            $('#faqModal').on('click', '#faqModalClose, #modal_close', function() {
                $('#faqModal').hide();
                $('#faqModalForm').trigger("reset");
            });

            $("#faqModalForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.user.store') }}",
                    data: {
                        id: $("#id").val(),
                        name: $("#name").val(),
                        phone: $("#phone").val(),
                        equity: $("#equity").val(),
                        email: $("#email").val(),
                    },
                    success: function(response) {
                        var message = response.success ? response.message : (Array.isArray(response
                                .message) ? response.message.join('<br>') : response
                            .message);
                        var icon = response.success ? 'success' : 'error';
                        fireToast(icon, message);
                        $('#faqModalForm').trigger("reset");
                        if (response.success) {
                            $('#faqModal').hide();
                            faq_listing_table.ajax.reload();
                            fireToast("success", response.message);

                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            });

            $("#body_attendance_listing_2").on('click', '.delete-faq-button', function() {
                var id = $(this).data('id');

                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {



                        $.ajax({
                            type: "delete",
                            url: "{{ route('admin.user.delete') }}",
                            data: {
                                id: id
                            },
                            success: function(response) {
                                fireToast(response.success ? "success" : "error", response
                                    .message);

                                if (response.success) {
                                    faq_listing_table.ajax.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });

                    }
                });
            });


        })(jQuery);
    </script>

</x-admin-layout>
