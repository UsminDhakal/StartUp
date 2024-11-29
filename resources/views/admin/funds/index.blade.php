<x-admin-layout>

    <style>
        .select2-container {
            z-index: 9999 !important;
        }
    </style>

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
                            <label for="invoice_no" class="form-label">Invoice No<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="invoice_no" name="invoice_no" class="form-control"
                                placeholder="Add title here" />
                        </div>

                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="date" class="form-label">Invoice Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" id="date" name="date" class="form-control"
                                placeholder="Add title here" />
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="topic" class="form-label col-12">Topic
                                <span class="text-danger">*</span>
                            </label>
                            <select id="topic" name="topic" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>Select a topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="user" class="form-label col-12">User
                                <span class="text-danger">*</span>
                            </label>
                            <select id="user" name="user" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>Select a user</option>
                                @foreach ($users as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="amount" class="form-label">Amount<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="amount" name="amount" class="form-control"
                                placeholder="Add title here" />
                        </div>

                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="col">
                            <label for="type" class="form-label col-12">Type
                                <span class="text-danger">*</span>
                            </label>
                            <select id="type" name="type" class="form-control" style="width: 100%;">
                                <option value="" disabled selected>Select Fund Type</option>
                                <option value="1">Investment</option>
                                <option value="2">Income</option>
                            </select>
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
                                    Add Funds
                                </button>
                            </th>
                        </tr>
                        <tr class="thead">
                            <th>SN</th>
                            <th>Topic</th>
                            <th>Amount</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                    zeroRecords: "<div class='px-4 py-3 w-full flex justify-center space-x-1' role='alert'><i class='ti-info-alt'></i>No <b> Funds</b> found.</div>",
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
                    "url": "{{ route('admin.fund.ajax.list') }}",
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
                            return row.topic;
                        },
                        "name": "topic",
                        "orderable": false,
                    },
                    {
                        "data": function(row, type, set, meta) {
                            return `<span class="${row.type == 1 ? "badge bg-label-success" : "badge bg-label-danger"}">${row.type == 1 ? "Income" : "Investment"}</span> | <span class="badge bg-label-primary">${row.amount}</span>`;
                        },
                        "name": "amount",
                        "orderable": false,
                    },

                    {
                        "data": function(row, type, set, meta) {
                            return row.invoice_no;
                        },
                        "name": "invoice_no",
                        "orderable": false,
                    },
                    {
                        "data": function(row, type, set, meta) {
                            var createdDate = moment(row
                                .invoice_date);
                            return `
                                <div>
                                    ${createdDate.format('YYYY-MM-DD')}<br>
                                </div>`;
                        },
                        "name": "invoice_date",
                        "orderable": true,
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

                            var edit = '<button data-id="' + row.id +
                                '" class="btn btn-icon edit-faq-button">' +
                                '<span class="iconify" data-icon="eva:edit-fill"  data-width="20"></span>' +
                                '</button>'

                            return destroy + edit;

                        },
                        "name": "delete",
                        "orderable": true,
                    },
                ],
            });

            $('.select2').select2({
                dropdownParent: $('#faqModal'), 
                placeholder: "Select a topic", // Placeholder text
                allowClear: true // Allows clearing the selection
            });
            $('#faqModal').on('shown.bs.modal', function () {
            $('#topic, #user').select2({
                dropdownParent: $('#faqModal'),
                placeholder: "Select a topic",
                allowClear: true
            });
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
                $('#topic #user').val(null).trigger('change');
            });

            $("#faqModalForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.fund.store') }}",
                    data: {
                        id: $("#id").val(),
                        name: $("#name").val(),
                        topic: $("#topic").val(),
                        user: $("#user").val(),
                        amount: $("#amount").val(),
                        invoice_no: $("#invoice_no").val(),
                        invoice_date: $("#date").val(),
                        type: $("#type").val(),


                    },
                    success: function(response) {
                        var message = response.success ? response.message : (Array.isArray(response
                                .message) ? response.message.join('<br>') : response
                            .message);
                        var icon = response.success ? 'success' : 'error';
                        fireToast(icon, message);
                        if (response.success) {
                            $('#faqModalForm').trigger("reset");
                            $('#topic #user').val(null).trigger('change');
                            $('#faqModal').hide();
                            faq_listing_table.ajax.reload();

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
                            url: "{{ route('admin.fund.delete') }}",
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

            $("#body_attendance_listing_2").on("click", ".edit-faq-button", function(){
                var id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.fund.edit') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#faqModalForm').trigger("reset");
                            $('#faqModal').show();
                            $('#faqModalLabelHeading').html("Edit Fund Details");
                            $('#faqModalSubmit').html("Update Fund");
                            $("#id").val(response.data.id);
                            $("#topic").val(response.data.topic_id).trigger('change');
                            $("#user").val(response.data.user_id).trigger('change');
                            $("#amount").val(response.data.amount);
                            $("#invoice_no").val(response.data.invoice_no);
                            $("#date").val(response.data.invoice_date);
                            $("#type").val(response.data.type);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            })


        })(jQuery);
    </script>

</x-admin-layout>
