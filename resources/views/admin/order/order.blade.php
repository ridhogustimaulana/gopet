@extends('admin.layouts.app')

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
                                    <th>Seller</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{ ($currentPage - 1) * $perPage + $key +  1 }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->userPetshop->name }}</td>
                                        <td>{{ $order->item->name }}</td>
                                        <td>@if($order->status == 0) <span class="text-danger">Belum Proses</span> @else <span class="text-success">Sudah Proses</span> @endif</td>
                                        <td>{{ $order->created_at }}</td>
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