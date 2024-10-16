# <img src="readmeAssets/icon.svg" height="50" width="50"> Statamic 3D Field

> Statamic 3D Field is a Statamic addon that allows uploading a 3d model and configuration options along with a tag for frontend usage. Uses [google/model-viewer](https://github.com/google/model-viewer) to display the 3d model.

## Features

This addon does:
- Upload a .glb 3d model
- Configure settings for the 3d model
- Tag for frontend usage

![Editor View](/readmeAssets/editorView.png)
![Config View](/readmeAssets/configView.png)

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require darinlarimore/statamic-3d-field
```

## How to Use

### Allow glb and usdz file types in `config/statamic/assets.php`
``` php
'additional_uploadable_extensions' => [
		'usdz', 'glb',
],
```

### Add the field to a blueprint
![3d Model Field](/readmeAssets/fieldType.png)
Name the field handle `three_d_model` or whatever you like.

### Configure the field settings
Choose an asset container.
![3d Model Field Configuration](/readmeAssets/configure.png)


### Use the tag in your template
Use the `3d_model` tag in your template to display the 3d model. The `field` parameter is required and should be the field handle you used in the blueprint.
``` html
{{ 3d_model field="three_d_model" class="w-full h-96" }}
```

