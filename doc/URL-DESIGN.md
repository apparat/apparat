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

	http://apparat.tools/2015/10/01/36704.event/36704.md
	
The path component consists of

1. up to five nested subdirectories denoting the object's [**creation date (and time)**](#creation-date), configurable from `YYYY/MM/DD` to `YYYY/MM/DD/HH/II`, 
2. an innermost directory named after the [**object ID**](#object-ids) and the [object type](#OBJECTS.md), serving as parent directory for all object related files,
3. and finally the [**object file**](#object-file-names) itself, once more named after the object ID and with **a lower-case file extension**. 

```
http://apparat.tools  /  2015/10/01  /  36704  .  event  /  36704  .  md
							 ^            ^         ^         ^       ^
						  creation     object    object    object     file
							date         ID       type       ID     extension
```

### Creation Date
 
Using the creation dates for structuring a large number of objects seems to be an **intuitive** and the **most widely accepted approach**. The dates are immutable, and unlike any other category system the calendar as such is perfectly stable, predictable and commonly understood. Although [ordinal dates](https://en.wikipedia.org/wiki/Ordinal_date) would be slightly shorter, *apparat* sticks to a [Gregorian date representation](https://en.wikipedia.org/wiki/Gregorian_calendar) as the large majority of users is not familiar with ordinal dates at all. 


### Object IDs

It is possible that several objects are created simultaneously (in terms of the date precision in use). In order to unambiguously distinguish these objects they need to be **numbered sequentially** in some way. While it may be possible to interpret the preceding [date based URL part](#creation-date) by intuition, any form of abstract numbering will be of little cognitive value to users anyway. So instead of numbering the objects "locally" (within their particular creation date and time), *apparat* applies a **"global" numbering across all objects**, turning the necessity into a feature. The absolute object creation order will always be comprehensible regardless of the creation dates.
 
 The object ID is used as the name of the **object's parent directory** and as a **suffix to the the [object file name](#object-file-name)** itself. 


### Object file names

#### Text based objects

A [text based object](OBJECTS.md#text-based-objects) (e.g. an article, note, etc.) results from a raw text submission, so the object file is created from scratch. The file name is built from

1. the automatically assigned **[object ID](#object-ids)** and
2. the appropriate **lower-case text file extension**.
 
An example could be `36704.md`.

#### File based objects

In contrast, a [file based object](OBJECTS.md#text-based-objects) (e.g. an image, video, etc.) derives from an existing file that is submitted during publication. As the original file name might describe the file's contents and thus be of a certain value to users, it is preserved, yet normalized to comply with general URL requirements. The object file name is built from

1. the **normalized original file name** (without the file extension),
2. the automatically assigned **[object ID](#object-ids)** and finally
3. the **lower-case normalized file extension**.

An example could be `myphoto.36704.jpg`.

Object versioning
-----------------

When an object gets modified and re-published, *apparat* saves a copy of the previous instance instead of simply overwriting it with the updated version. The latest instance will always be accessible under the canonical object URL, with the current version number being part of the object meta data. Previous versions may be explicitely retrieved by inserting a **version identifier** into the object URL (as a suffix of the object ID):

```
http://apparat.tools/2015/10/01/36704.event/36704-1.md
                        Identifier for version 1 ^^
```

*Apparat*'s versioning system is [explained in detail here](VERSIONING.md).