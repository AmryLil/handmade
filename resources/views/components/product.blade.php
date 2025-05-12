        <div
            class="transition-all duration-150 ease-in-out fixed top-24 z-50 hidden bg-white p-2 rounded-lg shadow-md w-[60%]  gap-2 h-[80vh]">
            <!-- Product Image -->
            <div class="w-1/2 flex justify-center relative">
                <button onclick="closeModal()"
                    class="absolute -start-1 text-slate-950 font-bold text-center bg-slate-50 p-3 rounded-br-md text-3xl">
                    <img class="w-5" src="{{ asset('images/close.png') }}" alt="close"></button>
                <img src="{{ asset('images/ktr2.jpg') }}" alt="Citizen Axiom" class="w-full h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="w-1/2  flex flex-col p-2 h-full justify-between">
                <div class="text-start mt-2">
                    <h1 class="text-4xl font-bold">Example Product</h1>
                    <p class="text-base text-gray-900 font-light">Category product</p>
                </div>
                <div class="h-0.5 w-full bg-slate-900 mt-4"></div>

                <!-- Color Options -->

                <!-- Product Specs -->
                <div class="mt-6 text-base">
                    <p class="text-base text-gray-900 font-light">Description</p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia eveniet
                        necessitatibus non repellendus accusamus.
                    </p>
                </div>
                <div class="flex justify-start mt-2 items-center space-x-4">
                    <!-- Minus Button -->
                    <div class="text-lg font-semibold">
                        Quantity
                    </div>
                    <div class="flex gap-2">
                        <button id="decrement"
                            class="bg-gray-200 text-gray-800 font-bold rounded-sm h-6 w-6 flex justify-center items-center hover:bg-gray-300">
                            -
                        </button>

                        <!-- Quantity Display -->
                        <span id="qty" class="text-base font-semibold">1</span>

                        <!-- Plus Button -->
                        <button id="increment"
                            class="bg-gray-200 text-gray-800 font-bold rounded-sm h-6 w-6 flex justify-center items-center hover:bg-gray-300">
                            +
                        </button>
                    </div>
                </div>
                <!-- Price -->
                <div class="mt-6 text-start">
                    <p class="text-5xl font-bold">Rp 200.000</p>
                </div>

                <!-- Add to Cart Button -->
                <div class="mt-2 mb-2 flex justify-center w-full gap-2 justify-self-end">
                    <button class="bg-black text-white py-2 px-4 rounded-md hover:bg-gray-900 w-[80%]">
                        Checkout Now
                    </button>
                    <button class=" w-[20%] bg-black justify-center flex rounded-md">
                        <img src="{{ asset('images/carts.png') }}" alt="" class="h-12 ">
                    </button>
                </div>
            </div>
        </div>
