@extends('components.master-index')

@section('content')
    <div class="pagetitle">
        <h1>Measurement</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">Measurement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <h5 class="card-title">Select customer measurement to add/view</h5>

        <div class="iconslist">
            @if($customer->blouseDressSkirt)
                <a href="{{route('edit.blouse.dress.skirt')}}">
                    <div class="icon">
                        <i class="bi bi-gender-female"></i>
                        <div class="label">View Blouse/Dress/Skirt</div>
                    </div>
                </a>
            @else
            <a href="{{route('blouse.dress.skirt')}}">
                <div class="icon">
                    <i class="bi bi-gender-female"></i>
                    <div class="label">Add Blouse/Dress/Skirt</div>
                </div>
            </a>
            @endif

            @if($customer->kabaSlit)
            <a href="{{route('edit.kaba.slit')}}">
                <div class="icon">
                    <i class="bi bi-gender-female"></i>
                    <div class="label">View Kaba/Slit</div>
                </div>
            </a>
            @else
                <a href="{{route('kaba.slit')}}">
                    <div class="icon">
                        <i class="bi bi-gender-female"></i>
                        <div class="label">Add Kaba/Slit</div>
                    </div>
                </a>
            @endif

                @if($customer->suit)
            <a href="{{route('edit.suit')}}">
                <div class="icon">
                    <i class="bi bi-gender-trans"></i>
                    <div class="label">View Suit</div>
                </div>
            </a>
                @else
                    <a href="{{route('suit')}}">
                        <div class="icon">
                            <i class="bi bi-gender-trans"></i>
                            <div class="label">Add Suit</div>
                        </div>
                    </a>
                @endif

            @if($customer->shirt)
            <a href="{{route('edit.shirt')}}">
                <div class="icon">
                    <i class="bi bi-gender-male"></i>
                    <div class="label">View Shirt[long/short]</div>
                </div>
            </a>
            @else
                <a href="{{route('shirt')}}">
                    <div class="icon">
                        <i class="bi bi-gender-male"></i>
                        <div class="label">Add Shirt[long/short]</div>
                    </div>
                </a>
            @endif

            @if($customer->shortTrouser )
                <a href="{{route('edit.short.trouser')}}">
                    <div class="icon">
                        <i class="bi bi-gender-male"></i>
                        <div class="label">View Shorts/Trouser</div>
                    </div>
                </a>
            @else
            <a href="{{route('short.trouser')}}">
                <div class="icon">
                    <i class="bi bi-gender-male"></i>
                    <div class="label">Add Shorts/Trouser</div>
                </div>
            </a>
            @endif

        </div>

    </section>


@endsection

