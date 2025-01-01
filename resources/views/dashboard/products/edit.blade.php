<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

   
    <section class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center">
        <div class="mx-auto max-w-3xl lg:py-2">
            <form method="post" action="/dashboard/products/{{ $product->slug }}" class="max-w-3xl mx-auto"  enctype="multipart/form-data">
                @method('put')
                @csrf
                <!-- Grid with horizontal and vertical gaps -->
                <div class="relative grid gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="name" id="name" class="@error('name')  @enderror w-full sm:w-1/2 md:w-[400px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your Title" required="" autofocus value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                        <input type="text" name="slug" id="slug" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block max-w-xl w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" readonly autofocus value="{{ old('slug', $product->slug) }}">
                        @error('slug')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Category Dropdown -->
                    <div class="relative">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category_id" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 z-10">
                            <option selected="">Select category</option>
                            @foreach ($categories as $category)
                                @if(old('category_id', $product->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price" class="@error('name')  @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block  max-w-xl w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" placeholder="e.g 1000" value="{{ old('price', $product->price) }}">
                        @error('price')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Currency Dropdown -->
                    <div class="relative">
                        <label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Currency</label>
                        <select id="currency" name="currency_id" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 z-10">
                            <option selected="">Select Currency</option>
                            @foreach ($currencies as $currency)
                                @if(old('currency_id,', $product->currency_id) == $currency->id)
                                <option value="{{ $currency->id }}" selected>{{ $currency->abbreviation }}</option>
                                @else
                                <option value="{{ $currency->id }}">{{ $currency->abbreviation }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                        <input type="number" name="stock" id="stock" class="@error('name')  @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block  max-w-xl w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" placeholder="e.g 1000" value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Discount Dropdown -->
                    <div class="relative">
                        <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount</label>
                        <select id="discount" name="discount_id" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 z-10">
                            <option selected="">Select Discount</option>
                            @foreach ($discounts as $discount)
                                @if(old('discount_id', $product->discount_id) == $discount->id)
                                <option value="{{ $discount->id }}" selected>{{ $discount->name }}</option>
                                @else
                                <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <input type="text" name="status" id="status" class="@error('status')  @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block  max-w-xl w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" placeholder="Available / Not" value="{{ old('status', $product->status) }}">
                        @error('status')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Upload Image -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Image</label>
                        <input type="hidden" name="oldImage" value="{{ $product->image }}">
                        <input class="@error('image')  @enderror block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-20 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="image" type="file" required="">
                        @error('image')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="py-4 flex justify-center">
                    <button type="submit" class="inline-flex items-center px-5 py-2 mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/products/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>

</x-layout>