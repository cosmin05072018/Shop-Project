@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/viewProducts.css') }}">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center text-white">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category }}</td>
                        <td class="w-25"><img class="img-fluid" src="{{ asset('storage/photos/'.$product->image) }}" alt=""></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                // "dom": 'Bfrtip',
                // buttons: [
                //     'excel', 'pdf', 'print'
                // ],
                "columnDefs": [{
                    "targets": [4],
                    "orderable": false
                }],
                // "language": {
                //     "searchPlaceholder": "Search records",
                //     "search": "",
                // },
                // "info": false
            });

            $('input[type="search"]').addClass('form-control rounded mb-5 px-3');
        });
    </script>
@endsection
