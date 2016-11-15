# Naxi
Do map stuff!


## Setup
Get a [Mapbox][mapbox] access token and add it to your settings at `/cp/addons/naxi/settings`.

## Usage
Use tags to access all available info.

```html
{{ naxi:geocode address="400 N Ervay, Dallas, TX" }}
  [{{ features:0:geometry:coordinates:0 }}, {{ features:0:geometry:coordinates:1 }}]
{{ /naxi:geocode }}
```

…or use the modifier to get the coordinates for the best match (great for [Vue][vue] components and other stuff).

```html
{{ address | naxi }}
```

Both of these result in `[-96.79825, 32.783822]`, a JavaScript array with longitude and latitude
(the standard order in web-based libraries for some reason).




[mapbox]: https://www.mapbox.com/
[vue]: http://vuejs.org/
