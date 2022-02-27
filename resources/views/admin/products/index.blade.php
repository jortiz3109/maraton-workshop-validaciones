@extends('layouts.app')
@push('body')

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card card-default mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-3">{{ trans('Administration of products') }}</div>
                            <div>
                                <a href="{{ route('admin.products.create') }}"
                                   class="btn btn-primary">{{ trans('Create') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{ trans('admin.products.fields.name') }}</th>
                                <th scope="col">{{ trans('admin.products.fields.price') }}</th>
                                <th scope="col">{{ trans('admin.products.fields.quantity') }}</th>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col col-md-3">
                @include('admin.products.metrics.visits')
            </div>
        </div>
    </div>
@endpush
