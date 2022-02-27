@extends('layouts.app')
@push('body')

    <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default mb-3">
                        <div class="card-header">{{ $product->name }}</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4>{{ trans('admin.products.fields.code') }}</h4>
                                <p>{{ $product->code }}</p>
                            </div>

                            <div class="mb-3">
                                <h4>{{ trans('admin.products.fields.name') }}</h4>
                                <p>{{ $product->name }}</p>
                            </div>

                            <div class="mb-3">
                                <h4>{{ trans('admin.products.fields.price') }}</h4>
                                <p>{{ $product->price }}</p>
                            </div>

                            <div class="mb-3">
                                <h4>{{ trans('admin.products.fields.quantity') }}</h4>
                                <p>{{ $product->quantity }}</p>
                            </div>

                            <div class="mb-3">
                                <h4>{{ trans('admin.products.fields.description') }}</h4>
                                <p>{{ $product->description }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-default mb-3">
                        <div class="card-header">{{ trans('admin.products.fields.images') }}</div>
                        <div class="card-body">
                            @foreach($product->images as $image)
                                <img class="img-fluid" style="width: 150px;" src="{{ $image->url() }}">
                            @endforeach
                        </div>
                </div>
            </div>
    </div>
@endpush
