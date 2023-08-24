<x-app-layout>
    <div class="">
        <!-- START CONTENT -->
        <div class="mt-3">
            <div
                    class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
                <div class="font-medium text-color-primary">Giới thiệu</div>
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-transparent css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M16 16L18 5L14 9L12 4L10 9L6 5L8 16M8 16L6.553 16.724C6.38692 16.807 6.24722 16.9346 6.14955 17.0925C6.05188 17.2504 6.0001 17.4323 6 17.618V20H18V17.618C17.9999 17.4323 17.9481 17.2504 17.8504 17.0925C17.7528 16.9346 17.6131 16.807 17.447 16.724L16 16H8Z"
                          stroke="#1E2843" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12 5C12.5523 5 13 4.55228 13 4C13 3.44772 12.5523 3 12 3C11.4477 3 11 3.44772 11 4C11 4.55228 11.4477 5 12 5Z"
                          stroke="#1E2843" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M6 6C6.55228 6 7 5.55228 7 5C7 4.44772 6.55228 4 6 4C5.44772 4 5 4.44772 5 5C5 5.55228 5.44772 6 6 6Z"
                          stroke="#1E2843" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M18 6C18.5523 6 19 5.55228 19 5C19 4.44772 18.5523 4 18 4C17.4477 4 17 4.44772 17 5C17 5.55228 17.4477 6 18 6Z"
                          stroke="#1E2843" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            @foreach(\App\Models\ImgIntro::orderBy('order', 'asc')->get() as $col)
                <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 css-aoeo82 @if($loop->index == 0) mt-2  @endif">
                    <img src="{{ asset($col->path) }}">
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
                <div class="font-medium text-color-primary">Thống kê</div>
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-transparent css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M7.37142 10.2017V17.0619" stroke="#1E2843" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                    <path d="M12.0381 6.91913V17.0618" stroke="#1E2843" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                    <path d="M16.6286 13.8268V17.0619" stroke="#1E2843" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z"
                          stroke="#1E2843" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 mt-2 px-3 py-3 css-aoeo82">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1.5 css-sag665">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 css-1s50f5r">
                        <div>
                            <div class="text-lg font-bold text-color-primary">80</div>
                            <div class="text-sm max-line-1">Số lượng đối tác</div>
                        </div>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 css-1s50f5r">
                        <div>
                            <div class="text-lg font-bold text-color-primary">{{ \App\Http\Controllers\ApiController::currentUsers() }}</div>
                            <div class="text-sm max-line-1">Thành viên</div>
                        </div>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 css-1s50f5r">
                        <div>
                            <div class="text-lg font-bold text-color-primary">{{ ceil(\App\Http\Controllers\ApiController::currentUsers() / 24) }}</div>
                            <div class="text-sm max-line-1">Cộng tác viên</div>
                        </div>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 css-1s50f5r">
                        <div>
                            <div class="text-lg font-bold text-color-primary">{{ ceil(\App\Http\Controllers\ApiController::currentUsers() / 2) }}</div>
                            <div class="text-sm max-line-1">Khách hàng tiềm năng</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</x-app-layout>
