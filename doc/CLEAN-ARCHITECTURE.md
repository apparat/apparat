# The Clean Architecture

At least for me and for the smaller Apparat modules like [apparat/resource](https://github.com/apparat/resource), an overly textbooky [Domain Driven Design](DDD.md) approach doesn't seem to work too well. DDD introduces a lot of overhead in my case and isn't really explicit about how multiple modules should interact in the end. I'm still confused about how to layout files and folders and there are still DDD concepts that I'm not able to locate in my particular use case (e.g. events, commands, use cases etc.).
 
While searching for something simpler, yet equally powerful, I came across [The Clean Architecture](http://blog.8thlight.com/uncle-bob/2012/08/13/the-clean-architecture.html) and [The Clean Architecture in PHP](https://leanpub.com/cleanphp). I will give it a try and refactor *apparat/resource* a second time according to the following layout:

## Package structure / file & directory layout

```
.
|-- composer.json
|-- src
|   `-- <PACKAGE>
|       |-- Domain
|       |   |-- Contract
|       |   |-- Factory
|       |   |-- Model
|       |   |   `-- <MODULE>
|       |   |       |-- <MODULE>Interface.php
|       |   |       |-- Abstract<MODULE>.php
|       |   |       |-- ...
|       |   |       `-- InvalidArgumentException.php
|       |   |-- Repository¹
|       |   `-- Service
|       |-- Application
|       |   |-- Contract
|       |   |-- Controller
|       |   `-- Service
|       `-- Framework
|           |-- Http²
|           |-- Yaml³
|           |-- Persistence⁴
|           `-- Test
`-- tests
```

¹ Interfaces ("contracts") only

² User Interface: Arbitrary number of primary ports (e.g. `Api`, `Cli`, `Rest`, etc.)

³ External Libraries: Arbitrary number of adapters for external libraries / frameworks etc.

⁴ Infrastructure: Arbitrary number of secondary ports (e.g. database adapters)

## Conventions

* The file name of **abstract classes** MUST start with `Abstract`
* **Interface** file names MUST end with `Interface.php`
* **Exception** file names MUST end with `Exception.php`
* **Contract interfaces** strongly related to domain modules SHOULD be part of the module (otherwise located at `Domain/Contract`)