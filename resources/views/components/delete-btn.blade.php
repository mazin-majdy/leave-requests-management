<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $('.btn-delete').on('click', function() {

        let form = $(this).next('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to delete this",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                )
                form.submit();

            }
        })

    })
</script>
