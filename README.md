# WPGraphQl Image DataUrl Plugin

This is an extension to the WPGraphQL plugin (https://github.com/wp-graphql/wp-graphql) that Generate DataUrl of MediaItems.

> Using this plugin? I would love to see what you make with it. 😃 [@maikap_dipankar](https://twitter.com/maikap_dipankar)

## Quick Install

- Install from the [WordPress Plugin Directory](https://wordpress.org/plugins/wp-graphql-image-dataurl/)
- Clone or download the zip of this repository into your WordPress plugin directory & activate the **WP GraphQL Yoast SEO** plugin
- Install & activate [WPGraphQL](https://www.wpgraphql.com/)

## Find this useful?

<a href="https://www.buymeacoffee.com/dipankarmaikap" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 40px !important;width: auto !important;" ></a>

## Usage

To query for the DataUrl simply add the `dataUrl` to your MediaItem:

### Featured Image

```graphql
query GetPostByID($id: ID!) {
  post(id: $id, idType: ID) {
    title
    uri
    featuredImage {
      node {
        id
        altText
        sourceUrl
        dataUrl
      }
    }
  }
}
```
This will then give you a result as such:


```json
{
  "data": {
    "post": {
      "title": "In doloremque dolor velit assumenda",
      "uri": "/2022/01/26/in-doloremque-dolor-velit-assumenda/",
      "featuredImage": {
        "node": {
          "id": "cG9zdDoxNTg=",
          "altText": "",
          "sourceUrl": "https://domain.com/.../01/e31cd4f05614.png",
          "dataUrl": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUg..."
        }
      }
    }
  }
}
or
{
  "data": {
    "post": {
      "title": "In doloremque dolor velit assumenda",
      "uri": "/2022/01/26/in-doloremque-dolor-velit-assumenda/",
      "featuredImage": null
    }
  }
}

```

### MediaItem

```graphql
query GetMediaByUrl($id: ID!) {
  mediaItem(id: $id, idType: ID) {
    id
    altText
    sourceUrl
    dataUrl
  }
}
```
This will then give you a result as such:

```json
{
  "data": {
    "mediaItem": {
      "id": "cG9zdDoxNjg=",
      "altText": "",
      "sourceUrl": "https://domain.com/wp-content/.../01/5ba99765.png",
      "dataUrl": "data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//g..."
    }
  }
}
or
{
  "data": {
    "mediaItem": {
      "id": "cG9zdDoxNjg=",
      "altText": "",
      "sourceUrl": null,
      "dataUrl": null
    }
  }
}
```

## Contributions

Contributions are welcome :). This was a very quick build.
Feel free to make a PR against this repo!

[Open an issue](https://github.com/dipankarmaikap/wp-graphql-image-dataurl/issues)

[@maikap_dipankar](https://twitter.com/maikap_dipankar)



