<x-user-layout>


    <div class="card overflow-hidden rounded-lg shadow" style="border-radius: 10px; ">
        
        <div class="card">
            <div class=" table-responsive border" style="border-radius: 10px;">
                <table id="faq_listing" class="table table-striped " style="width: 100%;">
                    <thead>
                        <tr class="thead">
                            <th>SN</th>
                            <th>Topic</th>
                            <th>Amount</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Created At</th>
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
                    "url": "{{ route('user.expense.ajaxx.get') }}",
                    "data": function(d) {
                        d.ajax = 1;
                        console.log("Ajax Request Data:", d);
                    }
                },
                "createdRow": function(row, data, dataIndex, cells) {
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
                ],
            });

        })(jQuery);
    </script>

</x-user-layout>
