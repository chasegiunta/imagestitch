# ImageStitch plugin for Craft CMS

Take an array of images, stitch them together side-by-side, and output as one image in templates, saving the client multiple HTTP requests.

## Installation

To install ImageStitch, follow these steps:

1. Download & unzip the file and place the `imagestitch` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/chasegiunta/imagestitch.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `imagestitch` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

## Configuring ImageStitch

Before using ImageStitch, navigate to the plugin's settings and define the local path where the final stitched image should be stored & referenced from.

## Using ImageStitch

ImageStich requires an array (`IMAGES` in the example below) of image URLs. It accepts `.png`, `.jpg`, and `.gif` image formats. ImageStitch can output `png` or `jpg` images. Be sure that your `FILENAME` parameter has the desired extension appended to the end. Images in other formats will be ignored. `OUTPUT HEIGHT`, `SPACING`, `RANDOM`, and `QUALITY` parameters are optional. `QUALITY` is only used on `png` output.

```
{{ imageStitch(FILENAME, IMAGES, HEIGHT, SPACING, RANDOM, QUALITY) }}
```
It's highly recommended to wrap the `imageStitch` function in Craft's cache tags.
The stitching process can be pretty slow.
Example showing srcset:

```
{% cache using key 'avatars' for 1 day %}
  <img src="{{ imageStitch('stitchedAvatars.png', avatars, 50, 0, true) }}">
{% endcache %}
```

Using `srcset` to display 2x images? Just double the height parameter and use a different filename.
```
<img src="{{ imageStitch('stiched.png', avatars, 50) }}" srcset="{{ imageStitch('stiched_2x.png', avatars, 100) }} 2x">
```

## ImageStitch Roadmap

- Support imagemagick for faster processing, if available


## ImageStitch Changelog


### 1.1.0 -- 2016.10.17

* Added support for JPG & GIF input
* Added support for JPG output
* Added quality parameter for JPG output

### 1.0.0 -- 2016.10.12

* Initial release

Brought to you by [ChaseGiunta](twitter.com/chasegiunta)