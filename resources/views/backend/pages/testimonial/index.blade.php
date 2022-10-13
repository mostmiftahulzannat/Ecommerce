@extends('backend.layouts.master')
@section('title', 'Testimonial_page')

@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <style>
        .dataTables_length {
            padding: 20px 0;
        }
    </style>
@endpush
@section('admin-content')
    <div class="row">
        <h4>Testimonial List</h4>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <a href="{{ route('testmonial.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle">Add New
                        Testimonial</i></a>

            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Client_Name</th>
                            <th scope="col">Client_Designation</th>
                            {{-- <th scope="col">Client_Message</th> --}}
                            <th scope="col">Client_Image</th>

                            <th scope="col">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($testmonial as $testimonial)
                            <tr>
                                <th scope="row">{{ $testmonial->firstItem() + $loop->index }}</th>
                                <td>{{ $testimonial->updated_at->format('d M Y') }}</td>
                                <td>{{ $testimonial->client_name }}</td>
                                <td>{{ $testimonial->client_designation }}</td>
                                <td>
                                    <img src="{{ asset('uploads/testimonials') }}/{{ $testimonial->client_image }} " class="img-fluid rounded h-50 w-50" alt="">

                                </td>


                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            setting
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('testmonial.edit',$testimonial->client_name_slug) }}">
                                                    <i class="fas fa-edit"></i> Edit</a></li>
                                            <form action="{{ route('testmonial.destroy',$testimonial->client_name_slug) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item show_confirm">
                                                    <i class="fas fa-trash"></i> Delete</a></li>
                                                </button>
                                            </form>
                                        </ul>
                                    </div>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pagingType: 'first_last_numbers',
            });
            $('.show_confirm').click(function(event){
        let form = $(this).closest('form');
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
    })
});
</script>
@endpush
