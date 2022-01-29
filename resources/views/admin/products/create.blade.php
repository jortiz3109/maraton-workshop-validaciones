@extends('layouts.app')
@push('body')

    <div class="container mt-5">
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default mb-3">
                        <div class="card-header">{{ trans('admin.products.titles.create') }}</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="code" class="form-label">{{ trans('admin.products.fields.code') }}</label>
                                <input type="text" @class(['form-control', 'is-invalid' => $errors->has('code')]) id="code" name="code" value="{{ old('code') }}">
                                @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ trans('admin.products.fields.description') }}</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-default mb-3">
                        <div class="card-header">{{ trans('admin.products.fields.images') }}</div>
                        <div class="card-body">
                    <span class="float-end">
                        <button @click="$emit('add-image')" type="button" class="btn btn-sm btn-success">{{ trans('add') }}</button>
                        <button @click="$emit('remove-image')" type="button" class="btn btn-sm btn-danger">{{ trans('remove') }}</button>
                        <button @click="$emit('remove-all-images')" type="button" class="btn btn-sm btn-danger">{{ trans('remove all') }}</button>
                    </span>
                        </div>
                        <input-file field-label="{{ trans('admin.products.fields.image') }}" field-name="images"></input-file>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-success">{{ trans('Save') }}</button>
                </div>
                <div class="col d-grid">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger">{{ trans('Cancel') }}</a>
                </div>
            </div>
        </form>
    </div>
@endpush
