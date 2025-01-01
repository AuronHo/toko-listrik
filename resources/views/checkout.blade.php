<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

        <div id="checkout" class="w-full max-w-md bg-white rounded-lg p-6 mx-auto" style="box-shadow: 0 12px 20px 5px rgba(0, 0, 0, 0.3);"> <!-- Adjusted shadow depth -->

            <!-- Product List -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="px-4 py-2 font-medium text-gray-300 border-b border-gray-200">Product</th>
                        <th class="px-4 py-2 font-medium text-gray-300 border-b border-gray-200 text-center">Quantity</th>
                        <th class="px-4 py-2 font-medium text-gray-300 border-b border-gray-200 text-right">Price</th>
                        <th class="px-4 py-2 font-medium text-gray-300 border-b border-gray-200 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="px-4 py-2 text-gray-600 border-b border-gray-200">{{ $item->product->name }}</td>
                            <td class="px-4 py-2 text-center border-b border-gray-200">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-right font-bold text-gray-800 border-b border-gray-200 item-price">{{ $item->product->currency->symbol  }}{{ $item->product->price }}</td>
                            <td class="px-4 py-2 text-right font-bold text-gray-800 border-b border-gray-200 item-total">
                                {{ $item->product->currency->symbol }}{{ $item->quantity * $item->product->price }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            

            <!-- Total -->
            <div class="flex justify-between items-center text-lg font-bold mt-6">
            <span>Total:</span>
            <span class="text-green-500 mr-3">
                {{ $item->product->currency->symbol }}{{ $cartItems->reduce(function ($carry, $item) {
                    return $carry + ($item->quantity * $item->product->price);
                }, 0) }}
            </span>
            </div>

            <!-- Proceed Button -->
            <form method="post" action="{{ route('checkout.remove') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                <button
                type="submit"
                class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg shadow-md transition duration-200"
                >
                Proceed to Payment
                </button>
            </form>
        </div>

    <script>
        // Simple Transaction Complete Message
        function completeTransaction() {
        document.getElementById("transaction-complete").classList.remove("hidden");
        }

        // Calculate Total Price
        function calculateTotal() {
            let total = 0;
           
            document.querySelectorAll(".item-price").forEach((priceElement) => {
          
            total += parseFloat(priceElement.innerText.replace("$", ""));
            });

            const formattedTotal = total % 1 === 0 ? total : total.toFixed(2);

            document.getElementById("total-price").innerText = `$${formattedTotal}`;
        }

        calculateTotal();
    </script>



</x-layout>