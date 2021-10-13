<div class="flex flex-wrap" id="tabs-id">
    <div class="w-full">
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
            @php $i = 0 @endphp
            @foreach ($headers as $item)
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    @if ($i == 0)
                        <a class="cursor-pointer text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-gray-800" onclick="changeAtiveTab(event, 'tab-{{ $item['key'] }}')">
                            <i class="fas fa-space-shuttle text-base mr-1"></i>
                            {{ $item['text'] }}
                        </a>
                    @else
                        <a class="cursor-pointer text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-gray-800 bg-white" onclick="changeAtiveTab(event, 'tab-{{ $item['key'] }}')">
                            <i class="fas fa-cog text-base mr-1"></i>
                            {{ $item['text'] }}
                        </a>
                    @endif
                </li>
                @php $i++ @endphp
            @endforeach
        </ul>
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
            <div class="px-4 py-5 flex-auto">
                <div class="tab-content tab-space">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    if (typeof changeAtiveTab !== 'function') {
        function changeAtiveTab(event, tabID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            ulElement = element.parentNode.parentNode;
            aElements = ulElement.querySelectorAll("li > a");
            tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
            for (let i = 0; i < aElements.length; i++) {
                aElements[i].classList.remove("text-white");
                aElements[i].classList.remove("bg-gray-800");
                aElements[i].classList.add("text-gray-800");
                aElements[i].classList.add("bg-white");
                tabContents[i].classList.add("hidden");
                tabContents[i].classList.remove("block");
            }
            element.classList.remove("text-gray-800");
            element.classList.remove("bg-white");
            element.classList.add("text-white");
            element.classList.add("bg-gray-800");
            document.getElementById(tabID).classList.remove("hidden");
            document.getElementById(tabID).classList.add("block");
        }
    }
</script>
