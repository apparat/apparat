# Apparat

* Platform for publishing different kinds of posts ("[objects](OBJECTS.md)")
* Long-term accessibility
    * Simple storage technology & format → file based!
        * Markdown (CommonMark) for text based objects
        * Markdown meta data along with binary objects (images, other media types)
    * Consumable with least possible requirements
        * Organization = file system
        * Minium requirements: Computer, text viewer
* Independence
    * Each technology involved (except minimum requirements) should be replaceable
        * Implementation language [PHP]
        * Webserver
        * Temmplating framework