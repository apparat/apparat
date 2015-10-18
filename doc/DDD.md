# File & directory structure for Apparat modules (DDD)

by the example of the [apparat/resource](https://github.com/apparat/apparat) module.

```
.
|-- composer.json
|-- src
|   `-- Resource
|       |-- Application
|       |-- Domain
|       |-- Http¹
|       `-- Infrastructure
`-- test
```

¹ Not used / present in *apparat/resource*. Could be as well `Api`, `Cli` or `Rest`. **Question**: Should they be grouped inside a `Ports` directory instead?

___

Structure before DDD reorganization:

```
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