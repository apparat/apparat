Text objects
============

What follows is a list of supported text based object types.


1. Article (`article`)
----------------------
* For medium to large, episodic and / or timestamped texts
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `e-content` property
* See [IWC articles](https://indiewebcamp.com/article)


2. Notes (`note`)
-----------------
* For short, typically unstructured and possibly timestamped (plain)texts
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `e-content` property
* See [IWC notes](https://indiewebcamp.com/note)


3. Comments / replies (`reply`)
-------------------------------
* Similar to notes, but in reply to another resource which is necessary to know in order to fully understand the reply
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `e-content` property
* See [IWC notes](https://indiewebcamp.com/reply)


4. Code (`code`)
----------------
* For source code snippets
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `e-content` property
* Custom `p-language-name` and `p-language-version` properties to denote the programming language and version as hint for syntax highlighters etc.
* See [IWC code](https://indiewebcamp.com/code)


5. Event (`event`)
------------------
* For events
* Compatible with [µf2 h-event](http://microformats.org/wiki/h-event)
* Body file part is mapped to?
* See [IWC event](https://indiewebcamp.com/event)


6. RSVP (`rsvp`)
----------------
* Similar to replies, but in response to an event post
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the draft `p-rsvp` property
* See [IWC RSVP](https://indiewebcamp.com/rsvp)


7. Favourite (`favourite`)
--------------------------
* For favourites as on Twitter
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `u-like-of` property
* See [IWC favourite](https://indiewebcamp.com/favourite)


8. Like (`like`)
----------------
* For likes like on Facebook, Instagram etc.
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `u-like-of` property
* See [IWC like](https://indiewebcamp.com/like)


9. Bookmark (`bookmark`)
------------------------
* For bookmarks consisting of a URL, sometimes with a description or cite
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to the `e-content` property
* Special property `u-bookmark-of` to denote the bookmarked URL
* See [IWC bookmark](https://indiewebcamp.com/bookmark)


10. Checkin (`checkin`)
----------------------
* For venue checkins
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Body file part is mapped to?
* Has a `p-location h-card` property for setting the venue
* What about referencing a venue post?
* See [IWC checkin](https://indiewebcamp.com/checkin)


11. Review / recommendation / rating (`review`)
----------------------------------------------
* For reviews, recommendations or ratings
* Compatible with [µf2 h-review](http://microformats.org/wiki/h-review)
* Body file part is mapped to the `e-description` property


12. Venue / address (`venue`)
-----------------------------
* Named locations or address / geo, typically used for checkins
* Compatible with a basic [µf2 h-card](http://microformats.org/wiki/h-card)
* Body file part is mapped to?
* See [IWC venue](https://indiewebcamp.com/venue) and [µf2 opening hours](http://microformats.org/wiki/opening-hours)


13. Geographical coordinates (`geo`)
------------------------------------
* [WGS84](http://en.wikipedia.org/wiki/WGS84) geographic coordinates, typically used by checkins and events
* Compatible with [µf2 h-geo](http://microformats.org/wiki/h-geo)
* Body file part is mapped to?
* See [IWC location](https://indiewebcamp.com/location) 


14. Contact card (`contact`)
----------------------------
* Person or organization details
* Compatible with [µf2 h-card](http://microformats.org/wiki/h-card)
* Body file part is mapped to?
* See [IWC contact](https://indiewebcamp.com/contact)


15. Citation (`cite`)
---------------------
* Citation or reference to online publication
* Compatible with [µf2 h-cite](http://microformats.org/wiki/h-cite)
* Body file part is mapped to the `p-content` property
* See [IWC citation](https://indiewebcamp.com/citation)


16. Project (`project`)
-----------------------
* Citation or reference to online publication
* Compatible with [µf2 h-project](http://microformats.org/wiki/h-product)
* Body file part is mapped to the `e-description` property
* What about a `product` object type?


17. Item (`item`)
-----------------
* As base for a review, project / product or event (in rare cases)
* Compatible with [µf2 h-item](http://microformats.org/wiki/h-item)
* Body file part is mapped to?


Media objects
=============

Media objects consist of two files: The media file and a like-named YAML file containing the meta data. In addition, the meta data might be embedded into the media file in case the file format supports this. 


1. Images (`image`)
-------------------
* For photos or images with an optional caption / description
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Has a reference to the image file that is mapped to the `u-photo` property
* Body file part is mapped to the `e-content` property (image description)
* All image formats are allowed
* See [IWC photos](https://indiewebcamp.com/photo)


2. Audio (`audio`)
-------------------
* For audio files / sound recordings with an optional caption / description
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Has a reference to the audio file that is mapped to the `u-audio` property
* Body file part is mapped to the `e-content` property (audio file description)
* All audio formats are allowed
* See [IWC audio](https://indiewebcamp.com/audio)


3. Video (`video`)
-------------------
* For video files with an optional caption / description
* Compatible with [µf2 h-entry](http://microformats.org/wiki/h-entry)
* Has a reference to the video file that is mapped to the `u-video` property
* Body file part is mapped to the `e-content` property (audio file description)
* All video formats are allowed
* See [IWC video](https://indiewebcamp.com/video)


Object meta data
================

* Name
* Type
* Object UID
* Object UUID (see https://en.wikipedia.org/wiki/Universally_unique_identifier)
* File hash
* Summary
* Keywords
* Categories
* Revision
* Dates
	* Created
	* Modified
	* Published
* Status
	* Draft / Published
* URL
* Authors
* History
	* Zero or more of: Revision + URL
* References
	* Zero or more of: URL + Coupling status
* Involvements
	* Zero or more of: URL + Coupling status
* Meta data
	* Custom meta data for arbitrary purposes
* Templating variables
* Miscellaneous rendering instructions
	* Additional styles?
	* JavaScript libraries?
	
	
Associations with foreign objects
---------------------------------

Associations need to carry the following characteristics:

* Type of association
	* embed
	* reply
	* like
	* repost
* Association target
	* local (apparat) URL
	* absolute apparat URL (remote object)
	* arbitrary URL (no apparat object)
* Association status (maybe achievable via type couples: "embed" and "embedded-in" 
	* outgoing
	* incoming
* Coupling
	* Coupled objects (only valid for apparat objects)
	* Loosely coupled