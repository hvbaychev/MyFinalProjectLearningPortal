@extends('layouts.index')

@section('content')


<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>{{ $user->first_name }}`s Profile</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section bg-light overlay align-items-center text-center" style="background-size: 100% 100%;background-image: url({{ url('images/5541508_10972.jpg') }});">
    <div class="container text-center" style="width: 650px;">
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

    @if(isset($success))
        <div class="alert alert-success">{{ $success }}</div>
    @endif
    @if(isset($fail))
        <div class="alert alert-danger">{{ $fail }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif


    <div class="container-profile">

        <div class="profile-row">
            <div class="profile-div-min profile-div-colunm-left">

                        <label class="profile-lable" for="user_cv">CV</label>
                    @if( $user->user_cv )
                        <a href="{{ url( config('app.files_path').'cv/' . $user->user_cv) }}" download="{{$user->first_name}}-{{$user->last_name}}-{{$user->user_cv}}">
                            <img src="{{ url('images/doc-ok.png') }}" alt="CV" class="cv">
                        </a>
                    @else
                        <img src="{{ url('images/doc-no.png') }}" alt="CV" class="cv" >
                    @endif
 
            </div>
        
            <div class="profile-div-max profile-div-colunm-right">


                    <label class="profile-lable" for="avatar">Avatar</label>
                    <img src="{{ url( config('app.files_path').'avatar/' . $user->avatar) }}" alt="Avatar" class="avatar">

            </div>
        </div>


            <div class="profile-row">
                <div class="profile-div-colunm-left">
                    <label class="profile-lable" for="name" >First Name</label>
                    <input type="text" id="name" class="profile-input" name="first_name" value="{{ $user->first_name }}" disabled>
                </div>
                <div class="profile-div-colunm-right">
                    <label class="profile-lable" for="name">Last Name</label>
                    <input type="text" id="name" class="profile-input" name="last_name" value="{{ $user->last_name }}" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="email">Email Address</label>
                    <input type="text" id="email" class="profile-input" name="email" value="{{ $user->email }}" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="phone">Phone</label>
                    <input type="text" id="phone" class="profile-input" name="phone" value="@if ( empty($user->phone) ) not entered @else {{ $user->phone }} @endif" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="organization">Organization</label>
                    <input type="text" id="organization" class="profile-input" name="organization" value="@if ( empty($user->organization) ) not entered @else {{ $user->organization }} @endif" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="user_type">User access type</label>
                    <input type="text" id="user_type" class="profile-input" name="user_type" value="{{ $user->user_type }}" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-colunm-left">
                <label class="profile-lable" for="country">Country</label>
                    <input type="text" id="country" class="profile-input" name="country" value="@if ( empty($user->country) ) not entered @else {{ $user->country->name }} @endif" disabled>
                </div>
                <div class="profile-div-colunm-right">
                <label class="profile-lable" for="city">City</label>
                    <input type="text" id="city" class="profile-input" name="city" value="@if ( empty($user->city) ) not entered @else {{ $user->city->name }} @endif" disabled>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                User Languages
                </div>
            </div>
            @if ($user->userLanguages->isNotEmpty())
                    @foreach ($user->userLanguages as $userLanguage)
                        <div class="profile-row-list">
                            <div class="profile-div-max profile-div-colunm-middle">
                                <input type="text" class="profile-input" value="{{ $userLanguage->language->name }}" disabled>
                            </div>
                            <div class="profile-div-min profile-div-colunm-right2">
                                <input type="text" class="profile-input" value="{{ $userLanguage->level->name }}" disabled>
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="profile-row-list">
                    <input type="text" class="profile-input" disabled value="No languages added">
                </div>
                @endif

            <div class="profile-row">
                <div class="profile-div-row">
                    User Repositories
                </div>
            </div>
            @if ($user->repositories->isNotEmpty())
                @foreach ($user->repositories as $reposatory)
                    <div class="profile-row-list">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="text" id="repository" disabled class="profile-input" value="{{ $reposatory->description }}">                     
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile-row-list">
                <input type="text" class="profile-input" disabled value="No languages added">
            </div>
            @endif

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="info">Info</label>
                    <textarea id="info" class="profile-input" name="info" disabled style="height: 120px;">{{ $user->info }}</textarea> 
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                User URL
                </div>
            </div>
            @if ($user->webPages->isNotEmpty())
                @foreach ($user->webPages as $url)
                    <div class="profile-row-list">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="text" id="repository" disabled class="profile-input" value="{{ $url->description }}">                     
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile-row-list">
                <input type="text" class="profile-input" disabled value="No URL added">
            </div>
            @endif

            <div class="profile-row">
                <div class="profile-div-row">
                User Messenger
                </div>
            </div>
            @if ($user->messengerNames->isNotEmpty())
                @foreach ($user->messengerNames as $messenger)
                    <div class="profile-row-list">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="text" id="repository" disabled class="profile-input" value="{{ $messenger->description }}">                     
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile-row-list">
                <input type="text" class="profile-input" disabled value="No messenger added">
            </div>
            @endif

          <div class="profile-row">
                <div class="profile-div-row">
                User Hobbies
                </div>
            </div>
            @if ($user->hobbies->isNotEmpty())
                @foreach ($user->hobbies as $hobby)
                    <div class="profile-row-list">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="text" id="repository" disabled class="profile-input" value="{{ $hobby->description }}">                     
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile-row-list">
                <input type="text" class="profile-input" disabled value="No hobbies added">
            </div>
            @endif


          <div class="profile-row">
                <div class="profile-div-row">
                User Skills
                </div>
            </div>
            @if ($user->skills->isNotEmpty())
                @foreach ($user->skills as $skill)
                    <div class="profile-row-list">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="text" id="skill" disabled class="profile-input" value="{{ $skill->description }}">                     
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile-row-list">
                <input type="text" class="profile-input" disabled value="No skill added">
            </div>
            @endif




    </div>
    <div class="back-button" style="margin-bottom: 20px;">
        <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
    </div>

  </div>
</section>

@endsection

