<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="5;url={{ $downloadLink }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
</head>

<body>
    <p>Your download will start shortly. If it doesn't, <a href="{{ $downloadLink }}">click here</a>.</p><br>
    <p>Go Back to <a href="{{route('ols.transaction.index')}}">Reports</a></p>
</body>
<script>
    $(document).ready(function() {

        /*=================================================================
               ============ success alerts after successfull process ====================
               ==================================================================*/
        var successMessage = '{{ session('success') }}';
        if (successMessage !== '') {
            Swal.fire({
                title: successMessage,
                icon: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload(true)
                } else if (result.dismiss === Swal.DismissReason.backdrop) {
                    location.reload(true)
                }
            })
        }
    })
</script>

</html>
