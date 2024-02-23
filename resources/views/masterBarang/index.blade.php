@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Master Barang</div>

                <div class="card-body">
                    <div class="mb-3">
                        <button id="addmasterBarang" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Master Barang</button>
                    </div>
                    
                    <table id="tablemasterBarang" class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Stok</th>
                                <th>Action</th>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formMasterBarang" action="" method="POST">
                <input type="hidden" id="modalState" value="">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" class="form-control" id="namaBarang" name="namaBarang">
                <label for="jenisBarang">Jenis Barang</label>
                <input type="text" class="form-control" id="jenisBarang" name="jenisBarang">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModal()" data-dismiss="modal">Close</button>
          <button type="button" id="submitmasterBarang"  onclick="savemasterBarang()" class="btn btn-danger">Submit</button>
        </div>
      </div>
    </div>
</div>

@endsection

@section('jsscript')
<script>
        var datatable = $('#tablemasterBarang').DataTable({
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
                { data: 'id', name: 'action',
                    render: function ( data, type, row, meta ) {
                            let action =
                            `<ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="btn btn-info dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                        <button type="button" class="dropdown-item" onclick="openModal('update')">View</button>
                                        <button type="button" class="dropdown-item" onclick="openModal('')">Edit</button>
                                    </ul>
                                </li>
                            </ul>`
                            ;

                        return action;
                    }

                },
            ]
        });
    
    function savemasterBarang(){
        formdata = {
            namaBarang : $('#namaBarang').val(),
            jenisBarang : $('#jenisBarang').val(),
            stok : $('#stok').val(),
        };
        url = '{{ route("api-master-barang.store") }}';
        datatable.ajax.reload()
        hitApi(url,formdata);
    }

    function openModal(state) {
        $('#myModal').modal('show');
        $('#modalState').val(state);
    }

    function closeModal() {
        $('#myModal').modal('hide');
    }



</script>
@endsection