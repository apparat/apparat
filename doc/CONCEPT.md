# Apparat
> Construction principles

* Platform for publishing different kinds of posts ("[objects](OBJECTS.md)")
    * Mostly typical IndieWeb post types
    * Publishing via Micropub
    * Incorporating IndieWeb features (Webmentions, replies etc.)
    * Object versioning
* Modular architecture
    * Files & file system access
    * Object storage and low-level manipulation
    * Object presentation, search, etc.
    * Object creation & publishing
* Long-term accessibility
    * Simple storage technology & format → file based!
        * Text based objects: Markdown / CommonMark
        * Binary objects (images, other media types): Along with Markdown / CommonMark meta data 
    * Consumable with least possible requirements
        * Organization = file system
        * Deliberate [URL design](URL-DESIGN.md) so that humans can easily translate between URL and file system
        * Minimum requirements: Computer, file system access, text viewer
* Independence
    * Each technology involved (except minimum requirements) should be replaceable
        * Implementation language
        * Webserver
        * Templating engine
        * Posting client
        * etc.
    * Posting of objects should be possible offline (and synced later)
* Interoperability
    * Apparat instances should interoperate with each other