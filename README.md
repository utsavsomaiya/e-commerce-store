### Requirements
- PHP >= 8.2
- Other [Laravel requirements](https://laravel.com/docs/12.x/deployment#server-requirements)

### Installation
- Clone the repo: `git clone [REPO_URL] [DIRECTORY_NAME]`
- Create `.env` file from the example file: `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- Setup .env variables.
- Install the dependencies: `composer install`
- Generate Key: `php artisan key:generate`
- DB migrate: `php artisan migrate`

- NPM: `npm install`
- `npm run dev` and start developing...
- Note: For the production just run the `npm run build` command

### Prevent main branch direct pushes
1. Open terminal (not inside VS Code) and cd into the project directory
2. `touch .git/hooks/pre-push` (to create the hook file)
3. `nano .git/hooks/pre-push` (to edit the hook file)
4. Paste the following content in it and save:

```sh
#!/bin/bash

protected_branch='main'
current_branch=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')

if [ $protected_branch = $current_branch ]
then
    echo "${protected_branch} is a protected branch, create PR to merge"
    exit 1 # push will not execute
else
    exit 0 # push will execute
fi
```
