@extends('layouts.master')
@section('title')
Data Barang
@endsection
@section('breadcrumb')
Data Barang
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                @if(Auth::user()->role == 'admin')
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah
                </button>
                @endif
                <h6>Data Barang</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto
                                    Barang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Barang</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kategori</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Harga</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Diskon</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{asset('img/'. $item->foto_b)}}" style="width:100px;"
                                                class="rounded-circle" alt="no image">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item->nama_b}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">{{$item->kategori}}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">Rp.{{$item->harga}}</span>
                                </td>
                                
                                <td class="align-middle text-center">
                                    @if ($item->harga > 40000)
                                      <span class="badge badge-sm bg-gradient-success">
                                          {{ $item->harga = (10/100) *  $item->harga  }}
                                      </span>
                                    @elseif(($item->harga > 20000 ) && ($item->harga < 40000)) 
                                      <span class="badge badge-sm bg-gradient-warning">
                                      {{ $item->harga = (5/100) *  $item->harga  }}
                                      </span>
                                    @else
                                      <span class="badge badge-sm bg-gradient-secondary">
                                          {{ $item->harga = 0  }}
                                      </span>
                                    @endif
                              <td>
                              @if(Auth::user()->role == 'admin')
                              <td class="align-middle">
                                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                       data-original-title="Edit" data-bs-toggle="modal" data-bs-target="#editBarang{{$item->id}}">
                                      Edit
                                  </a>
                                  <a href="javascript:;" class="text-danger font-weight-bold text-xs"
                                       data-original-title="Hapus" data-bs-toggle="modal" data-bs-target="#hapusBarang{{$item->id}}">
                                      Hapus
                                  </a>
                              </td>
                              @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal tambah Data --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('data-barang.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="nama_b" class="form-control" placeholder="Masukan Nama Barang"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="kategori" class="form-control"
                                placeholder="Masukan Kategori Barang" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="harga" class="form-control" placeholder="Masukan Harga Barang, Contoh : 50000"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="file" name="foto_b" class="form-control"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal edit Data --}}
@foreach ($index as $item)
<div class="modal fade" id="editBarang{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('data-barang.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="nama_b" value="{{$item->nama_b}}" class="form-control" placeholder="Masukan Nama Barang"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="kategori" value="{{$item->kategori}}" class="form-control"
                                placeholder="Masukan Kategori Barang" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="harga" class="form-control" placeholder="Masukan Harga Barang, Contoh : 50000"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="file" name="foto_b" class="form-control"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- modal hapus -->
@foreach ($index as $item)
<div class="modal fade" id="hapusBarang{{$item->id}}" tabindex="-1" aria-labelledby="modalDeletelLabel" aria-hidden="true">
  <div id="loadingDelete"></div>
  <div class="modal-dialog modal-dialog-centered">
    <form style="display: inline;" action="{{ route('data-barang.destroy', $item->id) }}" method="post" aria-labelledby="exampleModalLabel">
      @method('delete')
      @csrf
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Hapus Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <h4>Apakah anda yakin menghapus data Barang?</h4>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn bg-gradient-danger" id="SubmitDeleteForm">Iya</button>
              <button type="button" class="btn bg-gradient-secondary" data-dismiss="modal">Tidak</button>
          </div>
      </div>
    </form>
  </div>
</div>
@endforeach

@endsection
