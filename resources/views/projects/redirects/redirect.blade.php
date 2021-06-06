<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-map-signs"></i>{{ __('Welcome') }}
        </h2>
    </x-slot>
    <div class="outer-main">
        <div class="container">
            <div class="row">
                <div class="page-text">
                    <h1>{{$status}}</h1>
                    @if($status == "Complete")
                    <p>This survey is complete. Thanks</p>
                    @endif
                    @if($status == "Disqualify")
                    <p>Sorry, but are disqualified from the survey.</p>
                    @endif
                    @if($status == "Quotafull")
                    <p>Sorry, survey limit is reached.</p>
                    @endif
                    @if($status == "Qualityterm")
                    <p>Sorry, but you have been disqualified from the survey due to some quality issue.</p>
                    @endif
                    @if($status == "Unavailable")
                    <p>Currently, Survey is Unavailable</p>
                    @endif
                    <p><a href="javascript:void(0)">Visit Site</a></p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
