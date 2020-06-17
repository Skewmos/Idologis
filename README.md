[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2.5-8892BF.svg)](https://php.net/)
# Idologis
Projet d'agence immobilière listant des biens en location et en vente, développé avec le framework php symfony.

## Installation
Idologis fonctionne avec docker il vous faudra donc vous munir de [docker](https://www.docker.com/)

Pour Windows : 

Suivre les indications [suivantes](https://docs.docker.com/docker-for-windows/install/)

Pour linux : 

```bash
sudo apt update -y & sudo apt upgrade -y
sudo apt-get install  curl apt-transport-https ca-certificates software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt update
sudo apt install docker-ce
```
# Déploiement

Pour déployer le projet il vous suffira de lancer la commande suivante : 

```bash
docker-compose up -d
```

Pour éteindre l'ensemble des containers :

```bash
docker-compose down 
```

#Technologies

Le projet tourne avec les technologies suivantes : 

  - [PHP 7.4](php.net)
  - [Symfony 5](https://symfony.com/5)
  - [Twig](https://twig.symfony.com/)
  - [Doctrine](https://symfony.com/doc/current/doctrine.html)
  - [Composer](https://getcomposer.org/doc/)

# Versionnement

 Utilisation la méthodologie [GitFlow](https://danielkummer.github.io/git-flow-cheatsheet/) 
 
# Auteurs

  - Legrand Jérémie => [Skewmos](https://github.com/Skewmos)
