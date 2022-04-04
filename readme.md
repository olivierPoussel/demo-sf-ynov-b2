# Demo Sf B2

## Installation

```bash
git clone <repo>
cd demo
composer install
```

dupliquer le fichier .env et nommer le .env.local

Puis modifier la ligne de configuration de la bdd mysql dans le fichier .env.local
```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/demo"
``` 

créer la BDD et jouer les fixtures.
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixture:load
```

### Créer une entity

```bash
php bin/console make:entity
```
après la création d'une entity ne pas oublier de créer et executer la migration
```bash
php bin/console make:migration
php bin/console doctrine:migration:migrate
```