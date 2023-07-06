# Team Peppers

## Guidelines

### Adding new functionality
Ideally, each new functionality should be developed in a separate branch and merged to `main` after it's been tested. Same applies to fixes, additions etc.

### Controllers
Each controller represents a group of methods, related to the same functinality group. 
Example: UserController is responsible for User management, so everything related to a User should be in the UserController.

### API / Web routes / controllers

Because the project is designed to have an API as well -> it's a good practice to abstract the business logic from the controllers and put it in another classes under `Actions` namespace for example and then call the action from the Web / API controller. This way it will be much more easier to reuse the code from Web and API routes.

Example: App\Controllers\RegistrationController@register should call App\Actions\RegisterUserAction::register() or similar. Follow this approach for the other routes / controllers as well.

### Sending Emails (not a mandatory requirement though)

A better approach to sending emails would be to dispatch them as Jobs, that will run async. 
Example: user registers -> UserRegisteredEmail is fired; UserRegisteredEmailListener dispatches a send mail job.

PS: In case you don't want to use async jobs, you can still create the event / listener paid or even the job but don't dispatch it to the queue (just run it now)
