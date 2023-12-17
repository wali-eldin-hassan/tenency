<div>
    <div class="relative group">
        <div class="w-full overflow-hidden bg-gray-200 rounded-md min-h-80 aspect-w-1 aspect-h-1 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{ $product->image_path }}" alt="Front of men&#039;s Basic Tee in black." class="object-cover object-center w-full h-full lg:h-full lg:w-full">
        </div>
        
        <div class="flex justify-between mt-4">
            <div>
                <h3 class="text-gray-700">
                    <a href="{{ $product->path() }}">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        {{ $product->name }}
                    </a>
                </h3>
    
                <p class="mt-1 text-sm text-gray-500">{{ $product->color }}</p>
            </div>
            
            <p class="text-sm font-medium text-gray-900">${{ $product->price }}</p>
    
        </div>
    
    </div>

    <form action="{{ route('tenant.cart.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $product->id }}" name="id">
        <input type="hidden" value="{{ $product->name }}" name="name">
        <input type="hidden" value="{{ $product->price }}" name="price">
        <input type="hidden" value="{{ $product->color }}" name="color">
        <input type="hidden" value="{{ $product->image_path }}"  name="image">
        <input type="hidden" value="{{ $product->path() }}"  name="path">
        <input type="hidden" value="1" name="quantity">
        <button class="relative flex items-center justify-center w-full px-8 py-2 mt-3 text-sm font-medium text-gray-900 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200">Add to Cart</button>
    </form>
</div>