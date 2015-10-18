# File & directory structure for Apparat modules (DDD)

```
.
|-- composer.json
|-- src
|   `-- <PACKAGE>
|       |-- Application
|       |-- Domain
|       |-- Http¹
|       `-- Infrastructure
`-- test
```

¹ Arbitrary number of ports provided (may e.g. be `Api`, `Cli`, `Rest`, etc.)

# Namespaces

## `Domain`

* All things domain logic
	* Domain services
		* Representing, orchestrating and executing domain tasks and operations
		* Stateless
	* Entities
	* Value objects
	* Validators
	* Specifications
* Framework agnostic
* No external dependencies
* Infrastructure independent
	* Providing interfaces for secondary ports, e.g. a repository interface
* Must be run from the `Application` namespace
* Only domain logic changes should ever affect this namespace

## `Application`

* Main entry point
* Primary point of integration
	* Application level configuration
	* Dependency injection configuration
	* Framework integration
	* Abstract base classes
		* Providing shared functionality
		* No domain or port logic
		* To be extended by domain or port classes, e.g.
			* Entity base class (`Domain`)
			* Controller base (`Ports`)
	* Application services
		* Middleware between the outside world and the domain logic
		* Transforming commands from the outside to domain instructions
		* Possibly having dependencies (e.g. Framework)
		* Communication using DTOs (Data Transfer Objects)
	* Service providers
		* Translating primary port signals (HTTP, API, Cli, REST, etc.) to domain service calls 
		* Connecting the domain with the infrastructure (binding secondary adapters to domain interfaces)

## `Http` / `Api` / `Cli` / `Rest` ...
Primary Ports / "Driving" Adapters

* Connecting the application to "The Outer World"
* Controllers / MVC implementations
* Implementing domain interfaces

## `Infrastructure`
Secondary Ports / "Driven" Adapters

* Connecting the application to the local infrastructure
* Storage, databases (e.g. repository implementations), etc.
* Implementing domain interfaces

**Question**: What about grouping both the primary and the secondary adapter implementations in a directory named `Adapter` and then have a subdirectory for each single port / adapter?:

```
.
|-- composer.json
|-- src
|   `-- <PACKAGE>
|       |-- Application
|       |-- Domain
|       `-- Adapter
|           |-- Api
|           |-- Database
|           |-- Filesystem
|           |-- Http
|           `-- Log
`-- test
    `-- <PACKAGE>
        `-- Adapter
              `-- Test
```

___

Structure before DDD reorganization:

```bash
.
|-- README.md
|-- composer.json
|-- phpunit.php
|-- phpunit.xml.dist
|-- src
|   |-- Resource
|   |   |-- ExceptionInterface.php
|   |   |-- File
|   |   |   |-- CommonMark.php
|   |   |   |-- Exception
|   |   |   |   |-- InvalidArgument.php
|   |   |   |   `-- Runtime.php
|   |   |   |-- ExceptionInterface.php
|   |   |   |-- Frontmatter
|   |   |   |   `-- Yaml
|   |   |   |       |-- CommonMark.php
|   |   |   |       `-- Exception
|   |   |   |           `-- InvalidArgument.php
|   |   |   |-- FrontmatterInterface.php
|   |   |   |-- Generic.php
|   |   |   |-- Part
|   |   |   |   |-- Body
|   |   |   |   |   |-- CommonMark.php
|   |   |   |   |   |-- Exception
|   |   |   |   |   |   `-- OutOfBounds.php
|   |   |   |   |   |-- ExceptionInterface.php
|   |   |   |   |   |-- Generic.php
|   |   |   |   |   |-- Text.php
|   |   |   |   |   `-- Yaml.php
|   |   |   |   |-- Body.php
|   |   |   |   |-- BodyInterface.php
|   |   |   |   |-- Container
|   |   |   |   |   |-- Choice.php
|   |   |   |   |   |-- ChoiceInterface.php
|   |   |   |   |   |-- Exception
|   |   |   |   |   |   |-- InvalidArgument.php
|   |   |   |   |   |   |-- OutOfBounds.php
|   |   |   |   |   |   |-- OutOfRange.php
|   |   |   |   |   |   `-- Runtime.php
|   |   |   |   |   |-- ExceptionInterface.php
|   |   |   |   |   |-- Sequence.php
|   |   |   |   |   `-- SequenceInterface.php
|   |   |   |   |-- Container.php
|   |   |   |   |-- ContainerInterface.php
|   |   |   |   `-- ContainerTrait.php
|   |   |   |-- Part.php
|   |   |   |-- PartInterface.php
|   |   |   |-- Text.php
|   |   |   `-- Yaml.php
|   |   |-- File.php
|   |   |-- FileInterface.php
|   |   `-- Utility.php
|   |-- Resource.php
|   `-- ResourceInterface.php
`-- test
    |-- CommonMarkTest.php
    |-- FileTest.php
    |-- FrontMarkTest.php
    |-- TestBase.php
    |-- TextTest.php
    |-- YamlTest.php
    `-- files
        |-- cc0++.txt
        |-- cc0.txt
        |-- commonmark.md
        |-- frontmark.md
        |-- invoice.php
        `-- invoice.yaml
```