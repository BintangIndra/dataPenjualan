@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Master Barangs</div>

                <div class="card-body">
                    <div class="mb-3">
                        <button id="addmasterBarang" class="btn btn-primary">Add Master Barang</button>
                    </div>
                    
                    <table id="tablemasterBarang" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Biography</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsscript')
<script>
    $(document).ready(function() {
        $('#tablemasterBarang').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '{{ route("api-master-barang.index") }}',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('user_token') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataSrc: function(response) {
                    console.log(response);
                    return response;
                }
            },
            columns: [
                { data: 'namaBarang', name: 'namaBarang' }, // Use 'namaBarang' instead of 'nama_barang' since that's the key in the response
                { data: 'jenisBarang', name: 'jenisBarang' }, // Use 'jenisBarang' instead of 'jenis_barang' since that's the key in the response
                { data: 'stok', name: 'stok' },
            ]
        });
    
    });

    $('#addmasterBarang').click(function() {

    })

</script>
@endsection