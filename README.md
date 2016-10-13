# ImageStitch plugin for Craft CMS

Take an array of images, stitch them together side-by-side, and output as one image in templates.

Example: I needed to randomly output multiple ~30 college logos from separate entries side-by-side but didn't want 30 http requests.

## Installation

To install ImageStitch, follow these steps:

1. Download & unzip the file and place the `imagestitch` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/chasegiunta/imagestitch.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require chasegiunta/imagestitch`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `imagestitch` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

## Configuring ImageStitch

Before using ImageStitch, navigate to the plugin's settings and define the local path where the final stitched image should be stored & referenced from.

## Using ImageStitch

ImageStich requires an array (`IMAGES` in the example below) of image URLs. Currently, it only accepts & outputs PNG's, so make sure the required `FILENAME` parameter has `.png` appended to the end. Images in other formats will be ignored. `OUTPUT HEIGHT`, `SPACING`, and `RANDOM` parameters are optional.

```
{{ imageStitch(FILENAME, IMAGES, HEIGHT, SPACING, RANDOM) }}
```
It's highly recommended to wrap the `imageStitch` function in Craft's cache tags.
The stitching process can be relatively slow.
Example showing srcset:

```
{% cache using key 'avatars' for 1 day %}
  <img src="{{ imageStitch('stitchedAvatars.png', avatars, 50, 0, true) }}">
{% endcache %}
```

Using srcset to display 2x images? Just double the height parameter.
```
<img src="{{ imageStitch('stiched.png', avatars, 50) }}" srcset="{{ imageStitch('stiched.png', avatars, 100) }} 2x">
```

## ImageStitch Roadmap

- Support JPEG input & output
- Support imagemagick for faster processing, if available

## ImageStitch Changelog

### 1.0.0 -- 2016.10.12

* Initial release

Brought to you by [ChaseGiunta](twitter.com/chasegiunta)