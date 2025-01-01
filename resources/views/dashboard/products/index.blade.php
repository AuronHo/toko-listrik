<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class=" py-2 position: fixed; left: 0; top: 50%; transform: translateY(-50%);">
        <x-menu></x-menu>
    </div>

    <div class="py-2">
        <a href="/dashboard/products/create">
        <button class="text-white bg-yellow-300 hover:bg-yellow-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-blue-800" type="button">
            Create            
        </button>
        </a>
    </div>

    @if(session()->has('success')) 
        <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
        </div>
    @endif

    <div class="flex justify-center items-center overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300">
            <thead class="text-xs text-gray-300 uppercase bg-gray-800 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Currency
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 border-b  border-gray-300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <!-- Row 1 -->
                    <tr class="bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-600 border-b border-gray-300">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b border-gray-300">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->category->name}}
                        </td>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->currency->name}}
                        </td>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->currency->abbreviation }} {{ $product->price}}
                        </td>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->stock}}
                        </td>
                        <td class="px-6 py-4 border-b  border-gray-300">
                            {{ $product->status}}
                        </td>
                        <td class="px-6 py-4 text-right flex items-center space-x-4 align-middle">
                            <form action="/dashboard/products/{{ $product->slug }}/edit" method="get">
                                <button class="w-full p-2 bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-800 dark:hover:bg-blue-700 dark:text-white font-medium rounded-lg flex items-center">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/>
                                    </svg>
                                </button>
                            </form>
                            
                            <form action="/dashboard/products/{{ $product->slug }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="w-full p-2 bg-red-100 hover:bg-red-200 text-red-800 dark:bg-red-800 dark:hover:bg-red-700 dark:text-white font-medium rounded-lg flex items-center" onclick="return confirm('Are you sure you want to delete the data for this Product?')">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15v3c0 .5523.44772 1 1 1h16c.5523 0 1-.4477 1-1v-3M3 15V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v9M3 15h18M8 15v4m4-4v4m4-4v4m-5.5061-7.4939L12 10m0 0 1.5061-1.50614M12 10l1.5061 1.5061M12 10l-1.5061-1.50614"/>
                                    </svg>
                                </button>
                            </form>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>