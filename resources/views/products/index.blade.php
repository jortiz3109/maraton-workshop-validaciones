@extends('layouts.app')
@push('body')

    <div class="container mt-5">
        @foreach ($products->chunk(4) as $chunk)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach($chunk as $product)
                <div class="col mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ $product->image->url() }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text" style="min-height: 10px;">{{ $product->description }}</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">{{ __('Show') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach

        @if($products->hasPages())
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>

        @endif
    </div>
@endpush
