#!/bin/bash
mkdir /code/Administration/runtime/cache
chmod -R 777 /code/Administration/runtime/cache
mkdir /code/Administration/web/assets
chmod -R 777 /code/Administration/web/assets
tar -xvf /code/Administration/vendor.tar -C /code/Administration
