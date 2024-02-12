Codezone/Sage WordPress theme
======================

## Deployments


Code deployment is managed with GitHub actions.

### Production
The current version of the theme is located at TBD. It deploys from the `main` branch.

### Staging
The new version of the theme is located at TBD. It deploys from the `staging` branch.

## Development

### Requirements
- Docker
- [DDEV](https://ddev.com/)
- Access to repo on GitHub

### Setup


1. Create a directory for your WordPress install
2. Run `wp core download` in your WordPress root directory
3. Clone this repository into the `your-wp-root-directory/wp-content/themes/lifbook-site` directory
4. Copy the `.ddev-config` folder from your theme directory as `.ddev` in your WordPress root directory. <br /> `cp -r lifebook-site/.ddev-config ../../.ddev`
5. Run `ddev start`in your WordPress root directory
6. Run `composer install` from your theme directory
7. Run `yarn` from your theme directory to set up node modules
8. Run `yarn build` from your theme directory for the first time to compile assets
9. To sync database from production you can use the codezone/wp-scripts package.
10. Run `git clone git@github.com:thecodezone/wp-scripts.git scripts` in your WordPress root directory
11. Run `scripts/setup` in your WordPress root directory to configure your WordPress CLI or manually add configurations to `wp-cli.yml` (copy from `scripts/wp-cli.yml.example` to `wp-cli.yml` in project root). Production and staging environment information is on MyKinsta, or ask a developer. See below for development environment info using ddev.
12. Run `scripts/sync production development` in your WordPress root directory to download the production database, media files and plugins

### Build commands

* `yarn dev` — Compile assets when file changes are made
* `yarn build` — Compile assets for production

### Development environment with ddev and wp-scripts

```
@development:
ssh: docker:www-data@ddev-lifebook-site-web/var/www/html
port: 22
host: ddev-lifebook-site-web
path: /var/www/html
url: https://lifebook-site.ddev.site
username: www-data
```

### This theme is built with Sage 10

Sage is a WordPress starter theme with block editor support.

- Harness the power of [Laravel](https://laravel.com) and its available packages thanks to [Acorn](https://github.com/roots/acorn)
- Clean, efficient theme templating utilizing [Laravel Blade](https://laravel.com/docs/master/blade)
- Modern frontend development workflow powered by [Bud](https://bud.js.org/)
- Out of the box support for [Tailwind CSS](https://tailwindcss.com/)
- 
## Original code is a fork of the Sage theme to be used as a starter theme for CodeZone.

To update fork:

- git fetch upstream
- git checkout main
- git merge upstream/main

To start a new project off this theme:

 - git clone https://github.com/thecodezone/sage.git my-custom-site
 - cd my-custom-site
 - rm -rf .git
 - git init
 - git add .
 - git commit -m "Initial commit with customized Roots Sage theme"
 - git remote add origin https://github.com/thecodezone/my-custom-site.git
 - git push -u origin main

