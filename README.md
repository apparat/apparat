Apparat
=======

is (or will become) an opinionated object publishing platform focusing on independence, long-term accessibility and progressive enhancement. In incorporates several [indieweb](https://indiewebcamp.com) technologies and principles and is a personal experiment of [@jkphl](https://github.com/jkphl).


Modules
-------

* [apparat/kernel](https://github.com/apparat/kernel): Core functionality
	* Module registration & environment management
	* Dependency Injection / IoC container
	* Logging
	* Signals & Slots
* [apparat/resource](https://github.com/apparat/resource): File resource abstraction layer
	* Reading and writing files
	* Abstraction layer for multipart files (e.g. Markdown files with YAML front-matter)
* [apparat/object](https://github.com/apparat/object): Object abstraction layer
	* Creating, modifying & deleting objects of [indieweb](https://indiewebcamp.com) types
	* Accessing & retrieving objects
	* Managing object relations & meta data
	* Object revision management
* [apparat/server](https://github.com/apparat/server): *Apparat* object server
	* Object access & retrieval
	* Object search
	* Object filtering
	* Object API
	    * `/2016/01/13/123-article/123-1` returns the article payload
	    * `/2016/01/13/123-article/123-1/meta` returns the article meta data as YAML / JSON object
	    * Could serve different formats depending on the `Accept` header
* [apparat/publisher](https://github.com/apparat/publisher): *Apparat* object publishing API
	* [Micropub](https://indiewebcamp.com/Micropub) implementation
	* [Webmention](https://indiewebcamp.com/webmention) implementation