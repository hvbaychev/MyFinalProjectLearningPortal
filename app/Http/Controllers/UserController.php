<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Http\Requests\UpdatePasswordProfileRequest;
use App\Http\Controllers\AbstractBaseController;
use App\Mail\UpdatePasswordConfirmationMail;
use App\Http\Requests\UserUpdateMailRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Session;
use App\Listeners\SendMailListener;
use App\Http\Requests\UserRequest;
use App\Mail\UpdateEmailMail;
use App\Events\SendMail;
use App\Models\Language;
use App\Models\Country;
use App\Models\User;
use App\Models\City;
use App\Models\LanguageLevel;
use App\Models\Repository;
use App\Models\UserLanguage;
use App\Models\WebPage;
use App\Models\MassangerName;
use App\Models\Hobby;
use App\Models\Skill;
use App\Models\Course;
use App\Models\UserType;


class UserController extends AbstractBaseController
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        
        $noApprovedUsers = User::whereHas('courses', function ($query) {
            $query->where('status', 'waiting');
        })->get();

        
        return view ( 'user.index', [ 'users' => $users, 'noApprovedUsers' => $noApprovedUsers ] );
    }

    public function create()
    {
        
        $cv = null;

        return view('user.create', ['cv' => $cv]);

    }

    public function store(UserRequest $request)
    {

        if($request->input('country')) {

            $country_find = $request->input('country');        
            $country = Country::where('name', $country_find)->first();
            if (!$country) {
                $country = new Country();
                $country->name = $request->input('country');
                $country->save();
            }
        }

        if($request->input('city')) {
            
            $city_find = $request->input('city');
            $city = City::where('name', $city_find)->first();
            if (!$city) {
                $city = new City();
                $city->name = $request->input('city');
                $city->save();
            }
        }

        
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        
        if($request->input('user_type') != 'NULL') {
            $user->user_type = $request->input('user_type');
        }
        $user->organization = $request->input('organization');
        $user->phone = $request->input('phone');
        if ($request->info) {
            $user->info = $request->input('info');
        }

        if($request->input('city')) {
            $user->city_id = $city->id;
        }

        if($request->input('country')) {
            $user->country_id = $country->id;
        }
        $user->password = Hash::make($request->input('password'));

        if($request->hasFile('user_cv')) {
            $filePath = config('app.files_path') . '/cv';
            $user->user_cv = $request->file('user_cv');
            $fileName = time() . '.' . $user->user_cv->extension();
            $request->file('user_cv')->move($filePath, $fileName);
            $user->user_cv = $fileName;
        }

        if ($request->hasFile('avatar')) {
            $filePath = config('app.files_path') . '/avatar';
            $user->avatar = $request->file('avatar');
            $fileName = time() . '.' . $user->avatar->extension();
            $request->file('avatar')->move($filePath, $fileName);
            $user->avatar = $fileName;
        }
        
        $user->save();
        
        if($request->input('language')) {
            
            $language = new Language();
            $language->name = $request->input('language');
            $language->save();
            
            $user_languages = new UserLanguage();
            $user_languages->language_id = $language->id;
            $user_languages->user_id = $user->id;
            $user_languages->level_id = $request->input('language-level');
            $user_languages->save();
        }


        
        
        if ($request->input('repository') != "") {
            $new_repo = $request->input('repository');
            $repo = Repository::where('description', $new_repo)->first();
            if (!$repo) {
                $repo = new Repository();
                $repo->description = $new_repo;
                $repo->user_id = $user->id;
                $repo->save();
            } else {
                $errors['repository'] = 'You got this repository.';
                return back()->withErrors($errors);
            }
        }
        
        if ( $request->input('url') != "" ){
            $new_url = $request->input('url');
            $url = WebPage::where('description', $new_url)->first();
            if (!$url) {
                $url = new WebPage();
                $url->description = $new_url;
                $url->user_id = $user->id;
                $url->save();
            } else {
                $errors['url']='You got this url.';
                return back()->withErrors($errors);
            }
        }
        
        if ( $request->input('messenger') != "" ){
            $new_messenger = $request->input('messenger');
            $messenger = MassangerName::where('description', $new_messenger)->first();
            if (!$messenger) {
                $messenger = new MassangerName();
                $messenger->description = $new_messenger;
                $messenger->user_id = $user->id;
                $messenger->save();
            } else {
                $errors['messenger']='You got this messenger.';
                return back()->withErrors($errors);
            }
        }
        
        if ( $request->input('hobby') != "" ){
            $new_hobby = $request->input('hobby');
            $hobby = Hobby::where('description', $new_hobby)->first();
            if (!$hobby) {
                $hobby = new Hobby();
                $hobby->description = $new_hobby;
                $hobby->user_id = $user->id;
                $hobby->save();
            } else {
                $errors['hobby']='You got this hobby.';
                return back()->withErrors($errors);
            }
        }

        if ( $request->input('skill') != "" ){

            $new_skill = $request->input('skill');
            $skill = Skill::where('description', $new_skill)->first();
            if (!$skill) {
                $skill = new Skill();
                $skill->description = $new_skill;
                $skill->user_id = $user->id;
                $skill->save();
            } else {
                $errors['skill']='You got this skill.';
                return back()->withErrors($errors);
            }
        }


        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('user.show_profile', compact('user'))->with([
            'countries' => $this->countriesList(),
            'cities' => $this->citiesList(),
            'languages' => $this->languagesList(),
            'languageLevels' => $this->languageLevels(),
        ]);
            
    }

    public function edit(User $user)
    {
        return view('user.edit_profile', compact('user'))->with([
            'countries' => $this->countriesList(),
            'cities' => $this->citiesList(),
            'languages' => $this->languagesList(),
            'languageLevels' => $this->languageLevels(),
        ]);
    }

    public function update( ProfileUpdateRequest $request, User $user)
    {
        
        $errors=[];

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->info = $request->input('info');
        $user->organization = $request->input('organization');

        $user_validated = auth()->user();

        if($user && $user->user_type == UserType::ADMIN_CODE) {

            if ($request->has('user_type') && $request->input('user_type') !== null) {
                if ($user->user_type != $request->input('user_type')) {
                    $user->user_type = $request->input('user_type');
                }
            }
        }
        
        if ($request->input('assign_to_course') !== NULL) {
            $courseId = $request->input('assign_to_course');
            
            if (is_numeric($courseId) && (!$user->courses()->where('course_id', $courseId)->exists())) {
                $user->courses()->attach($courseId, ['status' => 'business']);
            }
        }
        
        if ($request->input('course_ids')) {
            foreach ($request->input('course_ids') as $course_id) {
                $user->courses()->detach($course_id);
            } 
        }

        $countryMethod = $request->input('country');
        if ( $countryMethod == 'country-input' && $request->input('country-input') != "" ) {
            $countryName = $request->input('country-input');
            $country = Country::where('name', $countryName)->first();
            if (!$country) {
                $country = new Country();
                $country->name = $request->input('country-input');
                $country->save();
            }
        } else {
            if ( $request->input('country-select') != "NULL" ) {
                $countryId = $request->input('country-select');
                $country = Country::find($countryId);
            } else {
                $country = NULL;
            }
        }

        if ( $country != NULL && $user->country_id != $country->id ) {
            $user->country_id = $country->id;
        } else {
            if (  $country == NULL ) {
                $user->country_id = NULL;
            }
        }

        $cityMethod = $request->input('city');
        if ( $cityMethod == 'city-input' && $request->input('city-input') != "" ) {
            
            $cityName = $request->input('city-input');
            $city = City::where('name', $cityName)->first();
            if (!$city) {
                $city = new City();
                $city->name = $request->input('city-input');
                $city->save();
            }
        } else {
            if ( $request->input('city-select') != "NULL" ) {
                $cityId = $request->input('city-select');
                $city = City::find($cityId);
            } else {
                $city = NULL;
            }
        }

        if ( $city != NULL && $user->city_id != $city->id ) {
            $user->city_id = $city->id;
        } else {
            if (  $city == NULL ) {
                $user->city_id = NULL;
            }
        }

        $languageMethod = $request->input('language');
        if ( $languageMethod == 'language-input' && $request->input('language-input') != "" ) {
            $languageName = $request->input('language-input');
            $language = Language::where('name', $languageName)->first();
            if (!$language) {
                $language = new Language();
                $language->name = $request->input('language-input');
                $language->save();
            }
        } else {
            if ( $request->input('language-select') != "NULL" ) {
                $languageId = $request->input('language-select');
                $language = Language::find($languageId);
            } else {
                $language = NULL;
            }
        }

        if ( $language != NULL ){
            if ( $user->userLanguages->contains('language_id', $language->id)) {
                $errors['language'] = 'You have this language.';
            } else {
                if ( $request->input('language-level') == "NULL" ) {
                    $errors['language-level']= 'Level not selected.';
                } else {
                    $languageLevelId = $request->input('language-level');
                    $languageLevel = LanguageLevel::find($languageLevelId);
                    $userLanguage = UserLanguage::create([
                        'user_id' => $user->id,
                        'language_id' => $language->id,
                        'level_id' => $languageLevel->id,
                    ]);
                    $user->userLanguages()->save($userLanguage);
                }
            }
        }

        foreach( $user->userLanguages as $userLanguage ){
            $var_name = 'user-language-id-'.$userLanguage->language_id;
            if ( $userLanguage->level_id != $request->input($var_name) ){
                $userLanguage->level_id = $request->input($var_name);
                $userLanguage->save();
            }
        }

        if ( $request->input('repository') != "" ){
            $new_repo = $request->input('repository');
            $repo = Repository::where('description', $new_repo)->first();
            if (!$repo) {
                $repo = new Repository();
                $repo->description = $new_repo;
                $repo->user_id = $user->id;
                $repo->save();
            } else {
                $errors['repository']='You got this repository.';
            }
        }
        
        if ( $request->input('url') != "" ){
            $new_url = $request->input('url');
            $url = WebPage::where('description', $new_url)->first();
            if (!$url) {
                $url = new WebPage();
                $url->description = $new_url;
                $url->user_id = $user->id;
                $url->save();
            } else {
                $errors['url']='You got this url.';
            }
        }
        
        if ( $request->input('messenger') != "" ){
            $new_messenger = $request->input('messenger');
            $messenger = MassangerName::where('description', $new_messenger)->first();
            if (!$messenger) {
                $messenger = new MassangerName();
                $messenger->description = $new_messenger;
                $messenger->user_id = $user->id;
                $messenger->save();
            } else {
                $errors['messenger']='You got this messenger.';
            }
        }
        
        if ( $request->input('hobby') != "" ){
            $new_hobby = $request->input('hobby');
            $hobby = Hobby::where('description', $new_hobby)->first();
            if (!$hobby) {
                $hobby = new Hobby();
                $hobby->description = $new_hobby;
                $hobby->user_id = $user->id;
                $hobby->save();
            } else {
                $errors['hobby']='You got this hobby.';
            }
        }

        if ( $request->input('skill') != "" ){

            $new_skill = $request->input('skill');
            $skill = Skill::where('description', $new_skill)->first();
            if (!$skill) {
                $skill = new Skill();
                $skill->description = $new_skill;
                $skill->user_id = $user->id;
                $skill->save();
            } else {
                $errors['skill']='You got this skill.';
            }
        }

        if ( !empty($errors) ) {
            return back()->withErrors($errors);
        }
        
        $user->save();
        $user = User::find($user->id);

        if ( $user ) {

            
            $admin_user = User::where('id',  Auth::user()->id)->first();
            
            return view('user.edit_profile',[
                'user' => $user,
                'countries' => $this->countriesList(),
                'cities' => $this->citiesList(),
                'languages' => $this->languagesList(),
                'languageLevels' => $this->languageLevels(),
                'success' => 'Profile updated successfully'
            ]);
            

        } else {
            return back()->with('fail', 'Something went wrong. Try again!');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Menu item deleted successfully.');
    }


    public function deleteDetail(User $user, $detail, $id){
        $modelClass = 'App\Models\\' . ucfirst($detail);

        $record = (new $modelClass)->find($id);

        if ( $record->delete() ){
            return view('user.edit_profile', compact('user'))->with([
                'countries' => $this->countriesList(),
                'cities' => $this->citiesList(),
                'languages' => $this->languagesList(),
                'languageLevels' => $this->languageLevels(),
                'success' => 'Profile updated successfully'
            ]);
        } else {
            return back()->with('fail', 'Something went wrong. Try again!');
        }
    }

    public function deleteUserLanguage(User $user, $id)
    {
        $userLanguage = UserLanguage::find($id);
    
        if ($userLanguage) {
            $userLanguage->delete();
            return view('user.show_profile', compact('user'))->with([
                'countries' => $this->countriesList(),
                'cities' => $this->citiesList(),
                'languages' => $this->languagesList(),
                'languageLevels' => $this->languageLevels(),
                'success', 'Profile updated successfully'
            ]);
        } else {
            return back()->with('fail', 'Something went wrong. Try again!');
        }
    
        return view('user.show_profile', compact('user'))->with([
            'countries' => $this->countriesList(),
            'cities' => $this->citiesList(),
            'languages' => $this->languagesList(),
            'languageLevels' => $this->languageLevels(),
            'success', 'Profile updated successfully'
        ]);
    }

    public function updateEmail() {

        $userId = Auth::id();
        $user = User::find($userId);

        SendMail::dispatch($user, 'update_email');

        return redirect()->back()->with('success', 'We have sent you a message. Check your current email!');
    }

    public function updateEmailGet() {
        return view('user.password_email_update.email_update');
    }

    public function updateEmailPost(UserUpdateMailRequest $request, User $user) {
        
        $userId = Auth::id();

        if (Auth::check() && $userId) {
            $user = User::find($userId);
            
            if ($user) {
                $user->update([
                    'email' => $request->email,
                ]);
                
                SendMail::dispatch($user, 'update_email_confirmation', null);

                return redirect()->route('user.profile.show', compact('user'))->with('success', 'Your email has been updated!');
                
            } else {
                return redirect()->route('user.profile.show', compact('user'))->with('fail', 'Something went wrong!');
            }
        }
    }

    public function updatePassword() {
        return view('user.password_email_update.password_update');
    }

    public function updatePasswordPost(UpdatePasswordProfileRequest $request, User $user) {
        
        $userId = Auth::id();
        $user = User::find($userId);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        SendMail::dispatch($user, 'update_password_confirmation', null);
        
        return view('user.edit_profile',[
            'user' => $user,
            'countries' => $this->countriesList(),
            'cities' => $this->citiesList(),
            'languages' => $this->languagesList(),
            'languageLevels' => $this->languageLevels(),
            'success' => 'Profile updated successfully'
        ]);

    }
}
