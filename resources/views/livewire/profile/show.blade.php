<?php
use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {

    public $showPopup = false;
    public $profileLink = 'https://www.example.com/user-profile';
    public $user;

    public function togglePopup()
    {
        $this->showPopup = !$this->showPopup;
    }

    public function mount()
    {
        session_start();
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $lastSegment = trim(basename($path));

        if (is_numeric($lastSegment)) {
            // If $lastSegment is a number, consider it as an ID
            $this->user = User::where('id', $lastSegment)->first();
        } else {
            // If $lastSegment is not a number, consider it as a username
            $this->user = User::where('username', $lastSegment)->first();
        }

        if (!$this->user) {
            abort(404);
            die("404 Error not found");
            exit();
        }
    }
};

?>
<div dir="ltr">

    @if (3 == 4)
        <p>کاربر پیدا نشد.</p>

    @else


        <!DOCTYPE html>
        <html lang="fa" dir="ltr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        </head>
        <body>
        <div class="h-full">
            <div class="bg-white rounded-lg shadow-xl pb-8">
                <div x-data="{ openSettings: false }" class="absolute right-12 mt-4 rounded">
                    <button @click="openSettings = !openSettings" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                    <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute right-0 w-40 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                        <div class="py-2 border-b">

                            <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                                <span class="text-sm text-gray-700" >همرسانی</span>

                            </button>






                        </div>
                        <div class="py-2">

                            <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">گزارش</span>
                            </button>

                            <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">

                                <span class="text-sm text-gray-700">بازخورد</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full h-[300px] ">
                    <img src="https://abinot.ir/gallery/back_1.jpg" alt="Cover Image" class="w-full h-full object-cover object-top">
                </div>




                <div class="flex flex-col -mt-20 pl-5">
                    <img src="https://abinot.ir/school/img/default_profile_image.png" class="w-40 border-4 border-white rounded-full">
                    <div class="flex items-center space-x-2 mt-2 pl-10">
                        <p class="text-2xl">{{$user->name}}</p>
                        <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                    </div>
                    <p class="text-gray-700 pl-10">
                        @if(isset($user->username))
                        ({{$user->username}})
                        @endif





                    </p>
                    <p class="text-sm text-gray-500 pl-10">

                        @if($user && $user->data)
                            @foreach($user->data as $data)
                                @if($data['key'] == "header")
                                    {{$data['value']}}

                                @endif
                            @endforeach
                        @endif

                    </p>
                </div>
                <br>
                <br>
                <p class="text-sm text-gray-700 pl-16">
                    @if($user && $user->data)
                        @foreach($user->data as $data)
                            @if($data['key'] == "header2")
                                {{$data['value']}}

                            @endif
                        @endforeach
                    @endif
                    <br>
                </p>



                {{-- /// connect and chat button ///--}}



            </div>

            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">

            <div class="flex flex-col w-full 2xl:w-2/3">
    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
        {{-- <h4 class="text-xl text-gray-900 font-bold"> ////////// </h4> --}}
        <p class="mt-2 text-gray-700">
            @if($user && $user->data)
                @php $hasData = false; @endphp
                @foreach($user->data as $data)
                    @if(($data['key'] == "biography" || $data['key'] == "text") && $data['show'] == 2)
                        @php $hasData = true; @endphp
                        <li class="flex py-2">
                            <span class="text-gray-700">{{$data['value']}}</span>
                        </li>
                    @endif
                @endforeach

                @if(!$hasData)
                    <p>داده‌ای وجود ندارد.</p>
                @endif
            @else
                <p>داده‌ای وجود ندارد.</p>
            @endif
        </p>
    </div>
</div>


                <div class="w-full flex flex-col 2xl:w-1/3">
                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                        {{--                        <h4 class="text-xl text-gray-900 font-bold">Personal Info</h4>--}}
                        <ul class="mt-2 text-gray-700">
    @if($user && $user->data)
        @php $hasData = false; @endphp
        @foreach($user->data as $data)
            @if($data['show'] == 2 && $data['key'] !== "biography" && $data['key'] !== "text")
                @php $hasData = true; @endphp
                <li class="flex border-y py-2">
                    <span class="font-bold w-24">{{$data['key']}}:</span>
                    <span class="text-gray-700">{{$data['value']}}</span>
                </li>
            @endif
        @endforeach

        @if(!$hasData)
            <p>داده‌ای وجود ندارد.</p>
        @endif
    @else
        <p>داده‌ای وجود ندارد.</p>
    @endif
</ul>


                    </div>

                </div>
            </div>
        </div>

</div>

</body>
</html>
@endif
</div>
