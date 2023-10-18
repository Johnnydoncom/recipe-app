
<div class="mb-0 mt-auto py-5">
    <div class="container p-5 bg-primary rounded-4xl flex flex-col">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:mb-10">

            <div class="order-last lg:order-last w-full text-white text-right sm:text-right">
                <a href="{{route('index')}}" class="btn btn-ghost bg-white text-primary uppercase mb-4">Contact Us</a>
                <div class="text-white text-sm">
                    <p>+1 (999) 999-99-99</p>
                    <p><a href="mailto:info@logoipsum.com">info@logoipsum.com</a></p>
                </div>
                <div class="flex lg:hidden gap-2 justify-end items-center mt-4">
                    <div class="border rounded-full border-secondary w-8 h-8 flex flex-col items-center justify-center p-1.5">
                        <img src="{{Storage::url('images/telegram-icon.svg')}}" alt="Telegram" class="">
                    </div>
                    <div class="border rounded-full border-secondary w-8 h-8 flex flex-col items-center justify-center p-1.5">
                        <img src="{{Storage::url('images/whatsapp-icon.svg')}}" alt="WhatsApp" class="">
                    </div>
                </div>
            </div>

            <div class="flex order-2 sm:order-first lg:order-2 flex-row lg:flex-row gap-4">
                <div class="text-white flex flex-col lg:flex-row gap-6 lg:gap-24">
                    <div>
                        <h3 class="mb-3 sm:mb-4 font-bold uppercase text-secondary underline">Information</h3>
                        <ul class="list-none space-y-2 text-sm">
                            <li>
                                <a href="#" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all">
                                    Privacy
                                </a>
                            </li>
                            <li>
                                <a href="#" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all">
                                    FAQ
                                </a>
                            </li>
                            <li>
                                <a href="#" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-3 sm:mb-4 font-bold uppercase text-secondary underline">Menu</h3>
                        <ul class="list-none space-y-2 text-sm">
                            <li>
                                <a href="{{route('recipes.index')}}" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all" wire:navigate>
                                    Recipes
                                </a>
                            </li>
                            <li>
                                <a href="{{route('recipes.index')}}" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all" wire:navigate>
                                    Restaurants
                                </a>
                            </li>
                            <li>
                                <a href="{{route('users.index')}}" class="transition ease-in-out duration-300 delay-150 hover:text-secondary hover:transition-all" wire:navigate>
                                    Users
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-xs font-sans order-first sm:order-last lg:order-first lg:col-span-1 sm:col-span-2">
                <div class="flex justify-start lg:justify-start sm:justify-end mb-5">
                    <a href="{{route('index')}}">
                        <x-application-logo class="text-white font-bold text-2xl lg:text-3xl" />
                        <span class="sr-only">{{config('app.name')}}</span>
                    </a>
                </div>
            </div>
        </div>


        <div class="hidden lg:flex gap-2 items-center mt-auto">
            <div class="border rounded-full border-secondary w-8 h-8 flex flex-col items-center justify-center p-1.5">
                <img src="{{Storage::url('images/telegram-icon.svg')}}" alt="Telegram" class="">
            </div>
            <div class="border rounded-full border-secondary w-8 h-8 flex flex-col items-center justify-center p-1.5">
                <img src="{{Storage::url('images/whatsapp-icon.svg')}}" alt="WhatsApp" class="">
            </div>
        </div>
    </div>
</div>
