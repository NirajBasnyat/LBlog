<script>
    $(function () {
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            let form = $(this).closest("form")

            Swal.fire({
                title: 'Are you sure?',
                text: "This item will be archived" +
                    "!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });


        $('.btn-force-delete').on('click', function (e) {
            e.preventDefault();
            let form = $(this).closest("form")

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Eliminate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    })
</script>