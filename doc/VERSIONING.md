Object versioning
=================

Instead of simply overwriting objects during re-publication, *apparat* uses a versioning strategy that is best explained with the help of some examples.

 
Versioning basics — a simple text object
-----------------------------------------

1. Imagine the initial publication of a note. An object file `note.123.md` is created with the `version` property set to `1` in its meta data.
2. When the object gets re-published, *apparat* compares the new content to the latest version. If the content didn't change, the process finishes with possibly altering the meta data of the latest existing object version.
3. If the content did change, however,
	* the latest object version is renamed to `note.123-1.md`, with `-1` being inserted as a version indicator (both the object file name and the meta data gets adjusted).
	* Then the updated object is again saved as `note.123.md`, using the previous version's meta data as a basis and updating it accordingly (e.g. setting the `version` property to `2`).
4. This way the most recent object version is always accessible under the very same canonical URL, with each instance having a complete list of its predecessors stored in its meta data.
4. A specific object revision may be retrieved by inserting the desired version identifier into the canonical URL.


Object cross references
-----------------------
 
As soon as there are multiple objects with references to each other (e.g. an article that embeds images), the situation gets more complex. The versioning strategy in this case partly depends on whether the objects have been created in one go.
 

### Independent objects

Imagine you create an object, say an image, and then some time later you create an article that embeds this image. In this case the objects are considered **"independent"** or **"loosely coupled"** as the image existed prior to and independently from the article.

Except the article explicitely references a particular version of the image (by using a version identifier in the image URL), a **dynamic reference** between the article and the most recent image version will be established. When the image gets updated, the article will automatically point to the updated image version. The article's list of referenced objects doesn't have to be updated. However, the article has to be removed from the second last image's list of referencing objects as the article doesn't point to this instance anymore.
  
### Coupled objects

In case several linked objects are created in one go, say an article and some embedded images, these objects are considered **tightly coupled**. A separate object will be created for each of them, but their special connection will be recorded in their meta data. Initially they are pointing to each others' most recent versions, but as soon as one of them gets updated, the referencing / referenced objects will be hard-wired to the shelved version.

For instance, if an newly created article embeds image `/2015/10/02/12345/image.12345.jpg`, and the  image gets updated later, the articles will be rewritten to reference `/2015/10/02/12345/image.12345-1.jpg` instead, loosing the dynamic coupling with the latest image version. Also, if the article itself gets updated, the images will be informed that the are no longer being referenced by the most recent article version but its version `1` instead. 