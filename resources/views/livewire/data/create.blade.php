<?php

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;

new class extends Component {
    #[Validate('required|string|max:255')]
    public string $key = '';
    public bool $keyDisabled = false;

    public function updatedKey()
    {

        $this->keyDisabled = false;  // Reactivate the key field when the user types
    }

    public function CustomInput()
    {
        $this->key = '';
        $this->keyDisabled = false;  // Reactivate the key field when the user types
    }

    public function selectKeyOption($option)
    {
        $this->key = $option;
        $this->keyDisabled = true;  // Disable the key field after selecting an option
    }


    #[Validate('required|string|max:5000')]
    public string $value = '';


    public $show = 2;



    #[Validate('required|exists:users,id')]
    public string $selected_user;
    public function mount() {
        $this->selected_user = auth()->id(); }
    public function store()
    {


            if($this->show = 2){

                $validated = $this->validate();

                $user = User::find($this->selected_user);


                if ($user) {
                    // ثبت داده‌ها برای کاربر با شناسه مشخص شده

                    $user->data()->create([
                        'key' => $this->key,
                        'value' => $this->value,
                        'show' => $this->show,
                        'added_by' => auth()->id(),
                    ]);
                    $this->key = '';
                    $this->value = '';
                    $this->show = 2;
                    $this->dispatch('data-created');

                }
            }




    }
};
?>




        <div>
<div class="w-1/2 m-5 p-6">
            <form wire:submit="store">
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <input
                        wire:model="key"
                        type="text"
                        placeholder="{{ __('کلید') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        @if($keyDisabled)  disabled @endif
                    >
                @endif
                <br>
                <input
                    wire:model="key"
                    type="text"
                    placeholder="{{ __('کلید') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    @if($keyDisabled)  disabled @endif
                >
                <br>

                <div class="suggestions-list ">
                    <style>
                        .suggestion-btn{
                            background-color: #3b82f6; color: white;
                        }
                        .suggestion-btn2{
                            padding: 7px 7px; /* Size of the button */
                            margin: 5px;
                            font-size: 15px; /* Base font size */
                            color: white; /* Text color */
                            background-color: #b0b1b5; /* Button color */
                            border: none; /* No border */
                            border-radius: 5px; /* Rounded corners */
                            cursor: pointer; /* Pointer cursor on hover */


                        }

                    </style>
                    <button  type="button" class="suggestion-btn2 custom-btn" wire:click="CustomInput()" @if(!$keyDisabled) style="background-color: #91b9fd;"  @endif >سفارشی</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('text')"  @if($key === 'text') style="background-color: #91b9fd;"  @endif>متن</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('biography')"  @if($key === 'biography') style="background-color: #91b9fd;"  @endif>درباره من</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('link')"  @if($key === 'link') style="background-color: #91b9fd;"  @endif>لینک</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('email')"  @if($key === 'email') style="background-color: #91b9fd;"  @endif>ایمیل</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('phone number')"  @if($key === 'phone number') style="background-color: #91b9fd;"  @endif>شماره تلفن</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('address')"  @if($key === 'address') style="background-color: #91b9fd;"  @endif>آدرس</button>
                    <br>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('date of birth')"  @if($key === 'date of birth') style="background-color: #91b9fd;"  @endif>تاریخ تولد</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('marital status')"  @if($key === 'marital status') style="background-color: #91b9fd;"  @endif>وضعیت تاهل</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('goal')"  @if($key === 'goal') style="background-color: #91b9fd;"  @endif>اهداف</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('campaign')"  @if($key === 'campaign') style="background-color: #91b9fd;"  @endif>کمپین</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('headline')"  @if($key === 'headline') style="background-color: #91b9fd;"  @endif>عنوان شغلی</button>
                    <button  type="button" class="suggestion-btn2" wire:click="selectKeyOption('skill')"  @if($key === 'skill') style="background-color: #91b9fd;"  @endif>مهارت</button>
                </div>


                <br>
                <textarea
                    wire:model="value"
                    placeholder="{{ __('مقدار') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>

                <div>
                    <x-input-error for="key" class="mt-2" />
                    <x-input-error for="value" class="mt-2" />
                    <x-input-error for="show" class="mt-2" />
                    <x-input-error for="selected_user" class="mt-2" />


                    <x-button class="mt-4">{{ __('افزودن') }}</x-button>
                </div>

            </form>
</div>
        </div>

