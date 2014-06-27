GetId3Bundle
===============

This bundle creates a Symfony integration for the GetId3 library. All actions will be recorded and show up in the
timeline in the Symfony2 profiler.

Currently only writing of tags is tracked. Feel free to extend it.

## Installation

Require [`simonsimcity/get-id3-bundle`](https://packagist.org/packages/simonsimcity/get-id3-bundle)
into your `composer.json` file:


``` json
{
    "require": {
        "simonsimcity/get-id3-bundle": "dev-master"
    }
}
```

Register the bundle in your Kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Simonsimcity\GetId3Bundle\SimonsimcityGetId3Bundle(),
        // ...
    );
}
```

You can activate the stopwatch for every call against the GetId3 library by adding the following lines to your
configuration:

```yaml
simonsimcity_get_id3:
    profiler_enabled: true
```

My personal recommendation is to add these lines to your `config_dev.yml` file.

In addition, you have to use the factory, provided in this bundle instead of creating the instances by your own. Here's
an example of how to use it:

```php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SampleController extends Controller
{
    public function updateId3TagsAction($file)
    {
        $tagWriter = $this->get("SimonsimcityGetId3.Factory")->getTagsWriter();
        $tagWriter->filename = $file;
        $tagWriter->tagformats = array('id3v2.3');
        $tagWriter->tag_encoding = 'UTF-8';
        $tagWriter->remove_other_tags = true;
        
        // ...
        
        $tagWriter->WriteTags();
    }
}
```
