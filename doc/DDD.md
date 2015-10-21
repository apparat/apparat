# File & directory structure for Apparat modules (DDD)

```
.
|-- composer.json
|-- src
|   `-- <PACKAGE>
|       |-- Application
|       |   |-- CommandHandlers
|       |   |-- Entity.php
|       |   |-- ValueObject.php
|       |   `-- DTO.php
|       |-- Domain
|       |   `-- Command
|       |       `-- CommandBusInterface.php
|       |       `-- CommandHandlerInterface.php
|       `-- Framework
|           |-- Http¹
|           `-- Persistence²
`-- tests
```

¹ Arbitrary number of primary ports (may e.g. be `Api`, `Cli`, `Rest`, etc.)

² Arbitrary number of secondary ports

# Namespaces

## `Domain`

* Defining the behaviour and constraints of the application
* Business logic ("Core domain")
	* Entities
	* Value objects
	* Validators
	* Specifications
* Supporting domain logic
    * Domain services
        * Representing, orchestrating and executing domain tasks and operations
        * Stateless
    * Domain Events
    * Use-Cases / Commands (definitions of what actions an be taken on the applications)
* Framework agnostic / infrastructure independent
* Providing interfaces ("ports") for implementations ("adapters"), e.g. a repository interface
* No external dependencies³
* Must be run from the `Application` namespace
* Only domain logic changes should ever affect this namespace

³ Dependencies to 3rd-party libraries [might be OK](https://groups.google.com/d/msg/dddinphp/YGogT1NSbO0/u22c4dgoxdEJ) under certain circumstances:
> If it's something that you would write in your own domain code, and that would make sense to extract into some reusable code, and that can be extracted into a reusable library, then you might as well depend on a library that does the same thing, but that happens to have been written by someone else. 

## `Application`

* Main entry point
* Orchestrates the use of `Domain` layer entities
* Adapts requests from the `Framework` layer to the `Domain` layer
* Handles use-cases / commands
* Dispatches domain events raised by the `Domain` layer
* Primary point of integration
	* Application level configuration
	* Dependency injection configuration
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

## `Framework`

* Integration of 3rd-party libraries (e.g. everything composer pulls in)
* Adapts requests from the outside world to the `Application` layer
    * Accepting HTTP requests
    * Collecting user data
    * Routing to a Controller etc.
    * Calling an application use-case, passing on user data and make the `Application` layer handle the use-case
* Implementing `Application` interfaces
* Primary Ports / "Driving" Adapters
    * Connecting the application to "The Outer World"
    * Controllers / MVC implementations
    * e.g. `Http` / `Api` / `Cli` / `Rest` ...
* Secondary Ports / "Driven" Adapters
    * Connecting the application to the local infrastructure
    * Storage, databases (e.g. repository implementations), etc.

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