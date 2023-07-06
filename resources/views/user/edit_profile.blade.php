@extends('layouts.index')

@section('content')


<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Edit {{ $user->first_name }}`s Profile</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

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
                <form action="{{ route('user.update_cv', ['user' => $user]) }}" method="post"  enctype="multipart/form-data" id="update_cv">
                    @method('PUT')
                    @csrf
                        <label class="profile-lable" for="user_cv">CV</label>
                    @if( $user->user_cv )
                        <a href="{{ url( config('app.files_path').'cv/' . $user->user_cv) }}" download="{{$user->first_name}}-{{$user->last_name}}-{{$user->user_cv}}">
                            <img src="{{ url('images/doc-ok.png') }}" alt="CV" class="cv" onclick="document.getElementById('cv_browse').click();">
                        </a>
                    @else
                        <img src="{{ url('images/doc-no.png') }}" alt="CV" class="cv" onclick="document.getElementById('cv_browse').click();">
                    @endif
                    <br/>
                    <input type="file" name="user_cv" id="cv_browse" accept=".pdf,.doc,.docx,.txt" style="display: none;">
                    <input type="submit" value="Upload avatar" class="btn btn-primary" id="submitButtonCV" style="display: none;">
                    <label for="cv_browse" id="browseButton" class="browse-button btn btn-primary" >Update CV</label>
                    <script>
                        document.getElementById('cv_browse').addEventListener('change', function() {
                        document.getElementById('submitButtonCV').click();
                        });
                    </script>
                </form>
            </div>
        
            <div class="profile-div-max profile-div-colunm-right">

            <form action="{{ route('user.update_avatar', ['user' => $user]) }}" method="post"  enctype="multipart/form-data" id="update_avatar">
                @method('PUT')
                @csrf
                    <label class="profile-lable" for="avatar">Avatar</label>
                    <img src="{{ url( config('app.files_path').'avatar/' . $user->avatar) }}" alt="Avatar" class="avatar" onclick="document.getElementById('avatar_browse').click();">
                    <input type="file" name="avatar" id="avatar_browse" accept="image/*" style="display: none;">
                    <input type="submit" value="Upload avatar" class="btn btn-primary" id="submitButton" style="display: none;">
                    <label for="avatar_browse" id="browseButton" class="browse-button btn btn-primary" >Update avatar</label>
                    <script>
                        document.getElementById('avatar_browse').addEventListener('change', function() {
                        document.getElementById('submitButton').click();
                        });
                    </script>
                </form>
            </div>
        </div>

    <form action="{{ route('user.profile.update', ['user' => $user]) }}" method="post">
    @method('PUT')
    @csrf

            <div class="profile-row">
                <div class="profile-div-colunm-left">
                    <label class="profile-lable" for="name" >First Name</label>
                    <input type="text" id="name" class="profile-input" name="first_name" value="{{ $user->first_name }}">
                    @error('first_name') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
                <div class="profile-div-colunm-right">
                    <label class="profile-lable" for="name">Last Name</label>
                    <input type="text" id="name" class="profile-input" name="last_name" value="{{ $user->last_name }}">
                    @error('last_name') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-max profile-div-colunm-left2">
                    <label class="profile-lable" for="email">Email Address</label>
                    <input type="text" id="email" class="profile-input" name="email" value="{{ $user->email }}" disabled>
                </div>
                <div class="profile-div-min profile-div-colunm-right2">
                    <a style="margin-left: 5px;" href="{{ route('user_update_email') }}" class="btn btn-primary">Update email</a>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="phone">Phone</label>
                    <input type="text" id="phone" class="profile-input" name="phone" value="{{ $user->phone }}">
                    @error('phone') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="organization">Organization</label>
                    <input type="text" id="organization" class="profile-input" name="organization" value="{{ $user->organization }}">
                    @error('organization') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="user_type">Access type</label>
                    @if (auth()->user() && auth()->user()->user_type == 'admin')
                        <select id="user_type" class="profile-input" name="user_type">
                            <option value=""></option>
                            @foreach($user_types as $type)
                                <option value="{{ $type->type_code }}" {{ $user->user_type == $type->type_code ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" class="profile-input" value="{{ auth()->user()->user_type }}" disabled>
                    @endif
                    @error('user_type') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>


        @if (auth()->user() && $user->user_type == 'business') 
        
        <div class="profile-row">
            <div class="profile-div-row" style="display: flex; align-items: center; justify-content: space-between;">
                <label class="profile-lable" for="assigned_courses">Assigned courses</label>
                @foreach ($user->courses as $course)
                    <div class="row">
                        <div class="col">
                            <input style="border:none;" type="text" name="assigned_courses" id="assigned_courses_{{ $course->id }}" class="profile-input" value="{{ $course->name }}" readonly>
                            
                            @if (auth()->user() && auth()->user()->user_type == 'admin')
                                <label class="profile-label" for="remove_course_{{ $course->id }}">Remove from list</label>
                                <input type="checkbox" id="remove_course_{{ $course->id }}" name="course_ids[]" value="{{ $course->id }}">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if (auth()->user() && auth()->user()->user_type == 'admin')
            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="user_type">Assign to course</label>
                    <select id="assign_to_course" class="profile-input" name="assign_to_course">
                        <option value="NULL"></option>
                        @foreach($courses_m as $course)
                            <option value="{{ $course->id }}"
                                @foreach($user->courses as $user_course)
                                    @if($user_course->course_id == $course->id)
                                        selected
                                    @endif
                                @endforeach
                            >
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('assign_to_courses') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>
        @endif


        @endif
        
            <div class="profile-row">
                <div class="profile-div-colunm-left">

                    <div class="profile-row-inter">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" class="profile-btn btn-primary" title="Add country" id="add-country">+</a>
                        </div>
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="hidden" id="country" class="profile-input" name="country" value="country-select">
                            <label class="profile-lable" for="country-input">Country</label>
                            <input type="text" id="country-input" class="profile-input" style="display: none;" name="country-input" placeholder="input value">
                            <select id="country-select" class="profile-input" name="country-select">
                                <option value="NULL">no selected</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" 
                                    @if ($country->id == $user->country_id)
                                        selected
                                    @endif
                                    >{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

<script>
    document.getElementById('add-country').addEventListener('click', function(event) {
        event.preventDefault();

        var countryInput = document.getElementById('country-input');
        var countrySelect = document.getElementById('country-select');
        var addCountryLink = document.getElementById('add-country');
        var countryElement = document.getElementById('country');

        
        if (countryInput.style.display === 'none') {
            countryInput.style.display = 'block';
            countrySelect.style.display = 'none';
            addCountryLink.textContent = '-';
            addCountryLink.title = "Select country"
            countryElement.value = 'country-input';
        } else {
            countryInput.style.display = 'none';
            countrySelect.style.display = 'block';
            addCountryLink.textContent = '+';
            addCountryLink.title = "Add country"
            countryElement.value = 'country-select';
        }
    });
</script>

<!-- ---- -->


                <div class="profile-div-colunm-right">
                    <div class="profile-row-inter">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" class="profile-btn btn-primary" title="Add city" id="add-city">+</a>
                        </div>
                        <div class="profile-div-max profile-div-colunm-right2">
                            <input type="hidden" id="city" class="profile-input" name="city" value="city-select">
                            <label class="profile-lable" for="city-input">City</label>
                            <input type="text" id="city-input" class="profile-input" style="display: none;" name="city-input" placeholder="input value">
                            <select id="city-select" class="profile-input" name="city-select">
                                <option value="NULL">no selected</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" 
                                    @if ($city->id == $user->city_id)
                                        selected
                                    @endif
                                    >{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

<script>
    document.getElementById('add-city').addEventListener('click', function(event) {
        event.preventDefault();

        var cityInput = document.getElementById('city-input');
        var citySelect = document.getElementById('city-select');
        var addCityLink = document.getElementById('add-city');
        var cityElement = document.getElementById('city');
        
        if (cityInput.style.display === 'none') {
            cityInput.style.display = 'block';
            citySelect.style.display = 'none';
            addCityLink.textContent = '-';
            addCityLink.title = "Select city"
            cityElement.value = 'city-input';
        } else {
            cityInput.style.display = 'none';
            citySelect.style.display = 'block';
            addCityLink.textContent = '+';
            addCityLink.title = "Add city"
            cityElement.value = 'city-select';
        }
    });
</script>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                User Languages
                </div>
            </div>
            @if ($user->userLanguages->isNotEmpty())
                    @foreach ($user->userLanguages as $userLanguage)
                        <div class="profile-row-list">
                            <div class="profile-div-min profile-div-colunm-left2">
                                <a href="#" onclick="document.getElementById('remove-user-language-{{ $userLanguage->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove language">-</a>
                            </div>
                            <div class="profile-div-max profile-div-colunm-middle">
                                <input type="text" class="profile-input" disabled value="{{ $userLanguage->language->name }}">
                            </div>
                            <div class="profile-div-min profile-div-colunm-right2">
                                <select class="profile-input" name="user-language-id-{{ $userLanguage->language->id }}" id="user-language-id-{{ $userLanguage->language->id }}">
                                    @foreach($languageLevels as $level)
                                        <option value="{{ $level->id }}" 
                                        @if ( $userLanguage->level->id == $level->id )
                                        selected
                                        @endif
                                        >{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="profile-row-list">
                    <input type="text" class="profile-input" disabled value="No languages added">
                </div>
                @endif
            



            <div class="profile-row">
                <div class="profile-div-min profile-div-colunm-left2">
                    <a href="#" class="profile-btn btn-primary" title="Add language"  id="add-language">+</a>
                </div>
                <div class="profile-div-max profile-div-colunm-middle">
                    <input type="hidden" id="language" class="profile-input" name="language" value="language-select">
                    <label class="profile-lable" for="language">Add Language</label>
                    <input type="text" id="language-input" class="profile-input" style="display: none;" name="language-input" placeholder="input value">
                    <select id="language-select" class="profile-input" name="language-select">
                        <option value="NULL">no selected</option>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="profile-div-min profile-div-colunm-right2">
                    <label class="profile-lable" for="language-level">Language level</label>
                    <select id="language-level" class="profile-input" name="language-level">
                        <option value="NULL">no select</option>
                        @foreach($languageLevels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('language-level')
            <div class="profile-row-list">
                <span class="text-danger"> {{$message}} </span>
            </div>
            @enderror
            @error('language')
            <div class="profile-row-list">
                <span class="text-danger"> {{$message}} </span>
            </div>
            @enderror

<script>
    document.getElementById('add-language').addEventListener('click', function(event) {
        event.preventDefault();

        var languageInput = document.getElementById('language-input');
        var languageSelect = document.getElementById('language-select');
        var addLanguageLink = document.getElementById('add-language');
        var cityElement = document.getElementById('language');

        if (languageInput.style.display === 'none') {
            languageInput.style.display = 'block';
            languageSelect.style.display = 'none';
            addLanguageLink.textContent = '-';
            addLanguageLink.title = "Select city"
            cityElement.value = 'language-input';
        } else {
            languageInput.style.display = 'none';
            languageSelect.style.display = 'block';
            addLanguageLink.textContent = '+';
            addLanguageLink.title = "Add city"
            cityElement.value = 'language-select';
        }
    });

    var selectElement = document.getElementById('language-level');


    var maxOptionWidth = 0;
    for (var i = 0; i < selectElement.options.length; i++) {
    var optionWidth = selectElement.options[i].text.length;
    if (optionWidth > maxOptionWidth) {
        maxOptionWidth = optionWidth;
    }
    }
    selectElement.style.width = maxOptionWidth + 'ch';

    var levelElements = document.querySelectorAll('[id^="user-language-id"]');
    for (var i = 0; i < levelElements.length; i++) {
    levelElements[i].style.width = maxOptionWidth + 'ch';
    }
</script>


            <div class="profile-row">
                <div class="profile-div-row">
                    User Repositories
                </div>
            </div>
            @if ($user->repositories->isNotEmpty())
                @foreach ($user->repositories as $reposatory)
                    <div class="profile-row-list">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" onclick="document.getElementById('remove-repo-{{ $reposatory->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove reposataory">-</a>
                        </div>
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
                    <label class="profile-lable" for="repository">Add Repository</label>
                    <input type="text" id="repository" class="profile-input" name="repository" value="{{ $user->repository }}">
                    <span class="text-danger">@error('repository') {{$message}} @enderror</span>
                </div>
            </div>

            
            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="info">Short info</label>
                    <textarea id="info" class="profile-input" name="info" style="height: 120px;">{{ $user->info }}</textarea>
                </div>
            </div>
            
            
            <hr>





            <div class="profile-row">
                <div class="profile-div-row">
                User URL
                </div>
            </div>
            @if ($user->webPages->isNotEmpty())
                @foreach ($user->webPages as $url)
                    <div class="profile-row-list">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" onclick="document.getElementById('remove-url-id-{{ $url->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove reposataory">-</a>
                        </div>
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
                  <label class="profile-lable" for="url">Add Url</label>
                  <input type="text" id="url" class="profile-input" name="url">
                  <span class="text-danger">@error('url') {{$message}} @enderror</span>
              </div>
          </div>



            <div class="profile-row">
                <div class="profile-div-row">
                User Messenger
                </div>
            </div>
            @if ($user->messengerNames->isNotEmpty())
                @foreach ($user->messengerNames as $messenger)
                    <div class="profile-row-list">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" onclick="document.getElementById('remove-messenger-id-{{ $messenger->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove messenger">-</a>
                        </div>
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
                  <label class="profile-lable" for="messenger">Add Messenger</label>
                  <input type="text" id="messenger" class="profile-input" name="messenger">
                  <span class="text-danger">@error('messenger') {{$message}} @enderror</span>
              </div>
          </div>



          <div class="profile-row">
                <div class="profile-div-row">
                User Hobbies
                </div>
            </div>
            @if ($user->hobbies->isNotEmpty())
                @foreach ($user->hobbies as $hobby)
                    <div class="profile-row-list">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" onclick="document.getElementById('remove-hobby-id-{{ $hobby->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove messenger">-</a>
                        </div>
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
                  <label class="profile-lable" for="hobby">Add Hobby</label>
                  <input type="text" id="hobbies" class="profile-input" name="hobby">
                  <span class="text-danger">@error('messenger') {{$message}} @enderror</span>
              </div>
          </div>



          <div class="profile-row">
                <div class="profile-div-row">
                User Skills
                </div>
            </div>
            @if ($user->skills->isNotEmpty())
                @foreach ($user->skills as $skill)
                    <div class="profile-row-list">
                        <div class="profile-div-min profile-div-colunm-left2">
                            <a href="#" onclick="document.getElementById('remove-skill-id-{{ $skill->id }}').submit(); return false;" class="profile-btn btn-primary profile-btn-remove" title="Remove skill">-</a>
                        </div>
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

          <div class="profile-row">
              <div class="profile-div-row">
                  <label class="profile-lable" for="skill">Add Skill</label>
                  <input type="text" id="skill" class="profile-input" name="skill">
                  <span class="text-danger">@error('skill') {{$message}} @enderror</span>
              </div>
          </div>


          <div class="profile-row">
              <div class="profile-div-colunm-left">
                  <a href="{{ route('user_update_password') }}" class="btn btn-primary">Update password</a>
              
                  <input type="submit" value="Update" class="btn btn-primary" style="margin-left:50px;">
                  @if (auth()->user() && auth()->user()->user_type == 'admin')
                    <a href="{{ route('user.index') }}" class="btn btn-primary" >Back</a>
                  @else    
                    <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
                  @endif
              </div>
            </div>
        </form>
    </div>
  </div>
</section>


@if ($user->repositories->isNotEmpty())
    @foreach ($user->repositories as $reposatory)
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'Repository', 'id' => $reposatory->id ]) }}" method="POST" id="remove-repo-{{ $reposatory->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif

@if ($user->userLanguages->isNotEmpty())
    @foreach ($user->userLanguages as $userLanguage)q
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'UserLanguage', 'id' => $userLanguage->id ]) }}" method="POST" id="remove-user-language-{{ $userLanguage->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif

@if ($user->webPages->isNotEmpty())
    @foreach ($user->webPages as $url)
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'WebPage', 'id' => $url->id ]) }}" method="POST" id="remove-url-id-{{ $url->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif

@if ($user->messengerNames->isNotEmpty())
    @foreach ($user->messengerNames as $messenger)
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'MassangerName', 'id' => $messenger->id ]) }}" method="POST" id="remove-messenger-id-{{ $messenger->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif

@if ($user->hobbies->isNotEmpty())
    @foreach ($user->hobbies as $hobby)
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'Hobby', 'id' => $hobby->id ]) }}" method="POST" id="remove-hobby-id-{{ $hobby->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif

@if ($user->skills->isNotEmpty())
    @foreach ($user->skills as $skill)
        <form action="{{ route('user.detail.delete', ['user' => $user, 'detail' => 'Skill', 'id' => $skill->id ]) }}" method="POST" id="remove-skill-id-{{ $skill->id }}">
        @method('delete')
        @csrf
        </form>
    @endforeach
@endif



@endsection

