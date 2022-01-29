@extends('layouts.app')
@push('body')

    <div class="container mt-5">
        <div class="card card-default">
            <div class="card-header">{{ trans('Administration of products') }} - <a href="{{ route('admin.products.create') }}"
                                                                                    class="btn btn-primary">{{ trans('Create') }}</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{ trans('admin.products.fields.name') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.price') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.quantity') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->disabled_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endpush
