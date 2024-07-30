@if(isset($product))
<li class="user-item gap14" id="row-{{ $product['id'] }}">
    <div class="flex items-center justify-between gap20 flex-grow">
        <div style="max-width: 145px">
            <div class="image">
                <img src="{{ $product->images->first()->name ?? '' }}" class="body-title-2"
                    style="border-radius: 10%;">
            </div>
            <div class="body-text" style="padding-left:10px;">{{ strlen($product['name']) > 20 ? substr($product['name'], 0, 20) . '...' : $product['name'] ?? '--' }}</div>
        </div>
        <div class="body-text" style="padding-left:5.7%;">{{ $product['quantity'] ?? '--' }}</div>
        <div class="body-text">
            @if ($product->description && strlen($product->description->description) > 25)
                {{ substr($product->description->description, 0, 25) . '...' }}
            @else
                {{ $product->description ? $product->description->description : '--' }}
            @endif
        </div>
        <div class="body-text">{{ 'Rs. '.$product['price'] ?? '--' }}</div>
        <div class="list-icon-function">
            @can('view_users')
            <div class="item eye">
                <a href="{{ route('view-product', $product['slug'] ?? '--') }}">
                    <i class="icon-eye"></i>
                </a>

            </div>
            @endcan
            @can('edit_users')
            <div class="item edit">
                <a href="{{ route('edit-product', $product['slug'] ?? '--') }}">
                    <i class="icon-edit-3"></i>
                </a>
            </div>
            @endcan
            @can('delete_users')
            <div class="item trash">
                <a class="delete-user del_product"
                    data-product-id="{{ $product['slug'] }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
            @endcan
        </div>
    </div>
</li>
@endif