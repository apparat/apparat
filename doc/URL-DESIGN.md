Apparat URL Design
==================

All objects published via *apparat* are assigned unique [permanent URLs](https://en.wikipedia.org/wiki/Permalink) for access and retrieval. As *apparat* aims to impose as few requirements as possible, URLs need to be designed deliberately. In particular, object URLs SHOULD NOT depend on

* a routing mechanism,
* the web server's index document feature¹,
* symbolic links or
* interpreters of any kind.

Canonical object URLs widely adhere to the underlying file system and should be easily resolvable even without a web server.

1. Alternative approach: File formats and extensions [are implementation details](http://www.w3.org/Provider/Style/URI.html#hmap-4) that don't have to be transparent to the client. It is OK to use the web server layer to abstract away these details (and rely on the web server's rewrite features).


Object URLs
-----------

There's no really compelling reason to distribute the entirety of objects over a multi-level directory structure. Doing so, however, keeps up the file system performance and helps avoiding troubles with file and directory name length limitations under certain file systems. A typical *apparat* object URL looks like this:

	https://apparat.tools/2015/10/01/36704.event/36704
	
It consists of

1. a [base URL](#base-url) associated with the *apparat* instance as a whole (`https://apparat.tools/`),
2. up to six nested subdirectories denoting the object's [creation date (and time)](#creation-date), configurable from `YYYY/MM/DD` to `YYYY/MM/DD/HH/II/SS`,
3. an innermost directory named after the [object ID](#object-ids) and the [object type](#OBJECTS.md), serving as parent directory for all object related files,
4. and finally the [object name](#object-names) itself, consisting of the original **object file name** ([media objects](#media-objects) only), the **object ID** an optionally an [object revision](#object-revisioning) number.

```
https://apparat.tools  /  2015/10/01  /  36704  .  image  /  36704  -  2
           ^                  ^            ^         ^         ^       ^
        base URL           creation     object    object    object   object
                             date         ID       type       ID    revision
```

### Base URL

The base URL associated with an *apparat* instance MAY inlude login credentials, a port number and / or a path component (e.g. `http://user:password@example.com:80/objects/`). In general, the [HTTPS scheme](https://en.wikipedia.org/wiki/HTTPS) is preferred for *apparat* URLs.

### Creation Date
 
Using creation dates for structuring a large number of objects seems to be an **intuitive** and the **most widely accepted approach**. These dates are immutable, and unlike many other category systems the calendar is a pretty stable, predictable and commonly understood system. Although [ordinal dates](https://en.wikipedia.org/wiki/Ordinal_date) would be slightly shorter, *apparat* sticks to a [Gregorian date representation](https://en.wikipedia.org/wiki/Gregorian_calendar) as the large majority of users is not familiar with ordinal dates at all.

### Object IDs

It is possible that several objects are created simultaneously (in terms of the date precision in use). In order to unambiguously distinguish these objects by URL they need to be **numbered sequentially** in some way. While it may be possible to interpret the preceding [date based URL part](#creation-date) by intuition, any form of abstract numbering will be of little cognitive value to users. So instead of numbering the objects "locally" (within the scope of their particular creation date and time), *apparat* applies a **"global" numbering across all objects**, turning the necessity into a feature. The absolute object creation order will always be comprehensible regardless of the creation dates.
 
 The object ID is used as the first part of the **object's parent directory** and once more as (a suffix to) the **[object name](#object-name)**. 

**Question**: Naturally sorting files by object ID?  

### Object types

Please see the [object summary](OBJECTS.md) for a list of known object types. 

### Object names

#### Text objects

A [text based object](OBJECTS.md#text-objects) (e.g. an article, note, etc.) results from a raw text submission, so the object resource is created from scratch. The object name is built from

1. the automatically assigned **[object ID](#object-ids)** and
2. an optional [revision number](#object-revision), separated by a dash.

An example could be `36704-1`. The object resource will be saved using a lower-case `.md` (Markdown) file extension and also include a [language indicator](#language-indicator).

#### Media objects

In contrast, a [media object](OBJECTS.md#media-objects) (e.g. an image, video, etc.) derives from an existing file that is submitted during publication. As the original file name might describe the object's contents and thus be of a certain value to users, it is preserved, yet normalized to comply with general URL requirements. The object name is built from

1. the **normalized original file name** (without the file extension),
2. the automatically assigned **[object ID](#object-ids)** and finally
3. an optional [revision number](#object-revision), separated by a dash.

An example could be `myphoto.36704-2`. The media file will be saved with its **original lower-case file extension** and also include a [language indicator](#language-indicator).

#### Object revision

When an object gets modified and re-published, *apparat* saves a copy of the previous instance instead of simply overwriting it with the updated version. The latest instance will always be accessible under the canonical object URL, with the current version number being part of the object meta data. Previous versions may be explicitely retrieved by inserting a **version identifier** into the object URL (as a suffix of the object ID):

```
https://apparat.tools/2015/10/01/36704.event/36704-1.md
                         Identifier for version 1 ^^
```

*Apparat*'s versioning system is [explained in detail here](VERSIONING.md).

## Object resources

Object resources use the [object name](#object-names) as first part of their file name, followed by a [lower-case file extension](#file-extensions).

```
/2015/10/01/36704.image/  36704  -  2  .  md
                            ^       ^     ^
                         object  object   file
                           ID   revision  extension
```

### File extensions

As [recommended](http://www.w3.org/Provider/Style/URI.html#hmap-4) a **canonical object URL** doesn't use a file extension since the file format (which is what file extensions usually indicate) is an implementation detail that shouldn't be mandatory for accessing and retrieving the object. When manually resolving an object URL, it will be easy to find the corresponding file as there will be no other file in the same directory with the very same name part. When resolving the URL via a web server, [content negotiation should be used](http://www.w3.org/Provider/Style/URI.html#hmap-8). The object type (also part of the object URL) will support the negotiation process.


A word on ...
-------------

### Object localizations

In general, localized object versions are considered as completely separate objects with independent URLs, creation dates and revisions. There should be cross-references between localizations that preferably support content negotiation (TBD).


### Object references

Some properties support *apparat* object references as values (e.g. `meta.authors`). References to objects

* within the same *apparat* instance take the form of root relative URLs (e.g. `/2015/10/01/36704.event/36704`).
* of remote *apparat* instances use the custom protocol `aprt` (respectively `aprts`) to distiguish them from regular HTTP URLs and trigger object instantiation (e.g. `aprts://apparat.tools/2015/10/01/36704.event/36704`).