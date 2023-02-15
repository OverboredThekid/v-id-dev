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
                                <label class="text-black" for="{{$key}}" style="color: black;">{{$value}}</label></br>
                                <select id="{{$key}}" wire:model="{{$key}}" wire:key="idKey-{{$key}}" style="color:black !important;" class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base text-black sm:text-sm" data-selected-value="{{$selectedOptions[$key] ?? ''}}">
                                    <option value="" disabled style="color:black !important;"><span>Select ID</span></option>
                                    @foreach($svgIds as $svgId)
                                    <option value="{{$svgId}}" style="color:black !important;"><span>{{ $svgId }}</span></option>
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
                <div class="flex justify-center space-x-12 " style='margin-top: 5px;'>
                    <button type="submit" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action" style="margin-right:5px;">Save</button>
                    <button class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action" wire:click="$emit('closeModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>