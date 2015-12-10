Apparat URL Design
==================

Each object published with *apparat* is assigned a unique **permanent URL** for access and retrieval. As *apparat* aims to impose as few requirements as possible the URLs need to be deliberately designed. In particular, they must not depend on

* a router,
* the webserver's index document feature,
* symbolic links or
* interpreters of any kind.

That said, *apparat*'s canonical object URLs need to stick **close to the file system** and should be easily resolvable even without a web server.


URL structure
-------------

As a matter of fact, there's no compelling reason why you would necessarily have to distribute the entirety of objects into a multi-level directory structure. Singling out the objects, however, keeps up file system performance and helps avoiding troubles with file and directory name length limitations under certain file systems. A typical *apparat* object URL looks like this:

	http://apparat.tools/2015/10/01/36704.event/36704
	
The path component consists of

1. up to five nested subdirectories denoting the object's [**creation date (and time)**](#creation-date), configurable from `YYYY/MM/DD` to `YYYY/MM/DD/HH/II`, 
2. an innermost directory named after the [**object ID**](#object-ids) and the [object type](#OBJECTS.md), serving as parent directory for all object related files,
3. and finally the [**object name**](#object-names) itself, consisting of the original **object file name** ([media objects](#media-objects) only), the **object ID** an optionally an [object revision](#object-revisioning) number. 

```
http://apparat.tools  /  2015/10/01  /  36704  .  image  /  36704  -  2
							 ^            ^         ^         ^       ^
						  creation     object    object    object   object
							date         ID       type       ID    revision
```

### Creation Date
 
Using the creation dates for structuring a large number of objects seems to be an **intuitive** and the **most widely accepted approach**. The dates are immutable, and unlike any other category system the calendar as such is perfectly stable, predictable and commonly understood. Although [ordinal dates](https://en.wikipedia.org/wiki/Ordinal_date) would be slightly shorter, *apparat* sticks to a [Gregorian date representation](https://en.wikipedia.org/wiki/Gregorian_calendar) as the large majority of users is not familiar with ordinal dates at all. 

### Object IDs

It is possible that several objects are created simultaneously (in terms of the date precision in use). In order to unambiguously distinguish these objects by URL they need to be **numbered sequentially** in some way. While it may be possible to interpret the preceding [date based URL part](#creation-date) by intuition, any form of abstract numbering will be of little cognitive value to users. So instead of numbering the objects "locally" (within the scope of their particular creation date and time), *apparat* applies a **"global" numbering across all objects**, turning the necessity into a feature. The absolute object creation order will always be comprehensible regardless of the creation dates.
 
 The object ID is used as the first part of the **object's parent directory** and once more as (a suffix to) the **[object name](#object-name)**. 

**Question**: Naturally sorting files by object ID?  

### Object types

Please see the [object summary](OBJECTS.md) for a list of known object types. 

### Object names

#### Text objects

A [text based object](OBJECTS.md#text-objects) (e.g. an article, note, etc.) results from a raw text submission, so the object file is created from scratch. The object name is built from

1. the automatically assigned **[object ID](#object-ids)** and
2. an optional [revision number](#object-revision), separated by a dash.

An example could be `36704-1`. The object file will be saved using a lower-case `.md` (Markdown) file extension and also include a [language indicator](#language-indicator). 

#### Media objects

In contrast, a [media object](OBJECTS.md#media-objects) (e.g. an image, video, etc.) derives from an existing file that is submitted during publication. As the original file name might describe the object's contents and thus be of a certain value to users, it is preserved, yet normalized to comply with general URL requirements. The object name is built from

1. the **normalized original file name** (without the file extension),
2. the automatically assigned **[object ID](#object-ids)** and finally
3. an optional [revision number](#object-revision), separated by a dash.

An example could be `myphoto.36704-2`. The media file will be saved with its **original lower-case file extension** and also include a [language indicator](#language-indicator).

#### Object revision

When an object gets modified and re-published, *apparat* saves a copy of the previous instance instead of simply overwriting it with the updated version. The latest instance will always be accessible under the canonical object URL, with the current version number being part of the object meta data. Previous versions may be explicitely retrieved by inserting a **version identifier** into the object URL (as a suffix of the object ID):

```
http://apparat.tools/2015/10/01/36704.event/36704-1.md
                        Identifier for version 1 ^^
```

*Apparat*'s versioning system is [explained in detail here](VERSIONING.md).

## Object file names

Object files use the [object name](#object-names) as first part of their file name, followed by a [language identifier](#language-identifier) and a [lower-case file extension](#file-extensions).

```
/2015/10/01/36704.image/  36704  -  2  .  de-de  .  md
                            ^       ^       ^        ^
                         object  object  language  file
                           ID   revision    ID   extension
```

### Language identifier

The language most appropriate for a particular user should be manually resolved or determined via [content negotiation](https://en.wikipedia.org/wiki/Content_negotiation). While canonical object URLs don't contain a language identifier for this reason, object file names very well do: The language identifier is appended to the object name, separated by a dot.

### File extensions

As also [recommended by TBL](http://www.w3.org/Provider/Style/URI.html#hmap-4), a **canonical object URL** doesn't use a file extension since the file format (which is what file extensions usually indicate) is an implementation detail that shouldn't be necessary for accessing and retrieving the object. When manually resolving an object URL, it will be easy to find the corresponding file as there will be no other one in the same directory with the very same name part. When resolving the URL via a webserver, [content negotiation should be used](http://www.w3.org/Provider/Style/URI.html#hmap-8). The object type — also part of the object URL — will support the negotiation process.