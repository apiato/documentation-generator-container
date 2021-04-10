# [Apiato](https://github.com/apiato/apiato) Documentation Container

#### An Apiato container which can creates a documentation from API annotations in your source code.

This container works out of the box prefectly but if you want to change its configs or modify the codes follow this steps:


1) Copy the container from `VendorSection` to a section of your project and fix the namespaces
2) Update `section_name` & `html_files` in container configs
3) Update `apidoc.json` files in `ApiDocJs/private` & `public` folders and fix the `filename`

```json
{
    "header": {
        "filename": "Containers/NEW_SECTION_NAME/Documentation/UI/WEB/Views/documentation/header.md"
    }
}
```

### Dependencies
This container depends on [apidoc](https://apidocjs.com/). If you ever removed this container you can remove `apidoc` from your package.json safely.
