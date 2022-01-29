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
                        <th scope="col">{{ trans('admin.products.fields.images') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->images_count }}</td>
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
