@inject('metrics', App\Services\ProductMetricsServices::class)

<div class="card mb-3">
    <div class="card-header">{{ trans('Most visited products since last week') }}</div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">
                    {{ trans('Product') }}
                </th>
                <th scope="col">
                    {{ trans('Visits') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($metrics->visits() as $productVisit)
                <tr>
                    <td>
                        <a href="{{ route('admin.products.show', $productVisit->product) }}">{{ $productVisit->product->name }}</a>
                    </td>
                    <td>
                        {{ $productVisit->visits }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
