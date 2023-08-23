<br/>
<p align="center">
  <a href="https://github.com/ZeadShalaby/SRNZ_PROJECT_SYSTEM">
    <img src="https://i.imgur.com/6kMSHq5.png" alt="Logo" width="300" height="270">
  </a>
  
<h3 align="center">SRZN PROJECT SYSTEM</h3>

  <p align="center">
    A Project not define yet
    <br/>
    <br/>
  </p>


![Forks](https://img.shields.io/github/forks/ZeadShalaby/SRNZ_PROJECT_SYSTEM?style=social) ![Issues](https://img.shields.io/github/issues/ZeadShalaby/SRNZ_PROJECT_SYSTEM) ![License](https://img.shields.io/github/license/ZeadShalaby/SRNZ_PROJECT_SYSTEM)

## Table Of Contents

* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
    * [Prerequisites](#prerequisites)
    * [Installation](#installation)
* [Usage](#usage)
    * [Locally](#running-locally)
    * [Via Container](#running-via-container)
* [Contributing](#contributing)
* [Authors](#authors)

## About The Project


It is a site for displaying antique products, pictures and picturesque artifacts, for artists and how to communicate with each other to sell or display them anywhere through it

## Built With

**Client:** Blade, Bootstrap

**Server:** Apache, Laravel

**Containerization Service:** Docker

**Miscellaneous:** Github
Actions, [Build and push Docker images](https://github.com/marketplace/actions/build-and-push-docker-images), [Docker Login](https://github.com/marketplace/actions/docker-login)

## Getting Started

To get a local copy up and running follow these simple example steps.

### Prerequisites

* npm

```sh
npm install npm@latest -g
```

* laravel

```sh
composer global require laravel/installer
```

Make sure that either **MySQL** or **MariaDB** are installed either manually or via **phpMyAdmin**

### Installation

Clone the project

```bash
  https://github.com/ZeadShalaby/SRZN_Project_System
```

Go to the project directory

```bash
  cd SRZN_Project_System
```

Install dependencies

```bash
  composer install
```

```bash
  npm install
```

## Usage

### Running Locally

Make the migrations to update the database

```bash
    php artisan migrate
```

Seed the Database

```bash
    php artisan db:seed
```

Start the server and run watch

```bash
    php artisan serve
```

```bash
    npx run watch
````

or alternatively run the .bat

```bash
    /autorun.bat
```

go to the following route

```
    http://127.0.0.1:8000/
```

### Running via container

pull the image 

```
docker pull zeadshalaby/lms
``` 

 run the container

 ```
 docker run --name lms -p 8000:8000 -d zeadshalaby/lms
 ```
 
 connect to Container Terminal
 
 ```
 docker exec -it lms /bin/sh
 ```
 
 make the migrations to update the database

```bash
    php artisan migrate
```

 go to the following page
 ```
 <container-ip>:8000
 ```
## Contributing

Any contributions you make are **greatly appreciated**.

* If you have suggestions for adding or removing projects, feel free
  to [open an issue](https://github.com/ZeadShalaby/SRNZ_PROJECT_SYSTEM/issues/new) to discuss it, or directly
  create a pull request after you edit the *README.md* file with necessary changes.
* Please make sure you check your spelling and grammar.
* Create individual PR for each suggestion.
* Make sure to add a meaningful description

### Creating A Pull Request

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/GoalFeature`)
3. Commit your Changes (`git commit -m 'Add some GoalFeature'`)
4. Push to the Branch (`git push origin feature/GoalFeature`)
5. Open a Pull Request

## Authors
* **Ziad Shalaby** - *Computer Science Student* - [Ziad Shalaby](https://github.com/ZeadShalaby)


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

