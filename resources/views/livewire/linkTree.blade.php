<div>
<div class="container mx-auto">
        <div class="col-xs-12">
            <div class="text-center py-10">
                <img class="backdrop linktree">
                <h2 class="text-white py-5">{{ config('app.name', 'Company Links') }}</h2>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
            </div>
        </div>
    </div>

    @extends($layout)

{!! $slug->data['content']['content'] !!}
</div>