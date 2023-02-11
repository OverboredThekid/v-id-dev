<div>
    <!-- ID info -->
    <div class="mx-auto max-w-2xl px-4 pt-5 pb-5 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-5 lg:pb-10">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">SVG ID Assignment ({{$whichSide}})</h1>
            <div class="lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-3 lg:pb-3 lg:pr-8">
            <!-- Live View -->
            <div class="hidden md:block">
                <h3 class="text-sm font-medium text-gray-900">Live View</h3>
                <div class="mt-4" id="svg-form">
                    {!! $svgContent !!}
                </div>
            </div>
        </div>
        </div>
        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
            <h2 class="sr-only">SVG ID Assignment</h2>
            <form class="mt-10" wire:submit.prevent="submitForm">
                <!-- Sizes -->
                <div class="mt-10">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-900">Available Options</h3>
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-green-500">Guide</a>
                    </div>
                    <ul role="list" class="list-disc space-y-2 pt-2 pl-4 text-sm">
                        <div>
                            @foreach($side as $key => $value)
                            <li>
                                <label class="text-black" for="{{$key}}">{{$value}}</label></br>
                                <select id="{{$key}}" wire:model="{{$key}}" wire:key="idKey-{{$key}}" data-selected-value="{{$selectedOptions[$key] ?? ''}}">
                                    <option value="" disabled>Select ID</option>
                                    @foreach($svgIds as $svgId)
                                    <option value="{{$svgId}}">{{ $svgId }}</option>
                                    @endforeach
                                </select>
                            </li>
                            @endforeach
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var selectElements = document.querySelectorAll("select");
                                selectElements.forEach(function(selectElement) {
                                    var selectedValue = selectElement.getAttribute("data-selected-value");
                                    var options = selectElement.querySelectorAll("option");
                                    options.forEach(function(option) {
                                        if (option.value === selectedValue) {
                                            option.setAttribute("selected", true);
                                        }
                                    });
                                });
                            });
                        </script>

                    </ul>
                </div>
                <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save Selections</button>
            </form>
        </div>
    </div>
</div>