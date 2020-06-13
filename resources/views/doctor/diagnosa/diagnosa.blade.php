@extends('doctor.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Diagnosa</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Diagnosa</li>
                </ol>
            </div>
        </div>

        @if($message = Session::get('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3>
                        {{ $message }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Pet Name</th>
                                    <th>Diagnosa</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($diagnosis as $key => $diagnosa)
                                    <tr>
                                        <td>{{ ($currentPage - 1) * $perPage + $key +  1 }}</td>
                                        <td>{{ $diagnosa->user->name }}</td>
                                        <td>{{ $diagnosa->pet_name }}</td>
                                        <td>{{ $diagnosa->diagnosis }}</td>
                                        <td>{{ $diagnosa->created_at }}</td>
                                        <td>
                                            <a href="" class="btn btn-xs btn-outline-warning" data-toggle="modal"
                                               data-target="#insertModal{{ $diagnosa->id }}">
                                                <i class="fa fa-plus"></i>&ensp;insert diagnosa</a>
                                            <div class="modal fade" id="insertModal{{$diagnosa->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel1">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-warning"
                                                                id="exampleModalLabel1">
                                                                <b>Insert Diagnosa</b>
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('doctor.diagnosa.update', $diagnosa->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <h3>Pet Name : {{ $diagnosa->pet_name }}</h3>
                                                                <h6>Owner : {{ $diagnosa->user->name }}</h6>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <textarea name="diagnosa" id="diagnosa"
                                                                                      class="form-control text-white"
                                                                                      cols="30" rows="10"
                                                                                      placeholder="Enter all diagnosa">{{ $diagnosa->diagnosis }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-sm"
                                                                            data-dismiss="modal">
                                                                        <i class="fa fa-close"></i>&ensp;go back
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-outline-warning btn-sm">
                                                                        <i class="fa fa-check"></i>&ensp;save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $diagnosis->links() }}
                            </div>
                            <div class="d-flex justify-content-center">
                                <p class="subtitle">Showing {{ $diagnosis->firstItem() }} - {{ $diagnosis->lastItem() }}
                                    of {{ $diagnosis->total() }} entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection