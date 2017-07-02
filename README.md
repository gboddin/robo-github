# Robo Github plugin

## Deployments

Plugin to create or update deployments on github from Robo.

### Available tasks

```bash
 github
  github:deploy:create       Create a github deployment
  github:deploy:fail         Fail a github deployment
  github:deploy:finish       Finish a github deployment
```

### Quick example:

#### Create a deployment ( and trigger hooks )

```bash
$ ./vendor/bin/robo github:deploy:create <http_token> <org> <repo> <ref> <environment>
```

#### Finish a deployment ( and trigger hooks )

```bash
$ ./vendor/bin/robo github:deploy:finish <http_token> <org> <repo> <ref> <environment>
```

#### Fail a deployment ( and trigger hooks )

```bash
$ ./vendor/bin/robo github:deploy:fail <http_token> <org> <repo> <ref> <environment>
```

#### Using the plugin in your tasks

See [the example RoboFile](RoboFile.example.php)
