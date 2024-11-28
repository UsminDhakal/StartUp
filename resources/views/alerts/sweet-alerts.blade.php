{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@if (session('info_toast'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: "{{ session('info_toast.type') }}",
            title: "{{ session('info_toast.title') }}",
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                container: 'small-toast-container',
                popup: 'small-toast-popup',
                title: 'small-toast-title'
            }
        });
    </script>
@endif


{{-- @if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: "error",
                title: "{{ $error }}",
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    container: 'small-toast-container',
                    popup: 'small-toast-popup',
                    title: 'small-toast-title'
                }
            });
        @endforeach
    </script>
@endif --}}

{{--
  session()->flash('confirm_toast', [
                    'type' => 'warning',
                    'title' => "Failed to Load",
                    'message' => $errorMessage,
                ]);

                 --}}
@if (session('confirm_toast'))
    <script>
        Swal.fire({
            title: "{{ session('confirm_toast.title') }}",
            text: "{{ session('confirm_toast.message') }}",
            icon: "{{ session('confirm_toast.type') }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif


<script>
    function fireToast(icon, title) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                container: 'small-toast-container',
                popup: 'small-toast-popup',
                title: 'small-toast-title'
            }
        });
    }
</script>



<script>
    function showConfirmation(title, text, icon, confirmtxt, url, userId, errorMsg, datatableVar, method) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmtxt
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const requestData = {
                    userId: userId,
                    _token: csrfToken
                };

                $.ajax({
                    url: url,
                    method: method,
                    data: requestData,
                    success: function(response) {
                        datatableVar.ajax.reload();
                        if (response.success) {
                            fireToast("success", response.message);
                        } else {
                            fireToast("error", response.message);
                        }
                    },
                    error: function(e) {
                        fireToast("error", errorMsg);
                    }
                });
            }
        });
    }
</script>
