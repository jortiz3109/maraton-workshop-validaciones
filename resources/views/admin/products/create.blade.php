@extends('layouts.app')
@push('body')

    <div class="container mt-5">
        <div class="card card-default">
            <form action="{{ route('admin.products.store') }}" method="post">
                @csrf
                <div class="card-header">{{ trans('admin.products.titles.create') }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ trans('admin.products.fields.name') }}</label>
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">{{ trans('admin.products.fields.price') }}</label>
                        <input type="number" min="0" @class(['form-control', 'is-invalid' => $errors->has('price')]) id="price" name="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">{{ trans('admin.products.fields.quantity') }}</label>
                        <input type="number" min="1" @class(['form-control', 'is-invalid' => $errors->has('quantity')]) id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                        @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">{{ trans('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endpush
