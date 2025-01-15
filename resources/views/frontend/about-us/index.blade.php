@extends('layouts.frontend.app')

@section('content')
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-2 gap-4">
            <div class="py-12">
                <h1 class="font-semibold text-5xl pb-4">Bontemps</h1>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>

                <div class="my-5">
                    <x-frontend.global.reservation.button></x-frontend.global.reservation.button>
                </div>
            </div>

            <div>
                <img src="" alt="">
            </div>
        </div>

        <div class="bg-green-400 p-16 my-8 rounded-lg">
            <h2 class="font-semibold text-3xl pb-4">What is Lorem Ipsum?</h2>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in
        </div>

        <div class="grid lg:grid-cols-2 gap-4 mt-20 text-justify">
            <div class="p-12 self-center">
                <h1 class="font-semibold text-5xl pb-4">Bontemps</h1>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>

            <div class="grid lg:grid-cols-1 gap-y-10 px-12 mb-12">
                <div class="border border-green-400 p-4 rounded-lg">
                    <p class="font-semibold">
                        <span class="text-green-400">01</span>
                        Title
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h
                    </p>
                </div>

                <div class="border border-green-400 p-4 rounded-lg">
                    <p class="font-semibold">
                        <span class="text-green-400">02</span>
                        Title
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h
                    </p>
                </div>

                <div class="border border-green-400 p-4 rounded-lg">
                    <p class="font-semibold">
                        <span class="text-green-400">03</span>
                        Title
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
