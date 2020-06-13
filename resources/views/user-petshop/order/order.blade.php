@extends('user-petshop.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Orders</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Order</li>
                </ol>
            </div>
        </div>

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
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Change Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{ ($currentPage - 1) * $perPage + $key +  1 }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->item->name }}</td>
                                        <td>@if($order->status == 0) <span class="text-danger">Belum Proses</span> @else <span class="text-success">Sudah Proses</span> @endif</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <a href="" class="btn btn-xs btn-outline-success" data-toggle="modal"
                                               data-target="#change{{$order->id}}">
                                                <i class="fa fa-refresh"></i></a>
                                            <div class="modal fade" id="change{{$order->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel1">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-primary" id="exampleModalLabel1">
                                                                <b>Change order status</b>
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('user-petshop.update', $order->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <p>
                                                                    Are you sure to change status "
                                                                    <b class="text-danger">{{ $order->item->name }}</b>"
                                                                    ?
                                                                </p>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-outline-success btn-sm"
                                                                            data-dismiss="modal">
                                                                        <i class="fa fa-close"></i>&ensp;No, go back
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-outline-danger btn-sm">
                                                                        <i class="fa fa-check"></i>&ensp;Yes, change this
                                                                        record
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
                                {{ $orders->links() }}
                            </div>
                            <div class="d-flex justify-content-center">
                                <p class="subtitle">Showing {{ $orders->firstItem() }} - {{ $orders->lastItem() }} of {{ $orders->total() }} entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection