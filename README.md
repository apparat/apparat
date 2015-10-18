Apparat
=======

is (or will become) a strongly opionated object publishing platform focusing on independence, long-term accessibility and progressive enhancement. It's a personal experiment of [@jkphl](https://github.com/jkphl) and doesn't intend to serve a particular purpose except delighting its author. ;)


Modules
-------

* [apparat/resource](https://github.com/apparat/resource): File resource abstraction layer
	* Reading and writing files
	* Abstraction layer for multipart files (e.g. Markdown files with YAML front-matter)
* [apparat/object](https://github.com/apparat/object): Object abstraction layer
	* Creating, modifying & deleting objects of particular types
	* Accessing & retrieving objects
	* Managing object references & involvements
	* Managing object meta data
	* Object version management
* [apparat/server](https://github.com/apparat/server): *Apparat* object server
	* Object access & retrieval
	* Object search
	* Object filtering
	* API / object query language serving objects in different formats
		* JSON?
* [apparat/publisher](https://github.com/apparat/publisher): *Apparat* object publishing API
	* [Micropub](https://indiewebcamp.com/Micropub) implementation