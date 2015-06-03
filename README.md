up-and-running-with-symfony
===========================

Following [Up and running with Symfony2](http://www.lynda.com/Symfony-tutorials/Up-Running-Symfony2-PHP/160060-2.html) on Lynda.com. 

## Things I learned

* There is a generator to generate doctrine entities from an existing database structure
* You can generate a bundle with the symfony console. Bundles register loading of controllers (with config for routes, etc.), entities, form classes, configs, resources for views, etc.
* Bundles are registered with the app in `app/AppKernel.php`.
* Routing needs to be added in `app/config/routing.yml` even if it's from a bundle already registered in the AppKernel. The bundle generator does this automatically.
* You can generate CRUD with the symfony console
* You can do the usual Doctrine stuff like updating schema, dumping sql, updating entities from configs, etc. More in my [doctrine example](https://github.com/mikedfunk/doctrine-example) repo.
* In order to add annotation references to classes/methods, you need to import those classes in use statements.
* It seems symfony core classes inject the dependency injection container into the class and use the container to resolve dependencies inside the class.
* Assetic will combine and minify css/js for you. It has a twig extension to make this look nice in twig.
* Validation is done by defining assertions in entity property docblocks.
* Form primitives are defined in WhateverType form classes, then a twig helper assembles that into a form.
* `$form->isValid()` is a shortcut to validating against entity assertions.
